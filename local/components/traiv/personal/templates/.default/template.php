<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die(); ?>
<?
if (!$USER->IsAuthorized()) {
    if ($_REQUEST["AJAX_MODE"] != "Y") {
        LocalRedirect("/auth/?backurl=".$APPLICATION->GetCurPage());
    }
}
include_once 'top.php'; ?>

<div class="row lk_right_menu h-100 g-0">

<div class="col-12 col-xl-8 col-lg-8 col-md-8">

<?php 
$APPLICATION->IncludeComponent(
    "bitrix:main.profile",
    "newlk",
    Array(
        "CHECK_RIGHTS" => "N",
        "SEND_INFO" => "N",
        "SET_TITLE" => "N",
        "USER_PROPERTY" => array("UF_ORGANIZATION","UF_INN","UF_SITE"),
        "USER_PROPERTY_NAME" => ""
    ),
    $component
    );
?>

	<div class="row lk-item-block d-none g-0">
		<div class="col-12"><div class="lk-item-block-title">Личные данные</div></div>
		<div class="col-12 g-0">
		
    <!-- personal info -->
	<div class="row g-0">
		<div class="col-6 ">
			<div class="lk-item-block-personal-title">
				Пользователь
			</div>
			<div class="lk-item-block-personal-val">
				<?php 
				$rsUser = CUser::GetByID($USER->GetID());
				$arUser = $rsUser->Fetch();
				echo $arUser['NAME'];
				?>
			</div>
		</div>
		
		<div class="col-6">
		<div class="lk-item-block-personal-title">
				<a href="/personal/profile/" class="lk-item-block-personal-link">Настроить...</a>
			</div>
			<!-- <div class="lk-item-block-personal-val">
				ООО "ТК МАШ"
			</div>-->
		</div>
		
		
				<!-- <div class="col-6 mt-2">
			<div class="lk-item-block-personal-title">
				Текущий адрес доставки
			</div>
			<div class="lk-item-block-personal-val">
				СПБ, Центральный, 41 <a href="#" class="lk-item-block-personal-link">Настроить...</a>
			</div>
		</div>
		
		<div class="col-6 mt-2">
		<div class="lk-item-block-personal-title">
				Мои награды
			</div>
			<div class="lk-item-block-personal-val">
				<i class="fa fa-gift"></i>
				<i class="fa fa-superpowers"></i>
				
			</div>
		</div>
		-->
	</div>	
	<!-- personal info end -->
	
		
		</div>
	</div>
	
	<div class="row lk_right_menu g-0">
	<div class="col-12 col-xl-12 col-lg-12 col-md-12">
		<div class="row row d-flex align-items-center lk-item-block g-0" style="margin:0px;">

<?$APPLICATION->IncludeComponent(
	"bitrix:subscribe.edit",
	"",
	Array(
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"ALLOW_ANONYMOUS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"SET_TITLE" => "N",
		"SHOW_AUTH_LINKS" => "Y",
		"SHOW_HIDDEN" => "N"
	),
        $component
);?>
		</div>
	</div>
