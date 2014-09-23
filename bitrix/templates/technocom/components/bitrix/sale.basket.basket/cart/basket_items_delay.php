<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

    <table class="table__hold">
        <thead><tr><th width="1130" class="recycle-table__name">Название</th><th width="230"></th><th>Стоимость</th><th></th></tr></thead>
        <tbody>
<?
if ($normalCount > 0):
foreach($arResult["ITEMS"]["DelDelCanBuy"] as $arBasketItems)
{
//    var_dump($arUrls);
//    var_dump($arUrlTempl);
    ?>
    <?
    //Check photo
    if (strlen($arItem["PREVIEW_PICTURE_SRC"]) > 0):
        $url = $arItem["PREVIEW_PICTURE_SRC"];
    elseif (strlen($arItem["DETAIL_PICTURE_SRC"]) > 0):
        $url = $arItem["DETAIL_PICTURE_SRC"];
    else:
        $url = $templateFolder."/images/no_photo.png";
    endif;
    ?>
    <tr>
        <td class="recycle-page__name"><div><img src="<?=$url?>"><a href="<?=$arBasketItems["DETAIL_PAGE_URL"] ?>"><?echo $arBasketItems["NAME"]?></a><div class="recycle-page__art">арт. <?=$arBasketItems['PROPERTY_ARTICLE_VALUE']?></div></div></td>
        <td></td>
        <td><div data-cost="<?=$arBasketItems["PRICE_FORMATED"]?>" class="recycle-page__sum"><span><?=$arBasketItems["PRICE_FORMATED"]?></span> руб.</div></td>
        <td class="recycle-page__actions_hold">
            <a class="link__green btn__addrecycle" href="<?=str_replace("#ID#", $arBasketItems["ID"], $arUrls["add"])?>">Добавить в корзину для оформления заказа</a>
            <br />
            <a class="btn__delete" href="<?=str_replace("#ID#", $arBasketItems["ID"], $arUrls["delete"])?>" title="<?=GetMessage("SALE_DELETE_PRD")?>"><?=GetMessage("SALE_DELETE")?></a>
        </td>
    </tr>

    <?php /*

    <tr>
        <?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
            <td><?
                if (strlen($arBasketItems["DETAIL_PAGE_URL"])>0):
                ?><a href="<?echo $arBasketItems["DETAIL_PAGE_URL"] ?>"><?
                    endif;
                    ?><b><?echo $arBasketItems["NAME"]?></b><?
                    if (strlen($arBasketItems["DETAIL_PAGE_URL"])>0):
                    ?></a><?
            endif;
            ?></td>
        <?endif;?>
        <?if (in_array("PROPS", $arParams["COLUMNS_LIST"])):?>
            <td>
                <?
                foreach($arBasketItems["PROPS"] as $val)
                {
                    echo $val["NAME"].": ".$val["VALUE"]."<br />";
                }
                ?>
            </td>
        <?endif;?>
        <?if (in_array("PRICE", $arParams["COLUMNS_LIST"])):?>
            <td align="right"><?=$arBasketItems["PRICE_FORMATED"]?></td>
        <?endif;?>
        <?if (in_array("TYPE", $arParams["COLUMNS_LIST"])):?>
            <td><?echo $arBasketItems["NOTES"]?></td>
        <?endif;?>
        <?if (in_array("QUANTITY", $arParams["COLUMNS_LIST"])):?>
            <td align="center"><?echo $arBasketItems["QUANTITY"]?></td>
        <?endif;?>
        <?if (in_array("DELETE", $arParams["COLUMNS_LIST"])):?>
            <td align="center"><input type="checkbox" name="DELETE_<?echo $arBasketItems["ID"] ?>" value="Y"></td>
        <?endif;?>
        <?if (in_array("DELAY", $arParams["COLUMNS_LIST"])):?>
            <td align="center"><input type="checkbox" name="DELAY_<?echo $arBasketItems["ID"] ?>" value="Y" checked></td>
        <?endif;?>
        <?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
            <td align="right"><?echo $arBasketItems["WEIGHT_FORMATED"] ?></td>
        <?endif;?>
    </tr>

<?
 */
}
?>
<?
else:
    ?>
    <tr>
        <td colspan="<?=$numCells?>" style="text-align:center"><br />
            <div class=""><?=GetMessage("SALE_NO_ITEMS");?></div>
        </td>
    </tr>
