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
        "VARIABLE_ALIASES" => Array()
    )
);?> 
</div>
   
    <div class="d_box2"> 
<?$APPLICATION->IncludeComponent("bitrix:main.register","jur",Array(
        "USER_PROPERTY_NAME" => "", 
        "SEF_MODE" => "Y", 
        "SHOW_FIELDS" => Array("NAME", "PERSONAL_PHONE", "WORK_COMPANY"),
        "REQUIRED_FIELDS" => Array("NAME", "PERSONAL_PHONE", "WORK_COMPANY"),
        "AUTH" => "Y", 
        "USE_BACKURL" => "Y", 
        "SUCCESS_PAGE" => "", 
        "SET_TITLE" => "Y", 
        "USER_PROPERTY" => Array("UF_CITY","UF_LEGAL","UF_DETAILS"),
        "SEF_FOLDER" => "/", 
        "VARIABLE_ALIASES" => Array()
    )
);?> 
 </div>
   </div>
 </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>