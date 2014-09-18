<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
 
<?if(!empty($arResult['ERRORS']['FATAL'])):?>

	<?foreach($arResult['ERRORS']['FATAL'] as $error):?>
		<?=ShowError($error)?>
	<?endforeach?>

<?else:?>

	<?if(!empty($arResult['ERRORS']['NONFATAL'])):?>

		<?foreach($arResult['ERRORS']['NONFATAL'] as $error):?>
			<?=ShowError($error)?>
		<?endforeach?>

	<?endif?>
 
    <table class="cabinet__table">
        <tr>
            <th width="300">№ заказа</th>
            <th width="230">Дата</th>
            <th width="590">Статус</th>
            <th>
                <?if($_REQUEST['filter_history'] != 'Y'):?>Оплата<?endif?>
            </th>
        </tr>
        
        <?foreach($arResult["ORDER_BY_STATUS"] as $key => $group):?>
            <?foreach($group as $k => $order):?>
                <tr>
                    <td>
                        <a href="<?=$order["ORDER"]["URL_TO_DETAIL"]?>"><?=$order["ORDER"]["ACCOUNT_NUMBER"]?></a>
                    </td>
                    <td><?=date('d.m.y', strtotime($order["ORDER"]["DATE_INSERT_FORMATED"]));?></td>
                    <td>
                        <span>
                            <?
                                if($arResult["INFO"]["STATUS"][$key]["ID"] == 'P'){
                                    echo '<font color="green">Оплачен, ждет отгрузку</font>';
                                }else if($arResult["INFO"]["STATUS"][$key]["ID"] == 'X'){
                                    echo '<font color="red">Отменен</font>';
                                }else if($arResult["INFO"]["STATUS"][$key]["ID"] == 'F'){
                                    echo '<font color="green">Выполнен</font>';
                                }else if($arResult["INFO"]["STATUS"][$key]["ID"] == 'N'){
                                    echo '<font color="green">Новый</font>';
                                }else {
                                    echo '<font color="red">Отменен</font>';
                                }
                            ?>                                           
                        </span>
                    </td>
                    <td>
                        <?if($_REQUEST['filter_history'] != 'Y'):?>
                            <?
                                if($arResult["INFO"]["STATUS"][$key]["ID"] == 'P'){
                                    echo date('d.m.y', strtotime($order["ORDER"]["DATE_PAYED"]));
                                }
                            ?>
                        <?endif?> 
                    </td>
                </tr>
            <?endforeach?>
        <?endforeach?>
        
        <?if(strlen($arResult['NAV_STRING'])):?>
			<?=$arResult['NAV_STRING']?>
		<?endif?>                
    </table>

    
<?endif?>


