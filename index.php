<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("�������");
$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/slider.php");
$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/benefits.php");
$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/production.php");
$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/map.php");
$APPLICATION->IncludeFile(
  SITE_TEMPLATE_PATH."/include/cycle.php",
  array("CAPTION_TYPE"=>"BG")
);
$APPLICATION->IncludeFile(
  SITE_TEMPLATE_PATH."/include/cycle.php",
  array("CAPTION_TYPE"=>"BG", "CAPTION_NAME"=>"������ �� �������")
);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>