
<?php 
session_start();

    include_once("conn.php");
   $sender= $_SESSION["username"] ;
    $avatar_user=$_SESSION["useravatar"];
 

   /***********************posted*******************/

   $user=$_GET['user'];
                          $sql = "SELECT * FROM `users` WHERE user_name='$user'  ";

                           $result = $conn->query($sql);
                          $row = $result->fetch_assoc();
   
 
  
      $path="img/post/";
      $path2 ="img/user_img/";
        $path3 ="img/background/";

   /* $sql="select * from post (post_by,post_title,post_desc,post_img, post_date,post_time,post_category)values('$posted_by','$title','$desc','$img_post','$date','$time','$category')";
   */ 
    
             

?>

<!DOCTYPE html>
<html >
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>profile</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" >
     <link rel="stylesheet" href="css/font-awesome.min.css" >
     <link rel="stylesheet" href="css/w3.css" >
    <link rel="stylesheet" href="css/home.css" >
  <style>
     
      </style>
    <!--[if lt IE 9]>
      <script src="js/html5shiv-3.6.2.jar"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

<nav class="navbar navbar-inverse navbar-fixed-top  ">
  <div class="container con">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="home.php">Photo <span>zoom</span></a>
    </div>
    <div class="collapse navbar-collapse navbar-right navbar-hover" id="myNavbar">
        
      <ul class="nav navbar-nav">
        <li ><a href="home.php">Home</a></li>
        <li class=""><a href="profile.php">Profile</a></li>
        <li><a href="messages.php">Messages</a></li> 
        
      </ul>
        
        <form action="home.php" method="GET" class="navbar-form navbar-left" role="search" >
<div class="form-group">
<input type="text" class="form-control" placeholder="Search" name="search">
</div>

</form>
      <ul class="nav navbar-nav navbar-right">
        <li ><a href="profile.php" style="height: 50px;"><img style="
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-top: -12px;" src="<?php echo $path2.$_SESSION['useravatar'];?>"> </a></li>
        <li><a href="session_destroy.php"><i class="fa fa-power-off fa-lg"></i> </a></li>
        
      </ul>
    </div>
  </div>
</nav>
              <section class="container home">
               
                     <div class="user_profile text-center">
                         <div class="background" style="background-image: url('<?php echo $path3.$row["user_background"];?>');">
                         <div class="pro ">
                           <a href="#"><img alt="image" src="<?php echo $path2.$row["user_avatar"];?>" class="avatar"></a>
                         </div>
                         <div class="about text-center">
                           <h3><?php echo  $row["user_full_name"];?></h3>
                         </div>
                        </div>
                     </div>

                <div class="row">
                  <div class="col-sm-4 side ">

                     <div class="user_profile text-center">
                        
                       
                         <div class="about text-center"  style="color:#345;">
                          <h3><?php echo  $row["user_name"];?></h3>
                           <h5><?php echo  $row["specialty"];?> </h5>
                           <span> <i class="fa fa-map-marker fa-fw"></i><?php echo  $row["user_country"];
                           echo ' , '.$row["user_city"]; ?></span>
                         </div>
                         <div class="follow">
                         <button  class="btn btn-primary" data-toggle="modal" data-target="#mymsg" > 
                         <i class="fa fa-envelope fa-lg"></i></button>

                            <div id="mymsg" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Message</h4>
                              </div>
                              <div class="modal-body " style=" color: #24afae; font-size:20px;">
                                <form class="formlog" role="form"  method="POST" action="message.php" >
             <input type="text" class="form-control" name="sender" hidden value="<?php echo $sender; ?>">
              <input type="text" class="form-control" name="to" hidden value="<?php echo $row["user_name"];?>">
               <div class="input-group">
                  <span class="input-group-addon">   <i class="fa fa-envelope fa-lg"></i></span>

                  <input type="text" class="form-control" placeholder="Your message" name="message" required>
              </div><br>

              
              <div class="form-group" style=;">
                  <input type="submit" class="btn btn-primary " value="send" name="" style="font-size:15px;width:65px"> 
               </div>
                 </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal" style=" background: #24afae; ">Close</button>
                              </div>
                            </div>

                          </div>
                        </div>
                          
                         </div>
                     </div>
                    
                 <div class="info">
                   
                      <h6 class="afh">About </h6>
                      <ul class="list-unstyled">
       <li>  <i class="fa fa-user fa-fw"></i> gender <a href="#"><?php echo  $row["user_gender"];?></a></li>
         <li> <i class="fa fa-mortar-board fa-fw"></i> studied at <a href="#"><?php echo  $row["studied"];?></a></li>
        <li> <i class="fa fa-home fa-fw"></i> Lives in <a href="#"><?php echo  $row["user_city"];?></a></li>
        <li> <i class="fa fa-map-marker fa-fw"></i> From <a href="#"><?php echo  $row["user_country"];?></a> </li>
         <li> <i class="fa fa-envelope fa-fw "></i> email <a href="#"><?php echo  $row["user_email"];?></a></li>
                       </ul>
                  </div>

   
                  </div>















                  <div class="col-sm-8 post">
            

            
  <!--************************ php post************************-->
                    <?php
                   
                        $posted_by=$row["user_name"];
                     $sql = "SELECT * FROM `post` WHERE post_by='$posted_by' ORDER BY post_id DESC  ";
                  
                    $result = $conn->query($sql);
                 
                       if ($result->num_rows > 0) {
                          while($row = $result->fetch_assoc()) {
              echo '<div class="post_p">';
                   echo '<div class="by">';
                    echo'<a href="#"><img alt="Image" src="'.$path2.$row["avatar_user"].'" > '.$row["post_by"].'</a>';
                   
                 echo '</div>';
                 echo '<div class="media text-left">';
                    echo '<div class="media-body">';
                      echo '<h3> '.$row["post_title"].'</h4>';
                      echo ' <p class="text-capitalize">'.$row["post_desc"].'</p>';
                      echo '<img alt="Image" src="'.$path.$row["post_img"].'"  class="img-responsive" > ';
                    echo ' </div>';
                echo ' </div>';
                echo ' <div class="like text-right">';
                 
                  
                   echo ' <span class=" b">'. $row["post_date"].'/'.$row["post_time"].'</span><br>';
                echo ' </div>';
             echo '</div>';
                               }
                       }else{
                        echo '<div class="post_p">';
                           echo"Not Found Any Post";
                        echo '</div>';
                      }
                    ?>
                      
                      
                           
                           
                          
                            
                          
                      
                      
                          
                         
                      
                  

 <!--************************ php post************************-->

                  </div>
               
                </div>
                

              </section>


              <footer class="footer text-center  text-capitalize" style="margin-top:19px;">


  &copy; <?php echo date("Y");?> <span>photo</span> Zoom  . All Rights Reserved | Design by max
</footer>


   <!-- Modal -->


       <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.nicescroll.min.js"></script>
      <script src="js/script.js"></script>
  </body>
</html>