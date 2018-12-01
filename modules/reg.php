<?php
require "../server/config.php";
session_start();

if(isset($_SESSION['id']))
{
    header("Location:".$site_url."/modules/feed.php");
}

else
{
  if(isset($_GET['submit']))
  {
    $login=trim(htmlspecialchars($_GET['login']));
    $name=trim(htmlspecialchars($_GET['name']));
    $password=trim(htmlspecialchars($_GET['password']));
    $department=trim(htmlspecialchars($_GET['department']));

    $query001=mysqli_query($db,"SELECT `id` FROM `commonmessages` ORDER BY id DESC LIMIT 1");
    if(mysqli_num_rows($query001)>0)
    {
      while ($messs=mysqli_fetch_assoc($query001))
      {
        $mes_last_read=$messs['id'];
    }}
    else $mes_last_read=0;

    $query2 = mysqli_query($db, "SELECT * FROM `users` WHERE `login`='$login'");

      if(mysqli_num_rows($query2)>0)
      {
          print "Логин уже занят.";
      }
      else
      {
          $query3 = mysqli_query($db, "INSERT INTO `users`(`login`, `password`, `name`, `lastRead`, `department`)
                                                VALUES ('$login', '$password', '$name', '$mes_last_read', '$department')");
                                                
                                                
                                     
          if(!$query3)
          {
            print "Что-то не так. Попробуй еще раз. Ошибка базы данных.";
          }
          else {
            $query1 = mysqli_query($db, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");

            if(mysqli_num_rows($query1)>0)
            {
                $users = mysqli_fetch_assoc($query1);
                $_SESSION['id'] = $users['id'];
                header("Location:".$site_url."/modules/feed.php");
            }
          else {
            print "Что-то пошло не так.";
          }
          }
      }
  }


?>

<html>
    <head>
      <title>Регестрация</title>
      <link rel="stylesheet" href="../style/auth.css" media="screen" type="text/css" />
    </head>

    <body>
      <div id="login">
      <form method="GET" action="<?$site_url?>/modules/reg.php">
        <p><span class="fontawesome-user"></span><input type="text" name="login" placeholder="Логин"></p>
        <p><span class="fontawesome-barcode"></span><input type="text" name="name" placeholder="Имя"></p>
        <p><span class="fontawesome-lock"></span><input type="text" name="password" placeholder="Пароль"></p>
        <p><span class="fontawesome-briefcase"></span>
        <p><select name="department">
          <option value="" disabled selected hidden>Отдел</option>
          <option value="Стройматериалы">Стройматериалы</option>
          <option value="Cтолярные изделия">Cтолярные изделия</option>
          <option value="Электротовары">Электротовары</option>
          <option value="Инструменты">Инструменты</option>
          <option value="Напольные покрытия">Напольные покрытия</option>
          <option value="Плитка">Плитка</option>
          <option value="Сантехника">Сантехника</option>
          <option value="Водоснабжение">Водоснабжение</option>
          <option value="Сад">Сад</option>
          <option value="Скобяные изделия">Скобяные изделия</option>
          <option value="Краски">Краски</option>
          <option value="Декор">Декор</option>
          <option value="Освещение">Освещение</option>
          <option value="Хранение">Хранение</option>
          <option value="Кухни">Кухни</option>
          <option value="B2B">B2B</option>
          <option value="Склад">Склад</option>

</select>
        <p>
        <input type="submit" name="submit" value="Регистрация"><br/>
      </form>

<br/>

  <p>Уже зарегестрированы? &nbsp;&nbsp;<a href="<?=$site_url;?>/modules/auth.php">Авторизация</a><span class="fontawesome-arrow-right"></span></p>
</div>

    </body>
</html>
<?php
}
?>
