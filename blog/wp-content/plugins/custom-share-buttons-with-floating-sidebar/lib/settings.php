 <div style="width: 80%; padding: 10px; margin: 10px;"> 
	<h1>Custom Share Buttons With Floating Sidebar Settings</h1>
<!-- Start Options Form -->

	<form action="options.php" method="post" id="csbwf-sidebar-admin-form">
		
	<div id="csbwf-tab-menu"><a id="csbwfs-general" class="csbwf-tab-links active" >General</a> <a  id="csbwfs-sidebar" class="csbwf-tab-links">Floating Sidebar</a> <a  id="csbwfs-share-buttons" class="csbwf-tab-links">Social Share Buttons</a> <a  id="csbwfs-pro" class="csbwf-tab-links">GO PRO</a> <a  id="csbwfs-support" class="csbwf-tab-links">Support</a></div>
	<p align="right"><span class="submit-btn"><?php echo get_submit_button('Save Settings','button-primary extrabtn','submit','','');?></span></p>
	<div class="csbwfs-setting">
	<!-- General Setting -->	
	<div class="first csbwfs-tab" id="div-csbwfs-general">
	<h2>General Settings</h2>
   <table cellpadding="10">
   <tr>
   <td valign="top" nowrap>
	 <p><input type="checkbox" id="csbwfs_active" name="csbwfs_active" value='1' <?php checked(get_option('csbwfs_active'),1);?>/> <b><?php _e('Enable Sidebar');?> </b></p>
	<p><h3><strong><?php _e('Social Share Button Publish Options:','csbwfs');?></strong></h3></p>
	<p><input type="checkbox" id="publish1" value="yes" name="csbwfs_fpublishBtn" <?php checked(get_option('csbwfs_fpublishBtn'),'yes');?>/><b>Facebook</b></p>
				<p><input type="checkbox" id="publish2" name="csbwfs_tpublishBtn" value="yes" <?php checked(get_option('csbwfs_tpublishBtn'),'yes');?>/> <b>Twitter</b></p>
				<p><input type="checkbox" id="publish4" name="csbwfs_lpublishBtn" value="yes" <?php checked(get_option('csbwfs_lpublishBtn'),'yes');?>/> <b>Linkedin</b></p>
				<p><input type="checkbox" id="publish6" name="csbwfs_ppublishBtn" value="yes" <?php checked(get_option('csbwfs_ppublishBtn'),'yes');?>/> <b>Pinterest</b></p>
				<p><input type="checkbox" id="publish7" name="csbwfs_republishBtn" value="yes" <?php checked(get_option('csbwfs_republishBtn'),'yes');?>/> <b>Reddit</b></p>
				<p><input type="checkbox" id="publish8" name="csbwfs_stpublishBtn" value="yes" <?php checked(get_option('csbwfs_stpublishBtn'),'yes');?>/> <b>Stumbleupon</b></p>
				<p><input type="checkbox" id="publish5" name="csbwfs_mpublishBtn" value="yes" <?php checked(get_option('csbwfs_mpublishBtn'),'yes');?>/> <b>Mail</b></p>
				<?php if(get_option('csbwfs_mpublishBtn')=='yes');{?> 
				<p id="mailmsg"><input type="text" name="csbwfs_mailMessage" id="csbwfs_mailMessage" value="<?php echo get_option('csbwfs_mailMessage');?>" placeholder="your@email.com?subject=Your Subject" size="40" class="regular-text ltr"><br><i>Leave empty to add current page title as subject line and url as body text </i></p>
				<?php } ?>
				<p><input type="checkbox" id="ytBtns" name="csbwfs_ytpublishBtn" value="yes" <?php checked(get_option('csbwfs_ytpublishBtn'),'yes');?>/> <b>Youtube</b></p>
				<p id="ytpath"><input type="text" name="csbwfs_ytPath" id="csbwfs_ytPath" value="<?php echo get_option('csbwfs_ytPath');?>" placeholder="http://www.youtube.com" size="40" class="regular-text ltr"><br>add youtube channel url</p>
				<p><input type="checkbox" id="skBtns" name="csbwfs_skpublishBtn" value="yes" <?php checked(get_option('csbwfs_skpublishBtn'),'yes');?>/> <b>Skype</b></p>
				<p id="skpath"><input type="text" name="csbwfs_skPath" id="csbwfs_skPath" value="<?php echo get_option('csbwfs_skPath');?>" placeholder="skype_user_id" size="40" class="regular-text ltr"><br>Define skype user id</p>
				<p><label><h3 ><strong><?php _e('Define your custom message:','csbwfs');?></strong></h3></label></p>
				<p><label><?php _e('Show:');?></label><input type="text" id="csbwfs_show_btn" name="csbwfs_show_btn" value="<?php echo get_option('csbwfs_show_btn'); ?>" placeholder="Show Buttons" size="40"/></p>
				<p><label><?php _e('Hide:');?></label><input type="text" id="csbwfs_hide_btn" name="csbwfs_hide_btn" value="<?php echo get_option('csbwfs_hide_btn'); ?>" placeholder="Hide Buttons" size="40"/></p>
				<p><label><?php _e('Message:');?></label><input type="textbox" id="csbwfs_share_msg" name="csbwfs_share_msg" value="<?php echo get_option('csbwfs_share_msg'); ?>" placeholder="Share This With Your Friends" size="40"/></p>
		</td>
   <td valign="top" style="border-left:1px solid #ccc;padding-left:20px;">
	 <h2>Shortcode</h2>
	 <code>[csbwfs_buttons buttons='fb,tw,li,pi,yt,re,st,ml,sk']</code> <br>(sk-Skype, tw-Twitter, li-Linkedin, pi-Pinterest, yt-Youtube, re-Reddit, st-Stumbleupon/Mix, ml-Mail, sk-Skype) 
	<p style="font-size:16px;">Watch given below video to view addon features and settings</p>
	<iframe width="100%" height="500" src="https://www.youtube.com/embed/L8UAqBbqqoU?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
	<h2><a href="http://www.wp-experts.in/products/share-buttons-with-floating-sidebar-pro-addon" target="_blank" class="contact-author"><strong>Click Here</strong></a> to download addon.</h2>
   </tr>
   </table>
	</div>
	<!-- Floating Sidebar -->
	<div class="csbwfs-tab" id="div-csbwfs-sidebar">
	<h2>Floating Sidebar Settings</h2>
	<table>
			<tr>
				<th nowrap><?php echo 'Siderbar Position:';?></th>
				<td>
				<select id="csbwfs_position" name="csbwfs_position" >
				<option value="left" <?php selected(get_option('csbwfs_position'),'left');?>>Left</option>
				<option value="right" <?php selected(get_option('csbwfs_position'),'right');?>>Right</option>
				<option value="bottom" <?php selected(get_option('csbwfs_position'),'bottom');?>>Bottom</option>
				</select>
				</td>
			</tr>
			<tr>
				<th>&nbsp;</th>
				<td><input type="checkbox" id="csbwfs_rmSHBtn" name="csbwfs_rmSHBtn" value="yes" <?php checked(get_option('csbwfs_rmSHBtn'),'yes');?>/> <strong><?php _e('Remove Show/Hide Button:','csbwfs');?></strong></td>
			</tr>
			<tr><th nowrap valign="top"><?php echo 'Delay Time: '; ?></th><td><input type="text" name="csbwfs_delayTimeBtn" id="csbwfs_delayTimeBtn" value="<?php echo get_option('csbwfs_delayTimeBtn')?get_option('csbwfs_delayTimeBtn'):0;?>"  size="40" class="regular-text ltr"><br><i>Publish share buttons after given time(millisecond)</i></td></tr>
				<tr>
				<th>&nbsp;</th>
				<td><input type="checkbox" id="csbwfs_deactive_for_mob" name="csbwfs_deactive_for_mob" value="yes" <?php checked(get_option('csbwfs_deactive_for_mob'),'yes');?>/><?php _e('Disable Sidebar For Mobile','csbwfs');?></td>
			</tr>
			<tr><th></th>
				<td><input type="checkbox" id="csbwfs_auto_hide" name="csbwfs_auto_hide" value="yes" <?php checked(get_option('csbwfs_auto_hide'),'yes');?>/><?php _e('Auto Hide Sidebar On Page Load','csbwfs');?></td>
			</tr>
			<tr><th>&nbsp;</th><td><input type="checkbox" id="csbwfs_hide_home" value="yes" name="csbwfs_hide_home" <?php checked(get_option('csbwfs_hide_home'),'yes');?>/>Hide Sidebar On Home Page</td></tr>
			<tr><td colspan="2"><strong><h4>Social Share Button Images 32X32 (Optional) :</h4></strong></td></tr>
			<tr><td colspan="2" align="right"><input type="button" id="csbwfs_resetpage" value="Reset"></td></tr>
			<tr>
			<th><?php echo 'Facebook:';?></th>
			<td class="csbwfsButtonsImg" id="csbwfsButtonsFbImg">
	       <input type="text" id="csbwfs_fb_image" name="csbwfs_fb_image" value="<?php echo get_option('csbwfs_fb_image'); ?>" placeholder="Insert facebook button image path" size="30" class="inputButtonid"/> <input id="csbwfs_fb_image_button" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="csbwfs_fb_bg" data-default-color="#305891" class="color-field" name="csbwfs_fb_bg" value="<?php echo get_option('csbwfs_fb_bg'); ?>" size="20"/>&nbsp;&nbsp;<input type="text" id="csbwfs_fb_title"  name="csbwfs_fb_title" value="<?php echo get_option('csbwfs_fb_title'); ?>" placeholder="Share on facebook" size="20" class="csbwfs_title"/>
			</td>
			</tr>
			<tr><th><?php echo 'Twitter:';?></th>
				<td class="csbwfsButtonsImg" id="csbwfsButtonsTwImg">		
				<input type="text" id="csbwfs_tw_image" name="csbwfs_tw_image" value="<?php echo get_option('csbwfs_tw_image'); ?>" placeholder="Insert twitter button image path" size="30" class="inputButtonid"/><input id="csbwfs_tw_image_button" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="csbwfs_tw_bg" name="csbwfs_tw_bg" value="<?php echo get_option('csbwfs_tw_bg'); ?>" data-default-color="#2ca8d2" class="color-field"  size="20"/>&nbsp;&nbsp;<input type="text" id="csbwfs_tw_title"  name="csbwfs_tw_title" value="<?php echo get_option('csbwfs_tw_title'); ?>" placeholder="Share on twitter" size="20" class="csbwfs_title"/>
				</td>
			</tr>
			<tr>
				<th><?php echo 'Linkedin:';?></th>
				<td class="csbwfsButtonsImg" id="csbwfsButtonsLiImg">
				<input type="text" id="csbwfs_li_image" name="csbwfs_li_image" value="<?php echo get_option('csbwfs_li_image'); ?>" placeholder="Insert Linkedin button image path" class="inputButtonid" size="30" class="buttonimg"/><input id="csbwfs_li_image_button" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="csbwfs_li_bg" name="csbwfs_li_bg" value="<?php echo get_option('csbwfs_li_bg'); ?>" data-default-color="#dd4c39" class="color-field"  size="20"/>&nbsp;&nbsp;<input type="text" id="csbwfs_li_title"  name="csbwfs_li_title" value="<?php echo get_option('csbwfs_li_title'); ?>" placeholder="Share on Linkedin" size="20" class="csbwfs_title"/>
				</td>
			</tr>
			<tr><th><?php echo 'Pintrest:';?></th>
				<td class="csbwfsButtonsImg" id="csbwfsButtonsPiImg">			
				<input type="text" id="csbwfs_pin_image" name="csbwfs_pin_image" value="<?php echo get_option('csbwfs_pin_image'); ?>" class="inputButtonid" placeholder="Insert pinterest button image path" size="30" class="buttonimg"/><input id="csbwfs_pin_image_button" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="csbwfs_pin_bg" name="csbwfs_pin_bg" value="<?php echo get_option('csbwfs_pin_bg'); ?>" data-default-color="#ca2027" class="color-field"  size="20"/>&nbsp;&nbsp;<input type="text" id="csbwfs_pin_title"  name="csbwfs_pin_title" value="<?php echo get_option('csbwfs_pin_title'); ?>" placeholder="Share on pintrest" size="20" class="csbwfs_title"/>
				</td>
			</tr>
		
			<tr><th><?php echo 'Reddit:';?></th>
				<td class="csbwfsButtonsImg" id="csbwfsButtonsReImg">
				<input type="text" id="csbwfs_re_image" name="csbwfs_re_image" value="<?php echo get_option('csbwfs_re_image'); ?>" placeholder="Insert reddit button image path" size="30" class="inputButtonid"/><input id="csbwfs_re_image_button" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="csbwfs_re_bg" name="csbwfs_re_bg" value="<?php echo get_option('csbwfs_re_bg'); ?>" data-default-color="#ff1a00" class="color-field"  size="20"/>&nbsp;&nbsp;<input type="text" id="csbwfs_re_title"  name="csbwfs_re_title" value="<?php echo get_option('csbwfs_re_title'); ?>" placeholder="Share on reddit" size="20" class="csbwfs_title"/>
				</td>
			</tr>
			<tr><th><?php echo 'Stumbleupon:';?></th>
				<td class="csbwfsButtonsImg" id="csbwfsButtonsStImg">
				<input type="text" id="csbwfs_st_image" name="csbwfs_st_image" value="<?php echo get_option('csbwfs_st_image'); ?>" placeholder="Insert stumbleupon button image path" size="30" class="inputButtonid"/><input id="csbwfs_st_image_button" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="csbwfs_st_bg" name="csbwfs_st_bg" value="<?php echo get_option('csbwfs_st_bg'); ?>" data-default-color="#eb4924" class="color-field"  size="20"/>
				&nbsp;&nbsp;<input type="text" id="csbwfs_st_title"  name="csbwfs_st_title" value="<?php echo get_option('csbwfs_st_title'); ?>" placeholder="Share on stumbleupon" size="20" class="csbwfs_title"/>
				</td>
			</tr>
			<tr><th><?php echo 'Mail:';?></th>
				<td class="csbwfsButtonsImg" id="csbwfsButtonsMaImg">
				<input type="text" id="csbwfs_mail_image" name="csbwfs_mail_image" value="<?php echo get_option('csbwfs_mail_image'); ?>" placeholder="Insert mail button image path" size="30" class="inputButtonid"/><input id="csbwfs_mail_image_button" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="csbwfs_mail_bg" name="csbwfs_mail_bg" value="<?php echo get_option('csbwfs_mail_bg'); ?>" data-default-color="#738a8d" class="color-field"  size="20"/>&nbsp;&nbsp;<input type="text" id="csbwfs_mail_title"  name="csbwfs_mail_title" value="<?php echo get_option('csbwfs_mail_title'); ?>" placeholder="Send contact request" size="20" class="csbwfs_title"/>
				</td>
			</tr>
			<tr><th><?php echo 'Youtube:';?></th>
				<td class="csbwfsButtonsImg" id="csbwfsButtonsYtImg">
				<input type="text" id="csbwfs_yt_image" name="csbwfs_yt_image" value="<?php echo get_option('csbwfs_yt_image'); ?>" placeholder="Insert youtube button image path" size="30" class="inputButtonid"/><input id="csbwfs_yt_image_button" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="csbwfs_yt_bg" name="csbwfs_yt_bg" value="<?php echo get_option('csbwfs_yt_bg'); ?>" data-default-color="#ffffff" class="color-field"  size="20"/>&nbsp;&nbsp;<input type="text" id="csbwfs_yt_title"  name="csbwfs_yt_title" value="<?php echo get_option('csbwfs_yt_title'); ?>" placeholder="Youtube" size="20" class="csbwfs_title"/>
				</td>
			</tr>		
			<tr><td colspan="2"><h3><strong>Style(Optional):</strong></h3></td></tr>
			
			<tr>
				<th><?php echo 'Top Margin:';?></th>
				<td>
			
				<input type="textbox" id="csbwfs_top_margin" name="csbwfs_top_margin" value="<?php echo get_option('csbwfs_top_margin'); ?>" placeholder="10% OR 10px" size="10"/>
				</td>
			</tr>
	</table>
	</div>
	<!-- Share Buttons -->
	<div class="csbwfs-tab" id="div-csbwfs-share-buttons">
	<h2>Social Share Buttons Settings</h2>
	<table>
		    <td><?php _e('Enable:','csbwfs');?></td>
				<td colspan="2">
					<input type="checkbox" id="csbwfs_buttons_active" name="csbwfs_buttons_active" value='1' <?php checked(get_option('csbwfs_buttons_active'),1);?>/>
				</td>
		    </tr>
			<tr>
				<th nowrap><?php echo 'Share Button Position:';?></th>
				<td>
				<select id="csbwfs_btn_position" name="csbwfs_btn_position" >
				<option value="left" <?php selected(get_option('csbwfs_btn_position'),'left');?>>Left</option>
				<option value="right" <?php selected(get_option('csbwfs_btn_position'),'right');?>>Right</option>
				</select>
				</td>
			</tr>
			<tr>
				<th nowrap><?php echo 'Display Buttons On ';?></th>
				<td>
				<select id="csbwfs_btn_display" name="csbwfs_btn_display" >
				<option value="below" <?php selected(get_option('csbwfs_btn_display'),'below');?>>Bottom Of The Content</option>
				<option value="above" <?php selected(get_option('csbwfs_btn_display'),'above');?>>Top Of The Content</option>
				</select>
				</td>
			</tr>
			<tr>
				<th nowrap><?php echo 'Share Button Text:';?></th>
				<td>
				<input type="textbox" id="csbwfs_btn_text" name="csbwfs_btn_text" value="<?php echo get_option('csbwfs_btn_text'); ?>" placeholder="Share This!" size="20"/>
				<i>(Leave blank if you want hide button)</i></td>
			</tr>
			<tr><td colspan="2"><strong>Show Share Buttons On :</strong> Home <input type="checkbox" id="csbwfs_page_hide_home" value="yes" name="csbwfs_page_hide_home" <?php checked(get_option('csbwfs_page_hide_home'),'yes');?>/> Page <input type="checkbox" id="csbwfs_page_hide_page" value="yes" name="csbwfs_page_hide_page" <?php checked(get_option('csbwfs_page_hide_page'),'yes');?>/> Post <input type="checkbox" id="csbwfs_page_hide_post" value="yes" name="csbwfs_page_hide_post" <?php checked(get_option('csbwfs_page_hide_post'),'yes');?>/> Category/Archive <input type="checkbox" id="csbwfs_page_hide_archive" value="yes" name="csbwfs_page_hide_archive" <?php checked(get_option('csbwfs_page_hide_archive'),'yes');?>/> <br>
			</td></tr>
			
			<tr><td colspan="2"><strong><h4>Social Share Button Images 32X32 (Optional) :</h4></strong></td></tr>
			<tr><td colspan="2" align="right"><input type="button" id="csbwfsresetpage" value="RESET"></td></tr>
			<tr><th><?php echo 'Facebook:';?></th>
				<td class="csbwfsButtonsImg" id="csbwfsButtonsFbImg2"><input type="text" id="csbwfs_page_fb_image" name="csbwfs_page_fb_image" value="<?php echo get_option('csbwfs_page_fb_image'); ?>" placeholder="Insert facebook button image path" size="40"  class="inputButtonid"/>
                <input id="csbwfs_fb_image_button2" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="csbwfs_page_fb_bg" data-default-color="#305891" class="color-field" name="csbwfs_page_fb_bg" value="<?php echo get_option('csbwfs_page_fb_bg'); ?>" size="20"/>&nbsp;&nbsp;<input type="text" id="csbwfs_page_fb_title"  name="csbwfs_page_fb_title" value="<?php echo get_option('csbwfs_page_fb_title'); ?>" placeholder="Alt Text" size="20" class="csbwfs_title"/>
				</td>
			</tr>
			<tr>
				<th><?php echo 'Twitter:';?></th>
				<td class="csbwfsButtonsImg" id="csbwfsButtonsTwImg2">
				<input type="text" id="csbwfs_page_tw_image" name="csbwfs_page_tw_image" value="<?php echo get_option('csbwfs_page_tw_image'); ?>" placeholder="Insert twitter button image path" size="40" class="inputButtonid"/>
				<input id="csbwfs_tw_image_button2" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="csbwfs_page_tw_bg" data-default-color="#2ca8d2" class="color-field" name="csbwfs_page_tw_bg" value="<?php echo get_option('csbwfs_page_tw_bg'); ?>" size="20"/>&nbsp;&nbsp;<input type="text" id="csbwfs_page_tw_title"  name="csbwfs_page_tw_title" value="<?php echo get_option('csbwfs_page_tw_title'); ?>" placeholder="Alt Text" size="20" class="csbwfs_title"/>
				</td>
			</tr>
			<tr><th><?php echo 'Linkedin:';?></th>
				<td class="csbwfsButtonsImg" id="csbwfsButtonsLiImg2"><input type="text" id="csbwfs_page_li_image" name="csbwfs_page_li_image" value="<?php echo get_option('csbwfs_page_li_image'); ?>" placeholder="Insert Linkedin button image path" size="40" class="inputButtonid"/>
				<input id="csbwfs_li_image_button2" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="csbwfs_page_li_bg" data-default-color="#dd4c39" class="color-field" name="csbwfs_page_li_bg" value="<?php echo get_option('csbwfs_page_li_bg'); ?>" size="20"/>&nbsp;&nbsp;<input type="text" id="csbwfs_page_li_title"  name="csbwfs_page_li_title" value="<?php echo get_option('csbwfs_page_li_title'); ?>" placeholder="Alt Text" size="20" class="csbwfs_title"/>
				</td>
			</tr>
			<tr>
				<th><?php echo 'Pintrest:';?></th>
				<td class="csbwfsButtonsImg" id="csbwfsButtonsPiImg2"><input type="text" id="csbwfs_page_pin_image" name="csbwfs_page_pin_image" value="<?php echo get_option('csbwfs_page_pin_image'); ?>" placeholder="Insert pinterest button image path" size="40" class="inputButtonid"/>
				<input id="csbwfs_pi_image_button2" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="csbwfs_page_pin_bg" data-default-color="#ca2027" class="color-field" name="csbwfs_page_pin_bg" value="<?php echo get_option('csbwfs_page_pin_bg'); ?>" size="20"/>&nbsp;&nbsp;<input type="text" id="csbwfs_page_pin_title"  name="csbwfs_page_pin_title" value="<?php echo get_option('csbwfs_page_pin_title'); ?>" placeholder="Alt Text" size="20" class="csbwfs_title"/>
				</td>
			</tr>
			
			<tr>
				<th><?php echo 'Reddit:';?></th>
				<td class="csbwfsButtonsImg" id="csbwfsButtonsReImg2">
				<input type="text" id="csbwfs_page_re_image" name="csbwfs_page_re_image" value="<?php echo get_option('csbwfs_page_re_image'); ?>" placeholder="Insert reddit button image path" size="40" class="inputButtonid"/>
				<input id="csbwfs_re_image_button2" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="csbwfs_page_re_bg" data-default-color="#ff1a00" class="color-field" name="csbwfs_page_re_bg" value="<?php echo get_option('csbwfs_page_re_bg'); ?>" size="20"/>&nbsp;&nbsp;<input type="text" id="csbwfs_page_re_title"  name="csbwfs_page_re_title" value="<?php echo get_option('csbwfs_page_re_title'); ?>" placeholder="Alt Text" size="20" class="csbwfs_title"/>
				</td>
			</tr>
			<tr>
				<th><?php echo 'Stumbleupon:';?></th>
				<td class="csbwfsButtonsImg" id="csbwfsButtonsStImg2">
				<input type="text" id="csbwfs_page_st_image" name="csbwfs_page_st_image" value="<?php echo get_option('csbwfs_page_st_image'); ?>" placeholder="Insert stumbleupon button image path" size="40" class="inputButtonid"/>
				<input id="csbwfs_st_image_button2" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="csbwfs_page_st_bg" data-default-color="#eb4924" class="color-field" name="csbwfs_page_st_bg" value="<?php echo get_option('csbwfs_page_st_bg'); ?>" size="20"/>&nbsp;&nbsp;<input type="text" id="csbwfs_page_st_title"  name="csbwfs_page_st_title" value="<?php echo get_option('csbwfs_page_st_title'); ?>" placeholder="Alt Text" size="20" class="csbwfs_title"/>
				</td>
			</tr>
			<tr>
				<th><?php echo 'Mail:';?></th>
				<td class="csbwfsButtonsImg" id="csbwfsButtonsMlImg2">
				<input type="text" id="csbwfs_page_mail_image" name="csbwfs_page_mail_image" value="<?php echo get_option('csbwfs_page_mail_image'); ?>" placeholder="Insert mail button image path" size="40" class="inputButtonid"/>
				<input id="csbwfs_ml_image_button2" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="csbwfs_page_mail_bg" data-default-color="#738a8d" class="color-field" name="csbwfs_page_mail_bg" value="<?php echo get_option('csbwfs_page_mail_bg'); ?>" size="20"/>&nbsp;&nbsp;<input type="text" id="csbwfs_page_mail_title"  name="csbwfs_page_mail_title" value="<?php echo get_option('csbwfs_page_mail_title'); ?>" placeholder="Alt Text" size="20" class="csbwfs_title"/>
				</td>
			</tr>
			<tr>
				<th><?php echo 'Youtube:';?></th>
				<td class="csbwfsButtonsImg" id="csbwfsButtonsYtImg2">
				<input type="text" id="csbwfs_page_yt_image" name="csbwfs_page_yt_image" value="<?php echo get_option('csbwfs_page_yt_image'); ?>" placeholder="Insert youtube button image path" size="40" class="inputButtonid"/>
				<input id="csbwfs_yt_image_button2" type="button" value="Upload Image" class="cswbfsUploadBtn"/>&nbsp;&nbsp;<input type="text" id="csbwfs_page_yt_bg" data-default-color="#ffffff" class="color-field" name="csbwfs_page_yt_bg" value="<?php echo get_option('csbwfs_page_yt_bg'); ?>" size="20"/>&nbsp;&nbsp;<input type="text" id="csbwfs_page_yt_title"  name="csbwfs_page_yt_title" value="<?php echo get_option('csbwfs_page_yt_title'); ?>" placeholder="Alt Text" size="20" class="csbwfs_title"/>
				</td>
			</tr>
	</table>
	
	</div>
	<!-- Support -->
	<div class="last author csbwfs-tab" id="div-csbwfs-support">
	
	<h2>Plugin Support</h2>
	
	<p><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=ZEMSYQUZRUK6A" target="_blank" style="font-size: 17px; font-weight: bold;"><img src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" title="Donate for this plugin"></a></p>
	
	<p><strong>Plugin Author:</strong><br><a href="https://www.ep-experts.in" target="_blank">WP-Experts.In Team</a></p>
	<p><a href="mailto:raghunath.0087@gmail.com" target="_blank" class="contact-author">Contact Author</a></p>
	<p><strong>Our Other Plugins:</strong><br>
	<ol>
		<li><a href="https://wordpress.org/plugins/custom-share-buttons-with-floating-sidebar" target="_blank">Custom Share Buttons With Floating Sidebar</a></li>
				<li><a href="https://wordpress.org/plugins/protect-wp-admin/" target="_blank">Protect WP-Admin</a></li>
				<li><a href="https://wordpress.org/plugins/wp-sales-notifier/" target="_blank">WP Sales Notifier</a></li>
				<li><a href="https://wordpress.org/plugins/wp-categories-widget/" target="_blank">WP Categories Widget</a></li>
				<li><a href="https://wordpress.org/plugins/wp-protect-content/" target="_blank">WP Protect Content</a></li>
				<li><a href="https://wordpress.org/plugins/wp-version-remover/" target="_blank">WP Version Remover</a></li>
				<li><a href="https://wordpress.org/plugins/wp-posts-widget/" target="_blank">WP Post Widget</a></li>
				<li><a href="https://wordpress.org/plugins/wp-importer" target="_blank">WP Importer</a></li>
				<li><a href="https://wordpress.org/plugins/wp-csv-importer/" target="_blank">WP CSV Importer</a></li>
				<li><a href="https://wordpress.org/plugins/wp-testimonial/" target="_blank">WP Testimonial</a></li>
				<li><a href="https://wordpress.org/plugins/wc-sales-count-manager/" target="_blank">WooCommerce Sales Count Manager</a></li>
				<li><a href="https://wordpress.org/plugins/wp-social-buttons/" target="_blank">WP Social Buttons</a></li>
				<li><a href="https://wordpress.org/plugins/wp-youtube-gallery/" target="_blank">WP Youtube Gallery</a></li>
				<li><a href="https://wordpress.org/plugins/tweets-slider/" target="_blank">Tweets Slider</a></li>
				<li><a href="https://wordpress.org/plugins/rg-responsive-gallery/" target="_blank">RG Responsive Slider</a></li>
				<li><a href="https://wordpress.org/plugins/cf7-advance-security" target="_blank">Contact Form 7 Advance Security WP-Admin</a></li>
				<li><a href="https://wordpress.org/plugins/wp-easy-recipe/" target="_blank">WP Easy Recipe</a></li>
		</ol>
	</div>
