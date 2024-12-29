<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php wp_title('|', true, 'right'); ?></title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->

    <?php wp_head(); ?>
</head>

<body>

    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#"><?= __('Events', 'events') ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php
                        wp_nav_menu(array(
                            'theme_location' => 'main_menu'
                        ));
                    ?>
                    <?php if (!is_user_logged_in()): ?>
                        <li class="nav-item"><a class="nav-link" href="<?= wp_login_url() ?>">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= wp_registration_url() ?>">Register</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="<?= wp_logout_url() ?>">Logout</a></li>
                    <?php endif; ?>
                </ul>



            </div>
        </div>
    </nav>