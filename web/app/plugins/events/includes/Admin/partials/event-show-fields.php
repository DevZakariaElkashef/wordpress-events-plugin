<?php
    $option = get_option('items_per_page', 10);
?>
<input type="number" id="items_per_page" name="items_per_page" value="<?php echo esc_attr($option); ?>" min="1" />
<label for="items_per_page"><?php echo esc_html__('Enter the number of events to display per page.', 'events'); ?></label>