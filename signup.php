
<?php 
         session_start();
    include_once("conn.php");

   if($_SERVER['REQUEST_METHOD']=='POST'){

          $username= filter_var($_POST['name'],FILTER_SANITIZE_STRING);
          $email=    filter_var($_POST['email'] ,FILTER_SANITIZE_EMAIL);
          $phone=    filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
          $pass=     filter_var($_POST['pass'],FILTER_SANITIZE_STRING);
          $hash_pass=sha1($pass);
          $pass2=     filter_var($_POST['pass2'],FILTER_SANITIZE_STRING);
          $full_name=     filter_var($_POST['full_name'],FILTER_SANITIZE_STRING);
          
          $gender=$_POST['gender'];
          $from=$_POST['from'];
          $live_in=     filter_var($_POST['live_in'],FILTER_SANITIZE_STRING);
          $date_reg=date("Y-m-d h:i:sa");
        
         $model;
         $form_error= array();

         if(strlen($username)<=2){
          $form_error[]='username Must be large than <strong>2</strong> Characters';
         } 

          if(strlen($email)<=10){
          $form_error[]='email Must be large than<strong>10</strong> Characters';
         }
          if(strlen($phone)<=9){
          $form_error[]='phone Must be large than <strong>10</strong> Characters';
         } 

          if(strlen($pass)<=3){
          $form_error[]='password Must be large than<strong>3</strong> Characters';
         }elseif ($pass !=$pass2) {
            $form_error[]='password no\'t <strong> identical</strong>';
         }
           if(strlen($full_name)<=7){
          $form_error[]='full name Must be large than<strong>7</strong> Characters';
         }
          if(strlen($live_in)<=2){
          $form_error[]='the city Must be large than <strong>2</strong> Characters';
         } 

             //check username if exist
          $sql = "SELECT user_name FROM users where user_name='$username' ";
                $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $form_error[]='the username <strong>( '.$username.' )</strong> already exist';
    }
  //check email if exist
          $sql = "SELECT user_name FROM users where user_email='$email' ";
                $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $form_error[]='the email: <strong>( '.$email.' )</strong> already exist';
    }



         
          if(empty($form_error)){
            $_SESSION["user_name"] = $username;
            $_SESSION["user_pass"] = $hash_pass;

            $sql="insert into users (user_name,user_email,user_phone,user_pass, user_full_name,user_gender,user_country,user_city,date_reg)values('$username','$email','$phone','$hash_pass','$full_name','$gender','$from','$live_in','$date_reg')";

            if ($conn->query($sql) === TRUE) {
                 $model='<div id="myModal" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"></h4>
                              </div>
                              <div class="modal-body " style=" color: #24afae; font-size:20px;">
                                <form class="formlog" role="form"  method="POST" action="complete_registeration.php" enctype="multipart/form-data">
                <div class="input-group ">
                    <span class="input-group-addon">profile image</span>
                     <input type="file" id="inputfile" name="img" required>
                </div><br>

               <div class="input-group">
                  <span class="input-group-addon">backgroung image</span>
                 <input type="file" id="inputfile" name="backgroung" required>
              </div><br>
              <div class="input-group">
                  <span class="input-group-addon"> <i class="fa fa-mortar-board fa-fw"></i></span>
                  <input type="text" class="form-control" placeholder="studied at" name="studied" required>
              </div><br>
               <div class="input-group">
                  <span class="input-group-addon">  <i class="fa fa-briefcase fa-fw"></i></span>
                  <input type="text" class="form-control" placeholder="Your specialty" name="specialty" required>
              </div><br>

              
              <div class="form-group" style=;">
                  <input type="submit" class="btn btn-primary " value="Done" name="" style="font-size:15px;width:65px"> 
               </div>
                 </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal" style=" background: #24afae; ">Close</button>
                              </div>
                            </div>

                          </div>
                        </div>';
             } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
              }
          

               $username='';
               $phone   ='';   
               $email   =''; 
               $pass ='';
               $pass2 ='';
               $full_name='';
               $live_in   ='';   
             

              
         

          }

 
   }

