<?php
/**
 * The template for displaying search forms in eluminous
 *
 * @package eluminous
 */
?>
<form method="get" class="form-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="form-group">
		<div class="input-group">
	  		<span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'eluminous' ); ?></span>
	    	<input type="text" class="form-control search-query" placeholder="<?php _e( 'Search...', 'eluminous' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
	    	<span class="input-group-btn">
	      		<button type="submit" class="btn btn-default" name="submit" id="searchsubmit" value="Search"><span class="glyphicon glyphicon-search"></span></button>
	    	</span>
	    </div>
	</div>
</form>