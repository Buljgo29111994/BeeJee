<?
session_start();

if (!isset($_SESSION["admin"])) 
{
	include '../function/function.php';
	$result = show ($_POST['page'], $_POST['varik'], $_POST['sort']);
?>
	<table class="table"  border="1" width="100%" cellpadding="5">
<?
foreach ($result  as  $value):
	if ($value['Mark'] == "Выполнено" || $value['Mark'] == "Выполнено<br>отредактировано администратором" ) 
	{
		$class = " class=\"mark_green\"";
	}
	else
	{
		$class = " class=\"mark\"";
	}
?>
<tr>
	<td><h6><?= $value['Name']?></h6></td>
	<td><h6><?= $value['Email']?></h6></td>
	<td><h6><?= $value['Description']?></h6></td>
	<td<?echo $class ?>><h6><?= $value['Mark']?></h6></td>
</tr>
<?
endforeach;
?>
	</table>
<?
	pagination($_POST['page']);
};

/*--------------------------------------------------------------------------------------------------------------------------*/
if (isset($_SESSION["admin"])) 
{
	include '../function/function.php';
	$result = show ($_POST['page'], $_POST['varik'], $_POST['sort']);
?>
	<table class="table"  border="1" width="100%" cellpadding="5">
<?
foreach ($result  as  $value):
	if ($value['Mark'] == "Выполнено" || $value['Mark'] == "Выполнено<br>отредактировано администратором" ) 
	{
		$class = " class=\"mark_green\"";
	}
	else
	{
		$class = " class=\"mark\"";
	}
?>
<tr>
	
	<td><h6><?= $value['Name']?></h6></td>
	<td><h6><?= $value['Email']?></h6></td>
	<td><h6><?= $value['Description']?></h6></td>
	<td<?echo $class ?>><h6><?= $value['Mark']?><br><button class="button" onclick="Edit_Tasks('<?= $value['Id']?>')">Редактировать</button></h6></td>
	
</tr>
<?
endforeach;
?>
	</table>
<?
	pagination($_POST['page']);
}

?>