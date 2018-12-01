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
            $login=trim(htmlspecialchars($_GET["login"]));
            $password=trim(htmlspecialchars($_GET["password"]));

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

?>

<html>
    <head>
      <title>Авторизация</title>
      <link rel="stylesheet" href="../style/auth.css" media="screen" type="text/css" />
    </head>

    <body>
      <div id="login">
      <form method="GET" action="<?$site_url?>/modules/auth.php">
        <fieldset class="clearfix">
            <p><span class="fontawesome-user"></span><input type="text" name="login" placeholder="Логин"/></p>
            <p><span class="fontawesome-lock"></span><input type="password" name="password" placeholder="Пароль"></p>
            <p><input type="submit" name="submit" value="Вход"></p>
        </fieldset>
      </form>
    <p>Нет аккаунта? &nbsp;&nbsp;<a href="<?=$site_url;?>/modules/reg.php">Регистрация</a><span class="fontawesome-arrow-right"></span></p>
</div>

    </body>
</html>
<?php
}
?>
