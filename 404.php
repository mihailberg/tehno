<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');
CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("������ 404");
?>
  <div class="page_not">
  <div class="text_err">404</div>
  <div class="title-not">����� �������� �� ���������� <br/>��� ��� ���� �������</div>
  <div class="info_search">�������������� ������� ��� �������� ������������ ������.</div>
  <div class="catalog__top">
    <div class="catalog__search">
      <input type="text" class="input" placeholder="������� �������� ��� ��� ������">
    </div>
    <button class="btn">�����</button>
  </div>
  <!-- BEGIN footer -->
  <footer class="footer not_found">
    <div class="footer__catalog not_found">
      <ul>
        <li><a href="#">���������� � ����������</a></li>
        <li><a href="#">��������</a></li>
        <li><a href="#">������������������� ���������</a></li>
        <li><a href="#">����������-������������ ���������</a></li>
        <li><a href="#">����������� ������</a></li>
        <li><a href="#">������������ ������</a></li>
        <li><a href="#">������� ����, ���� � ����������</a></li>
        <li><a href="#">�������� � ��������</a></li>
        <li><a href="#">��������</a></li>
        <li><a href="#">��������������</a></li>
      </ul>
      <ul>
        <li><a href="#">�������������� ���</a></li>
        <li><a href="#">������������ ������</a></li>
        <li><a href="#">������ ��� ������ ���</a></li>
        <li><a href="#">�������� �������</a></li>
        <li><a href="#">��������</a></li>
        <li><a href="#">�������� (����� � �������)</a></li>
        <li><a href="#">������� ���������� � ������</a></li>
        <li><a href="#">������������ ��������</a></li>
        <li><a href="#">���������</a></li>
        <li><a href="#">��������������� ���������� (���)</a></li>
      </ul>
      <ul>
        <li><a href="#">�������� ������������ ��� ����������� �������</a></li>
        <li><a href="#">������������� �����</a></li>
        <li><a href="#">���� � �����</a></li>
        <li><a href="#">���� ��������</a></li>
        <li><a href="#">���� �����������������</a></li>
        <li><a href="#">�������� � ������������</a></li>
        <li><a href="#">��������� ������ � �����</a></li>
        <li><a href="#">������ � ������</a></li>
        <li><a href="#">����������</a></li>
        <li><a href="#">����������</a></li>
      </ul>
      <ul>
        <li><a href="#">������� � ����������</a></li>
        <li><a href="#">����� � ������</a></li>
        <li><a href="#">��������� ����������</a></li>
        <li><a href="#">������������������ ����������</a></li>
        <li><a href="#">�������</a></li>
        <li><a href="#">������� �����������</a></li>
        <li><a href="#">��������� �������</a></li>
        <li><a href="#">������</a></li>
        <li><a href="#">������</a></li>
        <li><a href="#">������ �� �������</a></li>
      </ul>
    </div>
  </footer>
  <!-- END footer -->
<?
$APPLICATION->IncludeFile(
  SITE_TEMPLATE_PATH."/include/cycle.php",
  array(
    "CAPTION_TYPE"=>"LINE-BLUE",
    "CAPTION_NAME"=>"��� ����� ���� ���������"
  )
);
?>
<?
$APPLICATION->IncludeFile(
  SITE_TEMPLATE_PATH."/include/cycle.php",
  array("CAPTION_TYPE"=>"LINE-YELLOW")
);
?>
  </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>