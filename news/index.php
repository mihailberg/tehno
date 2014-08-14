<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("�������");
?>
  <div class="d_space"></div>
<?if(LEVEL!=1)$APPLICATION->IncludeComponent("bitrix:breadcrumb","breadcrumb",Array(
    "START_FROM" => "0",
    "PATH" => "",
    "SITE_ID" => "TE"
  )
);?>
<?if(LEVEL==1):?><div class="title-line"><h1>�������</h1></div><?endif;?>
<?$APPLICATION->IncludeComponent("bitrix:news", "news", Array(
    "IBLOCK_TYPE" => "news",	// ��� ���������
    "IBLOCK_ID" => "14",	// ��������
    "NEWS_COUNT" => "0",	// ���������� �������� �� ��������
    "USE_SEARCH" => "N",	// ��������� �����
    "USE_RSS" => "N",	// ��������� RSS
    "NUM_NEWS" => "20",
    "NUM_DAYS" => "30",
    "YANDEX" => "N",
    "USE_RATING" => "N",	// ��������� �����������
    "USE_CATEGORIES" => "N",	// �������� ��������� �� ����
    "USE_FILTER" => "N",	// ���������� ������
    "SORT_BY1" => "ACTIVE_FROM",	// ���� ��� ������ ���������� ��������
    "SORT_ORDER1" => "DESC",	// ����������� ��� ������ ���������� ��������
    "SORT_BY2" => "SORT",	// ���� ��� ������ ���������� ��������
    "SORT_ORDER2" => "ASC",	// ����������� ��� ������ ���������� ��������
    "CHECK_DATES" => "Y",	// ���������� ������ �������� �� ������ ������ ��������
    "SEF_MODE" => "Y",	// �������� ��������� ���
    "SEF_FOLDER" => "/news/",	// ������� ��� (������������ ����� �����)
    "AJAX_MODE" => "N",	// �������� ����� AJAX
    "AJAX_OPTION_SHADOW" => "N",
    "AJAX_OPTION_JUMP" => "Y",	// �������� ��������� � ������ ����������
    "AJAX_OPTION_STYLE" => "Y",	// �������� ��������� ������
    "AJAX_OPTION_HISTORY" => "Y",	// �������� �������� ��������� ��������
    "CACHE_TYPE" => "Y",	// ��� �����������
    "CACHE_TIME" => "86400",	// ����� ����������� (���.)
    "CACHE_FILTER" => "N",	// ���������� ��� ������������� �������
    "CACHE_GROUPS" => "Y",	// ��������� ����� �������
    "DISPLAY_PANEL" => "N",
    "SET_TITLE" => "Y",	// ������������� ��������� ��������
    "SET_STATUS_404" => "Y",	// ������������� ������ 404, ���� �� ������� ������� ��� ������
    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// �������� �������� � ������� ���������
    "ADD_SECTIONS_CHAIN" => "N",	// �������� ������ � ������� ���������
    "ADD_ELEMENT_CHAIN" => "Y",
    "USE_PERMISSIONS" => "N",	// ������������ �������������� ����������� �������
    "PREVIEW_TRUNCATE_LEN" => "",	// ������������ ����� ������ ��� ������ (������ ��� ���� �����)
    "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",	// ������ ������ ����
    "LIST_FIELD_CODE" => array(	// ����
      0 => "",
      1 => "",
    ),
    "LIST_PROPERTY_CODE" => array(	// ��������
      0 => "",
      1 => "",
    ),
    "HIDE_LINK_WHEN_NO_DETAIL" => "Y",	// �������� ������, ���� ��� ���������� ��������
    "DISPLAY_NAME" => "Y",	// �������� �������� ��������
    "META_KEYWORDS" => "-",	// ���������� �������� ����� �������� �� ��������
    "META_DESCRIPTION" => "-",	// ���������� �������� �������� �� ��������
    "BROWSER_TITLE" => "-",	// ���������� ��������� ���� �������� �� ��������
    "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",	// ������ ������ ����
    "DETAIL_FIELD_CODE" => array(	// ����
      0 => "",
      1 => "",
    ),
    "DETAIL_PROPERTY_CODE" => array(	// ��������
      0 => "H2",
      1 => "IMAGES",
    ),
    "DETAIL_DISPLAY_TOP_PAGER" => "N",	// �������� ��� �������
    "DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",	// �������� ��� �������
    "DETAIL_PAGER_TITLE" => "�������",	// �������� ���������
    "DETAIL_PAGER_TEMPLATE" => "arrows",	// �������� �������
    "DETAIL_PAGER_SHOW_ALL" => "N",	// ���������� ������ "���"
    "DISPLAY_TOP_PAGER" => "N",	// �������� ��� �������
    "DISPLAY_BOTTOM_PAGER" => "Y",	// �������� ��� �������
    "PAGE_CHAIN" => "�������",
    "PAGER_TITLE" => "�������",	// �������� ���������
    "PAGER_SHOW_ALWAYS" => "N",	// �������� ������
    "PAGER_TEMPLATE" => "",	// ������ ������������ ���������
    "PAGER_DESC_NUMBERING" => "N",	// ������������ �������� ���������
    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",	// ����� ����������� ������� ��� �������� ���������
    "PAGER_SHOW_ALL" => "N",	// ���������� ������ "���"
    "AJAX_OPTION_ADDITIONAL" => "",	// �������������� �������������
    "SEF_URL_TEMPLATES" => array(
      "news" => "",
      "section" => "",
      "detail" => "#ELEMENT_CODE#/",
      "search" => "search/",
      "rss" => "rss/",
      "rss_section" => "#SECTION_ID#/rss/",
    ),
    "BACK_LINK_TITLE"=>"��������"
  ),
  false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>