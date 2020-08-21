$ = jQuery;

$(document).ready(r => {

    $('#direcao').multiselect({
        afterSelect: function (f) {
            console.log(f);
        },
        columns: 3,
        placeholder: 'Diretores'
    });

    $(document).on('change', '#formDirecao :checkbox', e => {
        let element = $(e.target);
        let element_attr = element.attr('checked');
        let form_group = element.closest('.form-group');
        let select = form_group.find('#direcao');
        let val = select.val();
        let input_hidden = form_group.find('input[name="direcao"]');
        let checkboxes = form_group.find(':checkbox');
        let li = checkboxes.closest('.selected');

        val = Array.isArray(val) ? val[0] : val;

        select.attr('value', null);
        select.attr('value', [null, val]);

        if(element_attr === 'checked') {

            input_hidden.attr('value', val);
            checkboxes.attr('checked', false);
            li.removeClass('selected');
            element.addClass('selected');
            element.attr('checked', true);

        }

        else {

            input_hidden.attr('value', null);
            li.removeClass('selected');

        }

    });

    $('#filtros').multiselect({
        columns: 1,
        placeholder: 'Filtros'
    });

    $('#temas').multiselect({
        columns: 3,
        placeholder: 'Temas'
    });

    $('#raca_e_genero').multiselect({
        columns: 1,
        placeholder: 'Raça e gênero'
    });

    $('#genero').multiselect({
        columns: 1,
        placeholder: 'Gênero'
    });

    $(document).on('click', '.btn-pesquisa_avancada', c => {

        c.preventDefault();

        const btn = $(c.target).closest('.btn');
        btn.toggleClass('active');
        $('#pesquisaAvancada').slideToggle(300);

    })

});