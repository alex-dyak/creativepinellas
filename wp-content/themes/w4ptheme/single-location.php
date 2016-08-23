<?php
/**
 * The template for displaying all single posts venue.
 *
 * @package WordPress
 * @subpackage W4P-Theme
 * @since W4P Theme 1.0
 */

get_header();
global $EM_Location;
global $EM_Event; ?>
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
                        <div class="postPage-image">
                            <?php the_post_thumbnail('single_event_img'); ?>
                        </div>

                        <!--    Post Content    -->
                        <div class="postPage-content postPage-content--bottomLine">
                            <?php if (isset($EM_Location)) : ?>
                                <?php echo $EM_Location->post_content; ?>
                            <?php endif ?>
                        </div>
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
                                    <!-- Map here width x height settings sets in plugin settings > formatting as width: 100%; height: 280px; -->
                                    <? if (isset($EM_Location)) : ?>
                                        <?php echo $map = $EM_Location->output('#_LOCATIONMAP'); ?>
                                    <?php endif; ?>
                                </div>
                                <p>
                                    <a href="<?php echo $EM_Location->guid; ?>"><?php echo __('Get Directions', 'w4ptheme'); ?></a>
                                </p>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </aside>

            <section class="medium-8 large-9 column end relatedContent relatedContent--hasSidebar">
                <!--    Upcoming Events  -->
                <section class="row column">
                    <h2><?php echo __('UPCOMING EVENTS', 'w4ptheme'); ?></h2>

                    <div class="postsList">
                        <?php $events = get_related_events($EM_Location->location_id); ?>
                        <?php /* @var $EM_Event EM_Event */ ?>
                        <?php if (!empty($events)) : ?>
                        <?php foreach ($events as $EM_Event) : ?>
                        <!--    postsList-item  -->
                        <div class="postsList-item">
                            <div class="postsList-item-image">
                                <img
                                    src="<?php echo get_the_post_thumbnail_url($EM_Event->post_id, 'single_event_880x880'); ?>"
                                    alt=""
                                    srcset="<?php echo get_the_post_thumbnail_url($EM_Event->post_id, 'single_event_880x880'); ?> 460w, <?php echo get_the_post_thumbnail_url($EM_Event->post_id, 'related_post_img'); ?> 768w">
                                <span class="postsList-item-categoryDecor"></span>
                            </div>
                            <div class="postsList-item-body">
                                <h3><?php echo $EM_Event->event_name; ?></h3>

                                <p><?php echo substr(strip_tags($EM_Event->post_content), 0, 150) . '(...)'; ?></p>
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
<?php get_footer(); ?>