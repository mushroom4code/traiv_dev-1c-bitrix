function proto_history_restore(id) {
    BX.ajax({
        url: '/bitrix/admin/protobyte.elementhistory_restore_ajax.php',
        data: {
            id
        },
        method: 'POST',
        dataType: 'json',
        timeout: 30,
        async: true,
        processData: true,
        scriptsRunFirst: true,
        emulateOnload: true,
        start: true,
        cache: false,
        onsuccess: function (data) {
            var message_title = BX.message("PROTO_HISTORY_RESTORE_MODAL_TITLE")
            if (data.status == "ok") {
                var message_body = BX.message("PROTO_HISTORY_RESTORE_MODAL_BODY_OK")
            } else {
                var message_body = "Error: " + data.text
            }
            var popup = new BX.CDialog({
                'title': message_title,
                'content': message_body,
                'draggable': true,
                'resizable': true,
                'height': 50,
                'buttons': [btn_ok]
            });
            popup.Show();
        }
    });
}

var btn_ok = {
    title: "Ok",
    id: 'saveok',
    name: 'saveok',
    className: BX.browser.IsIE() && BX.browser.IsDoctype() && !BX.browser.IsIE10() ? '' : 'adm-btn-save',
    action: function () {
        location.reload();
        this.parentWindow.Close();
    }

};