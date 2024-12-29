<?php
$categoriesArgs = [
    'taxonomy'   => 'event_category',
    'orderby'    => 'count',
    'order'      => 'DESC',
    'hide_empty' => true,
];

$categories = get_terms($categoriesArgs);

?>
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