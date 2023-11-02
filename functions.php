<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 */


// Constants
define('THEME_VERSION', '1.0.0');

add_action('wp_enqueue_scripts', function () {
    // wp_enqueue_style('main-style', get_stylesheet_uri(), array(), THEME_VERSION);
    wp_enqueue_script('jquery');
    wp_enqueue_script('main-script', get_template_directory_uri() . '/main.js', array('jquery'), THEME_VERSION, true);
});


//Remove Gutemberg
add_filter('use_block_editor_for_post_type', '__return_false', 10);
// Don't load Gutenberg-related stylesheets.
add_action('wp_enqueue_scripts', function () {
    wp_dequeue_style('wp-block-library'); // Wordpress core
    wp_dequeue_style('wp-block-library-theme'); // Wordpress core
    wp_dequeue_style('wc-block-style'); // WooCommerce
    wp_dequeue_style('storefront-gutenberg-blocks'); // Storefront theme
}, 100);

// Remove JQuery Migrate from frontend

//Remove jQuery Migrate 

add_action('wp_enqueue_scripts', function () {
    if (!is_admin()) {
        wp_deregister_script('jquery-migrate');
        wp_deregister_script( 'wp-embed' );
    }
}, 11);

// Remove Emoji
add_action('init', function () {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
});

add_action('init', function () {
    register_nav_menus(
        array(
            'unicornio_main_menu' => __('Unicórnio Main Menu'),
            'unicornio_footer_menu' => __('Unicórnio Footer Menu'),
            'unicornio_footer_s_menu' => __('Unicórnio Footer Social Menu'),
        )
    );
});

// Adicionar meta box
// Função para adicionar o meta box
function add_subtitle_meta_box() {
    add_meta_box(
        'subtitle_meta_box', // ID do meta box
        'Subtitle', // Título
        'show_subtitle_meta_box', // Callback para renderizar o HTML
        'post', // Tipo de post
        'normal', // Contexto
        'high' // Prioridade
    );
}
add_action('add_meta_boxes', 'add_subtitle_meta_box');

// HTML para o meta box
function show_subtitle_meta_box($post) {
    // Recuperar o valor existente
    $td_post_theme_settings = get_post_meta($post->ID, 'td_post_theme_settings', true);
    $td_subtitle = isset($td_post_theme_settings['td_subtitle']) ? $td_post_theme_settings['td_subtitle'] : '';

    // Campo de texto
    echo '<label for="td_subtitle">Subtitle:</label>';
    echo '<input type="text" id="td_subtitle" name="td_subtitle" value="'. esc_attr($td_subtitle) .'" style="width:100%;" />';
}

// Função para salvar os dados
// Função para salvar os dados
function save_subtitle_meta_box($post_id) {
        if (!isset($_POST['td_subtitle']) || empty($_POST['td_subtitle'])) {
            return;
        }
    
        $td_post_theme_settings = get_post_meta($post_id, 'td_post_theme_settings', true);
    
        if (!is_array($td_post_theme_settings)) {
            $td_post_theme_settings = array();
        }
         $new_subtitle = sanitize_text_field($_POST['td_subtitle']);
    
        if (isset($td_post_theme_settings['td_subtitle']) && $td_post_theme_settings['td_subtitle'] === $new_subtitle) {
            return;
        }

        // Atualizar 'td_subtitle'
        $td_post_theme_settings['td_subtitle'] = $new_subtitle;
    
        // Salvar a meta box
        update_post_meta($post_id, 'td_post_theme_settings', $td_post_theme_settings);
}

add_action('save_post', 'save_subtitle_meta_box');

// Utility functions
function get_critical_css($file_name) {
    echo '<style>';
    $css_file_path = get_template_directory() . '/assets/critical/' . $file_name;
    if (file_exists($css_file_path)) {
        echo file_get_contents($css_file_path);
    }
    echo '</style>';
}

// Lazy Load Iframe

add_filter('the_content', function($content) {
    $content = preg_replace('/<iframe\s/', '<iframe loading="lazy" width="100%" height="100%" style="border:0;" ', $content);
    return $content;
});

// Thumbnails sizes
add_action('after_setup_theme', function () {
    add_theme_support( 'post-thumbnails' );
    add_image_size('featured-banner', 900, 500, true);
    add_image_size('large-banner', 820, 560, true);
    add_image_size('medium-banner', 560, 275, true);
    add_image_size('small-banner', 264, 264, true);
    add_image_size('featured-banner-category', 264, 264, true);
    add_image_size('featured-banner-random-post', 145, 180, true);
});

// remove img caption
add_filter('img_caption_shortcode_width', '__return_false');

