
<?php 
session_start();

    include_once("conn.php");
   $sender= $_SESSION["username"] ;
    $avatar_user=$_SESSION["useravatar"];
 
   if($_SERVER['REQUEST_METHOD']=='POST'){

          $message= filter_var($_POST['chatchat'],FILTER_SANITIZE_STRING);
          $to=$_POST['to'];
          $date=date("Y-m-d h:i:sa");


     $sql= "INSERT INTO `messages` ( `msg_from`, `msg_to`, `msg`, `msg_date`) VALUES ( '$sender', '$to', '$message', '$date')";


if ($conn->query($sql) === TRUE) {
   $message='';
 $to='';
} 
   }
   /***********************posted*******************/

   
 
  
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
    <title>messages</title>
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
        <li  class="active z"><a href="messages.php">Messages</a></li> 
        
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
              <section class="container msg">
               

                <div class="row">
                  <div class="col-sm-4 side ">
                  <div class="msg">
          <?php
            $user = array();
            $lastseen;
            $userstatus;
            $u_status;
            $u_lastseen;
            $u_img;
 $sql  = "SELECT  *  FROM `messages` WHERE msg_from='$sender' or msg_to='$sender' ORDER BY msg_date DESC";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                     $msgfrom=$row['msg_from'] ;
                      $msgto=$row['msg_to'] ;

                      if($msgto !=$sender){
                        $user[]=$msgto;
                      }
                       if($msgfrom !=$sender){
                        $user[]=$msgfrom;
                      }
              
              }

            }
                      $user=array_unique($user);
                      $user=implode(",", $user ) ;
                       $user= explode(",", $user);

                   
                if (count($user)>0) {
                 


       
      for ($i=0; $i <count($user) ; $i++) { 
      $sql="SELECT  msg  FROM `messages` WHERE msg_from='$user[$i]' or msg_to='$user[$i]' ORDER BY msg_date DESC LIMIT 1";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
               $mss= $row['msg'];

                $sql="SELECT  user_avatar,user_status,last_seen  FROM `users` WHERE user_name='$user[$i]' ";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                 $imgchat= $row['user_avatar'];
                 $lastseen= $row['last_seen'];
                 $userstatus= $row['user_status'];
            if($i==0){
               $u_status=$row['user_status'];
              $u_lastseen=$row['last_seen'];
              $u_img=$row['user_avatar'];
            }
              



                        echo '<a href="messages.php?chat='.$user[$i].'" class="list-group-item list-group-item-action item">';
                            echo '<div class="media">';
                                echo  '<img alt="Image" src="'.$path2.$imgchat.'" class="avatar">';
                                  echo '<div class="media-body d-none d-lg-block ml-2">';
                                  echo'<h6 class="mb-0">'.$user[$i];
                                 
                                  if($userstatus=='online'){
                                  echo ' <span class="badge  on" style="padding: 5px;background-color: #52C91E;"> </span>';  
                                 }else{
                                   echo '<span class="badge  off" style="padding: 5px;background-color:E#A8ABA7;"> </span>';
                                 }
                                   echo  '</h6>'; 
                                   echo  ' <span class="text-muted text-small ">'.$mss.'</span>';
                             echo  '</div></div></a>';
            }


   


          }else{

            echo '<a href="#" class="list-group-item list-group-item-action item">
                                    <div class="media">
                                <span class="text-muted text-small ">not found</span>
                                    </div>
                                </a>';


          }

   ?>

               </div>
       
                  </div>

                            
              
                     
                          
                   

   
                















                  <div class="col-sm-8 post">
            

            
  <!--************************ php chat************************-->
            <?php
            if(isset($_GET['chat'])){  /*************chat if ********/
                $userchat= $_GET['chat'];
              $sql="SELECT  user_avatar,user_status,last_seen  FROM `users` WHERE user_name='$userchat' ";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                 $imgchat= $row['user_avatar'];
                 $lastseen= $row['last_seen'];
                 $userstatus= $row['user_status'];

                 echo' <div href="#" class="list-group-item list-group-item-action item">
                                    <div class="media">
                                        <img alt="Image" src="'.$path2.$imgchat.'" class="avatar">
                                        <div class="media-body d-none d-lg-block ml-2">';
                        echo' <h6 class="mb-0">'.$userchat;

                                  if($userstatus=='online'){
                                  echo ' <span class="badge  on" style="padding: 5px;background-color: #52C91E;"> </span>';  
                                 }else{
                                   echo '<span class="badge  off" style="padding: 5px;background-color:E#A8ABA7;"> </span>';
                                 }

                                 echo '</h6>';
                              if($userstatus=='online'){
                                  echo '<span class="badge badge-indicator badge-success">online</span>';  
                                 }else{
                                  echo '<span class="badge badge-indicator badge-success">last seen '.$lastseen.'</span>';
                                 }


                                  echo  '</div>
                                    </div>
                                </div> ';     
                          

                          echo '<div class="msgbody ">';/*******msgbody******************/
 $sql  = "SELECT  *  FROM `messages` WHERE msg_from='$sender' and msg_to='$userchat'  or msg_from='$userchat' and msg_to='$sender' ORDER BY msg_date ";
     $result = $conn->query($sql);
          if ($result->num_rows > 0) {/*******if*************/
                  while($row = $result->fetch_assoc()) {/*******while*************/
                     $msgfrom=$row['msg_from'] ;
                      $msgto=$row['msg_to'] ;
                      $msgdate=$row['msg_date'] ;
                      $message=$row['msg'] ;

                    if($msgfrom !=$sender){
                                echo '<div class="justify-content-end bg-primary text-right him">
                                        <div class="card  text-white">';
                                                 echo $message;  
                                          echo '<div><small class="opacity-60">'.$msgdate.'</small></div>';
                                   echo' </div> </div>';
                      }else{
                       echo '<div class=" justify-content-end bg-primary text-right me">
                                        <div class="card  text-white">';
                                         echo $message;  
                                          echo '<div><small class="opacity-60">'.$msgdate.'</small></div>';
                                   echo' </div> </div>';

                            
                      }     
              }/*******while*************/
        }/********if***************/

        echo '</div>';/*******msgbody******************/


 
                    echo' <div class="send">';
      echo '<form class="bs-example bs-example-form" role="form" method="POST" action="messages.php">';
                            echo ' <div class="input-group">';
                               echo'<input type="text" class="form-control" name="to" style="display: none;"  value="'.$userchat.'">';
                                                                
                                   echo ' <input type="text" class="form-control sent" name="message">';
                                         echo'<span class="input-group-btn">';

                                            echo'<button class="btn btn-default" type="submit">
                                              <i class="fa fa-send fa-fw fa-lg"></i>
                                              </button>
                                              </span>
                                      </div>
                                   </form>
                              </div> ';  /*******send messages**********/            

               
                      
            }else{   /*************chat if ********/

                     echo' <div href="#" class="list-group-item list-group-item-action item">
                                    <div class="media">
                                       <img alt="Image" src="'.$path2.$u_img.'" class="avatar">
                                        <div class="media-body d-none d-lg-block ml-2">';
                        echo' <h6 class="mb-0">'.$user[0];

                                  if($u_status=='online'){
                                  echo ' <span class="badge  on" style="padding: 5px;background-color: #52C91E;"> </span>';  
                                 }else{
                                   echo '<span class="badge  off" style="padding: 5px;background-color:E#A8ABA7;"> </span>';
                                 }

                                 echo '</h6>';
                              if($u_status=='online'){
                                  echo '<span class="badge badge-indicator badge-success">online</span>';  
                                 }else{
                                  echo '<span class="badge badge-indicator badge-success">last seen '.$u_lastseen.'</span>';
                                 }


                                  echo  '</div>
                                    </div>
                                </div> '; 


                         echo '<div class="msgbody ">';/*******msgbody******************/
 $sql  = "SELECT  *  FROM `messages` WHERE msg_from='$sender' and msg_to='$user[0]'  or msg_from='$user[0]' and msg_to='$sender' ORDER BY msg_date ";
     $result = $conn->query($sql);
          if ($result->num_rows > 0) {/*******if*************/
                  while($row = $result->fetch_assoc()) {/*******while*************/
                     $msgfrom=$row['msg_from'] ;
                      $msgto=$row['msg_to'] ;
                      $msgdate=$row['msg_date'] ;
                      $message=$row['msg'] ;

                    if($msgfrom !=$sender){
                                echo '<div class="justify-content-end bg-primary text-right him">
                                        <div class="card  text-white">';
                                                 echo $message;  
                                          echo '<div><small class="opacity-60">'.$msgdate.'</small></div>';
                                   echo' </div> </div>';
                      }else{
                       echo '<div class=" justify-content-end bg-primary text-right me">
                                        <div class="card  text-white">';
                                         echo $message;  
                                          echo '<div><small class="opacity-60">'.$msgdate.'</small></div>';
                                   echo' </div> </div>';

                                  
                        }     
              }/*******while*************/
        }/********if***************/

    echo '</div>';/*******msgbody******************/

       
            
                    echo' <div class="send">';
      echo '<form class="bs-example bs-example-form" role="form" method="POST" action="messages.php">';
                            echo ' <div class="input-group">';
                               echo'<input type="text" class="form-control" name="to" style="display: none;"  value="'.$user[0].'">';
                                                                
                                   echo ' <input type="text" class="form-control sent" name="chatchat">';
                                         echo'<span class="input-group-btn">';

                                            echo'<button class="btn btn-default" type="submit">
                                              <i class="fa fa-send fa-fw fa-lg"></i>
                                              </button>
                                              </span>
                                      </div>
                                   </form>
                              </div> ';  /*******send messages**********/            




          }/***********else chat*********/

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