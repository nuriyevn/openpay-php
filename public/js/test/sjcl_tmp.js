$(document).ready(function () {


    console.log(sjcl);

    var randomWords = sjcl.random.randomWords(6, 0);

    console.log("Random words: " + randomWords);
    var base64  = sjcl.codec.base64.fromBits(randomWords);
    console.log("Base64 : " + base64);

    var replaced = base64.replace(/[\+\/]/g, '0');
    console.log("Replaced: " + replaced);


    /*var ciphertext = sjcl.encrypt("password", "Hello World!");
    var plaintext = sjcl.decrypt("password", ciphertext);

    console.log(ciphertext);
    console.log(plaintext);*/

    var _deviceData = function () {
        console.log('Device data function is called');
    };

    _deviceData();
    _deviceData._hostname = "https://api.openpay.mx/";

    console.log(_deviceData._hostname);


    _deviceData['setup'] = function(){
        console.log('Setup of device Data');
    };

    _deviceData['setup']();
    _deviceData.setup();

});