<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
if ($arResult['ITEMS']):?>
    <div class="sotbit-seometa-tags-column">
        <?if(is_array($arResult['ITEMS']['IMAGE_TAGS'])):?>
            <div class="sotbit-seometa-tags-column-container">
                <?foreach ($arResult['ITEMS']['IMAGE_TAGS'] as $Item):?>
                    <?if($Item['IMAGE']['SRC']):?>
                        <a class="seometa__item" href="<?= $Item['URL'] ?>" <?= $Item['TITLE'] ? "title=\"". $Item['TITLE'] .'"' : '' ?>>
                            <div class="seometa__img-wrapper">
                                <img class="seometa__img"
                                     src="<?= $Item['IMAGE']['SRC'] ?>"
                                     alt="<?= $Item['IMAGE']['SRC'] ?>"
                                    <?= $Item['TITLE'] ? "title=\"". $Item['TITLE'] .'"' : '' ?>>
                            </div>
                            <?if($Item['TITLE']):?>
                                <p class="seometa__title"><?= $Item['TITLE'] ?></p>
                            <?endif;?>
                        </a>
                    <?endif;?>
                <?endforeach;?>
            </div>
        <?endif;?>

        <?if($arResult['ITEMS']['CUSTOM_TAGS']):?>
            <div class="sotbit-seometa-tags-column-container">
                <?foreach ($arResult['ITEMS']['CUSTOM_TAGS'] as $Item):?>
                    <?if ($Item['TITLE'] && $Item['URL']):?>
                        <div class="tags_wrapper">
                            <div class="tags_section">
                                <div class="sotbit-seometa-tags-column-wrapper">
                                    <div class="sotbit-seometa-tag-column">
                                        <a class="sotbit-seometa-tag-link" href="<?= $Item['URL'] ?>"
                                           title="<?= $Item['TITLE'] ?>"><?= $Item['TITLE'] ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?endif;?>
                <?endforeach;?>
            </div>
        <?endif;?>
    </div>
<?endif;?>
