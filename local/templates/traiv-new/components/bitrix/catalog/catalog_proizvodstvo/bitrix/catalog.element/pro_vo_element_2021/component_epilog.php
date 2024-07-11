<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
 <? /*
	$APPLICATION->IncludeComponent(
	"api:reviews", 
	"reviews", 
	array(
		"COMPONENT_TEMPLATE" => "reviews",
		"INCLUDE_CSS" => "Y",
		"INCLUDE_JQUERY" => "N",
		"EMAIL_TO" => "",
		"SHOP_NAME" => "Трайв-Комплект",
		"THEME" => "aspro",
		"COLOR" => "traiv",
		"IBLOCK_ID" => "18",
		"SECTION_ID" => "",
		"ELEMENT_ID" => $arResult["ID"],
		"URL" => "",
		"UPLOAD_FILE_TYPE" => "",
		"UPLOAD_FILE_SIZE" => "10M",
		"UPLOAD_FILE_LIMIT" => "8",
		"UPLOAD_VIDEO_LIMIT" => "8",
		"THUMBNAIL_WIDTH" => "114",
		"THUMBNAIL_HEIGHT" => "72",
		"FORM_FORM_TITLE" => "Отзыв о магазине Трайв-Комплект",
		"FORM_FORM_SUBTITLE" => "",
		"FORM_PREMODERATION" => "N",
		"FORM_DISPLAY_FIELDS" => array(
			0 => "RATING",
			1 => "ADVANTAGE",
			2 => "DISADVANTAGE",
			3 => "ANNOTATION",
			4 => "GUEST_NAME",
			5 => "GUEST_EMAIL",
			6 => "GUEST_PHONE",
		),
		"FORM_REQUIRED_FIELDS" => array(
			0 => "RATING",
			1 => "ANNOTATION",
			2 => "GUEST_NAME",
			3 => "GUEST_EMAIL",
		),
		"FORM_DELIVERY" => array(
		),
		"FORM_CITY_VIEW" => "Y",
		"FORM_SHOP_TEXT" => "Отзывы о магазине",
		"FORM_SHOP_BTN_TEXT" => "Оставить свой отзыв",
		"FORM_RULES_TEXT" => "Правила публикации отзывов",
		"FORM_RULES_LINK" => "",
		"FORM_MESS_ADD_REVIEW_VIZIBLE" => "Спасибо!<br>Ваш отзыв №#ID# опубликован",
		"FORM_MESS_ADD_REVIEW_MODERATION" => "Спасибо!<br>Ваш отзыв отправлен на модерацию",
		"FORM_MESS_ADD_REVIEW_ERROR" => "Внимание!<br>Ошибка добавления отзыва",
		"FORM_MESS_STAR_RATING_1" => "Ужасный магазин",
		"FORM_MESS_STAR_RATING_2" => "Плохой магазин",
		"FORM_MESS_STAR_RATING_3" => "Обычный магазин",
		"FORM_MESS_STAR_RATING_4" => "Хороший магазин",
		"FORM_MESS_STAR_RATING_5" => "Отличный магазин",
		"FORM_MESS_ADD_REVIEW_EVENT_THEME" => "Отзыв о магазине Трайв-Комплект (оценка: #RATING#) ##ID#",
		"FORM_MESS_ADD_REVIEW_EVENT_TEXT" => "<p>#USER_NAME# добавил(а) новый отзыв (оценка: #RATING#) ##ID#</p>
<p>Открыть в админке #LINK_ADMIN#</p>
<p>Открыть на сайте #LINK#</p>",
		"FORM_USE_EULA" => "N",
		"FORM_MESS_EULA" => "Нажимая кнопку «Отправить отзыв», я принимаю условия Пользовательского соглашения и даю своё согласие на обработку моих персональных данных, в соответствии с Федеральным законом от 27.07.2006 года №152-ФЗ «О персональных данных», на условиях и для целей, определенных Политикой конфиденциальности.",
		"FORM_MESS_EULA_CONFIRM" => "Для продолжения вы должны принять условия Пользовательского соглашения",
		"FORM_USE_PRIVACY" => "Y",
		"FORM_MESS_PRIVACY" => "Я согласен на обработку персональных данных",
		"FORM_MESS_PRIVACY_LINK" => "",
		"FORM_MESS_PRIVACY_CONFIRM" => "Для продолжения вы должны принять соглашение на обработку персональных данных",
		"USE_FORM_MESS_FIELD_PLACEHOLDER" => "N",
		"LIST_SET_TITLE" => "N",
		"LIST_SHOW_THUMBS" => "Y",
		"LIST_SHOP_NAME_REPLY" => "Интернет-магазин Трайв-Комплект",
		"LIST_ITEMS_LIMIT" => "10",
		"LIST_SORT_FIELD_1" => "ACTIVE_FROM",
		"LIST_SORT_ORDER_1" => "DESC",
		"LIST_SORT_FIELD_2" => "DATE_CREATE",
		"LIST_SORT_ORDER_2" => "DESC",
		"LIST_SORT_FIELD_3" => "ID",
		"LIST_SORT_ORDER_3" => "DESC",
		"LIST_SORT_FIELDS" => array(
		),
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"PICTURE" => array(
		),
		"RESIZE_PICTURE" => "48x48",
		"LIST_MESS_ADD_UNSWER_EVENT_THEME" => "Официальный ответ к вашему отзыву",
		"LIST_MESS_ADD_UNSWER_EVENT_TEXT" => "#USER_NAME#, здравствуйте! 
К Вашему отзыву добавлен официальный ответ, для просмотра перейдите по ссылке #LINK#",
		"LIST_MESS_TRUE_BUYER" => "Проверенный покупатель",
		"LIST_MESS_HELPFUL_REVIEW" => "Отзыв полезен?",
		"DETAIL_HASH" => "",
		"USE_STAT" => "Y",
		"STAT_MESS_CUSTOMER_REVIEWS" => "Отзывы покупателей <span class=\"api-reviews-count\"></span>",
		"STAT_MESS_TOTAL_RATING" => "Рейтинг покупателей",
		"STAT_MESS_CUSTOMER_RATING" => "На основе #N# оценок покупателей",
		"STAT_MIN_AVERAGE_RATING" => "5",
		"USE_SUBSCRIBE" => "N",
		"USE_MESS_FIELD_NAME" => "N",
		"SEF_MODE" => "N",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "0",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_THEME" => "blue",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Отзывы",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "Y",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "0",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"VARIABLE_ALIASES" => array(
			"review_id" => "review_id",
			"user_id" => "user_id",
		)
	),
	false
);   ?>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<?
$search = $arResult["SECTION"]["SECTION_PAGE_URL"];
$url = $APPLICATION->GetCurPage(false);

if (strpos($url, $search) === false) {
	@define("ERROR_404", "Y");
	if($arParams["SET_STATUS_404"]==="Y")
		CHTTP::SetStatus("404 Not Found");
}

$APPLICATION->AddHeadString('<link href="'.$arResult['CANONICAL_PAGE_URL'].'" rel="canonical" />',true); */
?>

