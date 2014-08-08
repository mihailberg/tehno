<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ќформление заказа");
?><?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.order.ajax",
	"",
	Array(
	)
);?>
<br /><br /><?$APPLICATION->IncludeComponent(
	"bitrix:sale.order.full",
	"",
	Array(
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>