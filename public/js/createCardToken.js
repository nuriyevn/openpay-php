$(document).ready(function(){
    OpenPay.setSandboxMode(true);
    OpenPay.setId(DB_ID);
    OpenPay.setApiKey(DB_PUBLIC_KEY);

    function displayResultsCard(_message, _response, _sandboxMode)
    {
        console.log(_message + (_response !== null ? ' ' + JSON.stringify(_response) : ''));
    }

    function successCard(response) {
        displayResultsCard('Request proceessed successfully: ', response);
        $("input[name='status']").val('OK');
        $("input[name='id']").val(response.data.id);
    }

    function errorCard(response)
    {
        displayResultsCard('An error has been ocurred: ', response);

        var content = '';
        content += 'Status of error: ' + response.data.status + '<br>';
        content += 'Error: ' + response.message + '<br>';
        content += 'Description: ' + response.data.description + '<br>';
        content += 'ID of the request: ' + response.data.request_id + '<br>';
        $("input[name='status']").val("FAIL");
        $("input[name='id']").val(response.data.id);
        $("#error_details").html(content);
    }

    $("input[name='submit']").click(function(){
        $("input[name='status']").val('');
        $("input[name='id]").val('');
        $("#error_details").html('');

        var card_number = $("input[name='card_number']").val();
        var holder_name = $("input[name='holder_name']").val();
        var expiration_year = $("input[name='expiration_year']").val();
        var expiration_month = $("input[name='expiration_month']").val();
        var cvv2 = $("input[name='cvv2']").val();
        var line1 = $("input[name='line1']").val();
        var line2 = $("input[name='line2']").val();
        var line3 = $("input[name='line3']").val();
        var postal_code = $("input[name='postal_code']").val();
        var city = $("input[name='city']").val();
        var state = $("input[name='state']").val();
        var country_code = $("input[name='country_code']").val();

        OpenPay.token.create({
            "card_number":card_number,
            "holder_name":holder_name,
            "expiration_year":expiration_year,
            "expiration_month":expiration_month,
            "cvv2":cvv2,
            "address":{
                "city":city,
                "line3":line3,
                'postal_code':postal_code,
                'line1':line1,
                'line2':line2,
                'state':state,
                'country_code':country_code
            }
        }, successCard, errorCard);
    });
});