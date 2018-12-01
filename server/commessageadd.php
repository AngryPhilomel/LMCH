<?php
    session_start();
    require "config.php";
    if (isset($_POST['common_submit']))
    {
      $text=trim(htmlspecialchars($_POST['common_text']));
      $id=$_SESSION['id'];

      $query4=mysqli_query($db, "INSERT INTO `commonmessages` (`userid`, `messages`)
                                                            VALUES ('$id', '$text')");


      $query01=mysqli_query($db,"SELECT `id` FROM `commonmessages` ORDER BY id DESC LIMIT 1");
      if(mysqli_num_rows($query01)>0)
      {
        while ($messs=mysqli_fetch_assoc($query01))
        {
          $mes_last_read=$messs['id'];
  }}

  // ОБНОВЛЕНИЕ ПОСЛЕНДНЕГО ПРОЧИТАННОГО СООБЩЕНИЯ
  $query0=mysqli_query($db, "UPDATE `users` SET `lastRead`= '$mes_last_read' WHERE `users`.`id` = '$id' ");


    }
?>
