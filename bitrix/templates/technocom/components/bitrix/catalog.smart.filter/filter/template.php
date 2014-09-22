<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$prod = 0;
if (isset($_REQUEST["prod"])) $prod = (int)$_REQUEST["prod"];
foreach ($arResult["ITEMS"][21]["VALUES"] as $key => $val) {
  echo "<option value=\"$key\"";
  if ($key == $prod) echo " selected";
  echo ">{$val["VALUE"]}</option>";
}
?>