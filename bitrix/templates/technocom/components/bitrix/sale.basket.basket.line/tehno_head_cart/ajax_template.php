<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
$this->IncludeLangFile('template.php');
?><a class="user__link user__link_basket" href="<?=$arParams['PATH_TO_BASKET']?>"><span><?=GetMessage('TSB1_CART')?></span><?if ($arParams['SHOW_NUM_PRODUCTS'] == 'Y' && ($arResult['NUM_PRODUCTS'] > 0 || $arParams['SHOW_EMPTY_VALUES'] == 'Y')):?> (<?=$arResult['NUM_PRODUCTS']?>)<?endif?></a><?php /*