<?php 
	class Pulse {
		private $table = null;
		private $last_query = null;
		private $append = null;
		private $last_error = null;
		private $link = null;
		private $columns = Array();
		private $database = null;
		private $primary_key = 'id';
		public $data = Array();
		
		public function __construct($array) {
			if (is_array($array)) {
				if (isset($array['table'])) {
					$this->table = $array['table'];
				}
				
				if(isset($array['primary'])) {
					$this->primary_key = $array['primary'];
				}
				
				if (isset($array['column']) && isset($array['value'])) {
					$this->load($array['column'], $array['value']);
				}
				elseif (!isset($array['column']) && isset($array['value'])) {
					$this->load($this->primary_key, $array['value']);
				}
				
				if (isset($array[$this->primary_key])) {
					$this->load($this->primary_key, $array[$this->primary_key]);
				}
				
				if (isset($array['link'])) {
					$this->link = $array['link'];
				}
				
				if (isset($array['host']) && isset($array['username']) && isset($array['password']) && isset($array['database'])) {
					$this->database = $array['database'];
					
					$this->connect($this->database, $array['host'], $array['username'], $array['password']);
				}
			}
		}
		
		public function connect($database, $host, $user, $password) {
			$this->link = mysql_connect($host, $user, $password);
			$query = mysql_select_db($database, $this->link);
			
			$this->checkError($query);
			
			return $this->link;
		}
		
		public function setPrimaryKey($primary_key) {
			$this->primary_key = $primary_key;
		}
		
		public function getPrimaryKey() {
			return $this->primary_key;
		}
		
		public function setLink($link) {
			$this->link = $link;
		}
		
		public function getLink() {
			return $this->link;
		}
		
		public function setTable($table) {
			$this->table = $table;
			$this->columns = $this->getColumns();
		}
		
		public function getTable($table) {
			return $this->table;
		}
		
		public function getColumns() {
			$query = 'SHOW COLUMNS FROM `' . $this->table . '`';
			$result = mysql_query($query);
			
			if (!$this->checkError($result)) {
				$columns = Array();
				while($record = mysql_fetch_array($result)) {
					$columns[] = $record['Field'];
				}
				
				$this->last_query = $query;
				return $columns;
			}
		}
		
		public function getIDs() {
			$query = 'SELECT ' . $this->primary_key . ' FROM `' . $this->table . '` ' . $this->append;
			$result = mysql_query($query);
			
			if (!$this->checkError($result)) {
				$ids = Array();
				while($record = mysql_fetch_array($result)) {
					$ids[] = $record[$this->primary_key];
				}
				
				$this->last_query = $query;
				return $ids;
			}
		}
		
		public function getLastQuery() {
			return $this->last_query;
		}
		
		public function getLastError() {
			return $this->last_error;
		}
	
		private function checkError($query) {
			if ($this->link != null) {
				if (!$query) {
					$this->last_error = "Pulse Error: " . mysql_errno($this->link) . ": " . mysql_error($this->link);
					return true;
				}
				else {
					$this->last_error = null;
					return false;
				}
			}
			else {
				return false;
			}
		}
	
		public function load($column, $value = null) {
			if ($value == null) {
				$value = $column;
				$column = $this->primary_key;
			}
			
			$query = "SELECT * FROM `" . $this->table . "` WHERE `" . $column . "` = '" . $value . "' " . $this->append;
			$result = mysql_query($query);
		
			if (!$this->checkError($result)){
				$record = mysql_fetch_array($result);
				
				$data = Array();
				$c = 1;
				foreach(array_keys($record) as $key) {
					if ($c % 2 == 0) $data[$key] = $record[$key];
					$c++;
				}
				
				$this->data = $data;
				$this->last_query = $query;
				return $data;
			}
		}
		
		public function getDatabase() {
			return $this->database;
		}
		
		private function secureData() {
			$data = Array();
			foreach(array_keys($this->data) as $key){
				$data[$key] = addslashes($this->data[$key]);
			}
		
			return $data;
		}
		
		public function create() {
			$data = $this->secureData();
		
			if(empty($this->columns)) {
				$this->columns = $this->getColumns();
			}
			
			$cols = $this->columns;
			for($i = 0; $i < count($cols); $i++) {
				$cols[$i] = '`'.$cols[$i].'`';
			}
		
			$vals = Array();
			foreach($this->columns as $key) {
				if(@$data[$key] != '') {
					array_push($vals, "'".$data[$key]."'");
				}
				else{
					array_push($vals, 'NULL');
				}
			}
		
			$query = "INSERT INTO  `".$this->table."` ( ".join(', ', $cols).") VALUES ( ".join(', ', $vals).")";
			$result = mysql_query($query);
			
			$this->checkError($result);
		
			$this->last_query = $query;
		}
		
		public function update() {
			$data = $this->secureData();
		
			$cols = array_keys($data);
			$vals = array_values($data);
		
			$pieces = Array();
			for($i = 0; $i < count($cols); $i++) {
				array_push($pieces, "`".$cols[$i]."` = '".$vals[$i]."'");
			}
		
			$query = "UPDATE  `".$this->table."` SET ".join(', ', $pieces)." WHERE  `" . $this->primary_key . "` = '".$data[$this->primary_key]."' ".$this->append;
			$result = mysql_query($query);
			
			$this->checkError($result);
			
			$this->last_query = $query;
		}
		
		public function delete() {
			$data = $this->secureData();
			$query = "DELETE FROM `".$this->table."` WHERE `" . $this->primary_key . "` = '".$data[$this->primary_key]."'  ".$this->append;
			$result = mysql_query($query);
		
			$this->checkError($result);
			
			$this->last_query = $query;
		}
		
		public function getAll() { //not optimized
			$ids = $this->getIDs();
		
			$multiplearray = Array();
			foreach($ids as $id) {
				$p = new Pulse(Array('table' => $this->table, 'link' => $this->link, $this->primary_key => $id));
				array_push($multiplearray, $p->data);
			}
		
			return $multiplearray;
		}
		
	}
?>