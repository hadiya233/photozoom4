
<?php 
session_start();

    include_once("conn.php");
   $posted_by= $_SESSION["username"] ;
    $avatar_user=$_SESSION["useravatar"];
 

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
    <title>adminprofile</title>
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
      <a class="navbar-brand" href="dashboard.php"> <span>Dashboard</span></a>
    </div>
    <div class="collapse navbar-collapse navbar-right navbar-hover" id="myNavbar">
        
     
        
   
      <ul class="nav navbar-nav navbar-right">
        <li class="active z"><a href="adminprofile.php" style="height: 50px;"><img style="
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
                         <div class="background" style="background-image: url('<?php
                          if(isset( $_SESSION['userbackground'])){echo $path3.$_SESSION['userbackground'];}
                                     else {echo $path3.'def.jpg';}?>');">
                         <div class="pro ">
                           <a href="#"><img alt="Aaron Cunningham" src="<?php echo $path2.$_SESSION['useravatar'];?>" class="avatar "></a>
                         </div>
                         <div class="about text-center">
                           <h3><?php echo   $_SESSION["userfullname"];?></h3>
                         </div>
                        </div>
                     </div>

                <div class="row">
                  <div class="col-sm-4 side col-sm-offset-2 ">
                   <div class="user_profile text-center">
                        
                       
                         <div class="about text-center"  style="color:#345;">
                          <h3><?php echo  $_SESSION["username"];?></h3>
                           <h5><?php echo $_SESSION["userspecialty"];?> </h5>
                           <span> <i class="fa fa-map-marker fa-fw"></i><?php echo $_SESSION["usercountry"];
                           echo ' , '.$_SESSION["usercity"]; ?></span>
                         </div>
                         <div class="follow">
                    
                         </div>
                         </div>
                    
           
              
                  </div>

   <div class="col-sm-4 side ">
                  
                    
                 <div class="info">
                   
                      <h6 class="afh">About · <a href="#" data-toggle="modal" data-target="#update" ><i class="fa fa-pencil fa-fw"></i> Edit</a></h6>
                      <ul class="list-unstyled">
       <li>  <i class="fa fa-user fa-fw"></i> gender <a href="#"><?php echo   $_SESSION["usergender"];?></a></li>
         <li> <i class="fa fa-mortar-board fa-fw"></i> studied at <a href="#"><?php echo   $_SESSION["userstudy"];?></a></li>
        <li> <i class="fa fa-home fa-fw"></i> Lives in <a href="#"><?php echo   $_SESSION["usercity"];?></a></li>
        <li> <i class="fa fa-map-marker fa-fw"></i> From <a href="#"><?php echo   $_SESSION["usercountry"];?></a> </li>
        <li> <i class="fa fa-phone fa-fw"></i> mobile  <a href="#"><?php echo   $_SESSION["userphone"];?></a></li>
         <li> <i class="fa fa-envelope fa-fw "></i> email <a href="#"><?php echo   $_SESSION["useremail"];?></a></li>
                       </ul>
                  </div>

              
                  </div>













                
                </div>
                

              </section>




<div id="update" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                          <?php
                          $user= $_SESSION["username"];
                              $sql = "SELECT * FROM users where user_name='$user'";
                                  $result = $conn->query($sql);

                       
                             $row = $result->fetch_assoc();
                 
                 $row["user_name"]; 
               
              
                  
              ;
                
                   
                  
                  
                             
                             
                          ?>

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">up date your data</h4>
                              </div>
                              <div class="modal-body " style=" color: #24afae; font-size:20px;">
                                <form class="formlog" role="form"  method="POST" action="update.php" enctype="multipart/form-data">
                <div class="input-group ">
                    <span class="input-group-addon">profile image</span>
                     <input type="file" id="inputfile" name="img" required >
                </div><br>

               <div class="input-group">
                  <span class="input-group-addon">backgroung image</span>
                 <input type="file" id="inputfile" name="backgroung" required>
              </div><br>
                  <div class="input-group ">
                    <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                     <input type="text" class="form-control" placeholder="Full Name" name="full_name" required
                     value="<?php echo $row["user_full_name"];?>">
                </div><br>
            

               <div class="input-group">
                  <span class="input-group-addon">  <i class="fa fa-envelope fa-fw"></i></span>
                  <input type="email" class="form-control" placeholder="Email" name="email" required
                  value="<?php echo   $row["user_email"];?>">
              </div><br>
              <div class="input-group">
                  <span class="input-group-addon">  <i class="fa fa-phone fa-fw"></i></span>
                  <input type="number" class="form-control" placeholder="phone" name="phone" required
                  value="<?php echo $row["user_phone"]; ?>">
              </div><br>

            
         
                  <div class="input-group">
                  <span class="input-group-addon">  <i class="fa fa-home fa-fw"></i></span>
                                 
                  <select class="form-control" name="from" required="">

                  <?php
                  $country=$row["user_country"];
                  $list=array('sudan','USA','india','egypt','KSA');
                  for ($i=0; $i<count($list); $i++) { 
                           if($country==$list[$i]){
                             echo '<option value="'.$list[$i].'" selected>'.$list[$i].'</option>';
                           }else{

                           echo '<option value="'.$list[$i].'" >'.$list[$i].'</option>';
                  } 
                }



                  ?>
             
                  </select>
              </div><br>
                  <div class="input-group">
                  <span class="input-group-addon">  <i class="fa fa-map-marker fa-fw"></i></span>
                  <input type="text" class="form-control" placeholder="live in(city)" name="live_in" required
                  value="<?php echo   $row["user_city"];?>">
              </div><br>
                <div class="input-group">
                  <span class="input-group-addon"> <i class="fa fa-mortar-board fa-fw"></i></span>
                  <input type="text" class="form-control" placeholder="studied at" name="studied" required 
                  value="<?php echo   $row["studied"];?>">
              </div><br>
               <div class="input-group">
                  <span class="input-group-addon">  <i class="fa fa-briefcase fa-fw"></i></span>
                  <input type="text" class="form-control" placeholder="Your specialty" name="specialty" required 
                   value="<?php echo   $row["specialty"];?>">
              </div>
            <br>

              <br>
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
                        </div>'



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