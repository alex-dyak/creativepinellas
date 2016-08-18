<?php
/**
 * Widgets and Sidebars
 *
 * WordPress Widgets add content and features to your Sidebars. Examples are
 * the default widgets that come with WordPress; for post categories, tag
 * clouds, navigation, search, etc.
 *
 * Sidebar is a theme feature introduced with Version 2.2. It's basically a
 * vertical column provided by a theme for displaying information other than
 * the main content of the web page. Themes usually provide at least one
 * sidebar at the left or right of the content. Sidebars usually contain
 * widgets that an administrator of the site can customize.
 *
 * @link https://codex.wordpress.org/WordPress_Widgets
 * @link https://codex.wordpress.org/Widgets_API
 * @link https://codex.wordpress.org/Sidebars
 *
 * @package WordPress
 * @subpackage W4P-Theme
 */

if ( function_exists( 'register_sidebar' ) ) {
	/**
	 * Add Widget.
	 */
	function w4ptheme_widgets_init() {
		register_sidebar( array(
			'name'          => __( 'Sidebar Widgets', 'w4ptheme' ),
			'id'            => 'sidebar-primary',
			'before_widget' => '<div id="%1$s" class="widget %2$s siteSidebar-item">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => __( 'Sidebar Widgets Post', 'w4ptheme' ),
			'id'            => 'sidebar-primary-post',
			'before_widget' => '<div id="%1$s" class="widget %2$s siteSidebar-item">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => __( 'Sidebar Footer', 'w4ptheme' ),
			'id'            => 'sidebar-footer',
			'before_widget' => '<section class="row column">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => __( 'Sidebar Blog Landing Page', 'w4ptheme' ),
			'id'            => 'sidebar-blog-landing-page',
			'before_widget' => '<div class="medium-8 large-10 column medium-centered">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="u-text--center">',
			'after_title'   => '</h2>',
		) );

		register_widget( 'W4P_Contacts_Widget' );
		register_widget( 'W4P_Social_Profiles_Widget' );
		register_widget( 'Sky_Widgets_Widget' );
		register_widget( 'Custom_Widget_Categories' );

	}
	add_action( 'widgets_init', 'w4ptheme_widgets_init' );
}

/**
 * W4P Contacts Widget Class
 */
class W4P_Contacts_Widget extends WP_Widget {


	function __construct() {
		parent::__construct( false, $name = __( '[W4P] Contacts', 'w4ptheme' ) );
	}

	/** @see WP_Widget::widget -- do not rename this */
	function widget( $args, $instance ) {
		extract( $args );
		$title  = apply_filters( 'widget_title', $instance['title'] ); /* The widget title. */
		$items	= $instance['items'];
		$phone_url = $instance['phone_url'];
		$skype_url = $instance['skype_url'];
		$item_titles = $instance['item_titles'];
		$address = get_option( 'w4p_contacts_address' );
		$phones = get_option( 'w4p_contacts_phones' );
		$skype = get_option( 'w4p_contacts_skype' );
		echo $before_widget; ?>

		<?php if ( $title ) { echo $before_title . $title . $after_title; } ?>
			<?php
			if ( ! empty( $address ) || ! empty( $phones ) || ! empty( $skype ) ) { ?>
				<ul class="contacts-list">
				<?php
				foreach ( $items as $item ) {
					switch ( $item ) {
						case 'address':
							if ( ! empty( $address ) ) { ?>
								<li>
									<?php if ( ! empty( $item_titles ) ) : ?>
										<h4><?php esc_html_e( 'Address:', 'w4ptheme' );?></h4>
									<?php endif; ?>
									<?php echo esc_html( $address ); ?>
								</li>
							<?php }
							break;
						case 'phones':
							if ( ! empty( $phones ) ) { ?>
								<li>
									<?php
									if ( ! empty( $item_titles ) ) : ?>
										<h4><?php esc_html_e( 'Phones:', 'w4ptheme' );?></h4>
									<?php endif;
									foreach ( explode( ',', $phones ) as $phone ) {
										if ( ! empty( $phone ) ) { ?>
												<?php if ( ! empty( $phone_url ) ) : ?>
													<a href="tel:<?php echo esc_attr( trim( $phone ) ); ?>"><?php echo esc_html( trim( $phone ) ); ?></a>&nbsp;
												<?php else : ?>
													<?php echo esc_html( trim( $phone ) ); ?>&nbsp;
												<?php endif; ?>
										<?php }
									} ?>
								</li>
							<?php }
							break;
						case 'skype':
							if ( ! empty( $skype ) ) : ?>
								<li>
									<?php if ( ! empty( $item_titles ) ) : ?>
										<h4><?php esc_html_e( 'Skype:', 'w4ptheme' );?></h4>
									<?php endif; ?>
									<?php if ( ! empty( $skype_url ) ) : ?>
										<a href="skype:<?php echo esc_attr( $skype ); ?>"><?php echo esc_html( $skype ); ?></a>&nbsp;
									<?php else : ?>
										<?php echo esc_html( $skype ); ?>
									<?php endif; ?>
								</li>
							<?php endif; ?>
							<?php break;
					} ?>
				<?php } ?>
				</ul>
			<?php }
		 echo $after_widget;
	}

