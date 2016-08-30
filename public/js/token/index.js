function displayResultsCard(_message, _response, _sandboxMode)
{
    console.log(_message + (_response !== null ? ' ' + JSON.stringify(_response) : ''));
}

function successCard(_responseData) {
    displayResultsCard('Request proceessed successfully: ', _responseData);
}

function errorCard(_errorResponseData)
{
    displayResultsCard('An error has been ocurred: ', _errorResponseData);
}

$(document).ready(function() {

    var tokenCreateOnSuccess;
    var tokenCreateOnError;

    OpenPay.setId(DB_ID);
    OpenPay.setApiKey(DB_PUBLIC_KEY);
    OpenPay.setSandboxMode(true);

    var tokenObject = OpenPay.token.create({
        "card_number":"4111111111111111",
        "holder_name":"Juan Perez Ramirez",
        "expiration_year":"20",
        "expiration_month":"12",
        "cvv2":"110",
        "address":{
            "city":"Querétaro",
            "line3":"Queretaro",
            "postal_code":"76900",
            "line1":"Av 5 de Febrero",
            "line2":"Roble 207",
            "state":"Queretaro",
            "country_code":"MX"
        }
    }, successCard, errorCard);

});