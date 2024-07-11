<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?

if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR']) {
	ShowMessage($arResult['ERROR_MESSAGE']);
}

if (!empty($arResult["USER_NAME"]) && empty($arResult['ERROR'])):
	if (!$GLOBALS["just_auth"]) return;

	$GLOBALS["just_auth"] = false;
	?>
	<script>
		$(".auth__dialog.dialog").hide();
		window.location = '<?=$APPLICATION->GetCurPage()?>';
	</script>

	<?
	return;
endif;
?>

<? if ($arResult["FORM_TYPE"] == "login"): ?>
	<form
		name="system_auth_form<?= $arResult["RND"] ?>"
		action="<?= $arResult["AUTH_URL"] ?>"
		method="post"
		class="js-validate">
		<? foreach ($arResult["POST"] as $key => $value): ?>
			<input
				type="hidden"
				name="<?= $key ?>"
				value="<?= $value ?>"/>
		<? endforeach ?>
		<? if ($arResult["BACKURL"] <> ''): ?>
			<input
				type="hidden"
				name="backurl"
				value="<?= $arResult["BACKURL"] ?>"/>
		<? endif ?>
		<input
			type="hidden"
			name="AUTH_FORM"
			value="Y"/>
		<input
			type="hidden"
			name="TYPE"
			value="AUTH"/>

		<input
			type="hidden"
			name="antibot"
			value=""/>


		<div class="form-control-row">
			<input
				type="text"
				placeholder="Логин"
				name="USER_LOGIN"
				value="<?= $arResult["USER_LOGIN"] ?>"
				class="form-control">
		</div>
		<div class="form-control-row">
			<? if ($arResult["BACKURL"] <> ''): ?>
				<input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
			<? endif ?>
			<? foreach ($arResult["POST"] as $key => $value): ?>
				<input type="hidden" name="<?= $key ?>" value="<?= $value ?>"/>
			<? endforeach ?>
			<input type="hidden" name="AUTH_FORM" value="Y"/> <input type="hidden" name="TYPE" value="AUTH"/>

			<div class="form-control-row">
				<input type="password" placeholder="Пароль" name="USER_PASSWORD" class="form-control"
					   autocomplete="off">

				<div class="recovery-link">
					<a href="#" data-target="password-recovery">Забыли пароль?</a>
				</div>
			</div>
			<? if ($arResult["SECURE_AUTH"]): ?>
				<span class="bx-auth-secure" id="bx_auth_secure<?= $arResult["RND"] ?>"
					  title="<? echo GetMessage("AUTH_SECURE_NOTE") ?>" style="display:none">
                    <div class="bx-auth-secure-icon"></div>
                </span>
				<noscript>
                <span class="bx-auth-secure" title="<? echo GetMessage("AUTH_NONSECURE_NOTE") ?>">
                    <div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
                </span>
				</noscript>
				<script type="text/javascript">
					document.getElementById('bx_auth_secure<?=$arResult["RND"]?>').style.display = 'inline-block';
				</script>
			<? endif ?>

			<button class="btn btn--submit btn--fixed">Войти</button>
			<div class="spacer"></div>
			<a href="#" data-target="sign-up" class="btn btn--o btn--fixed">Регистрация</a>
		</div>
	</form>
	<?
else:
	?>
	<form action="<?= $arResult["AUTH_URL"] ?>">
		<table width="95%">
			<tr>
				<td align="center">
					<?= $arResult["USER_NAME"] ?><br/> [<?= $arResult["USER_LOGIN"] ?>]<br/>
					<a
						href="<?= $arResult["PROFILE_URL"] ?>"
						title="<?= GetMessage("AUTH_PROFILE") ?>"><?= GetMessage("AUTH_PROFILE") ?>
					</a><br/>
				</td>
			</tr>
			<tr>
				<td align="center">
					<? foreach ($arResult["GET"] as $key => $value): ?>
						<input type="hidden" name="<?= $key ?>" value="<?= $value ?>"/>
					<? endforeach ?>
					<input type="hidden" name="logout" value="yes"/>
					<input type="submit" name="logout_butt" value="<?= GetMessage("AUTH_LOGOUT_BUTTON") ?>"/>
				</td>
			</tr>
		</table>
	</form>
<? endif ?>


<script>
	$(document).ready(function () {
			$("form[name='system_auth_form<?=$arResult["RND"]?>']").on("submit", function () {
				BX.closeWait();
			});

			$("form[name='system_auth_form<?=$arResult["RND"]?>']").validate({

				submitHandler: function (form) {
					if ($("form[name='system_auth_form<?=$arResult["RND"]?>']").valid() == true) {
						BX.showWait();
						return true;
					} else {
						BX.closeWait();
						return false;
					}
				},


				rules: {
					'USER_LOGIN': {
						required: true,
						email: false,
					},
				},

				messages: {
					'USER_LOGIN': "",

				}
			});
		}
	)

</script>