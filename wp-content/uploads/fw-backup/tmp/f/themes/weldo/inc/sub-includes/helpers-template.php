<?php


/**
 *
 * Returning walker for change comments HTML
 */
if ( ! function_exists( 'weldo_return_comments_walker' ) ) :
	function weldo_return_comments_walker() {
		return new Weldo_Comments_Walker;
	}
endif;


if ( ! function_exists( 'weldo_the_attached_image' ) ) :
	/**
	 * Print the attached image with a link to the next attached image.
	 */
	function weldo_the_attached_image() {
		$post = get_post();
		/**
		 * Filter the default attachment size.
		 *
		 * @param array $dimensions {
		 *     An array of height and width dimensions.
		 *
		 * @type int $height Height of the image in pixels. Default 810.
		 * @type int $width Width of the image in pixels. Default 810.
		 * }
		 */
		$attachment_size     = apply_filters( 'weldo_attachment_size', array( 810, 810 ) );
		$next_attachment_url = wp_get_attachment_url();

		/*
		 * Grab the IDs of all the image attachments in a gallery so we can get the URL
		 * of the next adjacent image in a gallery, or the first image (if we're
		 * looking at the last image in a gallery), or, in a gallery of one, just the
		 * link to that image file.
		 */
		$attachment_ids = get_posts( array(
			'post_parent'    => $post->post_parent,
			'fields'         => 'ids',
			'numberposts'    => - 1,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => 'ASC',
			'orderby'        => 'menu_order ID',
		) );

		// If there is more than 1 attachment in a gallery...
		if ( count( $attachment_ids ) > 1 ) {
			foreach ( $attachment_ids as $attachment_id ) {
				if ( $attachment_id == $post->ID ) {
					$next_id = current( $attachment_ids );
					break;
				}
			}

			// get the URL of the next image attachment...
			if ( $next_id ) {
				$next_attachment_url = get_attachment_link( $next_id );
			} // or get the URL of the first image attachment.
			else {
				$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
			}
		}

		printf( '<a href="%1$s" rel="attachment">%2$s</a>',
			esc_url( $next_attachment_url ),
			wp_get_attachment_image( $post->ID, $attachment_size )
		);
	} //weldo_the_attached_image()

endif;

if ( ! function_exists( 'weldo_list_authors' ) ) :
	/**
	 * Print a list of all site authors who published at least one post.
	 */
	function weldo_list_authors($only_post_author = true) {
		if ( $only_post_author ) {
			$author_id = get_the_author_meta('ID');
			$author_ids = get_users( array(
				'fields'  => 'ID',
				'include' => array(
					$author_id
				)
			) );
		} else {
			// all authors with at least one post.
			$author_ids = get_users( array(
				'fields'  => 'ID',
				'orderby' => 'post_count',
				'order'   => 'DESC',
				'who'     => 'authors',
			) );
		}



		foreach ( $author_ids as $author_id ) :
			$post_count = count_user_posts( $author_id );

			// Move on if user has not published a post (yet).
			if ( ! $post_count ) {
				continue;
			}
			$twitter_url     = get_the_author_meta( 'twitter', $author_id );
			$facebook_url    = get_the_author_meta( 'facebook', $author_id );
			$google_plus_url = get_the_author_meta( 'google_plus', $author_id );
			$author_bio      = get_the_author_meta( 'description', $author_id );
			$custom_image_url= get_the_author_meta( 'custom_profile_image', $author_id );
			// Not showing meta if no author bio
			if ( ! $author_bio ) {
				continue;
			}

			?>
			<div class="author-meta side-item content-padding bordered">
				<div class="row">
					<div class="col-md-3">
						<div class="item-media">
							<?php
								if( ! empty( $custom_image_url ) ) {
									echo '<img src="' . esc_url( $custom_image_url ) . '" alt="' . esc_attr( get_the_author_meta( 'display_name', $author_id ) ) . '">';
								} else {
									echo get_avatar( $author_id, 700 );
								}
							?>
						</div><!-- eof .item-media -->
					</div><!-- eof .col-md-* -->
					<div class="col-md-9">
						<div class="item-content">
							<h4 class="author-name"><?php echo wp_kses_post( get_the_author_meta( 'display_name', $author_id ) ); ?></h4>
							<?php if ( $author_bio ) : ?>
								<p class="author-bio">
									<?php echo wp_kses_post( $author_bio ); ?>
								</p>
							<?php endif; //author_bio
							if ( $twitter_url || $facebook_url || $google_plus_url ) :
								?>
								<span class="author-social">
									<?php if ( $twitter_url ) : ?>
										<a href="<?php echo esc_url( $twitter_url ) ?>"
										   class="fa fa-twitter"></a>
									<?php endif; ?>
									<?php if ( $facebook_url ) : ?>
										<a href="<?php echo esc_url( $facebook_url ) ?>"
										   class="fa fa-facebook"></a>
									<?php endif; ?>
									<?php if ( $google_plus_url ) : ?>
										<a href="<?php echo esc_url( $google_plus_url ) ?>"
										   class="fa fa-google-plus"></a>
									<?php endif; ?>
								</span><!-- eof .author-social -->
							<?php
							endif; //author social
							?>
						</div><!-- eof .item-content -->
					</div><!-- eof .col-md-* -->
				</div>
				<!-- .author-info -->
			</div><!-- eof author-meta -->
		<?php
		endforeach;
	} //weldo_list_authors()

