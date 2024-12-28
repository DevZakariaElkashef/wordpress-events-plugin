<div class="wrap">
    <h1><?php echo esc_html__('Event Options', 'events'); ?></h1>
    <form method="post" action="options.php">
        <?php
        settings_fields('event_options');
        do_settings_sections('event-options');
        submit_button();
        ?>
    </form>
</div>