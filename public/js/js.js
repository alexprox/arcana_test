function err(text) {
    msg(text, 'danger');
}
function msg(text, type) {
    if (type === undefined) {
        type = 'info';
    }
    var bottom = 0;
    $('.alert-js').each(function() {
        bottom += parseInt($(this).css('width'));
    });
    $('body').append('<div class="alert alert-js alert-' + type + ' alert-dismissable" style="bottom: ' + bottom + 'px">'
            + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
            + text
            + '</div>');
}
function ajax_done(r) {
    if (r.err !== undefined) {
        err(r.err);
    }
    if (r.msg !== undefined) {
        msg(r.msg);
    }
    if (r.redirect !== undefined) {
        location.href = r.redirect;
    }
    if(r.tweeted !== undefined && r.tweeted) {
        location.href = location.href;
    }
    if (r.msg === undefined && r.err === undefined) {
        console.log(r);
    }
}
$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('button.ajax, input[type="button"].ajax, input[type="submit"].ajax').on('click touchstart', function(e) {
        var form = $(this).parents('form');
        form.find('input[name="tweet"]').attr('rows', 1);
        var data = {};
        form.find('textarea, input, select').each(function() {
            if ($(this).attr('name')) {
                data[$(this).attr('name')] = $(this).val();
            }
        });
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: data
        }).done(function(r){
            ajax_done(r);
        }).fail(function() {
            console.log("error");
        });
        e.preventDefault();
        return false;
    });
    $('textarea').on('focus', function(){
        $(this).attr('rows', 4);
    });
    $('.counter').each(function() {
        var form = $(this).parents('form');
        var input = form.find('[name="' + $(this).attr('for') + '"]');
        if (input) {
            input.on('keydown keyup change', function() {
                var form = $(this).parents('form');
                var counter = form.find('.counter[for="' + $(this).attr('name') + '"]');
                var maximum = counter.attr('max');
                maximum = maximum ? parseInt(maximum) : 0;
                if (maximum != 0) {
                    var count = $(this).val().length;
                    if (count == maximum + 1) {
                        var text = $(this).val();
                        $(this).val(text.substr(0, text.length - 1));
                    } else if (maximum >= count) {
                        counter.text(maximum - count);
                    }
                }
            });
        }
    });
    $('.find-username').on('click touchstart', function(e) {
        var name = $.trim($(this).parent().find('[name="find-username"]').val());
        location.href = '/user/'+name;
    });
    $('.reply').on('click touchstart', function(e) {
        $('.reply-modal [name="tweet_id"]').val($(this).attr("for"));
    });
    $('.retweet').on('click touchstart', function(e) {
        $.ajax({
            type: 'POST',
            url: '/retweet',
            data: {
                tweet_id: $(this).attr('for')
            }
        }).done(function(r){
            ajax_done(r);
        }).fail(function() {
            console.log("error");
        });
        e.preventDefault();
        return false;
    });
});