<?
session_start();
if (isset($_SESSION["admin"]) && $_SESSION["admin"] == TRUE) 
{
	echo 
	"
	<button class=\"button_av\" onclick=\"myBtnExit()\">Выход</button>
	";
}
else
{
	echo 
	"
	<button class=\"button_av\" onclick=\"myBtnavtoriz()\">Aвторизоваться</button>
	";
}
?>
