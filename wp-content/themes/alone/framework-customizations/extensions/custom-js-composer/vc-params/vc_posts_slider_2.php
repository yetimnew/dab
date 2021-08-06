<?php
/*
Element Description: VC Post Slider 2
*/

// Element Class
class vcPostsSlider2 extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        //global $__VcShadowWPBakeryVisualComposerAbstract;
        //add_action( 'init', array( $this, 'vc_posts_slider2_mapping' ) );
        $this->vc_posts_slider2_mapping();
        add_shortcode( 'vc_posts_slider2', array( $this, 'vc_posts_slider2_html' ) );
        //$__VcShadowWPBakeryVisualComposerAbstract->addShortCode('vc_posts_slider2', array( $this, 'vc_posts_slider2_html' ));
    }

    // Element Mapping
    public function vc_posts_slider2_mapping() {

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(
          array(
            'name' => __('Posts Slider 2', 'alone'),
            'base' => 'vc_posts_slider2',
            'description' => __('Posts slider custom layout', 'alone'),
            'category' => __('Theme Elements', 'alone'),
            'icon' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/posts-slider-2.png',
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
				          'block-image-3' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/posts-slider-layout-3.jpg',
				          'block-church' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/posts-slider-layout-church.png',
				          'block-events' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/post-slider-event.png',
				          'block-charitable' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/posts-slider-layout-4.jpg',
				          'block-final' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/posts-slider-layout-5.jpg',
                  'style1' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/give-forms-slider-layout-7.jpg',
                  'style2' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/posts-slider-layout-7.jpg',
                  'style3' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/give-goal-layout-square.jpg',
                  'style4' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/posts-slider-layout-7.jpg',
                  'style5' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/posts-slider-layout-4.jpg',
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
  		$css_class = apply_filters( 'vc_posts_slider_2_filter_class', 'wpb_theme_custom_element wpb_posts_slider_2 ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

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
	  global $post;
	  $author_id=$post->post_author;
	  $author_bt = esc_url( get_avatar_url( $author_id , 32 ) );
    $bt_post_id = $params['{pid}'];
	  //var_dump($user_id);
      $params = array_merge(array(
        '{image_html}'    => '<img src="'. $thumbnail_default .'" class="thumbnail-default" alt="#">',
        '{image_author}'    => '<img src="'. $author_bt .'">',
        '{readmore_html}' => '',
        '{post_title}'    => '',
        '{post_link}'     => '',
        '{bt_excerpt}'  => get_the_excerpt($bt_post_id),
		    '{date}' => get_the_date( '\<\s\p\a\n\>d\<\/\s\p\a\n\> M\<\/\b\r\> Y',$bt_post_id ),
		    '{date_final}' => get_the_date( 'd M, Y',$bt_post_id ),
        '{author_link}'   => '',
        '{author_name}'   => '',
        '{comment_count}' => 0,
		    '{thumbnail_default_bg}' => ! empty( $image_background ) ? $image_background : '',
      ), $params);
      $output = '';
      $template = array();

      /* layout default */
      $template['default'] = implode('', array(
        '<div class="item-inner posts_slider_2_template_default">',
          '<div class="post-thumbnail">{image_html} {readmore_html}</div>',
          '<div class="post-caption">',
            (! empty($params['{term_list_html}'])) ? '<div class="post-term-list">{term_list_html}</div>' : '',
            '<a class="post-title-link" href="{post_link}"><h2 class="post-title" title="{post_title}">{post_title}</h2></a>',
            '<div class="post-excerpt">{bt_excerpt}</div>',
            '{readmore_html}',
          '</div>',
        '</div>',
      ));

      /* layout blog-image */
      $template['block-image'] = implode('', array(
        '<div class="item-inner posts_slider_2_template_blog_image">',
          '<div class="post-thumbnail">{image_html} <a class="icon-readmore-post-link" title="{post_title}" href="{post_link}"><i class="ion-ios-arrow-right"></i></a></div>',
          '<div class="post-caption">',
            (! empty($params['{term_list_html}'])) ? '<div class="post-term-list">{term_list_html}</div>' : '',
            '<a class="post-title-link" href="{post_link}"><h2 class="post-title" title="{post_title}">{post_title}</h2></a>',
          '</div>',
        '</div>',
      ));

	  /* layout blog-image-3 */
      $template['block-image-3'] = implode('', array(
        '<div class="item-inner posts_slider_2_template_style_austim">',
          '<div class="post-thumbnail">{image_html}</div>',
          '<div class="post-caption">',
            (! empty($params['{term_list_html}'])) ? '<div class="post-term-date"><span class="ion-android-calendar"></span>{date_final}</div>' : '',
            '<a class="post-title-link" href="{post_link}"><h2 class="post-title" title="{post_title}">{post_title}</h2></a>',
            '<div class="post-author"><span class="pacifico">by: </span><a href="{author_link}"> {author_name}</a></div>',
            '<div class="post-more">{readmore_html}</div>',
          '</div>',
        '</div>',
      ));
	  /* layout block church  */
      $template['block-church'] = implode('', array(
        '<div class="item-inner posts_slider_2_template_style_church">',
          '<div class="post-thumbnail">{image_html}</div>',
          '<div class="post-caption">',
            (! empty($params['{term_list_html}'])) ? '<div class="post-term-date">{date}</div>' : '',
            '<div class="bt-church-meta">',
				'<a class="post-title-link" href="{post_link}"><h2 class="post-title" title="{post_title}">{post_title}</h2></a>',
				'<div class="post-comment"><i class="fa fa-commenting-o" aria-hidden="true"></i> {comment_count} Comments</div>',
				'<div class="post-more">{readmore_html}</div>',
			'</div>',
          '</div>',
        '</div>',
      ));
	  /* layout block events  */
      $template['block-events'] = implode('', array(
        '<div class="item-inner posts_slider_2_template_style_event">',
          '<div class="post-thumbnail">{image_html}</div>',
          '<div class="post-caption">',
            '<div class="bt-church-meta">',
    				'<a class="post-title-link" href="{post_link}"><h2 class="post-title" title="{post_title}">{post_title}</h2></a>',
    				'<div class="post-comment"><i class="fa fa-commenting-o" aria-hidden="true"></i> {comment_count} Comments</div>',
    				'<div class="post-more">{readmore_html}</div>',
    			'</div>',
          '</div>',
		  '<div class="post-term-date"><div class="date">'. get_the_date( '\<\s\p\a\n\>d\<\/\s\p\a\n\> F' ) .'</div></div>',
        '</div>',
      ));
	  /* layout block charitable  */
      $template['block-charitable'] = implode('', array(
        '<div class="item-inner posts_slider_2_template_style_charitable">',
          '<div class="thumb-meta" style="background: url({thumbnail_default_bg}) no-repeat center center / cover, #fafafa;"></div>',
          '<div class="post-caption">',
            '<div class="info-meta">',
    				'<a class="post-title-link" href="{post_link}"><h3 class="post-title" title="{post_title}">{post_title}</h3></a>',
    				'<div class="short-des">{bt_excerpt}</div>',
    				'<div class="post-more">{readmore_html}</div>',
    			'</div>',
          '</div>',
        '</div>',
      ));
	  /* layout block final */
      $template['block-final'] = implode('', array(
        '<div class="item-inner posts_slider_2_template_style_final">',
          '<div class="thumb-meta" style="background: url({thumbnail_default_bg}) no-repeat center center / cover, #fafafa;"></div>',
          '<div class="post-caption">',
			'<div class="post-avatar">{image_author}</div>',
            '<div class="info-meta">',
				'<div class="post-term-date">{date_final}</div>',
				'<a class="post-title-link" href="{post_link}"><h3 class="post-title" title="{post_title}">{post_title}</h3></a>',
				'<div class="short-des">{bt_excerpt}</div>',
			'</div>',
          '</div>',
        '</div>',
      ));

      /* layout style1 */
      $template['style1'] = implode('', array(
        '<div class="item-inner posts_slider_2_template_style1">',
          '<div class="post-thumbnail" style="background: url({thumbnail_default_bg}) no-repeat center center / cover, #fafafa;"><div class="bt-overlay"></div></div>',
          '<div class="post-caption">',
            '<a class="post-title-link" href="{post_link}"><h2 class="post-title" title="{post_title}">{post_title}</h2></a>',
            '<div class="bt-info-cap">',
              '<div class="post-author"><i class="fa fa-user-o" aria-hidden="true"> </i> <a href="{author_link}"> By {author_name}</a></div>',
              '<div class="post-term-date"><i class="fa fa-calendar-o" aria-hidden="true"> </i> {date_final}</div>',
            '</div>',
            '<div class="post-excerpt">{bt_excerpt}</div>',
            '{readmore_html}',
          '</div>',
        '</div>',
      ));
      /* layout style2 */
      $template['style2'] = implode('', array(
        '<div class="item-inner posts_slider_2_template_style2">',
          '<div class="post-thumbnail" style="background: url({thumbnail_default_bg}) no-repeat center center / cover, #fafafa;"><div class="bt-overlay"></div></div>',
          '<div class="post-caption">',
            '<div class="post-author"><a href="{author_link}"> By: {author_name}</a></div>',
            '<a class="post-title-link" href="{post_link}"><h2 class="post-title" title="{post_title}">{post_title}</h2></a>',
            '<div class="post-term-date">{date_final}</div>',
          '</div>',
        '</div>',
      ));
      /* layout style3 */
      $template['style3'] = implode('', array(
        '<div class="item-inner posts_slider_2_template_style3">',
          '<div class="post-caption">',
            '<a class="post-title-link" href="{post_link}"><h2 class="post-title" title="{post_title}">{post_title}</h2></a>',
            '<div class="post-term-date">{date_final}</div>',
            '<div class="post-excerpt">{bt_excerpt}</div>',
            '<div class="post-author"><a href="{author_link}"> By {author_name}</a></div>',
          '</div>',
        '</div>',
      ));
      /* layout style3 */
      $template['style4'] = implode('', array(
        '<div class="item-inner posts_slider_2_template_style4">',
          '<div class="post-thumbnail" style="background: url({thumbnail_default_bg}) no-repeat center center / cover, #fafafa;"><div class="bt-overlay"></div><a href="{post_link}" class="chain"><i class="fa fa-link" aria-hidden="true"></i></a></div>',
          '<div class="post-caption">',
            '<div class="post-term">',
              (! empty($params['{term_list_html}'])) ? '<div class="post-term-list">{term_list_html}</div>' : '',
              '<div class="post-term-date"> - {date_final}</div>',
            '</div>',
            '<a class="post-title-link" href="{post_link}"><h2 class="post-title" title="{post_title}">{post_title}</h2></a>',
            '<div class="bt-info-cap">',
              '<div class="post-author"><i class="fa fa-user" aria-hidden="true"></i> <a href="{author_link}"> By {author_name}</a></div>',
              '<div class="post-comment"><i class="fa fa-comment" aria-hidden="true"></i> {comment_count} Comments</div>',
            '</div>',
          '</div>',
        '</div>',
      ));
      $template['style5'] = implode('', array(
        '<div class="item-inner posts_slider_2_template_style5">',
            '<div class="bt-container-post-slider">',
                '<div class="bt-thumbnail-post">',
                    '<div class="post-thumbnail" style="background: url({thumbnail_default_bg}) no-repeat center center / cover, #fafafa;">',
                       '<div class="bt-overlay"></div>',
                    '</div>',
                '</div>',
                '<div class="bt-content-post">',
                    '<h2 class="post-title" title="{post_title}"><a href="{post_link}">{post_title}</a></h3>',
                    '<div class="post-excerpt">{bt_excerpt}</div>',
                    '<div class="bt-btn-post"><a href="{post_link}">Read More <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>',
                '</div>',
            '</div>',
        '</div>',
      ));

      $template = apply_filters('vc_post_slider_2:template', $template);

      return str_replace(array_keys($params), array_values($params), fw_akg($temp, $template));
    }

    // Element HTML
    public function vc_posts_slider2_html( $atts ) {
      $atts['self'] = $this;
      return fw_render_view(get_template_directory() . '/framework-customizations/extensions/custom-js-composer/vc-elements/vc_posts_slider_2.php', array('atts' => $atts), true);
    }

} // End Element Class


// Element Class Init
new vcPostsSlider2();
