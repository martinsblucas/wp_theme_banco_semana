$ = jQuery;



$(document).ready(r => {

    $(document).on('click', '#change_pass', e => {

        const element = $(e.target);
        const user_pass = element.siblings('#user_pass');

        element.hide('medium');
        user_pass.show('medium');

    });

});