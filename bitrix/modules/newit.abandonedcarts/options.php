<?php

if (!$USER->IsAdmin()) {
    return;
}

IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/options.php");
IncludeModuleLangFile(__FILE__);

$MODULE_ID = basename(dirname(__FILE__));
CModule::IncludeModule($MODULE_ID);
$abandon = new CAbandon();
global $APPLICATION;
if (($_REQUEST['action'] == 'Statistics')) {
	$APPLICATION->RestartBuffer();
	$answer = $abandon->GetStatistics();	
	echo $answer;
	die();
}

$aTabs = array(
    array(
        "DIV" => "edit1",
        "TAB" => GetMessage("edit1_tab"),
        "ICON" => "pull_path",
        "TITLE" => GetMessage("edit1_title"),
    ),
    array(
        "DIV" => "edit2",
        "TAB" => GetMessage("edit2_tab"),
        "ICON" => "pull_path",
        "TITLE" => GetMessage("edit2_title"),
    ),
);
$tabControl = new CAdminTabControl("tabControl", $aTabs);

if ((strlen($_POST["Update"]) > 0) && check_bitrix_sessid()) {


    if (!empty($_POST["email_field_id"])) {
        COption::SetOptionString($MODULE_ID, "email_field_id", $_POST["email_field_id"]);
    } else {
        COption::SetOptionString($MODULE_ID, "email_field_id", "");
    }
//    if (!empty($_POST["email_prop_code"])) {
//        COption::SetOptionString($MODULE_ID, "email_prop_code", $_POST["email_prop_code"]);
//    } else {
//        COption::SetOptionString($MODULE_ID, "email_prop_code", "");
//    }

    if (!empty($_POST["test_mails"])) {
        COption::SetOptionString($MODULE_ID, "test_mails", $_POST["test_mails"]);
    } else {
        COption::SetOptionString($MODULE_ID, "test_mails", "");
    }

    if (!empty($_POST["testing_mode"])) {
        COption::SetOptionString($MODULE_ID, "testing_mode", $_POST["testing_mode"]);
    } else {
        COption::SetOptionString($MODULE_ID, "testing_mode", "");
    }


    if (!empty($_POST["times"])) {
        COption::SetOptionString($MODULE_ID, "times", $_POST["times"]);
    } else {
        COption::SetOptionString($MODULE_ID, "times", "");
    }

    if (!empty($_POST["agent_on"])) {
        //COption::SetOptionString($MODULE_ID, "mail_count", $_POST["mail_count"]);
    	COption::SetOptionString($MODULE_ID, "agent_on", "Y");
        $ans = CAgent::AddAgent(
            "CAbandon::SendMail();",
            "newit.abandonedcarts",                // идентификатор модуля
            "Y",                      // агент не критичен к кол-ву запусков
            3600,                    // интервал запуска - 1 сутки
            "",                       // дата первой проверки - текущее
            "Y",                      // агент активен
            "",                       // дата первого запуска - текущее
            30
        );
    } else {
        // COption::SetOptionString($MODULE_ID, "mail_count", "");
    	COption::SetOptionString($MODULE_ID, "agent_on", "");
        $ans = CAgent::RemoveModuleAgents("newit_abandonedcarts");
    }
    if (!empty($_POST["site_id"])) {
        COption::SetOptionString($MODULE_ID, "site_id", $_POST["site_id"]);
    } else {
        COption::SetOptionString($MODULE_ID, "site_id", "");
    }
    for ($i = 1; $i <=10; $i++) {
    	if (!empty($_POST["mail_interval_{$i}_days"])) {
    		COption::SetOptionString($MODULE_ID, "mail_interval_{$i}_days", $_POST["mail_interval_{$i}_days"]);
    	}
    	else { 
    		COption::SetOptionString($MODULE_ID, "mail_interval_{$i}_days", "");
    	}
    	if (!empty($_POST["mail_interval_{$i}_hours"])) {
    		COption::SetOptionString($MODULE_ID, "mail_interval_{$i}_hours", $_POST["mail_interval_{$i}_hours"]);
    	}
    	else {
    		COption::SetOptionString($MODULE_ID, "mail_interval_{$i}_hours", "");
    	}
    	if (!empty($_POST["mail_interval_{$i}_minutes"])) {
    		COption::SetOptionString($MODULE_ID, "mail_interval_{$i}_minutes", $_POST["mail_interval_{$i}_minutes"]);
    	}
    	else {
    		COption::SetOptionString($MODULE_ID, "mail_interval_{$i}_minutes", "");
    	}
    }
}

