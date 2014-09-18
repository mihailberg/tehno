<?
/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>

<div class="cab_upd_error">
    <?=ShowError($arResult["strProfileError"]);?>
</div>
<div class="cabinet__head">
    <div class="ucright">
        <span class="cabinet__data cabinet__name"><?=$arResult["arUser"]["NAME"]?></span>
        <span class="ucab_name">
            <span class="cabiten__dialog">
                <a class="btn__edit" href="#" data-type="name">изменить</a>
            </span>
        </span>
    </div>
    <div class="ucity_select">
        <span>г. </span>
        <span class="cabinet__data ucity_data">
               
        <?
            $query = "SELECT ID, NAME FROM b_iblock_element WHERE IBLOCK_ID = 27 ORDER BY NAME"; 
            $res = mysql_query($query) or die(mysql_error());
            $cities = array();
            while($res1 = mysql_fetch_assoc($res)){
                $cities[$res1['ID']] = $res1['NAME'];
            }
        
            $rsUser = CUser::GetList(($by="ID"), ($order="desc"), array("ID"=>$USER->GetID()),array("SELECT"=>array("UF_CITY")));
            $arUser=$rsUser->Fetch();
            echo $cities[$arUser[UF_CITY]];
        ?>
        
        </span>
        <span class="ucab_city">

            <span class="cabiten__dialog">
                <a class="btn__edit2" onclick="$(this).siblings('.cabinet__edit2').toggle()">изменить</a>
                <div class="cabinet__edit2">                   
                    <select class="cabinet__edit_field">
                        <?
                            foreach ($cities as $id => $city) {
                                echo '<option value="'.$id.'" '.(($arUser[UF_CITY] == $id)?'selected':'').'>'.$city.'</option>';
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
            <?=$arResult["arUser"]["PERSONAL_PHOTO_HTML"]?>                 
        </div>

        <div class="ucab_photo">
            <div class="cabiten__dialog">
                <a class="btn__edit2" onclick="$(this).siblings('.cabinet__edit2').toggle()">изменить фото</a>
                <div class="cabinet__edit2">

                    <form method="post" id="photo_form" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
                        <?=$arResult["BX_SESSION_CHECK"]?>
                        <input type="hidden" name="lang" value="<?=LANG?>" />
                        <input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
                        <input type="hidden" name="LOGIN" maxlength="50" value="<? echo $arResult["arUser"]["LOGIN"]?>" />
                        <input type="hidden" name="EMAIL" maxlength="50" value="<? echo $arResult["arUser"]["EMAIL"]?>" />
                        
                        <?=$arResult["arUser"]["PERSONAL_PHOTO_INPUT"]?>
                		<div class="clear">
                            <input type="submit" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?>" onclick="$('.cabinet__edit2').has(this).hide()" />
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
                <span class="cabinet__data"><? echo $arResult["arUser"]["PERSONAL_PHONE"]?></span>
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
                    <a href="<?=CFile::GetPath($arResult["arUser"]["UF_DETAILS"]);?>"><?$matches = array(); preg_match('/\/([^\/]*)$/i', CFile::GetPath($arResult["arUser"]["UF_DETAILS"]), $matches); echo($matches[1]);?></a>    
                </span>         
            </div>
            <div class="ucab_details">
                <span class="cabiten__dialog">
                    <a class="btn__edit2" onclick="$(this).siblings('.cabinet__edit2').toggle()">загрузить новые реквизиты</a>
                    <div class="cabinet__edit2">
                        
                        
                        <form method="post" id="detail_form" name="form2" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
                            <?=$arResult["BX_SESSION_CHECK"]?>
                            <input type="hidden" name="lang" value="<?=LANG?>" />
                            <input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
                            
                            <input type="hidden" name="LOGIN" maxlength="50" value="<? echo $arResult["arUser"]["LOGIN"]?>" />
                            <input type="hidden" name="EMAIL" maxlength="50" value="<? echo $arResult["arUser"]["EMAIL"]?>" />
                            
                            <input class="typefile" type="file" size="20" name="UF_DETAILS" />
                    		<div class="clear">
                                <input type="submit" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?>" onclick="$('.cabinet__edit2').has(this).hide()" />
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
            
  