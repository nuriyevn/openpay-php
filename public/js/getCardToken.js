$(document).ready(function () {
    OpenPay.setSandboxMode(true);
    OpenPay.setId(DB_ID);
    OpenPay.setApiKey(DB_PUBLIC_KEY);

    $("input[name='button']").click(function(){
        var id = $("input[name='id']").val();

        function displayResultsCard(_message, _response, _sandboxMode)
        {
            console.log(_message + (_response !== null ? ' ' + JSON.stringify(_response) : ''));
        }

        function successCard(response) {
           // displayResultsCard('Request proceessed successfully: ', response);

            var string = JSON.stringify(response);

            $('#cardInfo').html(
                //"Id: " + response.data.id +
                "<br>card_number: " + response.data.card.card_number
                + "<br>holder_name: " + response.data.card.holder_name + "<br>expiration year: " + response.data.card.expiration_year
                + "<br>expiration month: " + response.data.card.expiration_month
                + "<br>Line 1: " + response.data.card.address.line1 + "<br>Line 2: " + response.data.card.address.line2 + "<br>Line 3: " + response.data.card.address.line3
                + "<br>City: " + response.data.card.address.city + "<br>Postal code: " + response.data.card.address.postal_code + "<br>State: " + response.data.card.address.state
                + "<br>County: " + response.data.card.address.country_code);

            //$("input[name='status']").val('OK');
           // $("input[name='id']").val(response.data.id);
        }

        console.log(typeof successCard);
        OpenPay.token.get({"id":id}, successCard);
    });

});