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
 
    	<title>LMCH</title>
    	<meta name="keywords" content="" />
    	<meta name="description" content="" />
    	<link href="<?=$site_url;?>/style/common.css" rel="stylesheet"/>
      <link href="<?=$site_url;?>/style/feed.css" rel="stylesheet"/>
      <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

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
          <label><span class="fontawesome-off exit"></span><input type="submit" name="submit" value="Выход" class="button exitbut"></label>
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
