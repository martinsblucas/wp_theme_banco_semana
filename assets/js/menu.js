$ = jQuery;
$(document).ready(r => {
    $(document).scroll(s => {
        const scrollPosition = $(document).scrollTop();
        if(scrollPosition > 0) {
            $('.navbar-brand h1').css({'font-size': '20px'});
            $('.navbar-brand h2').css({'font-size': '18px'});
            $('#header').css({'background-color': 'rgba(255, 255, 255, 1)'});
        }
        else {
            $('.navbar-brand h1').css({'font-size': '26px'});
            $('.navbar-brand h2').css({'font-size': '23px'});
            $('#header').css({'background-color': 'rgba(255, 255, 255, 0.85)'});
        }
    })
});