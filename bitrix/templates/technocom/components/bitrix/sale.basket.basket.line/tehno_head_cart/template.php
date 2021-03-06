<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$style = 'bx_cart_block';

if ($arParams['SHOW_PRODUCTS'] == 'Y')
	$style .= ' bx_cart_sidebar';

if ($arParams['POSITION_FIXED'] == 'Y')
{
	$style .= " bx_cart_fixed {$arParams['POSITION_HORIZONTAL']} {$arParams['POSITION_VERTICAL']}";
	if ($arParams['SHOW_PRODUCTS'] == 'Y')
		$style .= ' close';
}
?>
		<?require(realpath(dirname(__FILE__)).'/ajax_template.php')?>
<script>
	sbbl.elemBlock = BX('bx_cart_block');

	sbbl.ajaxPath = '<?=$componentPath?>/ajax.php';
	sbbl.siteId = '<?=SITE_ID?>';
	sbbl.templateName = '<?=$templateName?>';
	sbbl.arParams = <?=CUtil::PhpToJSObject ($arParams)?>;

	BX.addCustomEvent(window, 'OnBasketChange', sbbl.refreshCart);

	<?if ($arParams['POSITION_FIXED'] == 'Y'):?>
		sbbl.elemStatus = BX('bx_cart_block_status');
		sbbl.strCollapse = '<?=GetMessage('TSB1_COLLAPSE')?>';
		sbbl.strExpand = '<?=GetMessage('TSB1_EXPAND')?>';
		sbbl.bClosed = true;

		sbbl.elemProducts = BX('bx_cart_block_products');
		sbbl.bMaxHeight = false;
		sbbl.strVertical = '<?=$arParams['POSITION_VERTICAL']?>';
		sbbl.strHorizontal = '<?=$arParams['POSITION_HORIZONTAL']?>';

		<?if ($arParams['POSITION_VERTICAL'] == 'top'):?>
			BX.addCustomEvent(window, 'onTopPanelCollapse', sbbl.fixCart);
		<?endif?>

		sbbl.fixCart();

		sbbl.resizeTimer = null;
		BX.bind(window, 'resize', function() {
			clearTimeout(sbbl.resizeTimer);
			sbbl.resizeTimer = setTimeout(sbbl.fixCart, 500);
		});
	<?endif?>

</script>