</div>
	
	<?php 
	/*if ( $USER->IsAuthorized() )
	{
	    if ($USER->GetID() == '3092') {*/
	
	 ?>
	 	<div class="row lk-item-block g-0">
		<div class="col-12"><div class="lk-item-block-title">Текущие заказы</div></div>
		<div class="col-12 g-0">
		
    <!-- personal info -->
	<div class="row g-0">
		
		<div class="col-6 d-none">
		<div class="lk-item-block-personal-title">
				<a href="/personal/orders/" class="lk-item-block-personal-link">Все заказы...</a>
			</div>

		</div>
		
		<div class="col-12">
		
		<?php 
		$APPLICATION->IncludeComponent("bitrix:sale.personal.order.list", "orders-lk-small", Array(
		    "ACTIVE_DATE_FORMAT" => "m/d/Y",	// Формат показа даты
		    "CACHE_GROUPS" => "Y",	// Учитывать права доступа
		    "CACHE_TIME" => "3600",	// Время кеширования (сек.)
		    "CACHE_TYPE" => "A",	// Тип кеширования
		    "CUSTOM_SELECT_PROPS" => array(	// Дополнительные свойства инфоблока
		        0 => "",
		    ),
		    "DETAIL_HIDE_USER_INFO" => array(	// Не показывать в информации о пользователе
		        0 => "0",
		    ),
		    "HISTORIC_STATUSES" => array(	// Перенести в историю заказы в статусах
		        0 => "F",
		    ),
		    "NAV_TEMPLATE" => "",	// Имя шаблона для постраничной навигации
		    "ORDERS_PER_PAGE" => "10",	// Количество заказов на одной странице
		    "ORDER_DEFAULT_SORT" => "STATUS",	// Сортировка заказов
		    "PATH_TO_BASKET" => "/personal/cart",	// Страница с корзиной
		    "PATH_TO_CATALOG" => "/catalog/",	// Путь к каталогу
		    "PATH_TO_PAYMENT" => "/personal/order/payment/",	// Страница подключения платежной системы
		    "PROP_1" => "",	// Не показывать свойства для типа плательщика "Физическое лицо" (s1)
		    "PROP_2" => "",	// Не показывать свойства для типа плательщика "Юридическое лицо" (s1)
		    "REFRESH_PRICES" => "N",	// Пересчитывать заказ после смены платежной системы
		    "RESTRICT_CHANGE_PAYSYSTEM" => array(	// Запретить смену платежной системы у заказов в статусах
		        0 => "0",
		    ),
		    "SAVE_IN_SESSION" => "Y",	// Сохранять установки фильтра в сессии пользователя
		    "SEF_MODE" => "N",	// Включить поддержку ЧПУ
		    "SET_TITLE" => "N",	// Устанавливать заголовок страницы
		    "STATUS_COLOR_F" => "gray",	// Цвет статуса "Выполнен"
		    "STATUS_COLOR_N" => "green",	// Цвет статуса "Принят, ожидается оплата"
		    "STATUS_COLOR_P" => "yellow",	// Цвет статуса "Оплачен, формируется к отправке"
		    "STATUS_COLOR_PSEUDO_CANCELLED" => "red",	// Цвет отменённых заказов
		),
		    $component
		    );
		?>
		
		</div>

	</div>	
	<!-- personal info end -->
	
		
		</div>
	</div>
	 <?php        
	/*    }
	}*/
	?>
	
</div>

<div class="col-12 col-xl-4 col-lg-4 col-md-4">

<?php 
if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092' && 1==2) {
?>

	<div class="row lk-item-block g-0">
		<div class="col-12"><div class="lk-item-block-title">Бонусный счет на 28.06.2022</div></div>
		<div class="col-12 g-0">
		
		<!-- personal info -->
	<div class="row g-0 h-100 align-items-center pt-3">
		<div class="col-6">
			<div class="">
				<span class="rd-text">138</span>
			</div>
			</div>
			<div class="col-6">
			<div class="lk-item-block-personal-val">
				<a href="/personal/lk/" class="lk-item-block-personal-link">История начислений</a>
			</div>
		</div>
		
				<!-- <div class="col-6 text-center">
			
			 <div class=""><span class="rd-text">138</span></div>
			
		</div>-->
		
	</div>	
	<!-- personal info end -->
	
		
		</div>
	</div>
	
	<?php 
    }
}
	?>
	
	
	<!-- push -->
<div class="row lk-item-block g-0 d-none">
		<div class="col-12"><div class="lk-item-block-title">Уведомления</div></div>
		<div class="col-12 g-0">
	
    	<div class="row g-0 h-100">
    		<div class="col-12">
    			<div class="lk-item-block-personal-val-push">
    				<i class="fa fa-circle"></i><span>Вам нaчаслен бонус</span>
    				<i class="fa fa-circle"></i><span>Вы успешно прошли квиз</span>
    			</div>
    		</div>
    	</div>
    		
		</div>
</div>
	<!-- end push -->
	
		<!-- push -->
