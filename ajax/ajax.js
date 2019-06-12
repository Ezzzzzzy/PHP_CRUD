
var script = document.createElement('script');
script.src = "https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js";
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);

$('input[type=radio][name=inlineRadioOptions]').change(function() {
    $.ajax({
        url: "ajax/ups.php",
        type: "POST",
        data: {
            shipping: this.value
        },
        success: function(response){
            document.getElementById("total").innerHTML = "$"+response;
        }
    });
});