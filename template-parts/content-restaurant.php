<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
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
				<div class="col-sm-6">
					<?php

					$meta = get_post_meta( get_the_ID() );

					print_r( $meta );

					//upper left corner
					$lic = get_post_meta( $post->ID, 'lic', true );
					echo "<h1>$lic</h1>";
					$args        = array(
						'post_type' => 'inspection',
						'tax_query' => array(
							array(
								'taxonomy' => 'license',
								'field'    => 'name',
								'terms'    => $lic,
							),
							'meta_key' => 'lastinspec',
							'orderby'  => 'meta_value_num',
							'order'    => 'ASC',
						),
					);
					$inspections = new WP_Query( $args );
					if ( $inspections->have_posts() ) {
						while ( $inspections->have_posts() ) {
							$inspections->the_post();
							echo "<pre>";
							$inspectionscount = get_post_meta( $inspections->post->ID );
							print_r( $inspectionscount );
							$inspectionarr[ $inspectionscount['date'][0] ]['ttlv']          = $inspectionscount['ttlv'][0];
							$inspectionarr[ $inspectionscount['date'][0] ]['highv']         = $inspectionscount['highv'][0];
							$inspectionarr[ $inspectionscount['date'][0] ]['intv']          = $inspectionscount['intv'][0];
							$inspectionarr[ $inspectionscount['date'][0] ]['basv']          = $inspectionscount['basv'][0];
							$inspectionarr[ $inspectionscount['date'][0] ]['inspecdetails'] = unserialize( unserialize( $inspectionscount['inspectioncount'][0] ) );

							echo "</pre>";
						}
					}
					wp_reset_postdata();
					?>
				</div>
				<div class="col-sm-6">
					More text
				</div>
			</div>
			<?php
		}
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
