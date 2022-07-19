<?php 
session_start();
?>
<html>
<head><link rel="shortcut icon" href="favicon.ico" >
<link rel="icon" href="animated_favicon1.gif" type="image/gif" >

<script type="text/javascript" language="javascript">
function submitFunction() {
	var email = document.form1.email.value;
	var amount = document.form1.amount.value;
	
try {	
	if (email == '') {
		alert('Please provide email address');
		return false;
	}
	var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;  
   	if (!emailPattern.test(email)) {
		alert('Please provide valid email address');
		return false;
	}
	if (amount == '') {
		alert('Please provide amount');
		return false;
	}
	if (!IsNumeric(amount)) {
		alert('Please provide valid amount');
		return false;
	}
}catch(err){
	alert(err.message);
}

	document.getElementById("li_0_name").value ='Product: '+email;
	document.getElementById("product_id").value =email;

	return true;
}

function IsNumeric(strString)
   //  check for valid numeric strings	
   {
   var strValidChars = "0123456789.-";
   var strChar;
   var blnResult = true;

   if (strString.length == 0) return false;

   //  test strString consists of valid characters listed above
   for (i = 0; i < strString.length && blnResult == true; i++)
      {
      strChar = strString.charAt(i);
      if (strValidChars.indexOf(strChar) == -1)
         {
         blnResult = false;
         }
      }
   return blnResult;
   }

</script>

</head>
<body>


<center>
<img src="image/logo.gif" alt="eLuminous Technologies" />
<Br><Br><Br><Br><font face=verdana size=2><b>
Welcome To the eLuminous Technologies.com </b></font>

<BR><BR><BR><BR>
<font face=verdana size=2><b>Purchase Details Form
<BR><BR>
<table width="100%">
   <form method="post" name="form1" action="https://www.2checkout.com/2co/buyer/purchase" onSubmit="return submitFunction();">
   <input type=hidden name=sid value='67724'>
   <input type="hidden" name="currency_code" value="USD">
   
	<input type=hidden name=product_id id="product_id" >
	<input type='hidden' name='li_0_type' value='product' />
	<input type='hidden' name='li_0_name' id='li_0_name' />
	<input type='hidden' name='li_0_price' value='<?php echo $_SESSION['selected_plan_price']; ?>' />
	<input type='hidden' name='mode' value='2CO' />
	<input type='hidden' name='elumcustom' value='<?php echo $_COOKIE['phpaffiliateid']; ?>' />
	
	<tr>
    	<td width="48%" align="right"><font face=verdana size=2><b>Your Email :: </b></font></td>
    	<td width="52%"><input type=text name=cart_order_id id="email" >
        		
        		</td>
	</tr>
    <tr>
    	<td>&nbsp;</td>
    	<td><font face=verdana size=2><b>Note:Please enter your valid email ID, <br />It will be used for further communication by our team.</b></font> </td>
    </tr>
	<tr>
        <td align="right"><font face=verdana size=2><b>Amount :: ($)</b></font></td>
        <td>
            
            <input type=text name=total id="amount" value="<?php echo $_SESSION['selected_plan_price']; ?>" readonly >
            <input type="hidden" name="currency_vendor" value="<?php echo $_SESSION['selected_plan_price']; ?>">
        </td>
    </tr>
    <tr>
    	<td>&nbsp;</td>
    	<td align="left">
		<input name=submit type=submit value="Continue ->">
       	</td>
    </tr>
   </form>
</table>
<BR><BR>

<a href="http://www.2Checkout.com">2Checkout.com</a>, Inc. is an authorized retailer of eLuminous Technologies.<BR>

<BR><BR>


<!-- Google Code for Virtual Assistant Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1010138418;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "3d8aCP7WzgMQsvrV4QM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1010138418/?value=0&amp;label=3d8aCP7WzgMQsvrV4QM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

</body>
</html>