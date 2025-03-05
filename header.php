<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

	<title>ГАПОУ ТГЮК</title>
	<?php wp_head();?>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark">
		<div class="navbar-header d-flex justify-content-center justify-content-lg-end mx-auto">
			<div class="navbar-brand">
				<a href="<?=get_home_url();?>">
					<?php the_custom_logo(); //Установка кастомного лого ?>
				</a>
			</div>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
		</div>
		<div class="collapse navbar-collapse header" id="navbarContent">
			<table class="d-none d-lg-table">
				<tr>
					<td>
						<h3 class="text-center">ГАПОУ Туймазинский государственный юридический колледж</h3>
					</td>
				</tr>
			</table>

			<?php if (has_nav_menu('header-top-links')) : ?>
				<table class="d-none d-lg-table">
					<tr>
						<?php 
							wp_nav_menu([
								'theme_location' => 'header-top-links',
								'walker' => new My_Walker_Nav_Menu(),
								'container' => false, // убирает <div> контейнер вокруг меню
								'items_wrap' => '%3$s' // убирает <ul> контейнер вокруг элементов меню
							]);
						?>
						<td>
						    <a href="#" class="bvi-open">Версия сайта для слабовидящих</a>
						</td>
					</tr>
				</table>
			<?php endif; ?>

			<?php if (has_nav_menu('header-bottom-links')) : ?>
				<table class="d-none d-lg-table">
					<tr>
						<?php 
							wp_nav_menu([
								'theme_location' => 'header-bottom-links',
								'walker' => new My_Walker_Nav_Menu(),
								'container' => false, // убирает <div> контейнер вокруг меню
								'items_wrap' => '%3$s' // убирает <ul> контейнер вокруг элементов меню
							]);
						?>
						<td>
    						<form role="search" method="get" class="d-flex my-2 mx-2" style="width:100%;" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <input type="search" placeholder="Поиск" class="form-control mr-2" name="s" value="<?php echo get_search_query(); ?>">
                                <input type="hidden" name="post_type" value="post"> <!-- Добавляем скрытое поле, чтобы исключить страницы из результатов -->
                                <button class="btn btn-outline-success" type="submit">Поиск</button>
                            </form>
        				</td>
					</tr>
				</table>
			<?php endif; ?>

			<!-- Гамбургер -->
			<ul class="navbar-nav d-lg-none ms-2 m-3">
				<form role="search" method="get" class="d-flex my-2 mx-2" style="width:100%;" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="search" placeholder="Поиск" class="form-control mr-2" name="s" value="<?php echo get_search_query(); ?>">
                    <input type="hidden" name="post_type" value="post"> <!-- Добавляем скрытое поле, чтобы исключить страницы из результатов -->
                    <button class="btn btn-outline-success" type="submit">Поиск</button>
                </form>
			    <?php 
					wp_nav_menu([
						'theme_location' => 'mobile-header-links',
						'walker' => new My_Walker_Nav_Menu(),
						'container' => false, // убирает <div> контейнер вокруг меню
						'items_wrap' => '%3$s' // убирает <ul> контейнер вокруг элементов меню
					]);
				?>	
			</ul>
		</div>
	</nav>
	
	<div class="container-fluid prefooter marquee" style="height: 110px; background-color: #707cfa; display:flex; align-items: center;">
	<marquee style:"display:flex;">
		<?php 
			wp_nav_menu( [
                'theme_location' => 'footer-crossline-links',
                'walker' => new My_Walker_Nav_Menu(),
                'items_wrap' => '%3$s', // Это удалит <ul> контейнер вокруг элементов меню
                'container_class' => 'content' // Добавляет класс "content" к контейнеру меню
            ]);
		?>
	</marquee>
</div>

	<script>
	    //скрипт открытия меню на мобильных устройствах (bootstrap5)
		$(document).ready(function () {
			$('.navbar-toggler').click(function () {
				$('.collapse').toggleClass('show');
			});
		});
	</script>
</body>
</html>
