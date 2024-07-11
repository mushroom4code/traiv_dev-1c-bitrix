<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
global $APPLICATION;

if($arResult["DEBUG"]["SHOW"] == 'Y')
{
	echo '<pre>';
		echo 'Type: '; print_r($arResult["DEBUG"]["TYPE"]); echo "\r\n";
		echo 'Max count: '; print_r($arResult["DEBUG"]["TOP_COUNT"]); echo "\r\n";

		echo 'Find List: '; print_r($arResult["DEBUG"]["RESULT_WORDS"]); echo "\r\n";
	echo '</pre>';

	if($arResult["DEBUG"]["Q"])
	{
		// echo '<pre>'; print_r($arResult["DEBUG"]["Q"]); echo '</pre>';
	}
}
?>

<div class="bx-ag-search-page search-page <?=$arResult["VISUAL_PARAMS"]["THEME_CLASS"]?>">
	<form action="" method="get">
	<?if($arParams["USE_SUGGEST"] === "Y"):
		if(strlen($arResult["REQUEST"]["~QUERY"]) && is_object($arResult["NAV_RESULT"]))
		{
			$arResult["FILTER_MD5"] = $arResult["NAV_RESULT"]->GetFilterMD5();
			$obSearchSuggest = new CSearchSuggest($arResult["FILTER_MD5"], $arResult["REQUEST"]["~QUERY"]);
			$obSearchSuggest->SetResultCount($arResult["NAV_RESULT"]->NavRecordCount);
		}
		?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:search.suggest.input",
			"",
			array(
				"NAME" => "q",
				"VALUE" => $arResult["REQUEST"]["~QUERY"],
				"INPUT_SIZE" => 50,
				"DROPDOWN_SIZE" => 10,
				"FILTER_MD5" => $arResult["FILTER_MD5"],
			),
			$component, array("HIDE_ICONS" => "Y")
		);?>
	<?else:?>
		<input placeholder="<?/*=$arResult["VISUAL_PARAMS"]["PLACEHOLDER"]*/?>Поиск в разделе Производство" type="text" name="q" value="<?=$arResult["REQUEST"]["QUERY"]?>" size="50" />
	<?endif;?>
	<?if($arParams["SHOW_WHERE"]):?>
		&nbsp;<select name="where">
		<option value=""><?=GetMessage("SEARCH_ALL")?></option>
		<?foreach($arResult["DROPDOWN"] as $key=>$value):?>
		<option value="<?=$key?>"<?if($arResult["REQUEST"]["WHERE"]==$key) echo " selected"?>><?=$value?></option>
		<?endforeach?>
		</select>
	<?endif;?>
		&nbsp;<input type="submit" value="<?=GetMessage("SEARCH_GO")?>" />
		<input type="hidden" name="how" value="<?echo $arResult["REQUEST"]["HOW"]=="d"? "d": "r"?>" />
	<?if($arParams["SHOW_WHEN"]):?>
		<script>
		var switch_search_params = function()
		{
			var sp = document.getElementById('search_params');
			var flag;
			var i;

			if(sp.style.display == 'none')
			{
				flag = false;
				sp.style.display = 'block'
			}
			else
			{
				flag = true;
				sp.style.display = 'none';
			}

			var from = document.getElementsByName('from');
			for(i = 0; i < from.length; i++)
				if(from[i].type.toLowerCase() == 'text')
					from[i].disabled = flag;

			var to = document.getElementsByName('to');
			for(i = 0; i < to.length; i++)
				if(to[i].type.toLowerCase() == 'text')
					to[i].disabled = flag;

			return false;
		}
		</script>
		<br /><a class="search-page-params" href="#" onclick="return switch_search_params()"><?echo GetMessage('CT_BSP_ADDITIONAL_PARAMS')?></a>
		<div id="search_params" class="search-page-params" style="display:<?echo $arResult["REQUEST"]["FROM"] || $arResult["REQUEST"]["TO"]? 'block': 'none'?>">
			<?$APPLICATION->IncludeComponent(
				'bitrix:main.calendar',
				'',
				array(
					'SHOW_INPUT' => 'Y',
					'INPUT_NAME' => 'from',
					'INPUT_VALUE' => $arResult["REQUEST"]["~FROM"],
					'INPUT_NAME_FINISH' => 'to',
					'INPUT_VALUE_FINISH' =>$arResult["REQUEST"]["~TO"],
					'INPUT_ADDITIONAL_ATTR' => 'size="10"',
				),
				null,
				array('HIDE_ICONS' => 'Y')
			);?>
		</div>
	<?endif?>
	</form><br />

	<?if(isset($arResult["REQUEST"]["ORIGINAL_QUERY"])):
		?>
		<div class="search-language-guess">
			<?echo GetMessage("CT_BSP_KEYBOARD_WARNING", array("#query#"=>'<a href="'.$arResult["ORIGINAL_QUERY_URL"].'">'.$arResult["REQUEST"]["ORIGINAL_QUERY"].'</a>'))?>
		</div><br /><?
	endif;?>

	<?/* if($arResult["VISUAL_PARAMS"]["CLARIFY"] && count($arResult["CLARIFY_WORDS"]) > 1):?>
		<div class="ag-spage-clarify-list">
			<div class="ag-spage-clarify-title"><?=GetMessage("AG_SPAGE_CLARIFY_TITLE");?></div>
			<?foreach($arResult["CLARIFY_WORDS"] as $word):
			$word = strtolower($word);
			?>
				<a class="ag-spage-clarify-item" href="<?=$APPLICATION->GetCurPageParam('q='.$word, array("q"))?>"><?=$word?></a>
			<?endforeach;?>
		</div>
	<?endif; */?>


	<?if($arResult["REQUEST"]["QUERY"] === false && $arResult["REQUEST"]["TAGS"] === false):?>
	<?elseif($arResult["ERROR_CODE"]!=0):?>
		<p><?=GetMessage("SEARCH_ERROR")?></p>
		<?ShowError($arResult["ERROR_TEXT"]);?>
		<p><?=GetMessage("SEARCH_CORRECT_AND_CONTINUE")?></p>
		<br /><br />
		<?/* <p><?=GetMessage("SEARCH_SINTAX")?><br /><b><?=GetMessage("SEARCH_LOGIC")?></b></p>
		<table border="0" cellpadding="5">
			<tr>
				<td align="center" valign="top"><?=GetMessage("SEARCH_OPERATOR")?></td><td valign="top"><?=GetMessage("SEARCH_SYNONIM")?></td>
				<td><?=GetMessage("SEARCH_DESCRIPTION")?></td>
			</tr>
			<tr>
				<td align="center" valign="top"><?=GetMessage("SEARCH_AND")?></td><td valign="top">and, &amp;, +</td>
				<td><?=GetMessage("SEARCH_AND_ALT")?></td>
			</tr>
			<tr>
				<td align="center" valign="top"><?=GetMessage("SEARCH_OR")?></td><td valign="top">or, |</td>
				<td><?=GetMessage("SEARCH_OR_ALT")?></td>
			</tr>
			<tr>
				<td align="center" valign="top"><?=GetMessage("SEARCH_NOT")?></td><td valign="top">not, ~</td>
				<td><?=GetMessage("SEARCH_NOT_ALT")?></td>
			</tr>
			<tr>
				<td align="center" valign="top">( )</td>
				<td valign="top">&nbsp;</td>
				<td><?=GetMessage("SEARCH_BRACKETS_ALT")?></td>
			</tr>
		</table> */?>


	<?elseif(count($arResult["SEARCH"])>0):?>
		<div class="search-view-default">
			<?if($arParams["DISPLAY_TOP_PAGER"] != "N") echo $arResult["NAV_STRING"]?>
			<br /><hr />
    <?
    $array_name = [];

    foreach ($arResult["SEARCH"] as $key => $row)
    {
        $array_name[$key] = $row["ITEM_ID"];
    }

    array_multisort($array_name, SORT_DESC, $arResult["SEARCH"]);

    ?>

    <?//echo '<pre>'; print_r($arResult); echo '</pre>'; ?>

			<?foreach($arResult["SEARCH"] as $arItem):?>

    <?//echo '<pre>'; print_r($arItem); echo '</pre>'; ?>



    <div class="search-item <?if(strpos($arItem["ITEM_ID"], 'S')!== false) : ?>cat<? else :?>elem<?endif?>">
				<?if(is_array($arItem["PICTURE"])):?>
					<div class="search-preview"><img src="<?=$arItem["PICTURE"]["src"]?>"></div>
				<?endif;?>
                <?
                $origname = $arItem["TITLE_FORMATED"];
                $formatedPACKname = preg_replace("/\([^)]+(шт.\)|шт\)|ш\))/","",$origname);
                $formatedname = preg_replace("/КИТАЙ|Конт|Китай|Россия|Европа|Ев|PU=S|PU=K|RU=S|RU=K|PU=К|PU=*/","",$formatedPACKname);
                $arItem["TITLE_FORMATED"] = $formatedname;

                $arItem["BODY_FORMATED"] = preg_replace("/\([^)]+(шт.\)|шт\)|ш\))/","",$arItem["BODY_FORMATED"]);
                $arItem["BODY_FORMATED"] = preg_replace("/КИТАЙ|Конт|Китай|Россия|Европа|Ев|PU=S|PU=K|RU=S|RU=K|PU=К|PU=*/","",$arItem["BODY_FORMATED"]);
                ?>

				<a class="search-title" href="<?echo $arItem["URL"]?>"><?echo $arItem["TITLE_FORMATED"]?></a>
				<p><?echo $arItem["BODY_FORMATED"]?></p>
				<?if (
					$arParams["SHOW_RATING"] == "Y"
					&& strlen($arItem["RATING_TYPE_ID"]) > 0
					&& $arItem["RATING_ENTITY_ID"] > 0
				):?>
					<div class="search-item-rate"><?
						$APPLICATION->IncludeComponent(
							"bitrix:rating.vote", $arParams["RATING_TYPE"],
							Array(
								"ENTITY_TYPE_ID" => $arItem["RATING_TYPE_ID"],
								"ENTITY_ID" => $arItem["RATING_ENTITY_ID"],
								"OWNER_ID" => $arItem["USER_ID"],
								"USER_VOTE" => $arItem["RATING_USER_VOTE_VALUE"],
								"USER_HAS_VOTED" => $arItem["RATING_USER_VOTE_VALUE"] == 0? 'N': 'Y',
								"TOTAL_VOTES" => $arItem["RATING_TOTAL_VOTES"],
								"TOTAL_POSITIVE_VOTES" => $arItem["RATING_TOTAL_POSITIVE_VOTES"],
								"TOTAL_NEGATIVE_VOTES" => $arItem["RATING_TOTAL_NEGATIVE_VOTES"],
								"TOTAL_VALUE" => $arItem["RATING_TOTAL_VALUE"],
								"PATH_TO_USER_PROFILE" => $arParams["~PATH_TO_USER_PROFILE"],
							),
							$component,
							array("HIDE_ICONS" => "Y")
						);?>
					</div>
				<?endif;?>
				<small><?=GetMessage("SEARCH_MODIFIED")?> <?=$arItem["DATE_CHANGE"]?></small><br /><?
				/* if($arItem["CHAIN_PATH"]):?>
					<small><?=GetMessage("SEARCH_PATH")?>&nbsp;<?=$arItem["CHAIN_PATH"]?></small><?
				endif; */
				?>

				<div class="clear"></div>
				<hr />
        </div>
			<?endforeach;?>
			<?if($arParams["DISPLAY_BOTTOM_PAGER"] != "N") echo $arResult["NAV_STRING"]?>
			<br />
			<p>
			<?if($arResult["REQUEST"]["HOW"]=="d"):?>
				<a href="<?=$arResult["URL"]?>&amp;how=r<?echo $arResult["REQUEST"]["FROM"]? '&amp;from='.$arResult["REQUEST"]["FROM"]: ''?><?echo $arResult["REQUEST"]["TO"]? '&amp;to='.$arResult["REQUEST"]["TO"]: ''?>"><?=GetMessage("SEARCH_SORT_BY_RANK")?></a>&nbsp;|&nbsp;<b><?=GetMessage("SEARCH_SORTED_BY_DATE")?></b>
			<?else:?>
				<b><?=GetMessage("SEARCH_SORTED_BY_RANK")?></b>&nbsp;|&nbsp;<a href="<?=$arResult["URL"]?>&amp;how=d<?echo $arResult["REQUEST"]["FROM"]? '&amp;from='.$arResult["REQUEST"]["FROM"]: ''?><?echo $arResult["REQUEST"]["TO"]? '&amp;to='.$arResult["REQUEST"]["TO"]: ''?>"><?=GetMessage("SEARCH_SORT_BY_DATE")?></a>
			<?endif;?>
			</p>
		</div>
	<?else:?>
		<?ShowNote(GetMessage("SEARCH_NOTHING_TO_FOUND"));?>
	<?endif;?>
</div>

<?if($arResult["VISUAL_PARAMS"]["THEME_COLOR"]):?>
	<style>
		.search-page hr, .search-page input[type=text], .search-page input[type=submit], .ag-spage-clarify-item, .ag-spage-clarify-item:hover {
			border-color: <?=$arResult["VISUAL_PARAMS"]["THEME_COLOR"]?> !important;
		}
		.search-page input[type=submit] {
			background-color: <?=$arResult["VISUAL_PARAMS"]["THEME_COLOR"]?> !important;
		}
	</style>
<?endif;?>