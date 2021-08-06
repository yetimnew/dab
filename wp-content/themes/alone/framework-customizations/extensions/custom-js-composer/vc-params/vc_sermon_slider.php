<?php
/*
Element Description: VC Sermon Slider
*/

// Element Class
class vcSermonSlider extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        //global $__VcShadowWPBakeryVisualComposerAbstract;
        //add_action( 'init', array( $this, 'vc_sermon_slider_mapping' ) );
        $this->vc_sermon_slider_mapping();
        add_shortcode( 'vc_sermon_slider', array( $this, 'vc_sermon_slider_html' ) );
        //$__VcShadowWPBakeryVisualComposerAbstract->addShortCode('vc_sermon_slider', array( $this, 'vc_sermon_slider_html' ));
    }

    // Element Mapping
    public function vc_sermon_slider_mapping() {

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(
          array(
            'name' => __('Sermon Slider', 'alone'),
            'base' => 'vc_sermon_slider',
            'description' => __('Sermon slider custom layout', 'alone'),
            'category' => __('Theme Elements', 'alone'),
            'icon' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/base-carousel-sermon.png',
            'params' => array(
              array(
                'type' => 'textfield',
                'heading' => __('Number of Posts to Show', 'alone'),
                'param_name' => 'number_posts_show',
                'value' => '5',
                'admin_label' => true,
                'group' => 'Source',
              ),
              array(
                'type' => 'dropdown',
                'heading' => __( 'Data Type', 'alone' ),
                'param_name' => 'data_type',
                'value' => array(
                  __('Recent Posts', 'alone') => 'recent',
                  __('Popular Posts', 'alone') => 'popular',
                  __('Most Commented Posts', 'alone') => 'commented',
                ),
                'std' => 'recent',
                'description' => __( 'Select a post data type', 'alone' ),
                'admin_label' => true,
                'group' => 'Source',
              ),
              array(
                'type' => 'dropdown',
                'heading' => __( 'Select Days', 'alone' ),
                'param_name' => 'days',
                'value' => array(
                  __('All time', 'alone') => '',
                  __('1 Week', 'alone') => '7',
                  __('1 Month', 'alone') => '30',
                  __('6 Month', 'alone') => '180',
                  __('1 Year', 'alone') => '360',
                ),
                'std' => '',
                'admin_label' => false,
                'description' => __('Select a limit day for query or show all time', 'alone'),
                'group' => 'Source',
              ),
              array(
          			'type' => 'exploded_textarea_safe',
          			'heading' => __( 'Categories (ID)', 'alone' ),
          			'param_name' => 'categories',
          			'description' => __( 'Enter categories by ID to narrow output (Note: only listed categories will be displayed, divide categories with linebreak (Enter)).', 'alone' ),
                'group' => 'Source',
              ),
              array(
          			'type' => 'el_id',
          			'heading' => __( 'Element ID', 'alone' ),
          			'param_name' => 'el_id',
          			'description' => __( 'Enter element ID .', 'alone' ),
                'group' => 'Source',
              ),
          		array(
          			'type' => 'textfield',
          			'heading' => __( 'Extra class name', 'alone' ),
          			'param_name' => 'el_class',
          			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'alone' ),
                'group' => 'Source',
              ),
              /*** Layout Options ***/
              array(
                'type' => 'dropdown',
                'heading' => __('Image Size', 'alone'),
                'param_name' => 'image_size',
                'value' => array(
                  array('value' => 'thumbnail', 'label' => esc_html__('Thumbnail', 'alone')),
                  array('value' => 'medium', 'label' => esc_html__('Medium', 'alone')),
                  array('value' => 'medium_large', 'label' => esc_html__('Medium Large', 'alone')),
                  array('value' => 'large', 'label' => esc_html__('Large', 'alone')),
                  array('value' => 'alone-image-large', 'label' => esc_html__('Large (1228 x 691)', 'alone')),
                  array('value' => 'alone-image-medium', 'label' => esc_html__('Medium (614 x 346)', 'alone')),
                  array('value' => 'alone-image-small', 'label' => esc_html__('Small (295 x 166)', 'alone')),
                  array('value' => 'alone-image-square-800', 'label' => esc_html__('Square (800 x 800)', 'alone')),
                  array('value' => 'alone-image-square-300', 'label' => esc_html__('Square (300 x 300)', 'alone')),
                ),
                'std' => 'alone-image-medium',
                'description' => __('Select a image size', 'alone'),
                'group' => 'Layout',
              ),
              array(
                'type' => 'vc_image_picker',
                'heading' => __( 'Select Layout', 'alone' ),
                'param_name' => 'layout',
                'value' => array(
                  'default' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/posts-slider-layout-1.jpg',
                  'block-image' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/posts-slider-layout-2.jpg',
				          'block-image-1' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/give-forms-slider-layout-7.jpg',
                ),
                'std' => 'default',
                'description' => __('Select a layout display', 'alone'),
                'group' => 'Layout',
              ),
              /*** Slider Options ***/
              array(
                'type' => 'textfield',
                'heading' => __('Items', 'alone'),
                'param_name' => 'items',
                'value' => '1',
                'admin_label' => false,
                'description' => __('The number of items you want to see on the screen.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('Margin', 'alone'),
                'param_name' => 'margin',
                'value' => '0',
                'admin_label' => false,
                'description' => __('margin-right(px) on item.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'dropdown',
                'heading' => __('Loop', 'alone'),
                'param_name' => 'loop',
                'value' => array(
                  __('Yes', 'alone') => '1',
                  __('No', 'alone') => '0',
                ),
                'std' => '0',
                'description' => __('Infinity loop. Duplicate last and first items to get loop illusion.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'dropdown',
                'heading' => __('Center', 'alone'),
                'param_name' => 'center',
                'value' => array(
                  __('Yes', 'alone') => '1',
                  __('No', 'alone') => '0',
                ),
                'std' => '0',
                'description' => __('Center item. Works well with even an odd number of items.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('stagePadding', 'alone'),
                'param_name' => __('stage_padding', 'alone'),
                'value' => '0',
                'description' => __('Padding left and right on stage (can see neighbours).', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('startPosition', 'alone'),
                'param_name' => __('start_position', 'alone'),
                'value' => '0',
                'description' => __('Start position or URL Hash string like `#id`.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'dropdown',
                'heading' => __('Nav', 'alone'),
                'param_name' => 'nav',
                'value' => array(
                  __('Yes', 'alone') => '1',
                  __('No', 'alone') => '0',
                ),
                'std' => '0',
                'description' => __('Show next/prev buttons.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'dropdown',
                'heading' => __('Dots', 'alone'),
                'param_name' => 'dots',
                'value' => array(
                  __('Yes', 'alone') => '1',
                  __('No', 'alone') => '0',
                ),
                'std' => '0',
                'description' => __('Show dots navigation.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('slideBy', 'alone'),
                'param_name' => __('slide_by', 'alone'),
                'value' => 1,
                'description' => __('Navigation slide by x. `page` string can be set to slide by page.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'dropdown',
                'heading' => __('Autoplay', 'alone'),
                'param_name' => 'autoplay',
                'value' => array(
                  __('Yes', 'alone') => '1',
                  __('No', 'alone') => '0',
                ),
                'std' => '0',
                'description' => __('Autoplay.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'dropdown',
                'heading' => __('autoplayHoverPause', 'alone'),
                'param_name' => 'autoplay_hover_pause',
                'value' => array(
                  __('Yes', 'alone') => '1',
                  __('No', 'alone') => '0',
                ),
                'std' => '0',
                'description' => __('Pause on mouse hover.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('autoplayTimeout', 'alone'),
                'param_name' => 'autoplay_timeout',
                'value' => '5000',
                'description' => __('Autoplay interval timeout.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('smartSpeed', 'alone'),
                'param_name' => 'smart_speed',
                'value' => '250',
                'description' => __('AutoplaySpeed Calculate. More info to come..', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('Table Items', 'alone'),
                'param_name' => 'responsive_table_items',
                'value' => '1',
                'admin_label' => false,
                'description' => __('The number of items you want to see on the table screen.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('Mobile Items', 'alone'),
                'param_name' => 'responsive_mobile_items',
                'value' => '1',
                'admin_label' => false,
                'description' => __('The number of items you want to see on the mobile screen.', 'alone'),
                'group' => 'Slider Options',
              ),
              array(
                'type' => 'css_editor',
                'heading' => __( 'Css', 'alone' ),
                'param_name' => 'css',
                'group' => __( 'Design options', 'alone' ),
              ),
            ),
          )
        );
    }

    /**
  	 * Parses google_fonts_data and font_container_data to get needed css styles to markup
  	 *
  	 * @param $el_class
  	 * @param $css
  	 * @param $atts
  	 *
  	 * @since 1.0
  	 * @return array
  	 */
    public function getStyles($el_class, $css, $atts) {
      $styles = array();

      /**
  		 * Filter 'VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG' to change vc_custom_heading class
  		 *
  		 * @param string - filter_name
  		 * @param string - element_class
  		 * @param string - shortcode_name
  		 * @param array - shortcode_attributes
  		 *
  		 * @since 4.3
  		 */
  		$css_class = apply_filters( 'vc_sermon_slider_filter_class', 'wpb_theme_custom_element wpb_sermon_slider ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

  		return array(
  			'css_class' => trim( preg_replace( '/\s+/', ' ', $css_class ) ),
  			'styles' => $styles,
  		);
    }

    public function _template($temp = 'default', $params = array()) {
      /**
       * template variables
       * {image_html}, {readmore_html}, {post_link}, {post_excerpt}, {author_link}, {author_name}, {comment_count}
       */

      $thumbnail_default = get_template_directory_uri() . '/assets/images/image-default-2.jpg';
      $image_background = get_the_post_thumbnail_url( $params['{pid}'] , 'large' );
      $bt_post_id = $params['{pid}'];

      $params = array_merge(array(
        '{image_html}'    => '<img src="'. $thumbnail_default .'" class="thumbnail-default" alt="#">',
        '{readmore_html}' => '',
        '{post_title}'    => '',
        '{post_link}'     => '',
        '{post_excerpt}'  => '',
		    '{date}' => get_the_date('d M, Y',$bt_post_id),
        '{date_1}' => get_the_date('d M, Y',$bt_post_id),
        '{author_link}'   => '',
        '{author_name}'   => '',
        '{comment_count}' => 0,
        '{thumbnail_default_bg}' => ! empty( $image_background ) ? $image_background : '',
      ), $params);

      $output = '';
      $template = array();

      /* layout default */
      $template['default'] = implode('', array(
        '<div class="item-inner sermon_slider_template_default">',
          '<div class="post-thumbnail">{image_html}</div>',
          '<div class="post-caption">',
            (! empty($params['{term_list_html}'])) ? '<div class="post-term-list">{term_list_html}</div>' : '',
            '<div class="church-speaker">Speaker:<span> {peaker_sm}</span></div>',
			'<a class="post-title-link" href="{post_link}"><h2 class="post-title" title="{post_title}">{post_title}</h2></a>',
            '<span class="church-date">{date}</span>',

          '</div>',
			'<a class="sermon-media" href="#sm-modal-media-{rand_id}" data-semon-trigger-modal data-semon-id="{pid}" data-toggle="modal"><span class="video"><img src="'.get_template_directory_uri() . '/assets/images/video.png'.'"></span><span class="audio"><img src="'.get_template_directory_uri() . '/assets/images/head.png'.'"></span><span class="cloud"><img src="'.get_template_directory_uri() . '/assets/images/cloud.png'.'"></span><span class="book"><img src="'.get_template_directory_uri() . '/assets/images/book.png'.'"></span></a>',
        '</div>',
      ));
	  $template['block-image'] = implode('', array(
        '<div class="item-inner sermon_slider_template_block-image">',
          '<div class="post-thumbnail">{image_html}</div>',
          '<div class="post-caption">',
			'<a class="sermon-media" href="#sm-modal-media-{rand_id}" data-semon-trigger-modal data-semon-id="{pid}" data-toggle="modal"><span class="video"><img src="'.get_template_directory_uri() . '/assets/images/sermon_icon4.png'.'"></span><span class="audio"><img src="'.get_template_directory_uri() . '/assets/images/sermon_icon3.png'.'"></span><span class="cloud"><img src="'.get_template_directory_uri() . '/assets/images/sermon_icon2.png'.'"></span><span class="book"><img src="'.get_template_directory_uri() . '/assets/images/sermon_icon1.png'.'"></span></a>',
            (! empty($params['{term_list_html}'])) ? '<div class="post-term-list">{term_list_html}</div>' : '',
			'<a class="post-title-link" href="{post_link}"><h2 class="post-title" title="{post_title}">{post_title}</h2></a>',
            '<div class="church-bot">',
				'<span class="church-date">{date}</span>',
				'<div class="church-speaker">Speaker:<span> {author_name}</span></div>',
			'</div>',
          '</div>',
        '</div>',
      ));
      $template['block-image-1'] = implode('', array(
          '<div class="item-inner sermon_slider_template_block-image-1">',
            '<div class="post-thumbnail" style="background: url({thumbnail_default_bg}) no-repeat center center / cover, #fafafa;"><div class="bt-overlay"></div></div>',
            '<div class="post-caption">',
  			       '<a class="sermon-media" href="#sm-modal-media-{rand_id}" data-semon-trigger-modal data-semon-id="{pid}" data-toggle="modal"><span class="video"><i class="fa fa-video-camera" aria-hidden="true"></i></span><span class="audio"><i class="fa fa-headphones" aria-hidden="true"></i></span><span class="cloud"><i class="fa fa-arrow-down" aria-hidden="true"></i></span></a>',
  			       '<a class="post-title-link" href="{post_link}"><h2 class="post-title" title="{post_title}">{post_title}</h2></a>',
                '<div class="church-bot">',
          				'<div class="church-date">Posted: <span>{date_1}</span></div> - ',
          				'<div class="church-author">Pastor: <span>{author_name}</span></div>',
        			  '</div>',
            '</div>',
          '</div>',
        ));

      $template = apply_filters('vc_sermon_slider:template', $template);

      return str_replace(array_keys($params), array_values($params), fw_akg($temp, $template));
    }

    // Element HTML
    public function vc_sermon_slider_html( $atts ) {
      $atts['self'] = $this;
      return fw_render_view(get_template_directory() . '/framework-customizations/extensions/custom-js-composer/vc-elements/vc_sermon_slider.php', array('atts' => $atts), true);
    }

} // End Element Class


// Element Class Init
new vcSermonSlider();
