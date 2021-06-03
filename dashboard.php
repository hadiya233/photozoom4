
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
    
 if (isset($_GET['id'])) {
$id= $_GET['id'];

$sq="DELETE FROM `contact` WHERE `message_id` = $id";
$conn->query($sq) ;

}

               

?>

<!DOCTYPE html>
<html >
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" >
     <link rel="stylesheet" href="css/font-awesome.min.css" >
     <link rel="stylesheet" href="css/w3.css" >
    <link rel="stylesheet" href="css/home.css" >
  <style>
     body{
      background: #252830;
      color: white;
     }
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
      <a class="navbar-brand active" href="dashboard.php"><span>Dashboard</span></a>
    </div>
    <div class="collapse navbar-collapse navbar-right navbar-hover" id="myNavbar">
        
    
        
        
      <ul class="nav navbar-nav navbar-right">
        <li ><a href="adminprofile.php" style="height: 50px;"><img style="
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-top: -12px;" src="<?php echo $path2.$_SESSION['useravatar'];?>"> </a></li>
        <li><a href="session_destroy.php"><i class="fa fa-power-off fa-lg"></i> </a></li>
        
      </ul>
    </div>
  </div>
</nav>
              <section class="container dash">
              <div class="stat text-center text-uppercase">
             <h3 class="s">Quick stats</h3>
                </div>

              <div class="market-updates">
      <div class="col-md-3 market-update-gd">
        <div class="market-update-block clr-block-1">
          <div class="col-md-8 market-update-left">
            <h3>
            <?php
             $sql  = "SELECT * FROM `users`";

             $result = $conn->query($sql);
               echo $result->num_rows;
            ?>
              
            </h3>
            <h4>Registered User</h4>
             <p><hr></p>
          </div>
          <div class="col-md-3 market-update-right">
            <i class="fa fa-users fa-5x"> </i>
          </div>
          <div class="clearfix"> </div>
        </div>
      </div>
      <div class="col-md-3 market-update-gd">
        <div class="market-update-block clr-block-2">
         <div class="col-md-8 market-update-left">
          <h3>135</h3>
          <h4>Daily Visitors</h4>
          <p><hr></p>
          </div>
          <div class="col-md-3 market-update-right">
            <i class="fa fa-eye"> </i>
          </div>
          <div class="clearfix"> </div>
        </div>
      </div>


      <div class="col-md-3 market-update-gd">
        <div class="market-update-block clr-block-3">
          <div class="col-md-8 market-update-left">
            <h3>
           <?php
             $sql  = "SELECT * FROM `post`";

             $result = $conn->query($sql);
               echo $result->num_rows;
            ?>
            </h3>
            <h4>Uploaded Photo</h4>
             <p><hr></p>
          </div>
          <div class="col-md-3 market-update-right">
            <i class="fa fa-file-image-o fa-5x"> </i>
          </div>
          <div class="clearfix"> </div>
        </div>
      </div>

         <div class="col-md-3 market-update-gd">
        <div class="market-update-block clr-block-4">
          <div class="col-md-8 market-update-left">
            <h3><?php
             $sql  = "SELECT * FROM `contact`";

             $result = $conn->query($sql);
               echo $result->num_rows;
            ?></h3>
            <h4>New Messages</h4>
            <p><hr></p>
          </div>
          <div class="col-md-3 market-update-right">
            <i class="fa fa-comment fa-5x"> </i>
          </div>
          <div class="clearfix"> </div>
        </div>
      </div>

       <div class="clearfix"> </div>
    </div>
<div class="row">
   <div class="col-sm-8 ">
   <div class="user">
      <h2 class="text-center" style="color:white;">USERS</h2> 
        <div class="msg text-center">
                       <table class="table table-hover table-responsive">

                                <thead>
                                <tr  style="color:black; background:#1bc98e;">
                                <th>photo</th>
                                <th>Name</th>
                                <th>full name</th>
                                <th>email</th>
                                <th>Registered date</th>
                                </tr>
                                </thead>
                                <tbody>

                  <?php       
    $sql5="SELECT user_name, user_avatar,user_full_name ,user_email,date_reg  FROM `users` WHERE user_group!=1 ORDER BY date_reg DESC ";
                $result5 = $conn->query($sql5);
                if ($result5->num_rows > 0) {
                  while($row5 = $result5->fetch_assoc()) {
                $imgchat= $row5['user_avatar'];
                 $userfull_name= $row5['user_full_name'];
                 $useremail= $row5['user_email'];
                 $datereg= $row5['date_reg'];
                 $u_name= $row5['user_name'];
                    echo '<tr>';
                                  echo '<td><img alt="Image" src="'.$path2.$imgchat.'"></td>';
                                  echo '<td>'.$u_name.'</td>';
                                  echo'<td>'.$userfull_name.'</td>';
                                  echo '<td>'.$useremail.'</td>';
                                  echo'<td>'. $datereg.'</td>';   
                     echo  '</tr>';
                  }
                }
?>                         
                            </tbody>
                            </table>                        
                                               
                                      </div>           
                                              
         
                  </div>
                 </div>


                  <div class="col-sm-4 user">
                     <h2 class="text-center" style="color:white;">MESSAGES</h2> 
                     <div class="msg text-center">

                     <table class="table table-hover table-responsive">

                              <thead>
                              <tr  style="color:black; background:#1997c6;">
                              <th>Name</th>
                              <th>email</th>
                              <th>read</th>
                              <th> delete</th>
                              </tr>
                              </thead>
                              <tbody>

                  <?php    



    $sql5="SELECT *  FROM `contact`  ORDER BY message_date DESC ";
                $result5 = $conn->query($sql5);
                if ($result5->num_rows > 0) {
                  $x=0;
                  while($row = $result5->fetch_assoc()) {
               
                 $messagedate= $row['message_date'];
                 $useremail= $row['user_email'];
                 $mes= $row['message'];
                 $u_na= $row['user_name'];
                 $idm= $row['message_id'];

                  echo '<tr>';
                                  
                                  echo '<td>'.$u_na.'</td>';
                                  echo'<td>'.$useremail.'</td>';
                                  echo '<td><button  style="color:black; background:#1997c6;" 
                                  data-toggle="modal" data-target="#my'.$x.'"> <i class="fa fa-eye"></i></button></td>';
                                  echo'<td><button  style="color:red; background:#1997c6;"
                                   data-toggle="modal" data-target="#myd'.$x.'">
                                   <i class="fa fa-times fa-fw fa-lg" ></i></button></td>';   
                     echo  '</tr>';

          
        echo'  <!-- Modal -->
              <div id="my'.$x.'" class="modal fade" role="dialog" style="color:black;">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>';
       echo' <h4 class="modal-title">'.$u_na.'</h4>
      </div>';
     echo' <div class="modal-body">';
       echo' <p>'.$mes.'.</p>';
     echo' </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>';   
   
        echo'  <!-- Modal -->
              <div id="myd'.$x.'" class="modal fade" role="dialog" style="color:black;">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>';
       echo' <h4 class="modal-title">Are You Sure You Want To Delete This  message!</h4>
      </div>';
     echo' <div class="modal-body">';
       echo' <p><a href="dashboard.php?id='.$idm.'"><button  style="color:red; background:#1997c6;">Delete Anyway <i class="fa fa-times fa-fw fa-lg" ></i></button></a></p>';
     echo' </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>';                       
      

$x++;

                  }

                }


?>

</tbody>
</table>                        

                              
                     
                  
         
                  </div>
                 </div>
               </div>







              </section>
               

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