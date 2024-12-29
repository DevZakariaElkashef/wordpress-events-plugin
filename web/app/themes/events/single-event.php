<?php get_header(); ?>
<!-- Page content-->
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Event content-->
            <article>
                <!-- Event header-->
                <header class="mb-4">
                    <!-- Event title-->
                    <h1 class="fw-bolder mb-1"><?php the_title(); ?></h1>
                    <!-- Event meta content-->
                    <?php
                    $categories = get_the_terms(get_the_ID(), 'event_category');
                    if ($categories) {
                        foreach ($categories as $category) {
                            echo '<a class="badge bg-secondary text-decoration-none link-light" href="' . esc_url(get_term_link($category)) . '">' . esc_html($category->name) . '</a>';
                        }
                    }
                    ?>
                </header>
                <!-- Event image (if available)-->
                <figure class="mb-4">
                    <img class="img-fluid rounded" src="<?php echo esc_url(wp_get_attachment_url(get_post_meta(get_the_ID(), 'event_image', true))); ?>" alt="Event Image" />
                </figure>
                <!-- Event content-->
                <section class="mb-5">
                    <?= get_post_meta(get_the_ID(), 'event_description', true); ?>
                </section>

                <!-- Event custom fields (example for event date and location) -->
                <section class="mb-5">
                    <?php
                    $event_date = get_post_meta(get_the_ID(), 'event_date', true);
                    ?>
                    <?php if ($event_date) : ?>
                        <p><strong>Event Date:</strong> <?php echo date('Y-m-d', strtotime(esc_html($event_date))); ?></p>
                    <?php endif; ?>
                </section>
            </article>
        </div>
        <!-- Side widgets-->
        <?php require_once 'sidebar.php'; ?>
    </div>
</div>
<?php get_footer(); ?>