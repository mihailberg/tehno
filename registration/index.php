<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("�����������");
?> 
<div class="d_space"></div>
 
<div class="title-line"> 
  <h1>�����������</h1>
 </div>
 
<div class="d_reg-bg"> 
  <div class="d_regtext"> 
    <div class="d_regbox1"> 
      <p>��� ��� ���� �����������?</p>
     
      <ul> 
        <li>�������� ��������� <a href="#" >������ 3%</a> �������� ��� ���� ��� �����������</li>
       
        <li>��������� ���������� ������� ������������� ������</li>
       
        <li>������������� ���� ������ � ������������ �� ���������</li>
       
        <li>��������� ����� ������ ������� � �������, �������� � �����������</li>
       
        <li><strong>������������ �������� �������� �� ����� ����� ����� � ������ � ����� ����</strong> </li>
       </ul>
     </div>
   
    <div class="d_regbox2"> 
      <p>��� ������ ����� ������!</p>
     
      <ul> 
        <li>������ ��������� ����� ���� ���� � ������ ������������������ �������� ������ ��������</li>
       
        <li>����������� ����� ������ � ������� <strong>����� � ������������</strong>. ���� ����������� ������ � ��������������, � ����������� ������ � ������ �������</li>
       
        <li>��� ������ ����� <strong>1-2 ������</strong>, ����� ���� �� �������� ������ � ������� ��������</li>
       </ul>
     </div>
   </div>
	<div>

</div>
  <div class="d_regtabs"> <button class="d_pushone"><span>� ������� ����</span></button> <button class="d_pushtwo"><span>� ����������� 
        <br />
       �����������</span></button> 
    <div class="d_box1"> 
<?$APPLICATION->IncludeComponent("bitrix:main.register","fiz",Array(
        "USER_PROPERTY_NAME" => "", 
        "SEF_MODE" => "Y", 
        "SHOW_FIELDS" => Array("NAME", "PERSONAL_PHONE"),
        "REQUIRED_FIELDS" => Array("NAME", "PERSONAL_PHONE"),
        "AUTH" => "Y", 
        "USE_BACKURL" => "Y", 
        "SUCCESS_PAGE" => "", 
        "SET_TITLE" => "Y", 
        "USER_PROPERTY" => Array("UF_CITY"),
        "SEF_FOLDER" => "/", 
        "VARIABLE_ALIASES" => Array(),
    "FORM_TYPE" => "FIZ"
    )
);?> 
</div>
   
    <div class="d_box2"> 
<?$APPLICATION->IncludeComponent(
	"bitrix:main.register", 
	"jur", 
	array(
		"USER_PROPERTY_NAME" => "",
		"SEF_MODE" => "Y",
		"SHOW_FIELDS" => array(
			0 => "NAME",
			1 => "PERSONAL_PHONE",
			2 => "WORK_COMPANY",
		),
		"REQUIRED_FIELDS" => array(
			0 => "NAME",
			1 => "PERSONAL_PHONE",
			2 => "WORK_COMPANY",
		),
		"AUTH" => "Y",
		"USE_BACKURL" => "Y",
		"SUCCESS_PAGE" => "",
		"SET_TITLE" => "Y",
		"USER_PROPERTY" => array(
			0 => "UF_LEGAL",
			1 => "UF_DETAILS",
			2 => "UF_CITY",
		),
		"SEF_FOLDER" => "/",
		"FORM_TYPE" => "JUR"
	),
	false
);?> 
 </div>
   </div>
 </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>