<div class="row lk-item-block g-0 align-items-center d-none">
		<div class="col-12"><div class="lk-item-block-title">Настройки уведомлений</div></div>
		<div class="col-12 g-0">
	
    	<div class="row g-0 h-100 align-items-center">
    	
    		<div class="col-4">
    			<div class="lk-item-block-personal-val-push">
    				<a href="#"><i class="fa fa-envelope"></i><span>Почта</span></a>
    			</div>
    		</div>
    		
    		<div class="col-4">
    			<div class="lk-item-block-personal-val-push">
    				<a href="#"><i class="fa fa-whatsapp"></i><span>WhatsApp</span></a>
    			</div>
    		</div>
    		
    		<div class="col-4">
    			<div class="lk-item-block-personal-val-push">
    				<a href="#"><i class="fa fa-comments-o"></i><span>SMS</span></a>
    			</div>
    		</div>
    		
    	</div>
    		
		</div>
</div>
	<!-- end push -->
	
			<!-- bells -->
<div class="row lk-item-block g-0 align-items-center d-none">
		<div class="col-12"><div class="lk-item-block-title">Мои подписки</div></div>
		<div class="col-12 g-0">
	
    	<div class="row g-0 h-100 align-items-center">
    	
    		<div class="col-12">
    			<div class="lk-item-block-personal-val-push">
    				<a href="#"><i class="fa fa-envelope"></i><span>Приход контейнера</span></a>
    			</div>
    		</div>
    		
    		<div class="col-12">
    			<div class="lk-item-block-personal-val-push">
    				<a href="#"><i class="fa fa-envelope"></i><span>Новости Трайв-Комплект</span></a>
    			</div>
    		</div>
    		
    		<div class="col-12">
    			<div class="lk-item-block-personal-val-push">
    				<a href="#"><i class="fa fa-envelope"></i><span>Спецпредложения</span></a>
    			</div>
    		</div>
    		
    		<div class="col-12">
    			<div class="lk-item-block-personal-val-push">
    				<a href="#"><i class="fa fa-envelope"></i><span>Отраслевые статьи</span></a>
    			</div>
    		</div>
    		
    		
    	</div>
    		
		</div>
</div>
	<!-- end bells -->
	
	
		<!-- manager -->
<div class="row lk-item-block g-0">
		<div class="col-12"><div class="lk-item-block-title">Ваш персональный менеджер</div></div>
		<div class="col-12 g-0">
	
    	<div class="row g-0 h-100">
    		<div class="col-6 d-none">
    			<div class="profile_photo rounded-circle ml-0">
            		<i class="fa fa-user"></i>
            	</div>
    		</div>
    		
    		<div class="col-12">
    			<div class="row">
            		<div class="col-12">
            			<div class="lk-item-block-personal-val-push d-none">
            				<a href="javascript:void(0);return false;"><span>Дубровка Алиса</span></a>
            			</div>
            			<div class="lk-item-block-personal-val-push">
            				<a href="tel:88003339116"><span>8 (800) 333-91-16</span></a>
            			</div>
            			
            			<div class="lk-item-block-personal-val-push">
            				<a href="mailto:info@traiv.ru"><span>info@traiv.ru</span></a>
            			</div>
            			
            		</div>
            	</div>
    		</div>
    		
    	</div>
    		
		</div>
</div>
	<!-- end manager -->

</div>

</div>

<?/*$APPLICATION->IncludeComponent(
    "bitrix:menu",
    "right",
    Array(
        "ALLOW_MULTI_SELECT" => "N",
        "CHILD_MENU_TYPE" => "left",
        "DELAY" => "N",
        "MAX_LEVEL" => "1",
        "MENU_CACHE_GET_VARS" => array(""),
        "MENU_CACHE_TIME" => "3600",
        "MENU_CACHE_TYPE" => "N",
        "MENU_CACHE_USE_GROUPS" => "Y",
        "ROOT_MENU_TYPE" => "personal",
        "USE_EXT" => "N"
    ),
    $component
);*/?>
<? include_once 'bottom.php'; ?>
