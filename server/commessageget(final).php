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
                $query01=mysqli_query($db,"SELECT `id`, `messages` FROM `commonmessages` ORDER BY id DESC LIMIT 1");
                if(mysqli_num_rows($query01)>0)
                {
                  while ($messs=mysqli_fetch_assoc($query01))
                  {
                    $mes_last_read=$messs['id'];
                }}
                if($lastMes < $mes_last_read){
              // ОБНОВЛЕНИЕ ПОСЛЕНДНЕГО ПРОЧИТАННОГО СООБЩЕНИЯ
                 $query0=mysqli_query($db, "UPDATE `users` SET `lastRead`= '$mes_last_read' WHERE `users`.`id` = '$usid' ");

         ?>


         <script type="text/javascript">

        function alertNotifi(){
            <?php
           
      $query011=mysqli_query($db,"SELECT `id`, `messages`, `userid` FROM `commonmessages` ORDER BY id DESC LIMIT 1");
      if(mysqli_num_rows($query011)>0)
      {
        while ($messs=mysqli_fetch_assoc($query011))
        {
          $mes_last_read=$messs['id'];
          $mes_last_text=$messs['messages'];
          $mes_user_id=$messs['userid'];
      }}
      
       $query06=mysqli_query($db, "SELECT `name`, `department` FROM `users` WHERE `id`=$mes_user_id LIMIT 1");
                  $mes_user=mysqli_fetch_assoc($query06);
      ?>
      
      sendNotification("<?=$mes_user['name']."(".$mes_user['department']."):";?>", {
    body: '<?=$mes_last_text;?>',
    icon: '',
    dir: 'auto'
    });
            
        }
        
        
        alertNotifi();

            // HTML5 NOTIFI

            function sendNotification(title, options) {

            if (!("Notification" in window)) {
            alert('Ваш браузер не поддерживает HTML Notifications, его необходимо обновить.');
            }


            else if (Notification.permission === "granted") {

            var notification = new Notification(title, options);

            function clickFunc() { alert('Пользователь кликнул на уведомление'); }

            notification.onclick = clickFunc;
            }


            else if (Notification.permission !== 'denied') {
            Notification.requestPermission(function (permission) {

            if (permission === "granted") {
            var notification = new Notification(title, options);

            } else {
            alert('Вы запретили показывать уведомления');
            }
            });
            }


            }


         </script>
         <?

       }
      }
      else
      {
        print "Что-то не так.";
      }
      ?>
