<?php

$args = array(
    'post_type'      => 'event',
    'posts_per_page' => get_option('items_per_page'),
    'orderby'        => 'date',
    'order'          => 'DESC',
    'meta_query'     => array(
        'relation' => 'AND',
    ),
);


$show_past_events = get_option('show_past_events', false);

if (!$show_past_events) {
    $args['meta_query'][] = array(
        'key'     => 'event_date',
        'value'   => date('Ymd'),
        'compare' => '>=',
        'type'    => 'DATETIME',
    );
}

$events_query = new WP_Query($args);


$categoriesArgs = [
    'taxonomy'   => 'event_category',
    'orderby'    => 'count',
    'order'      => 'DESC',
    'hide_empty' => true,
];

$categories = get_terms($categoriesArgs);

?>
<?php get_header() ?>
<!-- Page header with logo and tagline-->
<header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder">Welcome to Blog Home!</h1>
            <p class="lead mb-0">A Bootstrap 5 starter layout for your next blog homepage</p>
        </div>
    </div>
</header>
<!-- Page content-->
<div class="container">
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-8">
            <!-- Nested row for non-featured blog posts-->
            <?php if ($events_query->have_posts()): ?>
                <div class="row" id="eventsResults">
                    <?php while ($events_query->have_posts()): $events_query->the_post(); ?>
                        <div class="col-lg-6">
                            <!-- Blog post -->
                            <div class="card mb-4">
                                <a href="<?php the_permalink(); ?>">
                                    <img class="card-img-top"
                                        src="<?php echo esc_url(wp_get_attachment_url(get_post_meta(get_the_ID(), 'event_image', true))); ?>"
                                        alt="<?php the_title(); ?>" />
                                </a>
                                <div class="card-body">
                                    <div class="small text-muted"><?= date('Y-m-d', strtotime(get_post_meta(get_the_ID(), 'event_date', true))); ?></div>
                                    <h2 class="card-title h4"><?php the_title(); ?></h2>
                                    <p class="card-text"><?= get_post_meta(get_the_ID(), 'event_description', true); ?></p>
                                    <a class="btn btn-primary" href="<?php the_permalink(); ?>">Read more →</a>
                                </div>
                            </div>
                            <!-- Blog post -->
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p class="text-center">No Events Yet!!</p>
            <?php endif; ?>

            <!-- Pagination-->
            <!-- <nav aria-label="Pagination">
                <hr class="my-0" />
                <ul class="pagination justify-content-center my-4">
                    <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Newer</a></li>
                    <li class="page-item active" aria-current="page"><a class="page-link" href="#!">1</a></li>
                    <li class="page-item"><a class="page-link" href="#!">2</a></li>
                    <li class="page-item"><a class="page-link" href="#!">3</a></li>
                    <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
                    <li class="page-item"><a class="page-link" href="#!">15</a></li>
                    <li class="page-item"><a class="page-link" href="#!">Older</a></li>
                </ul>
            </nav> -->
        </div>
        <!-- Side widgets-->
        <div class="col-lg-4">
            <!-- Search widget-->
            <div class="card mb-4">
                <div class="card-header">Search</div>
                <div class="card-body">
                    <div class="input-group">
                        <input id="searchInput" class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                    </div>
                </div>
            </div>
            <!-- Categories widget-->
            <div class="card mb-4">
                <div class="card-header">Categories</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="list-unstyled mb-0">
                                <?php if (!empty($categories) && !is_wp_error($categories)) : ?>
                                    <?php foreach ($categories as $category): ?>
                                        <li><a href="<?= esc_url(get_term_link($category)) ?>"><?= esc_html($category->name) ?></a></li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Side widget-->
            <!-- <div class="card mb-4">
                <div class="card-header">Side Widget</div>
                <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
            </div> -->
        </div>
    </div>
</div>

<?php get_footer() ?>