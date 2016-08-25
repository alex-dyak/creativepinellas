<?php
/**
 * The template for displaying all single artist post.
 *
 * @package WordPress
 * @subpackage W4P-Theme
 * @since W4P Theme 1.0
 */

get_header(); ?>
    <section class="siteBody">

        <div class="row">
            <?php if (have_posts()): while (have_posts()) : the_post(); ?>
                <section class="medium-8 large-9 column siteContent siteContent--hasSidebar">
                    <section class="row column">

                        <article class="postPage">
                            <!--    Back to category link -->
                            <div class="postPage-backLink">
                                <a href="<?php echo get_post_type_archive_link('artist'); ?>"
                                   title="go back to category"><?php echo __('View All Artist', 'w4ptheme'); ?></a>
                            </div>
                            <!--    Post title  -->
                            <h1 class="postPage-title"><?php the_title(); ?></h1>

                            <!--    Post Info   -->
                            <div class="postPage-info">
                                <?php echo $result = get_field('artist_grant_recipient') ? __('GRAND RECIPIENT', 'w4ptheme') . ' | ' : ''; ?>
                                <?php $terms = get_the_terms(get_the_ID(), 'artist_media'); ?>
                                <?php if (!empty($terms)) : ?>
                                    <?php foreach ($terms as $term): ?>
                                        <?php $terms_who_should_attend[] = $term->name; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <?php if (!empty($terms_who_should_attend)): ?>
                                    <?php echo mb_strtoupper(implode(", ", $terms_who_should_attend)) . ' | '; ?>
                                <?php endif; ?>
                                <?php $artist_genre_field = get_field('artist_genre'); ?>
                                <?php echo !empty($artist_genre_field) ? mb_strtoupper($artist_genre_field) : ''; ?>
                            </div>

                            <!--    Post Image   -->
                            <?php if (has_post_thumbnail()) : // Check if thumbnail exists ?>
                                <div class="postPage-image">
                                    <?php the_post_thumbnail('single_event_img'); ?>
                                </div>
                            <?php endif; ?>

                            <!--    Post Content    -->
                            <div class="postPage-content postPage-content--bottomLine">

                                <?php the_content(); ?>

                            </div>
                            <!--    Post Content    -->
                        </article>

                    </section>
                </section>
                <?php

                $images = get_field('artist_image_gallery');

                if ($images): ?>
                    <aside class="medium-4 large-3 column siteSidebar">
                        <div class="siteSidebar-inner">
                            <!--    Sidebar widget  -->
                            <div class="siteSidebar-galleryWidget">
                                <h3><?php echo __('Artist Gallery', 'w4ptheme'); ?></h3>
                                <ul class="siteSidebar-gallery-element u-list--plain u-clearfix">
                                    <?php foreach ($images as $image): ?>
                                        <li>
                                            <a href="<?php echo $image['sizes']['artist_gallery_600x250']; ?>"
                                               class="swipebox">
                                                <img src="<?php echo $image['sizes']['artist_gallery_300x300']; ?>"
                                                     srcset="<?php echo $image['sizes']['artist_gallery_440x440']; ?> 480w, <?php echo $image['sizes']['artist_gallery_300x300']; ?> 768w"
                                                     alt="<?php echo $image['alt']; ?>">
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <a href="<?php the_field('artist_web_site_url'); ?>"
                                   class="btn btn--fullWidth"><?php echo __('Artist WebSite', 'w4ptheme'); ?></a>
                            </div>
                        </div>
                    </aside>
                <?php endif; ?>
            <?php endwhile; ?>
            <?php endif; ?>
            <?php
            $args = array(
                'post_type' => 'event',
                'posts_per_page' => -1,
                'meta_query' => array(
                    array(
                        'key' => '_start_ts',
                        'value' => current_time('timestamp'),
                        'compare' => '>=',
                        'type' => 'numeric'
                    ),
                    array(
                        'key' => 'event_artist',
                        'value' => '"' . get_the_ID() . '"',
                        'compare' => 'LIKE'
                    )
                )
            );
            $the_query = new WP_Query($args); ?>
            <section class="medium-8 large-9 column end relatedContent relatedContent--hasSidebar">
                <!--    Upcoming Events  -->
                <section class="row column section-bottomLined">
                    <?php if ($the_query->have_posts()): ?>

                        <h2><?php echo __('UPCOMING EVENTS', 'w4ptheme'); ?></h2>

                        <div class="postsList">
                            <!--    postsList-item  -->
                            <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                                <div class="postsList-item">
                                    <div class="postsList-item-image">
                                        <img
                                            src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'single_event_880x880'); ?>"
                                            alt=""
                                            srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'single_event_880x880'); ?> 460w, <?php echo get_the_post_thumbnail_url(get_the_ID(), 'related_post_img'); ?> 768w">
                                        <span class="postsList-item-categoryDecor"></span>
                                    </div>
                                    <div class="postsList-item-body">
                                        <h3><?php the_title(); ?></h3>

                                        <p><?php echo substr(strip_tags($post->post_content), 0, 150) . '(...)'; ?></p>
                                        <?php /* @var $EM_Event EM_Event */ ?>
                                        <?php $location = $EM_Event->get_location(); ?>
                                        <?php $start_date = $EM_Event->event_start_date ? date_create($EM_Event->event_start_date) : $start_date = null; ?>
                                        <?php $end_date = $EM_Event->event_end_date ? date_create($EM_Event->event_end_date) : $end_date = null; ?>
                                        <p>
                                            <i>
                                                <?php if ($EM_Event->event_start_date == $EM_Event->event_end_date) : ?>
                                                    <?php echo date_format($start_date, 'M. j, Y'); ?>
                                                <?php else : ?>
                                                    <?php echo date_format($start_date, 'M. j, Y') . ' - ' . date_format($end_date, 'M. j, Y'); ?>
                                                <?php endif; ?>
                                                | <a
                                                    href="<?php echo $location->guid; ?>"><?php echo strtoupper($location->location_name); ?></a>
                                            </i>
                                        </p>
                                    </div>
                                    <div>
                                        <a href="<?php the_permalink(); ?>"
                                           class="btn btn--fullWidth"><?php echo __('SEE EVENT', 'w4ptheme'); ?></a>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                            <!--   / postsList-item  -->
                        </div>
                    <?php endif; ?>

                    <?php wp_reset_query(); ?>
                </section>
                <?php
                $get_id_author = get_field('artist_associate');
                if (!empty($get_id_author['ID'])) :
                    $args = array(
                        'post_type' => 'post',
                        'author' => $get_id_author['ID'],
                        'orderby' => 'post_date',
                        'order' => 'ASC',
                        'posts_per_page' => 5
                    );
                    $the_query = new WP_Query($args); ?>
                <?php endif; ?>
                <?php if ($the_query->have_posts()): ?>
                    <section class="row column">
                        <h2><?php echo __('POSTS BY ', 'w4ptheme') . strtoupper(get_the_title()); ?></h2>
                        <div class="postsList">
                            <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                                <!--    postsList-item  -->
                                <div class="postsList-item">
                                    <div class="postsList-item-image">
                                        <img
                                            src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'single_event_880x880'); ?>"
                                            alt=""
                                            srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'single_event_880x880'); ?> 460w, <?php echo get_the_post_thumbnail_url(get_the_ID(), 'related_post_img'); ?> 768w">
                                        <span class="postsList-item-categoryDecor"></span>
                                    </div>
                                    <div class="postsList-item-body">
                                        <h3><?php the_title(); ?></h3>
                                        <p><?php echo substr(strip_tags($post->post_content), 0, 150) . '(...)'; ?></p>
                                        <p>
                                            <i>
                                                <?php
                                                $post_categories = get_the_category();
                                                foreach ($post_categories as $post_category) :
                                                    $link_category[] = '<a href="' . get_category_link($post_category->cat_ID) . '">' . strtoupper($post_category->cat_name) . '</a>';
                                                endforeach; ?>
                                                <?php if (!empty($link_category)) : ?>
                                                    <?php echo implode(", ", $link_category); ?>
                                                    <?php unset($link_category); ?>
                                                <?php endif; ?>
                                            </i>
                                        </p>
                                    </div>
                                    <div>
                                        <a href="<?php the_permalink(); ?>"
                                           class="btn btn--fullWidth"><?php echo __('READ MORE', 'w4ptheme'); ?></a>
                                    </div>
                                </div>
                                <!--   / postsList-item  -->
                            <?php endwhile; ?>
                        </div>
                    </section>
                <?php endif; ?>
                <?php wp_reset_query(); ?>
            </section>
        </div>

    </section>

<?php get_footer(); ?>