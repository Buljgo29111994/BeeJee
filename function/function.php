<?
session_start();
function add($name, $email, $description)
{
	include '../conect.php';
	$name = htmlentities($name, ENT_QUOTES);
	$email = htmlentities($email, ENT_QUOTES);
	$description = htmlentities($description, ENT_QUOTES);
	$mark = "не выполнено";
	$return = $pdo->prepare("INSERT INTO Tasks (Name, Email, Description, Mark) VALUES (:name, :email, :description, :mark)");
	$return->bindParam(":name", $name);
	$return->bindParam(":email", $email);
	$return->bindParam(":description", $description);
	$return->bindParam(":mark", $mark);
	$return->execute();
}

function show($page, $varik, $sort)
{
	include '../conect.php';
	if ($page == NULL || !preg_match('/^\+?\d+$/', $page)) 
	{
		$page = 1;
	};

	$notesOnPage = 3;
	$from = ($page - 1) * $notesOnPage;

 	if ($sort == NULL && $_SESSION["sortirovka"] == NULL) {
	 	$return = $pdo->prepare("SELECT * FROM `Tasks` LIMIT $from,$notesOnPage");
	 };

	 if (isset($sort) AND $varik == "top") {
	 	$return = $pdo->prepare("SELECT * FROM `Tasks` ORDER BY `$sort` LIMIT $from,$notesOnPage");
	 	$_SESSION["sortirovka"] = "SELECT * FROM `Tasks` ORDER BY `$sort` ";
	 }

	  if (isset($sort) AND $varik == "bottom") {
	 	$return = $pdo->prepare("SELECT * FROM `Tasks` ORDER BY `$sort` DESC LIMIT $from,$notesOnPage");
	 	$_SESSION["sortirovka"] = "SELECT * FROM `Tasks` ORDER BY `$sort` DESC ";
	 }
	 if ($sort == NULL && isset($_SESSION["sortirovka"])) {
	 	$return = $pdo->prepare($_SESSION["sortirovka"] ."LIMIT $from,$notesOnPage");
	 };

	$return->execute();
	$Tasks = $return->fetchALL(PDO::FETCH_ASSOC);
	return $Tasks;
}

function pagination($page)
{
	include '../conect.php';
	$notesOnPage = 3;
	$counts = $pdo->query('SELECT COUNT(*) FROM `Tasks`')->fetchColumn(); 
	$pageCount = ceil($counts / $notesOnPage);
	$prev = $page - 1;
	if ($prev <= 0 ) 
	{
		$prev = 1;
	};

	$next = $page +1;
	if ($next > $pageCount) 
	{
		$next = $pageCount;
	};

echo 
	"
	<div class=\"container\">
	<div class=\"add_list\">
	";

	if ($pageCount > 1) {
		echo "<a href=\"?page=$prev\"><<</a> ";
	}

	for ($i = 1; $i <= $pageCount; $i++) 
	{ 
		if ($page == $i) {
			$class = " class=\"activ\"";
		}
		else
		{
			$class = "";
		}

		echo "<a href=\"?page=$i\"$class>$i</a> ";
	}
	if ($pageCount > 1) {
		echo "<a href=\"?page=$next\">>></a> ";
	}
	echo "
	<div>
	</div>
	";
}

function Edit ($id, $description, $Mark){
	include '../conect.php';
	$set = $pdo->prepare("SELECT * FROM `Tasks` WHERE `Id` = $id");
	$set->execute();
	$Tasks = $set->fetchALL(PDO::FETCH_ASSOC);
	foreach ($Tasks as  $value):
		if ($value['Description'] != $description) 
		{
			$Mark = $Mark."<br>отредактировано администратором";
		}
	endforeach;
	$return = $pdo->prepare("UPDATE `Tasks` SET `Description`= :description,`Mark`= :Mark WHERE Id = :id");
	$return->bindParam(":id", $id);
	$return->bindParam(":description", $description);
	$return->bindParam(":Mark", $Mark);
	$return->execute();
}
?>

