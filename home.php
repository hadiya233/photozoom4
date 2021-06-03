
<?php 
session_start();

        $avatar_user=$_SESSION["useravatar"];
        $posted_by= $_SESSION["username"] ;
    include_once("conn.php");
       
   if($_SERVER['REQUEST_METHOD']=='POST'){

          //$posted_by=$_SESSION["username"] ;
         
          $title= filter_var($_POST['title'],FILTER_SANITIZE_STRING);
          $desc=  filter_var($_POST['desc'],FILTER_SANITIZE_STRING);
           $category=$_POST['category'];
          
          $date=date("Y-m-d");
          $time= date("h:i:sa");


           $img_name= $_FILES['img']['name']; 
           $img_size=$_FILES['img']['size']; 
           $img_tmp=$_FILES['img']['tmp_name']; 
           $img_type=$_FILES['img']['type'];
            
         //allow type of img
          $img_allow_extention= array('jpeg','jpg','png','gif');

          $imgextention= strtolower(end(explode('.', $img_name))); 

        
         $model;
         $form_error= array();
         if ( ! in_array( $imgextention,  $img_allow_extention)) {
         $form_error[]='This extention of image Not<strong> allowed</strong>';
         }

         if ($img_size>9999999) {
           $form_error[]='The Size of  image is to<strong> big</strong>';
         }

         $img_post='post'.'_'.$date.'_'.rand(0,100000).'_'.$img_name;
         move_uploaded_file($img_tmp, "img/post/".$img_post);

          if(empty($form_error)){

            $sql="insert into post (post_by,post_title,post_desc,post_img, post_date,post_time,post_category,avatar_user)values('$posted_by','$title','$desc','$img_post','$date','$time','$category','$avatar_user')";

            if ($conn->query($sql) === TRUE) {

             } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
              }
               $title='';
               $desc   ='';   
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
    <title>home</title>
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
        <li class="active z"><a href="home.php">Home</a></li>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="messages.php">Messages</a></li> 
        
      </ul>
        
        <form method="GET" 
 action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="navbar-form navbar-left" role="search" >
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
                <div class="row">
                  <div class="col-sm-4 side ">
                     <div class="user_profile text-center">
                         <div class="background" style="background-image: url('<?php
                          if(isset( $_SESSION['userbackground'])){echo $path3.$_SESSION['userbackground'];}
                                     else {echo $path3.'def.jpg';}?>');"></div>
                         <div class="pro ">
                           <a href="profile.php"><img alt="Aaron Cunningham" src="<?php if(isset( $_SESSION['useravatar'])){echo $path2.$_SESSION['useravatar'];}
        else {echo $path2.'de.png';}?>" class="avatar "></a>
                         </div>
                         <div class="about text-center"  style="color:#345;">
                           <h3><?php echo   $_SESSION["userfullname"];?></h3>
                           <h5><?php echo   $_SESSION["userspecialty"];?> </h5>
                           <span> <i class="fa fa-map-marker fa-fw"></i><?php echo   $_SESSION["usercountry"];
                           echo ' , '. $_SESSION["usercity"]; ?></span>
                         </div>
                         <div class="follow">
                         <a href="#"><button  class="btn btn-primary " > <i class="fa fa-envelope fa-lg"></i></button></a>
                          
                         </div>
                     </div>


                    
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

               <div class="recent">
<?php
$sql = "SELECT * FROM `post`  ORDER BY post_id DESC LIMIT 4" ;
              $result = $conn->query($sql);
              $recent= array();
               $recentuser= array();
                $recentname= array();
              $rec;

       if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $recent[]= $row["post_img"];
        $recentuser[]= $row["post_by"];
     


    }
} else {
    $rec= "default.jpg";
     
}
?>
                               
                                    <div class="div1">
                                        Recent photos
                                    </div>
                                   
                                
                                <div class="row">
                                    <div class="col-sm-4">
    <img alt="Image" src="img/post/<?php if(isset($recent[0])){echo$recent[0];}else{echo $rec;}  ?>" 
                                         class="img-responsive" data-toggle="modal" data-target="#myModal" ><br>
    <img alt="Image" src="img/post/<?php if(isset($recent[1])){echo$recent[1];}else{echo $rec;}  ?>"  
                                         class="img-responsive" data-toggle="modal" data-target="#myModal2" >
                                    </div>
                                     <div class="col-sm-8">
    <img alt="Image" src="img/post/<?php if(isset($recent[2])){echo$recent[2];}else{echo $rec;}  ?>"  
                                         class="img-responsive" data-toggle="modal" data-target="#myModal3"  >
                                      
                                    </div>
                                     </div>
                                      <div class="col" >
    <img alt="Image" src="img/post/<?php if(isset($recent[3])){echo$recent[3];}else{echo $rec;}  ?>"  
                                         class="img-responsive" data-toggle="modal" data-target="#myModal4" >
                                    </div>


               
                  



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><a href="dir_to_profile.php?user=<?php echo$recentuser[0];?>"> <?php echo $recentuser[0];?></a></h4>
      </div>
      <div class="modal-body">
        <img alt="Image" src="img/post/<?php if(isset($recent[0])){echo$recent[0];}else{echo $rec;}  ?>" 
           class="img-responsive" style="width:100%; height:400px; " >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal2 -->
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title"><a href="dir_to_profile.php?user=<?php echo$recentuser[1];?>"> <?php echo $recentuser[1];?></a></h4>
      </div>
      <div class="modal-body">
        <img alt="Image" src="img/post/<?php if(isset($recent[1])){echo$recent[1];}else{echo $rec;}  ?>" 
           class="img-responsive" style="width:100%; height:400px; " >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal3 -->
