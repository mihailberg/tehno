<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
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
	Array(
	)
);?>


<?if($_SESSION["SESS_AUTH"]["AUTHORIZED"] == 'Y'):?>
        
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
    </div>
</div>  
       
<?endif;?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>