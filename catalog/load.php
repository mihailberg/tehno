<?
ini_set('display_errors',true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/technocom/tehnocom_functions.php");
if (!isset($_REQUEST["ajax"])) die();
CModule::IncludeModule("iblock");
$search = (int)$_REQUEST["search"];
$q = iconv("utf-8", "windows-1251", $_REQUEST["q"]);
$page = (int)$_REQUEST["page"];
$id = (int)$_REQUEST["id"];
$sales = (int)$_REQUEST["sales"];
$productionFilter = isset($_REQUEST["productionFilter"]) ? (int)$_REQUEST["productionFilter"] : 0;
$priceSort = (int)$_REQUEST["priceFilter"] ? "desc" : "asc";
$products = array();
$section = array();
$sArOrder = array();
$sArFilter = array("ACTIVE" => "Y", "IBLOCK_ID" => 13, "ID" => $id);
$sBIncCnt = false;
$sSelect = array();
$sNavStartParams = false;
$pArOrder = array("catalog_PRICE_7" => $priceSort);
$pArFilter = array("ACTIVE" => "Y");
if ($id) $pArFilter["SECTION_ID"] = $id;
else $pArFilter["IBLOCK_ID"] = 13;
if ($productionFilter) $pArFilter["PROPERTY_PRODUCTION"] = $productionFilter;
if ($sales) $pArFilter["PROPERTY_SALE_VALUE"] = 1;
if ($search) $pArFilter["SEARCHABLE_CONTENT"] = "%" . $q . "%";
$pArGroupBy = false;
$pArNavStartParams = array("iNumPage" => $page, "nPageSize" => 8);
$pArSelectFields = array("ID", "CODE", "NAME", "IBLOCK_SECTION_ID", "PREVIEW_PICTURE", "PROPERTY_ARTICLE");
$result = CIBlockSection::GetList(
  $sArOrder,
  $sArFilter,
  $sBIncCnt,
  $sSelect,
  $sNavStartParams
);
while ($row = $result -> Fetch()) $section = $row;
if ($section["DEPTH_LEVEL"] == 2) {
  $sArFilter["ID"] = $section["IBLOCK_SECTION_ID"];
  $result = CIBlockSection::GetList(
    $sArOrder,
    $sArFilter,
    $sBIncCnt,
    $sSelect,
    $sNavStartParams
  );
  while ($row = $result -> Fetch()) $section = $row;
}
$result = CIBlockElement::GetList(
  $pArOrder,
  $pArFilter,
  $pArGroupBy,
  $pArNavStartParams,
  $pArSelectFields
);
if ($result -> NavPageCount < $page && ($search || $sales) && $page == 1) {
  echo "noFound";
  exit;
} else if ($result -> NavPageCount < $page) {
  return;
}
while ($row = $result -> Fetch()) {
  $row["URL"] = "/catalog/" . $section["CODE"] . "/" . $row["CODE"] . "/";
  $row["ADD_URL"] = "/catalog/" . $section["CODE"] . "/" . $row["CODE"] . "/?action=ADD2BASKET&id=" . $row["ID"] . "&clear_cache=Y";
  $row["PREVIEW_PICTURE"] = CFile::GetPath($row["PREVIEW_PICTURE"]);
  $p = CCatalogProduct::GetOptimalPrice($row['ID']);
  $row["PRICE"] = $p['PRICE']['PRICE'];
  $products[] = $row;
}
echo my_json_encode($products);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");