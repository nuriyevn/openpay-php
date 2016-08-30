$(document).ready(function () {
    OpenPay.setSandboxMode(true);
    // Setup Form after calling setSandboxMode
    var deviceDataId = OpenPay.deviceData.setup("openpayForm", "deviceIdField");
    //var deviceDataId = OpenPay.deviceData.setup();

    $('#deviceId').text(deviceDataId);
    $('#deviceSessionId').val($('#deviceIdField').val());
});


