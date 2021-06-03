
<?php 
session_start();
    include_once("conn.php");

   if($_SERVER['REQUEST_METHOD']=='POST'){

                 $username= filter_var($_POST['name'],FILTER_SANITIZE_STRING);
                 $password= sha1(  filter_var($_POST['pass'],FILTER_SANITIZE_STRING));
               
        
    
      
                         

                            //check user if exist
                            $sql = "SELECT * FROM users where user_name='$username' and user_pass='$password' ";
                                  $result = $conn->query($sql);

                          if ($result->num_rows > 0) {
                             $row = $result->fetch_assoc();
                             $id=$row["user_id"]; 
                     $_SESSION["userid"]=$row["user_id"]; 
                     $_SESSION["username"]=$row["user_name"]; 
                     $_SESSION["useremail"]=$row["user_email"];
                     $_SESSION["userpass"]=$row["user_pass"];
                     $_SESSION["userphone"]=$row["user_phone"];
                     $_SESSION["userfullname"]=$row["user_full_name"];
                     $_SESSION["usergender"]=$row["user_gender"];
                     $_SESSION["usercountry"]=$row["user_country"];
                     $_SESSION["usercity"]=$row["user_city"];
                     $_SESSION["usergroup"]=$row["user_group"];
                     $_SESSION["userspecialty"]=$row["specialty"];
                     $_SESSION["userstudy"]=$row["studied"];
                     $_SESSION["date"]=$row["date_reg"];
                     $_SESSION["useravatar"]=$row["user_avatar"];
                     $_SESSION["userbackground"]=$row["user_background"];

                     if( $_SESSION["usergroup"]==0){
                         $sql = "UPDATE `users` SET `user_status` = 'online' WHERE `user_id` = $id";
                            $conn->query($sql);




                         header("location:home.php");
                     }else if( $_SESSION["usergroup"]==1){
                            header("location:dashboard.php");
                     }
                             
                             
                             

               
                              
                              
                              }else{
                                       $form_error;
                                    $form_error='username or password  Not corect';

                              }




      


 
   }

?>


<!DOCTYPE html>
<html >
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login</title>
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

<nav class="navbar navbar-inverse  ">
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
        <li class="active "><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        
      </ul>
    </div>
  </div>
</nav>
      
   <section class="container-fliud login text-center">
     <div class="log">

                          <span class="text-right"> Don't have an account?<a href="signup.php"> Sign Up</a></span>
               <div class="media text-left">
                    
                         <div class="media-body">
                           <h4> <i class="fa fa-unlock-alt media-object"></i>  Login</h4>
                           <p class="text-capitalize">users or Administrator </p>
                           </div>
                  </div>
           <form class="formlog" role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="input-group ">
                    <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                     <input type="text" class="form-control" placeholder="User Name" name="name" required>
                </div><br>
               <div class="input-group">
                  <span class="input-group-addon">  <i class="fa fa-key fa-fw"></i></span>
                  <input type="password" class="form-control" placeholder="PassWord" name="pass" required>
              </div><br>
               <span class="text-right text-muted"><a href="reset_password.php">Forgot Password?</a></span>
              <div class="form-group">
                  <input type="submit" class="btn btn-primary " value="login" > 
               </div>
           </form>

  
          </div>
          
                    
                                 <?php  
                                              if(!empty($form_error)){
                                                echo '<div class="alert alert-danger alert-dismssible" role="start">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                                  <span aria-hidden="true" >&times;</span>
                                                </button>';  
                                                
                                                       
                                                      echo  $form_error;
                                                        echo '</div>';
                                                     
                                                      } 

                             ?>   
       
        
   </section>   


<footer class="footer text-center  text-capitalize">


  &copy; <?php echo date("Y");?> <span>photo</span> Zoom  . All Rights Reserved | Design by max
</footer>


    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.nicescroll.min.js"></script>
      <script src="js/script.js"></script>
  </body>
</html>