<?php 





?>

<form id="contactForm1" action="devAjax.php" method="POST">
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="text" name="dfgh" id="dgfhdfg">
    <input type="submit" value="Upload Image" name="submit">
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

    var frm = $('#contactForm1');

    frm.submit(function (e) {

        e.preventDefault();

        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
            success: function (data) {
                console.log('Submission was successful.');
                console.log(data);
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            },
        });
    });
</script>