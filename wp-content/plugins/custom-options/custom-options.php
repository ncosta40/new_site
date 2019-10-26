<?php
/**
 * Plugin Name:       Opções administração Wordpress
 * Plugin URI:        https://www.ncosta.com/
 * Description:       Diversas alterações
 * Version:           1.0
 * Author:            Nuno Costa
 */

 /**
  * 
  * Este código impede que se aceda diretamente a este ficheiro
  *
  */
 if(!defined('ABSPATH')) {
     exit;
 }

/**
 * 
 * Menu Opções
 * 
 */
add_action('admin_menu', 'opcoes_create_menu');

function opcoes_create_menu() {

	//create new top-level menu
	add_menu_page('Opções Plugin', 'Opções', 'administrator', __FILE__, 'opcoes_settings_page','
    dashicons-admin-generic');

	//call register settings function
	add_action( 'admin_init', 'register_mysettings' );
}

function register_mysettings() {
	//register our settings
	register_setting( 'opcoes-settings-group', 'new_option_name' );
	register_setting( 'opcoes-settings-group', 'some_other_option' );
	register_setting( 'opcoes-settings-group', 'option_etc' );
}

function opcoes_settings_page() {
    include 'form-file.php';
}

if( function_exists('acf_add_local_field_group') ):

  acf_add_local_field_group(array(
    'key' => 'group_5d6f92196831a',
    'title' => 'Campos',
    'fields' => array(
      array(
        'key' => 'field_5d70c261aa55a',
        'label' => 'Esconder referências a Wordpress e updates da versão',
        'name' => 'esconder_referencias_updates',
        'type' => 'checkbox',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          1 => 'Sim',
        ),
        'allow_custom' => 0,
        'default_value' => array(
        ),
        'layout' => 'horizontal',
        'toggle' => 0,
        'return_format' => 'value',
        'save_custom' => 0,
      ),
      array(
        'key' => 'field_5d70c9913a925',
        'label' => 'Limitar acesso a campos não relevantes para cliente (Ex.: Temas, Plugins)',
        'name' => 'limitar_acesso',
        'type' => 'checkbox',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          1 => 'Sim',
        ),
        'allow_custom' => 0,
        'default_value' => array(
        ),
        'layout' => 'vertical',
        'toggle' => 0,
        'return_format' => 'value',
        'save_custom' => 0,
      ),
      array(
        'key' => 'field_5d6f921e3631b',
        'label' => 'Escolher Google Fonts',
        'name' => 'fonte',
        'type' => 'google_font_selector',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'include_web_safe_fonts' => 1,
        'enqueue_font' => 1,
        'default_font' => 'Open Sans',
      ),
      array(
        'key' => 'field_5d714c9e74dbf',
        'label' => 'Cor barras',
        'name' => 'cor_barras',
        'type' => 'select',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'fresh' => 'Fresh',
          'light' => 'Light',
          'blue' => 'Blue',
          'coffee' => 'Coffee',
          'ectoplasm' => 'Ectoplasm',
          'midnight' => 'Midnight',
          'ocean' => 'Ocean',
          'sunrise' => 'Sunrise',
        ),
        'default_value' => array(
          0 => 'fresh',
        ),
        'allow_null' => 0,
        'multiple' => 0,
        'ui' => 0,
        'return_format' => 'value',
        'ajax' => 0,
        'placeholder' => '',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'current_user_role',
          'operator' => '==',
          'value' => 'administrator',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
  ));
  
endif;

add_action( 'admin_init', 'add_acf_variables' );

function add_acf_variables() {
    acf_form_head();
}

// 1. Esconder referências a Wordpress e updates da versão

$esconder_referencias_updates = get_field('esconder_referencias_updates','option');

