

<?php 
session_start();
    include_once("conn.php");

   if($_SERVER['REQUEST_METHOD']=='POST'){

        $username= filter_var($_POST['name'],FILTER_SANITIZE_STRING);
        $email=    filter_var($_POST['email'] ,FILTER_SANITIZE_EMAIL);
        $phone=    filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
        $message=     filter_var($_POST['message'],FILTER_SANITIZE_STRING);
        $message_date=date("Y-m-d h:i:sa");
        $type_user;
       if (isset( $_SESSION["type_user"] )) {
         $type_user=$_SESSION["type_user"];
       }else{
        $type_user="visoter";
       }
   
      
       

         $model;
         $form_error= array();


         if(strlen($username)<=2){
          $form_error[]='name Must be large than <strong>2</strong>Characters';
         } 

          if(strlen($email)<=10){
          $form_error[]='email Must be large than<strong>10</strong>Characters';
         }
          if(strlen($phone)<=9){
          $form_error[]='phone Must be large than <strong>10</strong>Characters';
         } 

          if(strlen($message)<=15){
          $form_error[]='message Must be large than<strong>15</strong>Characters';
         }

         
          if(empty($form_error)){

            $sql="insert into contact (user_name,user_email,user_phone,message, message_date,user_type)values('$username','$email','$phone','$message','$message_date','$type_user')";

            if ($conn->query($sql) === TRUE) {
              $succ;
               $succ= "Your message send successfully";
             } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
              }
          

               $username='';
               $phone   ='';   
               $email   =''; 
               $message ='';


               $success='<div class="alert alert-success">'.$succ.'</div>';
               $model='<div id="myModal" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"></h4>
                              </div>
                              <div class="modal-body " style=" color: #24afae; font-size:20px;">
                                <p>Your message send successfully.</p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal" style=" background: #24afae; ">Close</button>
                              </div>
                            </div>

                          </div>
                        </div>
                        ';

          }

 
   }

?>

<!DOCTYPE html>
<html >
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>photo zoom</title>
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
        <li class="active "><a href="index.php">Home</a></li>
       
        <li class="Service" ><a href="#">Services</a></li> 
         <li class="Contact"><a href="#">Contact</a></li> 
        
      </ul>
   
      <ul class="nav navbar-nav navbar-right">
        <li ><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        
      </ul>
    </div>
  </div>
</nav>
      
 <!-- Init Skitter -->
 <div class="container-fluid m">
<div id="myCarousel" class="carousel slide" data-ride="carousel">

  <ol class="carousel-indicators  hidden-xs">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
   
  </ol>


  <div class="carousel-inner text-center" role="listbox" style="opacity:.8:">

    <div class="item active">
      <img src="img/banner1.jpg" class="img-responsive" alt="Chania">
      <div class="carousel-caption  hidden-xs ">
      <div class="captions hidden-xs">
        <h3>Nature Photography</h3>
         <h4>Your image is our focus</h4>
             <a href="login.php"> <button class="btn ">GET READY</button></a>
      </div>
      </div>
    </div>

    <div class="item">
      <img src="img/bnner2.jpg" alt="Chania">
      <div class="carousel-caption">
        <div class="captions hidden-xs">
        <h3 class="text-capitalize">Photo Gallery</h3>
         <h4 class="text-capitalize">Professional Photographer</h4>
               <a href="login.php"> <button class="btn ">GET READY</button></a>
      </div>
      </div>

    </div>

  

    <div class="item ">
      <img src="img/banner4.jpg" alt="Flower">
      <div class="carousel-caption">
        <div class="captions hidden-xs">
        <h3 class="text-capitalize">everything is great</h3>
         <h4 class="text-capitalize">Great Photo Great Price Great service </h4>
         <a href="login.php"> <button class="btn ">GET READY</button></a>
      </div>
      </div>
  
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>


<section id="Contact" class="container con text-center" style="   padding-top: 20px;padding-bottom: 20px;">
   <a name="contact"> </a>
     
     <i class="fa fa-headphones fa-4x" ></i>
      <h1 class="capitalize"> contact us</h1>
       <h1 class="capitalize"> tell us what you fell</h1>
       <p class="lead"> feel free to contact anything</p>
           <form role='form'  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                 <div class="input-group">
                       <span class="input-group-addon"> <i class="fa fa-user fa-fw"></i></span>
                       <input type="text" class="form-control" placeholder="Your Name" name="name" required  
                       value="<?php if(isset($username))echo $username;?>">
                       <span class="astrisx">*</span>
                 </div><br>
                 <div class="input-group">
                       <span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
                       <input type="email" class="form-control" placeholder="Your Email" name="email" required
                        value="<?php if(isset($email))echo $email;?>">
                       <span class="astrisx">*</span>
                 </div><br>
             
                 <div class="input-group">
                       <span class="input-group-addon"> <i class="fa fa-phone fa-fw"></i></span>
                       <input type="number" class="form-control" placeholder="Mobile Phone" name="phone" required
                        value="<?php if(isset($phone))echo $phone;?>">
                       <span class="astrisx">*</span>
                 </div><br>
             
                 <div class="form-group "> 
                      <textarea type="text" class="form-control" name="message" required> <?php if(isset($message)){echo $message;}else{echo "Your Message ";} ?></textarea>
                 </div>
                 <div class="form-group">
                     <input type="submit" class="btn btn-primary btn-block sent" value="sent" name="send" > 
                 </div>
   
           </form>

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



<!-- Modal -->
<?php
  if (isset($model)) {
   echo   $model;
}

?>


 </section>

<section id="ssss" class="container-fiuld our text-center">
<a name="service"> </a>
   <div class="cover">
     <div class="container text-center">
    
       <div class="row">
         <div class="col-md-4">
           <div>
             <img class="img-thumbnail img-responsive" src="img/c1.jpg">
           </div>
         </div>

         <div class="col-md-4">
           <div>
             <h2 >Our Abilities</h2> 

     <p class="lead" >Established initially as a Photography agency we've evolved and grown to become 
      the full service digital creative house that we are today.
     From local business Photography to complex Photography,
      we approach every project with the same focus on the core principles of digital: design, performance and .

      This approach is what we refer to as "Digital Goodness" and it is driven by our team,
       which has grown to include experts in every area of digital. We're at home tackling 
       new and complex projects, working with cutting edge technologies and embracing modern trends.
        Our experience ensures we can be confident that
         the solutions we produce will deliver for our clients.</p>
           </div>
         </div>
               <div class="col-md-4">
                <h1 > services</h1>
           <div class="s"><h1 class="t"> <i class="fa fa-camera"></i> Birthday Photography</h1> </div>
           <div class="s"><h1 class="t"> <i class="fa fa-camera"></i> Marriage Photography</h1> </div>
           <div class="s"><h1 class="t"> <i class="fa fa-camera"></i> Events Photography</h1> </div>
           <div class="s"><h1 class="t"> <i class="fa fa-camera"></i> Personal Photography</h1> </div>
            <div class="s"><h1 class="t"> <i class="fa fa-camera"></i> Personal Photography</h1> </div>
         </div>
       </div>

     </div>
   </div>


</section>

<footer class="footer text-center  text-capitalize">


  &copy; <?php echo date("Y");?> <span>photo</span> Zoom  . All Rights Reserved | Design by max
</footer>

 <section class="ccover">
    <h1></h1>
 </section>
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.nicescroll.min.js"></script>
      <script src="js/js.js"></script>

      <script>
$(function () {

   $('#myModal').modal('show')
});
</script>
  </body>
</html>