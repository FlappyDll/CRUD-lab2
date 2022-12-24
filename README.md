Реализация шаблона CRUD
========================
Задание
------------------------
Разработать и реализовать клиент-серверную информационную систему, реализующую механизм CRUD.
Система предназначена для анонимного общения в сети интернет.

Интерфейс системы представляет собой веб-страницу с лентой заметок, отсортированных в обратном хронологическом порядке и форму добавления новой заметки. В ленте отображаются последние 100 заметок.

Возможности пользователей:
- добавление текстовых заметок в общую ленту
- реагирование на чужие заметки(лайки, дизлайки, смайлики)
- добавление комментариев к чужим заметкам

Ход работы
------------------------

### [1. Пользовательский интерфейс](https://www.figma.com/file/VtJEYULVUZrCOfmWFQrJR0/Untitled?node-id=0%3A1&t=DQEoyEzQpMcGWfZ3-1)

#### 2. Пользовательский сценарий работы

Пользователь попадает на главную страницу **index.php**. 
Вводит любое текстовое сообщение. В случае корректного ввода данных, его сообщение появится на общей стене в обратном хронологическом порядке, сначала новые, затем старые публикации. 
Пользователи могут ставить лайки, дизлайки, смайлики на записи, а так же комментировать их.
Для этого необходимо ввести свой комментарий в поле под записью и нажать кнопку **Комментировать**.

#### 3. API сервера и хореография
![Добавление заметки](https://user-images.githubusercontent.com/90519017/209437984-9f747e57-149c-48e3-b5ae-14219ec54a8b.png)


![Реакция](https://user-images.githubusercontent.com/90519017/209437994-86cf8c43-f234-4a48-80ed-6e4626a5a715.png)


#### 4. Структура базы данных

 Таблица *posts*
| Название | Тип | NULL | Описание |
| :------: | :------: | :------: | :------: |
| **id** | INT  | NO | Автоматический идентификатор поста |
| **message** | TEXT | NO | Текст заметки |
| **likes** | INT | NO | Количество лайков |
| **dislikes** | INT | NO | Количество лайков |
| **funs** | INT | NO | Количество смайлов |
| **time** | DATETIME | NO | Дата создания поста |

Таблица *comments*
| Название | Тип | NULL | Описание |
| :------: | :------: | :------: | :------: |
| **id** | INT  | NO | Идентификатор комментария |
| **post_id** | INT  | NO | Идентификатор поста |
| **text** | TEXT | NO | Текст комментария |
| **time** | DATETIME | NO | Дата создания комментария |


#### 5. [Алгоритмы]
![Алгоритм](https://user-images.githubusercontent.com/90519017/209438095-cd5a71fb-72ff-4834-bd4d-a3a8860aed1f.png)


#### 6. HTTP запрос/ответ
**Запрос**  
Request URL: http://localhost/index.php
Request Method: POST
Status Code: 200 OK
Remote Address: [::1]:80
Referrer Policy: strict-origin-when-cross-origin
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9
Accept-Encoding: gzip, deflate, br
Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7
Cache-Control: no-cache
Connection: keep-alive
Content-Length: 150
Content-Type: application/x-www-form-urlencoded
Cookie: text=dimbrus%20skazal%20axyet%0D%0A; PHPSESSID=tjdf9k1fm7b06s0mjcf2m74log
DNT: 1
Host: localhost
Origin: http://localhost
Pragma: no-cache
Referer: http://localhost/index.php
sec-ch-ua: "Google Chrome";v="107", "Chromium";v="107", "Not=A?Brand";v="24"
sec-ch-ua-mobile: ?0
sec-ch-ua-platform: "Linux"
Sec-Fetch-Dest: document
Sec-Fetch-Mode: navigate
Sec-Fetch-Site: same-origin
Sec-Fetch-User: ?1
Upgrade-Insecure-Requests: 1
User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36

**Ответ**
Connection: Keep-Alive
Content-Encoding: gzip
Content-Length: 1352
Content-Type: text/html; charset=UTF-8
Date: Fri, 23 Dec 2022 23:35:55 GMT
Keep-Alive: timeout=5, max=100
Server: Apache/2.4.52 (Ubuntu)
Vary: Accept-Encoding
#### 7. Значимые фрагменты кода
**Добавление комментариев(comment.php)**
```
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

```
**Поставить лайк/дизлайк/смайлик (reaction.php)**
```
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

```

**Подключение базы данных (template/settings.php)**
```
require_once 'pdoconfig.php';
$db = mysqli_connect ($host, $username, $password, $dbname);
```
