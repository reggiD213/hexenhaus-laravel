$("#date_picker").datepicker({inline:!0,altField:"#event_date",dateFormat:"yy-mm-dd",regional:"de",defaultDate:new Date($("#event_date").val())}),$("#event_date").change(function(){$("#date_picker").datepicker("setDate",$(this).val())}),$(function(){$("#event_time").timepicker({timeFormat:"H:i"})}),$("#event_thumb,#band_thumb,#pic_thumb").on("change",function(){var e=new FileReader;e.onload=function(e){document.getElementById("image").src=e.target.result},e.readAsDataURL(this.files[0])}),$("#imgInp").change(function(){readURL(this)}),CKEDITOR.replace("event_desc_long");