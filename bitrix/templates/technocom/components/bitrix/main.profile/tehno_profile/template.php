<?
/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>



<script type="text/javascript" src="http://scriptjava.net/source/scriptjava/scriptjava.js"></script>
<script type="text/javascript">
    function SendFile() {
    	//submit file
    	$$f({
    		formid:'photo_form',
    		url:'/action.php',
    		onstart:function () {
    		},
    		onsend:function () {
    		  var loc = window.location.hostname;
              $.post('http://' + loc + '/action.php',
                {
                    get_photo: true
                },
                function(data){
                    $('.user-photo').html('<img src="/upload/user_profile/avatars/'+data+'" alt="" />');
                }               
              ); 
    		}
    	});
        $$f({
    		formid:'detail_form',
    		url:'/action.php',
    		onstart:function () {
    		},
    		onsend:function () {
    		  var loc = window.location.hostname;
              $.post('http://' + loc + '/action.php',
                {
                    get_details: true
                },
                function(data){
                    $('.comp_details').html('<a href="/upload/user_profile/details/'+data+'">'+data+'</a>');
                }               
              );  		  
    		}
    	});
    }
    
    
</script>

<div class="cabinet__head">
    <div class="ucright">
        <span class="cabinet__data"><?=$arResult["arUser"]["NAME"]?></span>
        <span class="ucab_name">
            <span class="cabiten__dialog">
                <a class="btn__edit" href="#" data-type="name">изменить</a>
            </span>
        </span>
    </div>
    <div>
        <span>г. </span>
        <span class="cabinet__data ucity_data"><?=$arResult["arUser"]["PERSONAL_CITY"]?></span>
        <span class="ucab_city">

            <span class="cabiten__dialog">
                <a class="btn__edit2" onclick="$(this).siblings('.cabinet__edit2').toggle()">изменить</a>
                <div class="cabinet__edit2">                   
                    <select class="cabinet__edit_field">
                        <?
                            $query = "SELECT ID, NAME FROM b_iblock_element WHERE IBLOCK_ID = 27 ORDER BY NAME"; 
                            $res = mysql_query($query) or die(mysql_error());
                            while($res1 = mysql_fetch_array($res)){
                                echo '<option value="'.$res1[0].'"';
                                if ($city_id != null && $city_id==$res[0]) echo ' selected';
                                echo'>'.$res1[1].'</option>';
                            }
                        ?>
                    </select>                                               
                    <div class="clear">
                        <input type="submit" value="Сохранить" onclick="$('.cabinet__edit2').has(this).hide()" />                                                       
                        <div class="fr btn_cancel" onclick="$('.cabinet__edit2').has(this).hide()">Отмена</div>
                    </div>                   
                </div>

            </span>
        </span>
    </div>
</div>
<div class="cabinet-user clearfix">
    <div class="cabinet-user__left">
        <div class="user-photo">    
            <?
                $query = "SELECT FILE_NAME FROM b_user INNER JOIN b_file ON b_user.PERSONAL_PHOTO=b_file.ID WHERE b_user.ID = {$_SESSION['SESS_AUTH']['USER_ID']}"; 
                $res = mysql_query($query) or die(mysql_error());
                $res1 = mysql_fetch_array($res);
            ?>
            <img src="/upload/user_profile/avatars/<?=$res1[0];?>" alt="" />

        </div>
        <div class="ucab_photo">
            <div class="cabiten__dialog">
                <a class="btn__edit2" onclick="$(this).siblings('.cabinet__edit2').toggle()">изменить фото</a>
                <div class="cabinet__edit2">
                    <form id="photo_form" enctype="multipart/form-data" method="post">
                        <input type="file" name="photo"/>                                               
                        <div class="clear">
                            <input type="submit" value="Сохранить" onclick="SendFile(); $('.cabinet__edit2').has(this).hide()" />                                                       
                            <div class="fr btn_cancel" onclick="$('.cabinet__edit2').has(this).hide()">Отмена</div>
                        </div>
                    </form>
                </div>                                   
            </div>
        </div>
    </div>
    <div class="cabinet-user__right clearfix">
        
        
        <div class="cabinet-user__block">
            <div class="cabinet-user__block_title">Ваши контакты:</div>
            <div class="ucab_tel">
                Тел.:
                <span class="cabinet__data"><?=$arResult["arUser"]["PERSONAL_PHONE"]?></span>
                <span class="cabiten__dialog fr">
                    <a class="btn__edit" href="#" data-type="tel">изменить</a>
                </span>
            </div>
            <div class="ucab_email">
                Почта:
                <span class="cabinet__data"><? echo $arResult["arUser"]["EMAIL"]?></span>
                <span class="cabiten__dialog fr">
                    <a class="btn__edit" href="#" data-type="email">изменить</a>
                </span>
            </div>
        </div>
        
        <?if($arResult["arUser"]["UF_LEGAL"] == '1'):?>
        <div class="cabinet-user__block">
            <div class="cabinet-user__block_title cabinet__data"><?=$arResult["arUser"]["WORK_COMPANY"]?></div>
            <span class="ucab_company">
                <span class="cabiten__dialog">
                    <a class="btn__edit" href="#" data-type="comp">изменить</a>
                </span>
            </span>
            <div>
                Реквизиты:
                <span class="comp_details">
                    <?
                        $query = "SELECT FILE_NAME FROM b_file INNER JOIN b_uts_user ON b_file.ID=b_uts_user.UF_DETAILS WHERE b_uts_user.VALUE_ID = {$_SESSION['SESS_AUTH']['USER_ID']}"; 
                        $res = mysql_query($query) or die(mysql_error());
                        $res1 = mysql_fetch_array($res);
                    ?>
                    <a href="/upload/user_profile/details/<?=$res1[0]?>"><?=$res1[0]?></a>    
                </span>         
            </div>
            <div class="ucab_details">
                <span class="cabiten__dialog">
                    <a class="btn__edit2" onclick="$(this).siblings('.cabinet__edit2').toggle()">загрузить новые реквизиты</a>
                    <div class="cabinet__edit2">
                        <form id="detail_form" enctype="multipart/form-data" method="post">
                            <input type="file" name="detail"/>
                            <div class="clear">
                                <input type="submit" value="Сохранить" onclick="SendFile(); $('.cabinet__edit2').has(this).hide()" />
                                <div class="fr btn_cancel" onclick="$('.cabinet__edit2').has(this).hide()">Отмена</div>
                            </div>
                        </form>
                    </div>
                </span>
            </div>
        </div>
        <?endif;?>
        
    </div>
</div>
            
  