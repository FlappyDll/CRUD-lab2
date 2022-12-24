<?php
include_once("template/settings.php");

if(isset($_GET['comment']))
{
    if(isset($_GET['com']))
    {
        $post_id = $_GET['com'];
        $comment = $_GET['comment'];
        $id = 0;
        $sql = mysqli_query($db, "INSERT INTO `comments` (`id`, `post_id`, `message`) VALUES ('".$id."', '".$post_id."', '".$comment."')");
    }
}
header('Location: index.php');
exit();
?>