	/** @see WP_Widget::update -- do not rename this */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['items'] = $new_instance['items'];
		$instance['item_titles'] = $new_instance['item_titles'];
		$instance['phone_url'] = $new_instance['phone_url'];
		$instance['skype_url'] = $new_instance['skype_url'];

		return $instance;
	}

	/** @see WP_Widget::form -- do not rename this */
	function form( $instance ) {
		$item_list = array(
			'Address' => 'address',
			'Phones' => 'phones',
			'Skype' => 'skype',
		);
		// Set up some default widget settings.
		$defaults = array( 'title' => __( 'Contacts', 'w4ptheme' ), 'items' => array(), 'skype_url' => true, 'phone_url' => true, 'item_titles' => false );
		$instance = wp_parse_args( (array) $instance, $defaults );

		// Get widget fields values.
		if ( ! empty( $instance ) ) {
			$title 	= esc_attr( $instance['title'] );
			$items	= $instance['items'];
			$phone_url = $instance['phone_url'];
			$skype_url = $instance['skype_url'];
			$item_titles = $instance['item_titles'];
		} ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'w4ptheme' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'items' ) ); ?>"><?php esc_html_e( 'Choose the Contacts to display:', 'w4ptheme' ); ?></label>
			<select  id="<?php echo esc_attr( $this->get_field_id( 'items' ) ); ?>" class="select-toggle" size="3" multiple="multiple" name="<?php echo esc_attr( $this->get_field_name( 'items' ) ); ?>[]">
				<?php foreach ( $item_list as $label => $item ) { ?>
					<option <?php echo in_array( $item, (array) $items, true ) ? ' selected="selected" ' : ''; ?> value="<?php echo esc_attr( $item ); ?>"><?php echo esc_html( $label ); ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $item_titles, 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'item_titles' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'item_titles' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'item_titles' ) ); ?>"><?php esc_html_e( 'Display item titles', 'w4ptheme' ) ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $phone_url, 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'phone_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone_url' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'phone_url' ) ); ?>"><?php esc_html_e( 'Phones as URL', 'w4ptheme' ) ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $skype_url, 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'skype_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'skype_url' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'skype_url' ) ); ?>"><?php esc_html_e( 'Skype as URL', 'w4ptheme' ) ?></label>
		</p>
	<?php
	}
} /* End class W4P_Contacts_Widget. */

/**
 * W4P Social Profiles Widget Class
 */
class W4P_Social_Profiles_Widget extends WP_Widget {

	function __construct() {
		parent::__construct( false, $name = __( '[W4P] Social Profiles', 'w4ptheme' ) );
	}

