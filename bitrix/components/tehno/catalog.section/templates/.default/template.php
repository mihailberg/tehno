<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

if (count($arResult["ITEMS"]) != 0) {

  if (count($arResult["SECTIONS"]) == 0 || isset($arParams["SALES"]) || isset($arParams["PRODUCTIONS"])) {
    $arResult["SECTIONS"] = array();
    $arResult["SECTIONS"][$arResult["ID"]] = array("ID" => $arResult["ID"]);
  }

  foreach ($arResult["SECTIONS"] as $arSectionKey => $arSection) {
    $i++;
    if ($i == 1) echo "<div class=\"js-section active\" data-id=\"#t" .$arSection["ID"]. "\">";
    else echo "<div class=\"js-section\" style=\"display: none;\" data-id=\"#t" .$arSection["ID"]. "\">";
    if (isset($arParams["SALES"])) echo "<input type=\"hidden\" name=\"sales\" value=\"1\">";
    if (isset($arParams["PRODUCTIONS"])) echo "<input type=\"hidden\" name=\"productions\" value=\"1\">";
    ?>
    <a name="t<?=$arSection["ID"]?>" id="t<?=$arSection["ID"]?>" class="d_sort">
      Сортировать по
      <select class="jsd-priceFilter">
        <option value="0" selected>цене, сначала дешевые</option>
        <option value="1">цене, сначала дороже</option>
      </select>
      <select class="one jsd-productionFilter">
        <option value="0">показать все бренды</option>
        <?$APPLICATION->IncludeComponent(
          "bitrix:catalog.smart.filter", "filter",
          array(
            "IBLOCK_TYPE" => "catalog",
            "IBLOCK_ID" => "13",
            "SECTION_ID" => $arSection["ID"],
            "FILTER_NAME" => "arrFilter",
            "PRICE_CODE" => array(
              0 => "Розничная",
              1 => "Мелкооптовая",
              2 => "Крупнооптовая",
              3 => "Мегаоптовая",
            ),
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "36000000",
            "CACHE_GROUPS" => "Y",
            "SAVE_IN_SESSION" => "Y",
            "INSTANT_RELOAD" => "Y",
            "XML_EXPORT" => "Y",
            "SECTION_TITLE" => "NAME",
            "SECTION_DESCRIPTION" => "DESCRIPTION",
            "HIDE_NOT_AVAILABLE" => "N"
          ),
          false
        );?>
      </select>
    </a>
    <div class="d_tabproducts">
    <?
    foreach ($arResult["ITEMS"] as $arItemKey => $arItem) {
      if ($arSection["ID"] != 0) if ($arItem["~IBLOCK_SECTION_ID"] != $arSection["ID"]) continue;
        $p = CCatalogProduct::GetOptimalPrice($arItem['ID']);
        $price = $p['PRICE']['PRICE'];
        $art = $arItem["PROPERTIES"]["ARTICLE"]["VALUE"];
        ?>
        <div class="product">
          <div class="product__pic">
            <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>"></a>
          </div>
          <div class="product__title"><?=$arItem["NAME"]?></div>
          <div class="product__code">арт. <?=$art?></div>
          <div class="product__details">
            <div class="product__price"><?=$price?> <i class="icon-rub"></i></div>
            <div class="product__buy">
              <a class="btn btn_small btn_green js-add2basket" href="<?=$arItem['ADD_URL']?>" data-id="<?=$arItem['ID']?>">В корзину</a>
            </div>
          </div>
        </div>
      <?
      }
    echo "</div><div class=\"loader\"></div><div class=\"js-section-end\"></div></div>";
  }

}