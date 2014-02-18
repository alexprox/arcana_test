function err(text) {
    msg(text, 'danger');
}
function msg(text, type) {
    if(type === undefined) {
        type = 'info';
    }
    var bottom = 0;
    $('.alert-js').each(function(){
        bottom += parseInt($(this).css('width'));
    });
    $('body').append('<div class="alert alert-js alert-'+type+' alert-dismissable" style="bottom: '+bottom+'px">'
            +'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
            +text
            +'</div>');
}
$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('button.ajax, input[type="button"].ajax, input[type="submit"].ajax').on('click touchstart', function(e) {
        var form = $(this).parent();
        var data = {};
        form.find('textarea, input, select').each(function() {
            if ($(this).attr('name')) {
                data[$(this).attr('name')] = $(this).is('textarea') ? $(this).text() : $(this).val();
            }
        });
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: data
        }).done(function(r) {
            if(r.err !== undefined) {
                err(r.err);
            }
            if(r.msg !== undefined) {
                msg(r.msg);
            }
            if(r.redirect !== undefined) {
                location.href = r.redirect;
            }
            if(r.msg === undefined && r.err === undefined) {
                console.log(r);
            }
        }).fail(function() {
            console.log("error");
        });
        e.preventDefault();
        return false;
    });
});