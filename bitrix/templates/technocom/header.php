<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();?>
<?IncludeTemplateLangFile(__FILE__);?>
<?define("LEVEL",count(explode("/", trim($APPLICATION->GetCurPage(), "/"))));?>
<!doctype html>
<html>
<head>
    <title><?$APPLICATION->ShowTitle();?></title>
    <link rel="icon" type="image/png" href="<?=SITE_TEMPLATE_PATH;?>/favicon.png" />
    <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH;?>/zoom.php?r=<?=mt_rand(0, 9999999999);?>" type="text/css" >
    <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH;?>/js/lib/fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" >
    <?$APPLICATION->ShowHead();?>
</head>
<body>
<?$APPLICATION->ShowPanel();?>
<div class="out">
    <div class="header">
        <a href="/" class="logo"></a>

        <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/header_address.php");?>

        <!-- User block. center -->

        <div class="header__right user">

            <? if($USER->IsAuthorized()):?>
              <?$res = $USER -> GetByID($USER -> GetID()); $usr = $res -> Fetch();?>
            <div class="user__row">
                <a class="user__link user__link_company" href="/profile/"> <span> <?if($usr["UF_LEGAL"]){ echo $usr["WORK_COMPANY"]; }else{ echo $usr["NAME"]; };?> </span> </a>
            </div>
            <div class="user__row user__row_mod">
                <?$APPLICATION->IncludeComponent(
                    "tehno:sale.basket.basket.line",
                    "tehno_head_cart",
                    array(
                        "PATH_TO_BASKET" => SITE_DIR."cart/",
                        "PATH_TO_PERSONAL" => SITE_DIR."profile/",
                        "SHOW_PERSONAL_LINK" => "N",
                        "SHOW_NUM_PRODUCTS" => "Y",
                        "SHOW_TOTAL_PRICE" => "N",
                        "SHOW_EMPTY_VALUES" => "N",
                        "SHOW_PRODUCTS" => "N",
                        "POSITION_FIXED" => "N",
                        "PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
                        "SHOW_DELAY" => "Y",
                        "SHOW_NOTAVAIL" => "Y",
                        "SHOW_SUBSCRIBE" => "Y",
                        "SHOW_IMAGE" => "Y",
                        "SHOW_PRICE" => "Y",
                        "SHOW_SUMMARY" => "Y"
                    ),
                    false
                );?>
                <a class="user__link user__link_mail" href="/profile"><span>Сообщения</span> (4)</a>
                <a class="user__link user__link_grey" href="/profile/?logout=yes"><span>Выход</span></a>
            </div>
            <div class="user__row">
                <a class="user__link user__link_grey user__link_pad" href="/cart#delayed"><span>Отложено</span> (4)</a>
            </div>

            <?else:?>
            <div class="user__row">

            </div>
            <div class="user__row user__row_mod">
                <?$APPLICATION->IncludeComponent(
                "bitrix:sale.basket.basket.line",
                "tehno_head_cart",
                array(
                    "PATH_TO_BASKET" => SITE_DIR."cart/",
                    "PATH_TO_PERSONAL" => SITE_DIR."profile/",
                    "SHOW_PERSONAL_LINK" => "N",
                    "SHOW_NUM_PRODUCTS" => "Y",
                    "SHOW_TOTAL_PRICE" => "N",
                    "SHOW_EMPTY_VALUES" => "N",
                    "SHOW_PRODUCTS" => "N",
                    "POSITION_FIXED" => "N",
                    "PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
                    "SHOW_DELAY" => "Y",
                    "SHOW_NOTAVAIL" => "Y",
                    "SHOW_SUBSCRIBE" => "Y",
                    "SHOW_IMAGE" => "Y",
                    "SHOW_PRICE" => "Y",
                    "SHOW_SUMMARY" => "Y"
                ),
                false
            );?>
                <a class="user__link user__link_mail_reg" href="/registration"><span>Регистрация</span></a>
                <a class="user__link user__link_grey" href="/profile"><span>Вход</span></a>
            </div>
            <div class="user__row">
                 <a class="user__link user__link_grey user__link_pad" href="/cart#delayed"><span>Отложено</span> (4)</a>
            </div>
        <?endif;?>
        </div>

    </div>
    <div class="menu<?if($APPLICATION -> GetCurPage() == "/")echo " main";?>">
        <div class="catalog">
            <a href="/catalog/" class="catalog__anchor">Каталог товаров</a>
            <div class="catalog__block">
                <div class="catalog__top">
                  <form method="get" action="/search/">
                    <div class="catalog__search">
                      <input type="text" class="input" placeholder="Введите название или код товара" name="q" value="<?=$arResult["REQUEST"]["QUERY"]?>">
                    </div>
                    <button class="btn" type="submit">Найти</button>
                  </form>
                </div>
                <div class="catalog__bottom">
                    <?$APPLICATION->IncludeComponent("bitrix:menu","header-catalog",Array(
                            "ROOT_MENU_TYPE" => "catalog-1",
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "catalog-1",
                            "USE_EXT" => "Y",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "Y",
                            "MENU_CACHE_TYPE" => "Y",
                            "MENU_CACHE_TIME" => "2592000",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => ""
                        )
                    );?>
                    <?$APPLICATION->IncludeComponent("bitrix:menu","header-catalog",Array(
                            "ROOT_MENU_TYPE" => "catalog-2",
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "catalog-2",
                            "USE_EXT" => "Y",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "Y",
                            "MENU_CACHE_TYPE" => "Y",
                            "MENU_CACHE_TIME" => "2592000",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => ""
                        )
                    );?>
                    <?$APPLICATION->IncludeComponent("bitrix:menu","header-catalog",Array(
                            "ROOT_MENU_TYPE" => "catalog-3",
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "catalog-3",
                            "USE_EXT" => "Y",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "Y",
                            "MENU_CACHE_TYPE" => "Y",
                            "MENU_CACHE_TIME" => "2592000",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => ""
                        )
                    );?>
                    <?$APPLICATION->IncludeComponent("bitrix:menu","header-catalog",Array(
                            "ROOT_MENU_TYPE" => "catalog-4",
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "catalog-4",
                            "USE_EXT" => "Y",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "Y",
                            "MENU_CACHE_TYPE" => "Y",
                            "MENU_CACHE_TIME" => "2592000",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => ""
                        )
                    );?>
                </div>
            </div>
        </div>
        <?$APPLICATION->IncludeComponent("bitrix:menu","header",Array(
                "ROOT_MENU_TYPE" => "header",
                "MAX_LEVEL" => "1",
                "CHILD_MENU_TYPE" => "header",
                "USE_EXT" => "Y",
                "DELAY" => "N",
                "ALLOW_MULTI_SELECT" => "Y",
                "MENU_CACHE_TYPE" => "Y",
                "MENU_CACHE_TIME" => "2592000",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "MENU_CACHE_GET_VARS" => ""
            )
        );?>
    </div>