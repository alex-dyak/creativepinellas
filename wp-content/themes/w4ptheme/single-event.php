<?php
/**
 * The template for displaying all single posts event.
 *
 * @package WordPress
 * @subpackage W4P-Theme
 * @since W4P Theme 1.0
 */

get_header(); ?>
    <section class="siteBody">

        <div class="row">
            <section class="medium-8 large-9 column siteContent siteContent--hasSidebar">
                <section class="row column">

                    <article class="postPage">
                        <!--    Back to category link -->
                        <div class="postPage-backLink">
                            <a href="<?php echo get_post_type_archive_link( 'event' ); ?>" title="go back to category"><?php echo __( 'View All Events', 'w4ptheme' );?></a>
                        </div>
                        <!--    Post title  -->
                        <h1 class="postPage-title"><?php the_title() ?></h1>

                        <!--    Post Info   -->
                        <div class="postPage-info">
                            <?php
                            /* @var $EM_Event EM_Event */
                            $start_time = $EM_Event->event_start_time ? date_create( $EM_Event->event_start_time ) : $start_time = null;
                            $end_time = $EM_Event->event_end_time ? date_create( $EM_Event->event_end_time ) : $end_time = null;
                            $start_date = $EM_Event->event_start_date ? date_create( $EM_Event->event_end_date ) : $start_date = null;
                            $end_date = $EM_Event->event_end_date ? date_create( $EM_Event->event_end_date ) : $end_date = null; ?>
                            <p><?php echo __( 'WHEN', 'w4ptheme' ) . ': ' . date_format( $start_date, 'F jS, Y' ) . ' @ ' . date_format($start_time, 'g:i A') . ' - ' . date_format( $end_time, 'g:i A' );?></p>
                            <p><?php echo __( 'COST', 'w4ptheme' ) . ': ' . get_field( 'event_cost' ); ?></p>
                            <?php $terms = get_the_terms( get_the_ID(), 'who-should-attend' ); ?>
                            <?php if ( !empty($terms) ) : ?>
                                <?php foreach( $terms as $term ): ?>
                                    <?php $terms_who_should_attend[] = $term->name; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <p>
                                <?php echo __('WHO SHOULD ATTEND', 'w4ptheme)') . ': '?>
                                <?php if( !empty($terms_who_should_attend) ): ?>
                                    <?php echo implode(", ", $terms_who_should_attend); ?>
                                <?php endif; ?>
                            </p>
                        </div>

                        <!--    Post Image   -->
                        <div class="postPage-image">
                            <?php the_post_thumbnail( 'single_event_img' ); ?>
                        </div>

                        <!--    Post Content    -->
                        <div class="postPage-content">
                            <?php echo $EM_Event->post_content;?>
                            <div class="postPage-content-links">
                                <a href="<?php echo $link_icall = isset ($EM_Event ) ? $EM_Event->get_ical_url() : '#'; ?>" class="btn"><?php echo __( '+ ADD TO iCALL', 'w4ptheme' );?></a>
                                <a href="<?php echo $link_calendar = isset( $EM_Event ) ? $EM_Event->output( '#_EVENTGCALURL' ) : '#' ; ?>" class="btn"><?php echo __( '+ ADD TO GOOGLE CALENDAR', 'w4ptheme' );?></a>
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
                        <h3><?php echo __( 'Event details H3', 'w4ptheme' );?></h3>

                        <div class="siteSidebar-item-content">
                            <p>
                                <strong><?php echo __( 'Date', 'w4ptheme' ) . ': ';?></strong><?php echo date_format( $start_date, 'F jS, Y' ); ?><br>
                                <strong><?php echo __( 'Time', 'w4ptheme' ) . ': ';?></strong><?php echo date_format ($start_time, 'g:i A' ) . ' - ' . date_format($end_time, 'g:i A');?>
                            </p>

                            <p>
                                <?php $terms = get_the_terms( get_the_ID(), 'event-type' ); ?>
                                <?php if ( !empty($terms) ) : ?>
                                    <?php foreach( $terms as $term ): ?>
                                        <?php $terms_event_type[] = $term->name; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <strong><?php echo __( 'Event type', 'w4ptheme)' ) . ': ';?></strong>
                                <?php if ( !empty($terms_event_type) ) : ?>
                                    <?php echo implode( ", ", $terms_event_type ); ?>
                                <?php endif; ?>
                            </p>
                            <p>
                                <strong><?php echo __( 'Artist(s)', 'w4ptheme)' ) . ': ';?></strong>
                                <?php $post_objects = get_field( 'event_artist' );
                                if( $post_objects ): ?>
                                    <?php foreach( $post_objects as $post): ?>
                                        <?php setup_postdata($post); ?>
                                        <?php $artist_links[] = '<a href="' . get_permalink( ) . '">' . get_the_title( ) . '</a>'?>
                                    <?php endforeach; ?>
                                    <?php wp_reset_postdata( ); ?>
                                <?php endif; ?>
                                <?php if (!empty($artist_links)) : ?>
                                    <?php echo implode(", ", $artist_links); ?>
                                <?php endif; ?>
                            </p>

                            <p>
                                <strong><?php echo __( 'Website', 'w4ptheme' ) . ': ';?></strong>
                                <?php $field_website = get_field( 'event_website' ); ?>
                                <?php if(!empty($field_website)) : ?>
                                    <a href="<?php the_field( 'event_website' );?>">
                                        <?php $parse =  parse_url( $field_website );
                                        echo $parse['host'];?>
                                    </a>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>

                    <!--    Sidebar widget  -->
                    <div class="siteSidebar-item">
                        <h3><?php echo __( 'Venue details H3', 'w4ptheme' );?></h3>
                        <?php $location = $EM_Event->get_location( ); ?>
                        <div class="siteSidebar-item-content">
                            <p><a href="<?php echo $location->guid;?>"><?php echo $location->location_name;?></a></p>

                            <p><?php echo $location->location_address;?><br> <?php echo $location->location_town .', ' . $location->location_postcode ;?><br><?php echo $location->get_country( );?></p>

                            <p><?php the_field( 'event_tel' );?></p>

                            <div class="siteSidebar-item-mapHolder">
                                <!-- Map here width x height settings sets in plugin settings > formatting as width: 100%; height: 280px; -->
                                <? if (isset($EM_Event)) : ?>
                                    <?php echo $map = $EM_Event->output( '#_LOCATIONMAP' ); ?>
                                <?php endif; ?>
                            </div>
                            <p><a href="<?php echo $location->guid;?>"><?php echo __( 'Get Directions', 'w4ptheme' );?></a></p>
                        </div>
                    </div>
                </div>
            </aside>
        </div>

    </section>
<?php get_footer(); ?>