<!-- GO PRO -->
	<div class="last author csbwfs-tab" id="div-csbwfs-pro">
	<h2 style="color:green;text-align:center;"><strong>Pay one time use lifetime!!!!!</strong></h2>
	<table>
	<tr>
	<td valign="top" width="30%">
	<h2>GO PRO</h2>
	<p><a href="https://www.wp-experts.in/products/share-buttons-with-floating-sidebar-pro-addon" target="_blank" class="contact-author">Click here</a> to download addon.</p>
	<p>We have released an add-on for Custom Share Buttons With Floating Sidebar which not only demonstrates the flexibility of CSBWFS, but also adds some important features:</p>
	<iframe width="560" height="450" src="https://www.youtube.com/embed/f_qk4qxAsz8" frameborder="0" allowfullscreen></iframe>
	</td>
	<td><h2>Key Features</h2><hr>
	<ol>
		<li>Responsive Floating Sidebar</li>
		<li>Shortcode</li>
		<li>Hide floating sidebar for any post type</li>
		<li>Hide Floating Sidebar for any taxonomy</li>
		<li>Show Share Buttons for any taxonomy</li>
		<li>Define sidebar/share buttons position</li>
		<li>Responsive Popup box Contact Form</li>
		<li> Shortcode supportable light box</li>
		<li>OG meta tags fields</li>
		<li>Choose different style of sidebar</li>
		<li>Use share buttons as social buttons</li>
		<li>Define Twitter username</li>
		<li>Share count buttons(FB, ST, PIN,Xing and Reddit)</li>
		<li>Manage buttons image, title, background color and url</li>
		<li>10 extra custom sidebar buttons to use it as your button</li>
		<li>Show/Hide social share buttons on specific page/post</li>
		<li>Page specific sidebar position (Left/Right/Bottom)</li>
		<li>add social site official page URL for all social buttons</li>
	</ol>
	</td>
	</tr>
	</table>
	</div>
	</div>
	<span class="submit-btn"><?php echo get_submit_button('Save Settings','button-primary','submit','','');?></span>	
    <?php settings_fields('csbwf_sidebar_options'); ?>
	</form>
<!-- End Options Form -->
	</div>
