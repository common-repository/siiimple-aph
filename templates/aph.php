<?php
/**
 * Template Name: Amicale du Personnel Hospitalier
 */
if ( flatsome_option( 'pages_layout' ) != 'default' ) :
	echo get_template_part( 'page', flatsome_option( 'pages_layout' ) );
	return;
else :
	get_header();
	do_action( 'flatsome_before_page' ); ?>
	<div id="content" class="content-area page-wrapper" role="main">
		<div class="row row-main">
			<div class="large-12 col">
				<div class="col-inner">
					<?php if ( get_theme_mod( 'default_title', 0 ) ) : ?>
					<header class="entry-header">
						<h1 class="entry-title mb uppercase"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->
					<?php endif; ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php do_action( 'flatsome_before_page_content' ); ?>
							<?php the_content(); ?>
							<?php if ( comments_open() || '0' != get_comments_number() ) : comments_template(); endif; ?>
						<?php do_action( 'flatsome_after_page_content' ); ?>
					<?php endwhile; // end of the loop. ?>
				</div><!-- .col-inner -->
			</div><!-- .large-12 -->
		</div><!-- .row -->
	</div>
	<?php
	do_action( 'flatsome_after_page' );
	get_footer();
endif;