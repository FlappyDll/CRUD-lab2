<?php
include_once("template/settings.php");

if(empty($_POST))
{
    header('Location: index.php');
    exit();
}

$result = $_POST['note'];
if(empty($result) or $result == null)
{
    header('Location: index.php?message=Поле должно быть заполнено');
    exit();
}

$result2 = mysqli_query ($db, "INSERT INTO `posts`(`message`, `likes`, `dislikes`, `funs`) VALUES ('".$result."','0','0','0')");

header('Location: index.php');
exit();
?>