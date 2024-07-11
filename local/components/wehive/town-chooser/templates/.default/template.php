<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
    use Bitrix\Main\Localization\Loc as Loc;

    Loc::loadMessages(__FILE__);


   switch (strtoupper($arResult["REGION_NAME"])){
       case "САНКТ-ПЕТЕРБУРГ":
           $curCity = "Санкт-Петербург";
           break;
       case "МОСКВА":
           $curCity = "Москва";
           break;
       case "ЕКАТЕРИНБУРГ":
           $curCity = "Екатеринбург";
           break;
       default:
           $curCity = "Вся Россия";
       break;
   }
?>

    <div class="location-chooser dropdown">
                                <a href="#" class="iconed iconed--left location-chooser__current dropdown-toggle">
                                    <span class="location"><?=$curCity?></span>
                                    <i class="icon icon--location"></i>
                                </a>

                                <div class="location-chooser__dropdown dropdown-inner">
                                    <ul class="u-clear-list">
                                        <li id="loc_spb">
                                            <a href="#">Санкт-Петербург</a>
                                        </li>
                                        <li id="loc_mosca">
                                            <a href="#">Москва</a>
                                        </li>
                                        <li id="loc_ekb">
                                            <a href="#">Екатеринбург</a>
                                        </li>
                                        <li id="loc_rus">
                                            <a href="#">Вся Россия</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>