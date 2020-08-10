<?
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<script src="js/jquery.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>
<body onload="showbtn();index_show('<?echo $_GET['page']?>');">
	<div class="modali" id="modali">
	</div>
	<div class="container" >
	<div id="showbtn">
	</div>
		<div class="add_list">
			<form method="post" action="obrabotchik/obrabotchik.php" id="addTask">
				<p>Имя пользователя:</p>
				<input type="text" name="name" required />
				<p>E-mail:</p>
				<input type="email" name="email" required />
				<p>Текст задачи:</p>
				<input type="text" name="description" required />
				<br>
				<input type="submit" name="submit" class="button_ok" value="OK" />
			</form>			
		</div>
		</div>
		<div class="container" >
				<table class="table"  border="1" width="100%" cellpadding="5">
					<tr>
						<td class="td_top">
							<h5>Имя пользователя:</h5>
							<button onclick="sortirovka('Name', 'top', '<?echo $_GET['page']?>')">∧</button>
							<button onclick="sortirovka('Name', 'bottom', '<?echo $_GET['page']?>')">∨</button>
						</td>
						<td class="td_top">
							<h5>E-mail:</h5>
							<button onclick="sortirovka('Email', 'top', '<?echo $_GET['page']?>')">∧</button>
							<button onclick="sortirovka('Email', 'bottom', '<?echo $_GET['page']?>')">∨</button>
						</td>
						<td class="td_top">
							<h5>Текст задачи:</h5>
							<button onclick="sortirovka('Description', 'top', '<?echo $_GET['page']?>')">∧</button>
							<button onclick="sortirovka('Description', 'bottom', '<?echo $_GET['page']?>')">∨</button>
						</td>
						<td class="td_top"><h5>Cтатус</h5>
							<button onclick="sortirovka('Mark', 'top', '<?echo $_GET['page']?>')">∧</button>
							<button onclick="sortirovka('Mark', 'bottom', '<?echo $_GET['page']?>')">∨</button>
						</td>
					</tr>
				</table>
			<div id="index_show"></div>
	</div>
<script src="js/js.js"></script>
</body>
</html>