if($esconder_referencias_updates[0] == 1) {

  /**
   * 
   * footer personalizado
   * 
   */
  function wpexplorer_remove_footer_admin () {
      echo '<span id="footer-thankyou">Alterado por Nuno Costa.</span>';
  }
  add_filter( 'admin_footer_text', 'wpexplorer_remove_footer_admin' );

  /**
   * 
  * esconde a versão do wordpress
  * 
  */
  function my_footer_shh() {    
      remove_filter( 'update_footer', 'core_update_footer' );
  }

  add_action( 'admin_menu', 'my_footer_shh' );

  /**
   * 
   * remover a versão de scripts e styles
   * 
   */
  /*function remove_version_from_style_js( $src ) {
      if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) )
      $src = remove_query_arg( 'ver', $src );
      return $src;
  }
  add_filter( 'style_loader_src', 'remove_version_from_style_js');
  add_filter( 'script_loader_src', 'remove_version_from_style_js');*/

  /**
   * 
   * remover logo barra admin
   * 
   */
  function example_admin_bar_remove_logo() {
      global $wp_admin_bar;
      $wp_admin_bar->remove_menu( 'wp-logo' );
  }
  add_action( 'wp_before_admin_bar_render', 'example_admin_bar_remove_logo', 0 );

  /**
   * 
   * Esconde mensagens de major updates de todos os utilizadores
   * exceto administradores
   * 
   */
  function hide_core_update_notifications_from_users() {
      //if ( ! current_user_can( 'update_core' ) ) {
          remove_action( 'admin_notices', 'update_nag', 3 );
      //}
  }
  add_action( 'admin_head', 'hide_core_update_notifications_from_users', 1 );
  
  /**
   * 
   * remover painel bemvindo
   * 
   */
  remove_action('welcome_panel', 'wp_welcome_panel');
  
  /**
   * 
   * remover widgets do dashboard
   * 
   */
  function remove_dashboard_meta() {
      //if ( ! current_user_can( 'manage_options' ) ) {
          remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
          remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
          remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
          remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
          remove_meta_box( 'dashboard_php_nag', 'dashboard', 'normal' );        
          remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
          remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
          remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
          remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
          remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
      //}
  }
  add_action( 'admin_init', 'remove_dashboard_meta' ); 
  
  /**
   * 
   * remove submenu "Updates" do dashboard
   * 
   */
  function remove_submenus() {
      global $submenu;
        unset($submenu['index.php'][10]); // Removes 'Updates'.
    }
  add_action('admin_menu', 'remove_submenus');

}

// 2. Limitar acesso a campos não relevantes para cliente (Ex.: Temas, Plugins)

$limitar_acesso = get_field('limitar_acesso','option');

if($limitar_acesso[0] == 1) {

  /**
   *
  * Remover menus da administração
  *
  */
  function remove_menus() {
    global $menu;
    global $current_user;
    get_currentuserinfo();

    //if($current_user->user_login == 'user') {
      $restricted = array(/*__('Posts'),
                          __('Media'),
                          __('Links'),
                          __('Pages'),
                          __('Comments'),*/
                          __('Appearance'),
                          __('Plugins'),
                          __('Users'),
                          __('Tools'),
                          __('Settings')
      );
      end ($menu);
      while (prev($menu)){
          $value = explode(' ',$menu[key($menu)][0]);
          if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
      }// end while
  
    //}// end if
  }

  add_action('admin_menu', 'remove_menus');

  /**
   * 
   * esconder menu ACF admin
   * 
   */
  add_filter('acf/settings/show_admin', '__return_false');

}

// 3. Escolher Google Fonts

/**
 * 
 * Fonte do google
 * Conforme a seleção em backoffice carrega a fonte
 * no ficheiro style.css
 * 
 */
function add_google_fonts() {
  $fonte = get_field('fonte','option');
  $nome = str_replace("","+",$fonte['font']);
  $variantes = $fonte['variants'];
  $subsets = $fonte['subsets'];

  $link = 'https://fonts.googleapis.com/css?family='.$nome;

  $vars = "";
  foreach($variantes as $var) {
      $vars .= $var.",";
  }
  $vars = substr($vars, 0, -1);
  
  $link .= ':'.$vars;

  $subs = "";
  foreach($subsets as $sub) {
      $subs .= $sub.",";
  }
  $subs = substr($subs, 0, -1);
  
  $link .= '&subset='.$subs;

  wp_enqueue_style( ' add_google_fonts ', $link, false );

  wp_enqueue_style(
    'custom-style',
    get_template_directory_uri() . '/style.css'
  );
  $custom_css = "
      html {
          font-size: 14px;
      }
      body, #wpadminbar *:not([class=\"ab-icon\"]), .wp-core-ui, .media-menu, .media-frame *, .media-modal *,
      button, input, select, optgroup, textarea,
      table, tr, td, th
        {
          font-family: '".$fonte['font']."' !important;
      }";
  wp_add_inline_style( 'custom-style', $custom_css );
}

add_action( 'admin_enqueue_scripts', 'add_google_fonts' );

/**
 * 
 * Remove o color scheme da página de perfil do
 * utilizador
 * 
 */
/*function admin_color_scheme() {
  global $_wp_admin_css_colors;
  $_wp_admin_css_colors = 0;
}
add_action('admin_head', 'admin_color_scheme');*/

$cor_barras = get_field('cor_barras','option');
//$cor_barras = 'midnight';

if($cor_barras != "") {
  function change_admin_color($result) {
    $result = $cor_barras;
  
    return $result;
  }
  add_filter('get_user_option_admin_color','change_admin_color');
}