	/** @see WP_Widget::widget -- do not rename this */
	function widget( $args, $instance ) {
		extract( $args );
		$title  = apply_filters( 'widget_title', $instance['title'] ); /* The widget title. */
		$items	= $instance['items'];
		echo $before_widget;
		if ( $title ) { echo $before_title . $title . $after_title; }
		$social_profiles = get_option( 'w4p_social_profiles' );
		if ( ! empty( $items ) && ! empty( $social_profiles ) ) {
			$social_profile_index = array();
			foreach ( (array) $social_profiles as $name => $element ) {
				foreach ( $element as $index => $value ) {
					array_push( $social_profile_index, $name . '_' . $index );
				}
			} ?>
			<ul class="social-profile-list">
			<?php
			foreach ( (array) $social_profiles as $name => $element ) {
				foreach ( $element as $index => $value ) { ?>
					<?php if ( in_array( (string) ( $name . '_' . $index ), (array) $items, true ) ) { ?>
						<li>
							<a class="<?php echo esc_attr( $name ); ?>" href="<?php echo esc_url( $value ) ?>"><?php echo esc_html( $name ); ?></a>
						</li>
					<?php } ?>
				<?php }
			} ?>
			</ul>
		<?php }
		echo $after_widget;
	}

	/** @see WP_Widget::update -- do not rename this */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['items'] = $new_instance['items'];

		return $instance;
	}

	/** @see WP_Widget::form -- do not rename this */
	function form( $instance ) {
		// Set up some default widget settings.
		$defaults = array( 'title' => __( 'Social Profiles', 'w4ptheme' ), 'items' => array() );
		$instance = wp_parse_args( (array) $instance, $defaults );

		// Get widget fields values.
		if ( ! empty( $instance ) ) {
			$title 	= esc_attr( $instance['title'] );
			$items	= $instance['items'];
		}
		$social_profiles = get_option( 'w4p_social_profiles' );
		$social_profile_index = array();
		if ( ! empty( $social_profiles ) ) {
			foreach ( (array) $social_profiles as $name => $element ) {
				foreach ( $element as $index => $value ) {
					array_push( $social_profile_index, $name . '_' . $index );
				}
			}
		} ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'w4ptheme' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'items' ) ); ?>"><?php esc_html_e( 'Choose the Social Profiles to display:', 'w4ptheme' ); ?></label><br>
			<select id="<?php echo esc_attr( $this->get_field_id( 'items' ) ); ?>" class="select-toggle" size="<?php echo count( $social_profile_index ); ?>" multiple="multiple" name="<?php echo esc_attr( $this->get_field_name( 'items' ) ); ?>[]" style="min-width: 150px;">
				<?php
				if ( ! empty( $social_profiles ) ) {
					foreach ( (array) $social_profiles as $name => $element ) {
						foreach ( $element as $index => $value ) { ?>
							<option
								<?php echo in_array( (string) ( $name . '_' . $index ), (array) $items, true ) ? ' selected="selected" ' : ''; ?>
								value="<?php echo esc_attr( $name . '_' . $index ); ?>"
								tooltip="<?php echo esc_attr( $value ); ?>"
								title="<?php echo esc_attr( $value ); ?>"
							><?php echo esc_html( ucfirst( $name ) ); ?>
							</option>
						<?php }
					}
				} ?>
			</select>
		</p>
	<?php }
} /* End class W4P_Contacts_Widget. */


include_once( WYWI_PLUGIN_DIR . '/includes/class-widget.php' );

