<?php
/*
Element Description: VC Events Listing
*/

// Element Class
class vcEventsChurch extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        //global $__VcShadowWPBakeryVisualComposerAbstract;
        //add_action( 'init', array( $this, 'vc_events_church_mapping' ) );
        $this->vc_events_church_mapping();
        add_shortcode( 'vc_events_church', array( $this, 'vc_events_church_html' ) );
        //$__VcShadowWPBakeryVisualComposerAbstract->addShortCode('vc_events_church', array( $this, 'vc_events_church_html' ));
    }

    // Element Mapping
    public function vc_events_church_mapping() {

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(
          array(
            'name' => __('Events church', 'alone'),
            'base' => 'vc_events_church',
            'description' => __('Events church', 'alone'),
            'category' => __('Events', 'alone'),
            'icon' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/event-church.png',
            'params' => array(
              /* source */
              array(
          			'type' => 'textfield',
          			'heading' => __( 'Total Items', 'alone' ),
          			'param_name' => 'post_total_items',
          			'description' => __( 'Set max limit for items in event or enter -1 to display all (limited to 1000).', 'alone' ),
                'value' => 3,
                'group' => 'Source',
                'admin_label'   => true,
              ),
              array(
                'type' => 'dropdown',
                'heading' => __('Events Order', 'alone'),
                'param_name' => 'order',
                'value' => array(
                  __('ASC', 'alone') => 'ASC',
                  __('DESC', 'alone') => 'DESC',
                ),
                'std' => 'DESC',
                'description' => __( 'Select event type query.', 'alone' ),
                'group' => 'Source',
                'admin_label' => true,
              ),
              array(
                'type' => 'dropdown',
                'heading' => __('Events Type', 'alone'),
                'param_name' => 'type',
                'value' => array(
                  __('By Date', 'alone') => 'v_date',
                  __('By Title', 'alone') => 'po_title',
                  __('By ID', 'alone') => 'event_id',
                ),
                'std' => 'v_date',
                'description' => __( 'Select event type query.', 'alone' ),
                'group' => 'Source',
                'admin_label' => true,
              ),
              array(
                'type' => 'textfield',
                'heading' => __('Offset', 'alone'),
                'param_name' => 'offset',
                'value' => 0,
                'dependency' => array(
          				'element' => 'type',
          				'value' => 'recent',
          			),
                'description' => __( 'Enter offset number.', 'alone' ),
                'group' => 'Source',
              ),
              array(
                'type' => 'textfield',
                'heading' => __('Event IDs', 'alone'),
                'param_name' => 'event_ids',
                'value' => '',
                'dependency' => array(
          				'element' => 'type',
          				'value' => 'event_id',
          			),
                'description' => __( 'Enter event id (Ex: 1,2,3).', 'alone' ),
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
                  //'default' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/event-listing-default.jpg',
                  'default' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/event-listing-simplify.jpg',
                  // 'block-image' => get_template_directory_uri() . '/framework-customizations/extensions/custom-js-composer/images/layouts/posts-slider-layout-2.jpg',
                ),
                'std' => 'default',
                'description' => __('Select a layout display', 'alone'),
                'group' => 'Layout',
              ),
              /* css editor */
              array(
                'type' => 'css_editor',
                'heading' => __( 'Css', 'alone' ),
                'param_name' => 'css',
                'group' => __( 'Design Options general', 'alone' ),
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
  		$css_class = apply_filters( 'vc_events_church_filter_class', 'wpb_theme_custom_element wpb_events_church ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

  		return array(
  			'css_class' => trim( preg_replace( '/\s+/', ' ', $css_class ) ),
  			'styles' => $styles,
  		);
    }

    public function event_get_posts($atts = array()) {
      extract($atts);

      $args = array(
        'post_type' => 'tribe_events',
        'items' => $post_total_items,
        'image_class' => 'event-featured-image',
        'date_format' => 'l, j, M',
        'image_size' => $image_size,
        'cat' => $taxonomy_ids,
        'image_width' => '100%',
        'image_height' => 'auto',
        'image_post' => false,
      );

      switch ($type) {
        case 'v_date':
          $args['sort'] = 'v_date';
          $args['offset'] = $offset;
          $args['order'] = $order;
          break;

        case 'po_title':
          $args['sort'] = 'po_title';
          $args['offset'] = $offset;
          $args['order'] = $order;
          break;

        case 'event_id':
          $args['sort'] = 'by_id';
          $args['post_by_id'] = explode(',', $event_ids);
          # code...
          break;
      }

      return  alone_get_posts($args);
    }

    public function variables($event_id, $item_data) {

      $time_start   = get_post_meta( $event_id, '_EventStartDate', true ) ? get_post_meta( $event_id, '_EventStartDate', true ) : '';
      $time_end     = get_post_meta( $event_id, '_EventEndDate', true ) ? get_post_meta( $event_id, '_EventEndDate', true ) : '';
      $adress_event   = tribe_get_full_address($event_id) ? tribe_get_full_address($event_id) : '';
      $date   = get_post_meta( $event_id, '_EventStartDateUTC', true ) ? get_post_meta( $event_id, '_EventStartDateUTC', true ) : '';
      $date_stars = date_i18n('d M Y', strtotime($date));
      $date_d = date_i18n('d', strtotime($date));
      $date_m = date_i18n('M \/\ Y', strtotime($date));
      $date_y = date_i18n('Y', strtotime($date));
      $date_t = date_i18n('H:i', strtotime($date));
      $variables = array(
        '{ID}'                => $event_id,
        '{post_title}'        => fw_akg('post_title', $item_data),
        '{post_link}'         => fw_akg('post_link', $item_data),
        '{post_author_link}'  => fw_akg('post_author_link', $item_data),
        '{post_author_name}'  => fw_akg('post_author_name', $item_data),
        '{term_list}'         => get_the_term_list($event_id, 'tribe_events_cat', '<div class="event-term-list">', ',', '</div>'),
        '{post_featured_image}' => get_template_directory_uri() . '/assets/images/image-default-2.jpg',
        '{post_excerpt}'      => get_the_excerpt($event_id),
        '{event_start_time}'  => $time_start,
        '{venue}'      => $adress_event,
        '{start_date}'        => $date_stars,
        '{start_d}'           => $date_d,
        '{start_m}'           => $date_m,
        '{start_y}'           => $date_y,
      );

      return $variables;

    }

    public function _template($temp = 'default', $item = array(), $atts = array()) {
      $output = '';
      $event_id = fw_akg('post_id', $item);
      $variables = $this->variables($event_id, $item);

	//var_dump($variables);
      /* check featured image exist */
      if ( has_post_thumbnail($event_id) ) {
        $variables['{post_featured_image}'] = get_the_post_thumbnail_url($event_id, fw_akg('image_size', $atts));
      }

      $variables['{layout}'] = $atts['layout'];

      switch ($temp) {
        case 'default':
          $date = get_post_meta( $event_id, '_EventStartDate', true ) ? get_post_meta( $event_id, '_EventStartDate', true ) : '';
          $date_template = implode('', array(
            '<div class="date-entry">',
              '<div class="date-entry-inner">',
                '<div class="d-d">{start_d}</div>',
                '<div class="d-my">{start_m}</div>',
              '</div>',
            '</div>',
          ));

          $output = implode('', array(
            '<div class="item-inner layout-{layout}">',
			  '<div class="event-featured-image-wrap">',
                '<div class="event-thumbnail"><img src="{post_featured_image}" alt="{post_title}"></div>',
              '</div>',
			  '<div class="church-event-content">',
				  '<div class="event-start-date">',
					$date_template,
				  '</div>',
				  '<div class="content-entry">',
					'<div class="church-event-author"><i class="fa fa-user" aria-hidden="true"></i> {post_author_name}</div>',
					'<a href="{post_link}" class="title-link" title="{post_title}"><h3 class="title">{post_title}</h3></a>',
					'<div class="church-event-adress">{venue}</div>',
				  '</div>',
				  '<a href="{post_link}" class="readmore-link">'. __('Read More', 'alone') .'</a>',
			  '</div>',
            '</div>',
          ));
          break;
      }

      return str_replace(array_keys($variables), array_values($variables), $output);
    }

    // Element HTML
    public function vc_events_church_html( $atts, $content ) {
      $atts['self'] = $this;
      $atts['content'] = $content;
      return fw_render_view(get_template_directory() . '/framework-customizations/extensions/custom-js-composer/vc-elements/vc_events_church.php', array('atts' => $atts), true);
    }

} // End Element Class


// Element Class Init
new vcEventsChurch();