<?
endif;
?>
        </tbody>
    </table>




<? /*





    <b><?= GetMessage("SALE_OTLOG_TITLE")?></b><br /><br />
<table class="sale_basket_basket data-table">
	<tr>
		<?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
			<th align="center"><?= GetMessage("SALE_NAME")?></th>
		<?endif;?>
		<?if (in_array("PROPS", $arParams["COLUMNS_LIST"])):?>
			<th align="center"><?= GetMessage("SALE_PROPS")?></th>
		<?endif;?>
		<?if (in_array("PRICE", $arParams["COLUMNS_LIST"])):?>
			<th align="center"><?= GetMessage("SALE_PRICE")?></th>
		<?endif;?>
		<?if (in_array("TYPE", $arParams["COLUMNS_LIST"])):?>
			<th align="center"><?= GetMessage("SALE_PRICE_TYPE")?></th>
		<?endif;?>
		<?if (in_array("QUANTITY", $arParams["COLUMNS_LIST"])):?>
			<th align="center"><?= GetMessage("SALE_QUANTITY")?></th>
		<?endif;?>
		<?if (in_array("DELETE", $arParams["COLUMNS_LIST"])):?>
			<th align="center"><?= GetMessage("SALE_DELETE")?></th>
		<?endif;?>
		<?if (in_array("DELAY", $arParams["COLUMNS_LIST"])):?>
			<th align="center"><?= GetMessage("SALE_OTLOG")?></th>
		<?endif;?>
		<?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
			<th align="center"><?= GetMessage("SALE_WEIGHT")?></th>
		<?endif;?>
	</tr>
	<?
	foreach($arResult["ITEMS"]["DelDelCanBuy"] as $arBasketItems)
	{
		?>
		<tr>
			<?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
				<td><?
				if (strlen($arBasketItems["DETAIL_PAGE_URL"])>0):
					?><a href="<?echo $arBasketItems["DETAIL_PAGE_URL"] ?>"><?
				endif;
				?><b><?echo $arBasketItems["NAME"]?></b><?
				if (strlen($arBasketItems["DETAIL_PAGE_URL"])>0):
					?></a><?
				endif;
				?></td>
			<?endif;?>
			<?if (in_array("PROPS", $arParams["COLUMNS_LIST"])):?>
				<td>
				<?
				foreach($arBasketItems["PROPS"] as $val)
				{
					echo $val["NAME"].": ".$val["VALUE"]."<br />";
				}
				?>
				</td>
			<?endif;?>
			<?if (in_array("PRICE", $arParams["COLUMNS_LIST"])):?>
				<td align="right"><?=$arBasketItems["PRICE_FORMATED"]?></td>
			<?endif;?>
			<?if (in_array("TYPE", $arParams["COLUMNS_LIST"])):?>
				<td><?echo $arBasketItems["NOTES"]?></td>
			<?endif;?>
			<?if (in_array("QUANTITY", $arParams["COLUMNS_LIST"])):?>
				<td align="center"><?echo $arBasketItems["QUANTITY"]?></td>
			<?endif;?>
			<?if (in_array("DELETE", $arParams["COLUMNS_LIST"])):?>
				<td align="center"><input type="checkbox" name="DELETE_<?echo $arBasketItems["ID"] ?>" value="Y"></td>
			<?endif;?>
			<?if (in_array("DELAY", $arParams["COLUMNS_LIST"])):?>
				<td align="center"><input type="checkbox" name="DELAY_<?echo $arBasketItems["ID"] ?>" value="Y" checked></td>
			<?endif;?>
			<?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
				<td align="right"><?echo $arBasketItems["WEIGHT_FORMATED"] ?></td>
			<?endif;?>
		</tr>
		<?
	}
	?>
</table>
<br />
<div width="30%">
	<input type="submit" value="<?= GetMessage("SALE_REFRESH")?>" name="BasketRefresh"><br />
	<small><?= GetMessage("SALE_REFRESH_DESCR")?></small><br />
</div>
<br />
<?
 */