?>
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
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span>  Login</a></li>
        
      </ul>
    </div>
  </div>
</nav>
      
   <section class="container-fliud login text-center" style="height:832px; background: url('img/71.jpg');background-size: cover;">
     <div class="log">

                         
               <div class="media text-left">
                    
                         <div class="media-body">
                           <h4> <i class="fa fa-unlock-alt media-object"></i>  Sign Up</h4>
                           <p class="text-capitalize">create free account </p>
                           </div>
                  </div>
           <form class="formlog" role="form"  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="input-group ">
                    <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                     <input type="text" class="form-control" placeholder="User Name" name="name" required
                     value="<?php if(isset($username))echo $username;?>">
                </div><br>

               <div class="input-group">
                  <span class="input-group-addon">  <i class="fa fa-envelope fa-fw"></i></span>
                  <input type="email" class="form-control" placeholder="Email" name="email" required
                  value="<?php if(isset($email))echo $email;?>">
              </div><br>
              <div class="input-group">
                  <span class="input-group-addon">  <i class="fa fa-phone fa-fw"></i></span>
                  <input type="number" class="form-control" placeholder="phone" name="phone" required
                  value="<?php if(isset($phone))echo $phone;?>">
              </div><br>

               <div class="input-group">
                  <span class="input-group-addon">  <i class="fa fa-key fa-fw"></i></span>
                  <input type="password" class="form-control" placeholder="PassWord" name="pass" required
                  value="<?php if(isset($pass))echo $pass;?>">
              </div><br>
               <div class="input-group">
                  <span class="input-group-addon">  <i class="fa fa-key fa-fw"></i></span>
                  <input type="password" class="form-control" placeholder="Repeat password" name="pass2" required
                  value="<?php if(isset($pass2))echo $pass2;?>">
              </div><br>

               <div class="input-group ">
                    <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                     <input type="text" class="form-control" placeholder="Full Name" name="full_name" required
                     value="<?php if(isset($full_name))echo $full_name;?>">
                </div><br>


              <div class="input-group">
                        <label for="inputPassword" class="col-sm-2 control-label">Gender</label>
                   <label class="checkbox-inline">
        
                  <input type="radio" name="gender" id="optionsRadios3" value="male" checked> Male 
                  </label>
                  <label class="checkbox-inline">
                  <input type="radio" name="gender" id="optionsRadios4" value="female"> Female 
                  </label>
              </div><br>
                  <div class="input-group">
                  <span class="input-group-addon">  <i class="fa fa-home fa-fw"></i></span>
                                 
                  <select class="form-control" name="from" required="">
                  <option value="sudan">sudan</option>
                  <option value="USA">USA</option>
                  <option value="india">india</option>
                  <option value="egypt">egypt</option>
                  <option value="KSA">KSA</option>
                  </select>
              </div><br>
                  <div class="input-group">
                  <span class="input-group-addon">  <i class="fa fa-map-marker fa-fw"></i></span>
                  <input type="text" class="form-control" placeholder="live in(city)" name="live_in" required
                  value="<?php if(isset($live_in))echo $live_in;?>">
              </div><br>
             
              
              <div class="form-group">
                  <input type="submit" class="btn btn-primary " value="signup" name="" style="font-size:15px;"> 
               </div>
                 </form>



  
               </div>
          
                             <?php  
                if(!empty($form_error)){
                  echo '<div class="alert alert-danger alert-dismssible" role="start">
                  <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true" >&times;</span>
                  </button>';  
                  
                         foreach ($form_error as $error) {
                        echo $error.'<br>';
                        
                        }
                     
                    echo '</div>';
                       
                        } 

              ?>    
                      
        
   </section>  


   <!-- Modal -->
<?php
  if (isset($model)) {
   echo   $model;
}

?> 


<footer class="footer text-center  text-capitalize" style="margin-top:19px;">


  &copy; <?php echo date("Y");?> <span>photo</span> Zoom  . All Rights Reserved | Design by max
</footer>


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