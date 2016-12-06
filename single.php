<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Inspector
 */

get_header(); ?>

	<div id="primary" class="content-area col-sm-9 col-lg-9 col-9">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();
			if ( 'restaurant' == $post->post_type ) {
					get_template_part( 'template-parts/content-restaurant', get_post_format() );
				} else {
			get_template_part( 'template-parts/content', get_post_format() );
			}
			the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
