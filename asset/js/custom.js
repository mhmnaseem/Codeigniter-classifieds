$(document).ready(function() {
    $('.compare_checkbox').hide();
    $('#compare-action').hide();
    $('.compare_label').hide();
    $('#reset').hide();


    $('#start-compare').click(function() {

        $('.compare_checkbox').show();
        $('#compare-action').show();
        $('#start-compare').hide();
        $('.compare_label').show();
        $('#reset').show();
    });
    $('#reset').click(function() {
        $('input:checkbox').removeAttr('checked');
    });

//    var checkorder = [];
//    $('.compare_checkbox').click(function() {
//
//        checkorder.push($(this).index('input:checkbox'));
//
//        if (checkorder.length > 3) {
//            $('.compare_checkbox').eq(checkorder[0]).prop('checked', false);
//            checkorder.splice(0, 1);
//
//        }
//    });

    var limit = 4;
    $('.compare_checkbox').on('change', function(evt) {

        if ($('.compare_checkbox:checkbox:checked').length >= limit) {
            $(this).prop('checked', false);
            alert("Max Selection Reached");
        }
    });




});