<div id="myModal3" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title"><a href="dir_to_profile.php?user=<?php echo$recentuser[2];?>"> <?php echo $recentuser[2];?></a></h4>
      </div>
      <div class="modal-body">
        <img alt="Image" src="img/post/<?php if(isset($recent[2])){echo$recent[2];}else{echo $rec;}  ?>"
           class="img-responsive" style="width:100%; height:400px; " >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal4 -->
<div id="myModal4" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title"><a href="dir_to_profile.php?user=<?php echo$recentuser[3];?>"> <?php echo $recentuser[3];?></a></h4>
      </div>
      <div class="modal-body">
        <img alt="Image" src="img/post/<?php if(isset($recent[3])){echo$recent[3];}else{echo $rec;}  ?>"
           class="img-responsive" style="width:100%; height:400px; " >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

</div>

   <div class="pepole">
                                        pepole
                                    </div>               
                                           

<div class="msg">
                  <?php          
    $sql5="SELECT user_name, user_avatar,specialty ,user_status,last_seen  FROM `users` WHERE user_name NOT LIKE '$posted_by' ORDER BY date_reg DESC LIMIT 10 ";
                $result5 = $conn->query($sql5);
                if ($result5->num_rows > 0) {
                  while($row5 = $result5->fetch_assoc()) {
                $imgchat= $row5['user_avatar'];
                 $lastseen= $row5['last_seen'];
                 $userstatus= $row5['user_status'];
                 $u_sp= $row5['specialty'];
                 $u_name= $row5['user_name'];

                


                    echo '<a href="other_profile.php?user='.$u_name.'" class="list-group-item list-group-item-action item">';
                            echo '<div class="media">';
                                echo  '<img alt="Image" src="'.$path2.$imgchat.'" class="avatar">';
                                  echo '<div class="media-body d-none d-lg-block ml-2">';
                                  echo'<h6 class="mb-0">'.$u_name;
                                 
                                  if($userstatus=='online'){
                                  echo ' <span class="badge  on" style="padding: 5px;background-color: #52C91E;"> </span>';  
                                 }else{
                                   echo '<span class="badge  off" style="padding: 5px;background-color:E#A8ABA7;"> </span>';
                                 }
                                   echo  '</h6>'; 
                                   echo  ' <span class="text-muted text-small ">'.$u_sp.'</span>';
                             echo  '</div></div></a>';


                  }

                }else{
  echo '<a href="#" class="list-group-item list-group-item-action item">
                                    <div class="media">
                                <span class="text-muted text-small ">not found any pepole</span>
                                    </div>
                                </a>';

                }
              







?>
                              
                                

                              
                     
                  
         
               </div>

                  </div>















                  <div class="col-sm-6 post">
                     <div class="post2">

