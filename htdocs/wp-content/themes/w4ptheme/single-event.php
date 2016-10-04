<?php
/**
 * The template for displaying all single posts event.
 *
 * @package WordPress
 * @subpackage W4P-Theme
 * @since W4P Theme 1.0
 */

get_header(); ?>
<?php if (have_posts()): while (have_posts()) : the_post(); ?>
    <section class="siteBody">

        <div class="row">
            <section class="medium-8 large-9 column siteContent siteContent--hasSidebar">
                <section class="row column">

                    <article class="postPage">
                        <!--    Back to category link -->
                        <div class="postPage-backLink">
                            <a href="<?php echo get_post_type_archive_link('event'); ?>"
                               title="go back to category"><?php echo __('View All Events', 'w4ptheme'); ?></a>
                        </div>
                        <!--    Post title  -->
                        <h1 class="postPage-title"><?php the_title() ?></h1>

                        <!--    Post Info   -->
                        <div class="postPage-info">
                            <?php
                            /* @var $EM_Event EM_Event */
                            $start_time = $EM_Event->event_start_time ? date_create($EM_Event->event_start_time) : $start_time = null;
                            $end_time = $EM_Event->event_end_time ? date_create($EM_Event->event_end_time) : $end_time = null;
                            $start_date = $EM_Event->event_start_date ? date_create($EM_Event->event_start_date) : $start_date = null;
                            $end_date = $EM_Event->event_end_date ? date_create($EM_Event->event_end_date) : $end_date = null; ?>
                            <?php if ($EM_Event->event_start_date == $EM_Event->event_end_date) : ?>
                                <p><?php echo __('WHEN', 'w4ptheme') . ': ' . date_format($start_date, 'F jS, Y') . ' @ ' . date_format($start_time, 'g:i A') . ' - ' . date_format($end_time, 'g:i A'); ?></p>
                            <?php else : ?>
                                <p><?php echo __('WHEN', 'w4ptheme') . ': ' . date_format($start_date, 'F jS, Y') . ' - ' . date_format($end_date, 'F jS, Y') . ' @ ' . date_format($start_time, 'g:i A') . ' - ' . date_format($end_time, 'g:i A'); ?></p>
                            <?php endif; ?>
                            <?php if (get_field('event_cost')) : ?>
                                <p><?php echo __('COST', 'w4ptheme') . ': ' . get_field('event_cost'); ?></p>
                            <?php endif; ?>
                            <?php $terms = get_the_terms(get_the_ID(), 'who-should-attend'); ?>
                            <?php if (!empty($terms)) : ?>
                                <?php foreach ($terms as $term): ?>
                                    <?php $terms_who_should_attend[] = $term->name; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <?php if (!empty($terms_who_should_attend)): ?>
                                <p>
                                    <?php echo __('WHO SHOULD ATTEND', 'w4ptheme)') . ': ' ?>
                                    <?php echo implode(", ", $terms_who_should_attend); ?>
                                </p>
                            <?php endif; ?>
                        </div>

                        <!--    Post Image   -->
                        <div class="postPage-image">
							<?php if ( has_post_thumbnail() ) : ?>
		                        <figure class="wp-caption alignnone">
			                        <?php the_post_thumbnail('single_event_img'); ?>
			                        <figcaption class="wp-caption-text">
				                        <?php echo get_post( get_post_thumbnail_id() )->post_excerpt; ?>
			                        </figcaption>
		                    <?php endif; ?>
	                        </figure>
                        </div>

                        <!--    Post Content    -->
                        <div class="postPage-content">
                            <?php echo do_shortcode( $EM_Event->post_content ); ?>
                            <div class="postPage-content-links">
                                <a href="<?php echo $link_icall = isset ($EM_Event) ? $EM_Event->get_ical_url() : '#'; ?>"
                                   class="btn"><?php echo __('+ ADD TO iCAL', 'w4ptheme'); ?></a>
                                <a href="<?php echo $link_calendar = isset($EM_Event) ? $EM_Event->output('#_EVENTGCALURL') : '#'; ?>"
                                   class="btn" target="_blank"><?php echo __('+ ADD TO GOOGLE CALENDAR', 'w4ptheme'); ?></a>
                            </div>
                        </div>
                        <!--    Post Content    -->
                    </article>

                </section>
            </section>

            <aside class="medium-4 large-3 column siteSidebar">
                <div class="siteSidebar-inner">
                    <!--    Sidebar widget  -->
                    <div class="siteSidebar-item">
                        <h3><?php echo __('Event Details', 'w4ptheme'); ?></h3>

                        <div class="siteSidebar-item-content">
                            <p>
                                <strong><?php echo __('DATE', 'w4ptheme') . ': '; ?></strong>
                                <?php if ($EM_Event->event_start_date == $EM_Event->event_end_date) : ?>
                                    <?php echo date_format($start_date, 'F jS, Y'); ?>
                                <?php else : ?>
                                    <?php echo date_format($start_date, 'F jS, Y') . ' - ' . date_format($end_date, 'F jS, Y'); ?>
                                <?php endif; ?>
                                <br>
                                <strong><?php echo __('TIME', 'w4ptheme') . ': '; ?></strong><?php echo date_format($start_time, 'g:i A') . ' - ' . date_format($end_time, 'g:i A'); ?>
                            </p>


                            <?php $terms = get_the_terms(get_the_ID(), 'event-type'); ?>
                            <?php if (!empty($terms)) : ?>
                                <?php foreach ($terms as $term): ?>
                                    <?php $terms_event_type[] = $term->name; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>

                            <?php if (!empty($terms_event_type)) : ?>
                                <p>
                                    <strong><?php echo __('EVENT TYPE', 'w4ptheme)') . ': '; ?></strong>
                                    <?php echo implode(", ", $terms_event_type); ?>
                                </p>
                            <?php endif; ?>

                            <?php $post_objects = get_field('event_artist');
                            if (!empty($post_objects)): ?>
                            <p>
                                <strong><?php echo __('ARTIST(S)', 'w4ptheme)') . ': '; ?></strong>
                                <?php foreach ($post_objects as $post): ?>
                                    <?php setup_postdata($post); ?>
                                    <?php $artist_links[] = '<a href="' . get_permalink() . '">' . get_the_title() . '</a>' ?>
                                <?php endforeach; ?>
                                <?php wp_reset_postdata(); ?>
                                <?php endif; ?>
                                <?php if (!empty($artist_links)) : ?>
                                <?php echo implode(", ", $artist_links); ?>
                            </p>
                        <?php endif; ?>

                            <?php $field_website = get_field('event_website'); ?>
                            <?php if (!empty($field_website)) : ?>
                                <p>
                                    <strong><?php echo __('WEBSITE', 'w4ptheme') . ': '; ?></strong>
                                    <a href="<?php the_field('event_website'); ?>">
                                        <?php $parse = parse_url($field_website);
                                        echo $parse['host']; ?>
                                    </a>
                                </p>
                            <?php endif; ?>

                        </div>
                    </div>

                    <!--    Sidebar widget  -->
                    <div class="siteSidebar-item">
                        <h3><?php echo __('Venue Details', 'w4ptheme'); ?></h3>
                        <?php $location = $EM_Event->get_location();
                        $location_link = get_permalink( $location->post_id );
                        ?>
                        <div class="siteSidebar-item-content">
                            <p><a href="<?php echo $location_link; ?>"><?php echo $location->location_name; ?></a></p>

                            <p>
                                <?php echo $location->location_address; ?>
                                <br>
                                <?php echo $location->location_town; ?>
                                <?php echo $loc_state = !empty($location->location_state) ? ', ' . $location->location_state : ''; ?>
                                <?php echo $loc_postcode = !empty($location->location_postcode) ? ', ' . $location->location_postcode : ''; ?>
                                <br>
                                <?php echo $location->get_country(); ?>
                            </p>
                            <?php if (get_field('venue_tel', $location->post_id)) : ?>
                                <p><?php the_field('venue_tel', $location->post_id); ?></p>
                            <?php endif; ?>
                            <div class="siteSidebar-item-mapHolder">
                                <? if (isset($EM_Event)) : ?>
                                    <?php echo $map = $EM_Event->output('#_LOCATIONMAP'); ?>
                                <?php endif; ?>
                            </div>
                            <?php if (!empty($location->location_latitude) & !empty($location->location_longitude)) : ?>
                                <?php $get_directions_link = 'http://maps.google.com/maps?q=' . $location->location_latitude .',' . $location->location_longitude; ?>
                                <p>
                                    <a href="<?php echo $get_directions_link; ?>" target="_blank"><?php echo __('Get Directions', 'w4ptheme'); ?></a>
                                </p>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </aside>
        </div>

    </section>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>