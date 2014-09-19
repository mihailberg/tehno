<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
?>
<div class="page_not">
  <div class="catalog__top">
    <form method="get" action="">
      <div class="catalog__search">
        <input type="text" class="input" placeholder="������� �������� ��� ��� ������" name="q" value="<?=$arResult["REQUEST"]["QUERY"]?>">
      </div>
      <button class="btn" type="submit">�����</button>
      <input type="hidden" name="how" value="<?echo $arResult["REQUEST"]["HOW"]=="d"? "d": "r"?>" />
      <input type="hidden" name="search" value="1" />
    </form>
  </div>

<?if(isset($arResult["REQUEST"]["ORIGINAL_QUERY"])):
	?>
	<div class="search-language-guess">
		<?echo GetMessage("CT_BSP_KEYBOARD_WARNING", array("#query#"=>'<a href="'.$arResult["ORIGINAL_QUERY_URL"].'">'.$arResult["REQUEST"]["ORIGINAL_QUERY"].'</a>'))?>
	</div><br /><?
endif;?>
</div>
<?if($arResult["REQUEST"]["QUERY"] === false && $arResult["REQUEST"]["TAGS"] === false):?>
<?elseif($arResult["ERROR_CODE"]!=0):?>
  <div class="page_not">
	<p><?=GetMessage("SEARCH_ERROR")?></p>
	<?ShowError($arResult["ERROR_TEXT"]);?>
	<p><?=GetMessage("SEARCH_CORRECT_AND_CONTINUE")?></p>
	<br /><br />
	<p><?=GetMessage("SEARCH_SINTAX")?><br /><b><?=GetMessage("SEARCH_LOGIC")?></b></p>
	<table border="0" cellpadding="5">
		<tr>
			<td align="center" valign="top"><?=GetMessage("SEARCH_OPERATOR")?></td><td valign="top"><?=GetMessage("SEARCH_SYNONIM")?></td>
			<td><?=GetMessage("SEARCH_DESCRIPTION")?></td>
		</tr>
		<tr>
			<td align="center" valign="top"><?=GetMessage("SEARCH_AND")?></td><td valign="top">and, &amp;, +</td>
			<td><?=GetMessage("SEARCH_AND_ALT")?></td>
		</tr>
		<tr>
			<td align="center" valign="top"><?=GetMessage("SEARCH_OR")?></td><td valign="top">or, |</td>
			<td><?=GetMessage("SEARCH_OR_ALT")?></td>
		</tr>
		<tr>
			<td align="center" valign="top"><?=GetMessage("SEARCH_NOT")?></td><td valign="top">not, ~</td>
			<td><?=GetMessage("SEARCH_NOT_ALT")?></td>
		</tr>
		<tr>
			<td align="center" valign="top">( )</td>
			<td valign="top">&nbsp;</td>
			<td><?=GetMessage("SEARCH_BRACKETS_ALT")?></td>
		</tr>
	</table>
    <div class="d_space"></div>
  </div>
<?elseif(count($arResult["SEARCH"])>0):?>
  <div class="d_tabs-m">
    <div class="domtab-m">
      <div class="js-section active" data-id="#t0">
        <a name="t0" id="t0" class="d_sort">
          ����������� ��
          <select class="jsd-priceFilter">
            <option value="0" selected>����, ������� �������</option>
            <option value="1">����, ������� ������</option>
          </select>
          <select class="one jsd-productionFilter">
            <option value="0">�������� ��� ������</option>
            <?$APPLICATION->IncludeComponent(
              "bitrix:catalog.smart.filter", "filter",
              array(
                "IBLOCK_TYPE" => "catalog",
                "IBLOCK_ID" => "13",
                "SECTION_ID" => 0,
                "FILTER_NAME" => "arrFilter",
                "PRICE_CODE" => array(
                  0 => "���������",
                  1 => "������������",
                  2 => "�������������",
                  3 => "�����������",
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
          <?foreach ($arResult["SEARCH"] as $arItem) {
            $p = CCatalogProduct::GetOptimalPrice($arItem['ID']);
            $price = $p['PRICE']['PRICE'];
            $art = $arItem["PROPERTIES"]["ARTICLE"]["VALUE"];
            ?>
            <div class="product">
              <div class="product__pic">
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>"></a>
              </div>
              <div class="product__title"><?=$arItem["NAME"]?></div>
              <div class="product__code">���. <?=$art?></div>
              <div class="product__details">
                <div class="product__price"><?=$price?> <i class="icon-rub"></i></div>
                <div class="product__buy">
                  <a class="btn btn_small btn_green js-add2basket" href="<?=$arItem['ADD_URL']?>">� �������</a>
                </div>
              </div>
            </div>
          <?}?>
        </div>
        <div class="loader"></div>
        <div class="js-section-end"></div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
<?else:?>
<div class="page_not">
	<?ShowNote(GetMessage("SEARCH_NOTHING_TO_FOUND"));?>
</div>
<?endif;?>