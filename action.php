<?php

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");  
  
   $filename = null;
   if ($_FILES['photo']['size'] != 0 and $_FILES['photo']['size'] <= 5072000){ 

      $filename = $_SESSION['SESS_AUTH']['USER_ID'] . "-" . $_FILES['photo']['name'];
      move_uploaded_file($_FILES['photo']['tmp_name'], $_SERVER["DOCUMENT_ROOT"]."/upload/user_profile/avatars/".$filename);    
      
      $arr = getimagesize($_SERVER["DOCUMENT_ROOT"]."/upload/user_profile/avatars/".$filename);
      $query = "INSERT INTO b_file (MODULE_ID, HEIGHT, WIDTH, FILE_SIZE, CONTENT_TYPE, SUBDIR, FILE_NAME, ORIGINAL_NAME, DESCRIPTION) 
                VALUES ('main', '{$arr['1']}', '{$arr['0']}', '{$_FILES['photo']['size']}', '{$_FILES['photo']['type']}', 'user_profile/avatars', '{$filename}', '{$filename}', '');"; 
      $res = mysql_query($query) or die(mysql_error()); 
      $id = mysql_insert_id();
      $query = "UPDATE b_user SET PERSONAL_PHOTO = '{$id}' WHERE ID = {$_SESSION['SESS_AUTH']['USER_ID']};"; 
      $res = mysql_query($query) or die(mysql_error());
          
   } 
   elseif ($_FILES['detail']['size'] != 0 and $_FILES['detail']['size'] <= 5072000){ 
      
      $filename = $_SESSION['SESS_AUTH']['USER_ID'] . "-" . $_FILES['detail']['name'];
      move_uploaded_file($_FILES['detail']['tmp_name'], $_SERVER["DOCUMENT_ROOT"]."/upload/user_profile/details/".$filename);  
      
      $query = "INSERT INTO b_file (MODULE_ID, HEIGHT, WIDTH, FILE_SIZE, CONTENT_TYPE, SUBDIR, FILE_NAME, ORIGINAL_NAME, DESCRIPTION) 
                VALUES ('main', '0', '0', '{$_FILES['detail']['size']}', '{$_FILES['detail']['type']}', 'user_profile/details', '{$filename}', '{$filename}', '');"; 
      $res = mysql_query($query) or die(mysql_error()); 
      $id = mysql_insert_id();
      $query = "UPDATE b_uts_user SET UF_DETAILS = '{$id}' WHERE VALUE_ID = {$_SESSION['SESS_AUTH']['USER_ID']};"; 
      $res = mysql_query($query) or die(mysql_error());      
   } 
   
   //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   if($_POST['city']){
        $query = "UPDATE b_uts_user SET UF_CITY = '{$_POST['city']}' WHERE VALUE_ID = {$_SESSION['SESS_AUTH']['USER_ID']}";
        $res = mysql_query($query) or die(mysql_error());
   }

   ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
   if($_POST['message']){
        $query = "DELETE FROM b_order_mess_status WHERE ID = {$_POST['message']}";
        $res = mysql_query($query) or die(mysql_error());
   } 
   //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   if(isset($_POST['get_photo'])){
        $query = "SELECT FILE_NAME FROM b_user INNER JOIN b_file ON b_user.PERSONAL_PHOTO=b_file.ID WHERE b_user.ID = {$_SESSION['SESS_AUTH']['USER_ID']}"; 
        $res = mysql_query($query) or die(mysql_error());
        $res1 = mysql_fetch_array($res);
        echo $res1[0];
   }elseif(isset($_POST['get_details'])){
        $query = "SELECT FILE_NAME FROM b_file INNER JOIN b_uts_user ON b_file.ID=b_uts_user.UF_DETAILS WHERE b_uts_user.VALUE_ID = {$_SESSION['SESS_AUTH']['USER_ID']}"; 
        $res = mysql_query($query) or die(mysql_error());
        $res1 = mysql_fetch_array($res);
        echo $res1[0];
   }
   
   //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   //array with post params
   $needFields = array(
        'name' => 'NAME',       
        'tel' => 'PERSONAL_PHONE',
        'email' => 'EMAIL',
        'comp' => 'WORK_COMPANY',
        'city_name' => 'PERSONAL_CITY'
   );
  
   $val;
   foreach($needFields as $key => $value){
        if (isset($_POST[$key])){
            $val = $_POST[$key];
        }
        else continue;
        
        $query = "UPDATE b_user SET {$value} = '{$val}' WHERE ID = {$_SESSION['SESS_AUTH']['USER_ID']}";
        $res = mysql_query($query) or die(mysql_error());
        break;
   }
   
    
   
     
?>