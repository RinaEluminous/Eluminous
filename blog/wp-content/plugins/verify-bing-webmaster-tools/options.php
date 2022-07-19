<div class="wrap">
<h2>Bing Webmaster Tools</h2>

<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>
<?php settings_fields('bing_webmaster_tools'); ?>

<p>Insert your Bing Webmaster Tools verification meta-tag below:</p>

<textarea name="bwebmasters_code" id="bwebmasters_code" rows="3"  cols="65" >
<?php echo get_option('bwebmasters_code'); ?> </textarea>


<input type="hidden" name="action" value="update" />

<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>

</form>
Have a question? Drop us a question at <a href="http://onlineads.lt/?utm_source=WordPress&utm_medium=Bing+Webmaster+Tools+-+Options+page&utm_campaign=WordPress+plugins" title="Bing Webmaster Tools">OnlineAds.lt</a>
</div>
