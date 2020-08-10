<?
session_start();

if ($_POST['action'] == "tru" && !isset($_SESSION["admin"])) 
{
	echo 
	"		<div class=\"container\">
			<div class=\"modal_list\">
			<form method=\"post\" action=\"obrabotchik/obrabotchik_form.php\" id=\"authorization\">
			<p>Login:</p>
			<input type=\"text\" name=\"login\" required />
			<p>Password:</p>
			<input type=\"password\" name=\"password\" required />
			<br>
			<input type=\"submit\" name=\"submit\" value=\"Ok\" class=\"button_ok\"/>
			</form>
			</div>
			</div>
	";
}
elseif ($_POST['action'] == TRUE && isset($_SESSION["admin"])) 
{
			echo 
			"
			<div class=\"container\">
			<div class=\"modal_list\">
			<h2>Вы успешно авторизованы!</h2>
			</div>
			</div>
			";
};

if (isset($_POST['login'])) 
{
			include '../conect.php';
			$stmt = $pdo->prepare('SELECT * FROM `Admin` WHERE `Login` = ?');
			$stmt->execute([$_POST['login']]);
			$row = $stmt->fetch(PDO::FETCH_LAZY);
			if ($row->Login == $_POST['login'] && $row->Password == $_POST['password'] ) 
			{
			$_SESSION["admin"] = TRUE;
			echo 
			"
			<div class=\"container\">
			<div class=\"modal_list\">
			<h2>Вы успешно авторизованы!</h2>
			</div>
			<div>
			";
			}
			else
			{
			echo 
			"	
			<div class=\"container\">
			<div class=\"modal_list\">
			<h4>Неверный Login или Password</h4>
			<form method=\"post\" action=\"obrabotchik/obrabotchik_form.php\" id=\"authorization\">
			<p>Login:</p>
			<input type=\"text\" name=\"login\" required />
			<p>Password:</p>
			<input type=\"password\" name=\"password\" required />
			<br>
			<input type=\"submit\" name=\"submit\" value=\"Ok\" class=\"button_ok\"/>
			</form>
			</div>
			</div>
			";
			}
};


if (isset($_POST['Description_edit']))
{
	if (isset($_SESSION["admin"])) 
	{
			if(!empty($_POST['checkbox'])){
		 		$Mark = "Выполнено";
		 	}
		 	else
		 	{
		 		$Mark = "не выполнено";
		 	}
		 	if (isset($_POST['mark_2'])) {
		 		$Mark = "Выполнено";
		 	}
		 	include '../function/function.php';
		 	Edit($_POST['id'], $_POST['Description_edit'], $Mark);

			echo 
			"
			<div class=\"container\">
			<div class=\"modal_list\">
			<h4>Запись успешно отредактирована</h4>
			</div>
			</div>
			";
	}
	else
	{
		echo 
		"
		<div class=\"container\">
		<div class=\"modal_list\">
		<h4>Вам необходимо авторизоваться</h4>
		</div>
		</div>
		";

	}
}

if ($_POST['action_edit'] == "Edit_Tasks" )
{
			$id = $_POST['id'];
			include '../conect.php';
			echo 
			"
			<div class=\"container\">
			<div class=\"modal_list\">
			";
			$return = $pdo->prepare(" SELECT * FROM `Tasks` WHERE `Id` = $id");
			$return->execute();
			$Tasks = $return->fetchALL(PDO::FETCH_ASSOC);

			foreach ($Tasks as  $value):
			?>
			<h3>Редактирование  записи</h3>
			<form method="POST" action="obrabotchik/obrabotchik_form.php" id="saveAdmin">
			<input type="text" name="id" value="<?= $value['Id']?>" id="stels" ><br>
			<input type="text" name="Description_edit" value="<?= $value['Description']?>"><br>

			<?
			if ($value['Mark'] == "не выполнено") {
				echo "<h6>Отметка о выполнении</h6><input type=\"checkbox\" name=\"checkbox\">";
			}
			else
			{
			echo "<input type=\"text\" name=\"mark_2\" value=\"gud\" id=\"stels\" >
			<h6>Задание выполнено</h6>";
			}
			?>
			<br>
			<input type="submit" name="submit" value="Сохранить">
			</form>
			<?
			endforeach;
			echo 
			"
			$q
			</div>
			</div>
			";
}

if ($_POST['action'] == "exit") 
{
			session_destroy();
}
?>
	
