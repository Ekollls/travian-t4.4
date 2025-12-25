$(document).ready(function () {

    $('#tabContentOtelnet').fadeIn();
    $('#tabOtelnet').css('border', '2px solid #f1c40f');
    $('#otelnetselect').addClass('businessSelected').fadeIn();
    $('#otelnetvalue').val('Selected');

    $('#tabContentAkaryakit').fadeIn();
    $('#tabAkaryakit').css('border', '2px solid #ff6648');
    $('#akaryakitselect').addClass('userSelected').fadeIn();
    $('#akaryakitvalue').val('Selected');

    $('#tab1SelectBox').addClass('selectEliptical');
    $('#tab1').fadeIn();

    //$('.footer').css("margin-top", Math.round($('.footer').offset().top - 200));

    $('#one').fadeIn('slow', function () {
        $('#two').fadeIn('slow', function () {
            $('#theree').fadeIn('slow');
        });
    });

    $("#telefonOneren,#telefonOnerilen").mask("(999) 999-9999");
    //$("#MultinetKartNumarasi").mask("9999-9999-9999-99999");

    $("").keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });

    $('.slider-input').jRange({
        from: 0,
        to: 250,
        step: 1,
        scale: [0, 250],
        format: '%s',
        width: 485,
        showLabels: true,
        onstatechange: function (amount) {

            if (amount == 250) {
                amount - 50;
                $('.RewardPrice').text((amount - 50) * 10);
            }
            else if (amount > 200) {
                amount = 2000;
            }
            else {
                $('.RewardPrice').text(amount * 10);
            }


        }
    });

    $('.slider-input2').jRange({
        from: 0,
        to: 250,
        step: 1,
        scale: [0, 250],
        format: '%s',
        width: 485,
        showLabels: true,
        onstatechange: function (amount) {

            if (amount == 250) {
                amount - 50;
                $('.RewardPrice2').text((amount - 50) * 10);
            }
            else if (amount > 200) {
                amount = 2000;
            }
            else {
                $('.RewardPrice2').text(amount * 10);
            }


        }
    });

    $('.slider-input3').jRange({
        from: 0,
        to: 250,
        step: 1,
        scale: [0, 250],
        format: '%s',
        width: 485,
        showLabels: true,
        onstatechange: function (amount) {

            if (amount == 250) {
                amount - 50;
                $('.RewardPrice3').text((amount - 50) * 10);
            }
            else if (amount > 200) {
                amount = 2000;
            }
            else {
                $('.RewardPrice3').text(amount * 10);
            }


        }
    });

    $('.slider-input4').jRange({
        from: 0,
        to: 250,
        step: 1,
        scale: [0, 250],
        format: '%s',
        width: 485,
        showLabels: true,
        onstatechange: function (amount) {

            if (amount == 250) {
                amount - 50;
                $('.RewardPrice4').text((amount - 50) * 10);
            }
            else if (amount > 200) {
                amount = 2000;
            }
            else {
                $('.RewardPrice4').text(amount * 10);
            }


        }
    });
    $('.slider-input5').jRange({
        from: 0,
        to: 250,
        step: 1,
        scale: [0, 250],
        format: '%s',
        width: 485,
        showLabels: true,
        onstatechange: function (amount) {

            if (amount == 250) {
                amount - 50;
                $('.RewardPrice5').text((amount - 50) * 10);
            }
            else if (amount > 200) {
                amount = 2000;
            }
            else {
                $('.RewardPrice5').text(amount * 10);
            }


        }
    });

    $('#le1 ins').text('250+');

    $('#tab1SelectBox').click(function () {
        $('#tab1SelectBox').addClass('selectEliptical');
        $('#tab1').fadeIn();
    });

    function oClear() {
        $('#tabContentOtelnet').fadeOut();
        $('#tabOtelnet').css('border', '0');
        $('#otelnetselect').removeClass('businessSelected').fadeIn();
        $('#otelnetvalue').val('');
    }
    function gClear() {
        $('#tabContentGiftCard').fadeOut();
        $('#tabGiftcard').css('border', '0');
        $('#giftcardselect').removeClass('businessSelected').fadeIn();
        $('#giftcardValue').val('');
    }
    function rClear() {
        $('#tabContentRestonet').fadeOut();
        $('#tabRestonet').css('border', '0');
        $('#restonetselect').removeClass('businessSelected').fadeIn();
        $('#restonetvalue').val('');
    }

    $('#tabOtelnet').click(function () {
        gClear();
        rClear();
        $('#tabContentOtelnet').fadeIn();
        $('#tabOtelnet').css('border', '2px solid #f1c40f');
        $('#otelnetselect').addClass('businessSelected').fadeIn();
        $('#otelnetvalue').val('Selected');
    });

    $('#tabGiftcard').click(function () {
        oClear();
        rClear();
        $('#tabContentGiftCard').fadeIn();
        $('#tabGiftcard').css('border', '2px solid #f1c40f');
        $('#giftcardselect').addClass('businessSelected').fadeIn();
        $('#giftcardValue').val('Selected');
    });

    $('#tabRestonet').click(function () {
        gClear();
        oClear();
        $('#tabContentRestonet').fadeIn();
        $('#tabRestonet').css('border', '2px solid #f1c40f');
        $('#restonetselect').addClass('businessSelected').fadeIn();
        $('#restonetvalue').val('Selected');
    });

    function gNewClear() {
        $('#tabContentGiftCardNew').fadeOut();
        $('#tabGiftCardNew').css('border', '0');
        $('#giftcardselectNew').removeClass('userSelected').fadeIn();
        $('#giftcardvaluenew').val('');
    }

    function aClear() {
        $('#tabContentAkaryakit').fadeOut();
        $('#tabAkaryakit').css('border', '0');
        $('#akaryakitselect').removeClass('userSelected').fadeIn();
        $('#akaryakitvalue').val('');
    }

    $('#tabAkaryakit').click(function () {
        gNewClear();
        $('#tabContentAkaryakit').fadeIn();
        $('#tabAkaryakit').css('border', '2px solid #ff6648');
        $('#akaryakitselect').addClass('userSelected').fadeIn();
        $('#akaryakitvalue').val('Selected');
    });

    $('#tabGiftCardNew').click(function () {
        aClear();
        $('#tabContentGiftCardNew').fadeIn();
        $('#tabGiftCardNew').css('border', '2px solid #ff6648');
        $('#giftcardselectNew').addClass('userSelected').fadeIn();
        $('#giftcardvaluenew').val('Selected');
    });

})