$(document).ready(function() {
    if ($('select').val() == "") {
        $('#dvd').hide();
        $('#book').hide();
        $('#furniture').hide();
    }

    $("#productType").change(function() {
        $('#sku').removeAttr('value');
        $('.options').removeAttr('name');
        $('.options').removeAttr('required');

        if ($('select').val() == "") {
            $('#dvd').hide();
            $('#book').hide();
            $('#furniture').hide();
        }

        if ($('select').val() == 'DVD') {
            $("#sku").attr('value', 'DVD');
            $("#size").attr('required', true);
            $("#size").attr('name', 'size');
            $('#dvd').show();
            $('#book').hide();
            $('#furniture').hide();
        }

        if ($('select').val() == 'Book') {
            $("#sku").attr('value', 'book');
            $("#weight").attr('required', true);
            $("#weight").attr('name', 'weight');
            $('#dvd').hide();
            $('#book').show();
            $('#furniture').hide();
        }

        if ($('select').val() == 'Furniture') {
            $("#sku").attr('value', 'furniture');
            $(".furniture").attr('required', true);
            $('#dvd').hide();
            $('#book').hide();
            $('#furniture').show();

            $("#height").attr('name', 'height');
            $("#width").attr('name', 'width');
            $("#length").attr('name', 'length');
        }

    });
});