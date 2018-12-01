<?php
session_start();
require "../server/config.php";

if(!isset($_SESSION['id']))
{
  header("Location".$site_url);
}
else
{
  ?>

  <!DOCTYPE html>
    <html>
    <head>
    	<meta charset="utf-8" />
    	<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script><![endif]-->
    	<title>LMCH</title>
    	<meta name="keywords" content="" />
    	<meta name="description" content="" />
    	<link href="<?=$site_url;?>/style/common.css" rel="stylesheet"/>
      <link href="<?=$site_url;?>/style/feed.css" rel="stylesheet"/>

      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
      </script>



      <script type="text/javascript">
          function mode() {
            $.ajax({
                url: '<?=$site_url?>/server/commessageget.php',
                success: function(data) {
                    $('#display').html(data);
                }
            });
          };

          setInterval(mode, 1000);

          </script>

          <script type="text/javascript">
            <!--
            function clearForm(f) {
              window.setTimeout(function() {
                f.elements.common_text.value='';
              }, 100);
            }
            //-->
            </script>



    </head>

    <body>

    <div class="wrapper">

    	<header class="header">
        <div><form action="<?=$site_url;?>/server/exit.php">
          <span class="fontawesome-off exit"></span><input type="submit" name="submit" value="Выход" class="button exitbut">
        </form></div>
    	</header><!-- .header-->

    	<div class="middle">

    		<div class="container">
    			<main class="content">
                    <div class="feed_wrap">
                      <div id="display"></div>
                    </div>

                    <!-- ПРОКРУТКА ВНИЗ -->
                    <input type="button" id="button" value="↑ВВЕРХ↑" />
                    <script>
                    var scrollinDiv = document.getElementById('display');
                      button.onclick = function() {
                        scrollinDiv.scrollTop = 0;
                      };

                    </script>




                    <div class="commonmessages_send">
                      <iframe name="iframe1" style="position: absolute; left: -999px" onload="clearAndSend(event);"></iframe>
                      <form method="POST" action="<?=$site_url?>/server/commessageadd.php" target="iframe1" id=sendForm onsubmit="clearForm(this); return true;">
                          <input type="text" name="common_text" placeholder="Ваше сообщение" autofocus id="mymessage" autocomplete="off"><br/>
                          <input type="submit" name="common_submit" value="Отправить" class="button send">
                      </form>

                    </div>
          </main><!-- .content -->
    		</div><!-- .container-->

    		<aside class="right-sidebar">
          <div class="users">
              <?php
                  $query8=mysqli_query($db,"SELECT * FROM `users`");
                      if(mysqli_num_rows($query8)>0)
                      {
                        while($users=mysqli_fetch_assoc($query8))
                        {
                          $users_id=$users['id'];
                          $users_name=$users['name'];
                          ?>
                          <div class="userline"><a href="<?=$site_url;?>/modules/user.php?id=<?=$users_id?>"><?=$users_name;?></a></div>
                          <?php
                        }
                      }
              ?>
          </div>
        </aside><!-- .right-sidebar -->

    	</div><!-- .middle-->

    </div><!-- .wrapper -->

    <footer class="footer">

    </footer><!-- .footer -->

    </body>
    </html>

  <?php
}
?>
