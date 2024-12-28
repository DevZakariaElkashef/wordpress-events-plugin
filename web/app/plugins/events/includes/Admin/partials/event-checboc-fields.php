<?php
    $option = get_option('show_past_events', 0);
?>
<input type="checkbox" id="show_past_events" name="show_past_events" value="1" <?php checked(1, $option); ?> />
<label for="show_past_events"><?php echo esc_html__('Check to show past events.', 'events'); ?></label>