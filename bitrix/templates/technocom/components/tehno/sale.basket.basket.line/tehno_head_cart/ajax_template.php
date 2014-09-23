<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
$this->IncludeLangFile('template.php');
?><a class="user__link user__link_basket" href="<?=$arParams['PATH_TO_BASKET']?>"><span class="b"><?=GetMessage('TSB1_CART')?></span> (<span class="js-add2basket-counter"><?=$arResult['NUM_PRODUCTS']?></span>)</a><?php /*