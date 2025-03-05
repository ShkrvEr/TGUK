    <div class="container-fluid my-5">
		<div class="row justify-content-center">
			<?php
				$content = get_the_content();
				if (has_block('video', $content)) {
					echo '<div style="max-width: 600px; max-height: 315px; margin: 0 auto;">';
					echo apply_filters('the_content', $content);
					echo '</div>';
				} else {
					echo 'Видео не найдено.';
				}
			?>
		</div>
	</div>

	
	<div class="page-slide d-none d-lg-block">
		<div class="menu-block">
			<div class="uni-block left wow slideInLeft animated" style="visibility: visible; animation-name: slideInLeft;">
				<div class="block-tape-left"><a href="<?= get_home_url(); ?>/абитуриенту"><p style="margin: 12px;">абитуриенту</p></a></div>
				<ul class="block-list">
					<?php 
					$loop = CFS()->get('applicant');
					foreach($loop as $row)
					{
						?>
						<li><?= $row['applicant_link'] ?></li>
						<?php
					}
					?>
				</ul>
			</div>
			<div class="center-block center wow slideInDown animated" style="visibility: visible; animation-name: slideInDown;">
				<div class="block-tape-center"><a href="<?= get_home_url(); ?>/студенту"><p>студенту</p></a></div>
				<ul class="block-list" id="nav_list_second">
					<?php 
					$loop = CFS()->get('student');
					foreach($loop as $row)
					{
						?>
						<li><?= $row['student_link'] ?></li>
						<?php
					}
					?>
				</ul>				
			</div>
			<div class="uni-block right wow slideInRight animated" style="visibility: visible; animation-name: slideInRight;">
				<div class="block-tape-right"><a href="<?= get_home_url(); ?>/выпускнику"><p style="margin: 12px;">выпускнику</p></a></div>
				<ul class="block-list" id="nav_list_second">
					<?php 
					$loop = CFS()->get('graduate');
					foreach($loop as $row)
					{
						?>
						<li><?= $row['graduate_link'] ?></li>
						<?php
					}
					?>						
				</ul>					
			</div>
		</div>
	</div>
	<div class="page-slide d-none d-lg-block">
		<div class="menu-block">
			<div class="uni-block left wow slideInLeft animated" style="visibility: visible; animation-name: slideInLeft;">
				<div class="block-tape-left"><a href="<?= get_home_url(); ?>/родителям"><p style="margin: 12px;">родителям</p></a></div>
				<ul class="block-list">
					<?php 
					$loop = CFS()->get('parent');
					foreach($loop as $row)
					{
						?>
						<li><?= $row['parent_link'] ?></li>
						<?php
					}
					?>
				</ul>
			</div>
			<div class="center-block center wow slideInDown animated" style="visibility: visible; animation-name: slideInDown;">
				<div class="block-tape-center"><a href="<?= get_home_url(); ?>/преподавателям"><p>преподавателям</p></a></div>
				<ul class="block-list" id="nav_list_second">
					<?php 
					$loop = CFS()->get('teacher');
					foreach($loop as $row)
					{
						?>
						<li><?= $row['teacher_link'] ?></li>
						<?php
					}
					?>
				</ul>				
			</div>
			<div class="uni-block right wow slideInRight animated" style="visibility: visible; animation-name: slideInRight;">
				<div class="block-tape-right"><a href="<?= get_home_url(); ?>/кураторам"><p style="margin: 12px;">кураторам</p></a></div>
				<ul class="block-list" id="nav_list_second">
					<?php 
					$loop = CFS()->get('curator');
					foreach($loop as $row)
					{
						?>
						<li><?= $row['curator_link'] ?></li>
						<?php
					}
					?>
				</ul>					
			</div>
		</div>
	</div>


	<br>
    <div class="news-header">
        <a href="http://2024.xn--c1aow3c.xn--p1ai/%D0%BD%D0%BE%D0%B2%D0%BE%D1%81%D1%82%D0%B8/"><p>НОВОСТНАЯ ЛЕНТА</p></a>
    </div>
    
    
    <!-- новостные карточки -->
    <div class="news row news-content-row justify-content-center">
        <?php
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 9, // Количество записей для вывода
            );
    
            $query = new WP_Query($args);
    
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    // Получаем содержимое записи
                    $content = get_the_content();
        ?>
        
        <div class="col-xl-4 col-lg-6 col-md-8 col-sm-12 mb-4">
            <div class="card" style="width: 100%; height:100%">
                <?php
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('full', array('class' => 'card-img-top', 'style' => 'width: 100%; height: 250px; object-fit: cover; object-position: center center;'));
                    } else {
                        // Вывод заглушки, если нет изображения
                        echo '<img style="width: 100%; height: 250px; object-fit: cover; object-position: center center;" src="' . get_template_directory_uri() . '/assets/img/plug.png" alt="Placeholder" class="img-fluid"> ';
                    }
                ?>
                <div class="card-body">
                    <h5 class="card-title text-truncate-2" style="color:black;"><?php echo wp_strip_all_tags(get_the_title()); ?></h5>
                    <p class="card-text mb-1 text-truncate-3" style="color:black;"><?php echo wp_strip_all_tags(get_the_content()); ?></p>
                </div>
                <a href="<?php the_permalink(); ?>" class="btn btn-primary read-btn">Читать</a>
            </div>
        </div>

        <style>
            .card {
                box-shadow: 0px 0px 1px 0px #000000;
            }
            .text-truncate-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2; /* Ограничение заголовка двумя строками */
                -webkit-box-orient: vertical;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            .text-truncate-3 {
                display: -webkit-box;
                -webkit-line-clamp: 3; /* Ограничение текста тремя строками */
                -webkit-box-orient: vertical;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            .read-btn:hover {
                background-color: #0312a8;
            }
        </style>
        
        <!--
        <div class="col-xl-4 col-lg-4 col-sm-12 news-content-col">
            <a href="<?php the_permalink(); ?>" style="font-size: 2vh;">
                <div class="img-container">
                    <?php
                        if (has_post_thumbnail()) {
                            the_post_thumbnail('full', array('class' => 'img-fluid', 'style' => 'width: 100%; height: 250px; object-fit: cover; object-position: center center;'));
                        } else {
                            // Вывод заглушки, если нет изображения
                            echo '<img src="' . get_template_directory_uri() . '/assets/img/plug.png" alt="Placeholder" class="img-fluid">';
                        }
                    ?>
                </div>
                <p><strong><?php the_title(); ?></strong></p>
                <p><?php echo wp_trim_words(get_the_content(), 10, '...'); ?></p>
            </a>
        </div>
        
        <style>
            .news-content-col {
                position: relative;
            }
        
            .img-container {
                width: 100%;
                height: 250px;
                overflow: hidden; /* Скрывает часть изображения, выходящую за пределы контейнера */
            }
        
            .img-fluid {
                transition: transform 0.5s ease;
                width: 100%;
                height: 100%;
                object-fit: cover;
                object-position: center center;
            }
        
            .news-content-col:hover .img-fluid {
                transform: scale(1.25);
            }
        </style>-->
        
        <?php
            endwhile;
            wp_reset_postdata();
            else : echo 'Записей не найдено.';
            endif;
        ?>
    </div>
    <br>