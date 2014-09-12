<?php

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");  

   ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
   if($_POST['message']){
        $query = "DELETE FROM b_order_mess_status WHERE ID = '".mysql_real_escape_string($_POST['message'])."' AND USER_ID = '".mysql_real_escape_string($_SESSION['SESS_AUTH']['USER_ID'])."'";
        $res = mysql_query($query) or die(mysql_error()); 
   } 
   
   //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $strError = array();
    $user = new CUser;
    
    if (isset($_POST['name'])) {
        $fields['NAME'] = iconv('utf-8', 'cp1251', mysql_real_escape_string($_POST['name']));
        $_SESSION["SESS_AUTH"]["NAME"] = iconv('utf-8', 'cp1251', $fields['NAME']);
    } elseif (isset($_POST['email'])) {
        $fields['EMAIL'] = iconv('utf-8', 'cp1251', mysql_real_escape_string($_POST['email']));
        $fields['LOGIN'] = iconv('utf-8', 'cp1251', mysql_real_escape_string($_POST['email']));
    } elseif (isset($_POST['tel'])) {
        $fields['PERSONAL_PHONE'] = iconv('utf-8', 'cp1251', mysql_real_escape_string($_POST['tel']));
    } elseif (isset($_POST['comp'])) {
        $fields['WORK_COMPANY'] = iconv('utf-8', 'cp1251', mysql_real_escape_string($_POST['comp']));
    } elseif(isset($_POST['city'])){
        $query = "UPDATE b_uts_user SET UF_CITY = '".iconv('utf-8', 'cp1251', mysql_real_escape_string($_POST['city']))."' WHERE VALUE_ID = '".mysql_real_escape_string($_SESSION['SESS_AUTH']['USER_ID'])."'";
        $res = mysql_query($query) or die(mysql_error());
    }
    
    $user->Update($_SESSION['SESS_AUTH']['USER_ID'], $fields);            
    if($user->LAST_ERROR)
        $strError[] = $user->LAST_ERROR;
                        
    if (count($fields)) {
       $rez['status'] = 'OK';
       if(count($strError)){
           $rez['status'] = 'ERROR'; 
           $rez['error'] = $strError;
       }
       echo json_encode($rez);
       die;
    }

   