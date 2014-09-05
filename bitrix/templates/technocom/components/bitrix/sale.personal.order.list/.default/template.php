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
    
    <?//if(!empty($arResult['ORDERS'])):?>
    
        <div class="cabinet__title cabinet__title_middle">Ваши заказы</div>     
        <div class="x_tabs">
            <div class="x_tabs__links">
                <a class="selected" href="#">
                    <span>Текущие</span>
                </a>
                <a href="#">
                    <span>Архив</span>
                </a>
            </div>
            <div class="Ajax_load">            
                <div class="x_tabs__item selected">
                    <table class="cabinet__table">
                        <tr>
                            <th width="300">№ заказа</th>
                            <th width="230">Дата</th>
                            <th width="590">Статус</th>
                            <th>Оплата</th>
                        </tr>
                        
                        <?foreach($arResult["ORDER_BY_STATUS"] as $key => $group):?>
                            <?foreach($group as $k => $order):?>
                                <tr>
                                    <td>
                                        <a href="<?=$order["ORDER"]["URL_TO_DETAIL"]?>"><?=$order["ORDER"]["ACCOUNT_NUMBER"]?></a>
                                    </td>
                                    <td><?=$order["ORDER"]["DATE_INSERT_FORMATED"];?></td>
                                    <td>
                                        <span>
                                            <?
                                                if($arResult["INFO"]["STATUS"][$key]["ID"] == 'P'){
                                                    echo '<font color="green">Оплачен, ждет отгрузку</font>';
                                                }else if($arResult["INFO"]["STATUS"][$key]["ID"] == 'X'){
                                                    echo '<font color="red">Отменен</font>';
                                                }else if($arResult["INFO"]["STATUS"][$key]["ID"] == 'F'){
                                                    echo '<font color="green">Выполнен</font>';
                                                }else{
                                                    echo '<font color="red">Отгружен, не оплачен</font>';
                                                }
                                            ?>                                           
                                        </span>
                                    </td>
                                    <td>
                                        <?
                                            if($arResult["INFO"]["STATUS"][$key]["ID"] == 'P'){
                                                echo $order["ORDER"]["DATE_PAYED"];
                                            }
                                        ?>
                                    </td>
                                </tr>
                            <?endforeach?>
                        <?endforeach?>
                        
                        <?if(strlen($arResult['NAV_STRING'])):?>
                			<?=$arResult['NAV_STRING']?>
                		<?endif?>                
                    </table>
                </div>
                <div class="x_tabs__item">   
                    <table class="cabinet__table">
                        <tr>
                            <th width="300">№ заказа</th>
                            <th width="230">Дата</th>
                            <th>Статус</th>
                        </tr>
                        <!--
                        <?foreach($arResult["ORDER_BY_STATUS"] as $key => $group):?>
                            <?foreach($group as $k => $order):?>
                                <tr>
                                    <td>
                                        <a href="<?=$order["ORDER"]["URL_TO_DETAIL"]?>"><?=$order["ORDER"]["ACCOUNT_NUMBER"]?></a>
                                    </td>
                                    <td><?=$order["ORDER"]["DATE_INSERT_FORMATED"];?></td>
                                    <td>
                                        <span class="<?=$arResult["INFO"]["STATUS"][$key]['COLOR']?><?/*yellow*/ /*red*/ /*green*/ /*gray*/?>"><?=$arResult["INFO"]["STATUS"][$key]["NAME"]?></span>
                                    </td>
                                </tr>
                            <?endforeach?>
                        <?endforeach?>
                        -->
                        <?if(strlen($arResult['NAV_STRING'])):?>
                			<?=$arResult['NAV_STRING']?>
                		<?endif?>                   
                    </table>                           
                </div>
            </div>                
        </div>
        
        <?
            $query = "SELECT * FROM b_order_mess_status WHERE USER_ID = {$_SESSION['SESS_AUTH']['USER_ID']}"; 
            $res = mysql_query($query) or die(mysql_error());
        ?>
        <div class="cabinet__title cabinet__title_middle">Ваши сообщения</div>
        <table class="cabinet__table">
            <tr>
                <th width="530">Тема:</th>
                <th width="590">Отправитель:</th>
                <th>Дата</th>
            </tr>
            <?while($value = mysql_fetch_array($res)):?>
                <tr>
                    <td>Заказ №<?=$value['ORDER_ID']?> 
                        <? 
                            if($value['STATUS'] == 'N'){
                                echo ' принят в обработку!';
                            }else if($value['STATUS'] == 'X'){
                                echo ' отменен!';
                            }else{
                                echo ' отгружен!';
                            }
                        ?>
                    </td>
                    <td><?=$value['SENDER']?></td>                    
                    <td>
                        <?=$value['DATE']?> 
                        <a class="fr delete_order_mess" style="cursor: pointer;">удалить</a>
                        <span class="mess_id" style="display: none;"><?=$value['ID']?></span>
                    </td>
                </tr> 
            <?endwhile?>             
        </table> 
        
	<?//endif?>
    
<?endif?>