// Register Widgets
add_action('widgets_init', function () {
    register_sidebar(array(
        'name'          => 'Global Search',
        'id'            => 'glogal-search',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>',
    ));

    register_sidebar(array(
        'name'          => 'Top Banner Global',
        'id'            => 'global-top-banner',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => 'Footer Banner Global',
        'id'            => 'global-footer-banner',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => 'Template Home - Right Sidebar',
        'id'            => 'template-home-right-sidebar',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => 'Post - Right Sidebar',
        'id'            => 'right-sidebar',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => 'Archive - Right Sidebar',
        'id'            => 'archive-right-sidebar',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    register_sidebar(array(
        'name'          => 'Search Page - Right Sidebar',
        'id'            => 'search-page-right-sidebar',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    register_sidebar(array(
        'name'          => 'Footer Bio - Sidebar',
        'id'            => 'footer-bio-sidebar',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
   
});


// Definindo a classe do Widget
class Related_Posts extends WP_Widget {

    // Construtor
    public function __construct() {
        parent::__construct(
            'related_posts', 
            'Related Posts Widget', 
            array( 'description' => 'A widget to display related posts' )
        );
    }

    // Formulário de administração
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : 'Related Posts';
        $limit = ! empty( $instance['limit'] ) ? $instance['limit'] : 5;
        $exclude_categories = ! empty( $instance['exclude_categories'] ) ? $instance['exclude_categories'] : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'limit' ); ?>">Limit:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" type="number" value="<?php echo esc_attr( $limit ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'exclude_categories' ); ?>">Exclude Categories (comma separated IDs):</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'exclude_categories' ); ?>" name="<?php echo $this->get_field_name( 'exclude_categories' ); ?>" type="text" value="<?php echo esc_attr( $exclude_categories ); ?>">
        </p>
        <?php 
    }

    // Atualizar a instância do widget
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['limit'] = ( ! empty( $new_instance['limit'] ) ) ? strip_tags( $new_instance['limit'] ) : '';
        $instance['exclude_categories'] = ( ! empty( $new_instance['exclude_categories'] ) ) ? strip_tags( $new_instance['exclude_categories'] ) : '';
        return $instance;
    }

    // Renderizar o widget
    public function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );
        $limit = $instance['limit'];
        $exclude_categories = explode(',', $instance['exclude_categories']); // Convertendo a string para um array
        $exclude_categories = array_map('trim', $exclude_categories); // Removendo espaços em branco

        echo $before_widget;
        if ( ! empty( $title ) ) echo $before_title . $title . $after_title;
    
        global $post;
        $current_post_id = $post->ID;

        $related_posts = new WP_Query(array(
            'posts_per_page' => $limit,
            'post__not_in' => array($current_post_id),
            'category__not_in' => $exclude_categories,  // Excluindo as categorias
            // Adicione outros critérios aqui se necessário
        ));
    
        echo '<ul>';
        $i = 1;
        while ( $related_posts->have_posts() ) : $related_posts->the_post();
            echo '<li><span class="related-numbers">' . $i . '</span> <a href="' . get_the_permalink() . '" aria-label="' . get_the_title() . '">' . get_the_title() . '</a></li>';
            $i++;
        endwhile;
        echo '</ul>';
    
        echo $after_widget;
    }
}


class Posts_By_Category extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'posts_by_category',
            'Posts By Category Widget',
            array( 'description' => 'A widget to display posts by category' )
        );
    }

    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : 'Posts By Category';
        $limit = ! empty( $instance['limit'] ) ? $instance['limit'] : 5;
        $category = ! empty( $instance['category'] ) ? $instance['category'] : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'limit' ); ?>">Limit:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" type="number" value="<?php echo esc_attr( $limit ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('category'); ?>">Select Category:</label>
            <?php wp_dropdown_categories(array('name' => $this->get_field_name('category'), 'selected' => $category)); ?>
        </p>
        <?php 
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['limit'] = ( ! empty( $new_instance['limit'] ) ) ? strip_tags( $new_instance['limit'] ) : '';
        $instance['category'] = ( ! empty( $new_instance['category'] ) ) ? strip_tags( $new_instance['category'] ) : '';
        return $instance;
    }

    public function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );
        $limit = $instance['limit'];
        $category = $instance['category'];

        echo $before_widget;
        if ( ! empty( $title ) ) echo $before_title . $title . $after_title;

        $query_args = array(
            'posts_per_page' => $limit,
            'cat' => $category
        );

        $posts_by_category = new WP_Query($query_args);

        echo '<ul>';
        $i = 1;
        while ( $posts_by_category->have_posts() ) : $posts_by_category->the_post();
            echo '<li><a href="' . get_the_permalink() . '" aria-label="' . get_the_title() . '">' . get_the_title() . '</a></li>';
            $i++;
        endwhile;
        echo '</ul>';

        echo $after_widget;
    }
}

