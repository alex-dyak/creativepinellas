<?php
/*
* Template Name: Event list
*/

get_header(); ?>
<section class="siteBody">

    <div class="row">
        <section class="column siteContent siteContent--noBottomSpace">
            <section class="row column">
                <?php if (have_posts()) :
                    while (have_posts()) : the_post(); ?>
                        <article class="postPage" id="post-<?php the_ID(); ?>">
                            <!--    Post title  -->
                            <h1 class="postPage-title u-text--center"><?php the_title(); ?></h1>

                            <!--    Post Content    -->
                            <div class="postPage-content">

                                <div class="intro">
                                    <?php echo get_the_content(); ?>
                                </div>

                            </div>
                            <!--    Post Content    -->
                        </article>
                    <?php endwhile;
                endif; ?>
            </section>
            <?php if (get_field('event_list_link_page')) : ?>
                <section class="row column">
                    <p class="u-text--center">
                        <a href="<?php the_field('event_list_link_page'); ?>" class="btn btn-middleWidth"><?php echo __('SUBMIT YOUR EVENT', 'w4ptheme'); ?></a>
                    </p>
                </section>
            <?php endif; ?>

        </section>

    </div>

    <section class="u-background--gray directoryFilters">
        <section class="row">
            <div class="column">
                <h2 class="u-text--center"><?php echo __('NARROW DOWN EVENTS', 'w4ptheme'); ?></h2>

                <p class="hide-for-medium">
                    <a href="#" class="btn btn--fullWidth js-toggle"
                       data-toggle="js-filtersForm"><?php echo __('Filters', 'w4ptheme'); ?></a>
                </p>
            </div>
        </section>
        <form action="<?php the_permalink() ?>" class="directoryFilters-form js-filtersForm" method="GET">
            <section class="row">
                <div class="halfMedium-6 medium-4 column">
                    <label for="attend"><?php echo __('Who Should Attend', 'w4ptheme'); ?></label>

                    <div class="form-row">
                        <?php
                        $args = array(
                            'show_option_all' => 'Everyone',
                            'taxonomy' => 'who-should-attend',
                            'value_field' => 'slug',
                            'name' => 'who-should-attend',
                            'selected' => get_query_var('who-should-attend'),
                        );

                        wp_dropdown_categories($args);
                        ?>
                    </div>
                </div>
                <div class="halfMedium-6 medium-4 column">
                    <label for="eventType"><?php echo __('Type of Event', 'w4ptheme'); ?></label>

                    <div class="form-row">
                        <?php
                        $args = array(
                            'show_option_all' => 'All types',
                            'taxonomy' => 'event-type',
                            'value_field' => 'slug',
                            'name' => 'event-type',
                            'selected' => get_query_var('event-type'),
                        );

                        wp_dropdown_categories($args);
                        ?>
                    </div>
                </div>
                <div class="medium-4 column">
                    <label for="location"><?php echo __('Location', 'w4ptheme'); ?></label>

                    <div class="form-row">
                        <?php
                        $args = array(
                            'show_option_all' => 'All Communities',
                            'taxonomy' => 'venue_community',
                            'value_field' => 'slug',
                            'name' => 'venue_community',
                            'selected' => get_query_var('venue_community'),
                        );

                        wp_dropdown_categories($args);
                        ?>
                    </div>
                </div>
            </section>
            <section class="row">
                <div class="halfMedium-6 medium-3 medium-offset-1 column">
                    <label for="dateFrom"><?php echo __('Date Range: From', 'w4ptheme'); ?></label>

                    <div class="form-row">
                        <input type="text" name="dateFrom" id="dateFrom" placeholder="all"
                               class="is-datepicker js-datepicker"
                               value="<?php echo !empty($_GET['dateFrom']) ? $_GET['dateFrom'] : null; ?>">
                    </div>
                </div>
                <div class="halfMedium-6 medium-3 column">
                    <label for="dateTo"><?php echo __('To', 'w4ptheme'); ?></label>

                    <div class="form-row">
                        <input type="text" name="dateTo" id="dateTo" placeholder="all"
                               class="is-datepicker js-datepicker"
                               value="<?php echo !empty($_GET['dateTo']) ? $_GET['dateTo'] : null; ?>">
                    </div>
                </div>
                <div class="medium-3 column end">
                    <div class="form-row directoryFilters-action">
                        <input type="submit" value="Go" class="btn btn--fullWidth btn--ocean">
                    </div>
                </div>
            </section>
        </form>
    </section>
