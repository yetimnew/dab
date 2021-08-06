<?php
// https://maps.googleapis.com/maps/api/js?key=AIzaSyDOkqN917F-V3B3BdilLSiO8AgmBy4sZaU
$TBFW = defined( 'FW' );
$alone_post_options = alone_single_post_options( $post->ID );
$alone_related_articles_type = ! empty( $TBFW ) ? fw_get_db_settings_option( 'posts_settings/related_articles/yes/related_type', 'related-articles-1' ) : 'related-articles-1';
$alone_is_builder = alone_fw_ext_page_builder_is_builder_post($post->ID);
$alone_general_posts_options = alone_general_posts_options();
$map_latitude = get_post_meta($post->ID, '_ctc_location_map_lat', true);
$map_longitude = get_post_meta($post->ID, '_ctc_location_map_lng', true);
$map_address = get_post_meta($post->ID, '_ctc_location_address', true);
$map_time = get_post_meta($post->ID, '_ctc_location_times', true);
$map_phone = get_post_meta($post->ID, '_ctc_location_phone', true);
$map_email = get_post_meta($post->ID, '_ctc_location_email', true);
//var_dump($terms_sm);
$image_background_elem = '';
if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
  $style_inline = "background: url(". get_the_post_thumbnail_url($post->ID, $alone_post_options['image_size']) .") center center;";
  $image_background_elem = "<div class='post-sing-image-background' style='{$style_inline}' data-stellar-background-ratio='0.8'></div>";
}
$article_classes = array(
	'post',
	'post-details',
	'clearfix',
  'post-single-creative-layout-' . $alone_general_posts_options['blog_type'],
);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( implode(' ', $article_classes) ); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
	<div class="col-inner">
		<div class="entry-content clearfix" itemprop="text">
			<div class="post-single-entry-header"> <!-- Start .single-entry-header -->
				<?php echo "{$image_background_elem}"; ?>
				<div class="heading-entry-wrap">
					<!-- Cat & tag -->
				  <div class="cat-meta">
				    <?php echo ! empty( $alone_post_options['category_list'] ) ? '<div class="post-category">' . $alone_post_options['category_list'] . '</div>' : ''; ?>
				  </div>

					<!-- title -->
				  <?php echo "{$alone_post_options['title']}"; ?>

					<div class="extra-meta">
				    <!-- post date -->
				    <div class="post-date" title="<?php _e('Date', 'alone'); ?>">
				      <?php echo "{$alone_post_options['date']}"; ?>
				    </div>

				    <!-- post author -->
				    <div class="post-author" title="<?php _e('Author', 'alone'); ?>">
				      <span><?php echo esc_html__('By ', 'alone') ?></span>
				      <?php echo "{$alone_post_options['author_link']}"; ?>
				    </div>

				    <!-- post comment -->
				    <div class="post-total-comment" title="<?php _e('Comment', 'alone'); ?>">
				      <?php echo "{$alone_post_options['comments']}"; ?>
				      <?php echo ((int) $alone_post_options['comments'] <= 1) ? esc_html__('Comment', 'alone') : esc_html__('Comments', 'alone')  ?>
				    </div>

				    <!-- post view -->
				    <div class="post-total-view" title="<?php _e('View', 'alone'); ?>">
				      <?php echo "{$alone_post_options['views']}"; ?>
				      <?php echo ((int) $alone_post_options['views'] <= 1) ? esc_html__('View', 'alone') : esc_html__('Views', 'alone')  ?>
				    </div>
				  </div>
				</div>
			</div> <!-- End .single-entry-header -->
			<div class="row">
				<div class="col-md-2">
					<?php echo alone_share_post(array('facebook' => true, 'twitter' => true, 'google_plus' => true, 'linkedin' => true, 'pinterest' => false));//echo do_shortcode('[x_share title="'. esc_html__(' ', 'alone') .'" facebook="true" twitter="true" google_plus="true" linkedin="true" pinterest="true"]'); ?>
				</div>
				<div class="col-md-10">
					<div class="location-content">	
						<div class="extra-location col-md-6">
							<!-- Cat & tag -->
							<div class="address-meta">
							  <span> <i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $map_address; ?></span>
							</div>
							<!-- post date -->
							<div class="post-time" >
							  <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $map_time; ?>
							</div>
							<!-- post date -->
							<div class="post-phone" >
							  <i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:<?php echo $map_phone; ?>"><?php echo $map_phone; ?></a>
							</div>
							<div class="post-email" >
							  <i class="fa fa-envelope-o" aria-hidden="true"></i> <a href="mailto:<?php echo $map_email; ?>"><?php echo $map_email; ?></a>
							</div>

						</div>
						<div class="location-map col-md-6">
							<?php alone_church_render_google_map_by_latlong($map_latitude, $map_longitude, ''); ?>
						</div>
					</div> <!-- End .single-entry-header -->
					
					<div class="post-single-content-text">
						<?php
						/* content */
						the_content();

						wp_link_pages( array(
							'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'alone' ) . '</span>',
							'after'       => '</div>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
						) );

						/* tags */
						if(isset($alone_post_options['tag_list']) && ! empty($alone_post_options['tag_list'])) {
							echo "<div class='single-entry-tag'>". esc_html__('Tags: ', 'alone') . "{$alone_post_options['tag_list']}</div>";
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>
<?php get_template_part( 'content', 'author' ); ?>
<hr />
<?php get_template_part( 'post', 'navigation' ); ?>
<?php get_template_part( 'templates/related-articles/'.$alone_related_articles_type ); ?>

