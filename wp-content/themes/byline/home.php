<?php
/*
		*Template Name:Home
	*/
?>
<!-- mainslider -->

<?php Starkers_Utilities::get_template_parts(array('parts/shared/html-header', 'parts/shared/header')); ?>
<section class="post-section section-gap">

    <div class="random-posts independent-scroll">
        <div class="container px-4">
            <div class="row">
                <div class="col-lg-3">
                    <main class="axil-content medium-section">
                        <div class="section-title m-b-xs-10">
                            <a href="<?php echo get_safe_category_link('editors-pick'); ?>" class="d-block">
                                <h2 class="axil-title">Editor's Pick</h2>
                            </a>
                        </div>

                        <?php
                        // Get the most recent post from Editor's Pick category
                        $editors_pick_category = get_category_by_slug('editors-pick');
                        if ($editors_pick_category) {
                            $featured_post = new WP_Query(array(
                                'category_name' => 'editors-pick',
                                'posts_per_page' => 1,
                                'post_status' => 'publish'
                            ));

                            if ($featured_post->have_posts()) :
                                while ($featured_post->have_posts()) : $featured_post->the_post();
                        ?>
                        <div class="live-card">
                            <a href="<?php the_permalink(); ?>" class="block-link">
                                <div class="flex-1">
                                    <h3 class="featured-title"><?php the_title(); ?></h3>
                                    <div class="post-image-wrapper">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('large', array('class' => 'img-fluid img-border-radius', 'alt' => get_the_title())); ?>
                                        <?php else : ?>
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/new/hero.jpg" alt="<?php the_title_attribute(); ?>" class="img-fluid img-border-radius">
                                        <?php endif; ?>
                                        <?php
                                        // Get categories and find the first one that's not 'editors-pick' or 'featured'
                                        $categories = get_the_category();
                                        $main_category = null;
                                        if (!empty($categories)) {
                                            foreach ($categories as $category) {
                                                if ($category->slug !== 'editors-pick' && $category->slug !== 'featured') {
                                                    $main_category = $category;
                                                    break;
                                                }
                                            }
                                        }
                                        
                                        // Only show badge if we found a main category
                                        if ($main_category) :
                                        ?>
                                        <div class="post-cat-group badge-on-image">
                                            <a href="<?php echo esc_url(get_category_link($main_category->term_id)); ?>" class="post-cat cat-btn bg-primary-color"><?php echo esc_html($main_category->name); ?></a>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <p class="excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                                    <div class="d-flex align-items-center flex-nowrap">
                                        <div class="post-cat-group flex-shrink-0">
                                            <?php
                                            $categories = get_the_category();
                                            if (!empty($categories)) {
                                                $cat_count = 0;
                                                foreach ($categories as $category) {
                                                    // Skip special categories
                                                    if ($category->slug === 'editors-pick' || $category->slug === 'featured') {
                                                        continue;
                                                    }
                                                    
                                                    if ($cat_count > 0) echo ', ';
                                                    echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="post-cat color-blue-three">' . esc_html($category->name) . '</a>';
                                                    $cat_count++;
                                                    if ($cat_count >= 3) break; // Limit to 3 categories
                                                }
                                            }
                                            ?>
                                        </div>
                                        <div class="post-time ms-3 flex-shrink-0">
                                            <i class="far fa-clock clock-icon"></i><?php echo meks_time_ago(); ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                                endwhile;
                                wp_reset_postdata();
                            endif;
                        }
                        ?>
                        <?php
                        // Get 4 other posts from Editor's Pick category (excluding the first one)
                        if ($editors_pick_category) {
                            $other_posts = new WP_Query(array(
                                'category_name' => 'editors-pick',
                                'posts_per_page' => 4,
                                'offset' => 1, // Skip the first post (already shown in featured card)
                                'post_status' => 'publish'
                            ));

                            if ($other_posts->have_posts()) :
                                while ($other_posts->have_posts()) : $other_posts->the_post();
                        ?>
                        <a href="<?php the_permalink(); ?>" class="block-link">
                            <div class="media post-block small-block">
                                <a href="<?php the_permalink(); ?>" class="block-link">
                                    <div>
                                        <h3 class="featured-title"><?php the_title(); ?></h3>
                                        <div class="d-flex align-items-center flex-nowrap">
                                            <div class="post-cat-group flex-shrink-0">
                                                <?php
                                                $categories = get_the_category();
                                                if (!empty($categories)) {
                                                    $cat_count = 0;
                                                    foreach ($categories as $category) {
                                                        // Skip special categories
                                                        if ($category->slug === 'editors-pick' || $category->slug === 'featured') {
                                                            continue;
                                                        }
                                                        
                                                        if ($cat_count > 0) echo ', ';
                                                        echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="post-cat color-blue-three">' . esc_html($category->name) . '</a>';
                                                        $cat_count++;
                                                        if ($cat_count >= 2) break; // Limit to 2 categories for smaller blocks
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <div class="post-time ms-3 flex-shrink-0">
                                                <i class="far fa-clock clock-icon"></i><?php echo meks_time_ago(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </a>
                        <?php
                                endwhile;
                                wp_reset_postdata();
                            endif;
                        }
                        ?>



                                        </main>
                                        <!-- End of .axil-content -->
                </div>
            <!-- End of .col-lg-3 -->
            <div class="col-lg-5">
                <aside class="main-lead-section">
                    <div class="section-title m-b-xs-10">
                        <a href="<?php echo get_safe_category_link('featured'); ?>" class="d-block">
                            <h2 class="axil-title">Featured News</h2>
                        </a>
                    </div>

                    <?php
                    // Get the most recent post from Featured category
                    $featured_category = get_category_by_slug('featured');
                    if ($featured_category) {
                        $featured_post = new WP_Query(array(
                            'category_name' => 'featured',
                            'posts_per_page' => 1,
                            'post_status' => 'publish'
                        ));

                        if ($featured_post->have_posts()) :
                            while ($featured_post->have_posts()) : $featured_post->the_post();
                    ?>
                    <div class="live-card">
                        <a href="<?php the_permalink(); ?>" class="block-link">
                            <div class="flex-1">
                                <h3 class="featured-title"><?php the_title(); ?></h3>
                                <div class="d-flex align-items-center flex-nowrap">
                                    <div class="post-cat-group flex-shrink-0">
                                        <?php
                                        $categories = get_the_category();
                                        if (!empty($categories)) {
                                            $cat_count = 0;
                                            foreach ($categories as $category) {
                                                // Skip special categories
                                                if ($category->slug === 'editors-pick' || $category->slug === 'featured') {
                                                    continue;
                                                }
                                                
                                                if ($cat_count > 0) echo ', ';
                                                echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="post-cat color-blue-three">' . esc_html($category->name) . '</a>';
                                                $cat_count++;
                                                if ($cat_count >= 3) break; // Limit to 3 categories
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="post-time ms-3 flex-shrink-0">
                                        <i class="far fa-clock clock-icon"></i><?php echo meks_time_ago(); ?>
                                    </div>
                                </div>
                                <div class="post-image-wrapper">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('large', array('class' => 'img-fluid img-border-radius', 'alt' => get_the_title())); ?>
                                    <?php else : ?>
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/new/hero.jpg" alt="<?php the_title_attribute(); ?>" class="img-fluid img-border-radius">
                                    <?php endif; ?>
                                    <?php
                                    // Get categories and find the first one that's not 'editors-pick' or 'featured'
                                    $categories = get_the_category();
                                    $main_category = null;
                                    if (!empty($categories)) {
                                        foreach ($categories as $category) {
                                            if ($category->slug !== 'editors-pick' && $category->slug !== 'featured') {
                                                $main_category = $category;
                                                break;
                                            }
                                        }
                                    }
                                    
                                    // Only show badge if we found a main category
                                    if ($main_category) :
                                    ?>
                                    <div class="post-cat-group badge-on-image">
                                        <a href="<?php echo esc_url(get_category_link($main_category->term_id)); ?>" class="post-cat cat-btn bg-primary-color"><?php echo esc_html($main_category->name); ?></a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <p class="excerpt"><?php echo wp_trim_words(get_the_excerpt(), 12, '...'); ?></p>
                            </div>
                        </a>
                    </div>
                    <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                    }
                    ?>
                    <?php
                    // Get 4 other posts from Featured category (excluding the first one)
                    if ($featured_category) {
                        $other_posts = new WP_Query(array(
                            'category_name' => 'featured',
                            'posts_per_page' => 4,
                            'offset' => 1, // Skip the first post (already shown in featured card)
                            'post_status' => 'publish'
                        ));

                        if ($other_posts->have_posts()) :
                            while ($other_posts->have_posts()) : $other_posts->the_post();
                    ?>
                    <a href="<?php the_permalink(); ?>" class="block-link">
                        <div class="media post-block small-block">
                            <div class="post-image-wrapper">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium', array('class' => 'img-fluid', 'alt' => get_the_title())); ?>
                                <?php else : ?>
                                    <img class="img-fluid" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/new/hero.jpg" alt="<?php the_title_attribute(); ?>">
                                <?php endif; ?>
                                <?php echo get_video_play_button(); ?>
                            </div>
                            <div class="media-body">
                                <a href="<?php the_permalink(); ?>" class="block-link">
                                    <h4 class="axil-post-title"><?php the_title(); ?></h4>
                                </a>
                                <div class="d-flex align-items-center flex-nowrap">
                                    <div class="post-cat-group flex-shrink-0">
                                        <?php
                                        $categories = get_the_category();
                                        if (!empty($categories)) {
                                            $cat_count = 0;
                                            foreach ($categories as $category) {
                                                // Skip special categories
                                                if ($category->slug === 'editors-pick' || $category->slug === 'featured') {
                                                    continue;
                                                }
                                                
                                                if ($cat_count > 0) echo ', ';
                                                echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="post-cat color-blue-three">' . esc_html($category->name) . '</a>';
                                                $cat_count++;
                                                if ($cat_count >= 2) break; // Limit to 2 categories for smaller blocks
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="post-time ms-3 flex-shrink-0">
                                        <i class="far fa-clock clock-icon"></i><?php echo meks_time_ago(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                    }
                    ?>
                


    </aside>
    <!-- End of .post-sidebar -->
    </div>
    <!-- End of .col-lg-4 -->
    <div class="col-lg-4">
        <aside class="post-sidebar">



            <!-- Gold Exchange Rate Widget -->
            <div class="exchange-widget bg-grey-light-three m-b-xs-20">
                <div class="section-title m-b-xs-10">
                    <a href="#" class="d-block">
                        <h2 class="axil-title">Gold Exchange Rates</h2>
                    </a>
                    <div class="last-updated">Last updated: <span id="gold-last-updated">--</span></div>
                </div>
                <div class="exchange-rates">
                    <div class="rate-item">
                        <div class="currency-info">
                            <span class="currency-name">Gold (24K)</span>
                        </div>
                        <div class="rate-values">
                            <span class="rate-value" id="gold-aed">--</span>
                            <span class="currency-symbol">AED</span>
                            <span class="rate-value" id="gold-inr">--</span>
                            <span class="currency-symbol">INR</span>
                        </div>
                    </div>
                </div>
                <div class="widget-footer">
                    <small class="text-muted">Rates per gram</small>
                </div>
            </div>
            <!-- End of Gold Exchange Rate Widget -->

            <!-- Money Exchange Rate Widget -->
            <div class="exchange-widget bg-grey-light-three m-b-xs-40">
                <div class="section-title m-b-xs-10">
                    <a href="#" class="d-block">
                        <h2 class="axil-title">Currency Exchange Rates</h2>
                    </a>
                    <div class="last-updated">Last updated: <span id="currency-last-updated">--</span></div>
                </div>
                <div class="exchange-rates">
                    <div class="rate-item">
                        <div class="currency-info">
                            <span class="currency-name">USD to AED</span>
                            <span class="currency-symbol">$ → د.إ</span>
                        </div>
                        <div class="rate-value" id="usd-aed">--</div>
                    </div>
                    <div class="rate-item">
                        <div class="currency-info">
                            <span class="currency-name">USD to INR</span>
                            <span class="currency-symbol">$ → ₹</span>
                        </div>
                        <div class="rate-value" id="usd-inr">--</div>
                    </div>
                    <div class="rate-item">
                        <div class="currency-info">
                            <span class="currency-name">AED to INR</span>
                            <span class="currency-symbol">د.إ → ₹</span>
                        </div>
                        <div class="rate-value" id="aed-inr">--</div>
                    </div>
                </div>
                <div class="widget-footer">
                    <small class="text-muted">Live rates from exchange APIs</small>
                </div>
            </div>
            <!-- End of Money Exchange Rate Widget --> <!-- Advertisement Section -->
            <!-- End Advertisement Section -->
            <main class="axil-content big-section">
                <div class="advertisement-section m-b-xs-20">
                    <a href="#" class="d-block">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/new/advt.png" alt="Advertisement" class="img-fluid" class="advertisement-image">
                    </a>
                </div>
                <!-- End Advertisement Section -->




            </main>
            <!-- End of .axil-content -->





        </aside>
        <!-- End of .post-sidebar -->
    </div>
    <!-- End of .col-lg-4 -->
    </div>
    <!-- End of .row -->
    </div>
    <!-- End of .container -->
    </div>
    <!-- End of .random-posts -->
</section>



<section class="post-section section-gap bg-grey-light-one">
    <div class="random-posts independent-scroll">
        <div class="container px-4">
            <div class="row">
                <div class="col-lg-4">
                    <main class="axil-content big-section">
                        <div class="section-title m-b-xs-10">
                            <a href="<?php echo get_safe_category_link('gulf'); ?>" class="d-block">
                                <h2 class="axil-title">Gulf News</h2>
                            </a>
                        </div>

                        <?php
                        // Get the most recent post from Gulf category
                        $gulf_category = get_category_by_slug('gulf');
                        if ($gulf_category) {
                            $gulf_post = new WP_Query(array(
                                'category_name' => 'gulf',
                                'posts_per_page' => 1,
                                'post_status' => 'publish'
                            ));

                            if ($gulf_post->have_posts()) :
                                while ($gulf_post->have_posts()) : $gulf_post->the_post();
                        ?>
                        <div class="live-card">
                            <a href="<?php the_permalink(); ?>" class="block-link">
                                <div class="flex-1">
                                    <h3 class="featured-title"><?php the_title(); ?></h3>
                                    <p class="excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                                    <div class="d-flex align-items-center flex-nowrap">
                                        <div class="post-cat-group flex-shrink-0">
                                            <?php
                                            $categories = get_the_category();
                                            if (!empty($categories)) {
                                                $cat_count = 0;
                                                foreach ($categories as $category) {
                                                    // Skip special categories
                                                    if ($category->slug === 'editors-pick' || $category->slug === 'featured' || $category->slug === 'gulf') {
                                                        continue;
                                                    }
                                                    
                                                    if ($cat_count > 0) echo ', ';
                                                    echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="post-cat color-blue-three">' . esc_html($category->name) . '</a>';
                                                    $cat_count++;
                                                    if ($cat_count >= 2) break; // Limit to 2 categories for Gulf News
                                                }
                                            }
                                            ?>
                                        </div>
                                        <div class="post-time ms-3 flex-shrink-0">
                                            <i class="far fa-clock clock-icon"></i><?php echo meks_time_ago(); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="post-image-wrapper">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('large', array('class' => 'img-fluid img-border-radius', 'alt' => get_the_title())); ?>
                                    <?php else : ?>
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/new/hero.jpg" alt="<?php the_title_attribute(); ?>" class="img-fluid img-border-radius">
                                    <?php endif; ?>
                                    <?php
                                    // Get categories and find the first one that's not special categories
                                    $categories = get_the_category();
                                    $main_category = null;
                                    if (!empty($categories)) {
                                        foreach ($categories as $category) {
                                            if ($category->slug !== 'editors-pick' && $category->slug !== 'featured' && $category->slug !== 'gulf') {
                                                $main_category = $category;
                                                break;
                                            }
                                        }
                                    }
                                    
                                    // Only show badge if we found a main category
                                    if ($main_category) :
                                    ?>
                                    <div class="post-cat-group badge-on-image">
                                        <a href="<?php echo esc_url(get_category_link($main_category->term_id)); ?>" class="post-cat cat-btn bg-primary-color"><?php echo esc_html($main_category->name); ?></a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </div>
                        <?php
                                endwhile;
                                wp_reset_postdata();
                            endif;
                        }
                        ?>
                        <?php
                        // Get 4 other posts from Gulf category (excluding the first one)
                        if ($gulf_category) {
                            $other_posts = new WP_Query(array(
                                'category_name' => 'gulf',
                                'posts_per_page' => 4,
                                'offset' => 1, // Skip the first post (already shown in featured card)
                                'post_status' => 'publish'
                            ));

                            if ($other_posts->have_posts()) :
                                while ($other_posts->have_posts()) : $other_posts->the_post();
                        ?>
                        <a href="<?php the_permalink(); ?>" class="block-link">
                            <div class="media post-block small-block">
                                <div class="post-image-wrapper">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('medium', array('class' => 'img-fluid', 'alt' => get_the_title())); ?>
                                    <?php else : ?>
                                        <img class="img-fluid" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/new/hero.jpg" alt="<?php the_title_attribute(); ?>">
                                    <?php endif; ?>
                                    <?php echo get_video_play_button(); ?>
                                </div>
                                <div class="media-body">
                                    <a href="<?php the_permalink(); ?>" class="block-link">
                                        <h4 class="axil-post-title"><?php the_title(); ?></h4>
                                    </a>
                                    <div class="d-flex align-items-center flex-nowrap">
                                        <div class="post-cat-group flex-shrink-0">
                                            <?php
                                            $categories = get_the_category();
                                            if (!empty($categories)) {
                                                $cat_count = 0;
                                                foreach ($categories as $category) {
                                                    // Skip special categories
                                                    if ($category->slug === 'editors-pick' || $category->slug === 'featured' || $category->slug === 'gulf') {
                                                        continue;
                                                    }
                                                    
                                                    if ($cat_count > 0) echo ', ';
                                                    echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="post-cat color-blue-three">' . esc_html($category->name) . '</a>';
                                                    $cat_count++;
                                                    if ($cat_count >= 2) break; // Limit to 2 categories for smaller blocks
                                                }
                                            }
                                            ?>
                                        </div>
                                        <div class="post-time ms-3 flex-shrink-0">
                                            <i class="far fa-clock clock-icon"></i><?php echo meks_time_ago(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                                endwhile;
                                wp_reset_postdata();
                            endif;
                        }
                        ?>
    

    </main>
    <!-- End of .axil-content -->
    </div>
    <!-- End of .col-lg-8 -->
    <div class="col-lg-4">
        <aside class="post-sidebar medium-section">


            <div class="section-title m-b-xs-10">
                <a href="<?php echo get_safe_category_link('uae'); ?>" class="d-block">
                    <h2 class="axil-title">UAE UPDATES</h2>
                </a>
            </div>

            <?php
            // Get the most recent post from UAE category
            $uae_category = get_category_by_slug('uae');
            if ($uae_category) {
                $uae_post = new WP_Query(array(
                    'category_name' => 'uae',
                    'posts_per_page' => 1,
                    'post_status' => 'publish'
                ));

                if ($uae_post->have_posts()) :
                    while ($uae_post->have_posts()) : $uae_post->the_post();
            ?>
            <div class="live-card">
                <a href="<?php the_permalink(); ?>" class="block-link">
                    <div class="flex-1">
                        <h3 class="featured-title"><?php the_title(); ?></h3>
                        <p class="excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                        <div class="d-flex align-items-center flex-nowrap">
                            <div class="post-cat-group flex-shrink-0">
                                <?php
                                $categories = get_the_category();
                                if (!empty($categories)) {
                                    $cat_count = 0;
                                    foreach ($categories as $category) {
                                        // Skip special categories
                                        if ($category->slug === 'editors-pick' || $category->slug === 'featured' || $category->slug === 'gulf' || $category->slug === 'uae') {
                                            continue;
                                        }
                                        
                                        if ($cat_count > 0) echo ', ';
                                        echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="post-cat color-blue-three">' . esc_html($category->name) . '</a>';
                                        $cat_count++;
                                        if ($cat_count >= 2) break; // Limit to 2 categories for UAE Updates
                                    }
                                }
                                ?>
                            </div>
                            <div class="post-time ms-3 flex-shrink-0">
                                <i class="far fa-clock clock-icon"></i><?php echo meks_time_ago(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="post-image-wrapper">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('large', array('class' => 'img-fluid img-border-radius', 'alt' => get_the_title())); ?>
                        <?php else : ?>
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/new/hero.jpg" alt="<?php the_title_attribute(); ?>" class="img-fluid img-border-radius">
                        <?php endif; ?>
                        <?php
                        // Get categories and find the first one that's not special categories
                        $categories = get_the_category();
                        $main_category = null;
                        if (!empty($categories)) {
                            foreach ($categories as $category) {
                                if ($category->slug !== 'editors-pick' && $category->slug !== 'featured' && $category->slug !== 'gulf' && $category->slug !== 'uae') {
                                    $main_category = $category;
                                    break;
                                }
                            }
                        }
                        
                        // Only show badge if we found a main category
                        if ($main_category) :
                        ?>
                        <div class="post-cat-group badge-on-image">
                            <a href="<?php echo esc_url(get_category_link($main_category->term_id)); ?>" class="post-cat cat-btn bg-primary-color"><?php echo esc_html($main_category->name); ?></a>
                        </div>
                        <?php endif; ?>
                    </div>
                </a>
            </div>
            <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
            }
            ?>
            <?php
            // Get 4 other posts from UAE category (excluding the first one)
            if ($uae_category) {
                $other_posts = new WP_Query(array(
                    'category_name' => 'uae',
                    'posts_per_page' => 4,
                    'offset' => 1, // Skip the first post (already shown in featured card)
                    'post_status' => 'publish'
                ));

                if ($other_posts->have_posts()) :
                    while ($other_posts->have_posts()) : $other_posts->the_post();
            ?>
            <a href="<?php the_permalink(); ?>" class="block-link">
                <div class="media post-block small-block">
                    <div class="post-image-wrapper">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('medium', array('class' => 'img-fluid', 'alt' => get_the_title())); ?>
                        <?php else : ?>
                            <img class="img-fluid" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/new/hero.jpg" alt="<?php the_title_attribute(); ?>">
                        <?php endif; ?>
                        <?php echo get_video_play_button(); ?>
                    </div>
                    <div class="media-body">
                        <a href="<?php the_permalink(); ?>" class="block-link">
                            <h4 class="axil-post-title"><?php the_title(); ?></h4>
                        </a>
                        <div class="d-flex align-items-center flex-nowrap">
                            <div class="post-cat-group flex-shrink-0">
                                <?php
                                $categories = get_the_category();
                                if (!empty($categories)) {
                                    $cat_count = 0;
                                    foreach ($categories as $category) {
                                        // Skip special categories
                                        if ($category->slug === 'editors-pick' || $category->slug === 'featured' || $category->slug === 'gulf' || $category->slug === 'uae') {
                                            continue;
                                        }
                                        
                                        if ($cat_count > 0) echo ', ';
                                        echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="post-cat color-blue-three">' . esc_html($category->name) . '</a>';
                                        $cat_count++;
                                        if ($cat_count >= 2) break; // Limit to 2 categories for smaller blocks
                                    }
                                }
                                ?>
                            </div>
                            <div class="post-time ms-3 flex-shrink-0">
                                <i class="far fa-clock clock-icon"></i><?php echo meks_time_ago(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
            }
            ?>
    </aside>
    <!-- End of .post-sidebar -->
    </div>
    <!-- End of .col-lg-4 -->
    <div class="col-lg-4">
        <aside class="post-sidebar">
            <!-- Advertisement Section -->
            <!-- End Advertisement Section -->
            <main class="axil-content big-section">
                <!-- End Advertisement Section -->
                <div class="section-title m-b-xs-10">
                    <a href="#" class="d-block">
                        <h2 class="axil-title">Recommended For You</h2>
                    </a>
                </div>

                <?php
                // Get recommended posts using our algorithm
                $recommended_posts = get_recommended_posts(6, array());
                
                if (!empty($recommended_posts)) :
                    $post_counter = 1;
                    foreach ($recommended_posts as $post) :
                        setup_postdata($post);
                ?>
                <a href="<?php echo get_permalink($post->ID); ?>" class="block-link">
                    <div class="media post-block small-block">
                        <div class="post-image-wrapper">
                            <?php if (has_post_thumbnail($post->ID)) : ?>
                                <?php echo get_the_post_thumbnail($post->ID, 'medium', array('class' => 'img-fluid', 'alt' => get_the_title($post->ID))); ?>
                            <?php else : ?>
                                <img class="img-fluid" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/new/hero.jpg" alt="<?php echo esc_attr(get_the_title($post->ID)); ?>">
                            <?php endif; ?>
                            <div class="post-cat-group badge-on-recommended">
                                <a href="#" class="post-cat cat-btn bg-primary-color"><?php echo $post_counter; ?></a>
                            </div>
                        </div>
                        <div class="media-body">
                            <h4 class="axil-post-title"><?php echo get_the_title($post->ID); ?></h4>
                            <div class="d-flex align-items-center flex-nowrap">
                                <div class="post-cat-group flex-shrink-0">
                                    <?php
                                    $categories = get_the_category($post->ID);
                                    if (!empty($categories)) {
                                        $cat_count = 0;
                                        foreach ($categories as $category) {
                                            // Skip special categories
                                            if (in_array($category->slug, array('editors-pick', 'featured', 'gulf', 'uae', 'video', 'kerala', 'entertainment', 'sports'))) {
                                                continue;
                                            }
                                            
                                            if ($cat_count > 0) echo ', ';
                                            echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="post-cat color-blue-three">' . esc_html($category->name) . '</a>';
                                            $cat_count++;
                                            if ($cat_count >= 2) break; // Limit to 2 categories
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="post-time ms-3 flex-shrink-0">
                                    <i class="far fa-clock clock-icon"></i><?php echo meks_time_ago($post->ID); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <?php
                        $post_counter++;
                    endforeach;
                    wp_reset_postdata();
                else :
                    // Fallback to trending posts if no recommendations available
                    $trending_posts = get_posts(array(
                        'numberposts' => 6,
                        'post_status' => 'publish',
                        'orderby' => 'date',
                        'order' => 'DESC'
                    ));
                    
                    if (!empty($trending_posts)) :
                        $post_counter = 1;
                        foreach ($trending_posts as $post) :
                            setup_postdata($post);
                ?>
                <a href="<?php echo get_permalink($post->ID); ?>" class="block-link">
                    <div class="media post-block small-block">
                        <div class="post-image-wrapper">
                            <?php if (has_post_thumbnail($post->ID)) : ?>
                                <?php echo get_the_post_thumbnail($post->ID, 'medium', array('class' => 'img-fluid', 'alt' => get_the_title($post->ID))); ?>
                            <?php else : ?>
                                <img class="img-fluid" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/new/hero.jpg" alt="<?php echo esc_attr(get_the_title($post->ID)); ?>">
                            <?php endif; ?>
                            <div class="post-cat-group badge-on-recommended">
                                <a href="#" class="post-cat cat-btn bg-primary-color"><?php echo $post_counter; ?></a>
                            </div>
                        </div>
                        <div class="media-body">
                            <h4 class="axil-post-title"><?php echo get_the_title($post->ID); ?></h4>
                            <div class="d-flex align-items-center flex-nowrap">
                                <div class="post-cat-group flex-shrink-0">
                                    <?php
                                    $categories = get_the_category($post->ID);
                                    if (!empty($categories)) {
                                        $cat_count = 0;
                                        foreach ($categories as $category) {
                                            // Skip special categories
                                            if (in_array($category->slug, array('editors-pick', 'featured', 'gulf', 'uae', 'video', 'kerala', 'entertainment', 'sports'))) {
                                                continue;
                                            }
                                            
                                            if ($cat_count > 0) echo ', ';
                                            echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="post-cat color-blue-three">' . esc_html($category->name) . '</a>';
                                            $cat_count++;
                                            if ($cat_count >= 2) break; // Limit to 2 categories
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="post-time ms-3 flex-shrink-0">
                                    <i class="far fa-clock clock-icon"></i><?php echo meks_time_ago($post->ID); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <?php
                            $post_counter++;
                        endforeach;
                        wp_reset_postdata();
                    endif;
                endif;
                ?>


    </main>
    <!-- End of .axil-content -->





    </aside>
    <!-- End of .post-sidebar -->
    </div>
    <!-- End of .col-lg-4 -->
    </div>
    <!-- End of .row -->
    </div>
    <!-- End of .container -->
    </div>
    <!-- End of .random-posts -->
</section>

<section class="axil-video-posts section-gap section-gap-top__with-text bg-grey-dark-one">
    <div class="container">
        <div class="section-title m-b-xs-10 text-white">
            <a href="<?php echo get_safe_category_link('video'); ?>" class="d-block">
                <h2 class="axil-title">VIDEO STORIES</h2>
            </a>
        </div>
        <!-- End of .section-title -->

        <?php
        // Get the most recent post from Video category
        $video_category = get_category_by_slug('video');
        if ($video_category) {
            $video_post = new WP_Query(array(
                'category_name' => 'video',
                'posts_per_page' => 1,
                'post_status' => 'publish'
            ));

            if ($video_post->have_posts()) :
                while ($video_post->have_posts()) : $video_post->the_post();
        ?>
        <div class="row">
            <div class="col-lg-6">
                <div class="axil-img-container flex-height-container video-container__type-2 m-b-xs-30" class="post-image-wrapper">
                    <a href="<?php the_permalink(); ?>" class="d-block h-100">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('large', array('class' => 'w-100', 'alt' => get_the_title())); ?>
                        <?php else : ?>
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/new/hero.jpg" alt="<?php the_title_attribute(); ?>" class="w-100">
                        <?php endif; ?>
                        <div class="grad-overlay grad-overlay__transparent"></div>

                        <div class="video-popup video-play-btn"></div>
                    </a>
                    <div class="post-image-wrapper" class="gallery-overlay">
                        <?php
                        // Get categories and find the first one that's not special categories
                        $categories = get_the_category();
                        $main_category = null;
                        if (!empty($categories)) {
                            foreach ($categories as $category) {
                                if ($category->slug !== 'editors-pick' && $category->slug !== 'featured' && $category->slug !== 'gulf' && $category->slug !== 'uae' && $category->slug !== 'video') {
                                    $main_category = $category;
                                    break;
                                }
                            }
                        }
                        
                        // Only show badge if we found a main category
                        if ($main_category) :
                        ?>
                        <div class="post-cat-group badge-on-image">
                            <a href="<?php echo esc_url(get_category_link($main_category->term_id)); ?>"
                                class="post-cat cat-btn btn-big bg-primary-color"><?php echo esc_html($main_category->name); ?></a>
                        </div>
                        <?php endif; ?>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="block-link">
                        <div class="media post-block grad-overlay__transparent position-absolute">
                            <div class="media-body media-body__big">
                                <div class="axil-media-bottom mt-auto">
                                    <h3 class="axil-post-title hover-line"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <div class="post-metas">
                                        <ul class="list-inline">
                                            <li>By <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="post-author"><?php the_author(); ?></a></li>
                                            <li><i class="dot">.</i><?php echo get_the_date(); ?></li>
                                            <li><a href="#"><i class="feather icon-activity"></i><?php echo get_post_views(get_the_ID()); ?> Views</a></li>
                                            <li><a href="#"><i class="feather icon-share-2"></i><?php echo get_share_count(); ?> Shares</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- End of .media-body -->
                        </div>
                        <!-- End of .post-block -->
                </div>
                <!-- End of .axil-img-container -->
            </div>
            <!-- End of .col-lg-6 -->

            <div class="col-lg-6">
                <div class="axil-content">
                    <?php
                    // Get 4 other posts from Video category (excluding the first one)
                    $other_posts = new WP_Query(array(
                        'category_name' => 'video',
                        'posts_per_page' => 4,
                        'offset' => 1, // Skip the first post (already shown in featured card)
                        'post_status' => 'publish'
                    ));

                    if ($other_posts->have_posts()) :
                        while ($other_posts->have_posts()) : $other_posts->the_post();
                    ?>
                    <a href="<?php the_permalink(); ?>" class="block-link">
                        <div class="media post-block top-story-post-block post-block__on-dark-bg m-b-xs-30">
                            <a href="<?php the_permalink(); ?>" class="align-self-center post-image-wrapper">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php 
                                    $thumbnail_id = get_post_thumbnail_id();
                                    $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'medium');
                                    if ($thumbnail_url) {
                                        echo '<img class="m-r-xs-30 wp-post-image" src="' . esc_url($thumbnail_url[0]) . '" alt="' . esc_attr(get_the_title()) . '" decoding="async" loading="lazy">';
                                    }
                                    ?>
                                <?php else : ?>
                                    <img class="m-r-xs-30" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/new/hero.jpg" alt="<?php the_title_attribute(); ?>">
                                <?php endif; ?>
                                <?php echo get_video_play_button(); ?>
                            </a>
                            <div class="media-body">
                                <h3 class="axil-post-title hover-line"><?php the_title(); ?></h3>
                                <div class="d-flex align-items-center flex-nowrap">
                                    <div class="post-cat-group flex-shrink-0">
                                        <?php
                                        $categories = get_the_category();
                                        if (!empty($categories)) {
                                            $cat_count = 0;
                                            foreach ($categories as $category) {
                                                // Skip special categories
                                                if ($category->slug === 'editors-pick' || $category->slug === 'featured' || $category->slug === 'gulf' || $category->slug === 'uae' || $category->slug === 'video') {
                                                    continue;
                                                }
                                                
                                                if ($cat_count > 0) echo ', ';
                                                echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="post-cat color-blue-three">' . esc_html($category->name) . '</a>';
                                                $cat_count++;
                                                if ($cat_count >= 2) break; // Limit to 2 categories for smaller blocks
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="post-time ms-3 flex-shrink-0">
                                        <i class="far fa-clock clock-icon"></i><?php echo meks_time_ago(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of .post-block -->
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
                <!-- End of .axil-content -->
            </div>
            <!-- End of .col-lg-6 -->
        </div>
        <?php
                endwhile;
                wp_reset_postdata();
            endif;
        }
        ?>
        <!-- End of .row -->
    </div>
    <!-- End of .container -->
</section>
<!-- End of .axil-video-posts -->

<section class="post-section section-gap">
    <div class="random-posts">
        <div class="container px-4">
            <div class="section-title m-b-xs-10">
                <a href="#" class="d-block">
                    <h2 class="axil-title">KERALA NEWS</h2>
                </a>
            </div>
            <div class="row">

                <?php
                // Get 3 posts from Kerala category for big cards
                $kerala_big_posts = new WP_Query(array(
                    'category_name' => 'kerala',
                    'posts_per_page' => 3,
                    'post_status' => 'publish'
                ));

                if ($kerala_big_posts->have_posts()) :
                    while ($kerala_big_posts->have_posts()) : $kerala_big_posts->the_post();
                ?>
                <div class="col-lg-4">
                    <div class="axil-img-container flex-height-container video-container__type-2 m-b-xs-30" class="post-image-wrapper">
                        <a href="<?php the_permalink(); ?>" class="d-block h-100">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large', array('class' => 'w-100', 'alt' => get_the_title())); ?>
                            <?php else : ?>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/new/hero.jpg" alt="<?php the_title_attribute(); ?>" class="w-100">
                            <?php endif; ?>
                            <div class="grad-overlay grad-overlay__transparent"></div>

                            <?php echo get_video_play_button(); ?>
                        </a>
                        <div class="post-image-wrapper" class="gallery-overlay">
                            <?php
                            // Get categories and find the first one that's not special categories
                            $categories = get_the_category();
                            $main_category = null;
                            if (!empty($categories)) {
                                foreach ($categories as $category) {
                                    if ($category->slug !== 'editors-pick' && $category->slug !== 'featured' && $category->slug !== 'gulf' && $category->slug !== 'uae' && $category->slug !== 'video' && $category->slug !== 'kerala') {
                                        $main_category = $category;
                                        break;
                                    }
                                }
                            }
                            
                            // Only show badge if we found a main category
                            if ($main_category) :
                            ?>
                            <div class="post-cat-group badge-on-image">
                                <a href="<?php echo esc_url(get_category_link($main_category->term_id)); ?>"
                                    class="post-cat cat-btn btn-big bg-primary-color"><?php echo esc_html($main_category->name); ?></a>
                            </div>
                            <?php endif; ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="block-link">
                            <div class="media post-block grad-overlay__transparent position-absolute">
                                <div class="media-body media-body__big">
                                    <div class="axil-media-bottom mt-auto">
                                        <h3 class="axil-post-title hover-line kerala-news-title"><?php the_title(); ?></h3>
                                    </div>
                                </div>
                                <!-- End of .media-body -->
                            </div>
                            <!-- End of .post-block -->
                        </a>
                    </div>
                    <!-- End of .axil-img-container -->
                </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
                
                

    </div>
    <!-- End of .row -->

    <!-- Small Cards Section -->
    <div class="row">
        <?php
        // Get 3 posts from Kerala category for small cards
        $kerala_small_posts = new WP_Query(array(
            'category_name' => 'kerala',
            'posts_per_page' => 3,
            'post_status' => 'publish'
        ));

        if ($kerala_small_posts->have_posts()) :
            while ($kerala_small_posts->have_posts()) : $kerala_small_posts->the_post();
        ?>
        <div class="col-lg-4">
            <a href="<?php the_permalink(); ?>" class="block-link">
                <div class="media post-block small-block">
                    <div class="post-image-wrapper">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('medium', array('class' => 'img-fluid', 'alt' => get_the_title())); ?>
                        <?php else : ?>
                            <img class="img-fluid" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/new/hero.jpg" alt="<?php the_title_attribute(); ?>">
                        <?php endif; ?>
                        <?php echo get_video_play_button(); ?>
                    </div>
                    <div class="media-body">
                        <h4 class="axil-post-title"><?php the_title(); ?></h4>
                        <div class="d-flex align-items-center flex-nowrap">
                            <div class="post-cat-group flex-shrink-0">
                                <?php
                                $categories = get_the_category();
                                if (!empty($categories)) {
                                    $cat_count = 0;
                                    foreach ($categories as $category) {
                                        // Skip special categories
                                        if ($category->slug === 'editors-pick' || $category->slug === 'featured' || $category->slug === 'gulf' || $category->slug === 'uae' || $category->slug === 'video' || $category->slug === 'kerala') {
                                            continue;
                                        }
                                        
                                        if ($cat_count > 0) echo ', ';
                                        echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="post-cat color-blue-three">' . esc_html($category->name) . '</a>';
                                        $cat_count++;
                                        if ($cat_count >= 2) break; // Limit to 2 categories for smaller blocks
                                    }
                                }
                                ?>
                            </div>
                            <div class="post-time ms-3 flex-shrink-0">
                                <i class="far fa-clock clock-icon"></i><?php echo meks_time_ago(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <?php
            endwhile;
            wp_reset_postdata();
        else:
        ?>
        <!-- Fallback if no Kerala posts found -->
        <div class="col-lg-4">
            <a href="#" class="block-link">
                <div class="media post-block small-block">
                    <div class="post-image-wrapper">
                        <img class="img-fluid" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/new/hero.jpg" alt="Sample post">
                    </div>
                    <div class="media-body">
                        <h4 class="axil-post-title">Sample Kerala News Post</h4>
                        <div class="d-flex align-items-center flex-nowrap">
                            <div class="post-cat-group flex-shrink-0">
                                <a href="#" class="post-cat color-blue-three">News</a>
                            </div>
                            <div class="post-time ms-3 flex-shrink-0">
                                <i class="far fa-clock clock-icon"></i>1 hour ago
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4">
            <a href="#" class="block-link">
                <div class="media post-block small-block">
                    <div class="post-image-wrapper">
                        <img class="img-fluid" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/new/hero.jpg" alt="Sample post">
                    </div>
                    <div class="media-body">
                        <h4 class="axil-post-title">Another Kerala News Post</h4>
                        <div class="d-flex align-items-center flex-nowrap">
                            <div class="post-cat-group flex-shrink-0">
                                <a href="#" class="post-cat color-blue-three">Politics</a>
                            </div>
                            <div class="post-time ms-3 flex-shrink-0">
                                <i class="far fa-clock clock-icon"></i>2 hours ago
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4">
            <a href="#" class="block-link">
                <div class="media post-block small-block">
                    <div class="post-image-wrapper">
                        <img class="img-fluid" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/new/hero.jpg" alt="Sample post">
                    </div>
                    <div class="media-body">
                        <h4 class="axil-post-title">Third Kerala News Post</h4>
                        <div class="d-flex align-items-center flex-nowrap">
                            <div class="post-cat-group flex-shrink-0">
                                <a href="#" class="post-cat color-blue-three">Business</a>
                            </div>
                            <div class="post-time ms-3 flex-shrink-0">
                                <i class="far fa-clock clock-icon"></i>3 hours ago
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <?php
        endif;
        ?>
    </div>
    <!-- End of Small Cards Section -->


    </div>
    <!-- End of .container -->
    </div>
    <!-- End of .random-posts -->
</section>

<!-- Image Gallery Section -->
<section class="image-gallery p-b-xs-30 post-section section-gap">
    <div class="container">
        <div class="section-title m-b-xs-10">
            <a href="#" class="d-block">
                <h2 class="axil-title">IMAGE GALLERY</h2>
            </a>
        </div>
        <!-- End of .section-title -->
        <div class="grid-wrapper">
            <div class="row">
                <?php
                // Get 3 gallery posts
                $gallery_posts = new WP_Query(array(
                    'post_type' => 'gallery',
                    'posts_per_page' => 3,
                    'post_status' => 'publish',
                    'orderby' => 'date',
                    'order' => 'DESC'
                ));

                if ($gallery_posts->have_posts()) :
                    $gallery_count = 1;
                    while ($gallery_posts->have_posts()) : $gallery_posts->the_post();
                ?>
                <div class="col-lg-4 col-md-4">
                    <div class="axil-img-container flex-height-container gallery-container__type-2 m-b-xs-30" data-gallery="gallery-<?php echo get_the_ID(); ?>">
                        <div class="gallery-image-wrapper d-block h-100">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large', array('class' => 'w-100', 'alt' => get_the_title())); ?>
                            <?php else : ?>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/new/hero.jpg" alt="<?php the_title_attribute(); ?>" class="w-100">
                            <?php endif; ?>
                            <div class="grad-overlay grad-overlay__transparent"></div>
                            <div class="gallery-icon gallery-play-btn">
                                <i class="fas fa-expand"></i>
                            </div>
                        </div>
                        <div class="gallery-overlay">
                            <div class="post-cat-group badge-on-image">
                                <span class="post-cat cat-btn btn-big bg-primary-color">GALLERY</span>
                            </div>
                        </div>
                        <div class="media post-block grad-overlay__transparent position-absolute">
                            <div class="media-body media-body__big">
                                <div class="axil-media-bottom mt-auto">
                                    <h3 class="axil-post-title hover-line"><?php the_title(); ?></h3>
                                </div>
                            </div>
                            <!-- End of .media-body -->
                        </div>
                        <!-- End of .post-block -->
                    </div>
                </div>
                
                <!-- Hidden Gallery Slides for Modal -->
                <div style="display: none;">
                    <?php
                    // Get gallery images for this post
                    $gallery_images = get_post_meta(get_the_ID(), '_gallery_images', true);
                    if (!empty($gallery_images) && is_array($gallery_images)) {
                        foreach ($gallery_images as $image_data) {
                            if (!empty($image_data['image_id'])) {
                                $image_url = wp_get_attachment_image_url($image_data['image_id'], 'large');
                                $image_alt = get_post_meta($image_data['image_id'], '_wp_attachment_image_alt', true);
                                $caption = !empty($image_data['caption']) ? $image_data['caption'] : '';
                                ?>
                                <div class="gallery-slide" data-gallery="gallery-<?php echo get_the_ID(); ?>">
                                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" class="gallery-slide-image">
                                    <?php if (!empty($caption)) : ?>
                                        <div class="gallery-slide-caption"><?php echo esc_html($caption); ?></div>
                                    <?php endif; ?>
                                </div>
                                <?php
                            }
                        }
                    } else {
                        // Fallback to featured image if no gallery images
                        if (has_post_thumbnail()) {
                            $image_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                            ?>
                            <div class="gallery-slide" data-gallery="gallery-<?php echo get_the_ID(); ?>">
                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title_attribute(); ?>" class="gallery-slide-image">
                                <div class="gallery-slide-caption"><?php the_title(); ?></div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <?php
                        $gallery_count++;
                    endwhile;
                    wp_reset_postdata();
                else:
                    // Fallback static content if no gallery posts found
                ?>
                <div class="col-lg-4 col-md-4">
                    <div class="axil-img-container flex-height-container gallery-container__type-2 m-b-xs-30" data-gallery="gallery-fallback-1">
                        <div class="gallery-image-wrapper d-block h-100">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/new/vs.jpg" alt="VS Achuthanandan Gallery" class="w-100">
                            <div class="grad-overlay grad-overlay__transparent"></div>
                            <div class="gallery-icon gallery-play-btn">
                                <i class="fas fa-expand"></i>
                            </div>
                        </div>
                        <div class="gallery-overlay">
                            <div class="post-cat-group badge-on-image">
                                <span class="post-cat cat-btn btn-big bg-primary-color">GALLERY</span>
                            </div>
                        </div>
                        <div class="media post-block grad-overlay__transparent position-absolute">
                            <div class="media-body media-body__big">
                                <div class="axil-media-bottom mt-auto">
                                    <h3 class="axil-post-title hover-line">ജനനായകന്റെ അന്ത്യയാത്ര: വി.എസ്. അച്യുതാനന്ദൻ വിട</h3>
                                </div>
                            </div>
                            <!-- End of .media-body -->
                        </div>
                        <!-- End of .post-block -->
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="axil-img-container flex-height-container gallery-container__type-2 m-b-xs-30" data-gallery="gallery-fallback-2">
                        <div class="gallery-image-wrapper d-block h-100">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/new/dubai1.jpg" alt="Dubai Festival Gallery" class="w-100">
                            <div class="grad-overlay grad-overlay__transparent"></div>
                            <div class="gallery-icon gallery-play-btn">
                                <i class="fas fa-expand"></i>
                            </div>
                        </div>
                        <div class="gallery-overlay">
                            <div class="post-cat-group badge-on-image">
                                <span class="post-cat cat-btn btn-big bg-primary-color">GALLERY</span>
                            </div>
                        </div>
                        <div class="media post-block grad-overlay__transparent position-absolute">
                            <div class="media-body media-body__big">
                                <div class="axil-media-bottom mt-auto">
                                    <h3 class="axil-post-title hover-line">വർണ്ണവിസ്മയങ്ങളുടെ ദുബായ്: ഫെസ്റ്റിവൽ കാഴ്ചകൾ</h3>
                                </div>
                            </div>
                            <!-- End of .media-body -->
                        </div>
                        <!-- End of .post-block -->
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="axil-img-container flex-height-container gallery-container__type-2 m-b-xs-30" data-gallery="gallery-fallback-3">
                        <div class="gallery-image-wrapper d-block h-100">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/new/uae.jpg" alt="UAE National Day Gallery" class="w-100">
                            <div class="grad-overlay grad-overlay__transparent"></div>
                            <div class="gallery-icon gallery-play-btn">
                                <i class="fas fa-expand"></i>
                            </div>
                        </div>
                        <div class="gallery-overlay">
                            <div class="post-cat-group badge-on-image">
                                <span class="post-cat cat-btn btn-big bg-primary-color">GALLERY</span>
                            </div>
                        </div>
                        <div class="media post-block grad-overlay__transparent position-absolute">
                            <div class="media-body media-body__big">
                                <div class="axil-media-bottom mt-auto">
                                    <h3 class="axil-post-title hover-line">ചതുർവർണ്ണ പതാകയേന്തി ഒരു ജനത: ദേശീയ ദിനാഘോഷം</h3>
                                </div>
                            </div>
                            <!-- End of .media-body -->
                        </div>
                        <!-- End of .post-block -->
                    </div>
                </div>
                
                <!-- Hidden Gallery Slides for Modal (Fallback) -->
                <div style="display: none;">
                    <div class="gallery-slide" data-gallery="gallery-fallback-1">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/new/vs.jpg" alt="VS Achuthanandan Gallery" class="gallery-slide-image">
                        <div class="gallery-slide-caption">ജനനായകന്റെ അന്ത്യയാത്ര: വി.എസ്. അച്യുതാനന്ദൻ വിട</div>
                    </div>
                    <div class="gallery-slide" data-gallery="gallery-fallback-2">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/new/dubai1.jpg" alt="Dubai Festival Gallery" class="gallery-slide-image">
                        <div class="gallery-slide-caption">വർണ്ണവിസ്മയങ്ങളുടെ ദുബായ്: ഫെസ്റ്റിവൽ കാഴ്ചകൾ</div>
                    </div>
                    <div class="gallery-slide" data-gallery="gallery-fallback-3">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/new/uae.jpg" alt="UAE National Day Gallery" class="gallery-slide-image">
                        <div class="gallery-slide-caption">ചതുർവർണ്ണ പതാകയേന്തി ഒരു ജനത: ദേശീയ ദിനാഘോഷം</div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <!-- End of .row -->
        </div>
        <!-- End of .grid-wrapper -->
    </div>
    <!-- End of .container -->
</section>
<!-- End of Image Gallery Section -->

<!-- Entertainment and Sports Section -->
<section class="post-section section-gap">
    <div class="random-posts independent-scroll">
        <div class="container px-4">
            <div class="row">
                <div class="col-lg-4">
                    <main class="axil-content big-section">
                        <div class="section-title m-b-xs-10">
                            <a href="<?php echo get_safe_category_link('entertainment'); ?>" class="d-block">
                                <h2 class="axil-title">Entertainment</h2>
                            </a>
                        </div>

                        <?php
                        // Get the most recent post from Entertainment category
                        $entertainment_category = get_category_by_slug('entertainment');
                        if ($entertainment_category) {
                            $entertainment_post = new WP_Query(array(
                                'category_name' => 'entertainment',
                                'posts_per_page' => 1,
                                'post_status' => 'publish'
                            ));

                            if ($entertainment_post->have_posts()) :
                                while ($entertainment_post->have_posts()) : $entertainment_post->the_post();
                        ?>
                        <div class="live-card">
                            <a href="<?php the_permalink(); ?>" class="block-link">
                                <div class="flex-1">
                                    <h3 class="featured-title"><?php the_title(); ?></h3>
                                    <p class="excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                                    <div class="d-flex align-items-center flex-nowrap">
                                        <div class="post-cat-group flex-shrink-0">
                                            <?php
                                            $categories = get_the_category();
                                            if (!empty($categories)) {
                                                $cat_count = 0;
                                                foreach ($categories as $category) {
                                                    // Skip special categories
                                                    if ($category->slug === 'editors-pick' || $category->slug === 'featured' || $category->slug === 'entertainment') {
                                                        continue;
                                                    }
                                                    
                                                    if ($cat_count > 0) echo ', ';
                                                    echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="post-cat color-blue-three">' . esc_html($category->name) . '</a>';
                                                    $cat_count++;
                                                    if ($cat_count >= 2) break; // Limit to 2 categories for Entertainment
                                                }
                                            }
                                            ?>
                                        </div>
                                        <div class="post-time ms-3 flex-shrink-0">
                                            <i class="far fa-clock clock-icon"></i><?php echo meks_time_ago(); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="post-image-wrapper">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('large', array('class' => 'img-fluid img-border-radius', 'alt' => get_the_title())); ?>
                                    <?php else : ?>
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/new/hero.jpg" alt="<?php the_title_attribute(); ?>" class="img-fluid img-border-radius">
                                    <?php endif; ?>
                                    <?php
                                    // Get categories and find the first one that's not special categories
                                    $categories = get_the_category();
                                    $main_category = null;
                                    if (!empty($categories)) {
                                        foreach ($categories as $category) {
                                            if ($category->slug !== 'editors-pick' && $category->slug !== 'featured' && $category->slug !== 'entertainment') {
                                                $main_category = $category;
                                                break;
                                            }
                                        }
                                    }
                                    
                                    // Only show badge if we found a main category
                                    if ($main_category) :
                                    ?>
                                    <div class="post-cat-group badge-on-image">
                                        <a href="<?php echo esc_url(get_category_link($main_category->term_id)); ?>" class="post-cat cat-btn bg-primary-color"><?php echo esc_html($main_category->name); ?></a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </div>
                        <?php
                                endwhile;
                                wp_reset_postdata();
                            endif;
                        }
                        ?>
                        <?php
                        // Get 4 other posts from Entertainment category (excluding the first one)
                        if ($entertainment_category) {
                            $other_posts = new WP_Query(array(
                                'category_name' => 'entertainment',
                                'posts_per_page' => 4,
                                'offset' => 1, // Skip the first post (already shown in featured card)
                                'post_status' => 'publish'
                            ));

                            if ($other_posts->have_posts()) :
                                while ($other_posts->have_posts()) : $other_posts->the_post();
                        ?>
                        <a href="<?php the_permalink(); ?>" class="block-link">
                            <div class="media post-block small-block">
                                <div class="post-image-wrapper">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('medium', array('class' => 'img-fluid', 'alt' => get_the_title())); ?>
                                    <?php else : ?>
                                        <img class="img-fluid" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/new/hero.jpg" alt="<?php the_title_attribute(); ?>">
                                    <?php endif; ?>
                                    <?php echo get_video_play_button(); ?>
                                </div>
                                <div class="media-body">
                                    <h4 class="axil-post-title"><?php the_title(); ?></h4>
                                    <div class="d-flex align-items-center flex-nowrap">
                                        <div class="post-cat-group flex-shrink-0">
                                            <?php
                                            $categories = get_the_category();
                                            if (!empty($categories)) {
                                                $cat_count = 0;
                                                foreach ($categories as $category) {
                                                    // Skip special categories
                                                    if ($category->slug === 'editors-pick' || $category->slug === 'featured' || $category->slug === 'entertainment') {
                                                        continue;
                                                    }
                                                    
                                                    if ($cat_count > 0) echo ', ';
                                                    echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="post-cat color-blue-three">' . esc_html($category->name) . '</a>';
                                                    $cat_count++;
                                                    if ($cat_count >= 2) break; // Limit to 2 categories for smaller blocks
                                                }
                                            }
                                            ?>
                                        </div>
                                        <div class="post-time ms-3 flex-shrink-0">
                                            <i class="far fa-clock clock-icon"></i><?php echo meks_time_ago(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                                endwhile;
                                wp_reset_postdata();
                            endif;
                        }
                        ?>
    

    </main>
    <!-- End of .axil-content -->
    </div>
    <!-- End of .col-lg-4 -->
    <div class="col-lg-4">
        <aside class="post-sidebar medium-section">


            <div class="section-title m-b-xs-10">
                <a href="<?php echo get_safe_category_link('sports'); ?>" class="d-block">
                    <h2 class="axil-title">Sports</h2>
                </a>
            </div>

            <?php
            // Get the most recent post from Sports category
            $sports_category = get_category_by_slug('sports');
            if ($sports_category) {
                $sports_post = new WP_Query(array(
                    'category_name' => 'sports',
                    'posts_per_page' => 1,
                    'post_status' => 'publish'
                ));

                if ($sports_post->have_posts()) :
                    while ($sports_post->have_posts()) : $sports_post->the_post();
            ?>
            <div class="live-card">
                <a href="<?php the_permalink(); ?>" class="block-link">
                    <div class="flex-1">
                        <h3 class="featured-title"><?php the_title(); ?></h3>
                        <p class="excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                        <div class="d-flex align-items-center flex-nowrap">
                            <div class="post-cat-group flex-shrink-0">
                                <?php
                                $categories = get_the_category();
                                if (!empty($categories)) {
                                    $cat_count = 0;
                                    foreach ($categories as $category) {
                                        // Skip special categories
                                        if ($category->slug === 'editors-pick' || $category->slug === 'featured' || $category->slug === 'entertainment' || $category->slug === 'sports') {
                                            continue;
                                        }
                                        
                                        if ($cat_count > 0) echo ', ';
                                        echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="post-cat color-blue-three">' . esc_html($category->name) . '</a>';
                                        $cat_count++;
                                        if ($cat_count >= 2) break; // Limit to 2 categories for Sports
                                    }
                                }
                                ?>
                            </div>
                            <div class="post-time ms-3 flex-shrink-0">
                                <i class="far fa-clock clock-icon"></i><?php echo meks_time_ago(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="post-image-wrapper">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('large', array('class' => 'img-fluid img-border-radius', 'alt' => get_the_title())); ?>
                        <?php else : ?>
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/new/hero.jpg" alt="<?php the_title_attribute(); ?>" class="img-fluid img-border-radius">
                        <?php endif; ?>
                        <?php
                        // Get categories and find the first one that's not special categories
                        $categories = get_the_category();
                        $main_category = null;
                        if (!empty($categories)) {
                            foreach ($categories as $category) {
                                if ($category->slug !== 'editors-pick' && $category->slug !== 'featured' && $category->slug !== 'entertainment' && $category->slug !== 'sports') {
                                    $main_category = $category;
                                    break;
                                }
                            }
                        }
                        
                        // Only show badge if we found a main category
                        if ($main_category) :
                        ?>
                        <div class="post-cat-group badge-on-image">
                            <a href="<?php echo esc_url(get_category_link($main_category->term_id)); ?>" class="post-cat cat-btn bg-primary-color"><?php echo esc_html($main_category->name); ?></a>
                        </div>
                        <?php endif; ?>
                    </div>
                </a>
            </div>
            <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
            }
            ?>
            <?php
            // Get 4 other posts from Sports category (excluding the first one)
            if ($sports_category) {
                $other_posts = new WP_Query(array(
                    'category_name' => 'sports',
                    'posts_per_page' => 4,
                    'offset' => 1, // Skip the first post (already shown in featured card)
                    'post_status' => 'publish'
                ));

                if ($other_posts->have_posts()) :
                    while ($other_posts->have_posts()) : $other_posts->the_post();
            ?>
            <a href="<?php the_permalink(); ?>" class="block-link">
                <div class="media post-block small-block">
                    <div class="post-image-wrapper">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('medium', array('class' => 'img-fluid', 'alt' => get_the_title())); ?>
                        <?php else : ?>
                            <img class="img-fluid" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/new/hero.jpg" alt="<?php the_title_attribute(); ?>">
                        <?php endif; ?>
                        <?php echo get_video_play_button(); ?>
                    </div>
                    <div class="media-body">
                        <h4 class="axil-post-title"><?php the_title(); ?></h4>
                        <div class="d-flex align-items-center flex-nowrap">
                            <div class="post-cat-group flex-shrink-0">
                                <?php
                                $categories = get_the_category();
                                if (!empty($categories)) {
                                    $cat_count = 0;
                                    foreach ($categories as $category) {
                                        // Skip special categories
                                        if ($category->slug === 'editors-pick' || $category->slug === 'featured' || $category->slug === 'entertainment' || $category->slug === 'sports') {
                                            continue;
                                        }
                                        
                                        if ($cat_count > 0) echo ', ';
                                        echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="post-cat color-blue-three">' . esc_html($category->name) . '</a>';
                                        $cat_count++;
                                        if ($cat_count >= 2) break; // Limit to 2 categories for smaller blocks
                                    }
                                }
                                ?>
                            </div>
                            <div class="post-time ms-3 flex-shrink-0">
                                <i class="far fa-clock clock-icon"></i><?php echo meks_time_ago(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
            }
            ?>
    </aside>
    <!-- End of .post-sidebar -->
    </div>
    <!-- End of .col-lg-4 -->
    <div class="col-lg-4">
        <aside class="post-sidebar">
        <main class="axil-content big-section">
                <div class="advertisement-section m-b-xs-20">
                    <a href="#" class="d-block">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/new/advt.png" alt="Advertisement" class="img-fluid" class="advertisement-image">
                    </a>
                </div>
                <!-- End Advertisement Section -->




            </main>
            <main class="axil-content big-section">
                <div class="advertisement-section m-b-xs-20">
                    <a href="#" class="d-block">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/new/advt.png" alt="Advertisement" class="img-fluid" class="advertisement-image">
                    </a>
                </div>
                <!-- End Advertisement Section -->




            </main>
        </aside>
        <!-- End of .post-sidebar -->
    </div>
    <!-- End of .col-lg-4 -->
</div>
<!-- End of .row -->
</div>
<!-- End of .container -->
</div>
<!-- End of .random-posts -->
</section>
<!-- End of Entertainment and Sports Section -->

<!-- End of .related-post -->
<?php include 'parts/shared/footer.php'; ?>
<?php include 'parts/shared/html-footer.php'; ?>