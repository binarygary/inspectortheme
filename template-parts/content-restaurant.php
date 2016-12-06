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

		if ( 'restaurant' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php inspector_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content col-9 col-9-sm col-9-lg">
		<div class="row">
		<?php
		if ( is_single() ) {
			?>

			<?php

			$type                = get_post_meta( get_the_ID(), 'type', 1 );
			$add1                = get_post_meta( get_the_ID(), 'add1', 1 );
			$add2                = get_post_meta( get_the_ID(), 'add2', 1 );
			$add3                = get_post_meta( get_the_ID(), 'add3', 1 );
			$city                = get_post_meta( get_the_ID(), 'city', 1 );
			$state               = get_post_meta( get_the_ID(), 'state', 1 );
			$zip                 = get_post_meta( get_the_ID(), 'zip', 1 );
			$seats               = get_post_meta( get_the_ID(), 'seats', 1 );
			$risk                = get_post_meta( get_the_ID(), 'risk', 1 );
			$last_inspected_date = get_post_meta( get_the_ID(), 'lastinspec', 1 );


			$meta = get_post_meta( get_the_ID(), '', 1 );

			echo '<div class="col-6-sm col-6-lg col-6">';
			echo $add1 . '<BR>' . $add2 . '<BR>' . $add3 . '<BR>' . $city . ', ' . $state . ' ' . $zip;
			echo '</div>';

			echo '<div class="col-3-sm col-3-lg col-3">';
			echo $risk;
			echo '</div>';

			//echo '<pre>';
			//print_r( $meta );
			//echo '</pre>';

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

			//print_r( $inspections );

			if ( $inspections->have_posts() ) {
				while ( $inspections->have_posts() ) {
					$inspections->the_post();
					echo "<pre>";
					$inspectionscount = get_post_meta( $inspections->post->ID );
					//print_r( $inspectionscount );
					$inspectionarr[ $inspectionscount['date'][0] ]['ttlv']          = $inspectionscount['ttlv'][0];
					$inspectionarr[ $inspectionscount['date'][0] ]['highv']         = $inspectionscount['highv'][0];
					$inspectionarr[ $inspectionscount['date'][0] ]['intv']          = $inspectionscount['intv'][0];
					$inspectionarr[ $inspectionscount['date'][0] ]['basv']          = $inspectionscount['basv'][0];
					$inspectionarr[ $inspectionscount['date'][0] ]['inspecdetails'] = unserialize( unserialize( $inspectionscount['inspectioncount'][0] ) );

					print_r( $inspectionarr );

					echo "</pre>";
				}
			}
			wp_reset_postdata();
			?>

			<?php
		}
		?>
			</div>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
