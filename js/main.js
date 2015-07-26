function check_form(id_input,regex,msg_vide,erreur) {
    valid = true;
    if ($("#"+id_input).length === 0)
        return true;
    if($("#"+id_input).val() === "") {
        $("#"+id_input).next(".form_error").fadeIn().text(msg_vide);
        valid = false;
    }
    else if(!$("#"+id_input).val().match(regex)) {
        valid = false;
        $("#"+id_input).next(".form_error").fadeIn().text(erreur);
    }
    else
        $("#"+id_input).next(".form_error").fadeOut();
    return valid;
}

function changeStyle() {
     var modeList = false;
    $('#thumbnails').click(function() {
        if(modeList) {
            $('.list').find('li').removeClass("liste").addClass("thumbnails");
            modeList=false;
        }
    });
    $('#list').click(function() {
        if(!modeList) {
            $('.list').find('li').removeClass("thumbnails").addClass("liste");
            modeList=true;
        }
    });
}

function filtre(id_input,id_ul) {
    $("#"+id_input).focus().keyup(function() {
        var input = $(this);
        var val = input.val();
        if(val == '') {
            $("#"+id_ul+" li").show();
            $("#"+id_ul+" span").removeClass('highlighted');
            return true;
        }
        var regexp = '\\b(.*)';
        for(var i in val) {
            regexp += '('+val[i]+')(.*)';
        }
        regexp += '\\b';
        $("#"+id_ul+"li").show();
        $("#"+id_ul).find('a>span').each(function() {
            var span = $(this);
            var resulats = span.text().match(new RegExp(regexp,'i'));
            if(resulats) {
                var string = '';
                for (var i in resulats) {
                    if(i > 0) {
                        if(i%2 == 0){
                            string += '<span class="highlighted">'+resulats[i]+'</span>';
                        } else {
                            string += resulats[i];
                        }
                    }
                }
                span.empty().append(string);
            } else {
                span.parent().parent().hide();
            }
        });
    });
}

function scrollToTop(id) {
    $('#'+id).click(function() {
        $('html,body').animate({scrollTop: 0}, 'slow');
    });
    $(window).scroll(function(){
        if($(window).scrollTop()<50){
            $('#'+id).fadeOut();
        }
        else{
            $('#'+id).fadeIn();
        }
    });
}

function ajax(div, url, data) {
    $(div).click(function(event) {
        event.preventDefault();
        $.ajax({
            method: "POST",
            url: url,
            data: {
                data
            }
        }).done(function(res) {
            var obj = $.parseJSON(res);

        });
    });
}


$(document).ready(function(){

});
