<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поиск");?>
<?$APPLICATION->IncludeComponent(
	"bitrix:search.page", 
	".default", 
	array(
		"TAGS_SORT" => "NAME",
		"TAGS_PAGE_ELEMENTS" => "150",
		"TAGS_PERIOD" => "30",
		"TAGS_URL_SEARCH" => "/search/index.php",
		"TAGS_INHERIT" => "Y",
		"FONT_MAX" => "50",
		"FONT_MIN" => "10",
		"COLOR_NEW" => "000000",
		"COLOR_OLD" => "C8C8C8",
		"PERIOD_NEW_TAGS" => "",
		"SHOW_CHAIN" => "Y",
		"COLOR_TYPE" => "Y",
		"WIDTH" => "100%",
		"USE_SUGGEST" => "Y",
		"SHOW_RATING" => "Y",
		"PATH_TO_USER_PROFILE" => "",
		"AJAX_MODE" => "N",
		"RESTART" => "Y",
		"NO_WORD_LOGIC" => "N",
		"USE_LANGUAGE_GUESS" => "N",
		"CHECK_DATES" => "N",
		"USE_TITLE_RANK" => "Y",
		"DEFAULT_SORT" => "rank",
		"FILTER_NAME" => "",
		"arrFILTER" => array(
			0 => "iblock_catalog",
		),
		"SHOW_WHERE" => "N",
		"arrWHERE" => "",
		"SHOW_WHEN" => "N",
		"PAGE_RESULT_COUNT" => "50",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"DISPLAY_TOP_PAGER" => "Y",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Результаты поиска",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "",
		"AJAX_OPTION_SHADOW" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"arrFILTER_iblock_catalog" => array(
			0 => "13",
		),
		"RATING_TYPE" => ""
	),
	false
);?>
<?
$q = isset($_REQUEST["q"]) ? $_REQUEST["q"] : "";
if (!empty($q)) {
  $result = CIBlockElement::GetList(
    array(),
    array("IBLOCK_ID" => 13, "NAME" => "%" . $q)
  );
  $products = array();
  while ($row = $result -> Fetch()) $products[] = $row;
  echo "<pre>";
  print_r($products);
  exit;
}
?>
  <div class="d_space"></div>
  <div class="title-line"><span>Поиск</span></div>
  <div class="page_not">
    <div class="catalog__top">
      <form method="get" action="/search/">
        <div class="catalog__search">
          <input type="text" class="input" placeholder="Введите название или код товара" name="q">
        </div>
        <button class="btn" type="submit">Найти</button>
      </form>
    </div>
    <?if(isset($_REQUEST["q"]) && empty($q)):?>
      <div class="no-result">Введите название или код товара</div>
    <?endif;?>
  </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>