<?php
session_start();
require "config.php";

    $query5=mysqli_query($db, "SELECT * FROM `commonmessages` ORDER BY `id` DESC");
      if(mysqli_num_rows($query5)>0)
      {
        while ($mes=mysqli_fetch_assoc($query5))
        {
          $mes_userid=$mes['userid'];
          $mes_message=$mes['messages'];
          $mes_id=$mes['id'];


              $query6=mysqli_query($db, "SELECT `name`, `department` FROM `users` WHERE `id`=$mes_userid LIMIT 1");
                  $mesuser=mysqli_fetch_assoc($query6);

          ?>
          <div class="mes_messageline">
            <div class="messLineLeft"><?= "<b>".$mesuser['name']."(".$mesuser['department']."): </b>".$mes_message; ?></div>
            <div class="messLineRight">
              <?php
                  if($_SESSION['id']==$mes_userid)
                  {?>
                      <a href="<?=$site_url;?>/server/commessagedelete.php?id=<?=$mes_id;?>">✗</a></div></a>
                  <?}?>

          </div>
        </div>

          <?php

        }
               // ПОСЛЕДНЕЕ ПРОЧИТАННОЕ СООБЩЕНИЕ
                $usid=$_SESSION['id'];
                $query02=mysqli_query($db,"SELECT `lastRead` FROM `users` WHERE `id`= '$usid' ");
                if(mysqli_num_rows($query02)>0)
                {
                  while ($lrmes=mysqli_fetch_assoc($query02))
                  {
                    $lastMes=$lrmes['lastRead'];
                }}

                // ПОСЛЕННЕЕ СООБЩЕНИЕ В ЧАТЕ
                $query01=mysqli_query($db,"SELECT `id` FROM `commonmessages` ORDER BY id DESC LIMIT 1");
                if(mysqli_num_rows($query01)>0)
                {
                  while ($messs=mysqli_fetch_assoc($query01))
                  {
                    $mes_last_read=$messs['id'];
                }}
                if($lastMes != $mes_last_read){
              // ОБНОВЛЕНИЕ ПОСЛЕНДНЕГО ПРОЧИТАННОГО СООБЩЕНИЯ
                $query0=mysqli_query($db, "UPDATE `users` SET `lastRead`= '$mes_last_read' WHERE `users`.`id` = '$usid' ");

         ?>
         </script>

         <script type="text/javascript">

       function mesAlert() {
  var i = 1;
  var timerId = setTimeout(function go() {
    if(i%2==0){
    document.title = "LMCH";
  }
    else {
      document.title = "(<?=$mes_last_read - $lastMes?>)Новое сообщение";
    }
    if (i < 20) setTimeout(go, 500);
    i++;
  }, 100);
}

function defaultTitle(){
  document.title = "LMCH";
}

mesAlert();
defaultTitle();

         </script>
         <?

       }
      }
      else
      {
        print "Что-то не так.";
      }
      ?>
