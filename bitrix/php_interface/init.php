<?
AddEventHandler("main", "OnAfterUserRegister", Array("MyEvents", "OnAfterUserRegisterHandler"));
AddEventHandler("catalog", "OnGetOptimalPrice", Array("MyEvents", "OnGetOptimalPrice"));
class MyEvents
{
    /**
     * Отправка письма с паролем клиенту при регистрации
     * @param $arFields
     */
    function OnAfterUserRegisterHandler(&$arFields)
    {
        $arEventFields= array(
            "LOGIN" => $arFields["LOGIN"],
            "NAME" => $arFields["NAME"],
            "LAST_NAME" => $arFields["LAST_NAME"],
            "PASSWORD" => $arFields["PASSWORD"],
            "EMAIL" => $arFields["EMAIL"],
            "SERVER_NAME" => "tehnocom.net",
        );
        CEvent::Send("MAIN_USER_INFO", SITE_ID, $arEventFields, "N", 2);
    }

    /**
     * Получение цены для текущего пользователя
     *
     * @param $productID
     * @param int $quantity
     * @param array $arUserGroups
     * @param string $renewal
     * @param array $arPrices
     * @param bool $siteID
     * @param bool $arDiscountCoupons
     * @return array
     */
    function OnGetOptimalPrice($productID, $quantity = 1, $arUserGroups = array(), $renewal = "N", $arPrices = array(), $siteID = false, $arDiscountCoupons = false)
    {
        //Делаем привязку по ценам. Без родителей/потомков.
        global $USER;

        //Дефолтная самая большая цена
        $priceType = 0;//Розница

        if($USER->IsAuthorized()){

            $priceType = 1; //Для зарегистрированного

            $arFilter = array("ID" => $USER->GetID());
            $arParams["SELECT"] = array("UF_SECTION_PRICE3","UF_SECTION_PRICE4");
            $arRes = CUser::GetList($by,$desc,$arFilter,$arParams);
            if ($res = $arRes->Fetch()) {
                //1. Узнать категории продукта
                $productSections = CCatalogProduct::GetProductSections($productID);

                $checkPrice3 = array_intersect($productSections,$res['UF_SECTION_PRICE3']);
                $checkPrice4 = array_intersect($productSections,$res['UF_SECTION_PRICE4']);

                //Если есть пересечения с ценой 3 - цена 3
                if(count($checkPrice3)){
                    $priceType = 2;
                }

                //Если есть пересечения с ценой 4 - цена 4
                if(count($checkPrice4)){
                    $priceType = 3;
                }
            }
        }

        $prices = GetCatalogProductPriceList($productID);
        return array('PRICE' => $prices[$priceType]);
    }
}
