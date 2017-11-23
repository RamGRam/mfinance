$(window).load(function () {

});

$('#BrandIsActive').on('click', function (e) {
    if ($('#BrandAlreadyUsed').val() == 1 && $("#BrandIsActive").is(':checked') == false) {
        $("#BrandUsed_Error").text('Brand is already used by the user, Cannot deactivate this.');
        $("#usedBrand").attr('disabled', 'disabled');
    } else {
        $("#BrandUsed_Error").text('');
        $("#usedBrand").attr('disabled', false);
    }
});

$('#VehicleModelIsActive').on('click', function (e) {

    if ($('#VehicleModelAlreadyUsed').val() == 1 && $("#VehicleModelIsActive").is(':checked') == false) {
        $("#ModelUsed_Error").text('Vahicle Model is already used by the user, Cannot deactivate this.');
        $("#usedModel").attr('disabled', 'disabled');
    } else {
        $("#ModelUsed_Error").text('');
        $("#usedModel").attr('disabled', false);
    }
});


$('#reset').click(function () {
    //$('.select2-container').select2('val', false);
    CKEDITOR.instances.ckText.setData('');
    
});