endif;


if ( ! function_exists( 'weldo_post_nav' ) ) :
	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function weldo_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '',
			true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="navigation post-navigation items-nav display_table_md hero-bg links-grey" role="navigation">
			<?php
			if ( is_attachment() ) :
				previous_post_link( '%link',
					'<div class="meta-nav text-center">' . esc_html__( 'Published In %title', 'weldo' ) . '</div>' );
			else :
				?>
				<div class="media display_table_cell_md prev-item">
					<div class="media-left media-middle">
						<?php
						$prev_thumbnail = ( get_previous_post() ) ? get_the_post_thumbnail( get_previous_post()->ID, array(
							90,
							90
						) ) : false;
						if ( $prev_thumbnail ) {
							previous_post_link( '%link', '<i class="fa fa-angle-left position-absolute"></i>' . $prev_thumbnail );
						} else {
							previous_post_link( '%link', '<i class="arrow-icon-left-open-big"></i>' );
						}
						?>
					</div>
					<div class="media-body media-middle">
						<?php
						previous_post_link( '%link', esc_html__( 'Previous Post', 'weldo' ) . '<h4>%title</h4>' );
						?>
					</div>
				</div><!-- eof .prev-item -->

				<div class="media display_table_cell_md next-item text-right">
					<div class="media-body media-middle">
						<?php
						next_post_link( '%link', esc_html__( 'Next Post', 'weldo' ) . '<h4>%title</h4>' );
						?>
					</div>
					<div class="media-right media-middle">

						<?php
						$next_thumbnail = ( get_next_post() ) ? get_the_post_thumbnail( get_next_post()->ID, array(
							90,
							90
						) ) : false;

						if ( $next_thumbnail ) {
							next_post_link( '%link', '<i class="fa fa-angle-right position-absolute"></i>' . $next_thumbnail );
						} else {
							next_post_link( '%link', '<i class="arrow-icon-right-open-big"></i>' );
						}
						?>
					</div>
				</div>
			<?php
			endif; //is_attachment
			?>
		</nav><!-- .navigation -->
	<?php } //weldo_post_nav
endif;

if ( ! function_exists( 'weldo_post_nav_2' ) ) :
	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function weldo_post_nav_2() {
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '',
			true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="navigation post-navigation items-nav links-grey" role="navigation">
			<?php
			$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
			$next     = get_adjacent_post( false, '', false );

			if ( is_attachment() && 'attachment' == $previous->post_type ) {
				return;
			}

			if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
				$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-thumbnail' );
				$prev_thumbnail = $prevthumb[0];
			} else {
				$prev_thumbnail = '';
			}

			if ( $next && has_post_thumbnail( $next->ID ) ) {
				$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );
				$next_thumbnail = $nextthumb[0];
			} else {
				$next_thumbnail = '';
			}
			?>
			<?php previous_post_link( '%link', '<div class="media hero-bg  prev-item text-center" style="background-image: url(' . esc_url( $prev_thumbnail ) . '); "><div class="nav-overlay"></div><div class="nav-middle"><span class="nav">' . esc_html__( 'Prev', 'weldo' ) . '</span><span class="title">%title</span></div></div>' ); ?>
			<?php next_post_link( '%link', '<div class="media hero-bg next-item text-center" style="background-image: url(' . esc_url( $next_thumbnail ) . '); "><div class="nav-overlay"></div><div class="nav-middle"><span class="nav">' . esc_html__( 'Next', 'weldo' ) . '</span><span class="title">%title</span></div></div>' ); ?>
		</nav><!-- .navigation -->
	<?php } //weldo_post_nav_2
endif;


