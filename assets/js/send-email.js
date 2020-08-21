$ = jQuery;



$(document).ready(r => {

    $(document).on('click', '#sendEmail', e => {

        e.preventDefault();

        const element = $(e.target);
        const form = element.closest('#contactForm');
        const name = form.find('#name');
        const subject = form.find('#subject');
        const email = form.find('#email');
        const text = form.find('#text');
        const status = form.find('#status');

        element.attr('disabled', true);
        status.html(`<p>Aguarde enquanto enviamos seu email...</p>`);
        status.show('medium');

        send_email(name.val(), subject.val(), email.val(), text.val(), form);

        element.attr('disabled', false);

    });

});

const send_email = (name, subject, email, text, form) => {



    const data = {
        action: 'send_email',
        'name': name,
        'subject': subject,
        'email': email,
        'text': text
    };

    const status = form.find('#status');

    $.ajax({
        'method': 'POST',
        'url': sendemail.ajaxurl,
        'data': data,
        'dataType': 'json',
        'success': (data) => {
            const inputs = form.find('input');
            const textarea = form.find('textarea');
            textarea.val('');
            inputs.val('');
            status.html(`<p class="text-success">Seu email foi enviado com sucesso. Entraremos em contato o mais rápido possível!</p>`);
            status.show('medium');
        },
        'error': (error) => {
            status.html(`<p class="text-danger">${error.responseJSON.data}</p>`);
            status.show('medium');
        }
    });

};