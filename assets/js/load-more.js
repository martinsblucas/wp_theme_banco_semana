$ = jQuery;
$(document).ready(r => {

    $('article').show('slow');

    const totalPages = Math.ceil(bancoloadmore.wp_query.found_posts / bancoloadmore.posts_per_page);

    !bancoloadmore.wp_query.query.paged ? bancoloadmore.wp_query.query.paged = 1 : null;

    let loadedPages = bancoloadmore.wp_query.query.paged;

    $(window).on('scroll', scrollEvent => {

        const eventTarget = $(scrollEvent.target);
        const card_group_banco = eventTarget.find('.card-group-banco.row');
        const eventTargetScrollTop = eventTarget.scrollTop();
        let cardsOfPage = eventTarget.find(`.page-${loadedPages}`);
        const cardsOfNextPage = eventTarget.find(`.page-${loadedPages + 1}`);

        let lastCardOfPage;
        let lastCardOfPageOffset;

        if (cardsOfPage.length > 0) {

            cardsOfPage = $.grep(cardsOfPage, e => {
                const element = $(e).css("display");
                return element != 'none';
            });
            
            lastCardOfPage = $(cardsOfPage).last();
            lastCardOfPageOffset = lastCardOfPage.offset().top;
        }

        if (lastCardOfPage && cardsOfPage.length > 0 && lastCardOfPageOffset - eventTargetScrollTop < 800 && loadedPages < totalPages && cardsOfNextPage.length === 0) {
            $("#Loading").toggleClass('d-none');
            $("#Loading").toggleClass('d-flex');
            card_group_banco.trigger(`load-more`);
        }

    });


    $(document).on('load-more', '.card-group-banco.row', e => {

        loadedPages++;

        const data = {
            action: 'load_more',
            post_type: bancoloadmore.wp_query.query['post_type'],
            tax_query: bancoloadmore.wp_query.tax_query,
            meta_query: bancoloadmore.wp_query.meta_query,
            s: bancoloadmore.wp_query.query['s'],
            paged: loadedPages,
        };

        $.get(bancoloadmore.ajaxurl, data, r => {

            if (bancoloadmore.wp_query.found_posts > bancoloadmore.posts_per_page) {

                for (const i in r.data.results) {

                    $(e.target).append(r.data.results[i]);

                    $('.card-img').on('load', l => {

                        const img = $(l.target);

                        const col = img.closest('[class^=col]');

                        const colWithoutImg = $('main [class^=col]:not(:has(.card-img))');

                        col.show('slow');

                        colWithoutImg.show('slow');

                        $('.card-img').on('error', l => {

                            const img = $(l.target);

                            const col = img.closest('[class^=col]');

                            col.show('slow');

                        });

                    });
                }
            }


            $("#Loading").toggleClass('d-none');
            $("#Loading").toggleClass('d-flex');


        });

    });

});