<form class="form-inline" role="form" method="POST" 
 action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                       <div class="btn btn-primary b">
                              <div class="form-group">
                              <label class="sr-only" for="inputfile">File input</label>
                              <input type="file" id="inputfile" name="img" required>
                              </div>
                              </div>
                              <div class="form-group">
                              <label class="sr-only" for="name">Name</label>
                              <input type="text" class="form-control" id="name"
                               placeholder="title" name="title" required>
                              </div>
                                  <div class="form-group">
                              <label class="sr-only" for="name">Name</label>
                              <input type="text" class="form-control" id="name"
                               placeholder="describtion" name="desc">
                              </div>
                            
                                 <div class="input-group">
                   <label class="sr-only" for="name">Name</label>
                                 
                  <select class="form-control" name="category" required>
                  <option value="general">General Photography</option>
                  <option value="marriage">Marriage Photography</option>
                  <option value="birthday">Birthday Photography</option>
                  <option value="wild">Wild Photography</option>
                  <option value="fashion">Fashion Photography</option>
                  <option value="events">Events Photography</option>
                   <option value="personal">Personal Photography</option>
                    <option value="family">  Family Photography</option>
                  
                  </select>
              </div><br>
                              <button type="submit" class="btn btn-default btn-block">Post</button>
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

                     </div>

            
  <!--************************ php post************************-->
                    <?php
                   
                       if (isset($_GET['cat'])) {
                         $cat=$_GET['cat'];
                          $sql = "SELECT * FROM `post` WHERE post_category='$cat' ORDER BY post_id DESC  ";
                          unset($cat);
                       }else if (isset($_GET['search'])) {
                        $sear=$_GET['search'];
                          $sql = "SELECT * FROM `post` WHERE post_category LIKE '%$sear%' or post_by LIKE '%$sear%' or post_title LIKE '%$sear%' or post_desc LIKE '%$sear%'  ORDER BY post_id DESC  ";

                       }else{
                     $sql = "SELECT * FROM `post` ORDER BY post_id DESC  ";
                       }
                    $result = $conn->query($sql);
                 
                       if ($result->num_rows > 0) {
                          while($row = $result->fetch_assoc()) {
              echo '<div class="post_p">';
                   echo '<div class="by">';
                     echo '<a href="dir_to_profile.php?user='.$row["post_by"].'"><img alt="Image" src="'.$path2.$row["avatar_user"].'" > '.$row["post_by"].'</a>';
                     if($posted_by==$row["post_by"]){
                     echo'<a href="delete_post.php?id_post='.$row["post_id"].'"> <i class="fa fa-times fa-fw fa-lg"></i></a>';
                     }
                 echo '</div>';
                 echo '<div class="media text-left">';
                    echo '<div class="media-body">';
                      echo '<h3> '.$row["post_title"].'</h4>';
                      echo ' <p class="text-capitalize">'.$row["post_desc"].'</p>';
                      echo '<img alt="Image" src="'.$path.$row["post_img"].'"  class="img-responsive" 
                      data-toggle="modal" data-target="o'.$row["post_id"].'"> ';
                    echo ' </div>';
                echo ' </div>';
                echo ' <div class="like text-right">';
                 
                  
                   echo ' <span class=" b">'. $row["post_date"].'/'.$row["post_time"].'</span><br>';
                echo ' </div>';
             echo '</div>';
                      
 // <!-- Modal -->
     echo '<div id="o'.$row["post_id"].'" class="modal fade" role="dialog">
  <div class="modal-dialog">


    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <img alt="Image" src="img/post/<?php if(isset($recent[0])){echo$recent[0];}else{echo $rec;}  ?>" 
           class="img-responsive" style="width:100%; height:400px; " >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>';





                               }
                       }else{
                        echo '<div class="post_p">';
                           echo"Not Found Any News";
                        echo '</div>';
                      }
                    ?>
                      
                      
                           
                           
                          
                            
                          
                      
                      
                          
                         
                      
                  

 <!--************************ php post************************-->

                  </div>
                  <div class="col-sm-2 cat">
                    
                    <div class="h1">categories</div>
                   <div class="cat2">
                                <a href="home.php" class="nav-link ">All</a><br>
                                <a href="home.php?cat=Personal" class="nav-link">Personal Photography</a><br>
                                <a href="home.php?cat=Marriage" class="nav-link">Marriage Photography</a><br>
                                <a href="home.php?cat=Birthday" class="nav-link">Birthday Photography</a><br>
                                <a href="home.php?cat=Wild" class="nav-link">Wild Photography</a><br>
                                <a href="home.php?cat=Fashion" class="nav-link">Fashion Photography</a><br>
                                <a href="home.php?cat=cat=Family" class="nav-link">Family Photography</a><br>
                                <a href="home.php?cat=Events" class="nav-link">Events Photography</a><br>
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


  &copy; <?php echo date("Y").$avatar_user;?> <span>photo</span> Zoom  . All Rights Reserved | Design by max
</footer>


   <!-- Modal -->


       <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.nicescroll.min.js"></script>
      <script src="js/script.js"></script>
  </body>
</html>