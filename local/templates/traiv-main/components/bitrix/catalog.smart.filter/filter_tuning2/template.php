<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
/*
echo "11111111111<pre>";
print_r($arParams['SEARCH_PROPERTIES']);
echo "</pre>";
 * */

//search needed properties
    function showCommonFilter($arItem){ ?>
        <div class="smart-search__cell smart-search__box">
            <select>
                <option data-role="<?= $arItem['ID'] ?>" value="0"><?=GetMessage("CT_BCSF_FILTER_ALL"); ?></option>
                <?
                $arTemp = array();
                foreach ($arItem["VALUES"] as $arVal) {
                    $arTemp[$arVal["VALUE"]] = $arVal;
                }
                ksort($arTemp);
                foreach ($arTemp as $value):?>
                    <option
                            value="<?=$value["ID"]?>"
                            data-role="<?= $arItem['ID'] ?>"
                            data-id="<?=abs(crc32($value["ID"]))?>"
                            <?=$value["SELECTED"] ? 'selected' : '' ?>
                    ><?=$value["VALUE"]?></option>
                <?endforeach?>
            </select>
        </div>
    <?}?>

    <h3 class="md-title"><? echo GetMessage("CT_BCSF_FILTER_TITLE") ?></h3>
    <div class="smart-search bx-filter">
        <form name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<? echo $arResult["FORM_ACTION"] ?>" method="get" class="smartfilter smart-search__aligner">
            <?foreach ($arResult["HIDDEN"] as $arItem): ?>
                <input type="hidden" name="<? echo $arItem["CONTROL_NAME"] ?>" id="<? echo $arItem["CONTROL_ID"] ?>" value="<? echo $arItem["HTML_VALUE"] ?>"/>
            <?endforeach;?>

            <?php
                $i = 0;
                foreach ($arParams['SEARCH_PROPERTIES'] as $property){
                    if($i == 2){
                        echo '<div style="display: table-row;"></div>';//для гребанного выравнивания
                        $i = 0;
                    }
                    $i++;
                    ?>
                    <div class="smart-search__cell smart-search__label"><? echo $property['NAME'] ?></div>
                    <?showCommonFilter($property)?>
                    <?php
                }
                if($i == 1){
                    echo '<div class="smart-search__cell smart-search__label"></div>';
                }

            unset($property, $arItem);

            ?>


        </form>
        <div class="preloader"></div>
        <div id="filter-search-container" style="display: none;">
            <div class="filter-search-results"></div>
        </div>
    </div>
    <script>
        $(".smart-search__box select").change(function(){
            var $this = $(this);

            if(parseInt($this.val())){
                if(!$this.hasClass('selected')){
                    $this.addClass('selected');
                    $this.parent().find('.selectbox').addClass('selected');
                }
            }else{
                $this.removeClass('selected');
                $this.parent().find('.selectbox').removeClass('selected');
            }

            //disables the button while ajax working. for those who wants to click too soon.
            //$("form[name='<? echo $arResult["FILTER_NAME"] . "_form" ?>'] input#set_filter").attr("disabled","disabled");

            //var inputId = $(this).children("option:selected").data("role");
            //dropdown list doesn't close without timeout, so don't touch it!
            //setTimeout(function(){$("div[data-container='filter-inputs'] input#"+inputId).click();},0);

            var $form = $("form[name='<? echo $arResult["FILTER_NAME"] . "_form" ?>']");
            var $filterSearchContainer = $('#filter-search-container');
            $filterSearchContainer.hide();


            var $filter = {};
            $form.find('option:selected').each(function(){
                if(parseInt($(this).val())){
                    $filter[$(this).data('role')] = $(this).val()
                }
            });

            if(Object.keys($filter).length > 0){
                //preloader show
                $('.catalog-filter-tuning .preloader').show();
                $.ajax({
                    type: 'GET',
                    dataType: "JSON",
                    url: '/ajax/search_filter.php',
                    data: {
                        filter: $filter
                    },
                    success: function($response){
                        //preloader hide
                        $('.catalog-filter-tuning .preloader').hide();
                        $filterSearchContainer.find('.filter-search-results').empty();

                        //$('.catalog-filter-tuning option').attr('disabled', 'disabled');
                        $('.catalog-filter-tuning .selectbox__item').hide();

                        $('.catalog-filter-tuning .selectbox__item[data-value="0"]').show();
                        if($response.COUNT){
                            var html_result = '';
                            $.each($response.ITEMS, function() {
                                html_result += '<li class="col x1d6 x1d4--md x1d6--s x1--xs" id=""><div class="catalog-item"><div class="catalog-item__header"><h4 class="catalog-item__title"><a href="'+this.URL+'">'+this.NAME+'</a></h4></div><div class="catalog-item__image"><a href="'+this.URL+'"><img src="'+this.IMAGE+'" alt="'+this.NAME+'"></a></div><div class="catalog-item__footer"><div class="u-pull-left"><span>Цена: </span><span class="catalog-item__price_"><span>'+this.PRICE+' руб.</span></span></div></div><div class="catalog-item__hidden"><a href="'+window.location.pathname+'/?action=ADD2BASKET&amp;id='+this.ID+'" class="btn" data-ajax-order="">Заказать</a></div></div></li>'; 
                            });
                            $("#result-tuning .row").html(html_result);
                            $("#result-tuning").show();
                            
                            /*for (var id in $response.ITEMS){
                                $('<div><a href="'+$response.ITEMS[id].URL+'">'+$response.ITEMS[id].NAME+'</a></div>')
                                    .appendTo(
                                        $filterSearchContainer.find('.filter-search-results')
                                    );
                            }*/

                            var idPropertyValue, idProperty;
                            for(idProperty in $response.PROPERTIES){
                                for(idPropertyValue in $response.PROPERTIES[idProperty]){
                                    $('.catalog-filter-tuning .selectbox__item[data-value="'+idPropertyValue+'"]').show();
                                }
                            }

                            $filterSearchContainer.show();
                        }
                    }
                });
            }else{
                $this.closest('.smart-search.bx-filter').find('.selectbox__item').show();
            }

        });

        $(document).on('click', '.selectbox.selected', function(){
            var $this = $(this);
            if($this.parent().find('select').hasClass('selected')){
                $this.parent().find('.selectbox__item').show();

                $this.parent().find('select').removeClass('selected');
                $this.parent().find('.selectbox').removeClass('selected');

                $this.parent().find('.selectbox__item[data-value="0"]').click();

            }
        });
        //var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
    </script>
<?
