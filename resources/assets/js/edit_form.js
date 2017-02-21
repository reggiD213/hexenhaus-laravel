//jqueryui datepicker
$('#date_picker').datepicker({
    inline: true,
    altField: '#event_date',
    dateFormat: 'yy-mm-dd',
    regional: 'de',
    defaultDate: new Date($('#event_date').val())
});

$('#event_date').change(function () {
    $('#date_picker').datepicker('setDate', $(this).val());
});

//timepicker
$(function () {
    $('#event_time').timepicker({
        'timeFormat': 'H:i'
    });
});

//image upload preview
$("#event_thumb,#band_thumb").on('change', function () {
    var reader = new FileReader();

    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("image").src = e.target.result;
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
});

$("#imgInp").change(function () {
    readURL(this);
});

CKEDITOR.replace('event_desc_long');