if ( ! function_exists( 'weldo_posted_on' ) ) : /**
 * Print HTML with meta information for the current post-date/time and author.
 */
	function weldo_posted_on() {

		$options = weldo_get_options();
		$hide_author = $options['blog_hide_author'];
		$hide_date = $options['blog_hide_date'];

		$before_date_suffix =  '';

		weldo_sticky_marker( array(
			'sticky_symbol' => 'fa fa-thumb-tack',
			'before' => '<span class="featured-post">',
			'after'  => esc_html__( ' Sticky ', 'weldo' ) . '</span>',
		) );

		if ( ! $hide_author ) :
			weldo_the_author( array(
				'before' => '<span class="author vcard"><i class="fa fa-user"></i>',
				'after' => '</span>',
				'link_class' => 'url fn n',
				'link_attributes' => 'rel="author"',
			) );
		endif; //!hide_author

		if ( ! $hide_date ) :
		weldo_the_date( array(
			'before' => '<span><i class="fa fa-calendar"></i>',
			'after' => '</span>',
			'link_attributes' => 'rel="bookmark"',
			'time_tag_class' => 'entry-date'
		) );
		endif; //!hide_date

	}

endif; //weldo_posted_on


/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 */
if ( ! function_exists( 'weldo_post_thumbnail' ) ) :
	function weldo_post_thumbnail( $small_image = false, $cover_image = '', $date_in_corner = false, $size = false ) {
		$pID = get_the_ID();

		//detecting featured video
		$embed_url = function_exists( 'fw_get_db_post_option' ) ? fw_get_db_post_option( $pID, 'post-featured-video', '' ) : '';
		$iframe    = '';
		if ( $embed_url ) {
			global $wp_embed;

			$width  = '1170';
			$height = '780';
			$iframe = $wp_embed->run_shortcode( '[embed  width="' . $width . '" height="' . $height . '"]' . trim( $embed_url ) . '[/embed]' );

		}// embed_url

		//detecting gallery
		$is_gallery = false;
		$gallery_css_class = '';
		if ( get_post_format( $pID ) == 'gallery' ) {

			weldo_shortcode_atts_gallery_trigger();
			$galleries_images = get_post_galleries_images( $pID );
			weldo_shortcode_atts_gallery_trigger( false );
			$galleries_images_count = count( $galleries_images );

			if ( $galleries_images_count ) {
				$is_gallery = true;
				$gallery_css_class = 'item-media-gallery';
			}
		} //gallery post format

		if ( post_password_required() || is_attachment() || ( ! has_post_thumbnail() && ! $is_gallery && ! $iframe ) ) {
			return false;
		}

		//adding additional wrap for small image layout feed
		if ( ! is_single() && $small_image ) :
			?>
			<div class="<?php echo esc_attr( $small_image ); ?>">
		<?php
		endif; //!is_single and small image

		if( ! $iframe ) :
		?>
		<?php endif; //iframe ?>
			<div class="item-media entry-thumbnail post-thumbnail <?php echo esc_attr( $gallery_css_class . ' ' . $cover_image ); ?>">
				<?php
				// info in corner only for feed view and only for posts
				if ( $date_in_corner && ( ! is_single() ) && ( 'post' === get_post_type() ) ) : ?>
					<div class="entry-meta-corner">
						<?php
						// Set up and print post meta information.
						printf( '<span class="date">
									<time class="entry-date" datetime="%1$s">
										<span class="day">%2$s</span><span class="month">%3$s</span>
									</time>
								</span>',

							esc_attr( get_the_date( 'c' ) ),
							esc_html( get_the_date( 'j' ) ),
							esc_html( get_the_date( 'M' ) )
						);

						// Set up and print post meta information.
						if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
							?>
							<span class="comments-link">
								<i class="fa fa-comment color-main"></i>
								<?php comments_popup_link( esc_html__( '0', 'weldo' ), esc_html__( '1', 'weldo' ), esc_html__( '%', 'weldo' ) ); ?>
						</span>
						<?php
						endif; //post_password_required
						?>
					</div><!-- .entry-meta-corner -->
				<?php endif; //!is_single && 'post'

				//featured image only for post
				if ( ! $is_gallery ) :
					if ( $iframe ) : ?>
						<div class="embed-responsive embed-responsive-3by2">
						<?php if ( has_post_thumbnail() ): ?>
							<a href="" data-iframe="<?php echo esc_attr( $iframe ) ?>" class="embed-placeholder">
						<?php
						else:
							echo wp_kses( $iframe, array( 'iframe' => array(
								'width' => true,
								'height' => true,
								'src' => true,
								'frameborder' => true,
								'allowfullscreen' => true,
							), ) );
						endif; //has_post_thumbnail inside iframe check
					endif; // iframe check

					if (
						! ( is_single() && ! $small_image )
						|| ( 'fw-event' === get_post_type() )
						|| ( is_single() && $iframe )
					) {
						$atts = array();
						if($iframe) {
							$atts['class'] = 'embed-responsive-item';
						}
						$thumbnail_size = $size ? $size : 'post-thumbnail';
						the_post_thumbnail( $thumbnail_size, $atts );
					} elseif ( ! is_single() && $small_image ) {
						the_post_thumbnail( 'weldo-square' );
					} else {
						$size ? the_post_thumbnail($size) : the_post_thumbnail();
					} //$current_position

					// creating post link for whole featured image
					if ( ! is_single() && ! $iframe && ! ( 'fw-portfolio' === get_post_type() ) ) : ?>
						<div class="media-links">
							<a class="abs-link" href="<?php the_permalink(); ?>"></a>
						</div>
					<?php endif; //!is_single check
					if ( $iframe ):
						if ( has_post_thumbnail() ) :
							?>
							</a><!-- eof image link -->
						<?php endif; //post thumbnail check for closing A tag ?>
						</div>
					<?php endif; //iframe check

				// gallery
				else :
					//featured image url
					$options = weldo_get_options();
					$post_featured_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $pID ), 'post-thumbnail' );
					if ( $options['blog_layout'] === 'grid' || $options['blog_layout'] === '4' ) {
						$post_featured_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $pID ), 'weldo-square' );
					}
					?>
					<div id="owl-carousel-<?php echo esc_attr( $pID ); ?>" class="owl-carousel"
					     data-loop="true"
					     data-margin="0"
					     data-nav="true"
					     data-dots="false"
					     data-themeclass="owl-theme entry-thumbnail-carousel"
					     data-center="false"
					     data-items="1"
					     data-autoplay="true"
					     data-responsive-xs="1"
					     data-responsive-sm="1"
					     data-responsive-md="1"
					     data-responsive-lg="1"
					>
						<?php
						//adding featured image as a first element in carousel
						if ( $post_featured_image_src ) : ?>
							<div class="item">
								<img src="<?php echo esc_attr( $post_featured_image_src[0] ); ?>"
								     alt="<?php echo esc_attr( get_the_title( $pID ) ); ?>">
							</div>
						<?php endif;
						$count = 1;
						foreach ( $galleries_images as $gallerie ) :
							foreach ( $gallerie as $src ) :
								//showing only 3 images from gallery
								if ( $count > 3 ) {
									break 2;
								}
								?>
								<div class="item">
									<img src="<?php echo esc_attr( $src ); ?>"
									     alt="<?php echo esc_attr( get_the_title( $pID ) ); ?>">
								</div>
								<?php
								$count ++;
							endforeach;
						endforeach; ?>
					</div>
				<?php
				endif; // $is_gallery
				?>
			</div> <!-- .item-media -->
		<?php if( ! $iframe ) : ?>
		<?php
		endif; //iframe
		//closing additional wrap for small image layout feed
		if ( ! is_single() && $small_image ) : ?>
			</div> <!-- eof .col-md-6 -->
		<?php endif;
	}
