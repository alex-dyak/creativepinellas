<?php
/*
* Template Name: Artist list
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
        </section>
    </div>

    <section class="u-background--gray directoryFilters">
        <section class="row">
            <div class="column">
                <h2 class="u-text--center"><?php echo __('NARROW DOWN ARTIST', 'w4ptheme'); ?></h2>

                <p class="hide-for-medium">
                    <a href="#" class="btn btn--fullWidth js-toggle"
                       data-toggle="js-filtersForm"><?php echo __('Filters', 'w4ptheme'); ?></a>
                </p>
            </div>
        </section>
        <form action="<?php the_permalink() ?>" class="directoryFilters-form js-filtersForm" method="GET">
            <section class="row">
                <div class="halfMedium-6 column">
                    <label for="eventType"><?php echo __('Media', 'w4ptheme'); ?></label>

                    <div class="form-row">
                        <?php
                        $args = array(
                            'show_option_all' => 'All types',
                            'taxonomy' => 'artist_media',
                            'value_field' => 'slug',
                            'name' => 'artist_media',
                            'selected' => get_query_var('artist_media'),
                        );

                        wp_dropdown_categories($args);
                        ?>
                    </div>
                </div>
                <div class="halfMedium-6 column">
                    <div class="form-row directoryFilters-action">
                        <input type="submit" value="Go" class="btn btn--fullWidth btn--ocean">
                    </div>
                </div>
            </section>
        </form>
    </section>
    <?php
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    // base arguments of filter.
    $args = array(
        'post_type' => 'artist',
        'posts_per_page' => 1,
        'paged'          => $paged,
    );
    if (!empty($_GET['artist_media'])) {
        $args['tax_query'][] = array(
            'taxonomy' => 'artist_media',
            'terms' => get_query_var('artist_media'),
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
                                             srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'big_blog_img'); ?> 768w, <?php echo get_the_post_thumbnail_url(get_the_ID(), 'event_list_680x680'); ?> 1024w,  <?php echo get_the_post_thumbnail_url(get_the_ID(), 'event_list_940x940'); ?> 1400w">
                                    <?php endif; ?>
                                    <div class="gridItem-info">
                                        <h3><?php short_title('', 60); ?> </h3>
                                        <p class="u-text--upper">
                                                <?php echo __('Media', 'w4ptheme'); ?>
                                                |
                                                <?php $terms = get_the_terms(get_the_ID(), 'artist_media'); ?>
                                                <?php if (!empty($terms)) : ?>
                                                    <?php foreach ($terms as $term): ?>
                                                        <?php $event_type[] = $term->name; ?>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                                <?php if (!empty($event_type)): ?>
                                                    <?php echo implode(", ", $event_type); ?>
                                                    <?php unset($event_type); ?>
                                                <?php endif; ?>
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

