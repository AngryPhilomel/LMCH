<?php
session_start();
require "../server/config.php";
if(!isset($_SESSION['id']))
{
  header("Location".$site_url);
}
else
{
    if(isset($_GET['id']) & is_numeric($_GET['id']))
    {
      $uid=$_GET['id']
       ?>

       <!DOCTYPE html>
         <html>
         <head>
           <meta charset="utf-8" />
           <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script><![endif]-->
           <title>"<?=$uid;?>"</title>
           <meta name="keywords" content="" />
           <meta name="description" content="" />
           <link href="<?=$site_url;?>/style/common.css" rel="stylesheet"/>
           <link href="<?=$site_url;?>/style/feed.css" rel="stylesheet"/>
         </head>

         <body>

         <div class="wrapper">

           <header class="header">
            <div> <form action="<?=$site_url;?>">
              <label> <span class="fontawesome-arrow-left"></span><input type="submit" name="submit" value="Назад" class="button back"></label>
             </form></div>

             <div><form action="<?=$site_url;?>/server/exit.php">
              <label> <span class="fontawesome-off exit"></span><input type="submit" name="submit" value="Выход" class="button exitbut"></label>
             </form></div>
             </header><!-- .header-->

           <div class="middle">

             <div class="container">
               <main class="content">
                         <?php
                              $query9=mysqli_query($db,"SELECT * FROM `users` WHERE `id`=$uid");
                              if(mysqli_num_rows($query9)>0)
                              {
                                $u=mysqli_fetch_assoc($query9);

                                ?>
                                Name:<?=$u['name'];?>
                                <?php
                              }
                              else{
                                print "NOT FOUND";
                              }
                         ?>
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
                               <div class="userline"><a href="<?=$site_url;?>/modules/user.php?id=<?=$users_id;?>"><?=$users_name;?></a></div>
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
}
?>
