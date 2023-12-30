$('#tools-sidebar').on('click', function () {
    if (config.sidebarVisible) {
        $('#sidebar').fadeOut(anim_delay, function () {
            $('#mainbar').removeClass('col-md-9').addClass('col-md-12');
            config.setSidebarVisible(false);
        });

        //remove btn-dark from self and add btn-outline-dark
        $(this).removeClass('btn-dark').addClass('btn-outline-dark');

    } else {
        $('#mainbar').removeClass('col-md-12').addClass('col-md-9');
        $('#sidebar').fadeIn(anim_delay, function () {
            config.setSidebarVisible(true);
        });

        //remove btn-outline-dark from self and add btn-dark
        $(this).removeClass('btn-outline-dark').addClass('btn-dark');
    }
});

anim_delay = 250;
//load every .card with 200ms delay
$('.card').each(function (i) {
    //skip #card-selection
    if ($(this).attr('id') == 'card-selection') return;
    $(this).delay(anim_delay * i).fadeIn(anim_delay);
});

config.setScrollAnchor(true);

function fill_select(url, targets, field = 'name', id='id') {
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            data = data.data;
            html = "";
            $.each(data, function (i, item) {
                html += '<option value="' + item[id] + '">' + item[field] + '</option>';
            });

            $.each(targets, function (i, target) {
                $(target).html(html);
            });
        }
    });
}
