<?php
include_once("template/settings.php");

if(isset($_POST['like']))
{
    $id_like = $_POST['like'];
    $sql = mysqli_query($db, 'UPDATE posts SET likes = likes + 1 WHERE id = '.$id_like.'');
    header('Location: index.php');
    exit();
}
if(isset($_POST['dislike']))
{
    $id_dislike = $_POST['dislike'];
    $sql = mysqli_query($db, 'UPDATE posts SET dislikes = dislikes + 1 WHERE id = '.$id_dislike.'');
    header('Location: index.php');
    exit();
}
if(isset($_POST['funs']))
{
    $id_funs = $_POST['funs'];
    $sql = mysqli_query($db, 'UPDATE posts SET funs = funs + 1 WHERE id = '.$id_funs.'');
    header('Location: index.php');
    exit();
}
header('Location: index.php');
exit();
?>