<?php
add_action('wp_enqueue_scripts', 'add_scripts_and_styles');
add_theme_support('custom-logo');
add_theme_support('post-thumbnails');
add_theme_support('menus');

function add_scripts_and_styles()
{
    // Bootstrap скрипты
    wp_enqueue_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', array('jquery'), null, true);
    wp_enqueue_script('bootstrapminjs', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array('jquery'), null, true);
    
    wp_enqueue_script('jquery');
    wp_register_script(
        'jquery.bootstrap.min', 
        get_template_directory_uri() . '/assets/js/bootstrap.min.js', 
        'jquery'
    );
    wp_enqueue_script('jquery.bootstrap.min');

    // Bootstrap CSS
    wp_enqueue_style('bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
    wp_enqueue_style('main', get_stylesheet_uri());
}

// определение положений меню
register_nav_menus([
    'footer-crossline-links' => 'Бегущая полоса',
    'header-top-links' => 'Верхняя строка шапки',
    'header-bottom-links' => 'Нижняя строка шапки',
    'mobile-header-links' => 'Меню мобильной версии',
    'footer-bottom-links' => 'Нижнее меню подвала'
]);

// Добавляем поле для загрузки изображений в меню и чекбокс
function crossline_add_custom_nav_fields($item_id, $item, $depth, $args) {
    $image_url = get_post_meta($item_id, '_menu_item_image_url', true);
    $display_image = get_post_meta($item_id, '_menu_item_display_image', true);
    $show_label = get_post_meta($item_id, '_menu_item_show_label', true);
    ?>
    <p class="description description-wide">
        <label for="edit-menu-item-image-url-<?php echo $item_id; ?>">
            <?php _e('Image URL'); ?><br>
            <input type="text" id="edit-menu-item-image-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-custom" name="menu-item-image-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr($image_url); ?>" />
        </label>
    </p>
    <p class="description description-wide">
        <label for="edit-menu-item-display-image-<?php echo $item_id; ?>">
            <input type="checkbox" id="edit-menu-item-display-image-<?php echo $item_id; ?>" class="widefat code edit-menu-item-custom" name="menu-item-display-image[<?php echo $item_id; ?>]" <?php checked($display_image, 'on'); ?> />
            <?php _e('Показать изображение'); ?>
        </label>
    </p>
    <p class="description description-wide">
        <label for="edit-menu-item-show-label-<?php echo $item_id; ?>">
            <input type="checkbox" id="edit-menu-item-show-label-<?php echo $item_id; ?>" class="widefat code edit-menu-item-custom" name="menu-item-show-label[<?php echo $item_id; ?>]" <?php checked($show_label, 'on'); ?> />
            <?php _e('Показать ярлык навигации'); ?>
        </label>
    </p>
    <?php
}
add_action('wp_nav_menu_item_custom_fields', 'crossline_add_custom_nav_fields', 10, 4);

// Сохранение пользовательских полей
function crossline_update_custom_nav_fields($menu_id, $menu_item_db_id) {
    if (isset($_POST['menu-item-image-url'][$menu_item_db_id])) {
        $sanitized_data = sanitize_text_field($_POST['menu-item-image-url'][$menu_item_db_id]);
        update_post_meta($menu_item_db_id, '_menu_item_image_url', $sanitized_data);
    } else {
        delete_post_meta($menu_item_db_id, '_menu_item_image_url');
    }

    if (isset($_POST['menu-item-display-image'][$menu_item_db_id])) {
        update_post_meta($menu_item_db_id, '_menu_item_display_image', 'on');
    } else {
        delete_post_meta($menu_item_db_id, '_menu_item_display_image');
    }

    if (isset($_POST['menu-item-show-label'][$menu_item_db_id])) {
        update_post_meta($menu_item_db_id, '_menu_item_show_label', 'on');
    } else {
        delete_post_meta($menu_item_db_id, '_menu_item_show_label');
    }
}
add_action('wp_update_nav_menu_item', 'crossline_update_custom_nav_fields', 10, 2);


// Добавление данных в объект меню
function crossline_custom_nav_fields($menu_items) {
    foreach ($menu_items as $menu_item) {
        $menu_item->image_url = get_post_meta($menu_item->ID, '_menu_item_image_url', true);
        $menu_item->display_image = get_post_meta($menu_item->ID, '_menu_item_display_image', true);
        $menu_item->show_label = get_post_meta($menu_item->ID, '_menu_item_show_label', true);
    }
    return $menu_items;
}
add_filter('wp_get_nav_menu_items', 'crossline_custom_nav_fields');

// свой класс построения меню:
class My_Walker_Nav_Menu extends Walker_Nav_menu {

    function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
        global $wp_query;

        $item = $data_object;

        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' );

        $depth_classes = array(
            ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
            ( $depth >= 2 ? 'sub-sub-menu-item' : '' ),
            ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
            'menu-item-depth-' . $depth
        );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

        $output .= $indent . '<td id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )    ? ' target="' . esc_attr( $item->target  ) .'"' : '';
        $attributes .= ! empty( $item->xfn )       ? ' rel="'    . esc_attr( $item->xfn     ) .'"' : '';
        $attributes .= ! empty( $item->url )       ? ' href="'   . esc_attr( $item->url     ) .'"' : '';
        $attributes .= ' class="nav-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

        $image_url = ! empty( $item->image_url ) ? $item->image_url : '';
        $display_image = ! empty( $item->display_image ) ? $item->display_image : '';
        $show_label = ! empty( $item->show_label ) ? $item->show_label : '';

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before;

        if ($display_image && !empty($image_url)) {
            $item_output .= '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($item->title) . '" height="50px">';
        }

        if ($show_label) {
            $item_output .= $item->title;
        }

        $item_output .= $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= '</td>';
    }
}

?>