endif;//weldo_post_thumbnail()



//pagination default args in one place
if ( !function_exists( 'weldo_get_default_pagination_args_array' ) ) :
	function weldo_get_default_pagination_args_array() {
		return array(
			'prev_text' => '<i class="fa fa-angle-left"></i>',
			'next_text' => '<i class="fa fa-angle-right"></i>',
		);
	}
endif;

//helper for actions - echo closing div
if ( !function_exists( 'weldo_echo_closing_div' ) ) :
	function weldo_echo_closing_div() {
		echo '</div>';
	}
endif;

//helper for Unyson Events - related events
if ( !function_exists( 'weldo_fw_releted_events' ) ) :
	function weldo_fw_releted_events() {
		if( ! function_exists( 'fw' ) ) {
			return;
		}
		if ( ! fw()->extensions->get( 'events' ) ) {
			return;
		}

		global $post;
		$events_extension = fw()->extensions->get( 'events' );
		$post_type = $events_extension->get_post_type_name();
		$taxonomy_name = $events_extension->get_taxonomy_name();

		$args = array(
			'post_type'      => $post_type,
			'taxonomy'       => $taxonomy_name,
			'orderby'        => 'post_date',
			'posts_per_page' => '3',
			'post__not_in'   => array( $post->ID )
		);

		$query = new WP_Query( $args );

		if( ! empty( $query->posts ) ):
			echo '<h4>' . esc_html__( 'Recent Events', 'weldo') . '</h4>';
			echo '<div class="recent-events">';
			while ( $query->have_posts() ) :
				$query->the_post(); ?>
				<div class="related-post">
				<a href="<?php the_permalink(); ?>">
					<?php
					the_title();
					?>
				</a>
				</div><?php
			endwhile;

			echo '</div><!-- .recent-events -->';

		endif;
	}
endif;