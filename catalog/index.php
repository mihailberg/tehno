<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("�������");
if (LEVEL == 1) $sectionViewMode = "TILE";
else $sectionViewMode = "TEXT";
?>
  <div class="d_space"></div>
<?if(LEVEL==1):?>
  <div class="title-line"><span>������ ������� �������</span></div>
  <div class="d_decription">
    <p>���������� ������!</p>
    <span>�������� � ������� ������������ ��������� ���������� � ������������� ������� � ������� ���������� � ����������. �������� ������������ ������������ �������� �������� �������� ������ � ��������� ���������� ��� ������������������� � �������-������������ �������.</span>
    <div>
      <a href="#" title="" class="d_sertificat">�����������</a>
      <a href="#" title="" class="d_discount">������ �� �������</a>
    </div>
  </div>
<?else:?>
  <?$APPLICATION->IncludeComponent("bitrix:breadcrumb","breadcrumb-left",Array(
      "START_FROM" => "0",
      "PATH" => "",
      "SITE_ID" => "TE"
    )
  );?>
<?endif;?>
<?$APPLICATION->IncludeComponent("bitrix:catalog", "catalog", Array(
    "IBLOCK_TYPE" => "catalog",	// ��� ���������
    "IBLOCK_ID" => "13",	// ��������
    "RUBRICS_IBLOCK_ID" => "16",
    "HIDE_NOT_AVAILABLE" => "N",
    "BASKET_URL" => "/personal/cart/",	// URL, ������� �� �������� � �������� ����������
    "ACTION_VARIABLE" => "action",	// �������� ����������, � ������� ���������� ��������
    "PRODUCT_ID_VARIABLE" => "id",	// �������� ����������, � ������� ���������� ��� ������ ��� �������
    "SECTION_ID_VARIABLE" => "SECTION_ID",	// �������� ����������, � ������� ���������� ��� ������
    "PRODUCT_QUANTITY_VARIABLE" => "quantity",	// �������� ����������, � ������� ���������� ���������� ������
    "ADD_PROPERTIES_TO_BASKET" => "Y",	// ��������� � ������� �������� ������� � �����������
    "PRODUCT_PROPS_VARIABLE" => "prop",	// �������� ����������, � ������� ���������� �������������� ������
    "PARTIAL_PRODUCT_PROPERTIES" => "Y",	// ��������� ��������� � ������� ������, � ������� ��������� �� ��� ��������������
    "SEF_MODE" => "Y",	// �������� ��������� ���
    "SEF_FOLDER" => "/catalog/",	// ������� ��� (������������ ����� �����)
    "AJAX_MODE" => "N",	// �������� ����� AJAX
    "AJAX_OPTION_JUMP" => "N",	// �������� ��������� � ������ ����������
    "AJAX_OPTION_STYLE" => "Y",	// �������� ��������� ������
    "AJAX_OPTION_HISTORY" => "N",	// �������� �������� ��������� ��������
    "CACHE_TYPE" => "A",	// ��� �����������
    "CACHE_TIME" => "36000000",	// ����� ����������� (���.)
    "CACHE_FILTER" => "N",	// ���������� ��� ������������� �������
    "CACHE_GROUPS" => "Y",	// ��������� ����� �������
    "SET_TITLE" => "Y",	// ������������� ��������� ��������
    "SET_STATUS_404" => "Y",	// ������������� ������ 404, ���� �� ������� ������� ��� ������
    "ADD_SECTIONS_CHAIN" => "Y",
    "ADD_ELEMENT_CHAIN" => "Y",	// �������� �������� �������� � ������� ���������
    "USE_ELEMENT_COUNTER" => "Y",	// ������������ ������� ����������
    "USE_FILTER" => "N",	// ���������� ������
    "FILTER_NAME" => "",	// ������
    "FILTER_FIELD_CODE" => array(	// ����
      0 => "",
      1 => "",
    ),
    "FILTER_PROPERTY_CODE" => array(	// ��������
      0 => "",
      1 => "",
    ),
    "FILTER_PRICE_CODE" => array(	// ��� ����
      0 => "",
    ),
    "FILTER_OFFERS_FIELD_CODE" => array(
      0 => "",
      1 => "",
      2 => "",
    ),
    "FILTER_OFFERS_PROPERTY_CODE" => array(
      0 => "",
      1 => "",
    ),
    "FILTER_VIEW_MODE" => "VERTICAL",	// ��� ����������� ������ �������
    "USE_REVIEW" => "Y",
    "MESSAGES_PER_PAGE" => "10",
    "USE_CAPTCHA" => "Y",
    "REVIEW_AJAX_POST" => "Y",
    "URL_TEMPLATES_READ" => "",
    "SHOW_LINK_TO_FORUM" => "Y",
    "POST_FIRST_MESSAGE" => "N",
    "USE_COMPARE" => "N",	// ������������ ��������� ���������
    "PRICE_CODE" => array(	// ��� ����
      0 => "",
    ),
    "USE_PRICE_COUNT" => "N",	// ������������ ����� ��� � �����������
    "SHOW_PRICE_COUNT" => "1",	// �������� ���� ��� ����������
    "PRICE_VAT_INCLUDE" => "Y",	// �������� ��� � ����
    "PRICE_VAT_SHOW_VALUE" => "N",	// ���������� �������� ���
    "PRODUCT_PROPERTIES" => "",	// �������������� ������, ����������� � �������
    "USE_PRODUCT_QUANTITY" => "Y",	// ��������� �������� ���������� ������
    "CONVERT_CURRENCY" => "Y",
    "CURRENCY_ID" => "RUB",
    "OFFERS_CART_PROPERTIES" => array(
      0 => "",
      1 => "",
      2 => "",
    ),
    "SHOW_TOP_ELEMENTS" => "N",	// �������� ��� ���������
    "SECTION_COUNT_ELEMENTS" => "N",	// ���������� ���������� ��������� � �������
    "SECTION_TOP_DEPTH" => "3",	// ������������ ������������ ������� ��������
    "SECTIONS_VIEW_MODE" => $sectionViewMode,	// ��� ������ �����������
    "SECTIONS_SHOW_PARENT_NAME" => "Y",	// ���������� �������� �������
    "PAGE_ELEMENT_COUNT" => "8",	// ���������� ��������� �� ��������
    "LINE_ELEMENT_COUNT" => "4",	// ���������� ���������, ��������� � ����� ������ �������
    "ELEMENT_SORT_FIELD" => "sort",	// �� ������ ���� ��������� ������ � �������
    "ELEMENT_SORT_ORDER" => "asc",	// ������� ���������� ������� � �������
    "ELEMENT_SORT_FIELD2" => "id",	// ���� ��� ������ ���������� ������� � �������
    "ELEMENT_SORT_ORDER2" => "desc",	// ������� ������ ���������� ������� � �������
    "LIST_PROPERTY_CODE" => array(	// ��������
      1 => "ARTICLE",
      2 => "PRODUCTION",
      3 => "H2",
      4 => "H3",
      5 => "KB_URL",
      6 => "PRICE1",
      7 => "PRICE2",
      8 => "PRICE3",
      9 => "PRICE4",
      10 => "PHOTOS",
      11 => "VIDEO_YOUTUBE",
    ),
    "INCLUDE_SUBSECTIONS" => "Y",	// ���������� �������� ����������� �������
    "LIST_META_KEYWORDS" => "",	// ���������� �������� ����� �������� �� �������� �������
    "LIST_META_DESCRIPTION" => "",	// ���������� �������� �������� �� �������� �������
    "LIST_BROWSER_TITLE" => "",	// ���������� ��������� ���� �������� �� �������� �������
    "LIST_OFFERS_FIELD_CODE" => array(
      0 => "",
      1 => "",
      2 => "",
      3 => "",
    ),
    "LIST_OFFERS_PROPERTY_CODE" => array(
      0 => "",
      1 => "",
      2 => "",
      3 => "",
      4 => "",
      5 => "",
    ),
    "LIST_OFFERS_LIMIT" => "0",
    "DETAIL_PROPERTY_CODE" => array(	// ��������
      1 => "ARTICLE",
      2 => "PRODUCTION",
      3 => "H2",
      4 => "H3",
      5 => "KB_URL",
      6 => "PRICE1",
      7 => "PRICE2",
      8 => "PRICE3",
      9 => "PRICE4",
      10 => "PHOTOS",
      11 => "VIDEO_YOUTUBE",
    ),
    "DETAIL_META_KEYWORDS" => "KEYWORDS",	// ���������� �������� ����� �������� �� ��������
    "DETAIL_META_DESCRIPTION" => "META_DESCRIPTION",	// ���������� �������� �������� �� ��������
    "DETAIL_BROWSER_TITLE" => "TITLE",	// ���������� ��������� ���� �������� �� ��������
    "DETAIL_OFFERS_FIELD_CODE" => array(
      0 => "",
      1 => "",
    ),
    "DETAIL_OFFERS_PROPERTY_CODE" => array(
      0 => "",
      1 => "",
      2 => "",
      3 => "",
      4 => "",
      5 => "",
    ),
    "SECTION_FIELDS" => array(
      "UF_SECTION"
    ),
    "LINK_IBLOCK_TYPE" => "",	// ��� ���������, �������� �������� ������� � ������� ���������
    "LINK_IBLOCK_ID" => "",	// ID ���������, �������� �������� ������� � ������� ���������
    "LINK_PROPERTY_SID" => "",	// ��������, � ������� �������� �����
    "LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",	// URL �� ��������, ��� ����� ������� ������ ��������� ���������
    "USE_ALSO_BUY" => "Y",
    "ALSO_BUY_ELEMENT_COUNT" => "3",
    "ALSO_BUY_MIN_BUYES" => "2",
    "USE_STORE" => "Y",	// ���������� ���� "���������� ������ �� ������"
    "USE_STORE_PHONE" => "Y",
    "USE_STORE_SCHEDULE" => "Y",
    "USE_MIN_AMOUNT" => "N",
    "STORE_PATH" => "/store/#store_id#",
    "MAIN_TITLE" => "������� �� �������",
    "OFFERS_SORT_FIELD" => "sort",
    "OFFERS_SORT_ORDER" => "asc",
    "OFFERS_SORT_FIELD2" => "id",
    "OFFERS_SORT_ORDER2" => "desc",
    "PAGER_TEMPLATE" => "arrows",	// ������ ������������ ���������
    "DISPLAY_TOP_PAGER" => "N",	// �������� ��� �������
    "DISPLAY_BOTTOM_PAGER" => "Y",	// �������� ��� �������
    "PAGER_TITLE" => "������",	// �������� ���������
    "PAGER_SHOW_ALWAYS" => "N",	// �������� ������
    "PAGER_DESC_NUMBERING" => "N",	// ������������ �������� ���������
    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",	// ����� ����������� ������� ��� �������� ���������
    "PAGER_SHOW_ALL" => "N",	// ���������� ������ "���"
    "ADD_PICT_PROP" => "-",	// �������������� �������� ��������� ������
    "LABEL_PROP" => "NEWPRODUCT",	// �������� ����� ������
    "PRODUCT_DISPLAY_MODE" => "Y",
    "OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
    "OFFER_TREE_PROPS" => array(
      0 => "COLOR_REF",
      1 => "SIZES_SHOES",
      2 => "SIZES_CLOTHES",
      3 => "",
    ),
    "DETAIL_DISPLAY_NAME" => "Y",	// �������� �������� ��������
    "DETAIL_ADD_DETAIL_TO_SLIDER" => "N",	// ��������� ��������� �������� � �������
    "SHOW_DISCOUNT_PERCENT" => "Y",
    "SHOW_OLD_PRICE" => "Y",
    "DETAIL_SHOW_MAX_QUANTITY" => "N",
    "MESS_BTN_BUY" => "������",	// ����� ������ "������"
    "MESS_BTN_ADD_TO_BASKET" => "� �������",	// ����� ������ "�������� � �������"
    "MESS_BTN_COMPARE" => "���������",	// ����� ������ "���������"
    "MESS_BTN_DETAIL" => "���������",	// ����� ������ "���������"
    "MESS_NOT_AVAILABLE" => "��� � �������",	// ��������� �� ���������� ������
    "TOP_VIEW_MODE" => "SECTION",
    "DETAIL_USE_VOTE_RATING" => "Y",	// �������� ������� ������
    "DETAIL_VOTE_DISPLAY_AS_RATING" => "rating",	// � �������� �������� ����������
    "DETAIL_USE_COMMENTS" => "Y",
    "DETAIL_BLOG_USE" => "Y",
    "DETAIL_VK_USE" => "N",
    "DETAIL_FB_USE" => "Y",
    "DETAIL_FB_APP_ID" => "",
    "DETAIL_BRAND_USE" => "N",
    "AJAX_OPTION_ADDITIONAL" => "",	// �������������� �������������
    "SEF_URL_TEMPLATES" => array(
      "sections" => "",
      "section" => "#SECTION_CODE#/",
      "element" => "#SECTION_CODE#/#ELEMENT_ID#/",
      "compare" => "",
    )
  ),
  false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>