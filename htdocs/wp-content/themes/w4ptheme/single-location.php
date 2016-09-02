<?php
/**
 * The template for displaying all single posts venue.
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
                            <a href="<?php echo get_post_type_archive_link('location'); ?>"
                               title="go back to category"><?php echo __('View All Venues', 'w4ptheme'); ?></a>
                        </div>
                        <!--    Post title  -->
                        <h1 class="postPage-title"><?php the_title() ?></h1>

                        <!--    Post Image   -->
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="postPage-image">
                                <?php the_post_thumbnail('single_event_img'); ?>
                            </div>
                        <?php endif; ?>

                        <!--    Post Content    -->
                        <?php /* @var $EM_Location $EM_Location */ ?>
                        <?php if (isset($EM_Location)) : ?>
                            <div class="postPage-content postPage-content--bottomLine">
                                <?php echo $EM_Location->post_content; ?>
                            </div>
                        <?php endif ?>
                        <!--    Post Content    -->
                    </article>

                </section>
            </section>

            <aside class="medium-4 large-3 column siteSidebar">
                <div class="siteSidebar-inner">
                    <!--    Sidebar widget  -->
                    <div class="siteSidebar-item">
                        <h3><?php echo __('Venue details', 'w4ptheme'); ?></h3>

                        <div class="siteSidebar-item-content">
                            <?php if (!empty($EM_Location)) : ?>
                                <p>
                                    <a href="<?php echo $EM_Location->guid; ?>">
                                        <?php echo $EM_Location->location_name; ?>
                                    </a>
                                </p>
                                <p>
                                    <?php echo $EM_Location->location_address; ?>
                                    <br>
                                    <?php echo $EM_Location->location_town; ?>
                                    <?php echo $loc_state = !empty($EM_Location->location_state) ? ', ' . $EM_Location->location_state : ''; ?>
                                    <?php echo $loc_postcode = !empty($EM_Location->location_postcode) ? ', ' . $EM_Location->location_postcode : ''; ?>
                                    <br>
                                    <?php echo $EM_Location->get_country(); ?>
                                </p>
                                <p><?php the_field('venue_tel'); ?></p>
                                <div class="siteSidebar-item-mapHolder">
                                    <? if (isset($EM_Location)) : ?>
                                        <?php echo $map = $EM_Location->output('#_LOCATIONMAP'); ?>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($EM_Location->location_latitude) & !empty($EM_Location->location_longitude)) : ?>
                                    <?php $get_directions_link = 'http://maps.google.com/maps?q=' . $EM_Location->location_latitude .',' . $EM_Location->location_longitude; ?>
                                    <p>
                                        <a href="<?php echo $get_directions_link; ?>" target="_blank"><?php echo __('Get Directions', 'w4ptheme'); ?></a>
                                    </p>
                                <?php endif ?>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </aside>

            <section class="medium-8 large-9 column end relatedContent relatedContent--hasSidebar">
                <!--    Upcoming Events  -->
                <section class="row column">
                    <?php $events = get_related_events($EM_Location->location_id); ?>
                    <?php /* @var $EM_Event EM_Event */ ?>
                    <?php if (!empty($events)) : ?>
                        <h2><?php echo __('UPCOMING EVENTS', 'w4ptheme'); ?></h2>
                        <div class="postsList">
                        <?php foreach ($events as $EM_Event) : ?>
                            <!--    postsList-item  -->
                            <div class="postsList-item">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="postsList-item-image">
                                        <img
                                            src="<?php echo get_the_post_thumbnail_url($EM_Event->post_id, 'single_event_880x880'); ?>"
                                            alt=""
                                            srcset="<?php echo get_the_post_thumbnail_url($EM_Event->post_id, 'single_event_880x880'); ?> 460w, <?php echo get_the_post_thumbnail_url($EM_Event->post_id, 'related_post_img'); ?> 768w">
                                        <span class="postsList-item-categoryDecor"></span>
                                    </div>
                                <?php endif ?>
                                <div class="postsList-item-body">
                                    <?php if (!empty($EM_Event->event_name)) : ?>
                                        <h3><?php echo $EM_Event->event_name; ?></h3>
                                    <?php endif; ?>
                                    <?php if (!empty($EM_Event->post_content)) : ?>
                                        <p><?php echo substr(strip_tags($EM_Event->post_content), 0, 150) . '(...)'; ?></p>
                                    <?php endif; ?>
                                    <?php $start_date = $EM_Event->event_start_date ? date_create($EM_Event->event_start_date) : $start_date = null; ?>
                                    <?php $end_date = $EM_Event->event_end_date ? date_create($EM_Event->event_end_date) : $end_date = null; ?>
                                    <p>
                                        <i>
                                            <?php if ($EM_Event->event_start_date == $EM_Event->event_end_date) : ?>
                                                <?php echo date_format($start_date, 'M. j, Y'); ?>
                                            <?php else : ?>
                                                <?php echo date_format($start_date, 'M. j, Y') . ' - ' . date_format($end_date, 'M. j, Y'); ?>
                                            <?php endif; ?>
                                            | <?php $post_objects = get_field('event_artist', $EM_Event->post_id);
                                            if ($post_objects): ?>
                                                <?php foreach ($post_objects as $post): ?>
                                                    <?php setup_postdata($post); ?>
                                                    <?php $artist_links[] = '<a href="' . get_permalink() . '">' . get_the_title() . '</a>' ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            <?php wp_reset_postdata(); ?>
                                            <?php if (!empty($artist_links)) : ?>
                                                <?php echo implode(", ", $artist_links); ?>
                                                <?php unset($artist_links); ?>
                                            <?php endif; ?>
                                        </i>
                                    </p>
                                </div>
                                <div>
                                    <a href="<?php echo $EM_Event->guid; ?>"
                                       class="btn btn--fullWidth"><?php echo __('SEE EVENT', 'w4ptheme'); ?></a>
                                </div>
                            </div>
                            </div>
                        <?php endforeach ?>
                    <?php endif ?>
                </section>
            </section>
        </div>

    </section>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>