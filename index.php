<?php
    include_once("template/settings.php");
    if ($_GET)
    {
        echo $_GET['message'];
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>CRUD приложение на PHP</title>
    <meta name="description" content="Добавление заметок и комментариев к ним">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">   
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,700&display=swap" rel="stylesheet">
    <link href="css/base.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<header class="header">
    <div class="container">
        <div class="header-inner">
            <h1>Добавить новую запись</h1>
            <form action="public.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <textarea name="note" class="form-control" placeholder="Введите текст" required></textarea>
                </div>
                <br>
                <input name="post" type="submit" class="btn" value="Добавить запись">
                <strong><?php 
                if(isset($_GET['message']))
                {
                    echo $_GET['message'];
                }
            ?></strong>
            </form>
        </div>
    </div>
</header>

<?php
$sql = mysqli_query($db, 'SELECT `likes`, `dislikes`, `funs`, `id`, `message`, `time` FROM posts');
$sql2 = mysqli_query($db, 'SELECT `post_id`, `id`, `message`, `time` FROM comments');

while ($result = mysqli_fetch_assoc($sql)) {
    echo '<br>';
    print "{$result['message']}: {$result['time']}
    <form action='like.php' method='POST'>
    <button style='width:25x;height:25px' name='like' type='submit'value='{$result['id']}'> 👍 {$result['likes']}</button>
    <button style='width:25x;height:25px' name='dislike' type='submit' value='{$result['id']}'> 👎 {$result['dislikes']}</button>
    <button style='width:25x;height:25px' name='funs' type='submit' value='{$result['id']}'> 😂 {$result['funs']}</button></form></h2>
    <form action='comment.php' method'GET'>
    <input name='comment' type='text' placeholder='Ваш коммент'><button name='com' type='submit' value='{$result['id']}'> Комментировать </button></form>";
    foreach($sql2 as $result2){
        if($result2['post_id'] == $result['id']){
            print "<span id='dots' style='display:none'></span><span style='display: inline' id='more'>{$result2['message']}: {$result2['time']}</div><br></span>";
        }
    }
}
?>
</body>
</html>