?>

<? CJSCore::Init(array("jquery")); ?>

<form method="post"
      action="<? echo $APPLICATION->GetCurPage() ?>?mid=<?= htmlspecialcharsbx($mid) ?>&lang=<? echo LANG ?>">
    <?php echo bitrix_sessid_post() ?>
    <?php
    //    $rsSites = CSite::GetList($by="sort", $order="desc", Array("NAME" => "www.mysite.ru"));
    //    while ($arSite = $rsSites->Fetch())
    //    {
    //        echo "<pre>"; print_r($arSite); echo "</pre>";
    //    }


    $tabControl->Begin();
    $tabControl->BeginNextTab();
    ?>
    <!--    <tr>-->
    <!--        <td align="right" valign="top" width="50%">--><? //= GetMessage("EMAIL_FIELD_ID") ?><!--</td>-->
    <!--        <td>-->
    <!--            --><? // echo SelectBoxMFromArray($opt.'[]', $arOptParams['VALUES'], $val);?>
    <!--        </td>-->
    <!--    </tr>-->

    <tr>
        <td align="right" valign="top" width="50%"><?= GetMessage("EMAIL_FIELD_ID") ?></td>
        <td>
            <input type="text" size="20" value="<?= COption::GetOptionString($MODULE_ID, "email_field_id"); ?>"
                   name="email_field_id">
        </td>
    </tr>
    <tr class="heading">
		<td colspan="2"><?= GetMessage("TIMES_TITLE") ?></td>
	</tr>
    <!--tr>
        <td align="right" valign="top" width="50%"><?= GetMessage("MAIL_COUNT") ?></td>
        <td>
            <input type="text" size="20" value="<?= COption::GetOptionString($MODULE_ID, "mail_count"); ?>"
                   name="mail_count">

        </td>

    </tr>	

    <tr>

        <td align="right" valign="top" width="50%"><?= GetMessage("TIMES") ?></td>
        <td>
            <input type="text" size="20" value="<?= COption::GetOptionString($MODULE_ID, "times"); ?>"
                   name="times">

        </td>
    </tr-->
    <? 
    	for ($i = 1; $i <=10; $i++) {
    		?>
    		<tr>
		        <td align="right" valign="top" width="50%"><?=GetMessage("NEWIT_ABANDONEDCARTS_OTPRAVKA")?><?= $i ?>-<?=GetMessage("NEWIT_ABANDONEDCARTS_GO_PISQMA_CEREZ")?></td>
		        <td>
		            <input type="text" size="1" value="<?= COption::GetOptionString($MODULE_ID, "mail_interval_{$i}_days"); ?>"
		                   name="mail_interval_<?= $i ?>_days"> <?=GetMessage("NEWIT_ABANDONEDCARTS_DNEY")?><input type="text" size="1" value="<?= COption::GetOptionString($MODULE_ID, "mail_interval_{$i}_hours"); ?>"
		                   name="mail_interval_<?= $i ?>_hours"> <?=GetMessage("NEWIT_ABANDONEDCARTS_CASOV")?><input type="text" size="1" value="<?= COption::GetOptionString($MODULE_ID, "mail_interval_{$i}_minutes"); ?>"
		                   name="mail_interval_<?= $i ?>_minutes"> <?=GetMessage("NEWIT_ABANDONEDCARTS_MINUT")?></td>
		    </tr>
    		<?
    	}    
    ?>
    <tr>
        <td align="right" valign="top" width="50%"><?=GetMessage("NEWIT_ABANDONEDCARTS_AGENT_VKLUCEN")?></td>
        <td>
            <input type="checkbox"
                   size="20"<? if (COption::GetOptionString($MODULE_ID, "agent_on") == "Y"): ?> checked="checked"<? endif ?>
                   value="Y" name="agent_on">
        </td>
    </tr>
	<tr class="heading">
		<td colspan="2"><?=GetMessage("NEWIT_ABANDONEDCARTS_TESTOVYY_REJIM")?></td>
	</tr>
 	<tr>
        <td colspan="2">
            <p style="text-align: center"><span class="adm-info-message" style="margin:0;"><?= GetMessage("TESTING_DESC") ?></span></p>
        </td>
    </tr>
    <tr>
        <td align="right" valign="top" width="50%"><?= GetMessage("TESTING_MODE") ?></td>
        <td>
            <input type="checkbox"
                   size="20"<? if (COption::GetOptionString($MODULE_ID, "testing_mode") == "Y"): ?> checked="checked"<? endif ?>
                   value="Y" onchange="validate()" name="testing_mode" id="testing_mode">
        </td>
    </tr>
    <tr>
        <td align="right" valign="top" width="50%"><?= GetMessage("TEST_MAILS") ?></td>
        <td>
            <input type="text" size="20" value="<?= COption::GetOptionString($MODULE_ID, "test_mails"); ?>"
                   name="test_mails" id="test_mails">

        </td>
    </tr>
   

    <script type="application/javascript">
        function validate() {
            if (document.getElementById('testing_mode').checked) {
                document.getElementById('test_mails').removeAttribute('disabled');
            } else {
                document.getElementById('test_mails').setAttribute('disabled', 'disabled');
            }
        }
        document.onreadystatechange = function () {
            if (document.getElementById('testing_mode').checked) {
                document.getElementById('test_mails').removeAttribute('disabled');
            } else {
                document.getElementById('test_mails').setAttribute('disabled', 'disabled');
            }
        }
    </script>


    <!--    <tr>-->
    <!--        <td align="right" valign="top" width="50%">--><? //= GetMessage("SITE_ID") ?><!--</td>-->
    <!--        <td>-->
    <!--            <input type="text" size="20" value="-->
    <? //= COption::GetOptionString($MODULE_ID, "site_id"); ?><!--"-->
    <!--                   name="site_id">-->
    <!---->
    <!--        </td>-->
    <!--    </tr>-->
    <!--    --><? // $tabControl->Buttons(); ?>
    <? $tabControl->BeginNextTab();
    
	?>
    <div>
	<h3><? echo GetMessage("SELECT_DATES") ?></h3>
	<? 
	$date = new DateTime();
	$date->modify('+1 day');
	$date_end = $date->format("d.m.Y");
	
		
	$date = new DateTime();
	$date->modify('-14 day');
	$date_begin = $date->format("d.m.Y");	
	echo CalendarPeriod("date_from", $date_begin, "date_to", $date_end);
	?> 
	<div style="margin-top:10px;">
	 <input type="button" name="UpdateStatistics" id="update-statistics"
           value="<? echo GetMessage("OBNOVIT") ?>" class="adm-btn-save">
	 </div>
	 <div id="statistics-container">
	<?
	$abandon->GetStatistics(); 	
	?></div>
	<script type="application/javascript">
		$(document).on('click', '#update-statistics', function() {
			$.ajax({
				url: 'settings.php?lang=ru&mid=<?=$MODULE_ID?>&mid_menu=1',
				//dataType: 'json',
				method: 'POST',
				data: {action: 'Statistics', date_from: $('#date_from_calendar_from').val(), date_to: $('#date_to_calendar_to').val()},
				success: function (data) {					
					$('#statistics-container').html(data);					
				}
			});
		});
	</script>
	</div>
    <? $tabControl->Buttons(); ?>

    <input type="submit" name="Update"
           value="<? echo GetMessage("MAIN_SAVE") ?>" class="adm-btn-save">

    <?= bitrix_sessid_post(); ?>


    <? $tabControl->End(); ?>
</form>

