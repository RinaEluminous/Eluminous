$(document).ready(function(){
  $('#signin_btn').click(function(){
      var bt_box_object = bootbox.dialog({
        title: 'Please Sign In',
        closeButton: false,
        message: $('#login_form').html(),
        buttons: {
          ok: {
            label: 'Sign In',
            callback: function(){
              bt_box_object.modal('hide')
            }
          }
        }
      }
    );
  });
});