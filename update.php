
<?php 
session_start();

    include_once("conn.php");

   $username= $_SESSION["username"] ;
    $avatar_user=$_SESSION["useravatar"];
          $path2 ="img/user_img/";
        $path3 ="img/background/";
         $form_error;
   if($_SERVER['REQUEST_METHOD']=='POST'){

 
          $email=    filter_var($_POST['email'] ,FILTER_SANITIZE_EMAIL);
          $phone=    filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
          $full_name=     filter_var($_POST['full_name'],FILTER_SANITIZE_STRING);
          $from=$_POST['from'];
          $live_in=     filter_var($_POST['live_in'],FILTER_SANITIZE_STRING);
          $study= filter_var($_POST['studied'],FILTER_SANITIZE_STRING);
          $special=    filter_var($_POST['specialty'] ,FILTER_SANITIZE_STRING);

 //allow type of img
          $img_allow_extention= array('jpeg','jpg','png','gif');

            


           
            $img_name= $_FILES['img']['name']; 
           $img_size=$_FILES['img']['size']; 
           $img_tmp=$_FILES['img']['tmp_name']; 
           $img_type=$_FILES['img']['type'];
           $imgextention= strtolower(end(explode('.', $img_name))); 
            $img_user='avatar'.'_'.'_'.rand(0,100000).'_'.$img_name;
             move_uploaded_file($img_tmp, "img/user_img/".$img_user);
          
        
            $back_name= $_FILES['backgroung']['name']; 
           $back_size=$_FILES['backgroung']['size']; 
           $back_tmp=$_FILES['backgroung']['tmp_name']; 
           $back_type=$_FILES['backgroung']['type'];
          $backextention= strtolower(end(explode('.', $back_name))); 
         $back_user='backgroung'.'_'.'_'.rand(0,100000).'_'.$back_name;
         move_uploaded_file($back_tmp, "img/background/".$back_user);


                            


         $sql = "UPDATE users SET specialty='$special' ,studied='$study' ,user_avatar='$img_user' ,user_background='$back_user' ,user_full_name ='$full_name' ,user_email='$email' ,user_phone='$phone',user_country ='$from',user_city='$live_in' WHERE user_name='$username' ";
           
            if ($conn->query($sql) === TRUE) {
                  $sql = "UPDATE post SET avatar_user='$img_user' WHERE post_by='$username' ";  
                  $conn->query($sql) ;
             
                    
                     $_SESSION["useremail"]=$email;
                     $_SESSION["userphone"]=$phone;
                     $_SESSION["userfullname"]=$full_name;
                     $_SESSION["usercountry"]=$from;
                     $_SESSION["usercity"]=$live_in;
                     $_SESSION["userspecialty"]=$special;
                     $_SESSION["userstudy"]=$study;
                     $_SESSION["useravatar"]=$img_user;
                     $_SESSION["userbackground"]=$back_user;


                     header('location:profile.php');
               
              


             }else{
              echo "sorry";
             }
    

       
        
     
   }
 
  
 


  ?>