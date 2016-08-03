function displayResultsCard(_message, _response, _sandboxMode)
{
    console.log(_message + (_response !== null ? ' ' + JSON.stringify(_response) : ''));

    
}

function successCard(_responseData) {
    displayResultsCard('Request proceessed successfully: ', _responseData);
}

function errorCard(_errorResponseDate)
{
    displayResultsCard('An error has been ocurred: ', _errorResponseData);
}

$(document).ready(function() {

    var tokenCreateOnSuccess;
    var tokenCreateOnError;

    OpenPay.setId('mfd2pqjabubndytsbea1');
    OpenPay.setApiKey('pk_b23491f8eebe402e8d2f981001552c3c');

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