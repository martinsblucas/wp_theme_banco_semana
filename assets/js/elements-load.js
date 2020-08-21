$ = jQuery;



$(document).ready(r => {


    $('.card-img').on('load', l => {

        const img = $(l.target);

        const colWithoutImg = $('main [class^=col]:not(:has(.card-img))');

        const col = img.closest('[class^=col]');

        col.show('slow');

        colWithoutImg.show('slow');

    });

    $('.card-img').on('error', l => {

        const img = $(l.target);

        const col = img.closest('[class^=col]');

        col.show('slow');

    });


});