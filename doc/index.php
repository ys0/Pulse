<!DOCTYPE html>
<html>
	<head>
		<title>Pulse doc</title>
		
		<style>
			body  {
				font-family: monospace;
			}
			#mainTable { 
				width: 100%;
			}
			#mainTable tr { 
				vertical-align: top 
			}
			#mainTable tr td { 
				border: 1px dotted lightgray;
				padding: 5px;
			}
			#mainTable tr td ul { 
				padding-left: 0px; 
			}
			#mainTable tr td ul li { 
				list-style-type: none; 
			}
			a { 
				text-decoration: none;
				font-weight: bold;
				color: royalblue;
			}
			pre {
				background-color: #EEE;
				padding: 5px;
				color: green;
			}
		</style>
	</head>
	<body>
		<?php
			include '../Pulse.inc';
		?>
		
		<table id="mainTable">
			<tr>
				<td colspan="2">
					<h1 align="center">Pulse</h1>
				</td>
			</tr>
			<tr>
				<td  width="150px">
					<?php include 'menu.php'; ?>
				</td>
				<td>
					<?php
						if(isset($_GET['page'])){
							include './pages/' . $_GET['page'] . '.php';
						}
						else {
							include './pages/home.php';
						}
					?>
				</td>
			</tr>
		</table>
	</body>
</html>
