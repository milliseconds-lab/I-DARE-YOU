<?php
$ajax_url = esc_js( admin_url( 'admin-ajax.php' ) );
?>
<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>I DARE YOU</title>
    <script type="text/javascript">
        const AJAX_URL = "<?php echo $ajax_url; ?>";
    </script>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<nav id="global-navigation" role="navigation">
    <h1>I DARE YOU</h1>
	<?php
	wp_nav_menu( array(
		'theme_location'  => 'gn_menu',
		'container_id'    => 'gn-menu',
		'container_class' => 'gn-menu',
		'items_wrap'      => '<ul>%3$s</ul>',
		'link_before'     => '',
		'depth'           => 1,
		'fallback_cb'     => false
	) );
	?>
</nav>