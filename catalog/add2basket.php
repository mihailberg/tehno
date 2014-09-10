<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->IncludeComponent(
    "bitrix:catalog.section",
    "empty",
    array()
);

$APPLICATION->IncludeComponent(
    "bitrix:sale.basket.basket.line",
    "",
    array(
        "PATH_TO_BASKET" => "/cart/",
        "PATH_TO_PERSONAL" => "/profile/",
        "SHOW_PERSONAL_LINK" => "N",
    ),
    false
);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>