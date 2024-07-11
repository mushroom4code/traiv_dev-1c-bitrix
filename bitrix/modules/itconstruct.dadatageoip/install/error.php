<?php

use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
?>
<p>
    <?=Loc::getMessage('ITC_APP_INSTALL_ERROR_TITLE')?>:
    <ul>
        <?foreach ($GLOBALS['ITC_APP_INSTALL_ERROR'] as $error):?>
            <li>
                <?=$error?>
            </li>
        <?endforeach;?>
    </ul>
</p>