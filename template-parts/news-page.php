<?php get_header(); ?>

<div class="container mt-5 mb-5 content-main">
	<article style="color: black;" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php if ( !is_front_page() && is_home()) { ?>
			<header>
				<h1 class="page-title"><?php single_post_title(); ?></h1>
			</header><!-- .entry-header -->
		<?php } ?>

	</article><!-- #post-<?php the_ID(); ?> -->
</div>

<?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Получаем текущую страницу
    $custom_query = new WP_Query(array(
        'posts_per_page' => 10, // Количество записей на страницу
        'paged' => $paged // Передаем текущую страницу в запрос
    ));
    
    if ($custom_query->have_posts()) :
        while ($custom_query->have_posts()) :
            $custom_query->the_post();
            ?>
            <div class="container mt-5 mb-5 content-main">
                <div class="row ml-1 mr-1">
                    <div class="col-6 img_prev" style="background-color:#333;">
                        <a href="<?php the_permalink(); ?>">
                            <?php
                            if (has_post_thumbnail()) {
                                // Вывод миниатюры поста (обрезка сверху)
                                the_post_thumbnail('full', array(
                                    'class' => 'img-fluid', 
                                    'style' => 'width: 100%; height: 100%; object-fit: cover; object-position: top center;'
                                ));
                            } else {
                                // Вывод заглушки, если нет изображения
                                echo '<img src="' . get_template_directory_uri() . '/assets/img/plug.png" alt="Placeholder" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover; object-position: top center;">';
                            }
                            ?>
                        </a>
                    </div>
                    <article class="entry-content col-6">
                        <?php 
                        $categories = get_the_category();
                        if ($categories) {
                            foreach ($categories as $category) {
                                echo 
                                '<span class="blog-category">
                                    <a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a> 
                                </span>';
                            }
                        } 
                        ?>
                        <h4 class="post-title mt-2" style=""><a style="color: black;" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        <div class="bs-blog-meta mt-2">
                            <span class="bs-author">
                                <a style="color: black;" class="auth" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                    <?php echo get_avatar(get_the_author_meta('user_email'), 20, '', '', array('class' => 'avatar', 'height' => '20', 'width' => '20', 'decoding' => 'async')); ?>
                                    <?php echo esc_html(get_the_author()); ?>
                                </a>
                            </span>
                            <span class="bs-blog-date">
                                <span class="material-symbols-outlined">schedule</span>
                                <a style="color: black;" href="<?php echo esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))); ?>">
                                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('d.m.Y')); ?></time>
                                </a>
                            </span>
                        </div>
                        
                        <!-- Вывод описания в зависимости от разрешения -->
                        <div class="post-content">
                            <p class="mt-2 content-short" style="color: black; display: none;">
                                <?php echo wp_trim_words(get_the_content(), 10, '...'); ?>
                            </p>
                            <p class="mt-3 content-long" style="color: black; display: none;">
                                <?php echo wp_trim_words(get_the_content(), 30, '...'); ?>
                            </p>
                        </div>
                        
                        <script>
                            // скрипт изменения длины описания в зависимости от разрешения
                            function updateContent() {
                                const shortContents = document.querySelectorAll('.content-short');
                                const longContents = document.querySelectorAll('.content-long');
                        
                                shortContents.forEach((shortContent, index) => {
                                    const longContent = longContents[index];
                        
                                    if (window.innerWidth < 768) {
                                        shortContent.style.display = 'block';
                                        longContent.style.display = 'none';
                                    } else {
                                        shortContent.style.display = 'none';
                                        longContent.style.display = 'block';
                                    }
                                });
                            }
                        
                            window.addEventListener('resize', updateContent);
                            window.addEventListener('load', updateContent);
                        </script>
                    </article>
                </div>
            </div>
            <?php
        endwhile;
        
        // Пагинация
        $pagination_args = array(
            'total' => $custom_query->max_num_pages,
            'current' => $paged,
            'mid_size' => 2,
            'prev_text' => __('« Назад'),
            'next_text' => __('Вперед »'),
        );
        echo '<div class="pagination-container"><div class="pagination">' . paginate_links($pagination_args) . '</div></div>';
        
        wp_reset_postdata();
    else :
?>
    <p><?php _e('Извините, ничего не найдено.'); ?></p>
    <?php
endif;
?>


<?php get_footer(); ?>