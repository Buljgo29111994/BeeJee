<?
require '../function/function.php';

add($_POST['name'],$_POST['email'], $_POST['description']);

echo 
"<div class=\"container\">
<div class=\"modal_list\">
<h4>Задание успешно добавлено</h4>
</div>
</div>
";
?>