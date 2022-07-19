<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Display_Latest_Tweets_Widget' ) ) {
	/**
	 * Adds Display_Latest_Tweets_Widget widget.
	 */
	class Display_Latest_Tweets_Widget extends WP_Widget {

		/**
		 * Display_Latest_Tweets_Widget constructor.
		 */
		public function __construct() {
			$widget_options = array(
				'classname'   => 'widget_display_latest_tweets',
				'description' => esc_html__( 'A widget that displays your recent tweets from twitter.', 'display-latest-tweets' )
			);
			parent::__construct(
				'display-latest-tweets',
				esc_html__( 'Latest Tweets', 'display-latest-tweets' ),
				$widget_options
			);

			add_action( 'save_post', array( $this, 'flush_widget_transient' ) );
			add_action( 'deleted_post', array( $this, 'flush_widget_transient' ) );
			add_action( 'switch_theme', array( $this, 'flush_widget_transient' ) );
		}

		/**
		 * Delete transient
		 */
		public function flush_widget_transient() {
			delete_transient( 'display_latest_tweets' );
		}

		/**
		 * Front-end display of widget.
		 *
		 * @see WP_Widget::widget()
		 *
		 * @param array $args Widget arguments.
		 * @param array $instance Saved values from database.
		 */
		public function widget( $args, $instance ) {
			echo $args['before_widget'];

			if ( ! empty( $instance['title'] ) ) {
				echo $args['before_title'] . esc_html( $instance['title'] ) . $args['after_title'];
			}

			// retrieve cache contents on success
			$settings         = array(
				'oauth_access_token'        => isset( $instance['oauth_access_token'] ) ? $instance['oauth_access_token'] : null,
				'oauth_access_token_secret' => isset( $instance['oauth_access_token_secret'] ) ? $instance['oauth_access_token_secret'] : null,
				'consumer_key'              => isset( $instance['consumer_key'] ) ? $instance['consumer_key'] : null,
				'consumer_secret'           => isset( $instance['consumer_secret'] ) ? $instance['consumer_secret'] : null,
			);
			$limit            = isset( $instance['update_count'] ) ? intval( $instance['update_count'] ) : 5;
			$twitter_duration = isset( $instance['twitter_duration'] ) ? intval( $instance['twitter_duration'] ) : 15;

			// Get the tweets.
			$tweets = $this->twitter_timeline( $settings, $limit, $twitter_duration );


			if ( ! empty( $tweets ) ) {

				echo '<ul class="tweets">';
				foreach ( $tweets as $tweet ) {
					// Add links to URL and username mention in tweets.
					$patterns   = array(
						'@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@',
						'/@([A-Za-z0-9_]{1,15})/'
					);
					$replace    = array( '<a href="$1">$1</a>', '<a href="http://twitter.com/$1">@$1</a>' );
					$text       = preg_replace( $patterns, $replace, $tweet['text'] );
					$created    = strtotime( $tweet['time'] );
					$human_time = human_time_diff( $created ) . esc_html__( ' ago', 'display-latest-tweets' );
					echo '<li class="tweet">';
					echo $text;
					echo '<span class="tweet-time">' . $human_time . '</span>';
					echo '</li>';
				}
				echo '</ul>';

			} else {
				if ( current_user_can( 'manage_options' ) ) {
					esc_html_e( 'Error fetching twitter feeds. Please verify the Twitter settings in the widget.', 'display-latest-tweets' );
				}
			}

			echo $args['after_widget'];
		}

		/**
		 * Back-end widget form.
		 *
		 * @see WP_Widget::form()
		 *
		 * @param array $instance Previously saved values from database.
		 */
		public function form( $instance ) {
			$title                     = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Latest Tweets', 'display-latest-tweets' );
			$update_count              = ! empty( $instance['update_count'] ) ? $instance['update_count'] : 5;
			$twitter_duration          = ! empty( $instance['twitter_duration'] ) ? intval( $instance['twitter_duration'] ) : 15;
			$oauth_access_token        = ! empty( $instance['oauth_access_token'] ) ? $instance['oauth_access_token'] : '';
			$oauth_access_token_secret = ! empty( $instance['oauth_access_token_secret'] ) ? $instance['oauth_access_token_secret'] : '';
			$consumer_key              = ! empty( $instance['consumer_key'] ) ? $instance['consumer_key'] : '';
			$consumer_secret           = ! empty( $instance['consumer_secret'] ) ? $instance['consumer_secret'] : '';
			?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>">
					<?php esc_attr_e( 'Title: ', 'display-latest-tweets' ); ?>
                </label>
                <input
                        type="text"
                        class="widefat"
                        id="<?php echo $this->get_field_id( 'title' ); ?>"
                        name="<?php echo $this->get_field_name( 'title' ); ?>"
                        value="<?php echo esc_attr( $title ); ?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'update_count' ); ?>">
					<?php esc_attr_e( 'Number of Tweets to Display: ', 'display-latest-tweets' ); ?>
                </label>
                <input
                        type="number" class="widefat" min="1" max="50" step="1"
                        id="<?php echo $this->get_field_id( 'update_count' ); ?>"
                        name="<?php echo $this->get_field_name( 'update_count' ); ?>"
                        value="<?php echo esc_attr( $update_count ); ?>"
                />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'consumer_key' ); ?>">
					<?php esc_attr_e( 'Consumer Key: ', 'display-latest-tweets' ); ?>
                </label>
                <input
                        class="widefat"
                        id="<?php echo $this->get_field_id( 'consumer_key' ); ?>"
                        name="<?php echo $this->get_field_name( 'consumer_key' ); ?>"
                        type="text"
                        value="<?php echo esc_attr( $consumer_key ); ?>"/>

                <small>Don't know your Consumer Key, Consumer Secret, Access Token and Access Token Secret? <a
                            target="_blank" href="https://apps.twitter.com/">Click here</a></small>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'consumer_secret' ); ?>">
					<?php esc_attr_e( 'Consumer Secret: ', 'display-latest-tweets' ); ?>
                </label>
                <input
                        type="text"
                        class="widefat"
                        id="<?php echo $this->get_field_id( 'consumer_secret' ); ?>"
                        name="<?php echo $this->get_field_name( 'consumer_secret' ); ?>"
                        value="<?php echo esc_attr( $consumer_secret ); ?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'oauth_access_token' ); ?>">
					<?php esc_attr_e( 'Access Token: ', 'display-latest-tweets' ); ?>
                </label>
                <input
                        type="text"
                        class="widefat"
                        id="<?php echo $this->get_field_id( 'oauth_access_token' ); ?>"
                        name="<?php echo $this->get_field_name( 'oauth_access_token' ); ?>"
                        value="<?php echo esc_attr( $oauth_access_token ); ?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'oauth_access_token_secret' ); ?>">
					<?php esc_attr_e( 'Access Token Secret: ', 'display-latest-tweets' ); ?>
                </label>
                <input
                        type="text"
                        class="widefat"
                        id="<?php echo $this->get_field_id( 'oauth_access_token_secret' ); ?>"
                        name="<?php echo $this->get_field_name( 'oauth_access_token_secret' ); ?>"
                        value="<?php echo esc_attr( $oauth_access_token_secret ); ?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'twitter_duration' ); ?>">
					<?php esc_attr_e( 'Load new Tweets every: ', 'display-latest-tweets' ); ?>
                </label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'twitter_duration' ); ?>"
                        name="<?php echo $this->get_field_name( 'twitter_duration' ); ?>">
					<?php
					foreach ( $this->twitter_duration() as $time => $label ) {
						$selected = $time == $twitter_duration ? 'selected' : '';
						echo '<option value="' . $time . '" ' . $selected . '>' . $label . '</option>';
					}
					?>
                </select>
            </p>
			<?php
		}

		/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @see WP_Widget::update()
		 *
		 * @param array $new_instance Values just sent to be saved.
		 * @param array $old_instance Previously saved values from database.
		 *
		 * @return array Updated safe values to be saved.
		 */
		public function update( $new_instance, $old_instance ) {
			$instance = array();

			$instance['update_count']              = intval( $new_instance['update_count'] );
			$instance['twitter_duration']          = intval( $new_instance['twitter_duration'] );
			$instance['title']                     = wp_strip_all_tags( $new_instance['title'] );
			$instance['consumer_key']              = wp_strip_all_tags( $new_instance['consumer_key'] );
			$instance['consumer_secret']           = wp_strip_all_tags( $new_instance['consumer_secret'] );
			$instance['oauth_access_token']        = wp_strip_all_tags( $new_instance['oauth_access_token'] );
			$instance['oauth_access_token_secret'] = wp_strip_all_tags( $new_instance['oauth_access_token_secret'] );

			// Delete widget transient
			$this->flush_widget_transient();

			return $instance;
		}

		/**
		 * Making request to Twitter API
		 *
		 * @param array $settings
		 * @param int $limit
		 * @param int $twitter_duration
		 *
		 * @return array|mixed
		 */
		private function twitter_timeline( $settings, $limit = 5, $twitter_duration = 15 ) {
			// Do we have this information in our transients already?
			$tweets = get_transient( 'display_latest_tweets' );

			if ( false === $tweets ) {
				$twitter_instance = new Twitter_API_WordPress( $settings );
				$timeline         = (array) $twitter_instance->user_timeline( $limit );

				foreach ( $timeline as $tweet ) {
					$tweets[] = array(
						'text' => $tweet->text,
						'time' => $tweet->created_at,
					);
				}

				$transient_expiration = ( intval( $twitter_duration ) * MINUTE_IN_SECONDS );
				set_transient( 'display_latest_tweets', $tweets, $transient_expiration );
			}

			return $tweets;
		}

		private function twitter_duration() {
			return array(
				'5'    => __( '5 Minutes', 'display-latest-tweets' ),
				'15'   => __( '15 Minutes', 'display-latest-tweets' ),
				'30'   => __( '30 Minutes', 'display-latest-tweets' ),
				'60'   => __( '1 Hour', 'display-latest-tweets' ),
				'120'  => __( '2 Hours', 'display-latest-tweets' ),
				'240'  => __( '4 Hours', 'display-latest-tweets' ),
				'720'  => __( '12 Hours', 'display-latest-tweets' ),
				'1440' => __( '24 Hours', 'display-latest-tweets' ),
			);
		}

		/**
		 * Register current class as widget
		 */
		public static function register() {
			register_widget( __CLASS__ );
		}
	}
}

// register Display_Latest_Tweets_Widget widget
add_action( 'widgets_init', array( 'Display_Latest_Tweets_Widget', 'register' ) );
