$(document).ready(function(){$('.formContact').on('submit',function(e){var obj=$(this);$.ajax({type:'post',url:'post.php',dataType:'json',data:$(this).serialize(),success:function(msg){if(msg.type=='succs'){$("#myModal").modal('show');obj[0].reset()}else{if(msg.fullName!='')
{obj.find(".errfname").html(msg.fullName).show()}
if(msg.email!='')
{obj.find(".erremail").html(msg.email).show()}
if(msg.mobileNo!='')
{obj.find(".errmobileNo").html(msg.mobileNo).show()}}}});e.preventDefault()})})