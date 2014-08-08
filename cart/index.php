<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>    <div class="recycle-page">
        <div class="recycle-title"><i class="recycle-pic"></i>Моя Корзина</div>

<?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket", 
	"cart", 
	array(
		"COLUMNS_LIST" => array(
			0 => "NAME",
			1 => "DISCOUNT",
			2 => "WEIGHT",
			3 => "PROPS",
			4 => "DELETE",
			5 => "DELAY",
			6 => "TYPE",
			7 => "PRICE",
			8 => "QUANTITY",
			9 => "SUM",
			10 => "PROPERTY_ARTICLE",
			11 => "PROPERTY_PRODUCTION",
		),
		"PATH_TO_ORDER" => "/order",
		"HIDE_COUPON" => "N",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"USE_PREPAYMENT" => "N",
		"QUANTITY_FLOAT" => "N",
		"SET_TITLE" => "Y",
		"ACTION_VARIABLE" => "action"
	),
	false
);?>
    </div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>