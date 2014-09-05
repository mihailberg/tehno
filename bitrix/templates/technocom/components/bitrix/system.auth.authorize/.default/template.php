<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?
ShowMessage($arParams["~AUTH_RESULT"]);
ShowMessage($arResult['ERROR_MESSAGE']);

?>

<div id="auth_blk" class="bx-auth">
<?if($arResult["AUTH_SERVICES"]):?>
	<div class="vik-order__title">�������������</div>
<?endif?>   
    <div class="vik-order-identification_bg">
    	<form class="form-validate" name="form_auth" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">           
            <div class="vik-order__title-sm">� ��� ���������������</div>
            <p>
                ������� �����(��������� � ����������� ������) � ������,
                <br>
                ������� ���� �������� ��� �����������.
            </p>           

    		<input type="hidden" name="AUTH_FORM" value="Y" />
    		<input type="hidden" name="TYPE" value="AUTH" />
    		<?if (strlen($arResult["BACKURL"]) > 0):?>
    		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
    		<?endif?>
    		<?foreach ($arResult["POST"] as $key => $value):?>
    		<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
    		<?endforeach?>   

            <div class="vik-order__form-col clearfix">
				<label class="bx-auth-label"><?=GetMessage("AUTH_LOGIN")?></label>
				<div class="vik-order__form-col_right">
                    <input class="vik-inptxt-style" type="text" name="USER_LOGIN" maxlength="255" value="<?=$arResult["LAST_LOGIN"]?>" />
                    <span class="vik-order__form-col_sm">������� ����������� �����, ��������� ��� �����������</span>
                </div>
            </div>
            <div class="vik-order__form-col clearfix">
                <label class="bx-auth-label"><?=GetMessage("AUTH_PASSWORD")?></label>	
    			<div class="vik-order__form-col_right">
                    <input class="vik-inptxt-style" type="password" name="USER_PASSWORD" maxlength="255" />
                    <?if ($arParams["NOT_SHOW_LINKS"] != "Y"):?>
                        <a class="vik-forgott-pass" href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>">� ����� ������!</a>
                    <?endif?>
                    <span class="vik-order__form-col_sm">������� ������ ������� ������ ��������</span>
                </div>	
    		</div>
            <div class="vik-order__form-col vik-order__form-col_btn clearfix">
    		    <input class="vik-btn-large vik-btn-disable" type="submit" name="Login" value="<?=GetMessage("AUTH_AUTHORIZE")?>" />
                <span class="vik-order__form-col_btn-sm">
                    ���
                    <a href="#">�������� �����</a>
                </span>  
            </div>	
    				
	
            
        </form>
     </div>
</div>

<script type="text/javascript">
<?if (strlen($arResult["LAST_LOGIN"])>0):?>
try{document.form_auth.USER_PASSWORD.focus();}catch(e){}
<?else:?>
try{document.form_auth.USER_LOGIN.focus();}catch(e){}
<?endif?>
</script>


