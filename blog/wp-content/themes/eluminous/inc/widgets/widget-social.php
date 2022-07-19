<?php

/**
 * Social  Widget
 * eluminous Theme
 */
class eluminous_social_widget extends WP_Widget
{
    function eluminous_social_widget(){

       $widget_ops = array('classname' => 'eluminous-social','description' => esc_html__( "eluminous Social Widget" ,'eluminous') );
       parent::__construct('eluminous-social', esc_html__('eluminous Social Widget','eluminous'), $widget_ops);
    }

    function widget($args , $instance) {
    	extract($args);
        $title = isset($instance['title']) ? $instance['title'] : esc_html__('Follow us' , 'eluminous');

        echo $before_widget;
        echo $before_title;
        echo $title;
        echo $after_title;

        /**
         * Widget Content
         */ ?>

        <!-- social icons -->
        <div class="social-icons sticky-sidebar-social">

            <?php eluminous_social_icons(); ?>

        </div><!-- end social icons --><?php

        echo $after_widget;
    }

    function form($instance) {
      if(!isset($instance['title'])) $instance['title'] = esc_html__('Follow us' , 'eluminous'); ?>

      <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title ','eluminous') ?></label>

      <input type="text" value="<?php echo esc_attr($instance['title']); ?>"
                          name="<?php echo $this->get_field_name('title'); ?>"
                          id="<?php $this->get_field_id('title'); ?>"
                          class="widefat" />
      </p><?php
    }

}
?>