var obj1;

$(document).ready(function(){
    var a="view";
    $.ajax({
        url: "wlist.php",
        type: "POST",
        data: {action: a},
        // dataType: "json",
        // alert("ok");
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR.readyState);
            alert(textStatus)
        },

        success: function (t_array) {

            obj1=eval("("+t_array+")");

            var html = '';
            for (var i = 0; i < obj1.length; i++) {
                html += '<p>'+obj1[i]+'</p>';
            }
            // alert(html);
            document.querySelector(".favourite").innerHTML = html;

        }
    })
})

