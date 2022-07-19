<script>
jQuery.ajax({
    type: "post",
    dataType: "json",
    url: my_ajax_object.ajax_url,
    data: formData,
    success: function(msg){
        console.log(msg);
    }
});