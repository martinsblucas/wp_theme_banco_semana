$ = jQuery;



$(document).ready(r => {

    $(document).on('click', '#login', e => {

        e.preventDefault();

        const element = $(e.target);
        const form = element.closest('#loginForm');
        const user_input = form.find('#User');
        const pass_input = form.find('#Pass');

        authenticate_user_ajax(user_input.val(), pass_input.val(), form);

    });

});

const authenticate_user_ajax = (user, pass, form) => {

    const data = {
        action: 'authenticate_user',
        'user_login': user,
        'user_pass': pass
    };

    $.ajax({
       'method': 'POST',
        'url': authenticateuser.ajaxurl,
        'data': data,
        'dataType': 'json',
        'success': (data) => {
            form.submit();
        },
        'error': (error) => {
           const authErrors = form.find('#authErrors');
           authErrors.html(`<p class="text-danger">${error.responseJSON.data}</p>`);
           authErrors.show('medium');
        }
    });

};