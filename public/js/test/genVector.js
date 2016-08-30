$(document).ready(function(){

    console.log("Generate Vector");
    var randomWords = [];

    $('input[name="button"]').click(function(){
        var count = $("input[name='count']").val();

        if ($.isNumeric(count))
        {
            randomWords = sjcl.random.randomWords(count, 0);
            $('p[id="result"]').text(randomWords);
        }
        else
            console.log("Nein, es ist keine Nummer");

    });

    $('input[name="log"]').click(function(){
        console.log(randomWords);
    });

    $('input[name="convert"]').click(function(){

        var base64  = sjcl.codec.base64.fromBits(randomWords);
        var replaced = base64.replace(/[\+\/]/g, '0');

        $("#base64_result").text(base64);
        $("#base64_replaced").text(replaced);
    });
});