<?php
if (!empty($_GET['venue_community'])) {
    $args = array(
        'post_type' => 'location',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'venue_community',
                'terms' => get_query_var('venue_community'),
                'field' => 'slug',
            ),
        ),
    );
    // get all locations by taxonomy Community.
    $locations = new WP_Query($args);
    foreach ($locations->posts as $location) {
        // save location ID.
        $locationID[] = get_post_meta($location->ID, '_location_id', true);
    }
    // prepare arguments by search events.
    if (!empty($locationID)) {
        $location_meta_query = array(
            'key' => '_location_id',
            'value' => $locationID,
            'compare' => 'IN'
        );
    }
}
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
// base arguments if taxonomy and date empty.
$args = array(
    'post_type' => 'event',
    'posts_per_page' => 12,
    'paged'          => $paged,
);
if (!empty($location_meta_query)) {
    $args['meta_query'][] = $location_meta_query;
}
if (!empty($_GET['dateFrom'])) {
    $date_start = strtotime($_GET['dateFrom']);
    $args['meta_query'][] = array(
        'key' => '_start_ts',
        'value' => $date_start,
        'compare' => '>=',
        'type' => 'numeric'
    );
}
if (!empty($_GET['dateTo'])) {
    $date_end = strtotime($_GET['dateTo']);
    $args['meta_query'][] = array(
        'key' => '_start_ts',
        'value' => $date_end,
        'compare' => '<=',
        'type' => 'numeric'
    );
}
if (!empty($_GET['who-should-attend'])) {
    $args['tax_query'][] = array(
        'taxonomy' => 'who-should-attend',
        'terms' => get_query_var('who-should-attend'),
        'field' => 'slug',
    );
}
if (!empty($_GET['event-type'])) {
    $args['tax_query'][] = array(
        'taxonomy' => 'event-type',
        'terms' => get_query_var('event-type'),
        'field' => 'slug',
    );
}
$the_query = new WP_Query($args); ?>
<?php if ($the_query->have_posts()): ?>
    <div id="wrapper_content">
        <div class="cont">
            <section class="row expanded small-collapse small-up-1 medium-up-3 xlarge-up-4 xxlarge-up-5 entityGrid">
                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                    <div class="column">
                        <div class="gridItem gridItem--element">
                            <a href="<?php the_permalink(); ?>" class="js-touchFocus">
                                <?php if (has_post_thumbnail()) : ?>
                                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'big_blog_img'); ?>" alt=""
                                         srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'big_blog_img'); ?> 768w, <?php echo get_the_post_thumbnail_url(get_the_ID(), 'img_680x680'); ?> 1024w,  <?php echo get_the_post_thumbnail_url(get_the_ID(), 'img_940x940'); ?> 1400w">
                                <?php endif; ?>
                                <div class="gridItem-info">
                                    <h3><?php short_title('', 60); ?> </h3>
                                    <?php /* @var $EM_Event EM_Event */ ?>
                                    <?php $EM_Event = em_get_event(get_the_ID(), 'post_id'); ?>
                                    <?php $start_date = $EM_Event->event_start_date ? date_create($EM_Event->event_start_date) : $start_date = null; ?>
                                    <?php $end_date = $EM_Event->event_end_date ? date_create($EM_Event->event_end_date) : $end_date = null; ?>
                                    <p class="u-text--upper">
                                        <i>
                                            <?php if ($EM_Event->event_start_date == $EM_Event->event_end_date) : ?>
                                                <?php echo date_format($start_date, 'M. j'); ?>
                                            <?php else : ?>
                                                <?php echo date_format($start_date, 'M. j') . ' - ' . date_format($end_date, 'M. j'); ?>
                                            <?php endif; ?>
                                            |
                                            <?php $terms = get_the_terms(get_the_ID(), 'event-type'); ?>
                                            <?php if (!empty($terms)) : ?>
                                                <?php foreach ($terms as $term): ?>
                                                    <?php $event_type[] = $term->name; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            <?php if (!empty($event_type)): ?>
                                                <?php echo implode(", ", $event_type); ?>
                                                <?php unset($event_type); ?>
                                            <?php endif; ?>
                                        </i>
                                    </p>

                                    <p class="gridItem-info-showHover gridItem-info-showHover--fSize">
                                        <strong><?php echo __('See Event', 'w4ptheme'); ?></strong>
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_query(); ?>
            </section>

            <section class="row entityGrid-pagination">
                <section class="column">
                    <?php if ( function_exists( 'wp_pagenavi' ) ) {
                        wp_pagenavi( array(
                            'before'        => '<nav class="navigation pagination" role="navigation">',
                            'after'         => '</nav>',
                            'wrapper_tag'   => 'div',
                            'wrapper_class' => 'nav-links',
                            'options'       => array(),
                            'query'         => $the_query,
                            'type'          => 'posts',
                            'echo'          => TRUE
                        ) );
                    }
                    ?>

                </section>
            </section>
        </div>
    </div>
<?php else : ?>
    <section class="row expanded small-collapse small-up-1 medium-up-3 xlarge-up-4 xxlarge-up-5 entityGrid">
        <h2 class="u-text--center"><?php echo __( 'Nothing Found', 'w4ptheme' ); ?></h2>
    </section>
<?php endif; ?>
</section>
<?php get_footer(); ?>