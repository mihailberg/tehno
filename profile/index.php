<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");

/**
 * foreach($_POST as $key => $value){
 *     preg_match_all('/\"([^"]*)\".([^-]*).\-/', $value, $found);
 *     echo '++++++++++++++++++++++++++++++';
 *     foreach($found[1] as $pk => $p_k){
 *         if($p_k != 'PERSONAL_PHOTO'){
 *             $_REQUEST[trim($p_k)] = trim($found[2][$pk]);     
 *         }
 *     }
 *     die;
 * }
 */


?>

<?if($_SESSION["SESS_AUTH"]["AUTHORIZED"] == 'Y'):?>
<div class="cabinet">

    <?ShowError($arResult["strProfileError"]);?>
    <?
    if ($arResult['DATA_SAVED'] == 'Y')
    	ShowNote(GetMessage('PROFILE_DATA_SAVED'));
    ?>
    <script type="text/javascript">
    <!--
    var opened_sections = [<?
    $arResult["opened"] = $_COOKIE[$arResult["COOKIE_PREFIX"]."_user_profile_open"];
    $arResult["opened"] = preg_replace("/[^a-z0-9_,]/i", "", $arResult["opened"]);
    if (strlen($arResult["opened"]) > 0)
    {
    	echo "'".implode("', '", explode(",", $arResult["opened"]))."'";
    }
    else
    {
    	$arResult["opened"] = "reg";
    	echo "'reg'";
    }
    ?>];
    //-->
    
    var cookie_prefix = '<?=$arResult["COOKIE_PREFIX"]?>';
    </script>
        
    <div class="cabinet__title">Личный кабинет</div>  
    <div class="clearfix">
        <div class="cabinet__left">
            <div class="cabinet__left_title">Ваш личный менеджер</div>
            <div class="cabinet__left_mtitle">Виталий Кузнецов</div>
            <div class="cabinet__left_mtitle">Офис:</div>
            <div>8 (812) 400-00-20 доб. 209</div>
            <div class="cabinet__left_mtitle">Личный мобильный:</div>
            <div>8 (911) 929-00-22</div>
            <div class="cabinet__left_mtitle">Почта:</div>
            <div>kuznetsov@tehnocom.net</div>           
            <div class="cabinet__skype"><i class="skype__pic"></i>kuznetsov.tehnocom</div>
            <div class="cabinet__call clearfix"><i class="callback__pic"></i><a href="#"><span>Заказать бесплатный обратный звонок</span></a></div>
        </div>
        <div class="cabinet__right">
<?endif;?>

<!-- User Profile -->
<?$APPLICATION->IncludeComponent(
	"bitrix:main.profile", 
	"tehno_profile", 
	array(
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"SET_TITLE" => "Y",
		"USER_PROPERTY" => array(
			0 => "UF_SECTION_PRICE3",
			1 => "UF_SECTION_PRICE4",
			2 => "UF_IM_SEARCH",
			3 => "UF_LEGAL",
			4 => "UF_DETAILS",
			5 => "UF_CITY",
			6 => "UF_CONTACT",
		),
		"SEND_INFO" => "N",
		"CHECK_RIGHTS" => "N",
		"USER_PROPERTY_NAME" => "",
		"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>

<?if($_SESSION["SESS_AUTH"]["AUTHORIZED"] == 'Y'):?>

        <?//if(!empty($arResult['ORDERS'])):?>
    
            <div class="cabinet__title cabinet__title_middle">Ваши заказы</div>     
            <div class="x_tabs">
                <div class="x_tabs__links">
                    <a class="selected" href="#">
                        <span>Текущие</span>
                    </a>
                    <a href="#">
                        <span>Архив</span>
                    </a>
                </div>
                
                <div class="Ajax_load">            
                    <div class="x_tabs__item selected">
                          
                                <!-- Your Orders && Your messages -->        
                                <?$APPLICATION->IncludeComponent("bitrix:sale.personal.order", "", array(
                                	"SEF_MODE" => "Y",
                                	"SEF_FOLDER" => "/personal/order/",
                                	"ORDERS_PER_PAGE" => "10",
                                	"PATH_TO_PAYMENT" => "/personal/order/payment/",
                                	"PATH_TO_BASKET" => "/personal/cart/",
                                	"SET_TITLE" => "Y",
                                	"SAVE_IN_SESSION" => "N",
                                	"NAV_TEMPLATE" => "arrows",
                                	"SEF_URL_TEMPLATES" => array(
                                		"list" => "index.php",
                                		"detail" => "detail/#ID#/",
                                		"cancel" => "cancel/#ID#/",
                                	),
                                	"SHOW_ACCOUNT_NUMBER" => "Y"
                                	),
                                	false
                                );?>
                        
                    </div>
                    <div class="x_tabs__item">   
                        
                                <?
                                $_REQUEST['filter_history'] = 'Y';
                                ?>
                                 <?$APPLICATION->IncludeComponent("bitrix:sale.personal.order", "", array(
                                	"SEF_MODE" => "Y",
                                	"SEF_FOLDER" => "/personal/order/",
                                	"ORDERS_PER_PAGE" => "10",
                                	"PATH_TO_PAYMENT" => "/personal/order/payment/",
                                	"PATH_TO_BASKET" => "/personal/cart/",
                                	"SET_TITLE" => "Y",
                                	"SAVE_IN_SESSION" => "N",
                                	"NAV_TEMPLATE" => "arrows",
                                	"SEF_URL_TEMPLATES" => array(
                                		"list" => "index.php",
                                		"detail" => "detail/#ID#/",
                                		"cancel" => "cancel/#ID#/",
                                	),
                                	"SHOW_ACCOUNT_NUMBER" => "Y"
                                	),
                                	false
                                );?>
                                
                    </div>
                </div>
            </div>
            
            <?
                $query = "SELECT * FROM b_order_mess_status WHERE USER_ID = {$_SESSION['SESS_AUTH']['USER_ID']}"; 
                $res = mysql_query($query) or die(mysql_error());
            ?>
            <div class="cabinet__title cabinet__title_middle">Ваши сообщения</div>
            <table class="cabinet__table">
                <tr>
                    <th width="530">Тема:</th>
                    <th width="590">Отправитель:</th>
                    <th>Дата</th>
                </tr>
                <?while($value = mysql_fetch_array($res)):?>
                    <tr>
                        <td>Заказ №<?=$value['ORDER_ID']?> 
                            <? 
                                if($value['STATUS'] == 'N'){
                                    echo ' принят в обработку!';
                                }else if($value['STATUS'] == 'X'){
                                    echo ' отменен!';
                                }else if($value['STATUS'] == 'P'){
                                    echo ' оплачен!';
                                }else if($value['STATUS'] == 'F'){
                                    echo ' выполнен!';
                                }else{
                                    echo ' отменен!';
                                }
                            ?>
                        </td>
                        <td><?=$value['SENDER']?></td>                    
                        <td>
                            <?=date('d.m.y', strtotime($value['DATE']));?> 
                            
                            <a class="fr delete_order_mess" style="cursor: pointer;">удалить</a>
                            <span class="mess_id" style="display: none;"><?=$value['ID']?></span>
                        </td>
                    </tr> 
                <?endwhile?>             
            </table> 
            
    	<?//endif?>     
        </div>
    </div>
</div>  
       
<?endif;?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>