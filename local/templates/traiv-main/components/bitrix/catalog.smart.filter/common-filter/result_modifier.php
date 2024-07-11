<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?function showCommonFilter($arItem){?>
	<?$arCur = current($arItem["VALUES"]);?>
	<div class="smart-search__cell smart-search__box">
		<select >
			<option data-role="<?="all_".$arCur["CONTROL_ID"]?>">
				<? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
			</option>
			<?
			foreach ($arItem["VALUES"] as $val => $ar):?>
				<option data-role="<?=$ar["CONTROL_ID"]?>">
					<?=$ar["VALUE"]?>
				</option>
			<?endforeach?>
		</select>
	</div>
	<div data-container='filter-inputs' style="display: none">
		<input
			type="radio"
			value=""
			name="<? echo $arCur["CONTROL_NAME_ALT"] ?>"
			id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
			onclick="smartFilter.click(this)"
			/>
		<?foreach($arItem["VALUES"] as $val => $ar):?>
			<input
				type="radio"
				value="<? echo $ar["HTML_VALUE_ALT"] ?>"
				name="<? echo $ar["CONTROL_NAME_ALT"] ?>"
				id="<? echo $ar["CONTROL_ID"] ?>"
				<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
				onclick="smartFilter.click(this)"
				/>
		<?endforeach;?>
	</div>
<?}?>