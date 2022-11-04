$(document).ready(function() {
    if ($('select').val() == "") {
        $('#dvd').hide();
        $('#book').hide();
        $('#furniture').hide();
    }

    $("#productType").change(function() {
        $('.options').removeAttr('name');
        $('.options').removeAttr('required');

        if ($('select').val() == "") {
            $('#dvd').hide();
            $('#book').hide();
            $('#furniture').hide();
        }

        if ($('select').val() == 'DVD') {
            $("#size").attr('required', true);
            $("#size").attr('name', 'size');
            $('#dvd').show();
            $('#book').hide();
            $('#furniture').hide();
        }

        if ($('select').val() == 'Book') {
            $("#weight").attr('required', true);
            $("#weight").attr('name', 'weight');
            $('#dvd').hide();
            $('#book').show();
            $('#furniture').hide();
        }

        if ($('select').val() == 'Furniture') {
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