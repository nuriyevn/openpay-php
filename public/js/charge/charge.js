$(document).ready(function () {
    $("input[name='generate_device_id']").click(function(){
        var deviceDataId = OpenPay.deviceData.setup("#create_charge_form", "device_session_id");
        $("input[name='device_session_id']").val(deviceDataId);
    });
});