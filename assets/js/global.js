//disable all console.log, comment if in testing or development
//console.log = function () { };

console.log('[LOAD] global.js');

cookie_config = {
    sameSite: 'strict',
    secure: false,
    expires: 31
};

global_defaults = {
    server_url: "http://127.0.0.1/osc-umpo-apisched/",
    auth_url: "http://127.0.0.1/osc-umpo-apisched/auth",
    dashboard_url: "http://127.0.0.1/osc-umpo-apisched/dashboard",
    VERSION: '2023'
}


//config class
class Config {
    constructor() {
        this.scrollAnchor = false;
        this.sidebarVisible = true;
    }

    setScrollAnchor(value) {
        this.scrollAnchor = value;
    }

    setSidebarVisible(value) {
        this.sidebarVisible = value;
    }
}

class AuthInfo {
    constructor() {
        //all are stored in cookie
        this.id = Cookies.get('id');
        this.session_id = Cookies.get('session_id');
        this.name = Cookies.get('name');
    }

    setAuthInfo(id, session_id, name) {
        this.clearAuthInfo();

        Cookies.set('id', id, { sameSite: cookie_config.sameSite, secure: cookie_config.secure, expires: cookie_config.expires });
        Cookies.set('session_id', session_id, { sameSite: cookie_config.sameSite, secure: cookie_config.secure, expires: cookie_config.expires });
        Cookies.set('name', name, { sameSite: cookie_config.sameSite, secure: cookie_config.secure, expires: cookie_config.expires });

        this.id = id;
        this.session_id = session_id;
        this.name = name;
    }

    getAuthInfo() {
        return {
            id: Cookies.get('id'),
            session_id: Cookies.get('session_id'),
            name: Cookies.get('name')
        };
    }

    clearAuthInfo() {
        this.id = null;
        this.session_id = null;
        this.name = null;

        Cookies.remove('id');
        Cookies.remove('session_id');
        Cookies.remove('name');

        window.location.href = global_defaults.auth_url;
    }

    isAuth() {
        return (Cookies.get('id') != undefined && Cookies.get('session_id') != undefined && Cookies.get('name') != undefined);
    }
}

if (typeof config == 'undefined') {
    var config = new Config();
}

if (typeof auth_info == 'undefined') {
    var auth_info = new AuthInfo();
}

//if user is not auth, redirect to login page, dont check if current url is auth_url
if (window.location.href != global_defaults.auth_url) {
    if (!auth_info.isAuth()) {
        window.location.href = global_defaults.auth_url;
    }
    else {
        console.log('[AUTH] Checking session validity');
        //verify to server
        $.ajax({
            url: global_defaults.server_url + "api/v1/open/session/check", //ask backend for new dedicated endpoint for this
            type: "POST",
            headers: {
                'Authorization': auth_info.session_id
            },
            dataType: "json",
            success: function (data) {
                //color the log green
                console.log('%c[AUTH] Session is valid', 'color: lime'); 
            },
            error: function (data) {
                console.log('%c[AUTH] Session is invalid or expired', 'color: red');
                auth_info.clearAuthInfo();
            }
        });

        //add Authorization header to all ajax request
        $.ajaxSetup({
            headers: {
                'Authorization': auth_info.session_id
            }
        });
        
        //safeguard if session expired when page is loaded
        //override default ajax error handler for 403
        $(document).ajaxError(function (event, jqxhr, settings, thrownError) {
            if (jqxhr.status == 403) {
                auth_info.clearAuthInfo();
            }
        });
    }
}
else {
    if (auth_info.isAuth()) {
        window.location.href = global_defaults.dashboard_url;
    }
}





//wait document ready
$(document).ready(function () {
    $(".nav-toggler").click(function () {
        $("#nav-side").fadeToggle(200);
    });

    //scroll to anchor
    $(window).scroll(function () {
        if (config.scrollAnchor) {
            var scroll = $(window).scrollTop();
            //stop scroll-spacer at scroll-stopper
            if (scroll > $('#scroll-stopper').offset().top - $(window).height()) {
                $('#scroll-spacer').css('height', $('#scroll-stopper').offset().top - $(window).height());
            } else {
                $('#scroll-spacer').css('height', scroll);
            }
        }
    });

    $('#bottom-version').html(global_defaults.VERSION);

    //for every form-counter, add event listener to change it's valie by number of char inside it's for
    $('.form-counter').each(function () {
        var counter = $(this);
        var for_id = counter.attr('for');
        var for_element = $('#' + for_id);
        var for_max = for_element.attr('maxlength');
        for_element.on('keyup', function () {
            counter.html(for_element.val().length + '/' + for_max);
        });
        //also on change
        for_element.on('change', function () {
            counter.html(for_element.val().length + '/' + for_max);
        });
    });
});

//function to show bottom info
function bin(message, category, expiry=2000){
    colors = {
        'info': 'primary',
        'success': 'success',
        'warning': 'warning',
        'danger': 'danger',
        'default': 'dark'
    }

    //if color not found, use default
    if (colors[category] == undefined) {
        category = 'default';
    }

    $('#bottom-info').html(message);
    //remove all bg-* class
    $('#bottom-info').removeClass(function (index, className) {
        return (className.match(/(^|\s)bg-\S+/g) || []).join(' ');
    });

    $('#bottom-info').addClass('bg-' + colors[category]);
    
    $('#bottom-info').fadeIn(200);
    setTimeout(function(){
        $('#bottom-info').fadeOut(200);
    }, expiry);
}

//idr formatter
formatter = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 0
})

function build_row(data, except = [], num = false, custom_column = false) {
    var row = "<tr>";
    if (num) {
        row += "<td class='text-center'>" + num + "</td>";
    }
    for (var key in data) {
        if (except.indexOf(key) == -1) {
            row += "<td>" + data[key] + "</td>";
        }
    }
    if (custom_column) {
        row += custom_column;
    }

    row += "</tr>";
    return row;
}

function validate_email(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

function animate_text(selector, text, speed = 100, by_word = false) {

    $(selector).html("");
    var i = 0;
    var words = text.split(" ");
    var interval = setInterval(function () {
        if (by_word) {
            if (i < words.length) {
                $(selector).append(words[i] + " ");
                i++;
            } else {
                clearInterval(interval);
            }
        } else {
            if (i < text.length) {
                $(selector).append(text[i]);
                i++;
            } else {
                clearInterval(interval);
            }
        }
    }, speed);
}