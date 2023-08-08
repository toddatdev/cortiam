jQuery(document).ready(function () {
    // var list = $(".more-reviews");
    // var numToShow = 2;
    // var button = $("#moreReviews");
    // var numInList = list.length;
    // list.hide();
    // if (numInList > numToShow) {
    //     button.show();
    // }
    // list.slice(0, numToShow).show();

    // button.click(function () {

    //     alert("they Clicked");
    //     var showing = list.filter(':visible').length;
    //     list.slice(showing - 1, showing + numToShow).fadeIn();
    //     var nowShowing = list.filter(':visible').length;
    //     if (nowShowing >= numInList) {
    //         button.hide();
    //     }
    // });


    $('.rate .ratings_stars').click(function() {

        let star_val = $(this).attr('title');
        let start_rating = $(this).attr('rating-id');
        start_rating = `.start_rating${start_rating}`;
        $(this).prevAll('label').removeClass('checked');
        $(this).prevAll('input').val('');
        $(this).prev('input').val(star_val);
        $(this).prev('input').click();
        $(this).addClass('checked');
        $(this).next().next('label').addClass('checked');
        $(this).nextAll('label').addClass('checked');
        $(this).parent().parent().prev().addClass('click');




    });

});