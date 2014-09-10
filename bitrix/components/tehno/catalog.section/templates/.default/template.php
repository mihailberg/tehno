<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);


//echo count($arResult['ITEMS']);

// print_r($arResult);
//die();

if (count($arResult["ITEMS"]) != 0) {
  if (count($arResult["SECTIONS"]) != 0) {
    $i = 0;
    foreach ($arResult["SECTIONS"] as $arSectionKey => $arSection) {
      $i++;
      if ($i == 1) echo "<div class=\"js-section\" data-id=\"#t" .$arSection["ID"]. "\">";
      else echo "<div class=\"js-section\" style=\"display: none;\" data-id=\"#t" .$arSection["ID"]. "\">";
      ?>
      <a name="t<?=$arSection["ID"]?>" id="t<?=$arSection["ID"]?>" class="d_sort">
        Сортировать по
        <select>
          <option>цене, сначала дешевые</option>
          <option>цене, сначала дороже</option>
        </select>

        <select class="one">
          <option>показать все бренды</option>
        </select>
      </a>
      <div class="d_tabproducts">
      <?

      foreach ($arResult["ITEMS"] as $arItemKey => $arItem) {
        if ($arItem["~IBLOCK_SECTION_ID"] == $arSection["ID"]) {

            $p = CCatalogProduct::GetOptimalPrice($arItem['ID']);
            $price = $p['PRICE']['PRICE'];
//
//            $res = CIBlockElement::GetProperty($arItem['IBLOCK_ID'], $arItem['ID'], "sort", "asc", array("CODE" => "ARTICLE"));
//            if ($ob = $res->GetNext())
//            {
//                $art = $ob['VALUE'];
//            }
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
                <a class="btn btn_small btn_green js-add2basket" href="<?=$arItem['ADD_URL']?>">В корзину</a>
              </div>
            </div>
          </div>
        <?
        }}
      echo "</div></div>";
    }
  } else {
    echo "<div class=\"js-section\">";
    ?>
    <a name="t1" id="t1" class="d_sort">
      Сортировать по
      <select>
        <option>цене, сначала дешевые</option>
        <option>цене, сначала дороже</option>
      </select>

      <select class="one">
        <option>показать все бренды2</option>
      </select>
    </a>
    <div class="d_tabproducts">
    <?
    foreach ($arResult["ITEMS"] as $arItemKey => $arItem) {?>
      <div class="product">
        <div class="product__pic">
          <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>"></a>
        </div>
        <div class="product__title"><?=$arItem["NAME"]?></div>
        <div class="product__code">арт. <?=$arItem["DISPLAY_PROPERTIES"]["ARTICLE"]["VALUE"]?></div>
        <div class="product__details">
          <div class="product__price"><?=$arItem["DISPLAY_PROPERTIES"]["PRICE1"]["VALUE"]?> Р</div>
          <div class="product__buy">
            <a class="btn btn_small btn_green js-add2basket" href="<?=$arItem['ADD_URL']?>">В корзину</a>
          </div>
        </div>
      </div>
    <?
    }
    echo "</div></div>";
  }
}