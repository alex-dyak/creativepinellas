<?php
/*
* Template Name: Contact Page
*/

get_header(); ?>

<section class="siteBody">

	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<div class="row">
				<section
					class="medium-8 large-9 column siteContent siteContent--hasSidebar">
					<section class="row column">
						<article class="postPage">
							<!--    Post title  -->
							<h1 class="postPage-title"><?php the_title(); ?></h1>
							<!--    Post Content    -->
							<div class="postPage-content">
								<?php the_content(); ?>
							</div>
							<!--    Post Content    -->
						</article>
					</section>
				</section>

				<?php
				$maps = Mappress_Map::get_post_map_list( get_the_ID() );
				$map  = ( isset ( $maps[0] ) ? $maps[0] : FALSE );
				?>
				<aside class="medium-4 large-3 column siteSidebar">
					<div class="siteSidebar-inner">
						<!--    Sidebar widget  -->
						<div class="siteSidebar-item">
							<h3><?php _e( 'Offices & Mailing Address', 'w4ptheme' ); ?></h3>

							<div class="siteSidebar-item-content">
								<p>
									<?php echo $map->title; ?>
									<br>
									<?php echo $map->pois[0]->title; ?>
									<br>
									<?php echo strip_tags( $map->pois[0]->body ); ?>
								</p>
								<?php if ( get_field( 'email', get_the_ID() ) ): ?>
									<p>
										<a href="mailto:<?php echo get_field( 'email', get_the_ID() ); ?>"><?php echo get_field( 'email', get_the_ID() ); ?></a>
									</p>
								<? endif; ?>

								<?php if ( get_field( 'phone_contacts', get_the_ID() ) ): ?>
									<p>
										<a href="tel:<?php echo get_field( 'phone_contacts', get_the_ID() ); ?>"><?php echo get_field( 'phone_contacts', get_the_ID() ); ?></a>
									</p>
								<? endif; ?>

								<div class="siteSidebar-item-mapHolder">
									<?php echo $map->display(); ?>
								</div>

								<?php if ( ! empty( $map->pois[0]->point['lat'] ) & ! empty( $map->pois[0]->point['lng'] ) ) : ?>
									<?php $get_directions_link = 'http://maps.google.com/maps?q=' . $map->pois[0]->point['lat'] . ',' . $map->pois[0]->point['lng']; ?>
									<p>
										<a href="<?php echo $get_directions_link; ?>"
										   target="_blank"><?php echo __( 'Get Directions', 'w4ptheme' ); ?></a>
									</p>
								<?php endif ?>
							</div>
						</div>

					</div>
				</aside>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>

</section>

<?php get_footer(); ?>