class Sky_Widgets_Widget extends WP_Widget {
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct(
			'sky_widgets_widget', // Base ID
			$name = __( 'Sky Blocks Widget', 'wysiwyg-widgets' ), // Name
			array( 'description' => __('Displays one of your Sky Widget Blocks.', 'wysiwyg-widgets') ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$id = ($instance['wysiwyg-widget-id']) ? $instance['wysiwyg-widget-id'] : 0;

		$show_title = (isset($instance['show_title'])) ? $instance['show_title'] : 1;
		$post = get_post( $id );

		// Get checkbox value.
		$values = get_post_meta( $id, 'add_style' );
		if ( ! empty( $values[0] ) ) {
			if ( $values[0][0] == 'Add Style' ) {
				$args['before_widget'] = '<div id="%1$s" class="widget %2$s siteSidebar-item siteSidebar-item--sky">';
			}
		}

		echo $args['before_widget'];

		if( ! empty( $id ) && $post ) {

			// Allow filtering of content
			$content = apply_filters( 'ww_content', $post->post_content, $id );

			printf( '<!-- Widget by WYSIWYG Widgets v%s - https://wordpress.org/plugins/wysiwyg-widgets/ -->', WYWI_VERSION_NUMBER );

			if( $show_title ) {
				// first check $instance['title'] so titles are not changed for people upgrading from an older version of the plugin
				// titles WILL change when they re-save their widget..
				$title = ( isset( $instance['title'] ) ) ? $instance['title'] : $post->post_title;
				$title = apply_filters( 'widget_title', $title );
				echo $args['before_title'] . $title . $args['after_title'];
			}

			echo $content;
			echo '<!-- / WYSIWYG Widgets -->';

		} elseif( current_user_can( 'manage_options' ) ) { ?>
			<p>
				<?php if( empty( $id ) ) {
					_e( 'Please select a Widget Block to show in this area.', 'wysiwyg-widgets' );
				} else {
					printf( __( 'No widget block found with ID %d, please select an existing Widget Block in the widget settings.', 'wysiwyg-widgets' ), $id );
				} ?>
			</p>
		<?php
		}

		echo $args['after_widget'];

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
		$instance['wysiwyg-widget-id'] = $new_instance['wysiwyg-widget-id'];
		$instance['show_title'] = ( isset($new_instance['show_title'] ) && $new_instance['show_title'] == 1 ) ? 1 : 0;
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		$posts = (array) get_posts(array(
			'post_type' => 'wysiwyg-widget',
			'numberposts' => -1
		));

		$show_title = ( isset( $instance['show_title'] ) ) ? $instance['show_title'] : 1;
		$selected_widget_id = ( isset( $instance['wysiwyg-widget-id'] ) ) ? $instance['wysiwyg-widget-id'] : 0;
		$title = ($selected_widget_id) ? get_the_title( $selected_widget_id ) : 'No widget block selected.';
		?>

		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="hidden" value="<?php echo esc_attr( $title ); ?>" />

		<p>
			<label for="<?php echo $this->get_field_id( 'wysiwyg-widget-id' ); ?>"><?php _e( 'Widget Block to show:', 'wysiwyg-widgets' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('wysiwyg-widget-id'); ?>" name="<?php echo $this->get_field_name( 'wysiwyg-widget-id' ); ?>" required>
				<option value="0" disabled <?php selected( $selected_widget_id, 0 ); ?>>
					<?php if( empty( $posts ) ) {
						_e( 'No widget blocks found', 'wysiwyg-widgets' );
					} else {
						_e( 'Select a widget block', 'wysiwyg-widgets' );
					} ?>
				</option>
				<?php foreach( $posts as $p ) { ?>
					<option value="<?php echo $p->ID; ?>" <?php selected( $selected_widget_id, $p->ID ); ?>><?php echo $p->post_title; ?></option>
				<?php } ?>
			</select>
		</p>

		<p>
			<label><input type="checkbox" id="<?php echo $this->get_field_id( 'show_title' ); ?>" name="<?php echo $this->get_field_name( 'show_title' ); ?>" value="1" <?php checked( $show_title, 1 ); ?> /> <?php _e( "Show title?", "wysiwyg-widgets" ); ?></label>
		</p>

		<p class="help"><?php printf( __( 'Manage your widget blocks %shere%s', 'wysiwyg-widgets' ), '<a href="'. admin_url( 'edit.php?post_type=wysiwyg-widget' ) .'">', '</a>' ); ?></p>
	<?php
	}

}

/**
 * Class Custom_Widget_Categories
 */
class Custom_Widget_Categories extends WP_Widget {

	/**
	 * Sets up a new Categories widget instance.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'custom_widget_categories',
			'description' => __( 'A list or dropdown of categories.' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'custom_widget_categories', __( 'Custom Categories' ), $widget_ops );
	}

	/**
	 * Outputs the content for the current Categories widget instance.
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Categories widget instance.
	 */
	public function widget( $args, $instance ) {
		static $first_dropdown = true;

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Categories' ) : $instance['title'], $instance, $this->id_base );

		$c = ! empty( $instance['count'] ) ? '1' : '0';
		$h = ! empty( $instance['hierarchical'] ) ? '1' : '0';
		$d = ! empty( $instance['dropdown'] ) ? '1' : '0';

		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$cat_args = array(
			'orderby'      => 'name',
			'show_count'   => $c,
			'hierarchical' => $h
		);

		if ( $d ) {
			$dropdown_id = ( $first_dropdown ) ? 'cat' : "{$this->id_base}-dropdown-{$this->number}";
			$first_dropdown = false;

			echo '<label class="screen-reader-text" for="' . esc_attr( $dropdown_id ) . '">' . $title . '</label>';

			$cat_args['show_option_none'] = __( 'Select Category' );
			$cat_args['id'] = $dropdown_id;

			/**
			 * Filter the arguments for the Categories widget drop-down.
			 *
			 * @since 2.8.0
			 *
			 * @see wp_dropdown_categories()
			 *
			 * @param array $cat_args An array of Categories widget drop-down arguments.
			 */
			wp_dropdown_categories( apply_filters( 'widget_categories_dropdown_args', $cat_args ) );
			?>

			<script type='text/javascript'>
				/* <![CDATA[ */
				(function() {
					var dropdown = document.getElementById( "<?php echo esc_js( $dropdown_id ); ?>" );
					function onCatChange() {
						if ( dropdown.options[ dropdown.selectedIndex ].value > 0 ) {
							location.href = "<?php echo home_url(); ?>/?cat=" + dropdown.options[ dropdown.selectedIndex ].value;
						}
					}
					dropdown.onchange = onCatChange;
				})();
				/* ]]> */
			</script>

		<?php
		} else {
			?>
			<ul class="u-list--plain">
				<?php
				$cat_args['title_li'] = '';

				/**
				 * Filter the arguments for the Categories widget.
				 *
				 * @since 2.8.0
				 *
				 * @param array $cat_args An array of Categories widget options.
				 */
				wp_list_categories( apply_filters( 'widget_categories_args', $cat_args ) );
				?>
			</ul>
		<?php
		}

		echo $args['after_widget'];
	}

	/**
	 * Handles updating settings for the current Categories widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['count'] = !empty($new_instance['count']) ? 1 : 0;
		$instance['hierarchical'] = !empty($new_instance['hierarchical']) ? 1 : 0;
		$instance['dropdown'] = !empty($new_instance['dropdown']) ? 1 : 0;

		return $instance;
	}

	/**
	 * Outputs the settings form for the Categories widget.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = sanitize_text_field( $instance['title'] );
		$count = isset($instance['count']) ? (bool) $instance['count'] :false;
		$hierarchical = isset( $instance['hierarchical'] ) ? (bool) $instance['hierarchical'] : false;
		$dropdown = isset( $instance['dropdown'] ) ? (bool) $instance['dropdown'] : false;
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('dropdown'); ?>" name="<?php echo $this->get_field_name('dropdown'); ?>"<?php checked( $dropdown ); ?> />
			<label for="<?php echo $this->get_field_id('dropdown'); ?>"><?php _e( 'Display as dropdown' ); ?></label><br />

			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>"<?php checked( $count ); ?> />
			<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e( 'Show post counts' ); ?></label><br />

			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('hierarchical'); ?>" name="<?php echo $this->get_field_name('hierarchical'); ?>"<?php checked( $hierarchical ); ?> />
			<label for="<?php echo $this->get_field_id('hierarchical'); ?>"><?php _e( 'Show hierarchy' ); ?></label></p>
	<?php
	}

}
