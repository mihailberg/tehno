<?php
//Подключаем IBlock
CModule::IncludeModule('iblock');

//DEBUG
ini_set("display_errors",1);

//Определяем регион
if(CModule::IncludeModule("altasib.geoip"))
{
    $arData = ALX_GeoIP::GetAddr();

    //Тест города
    //Получаем инфоблок город по имени города
//    $arData['city'] = 'Ухта';
//    $arData['city'] = 'Сыктывкар';

    $arSelect = Array("ID", "NAME","IBLOCK_SECTION_ID", "PROPERTY_*");
    $arFilter = Array("IBLOCK_ID"=>27, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","NAME"=>$arData['city']);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);

    if (intval($res->SelectedRowsCount())==1){  //Найден один город все ок
        $city = $res->GetNextElement();
        //Array ( [ID] => 21478 [~ID] => 21478 [NAME] => Ухта [~NAME] => Ухта [IBLOCK_SECTION_ID] => 2350 [~IBLOCK_SECTION_ID] => 2350 )
        $city = $city->GetFields();

        //Получаем инфоблок контакты по городу
        $arSelect = Array("*",
            'PROPERTY_PHONES',
            'PROPERTY_ADDRESS',
            'PROPERTY_EMAIL',
            'PROPERTY_BUTTON',
            'PROPERTY_SKYPE',
            'PROPERTY_JOB_TIME',
            'PROPERTY_REGION',
            'PROPERTY_CITY',
            'PROPERTY_CENTER',
            'PROPERTY_MAP'
        );
        $arFilter = Array("IBLOCK_ID"=>19, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y",
            "PROPERTY_CITY"=>$city['ID']
        );
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);

        if (intval($res->SelectedRowsCount())>0){  //Найдены контактные данные
            $contacts = $res->GetNextElement();
            $contacts = $contacts->GetFields();
        } else {
            //В городе нет контактов. Ищем в регионе:
            //Получаем инфоблок контакты по региону
            $arSelect = Array("*",
                'PROPERTY_PHONES',
                'PROPERTY_ADDRESS',
                'PROPERTY_EMAIL',
                'PROPERTY_BUTTON',
                'PROPERTY_SKYPE',
                'PROPERTY_JOB_TIME',
                'PROPERTY_REGION',
                'PROPERTY_CITY',
                'PROPERTY_CENTER',
                'PROPERTY_MAP');
            $arFilter = Array("IBLOCK_ID"=>19, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y",
                "PROPERTY_REGION"=>$city['IBLOCK_SECTION_ID'],  //Нужный регион
                "PROPERTY_178" =>"323"  //Центральный филиал региона => Да
            );
            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);

            if (intval($res->SelectedRowsCount())>0){  //Найдены контактные данные
                $contacts = $res->GetNextElement();
                $contacts = $contacts->GetFields();
            }
        }
    }
}

if(!isset($contacts)){
    //Либо город не определился, либо в городе и в регионе нет филлиалов.
    //Подставляем питер
    //Получаем инфоблок контакты по городу
    //Питер ID = 1580;
    $arSelect = Array("*",
        'PROPERTY_PHONES',
        'PROPERTY_ADDRESS',
        'PROPERTY_EMAIL',
        'PROPERTY_BUTTON',
        'PROPERTY_SKYPE',
        'PROPERTY_JOB_TIME',
        'PROPERTY_REGION',
        'PROPERTY_CITY',
        'PROPERTY_CENTER',
        'PROPERTY_MAP');
    $arFilter = Array("IBLOCK_ID"=>19, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y",
        "ID"=>1580
    );
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
    if (intval($res->SelectedRowsCount())>0){  //Найдены контактные данные
        $contacts = $res->GetNextElement();
        $contacts = $contacts->GetFields();
    }
}

//print_r($contacts);

//$contacts
//PROPERTY_43    Телефон    PROPERTY_PHONES_VALUE
//PROPERTY_44    Адрес
//PROPERTY_45    e-mail
//PROPERTY_177   skype
//NAME           Город

$_SESSION['CONTACTS'] = $contacts;

//Выводим ближайшие контактные данные
?><div class="header__left">
    <div class="header__address"><?=$contacts['NAME'];//Имя города?>
        <p><?=$contacts['PROPERTY_ADDRESS_VALUE'];//Адрес офиса?></p>
        <a href="/contacts/">Все филиалы компании</a>
    </div>
    <div class="header__phone"><?=$contacts['PROPERTY_PHONES_VALUE'][0];//Телефон (первый) ?></div>
</div>

<!-- contacts block. center -->
<div class="header__center">
    <a class="online-assist" onclick="javascript:jivo_api.open();"><i class="online-assist__pic"></i><span>Онлайн-консультант</span></a><br />
    <a class="callback"><i class="callback__pic"></i><span data-modal-button="callback">Заказать обратный звонок</span></a><br />
    <a class="skype" href="skype:<?=$contacts['PROPERTY_SKYPE_VALUE'];//Скайп?>"><i class="skype__pic"></i><span><?=$contacts['PROPERTY_SKYPE_VALUE'];//Скайп?></span></a>
</div>

<div id="callback" style="display: none;">
  <div class="vik-order-fast">
    <div class="vik-order-fast__bg">
      <form action="/">
        <div class="vik-order__title-sm"><strong>Заказать звонок</strong> нашего менеджера</div>
        <p>Просто заполните форму ниже и наш менеджер позвонит<br> Вам в удобное время и уточнит детали по оплате и доставке!</p>

        <div class="vik-order__form-col clearfix">
          <label for="/">Имя:</label>
          <input type="text" class="vik-inptxt-style" placeholder="Константин Константинопольский">
        </div>

        <div class="vik-order__form-col clearfix">
          <label for="/">Телефон:</label>
          <input type="text" class="vik-inptxt-style vik-numb-phone-mask" placeholder="+7 (900) 555-55-55">
        </div>

        <div class="vik-order__form-col clearfix">
          <label for="/">Удобное для звонка время:</label>
          <input type="text" class="vik-inptxt-style vik-inptxt-style__small" placeholder="12 - 18">
          <span class="vik-order__form-col__sm-txt">с понедельника по пятницу</span>
        </div>

        <div class="vik-order__form-col vik-order__form-col_btn clearfix">
          <input type="submit" class="vik-btn-large vik-btn-green" value="Позвонить мне!">
          <span class="vik-order__form-col_btn-sm">или <a href="#" data-modal-close>отменить заказ</a></span>
        </div>

      </form>
    </div>
  </div>
</div>