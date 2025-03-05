<style>

.prefooter a{
	margin-right: 30px;
}

.marquee {
  position: relative;
  width: 100vw;
  max-width: 100%;
  height: 200px;
  overflow-x: hidden;
}
.content a {
    display: inline-block; /* Располагаем элементы в строку */
    margin-right: 30px; /* Задаем отступ между элементами */
}

@keyframes marquee {
  from { transform: translateX(0); }
  to { transform: translateX(-50%); }
}

</style>

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

<div class="row footer-content-row">
	<div class="col-md footer-content-col">
		<div class="docs d-flex justify-content-center">
			<p>КОНТАКТЫ</p>
		</div>
		<div class="d-flex flex-column text-center">
			<p>Электронная почта №1: tguk@rambler.ru</p>
			<p>Электронная почта №2: gapou.tguk@yandex.ru</p>
		</div>
	</div>
	<div class="col-md footer-content-col">
		<div class="docs d-flex justify-content-center">
			<p>СВЯЗЬ</p>
		</div>
		<div class="d-flex flex-column text-center">
			<p>Директор: (34782) 5-78-31</p>
			<p>Заместитель директора по учебной части: (34782) 5-77-98</p>
			<p>Заместитель директора по воспитательной работе: (34782) 5-80-86</p>
			<p>Заведующий отделением: (34782) 5-78-51</p>
			<p>Бухгалтерия (тел/факс): (34782) 5-78-15</p>
			<p>Специалист по кадрам: (34782)5-79-20</p>
			<p>Общежитие: (34782) 7-82-84</p>
			<p>Вахта: (34782) 5-78-37</p>
		</div>
	</div>
	<div class="col-md footer-content-col" style="padding: 10px;">
		<div class="docs d-flex justify-content-center">
			<p>НАШИ СОЦИАЛЬНЫЕ СЕТИ</p>
		</div>
		<div class="d-flex flex-column text-center" style="border-bottom: 1px solid #ffffff; padding: 10px;">
			<div class="row">
				<div class="col text-right"><a href="https://vk.com/gapoutguk"><img src="<?=get_home_url();?>/wp-content/themes/ГАПОУ ТГЮК ild/assets/img/vk-ico.png" alt="" width="30px" height="30px"></a></div>
				<div class="col"><a href=""><img src="<?=get_home_url();?>/wp-content/themes/ГАПОУ ТГЮК ild/assets/img/tg-ico.png" alt="" width="30px" height="30px"></a></div>
				<div class="col text-left"><a href=""><img src="<?=get_home_url();?>/wp-content/themes/ГАПОУ ТГЮК ild/assets/img/ok-ico.png" alt="" width="30px" height="30px"></a></div>
			</div>
		</div>
		<div class="d-flex flex-column text-center" style="padding: 10px;">
			<a href="http://2024.тгюк.рф/%d0%b3%d0%bb%d0%b0%d0%b2%d0%bd%d0%b0%d1%8f/%d1%82%d0%b5%d0%bb%d0%b5%d1%84%d0%be%d0%bd-%d0%bf%d0%be%d0%b4%d0%b4%d0%b5%d1%80%d0%b6%d0%ba%d0%b8/">ТЕЛЕФОН ДОВЕРИЯ</a>
		</div>
		
		<div class="d-flex flex-column text-center vstrsnln-block" style="padding: 10px;">
			<?php echo do_shortcode('[vstrsnln_info]'); ?>
		</div>
	</div>
</div>

<nav class="navbar justify-content-evenly" style="background: #0b4b5a; padding: 10px;">
	<p>Россия, республика Башкортостан, 452750, г. Туймазы, Мкр-н Молодежный, 14</p>
	
	<?php 
		wp_nav_menu( [
            'theme_location' => 'footer-bottom-links',
            'walker' => new My_Walker_Nav_Menu(),
            'items_wrap' => '%3$s', // Это удалит <ul> контейнер вокруг элементов меню
            'container_class' => 'content' // Добавляет класс "content" к контейнеру меню
        ]);
	?>
	<!--
	<a href="<?= get_home_url(); ?>">Главная</a>
	<a href="<?=get_home_url();?>/основные-сведения-3">О колледже</a>
	<a href="<?=get_home_url();?>/наши-достижения">Наши достижения</a>
	<a href="<?=get_home_url();?>/основные-сведения-3">Контакты</a>
	-->
</nav>

<?php wp_footer(); ?>
</body>
</html>