<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
} ?>

<? if (!empty($arResult)): ?>
    <nav class="nav">
        <ul class="u-clear-list">

            <?
                foreach ($arResult as $arItem):
                    if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) {
                        continue;
                    }
                    ?>
                    <li class="nav__item">
                        <a class="nav__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                    </li>
                <? endforeach ?>

        </ul>

    </nav>
<? endif ?>


