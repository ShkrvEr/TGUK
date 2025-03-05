<?php get_header(); ?>

<style>

.content-main {
	padding: 15px;
	background: #ffffff;
	border-radius: 5px;

    box-shadow: 0px 0px 15px 0px #000000;
    border: 3px solid #0312a8;
}

.page-title {
	color: black;
}

.blog-category {
	background: #0312a8;
	margin: 3px;
	padding: 0px 10px 3px 10px;
	border-radius: 10px;
}

.blog-category>a {
	color: #ffffff;
}

.img_prev {
	padding: 0;
	border-radius: 5px;
}

.avatar {
    border-radius: 50%; /* 50% скругляет границы, круглый аватар  */
    overflow: hidden; /* обрезает изображение за границами окружности */
}

.material-symbols-outlined {
    font-size: 14px; 
    line-height: 0; 
}

.pagination-container {
    text-align: center;
    margin: 20px 0;
}

.pagination {
    display: inline-block;
    background: #fff;
    padding: 10px;
}

.pagination a, .pagination span {
    display: inline-block;
    padding: 10px 15px;
    margin: 0 2px;
    border: 1px solid #ddd;
    color: #333;
    text-decoration: none;
    border-radius: 5px;
}

.pagination a:hover {
    background-color: #707cfa;
    border-color: #ccc;
    color: #fff;
}

.pagination .current {
    background-color: #0312a8;
    color: #fff;
    border-color: #333;
}

.entry-content a, .entry-content p {
    color: #000000;
}
.entry-content a:hover{
    color: #8b8b8b;
}

@media only screen and (max-width: 425px) {
    .post-title {
        /*font-size: 1rem;*/
        font-size: 10px;
    }
    .post-content {
        /*font-size: 1rem;*/
        font-size: 10px;
    }
    .auth {
        font-size: 10px;
    }
    .avatar {
        height: 10px !important;
        width: 10px !important;
    }
    .material-symbols-outlined {
        font-size: 10px !important;
    }
    .bs-blog-date {
        font-size: 10px !important;
    }
    .entry-content h2 {
        font-size: 10px !important;
    }
}

</style>

<div class="container mt-5 mb-5 content-main">
    <h2 style="color:#000000;">Результаты поиска по запросу "<?php echo esc_html(get_search_query()); ?>"</h2>
</div>

<?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
        <div class="container mt-5 mb-5 content-main">
            <div class="row ml-1 mr-1">
                <div class="col-6 img_prev">
                    <a href="<?php the_permalink(); ?>">
                        <?php
                        if ( has_post_thumbnail() ) {
                            the_post_thumbnail( 'full', array(
                                'class' => 'img-fluid',
                                'style' => 'width: 100%; height: 100%; object-fit: cover; object-position: top center;'
                            ) );
                        } else {
                            echo '<img src="' . get_template_directory_uri() . '/assets/img/plug.png" alt="Placeholder" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover; object-position: top center;">';
                        }
    ?>
                    </a>
                </div>
                <article class="entry-content col-6">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    
                    
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
    <?php endwhile; ?>
        

    <!-- Пагинация -->
    <div class="pagination-container">
        <div class="pagination">
            <?php echo paginate_links(); ?>
        </div>
    </div>
<?php else : ?>
    <div class="container mt-5 mb-5 content-main">
        <p><?php _e( 'Извините, ничего не найдено.' ); ?></p>
    </div>
<?php endif; ?>

<?php get_footer(); ?>
