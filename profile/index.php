<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("������ �������");
?><?$APPLICATION->IncludeComponent(
	"bitrix:main.profile",
	"tehno_profile",
	Array(
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>