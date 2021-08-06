<?php
class WPBakeryShortCode_bt_social_media extends WPBakeryShortCode {
	
	protected function content( $atts, $content = null ) {

		extract(shortcode_atts(array(
			'style' => 'default',
			'align' => 'text-left',
			'css_animation' => '',
			'el_id' => '',
			'el_class' => '',
			
			'css' => ''
			
		), $atts));
		
		$css_class = array(
			$this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation ),
			'bt-element',
			'bt-social-media-element',
			$style,
			$align,
			apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts )
		);
		
		$wrapper_attributes = array();
		
		if ( ! empty( $el_id ) ) {
			$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
		}
		
		ob_start();
		?>
		<ul class="<?php echo esc_attr(implode(' ', $css_class)); ?>" <?php echo esc_attr(implode(' ', $wrapper_attributes)); ?>>
			<?php
				$social_media = vc_param_group_parse_atts( $atts['social_media'] );
				if(!empty($social_media)){
					foreach($social_media as $social){
						/* Icon */
						$icon_class = isset($social['icon'])?$social['icon']:'';
						$icon = (!empty($icon_class))?'<i class="'.esc_attr($icon_class).'"></i>': '';
						
						/* Link */
						$link = isset($social['link'])?vc_build_link( $social['link'] ):array();
						$link_before = $link_after = '';
						$link_attributes = array();
						$link_attributes[] = 'data-icon-class="'.esc_attr($icon_class).'"';
						$link_attributes[] = 'class="bt-link"';
						if(!empty($link)){
							if ( ! empty( $link['url'] ) ) {
								$link_attributes[] = 'href="' . esc_attr( $link['url'] ) . '"';
							}
							
							if ( ! empty( $link['target'] ) ) {
								$link_attributes[] = 'target="' . esc_attr( $link['target'] ) . '"';
							}
							
							if ( ! empty( $link['rel'] ) ) {
								$link_attributes[] = 'rel="' . esc_attr( $link['rel'] ) . '"';
							}
							
							if ( ! empty( $link['title'] ) ) {
								$link_attributes[] = 'title="'.esc_attr($link['title']).'"';
							}
							$link_before = '<a '.implode(' ', $link_attributes).'>';
							$link_after = '</a>';
						}
						
						if($icon){
							echo '<li>'.$link_before.$icon.$link_after.'</li>';
						}
					}
				}
			?>
		</ul>
		<?php
		return ob_get_clean();
	}
}

vc_map(array(
	'name' => esc_html__('Social Media', 'alone'),
	'base' => 'bt_social_media',
	'category' => esc_html__('BT Elements', 'alone'),
	'icon' => 'bt-icon',
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Style', 'alone'),
			'param_name' => 'style',
			'value' => array(
				esc_html__('Default', 'alone') => 'default',
				esc_html__('Rounded', 'alone') => 'rounded',
				esc_html__('Circle', 'alone') => 'circle'
			),
			'description' => esc_html__('Select layout style in this elment.', 'alone')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Align', 'alone'),
			'param_name' => 'align',
			'value' => array(
				esc_html__('Left', 'alone') => 'text-left',
				esc_html__('Center', 'alone') => 'text-center',
				esc_html__('Right', 'alone') => 'text-right',
			),
			'description' => esc_html__('Select layout align in this elment.', 'alone')
		),
		vc_map_add_css_animation(),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Element ID', 'alone'),
			'param_name' => 'el_id',
			'value' => '',
			'description' => esc_html__('Enter element ID (Note: make sure it is unique and valid).', 'alone')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra Class', 'alone'),
			'param_name' => 'el_class',
			'value' => '',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'alone')
		),
		array(
			'type' => 'param_group',
			'heading' => esc_html__('Client Logo', 'alone'),
			'param_name' => 'social_media',
			'value' => '',
			'group' => esc_html__('Data Setting', 'alone'),
			'description' => esc_html__('Please, select logo for option - social_media.', 'alone'),
			'params' => array(
				array(
					'type' => 'textfield',
					'class' => '',
					'heading' => esc_html__('Icon', 'alone'),
					'param_name' => 'icon',
					'value' => 'fa fa-facebook',
					'description' => esc_html__('Please, enter class font icon in this element.', 'alone'),
					'admin_label' => true,
				),
				array(
					'type' => 'vc_link',
					'heading' => esc_html__('URL (Link)', 'alone'),
					'param_name' => 'link',
					'description' => esc_html__('Add link of social in this element.', 'alone')
				),
			)
		),
		array(
			'type' => 'css_editor',
			'heading' => esc_html__('CSS box', 'alone'),
			'param_name' => 'css',
			'group' => esc_html__('Design Options', 'alone'),
		)
	)
));
