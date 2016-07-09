<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Inspector
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php inspector_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			if ( is_single() ) {
				?>
		<div class="row">
			<div class="col-sm-4">
				Text
			</div>
			<div class="col-sm-8">
				More text
			</div>
		</div>
		<?php
			}
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php  ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
