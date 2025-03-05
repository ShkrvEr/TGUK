<?php
/**
 * The template for displaying 404 pages (not found)
 *
**/

get_header();
?>
<div class="container mt-5" style="height: 50vh">
	<header class="page-header alignwide">
		<h1 style="color: black" class="page-title"><?php esc_html_e( 'ОШИБКА 404' ); ?></h1>
	</header><!-- .page-header -->

	<div class="error-404 not-found default-max-width">
		<div class="page-content">
			<p style="color: black"><?php esc_html_e( 'Страница не существует или удалена' ); ?></p>
		</div><!-- .page-content -->
	</div><!-- .error-404 -->
</div>
<?php
get_footer();
