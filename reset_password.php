
<?php 
session_start();
    include_once("conn.php");

   if($_SERVER['REQUEST_METHOD']=='POST'){

      
        $email=filter_var($_POST['email'] ,FILTER_SANITIZE_EMAIL);
    
      
       

         $model;
         $form_error= array();

          //check email if exist
          $sql = "SELECT user_id FROM users where user_email='$email' ";
                $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row

          $header="from : ".$email;
           $myemail="mahdi400@gmail.com";
           $subj="reset password";
        
           
             // mail($email, $subj, 'bb', $myemail) or die("n");

               $email   =''; 
              
               $model='<div id="myModal" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"></h4>
                              </div>
                              <div class="modal-body " style=" color: #24afae; font-size:20px;">
                                <p>check Your email to reset the password.</p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal" style=" background: #24afae; ">Close</button>
                              </div>
                            </div>

                          </div>
                        </div>
                        ';

      
             }else{

               $form_error[]='the email: <strong>( '.$email.' )</strong> No\'t exist';
             }





 
   }

?>

<!DOCTYPE html>
<html >
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Reset Password</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/font-awesome.min.css" >
    <link rel="stylesheet" href="css/style.css" >
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
        <li ><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        
      </ul>
    </div>
  </div>
</nav>
      
   <section class="container-fliud login text-center" style="  background: url('img/success4.jpg');background-size: cover;">
     <div class="log">

                         
               <div class="media text-left">
                    
                         <div class="media-body">
                           <h4> <i class="fa fa-unlock media-object"></i>  Reset Password</h4>
                           <p class="text-capitalize">Enter your email address and we'll send you an email with instructions to reset your password. </p>
                           </div>
                  </div>
           <form class="formlog" role="form"  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                  <div class="input-group">
                  <span class="input-group-addon">  <i class="fa fa-envelope fa-fw"></i></span>
                  <input type="email" class="form-control" placeholder="Email" name="email" required>
              </div><br>
              <div class="form-group">
                  <input type="submit" class="btn btn-primary " value="reset" > 
               </div>
           </form>

  
          </div>
          


      <?php  
                if(!empty($form_error)){
                  echo ' <div class="alert alert-danger alert-dismissable text-capitalize">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            <i class="fa fa-close fa-2x"></i>
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


<footer class="footer text-center  text-capitalize">
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