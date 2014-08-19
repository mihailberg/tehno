<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Îôîğìëåíèå çàêàçà");
?><?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.order.ajax",
	"",
	Array(
	)
);?> <br>
 <br>
 <?$APPLICATION->IncludeComponent(
	"bitrix:sale.order.full",
	"",
	Array(
	)
);?><br>
&lt;!!!!!!!!!!!!!!!&gt;<br>
<?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket",
	"",
	Array(
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>