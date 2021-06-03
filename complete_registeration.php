

<!DOCTYPE html>
<html >
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>sign up</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/font-awesome.min.css" >
    <link rel="stylesheet" href="css/stylecss.css" >
  <style>
     
      </style>
    <!--[if lt IE 9]>
      <script src="js/html5shiv-3.6.2.jar"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>


<?php 
       session_start();
    include_once("conn.php");
     $form_error;
         $message;
         $message2;

   if($_SERVER['REQUEST_METHOD']=='POST'){

           $username = $_SESSION["user_name"];
           $hash_pass= $_SESSION["user_pass"];

          $study= filter_var($_POST['studied'],FILTER_SANITIZE_STRING);
          $special=    filter_var($_POST['specialty'] ,FILTER_SANITIZE_STRING);


       

    
           $img_name= $_FILES['img']['name']; 
           $img_size=$_FILES['img']['size']; 
           $img_tmp=$_FILES['img']['tmp_name']; 
           $img_type=$_FILES['img']['type'];

            $back_name= $_FILES['backgroung']['name']; 
           $back_size=$_FILES['backgroung']['size']; 
           $back_tmp=$_FILES['backgroung']['tmp_name']; 
           $back_type=$_FILES['backgroung']['type'];
            
         //allow type of img
          $img_allow_extention= array('jpeg','jpg','png','gif');

          $imgextention= strtolower(end(explode('.', $img_name))); 
          $backextention= strtolower(end(explode('.', $back_name))); 

        
     
        
         if ( ! in_array( $imgextention,  $img_allow_extention) and 
          ! in_array( $backextention,  $img_allow_extention)) {
         $form_error='This extention of image Not<strong> allowed</strong>';
         }

         $img_user='avatar'.'_'.'_'.rand(0,100000).'_'.$img_name;
         $back_user='backgroung'.'_'.'_'.rand(0,100000).'_'.$back_name;

         move_uploaded_file($img_tmp, "img/user_img/".$img_user);
         move_uploaded_file($back_tmp, "img/background/".$back_user);


          if(empty($form_error)){


         $sql = "UPDATE users SET specialty='$special' ,studied='$study' ,user_avatar='$img_user' ,user_background='$back_user' WHERE user_name='$username' and user_pass='$hash_pass'";
           
            if ($conn->query($sql) === TRUE) {
               
               $message=' Your Account Is Ready<a href="Login.php" style="color:#24afae;"> Login</a>';
             } else {
              $message2= "Error:bad coonnection " ;
              }
               
          }
  



        
     echo '<nav class="navbar navbar-inverse  ">
  <div class="container con">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="index.php"><i class="fa fa-camera"></i>  Photo <span>zoom</span></a>
    </div>
    <div class="collapse navbar-collapse navbar-right navbar-hover" id="myNavbar">
        
      <ul class="nav navbar-nav ">
        <li><a href="index.php">Home</a></li>
       
        
        
      </ul>
   
      <ul class="nav navbar-nav navbar-right">
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span>  Login</a></li>
        
      </ul>
    </div>
  </div>
</nav>';

echo '<section class="container-fliud login text-center" style="height:525px; background: url(\'img/banner3.jpg\');background-size: cover;">
   <div class="logo">
     <h2 class="h2">';
      
          if (isset($form_error)) {
       echo "something wrong we can\'t upload photo";
     }else if (isset($message)) {
       echo $message;
     }else if (isset($message2)){
      echo $message2;
     }
      
        

      echo ' 
     </h2>
   </div>              
        
   </section>  





<footer class="footer text-center  text-capitalize" style="margin-top:19px;">


  &copy; <?php echo date("Y");?> <span>photo</span> Zoom  . All Rights Reserved | Design by max
</footer>
';    


         

 
   }else{
    echo 'go back to <a href="index.php">home page </a>';
   }


?>








      
   
    

    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.nicescroll.min.js"></script>
      <script src="js/script.js"></script>
           <script>
$(function () {

   $('#myModal').modal('show')
});
</script>
  </body>
</html>