class Popular_Posts_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'popular_posts_widget',
            'Posts Populares',
            array('description' => 'Exibe os posts mais populares ou mais lidos.')
        );
    }

    public function widget($args, $instance) {
        $title = !empty($instance['title']) ? apply_filters('widget_title', $instance['title']) : 'Posts Populares';
        $limit = !empty($instance['limit']) ? $instance['limit'] : 5;
        $query_args = array(
            'post_type' => 'post',
            'posts_per_page' => $limit,
            'orderby' => 'comment_count',
            'order' => 'DESC'
        );

        $popular_posts = new WP_Query($query_args);

        echo $args['before_widget'];
        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        if ($popular_posts->have_posts()) {
            echo '<ul>';
            while ($popular_posts->have_posts()) {
                $popular_posts->the_post();
                echo '<li><a href="' . get_permalink() . '" aria-label="' . get_the_title() . '">' . get_the_title() . '</a></li>';
            }
            echo '</ul>';
        } else {
            echo 'Nenhum post popular encontrado.';
        }

        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? esc_attr($instance['title']) : 'Posts Populares';
        $limit = !empty($instance['limit']) ? esc_attr($instance['limit']) : 5;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>">Limit:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" value="<?php echo $limit; ?>" />
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['limit'] = strip_tags($new_instance['limit']);
        return $instance;
    }
}

class Searchbar_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'searchbar_widget',
            'Searchbar Widget',
            array('description' => __('Pesquisar personalizado', 'text_domain'))
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        ?>
        <form role="search" method="get" id="searchWidgetForm" action="<?php echo esc_url(home_url('/')); ?>">
            <input type="text" name="s" id="s" placeholder="Pesquisar...">
            <button type="submit" id="searchWidgetSubmit" aria-label="Pesquisar">
                <svg aria-hidden="true" width="20" height="20" class="search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
                </svg>
            </button>
        </form>
        <?php
        echo $args['after_widget'];
    }
}

// Register Widget
add_action( 'widgets_init', function () {
    register_widget( 'Related_Posts' );
    register_widget( 'Posts_By_Category' );
    register_widget('Popular_Posts_Widget');
    register_widget('Searchbar_Widget');
});


// Excude page from search
add_filter('pre_get_posts', function($query) {
    if ($query->is_search && !is_admin()) {
        $query->set('post_type', 'post');
    }
    return $query;
});


// THeme Settings

// Adiciona página de opções ao menu
function unicorniohater_add_options_page() {
    add_menu_page(
        'Theme Settings',
        'Theme Settings',
        'manage_options',
        'unicorniohater_theme_settings',
        'unicorniohater_display_options_page'
    );
}
add_action('admin_menu', 'unicorniohater_add_options_page');

// Conteúdo da página de opções
function unicorniohater_display_options_page() {
    ?>
    <div class="wrap">
        <h1>Theme Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('unicorniohater_settings_group');
            do_settings_sections('unicorniohater_theme_settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Inicializa as configurações
function unicorniohater_initialize_settings() {
    register_setting('unicorniohater_settings_group', 'unicorniohater_settings');

    // Primeira seção: Featured Section
    add_settings_section(
        'featured_section',
        'Featured Section',
        'featured_section_description',
        'unicorniohater_theme_settings'
    );

    add_settings_field(
        'featured_title',
        'Título da Seção',
        'featured_title_callback',
        'unicorniohater_theme_settings',
        'featured_section'
    );

    add_settings_field(
        'featured_category',
        'Nome da Categoria',
        'featured_category_callback',
        'unicorniohater_theme_settings',
        'featured_section'
    );

    // Segunda seção: Content Random Section
    add_settings_section(
        'content_random_section',
        'Content Random Section',
        'content_random_section_description',
        'unicorniohater_theme_settings'
    );

    add_settings_field(
        'random_title',
        'Título da Seção',
        'random_title_callback',
        'unicorniohater_theme_settings',
        'content_random_section'
    );

    add_settings_field(
        'random_category',
        'Nome das Categorias',
        'random_category_callback',
        'unicorniohater_theme_settings',
        'content_random_section'
    );
}
add_action('admin_init', 'unicorniohater_initialize_settings');

// Descrições das seções
function featured_section_description() {
    echo 'Configure as opções para a Featured Section aqui.';
}

function content_random_section_description() {
    echo 'Configure as opções para a Content Random Section aqui.';
}

// Callbacks para os campos
function featured_title_callback() {
    $options = get_option('unicorniohater_settings');
    $value = isset($options['featured_title']) ? $options['featured_title'] : '';
    echo "<input name='unicorniohater_settings[featured_title]' type='text' value='" . esc_attr($value) . "' />";
}

function featured_category_callback() {
    $options = get_option('unicorniohater_settings');
    $value = isset($options['featured_category']) ? $options['featured_category'] : '';
    echo "<input name='unicorniohater_settings[featured_category]' type='text' value='" . esc_attr($value) . "' />";
}

function random_title_callback() {
    $options = get_option('unicorniohater_settings');
    $value = isset($options['random_title']) ? $options['random_title'] : '';
    echo "<input name='unicorniohater_settings[random_title]' type='text' value='" . esc_attr($value) . "' />";
}

function random_category_callback() {
    $options = get_option('unicorniohater_settings');
    $value = isset($options['random_category']) ? $options['random_category'] : '';
    echo "<input name='unicorniohater_settings[random_category]' type='text' value='" . esc_attr($value) . "' />";
}
