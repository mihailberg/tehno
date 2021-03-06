<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="product-detail">
  <div class="product-detail__head clearfix">
    <div class="product-detail__lhead">
      <h1><?=$arResult["NAME"]?></h1>
      <div class="product-detail__art">���. <?=$arResult["DISPLAY_PROPERTIES"]["ARTICLE"]["VALUE"]?></div>
    </div>
      <?if(!empty($arResult['DISPLAY_PROPERTIES']['R_HEAD']['DISPLAY_VALUE'])):?>
          <div class="product-detail__rhead">
              <?=$arResult['DISPLAY_PROPERTIES']['R_HEAD']['DISPLAY_VALUE']?>
          </div>
      <?endif;?>
  </div>
  <div class="product-detail__body clearfix">
    <div class="product-detail__left">
      <div class="product-detail__pics">
        <div class="product-detail__image">
          <a class="fancybox" href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" rel="product__pics"><img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" ></a>
        </div>
        <?if(!empty($arResult["PROPERTIES"]["PHOTOS"]["VALUE"])):?>
          <ul class="clearfix">
            <?foreach($arResult["PROPERTIES"]["PHOTOS"]["VALUE"] as $arItem):$path=CFile::GetPath($arItem);?>
              <li><a class="fancybox" href="<?=$path?>" rel="product__pics"><img src="<?=$path?>" /></a></li>
            <?endforeach;?>
          </ul>
        <?endif;?>
      </div>
      <?if(!empty($arResult['DISPLAY_PROPERTIES']['VIDEO_YOUTUBE']['VALUE'])):?>
        <div class="product-detail__ltitle">�����</div>
        <iframe width="592" height="333" src="//<?=$arResult['DISPLAY_PROPERTIES']['VIDEO_YOUTUBE']['VALUE']?>" frameborder="0" allowfullscreen></iframe>
      <?endif;?>
    </div>
    <div class="product-detail__right">
      <?if(!empty($arResult['DISPLAY_PROPERTIES']['H2']['VALUE'])):?>
        <h2><?=$arResult['DISPLAY_PROPERTIES']['H2']['VALUE']?></h2>
      <?endif;?>
        <?
        global $USER;
        if($USER->IsAuthorized()){
            //���������� ����
            $p = CCatalogProduct::GetOptimalPrice($arResult['ID']);
            $price = $p['PRICE']['PRICE'];
        } else {
            $prices = GetCatalogProductPriceList($arResult['ID']);
        }
        ?>

      <?if(!empty($arResult['DISPLAY_PROPERTIES']['H3']['VALUE'])):?>
        <h3><?=$arResult['DISPLAY_PROPERTIES']['H2']['VALUE']?></h3>
      <?endif;?>
      <?if($USER->IsAuthorized()): // ���� ������������ �����������, ������� ���� ���� ?>
          <div class="product-detail__cost"><span><?=$price?></span> <span class="product-detail__currency"></span><a class="btn btn_green btn_big js-add2basket" data-id="<?=$arResult['ID']?>" href="<?=$arResult['ADD_URL']?>">� �������</a> <a href="#" class="btn btn_silver btn_middle">��������</a> <a href="#" class="btn btn_blue btn_middle"><i class="callback__pic"></i>��������� ���</a></div>
      <? else: //���� �� ����������� ������� ���� 0 ����� ���� 1?>
          <div class="product-detail__cost"><span><?=(int)$prices[0]["PRICE"]?></span> <span class="product-detail__currency"></span><a class="btn btn_green btn_big js-add2basket" href="<?=$arResult['ADD_URL']?>">� �������</a> <a href="#" class="btn btn_silver btn_middle">��������</a> <a href="#" class="btn btn_blue btn_middle"><i class="callback__pic"></i>��������� ���</a></div>
          <div class="product-detail__cost_after">���� ����� <a href="/registration">�����������</a> <span><?=(int)$prices[1]["PRICE"]?> P</span></div>
      <?endif;?>
      <?if(!empty($arResult['DISPLAY_PROPERTIES']['COUNT']['VALUE'])):?>
        <!--<div class="product-detail__exist">� �������: ��.</div>-->
      <?endif;?>
      <div class="product-detail__notexist">
        ��� � ������� ��� ����� ������? ��� �������
        <div>������ <a href="#">��������� � ����</a> � �� �������� ����� �����.</div>
      </div>
      <div class="product-detail__text"><?=$arResult['DETAIL_TEXT']?></div>
    </div>
  </div>
</div>