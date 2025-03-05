<?php
/**
 * Template part for displaying page content in index.php
 */

?>

<style>
.content-main {
    padding: 40px;
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0px 0px 15px #bbbbbb;
}

.page-title {
    color: black;
    margin-bottom: 30px;
}

@media (min-width: 992px) {
    .content {
        /* width: 100%; */
        /* display: inline-flex; */
        /* align-items: flex-start; */
        /* flex-direction: row-reverse; */
        /* justify-content: space-around; */
        /* color: #ffffff; */
    }
    .content>p {
        /* margin-left: 5px; */
    }
}

.content figure {
    overflow: hidden; /* Обрезаем содержимое, которое выходит за границы блока */
    width: 100%; /* Жестко установит ширину изображений в 100% контейнера */
    height: auto; /* Автоматический расчет высоты, чтобы сохранить пропорции */
    display: block; /* Убеждаемся, что изображение не имеет отступов по бокам */
    margin: 20px auto 0 0; /* Выравниваем по центру, если необходимо */
    display: flex;
}

.content > p, .content strong, .content h1, .content h2, .content h3, .content h4, .content h5  {
    color: #000000;
    margin-bottom: 25px;
}

.content a {
    color: #2271B1;
    text-decoration: underline;
}

#breadcrumbs a, #breadcrumbs p, #breadcrumbs span, #breadcrumbs strong {
    color: #000000;
}

.nav-previous, .nav-next {
    display: flex;
    align-items: center;
    justify-content: center;
}

.nav-previous>a, .nav-next>a {
    display: flex;
    align-items: center;
    justify-content: center;
    background: #000000;
    margin-bottom: 10px;
    padding: 5px;
    border-radius: 30px;
    width: 100%;
}
</style>

<div class="container mt-5 mb-5 content-main">
    <?php 
    if ( function_exists('yoast_breadcrumb')) { 
      yoast_breadcrumb( '<p id="breadcrumbs">','</p>' ); 
    } 
    ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <?php if ( !is_front_page() && is_page()) { ?>
            <header>
                <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
            </header><!-- .entry-header -->

            <div class="content">
                <?php the_content(); ?>
            </div><!-- .entry-content -->
        <?php } ?>

        <?php if ( !is_front_page() && is_single()) { ?>
            <header>
                <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
            </header><!-- .entry-header -->

            <div class="content">
                <?php the_content(); ?>
            </div><!-- .entry-content -->

            <div class="navigation mt-3">
                <div class="nav-next">
                    <?php
                        $next_post = get_adjacent_post(false, '', false);
                        if ($next_post) {
                            $next_post_link = get_permalink($next_post);
                            echo '<a href="' . esc_url($next_post_link) . '" class="button-link">
                                    К следующей новости 
                                    <div><span class="material-symbols-outlined">arrow_forward</span></div>
                                </a>';
                        }
                    ?>
                </div>
                <div class="nav-previous">
                    <?php
                        $prev_post = get_adjacent_post(false, '', true);
                        if ($prev_post) {
                            $prev_post_link = get_permalink($prev_post);
                            echo '<a href="' . esc_url($prev_post_link) . '" class="button-link">
                                    <div><span class="material-symbols-outlined">arrow_back</span></div>
                                    К предыдущей новости
                                </a>';
                        }
                    ?>
                </div>
            </div>
        <?php } ?>
    </article><!-- #post-<?php the_ID(); ?> -->
</div>