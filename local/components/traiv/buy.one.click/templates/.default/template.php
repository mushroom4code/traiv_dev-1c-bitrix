<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die(); ?>
<!--<a href="#buy-one-click" class="btn btn-mfp-dialog">Купить в 1 клик</a>-->
<div id="buy-one-click" class="popup-dialog js-validate mfp-hide">
    <div class="md-title">Заказ в 1 клик</div>
    
    <?php 
    if ( $USER->IsAuthorized() )
    {
            $user_name = $USER->GetFirstName();
            $user_mail = $USER->GetEmail();
            $user_phone = $USER->GetByID($USER->GetID())->Fetch()["PERSONAL_PHONE"];       
    }
    ?>
    
    <p>Заполните форму и наш менеджер свяжется с вами, для уточнения заказа.</p>

    <div class="form-control-row">
        <div class="col x1d2 x1d1--m form-control-row">
            <input type="text" placeholder="Имя" id="order-name" class="form-control" value="<?php echo $user_name;?>">
        </div>
        <div class="col x1d2 x1d1--m form-control-row">
            <input type="text" placeholder="Телефон"  id="order-phone" class="form-control input_tel" value="<?php echo $user_phone;?>">
        </div>
        <div class="col x1d1 x1d1--m form-control-row">
            <input type="text" maxlength="70" placeholder="Email" id="order-email" class="form-control form-email" value="<?php echo $user_mail;?>">
        </div>
    </div>

    <?if ($arParams['USER_CONSENT'] == 'Y'):?>
        <?$APPLICATION->IncludeComponent(
	"bitrix:main.userconsent.request", 
	"main_2021", 
	array(
		"ID" => "1",
		"IS_CHECKED" => "N",
		"AUTO_SAVE" => "Y",
		"IS_LOADED" => "N",
		"REPLACE" => array(
			"button_caption" => "Отправить",
			"fields" => array(
				0 => "Email",
				1 => "Телефон",
				2 => "Имя",
			),
		),
		"COMPONENT_TEMPLATE" => "main_2021",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
    <?endif;?>
    
    <div class="form-control-row">
        <button class="btn btn--submit btn-blue submit-button submit-big-text w100">Оформить заказ</button>
    </div>

    <button class="w-form__close mfp-close" title="Закрыть"><i class="fa fa-close" tabindex="0"></i></button>

</div>
</div>