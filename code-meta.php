<?php

// defined( 'ABSPATH' ) || exit;

/**
 * Plugin Name:     CodeMilitant Meta Tags
 * Plugin URI:      https://codemilitant.com/product/codemilitant-seo-opengraph-meta-tag-generator-wordpress-plugin/
 * Description:     The CodeMilitant meta tag generator will create the vital meta tags required by the search engines for proper indexing of your website.
 * Author:          CodeMilitant
 * Author URI:      https://codemilitant.com
 * Text Domain:     code-meta
 * Domain Path:     /languages
 * Version:         1.8.0
 *
 * @package         Code_Meta
 */

 if (!defined('CM_META_FILE')) {
    define('CM_META_FILE', __FILE__);
}

// Include the main CodeMilitant class
if (!class_exists('CodeMeta', false)) {
    include_once dirname(CM_META_FILE) . '/includes/class-codemilitant.php';
}

/**
 * Returns the main instance of CM to prevent the need to use globals
 *
 * @return CodeMeta
 */
function CM() // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
{
    return CodeMeta::instance();
}
CM();

// REGISTER ACTIVATION HOOK
function cm_plugin_activate()
{
    add_option('Activated_Plugin', 'code-meta');
}
register_activation_hook(__FILE__, 'cm_plugin_activate');
// REGISTER DEACTIVATION HOOK
function cm_load_plugin()
{
    if (is_admin() && get_option('Activated_Plugin') == 'code-meta') {
        delete_option('Activated_Plugin');
    }
}
add_action('admin_init', 'cm_load_plugin');
register_deactivation_hook(__FILE__, 'cm_plugin_activate');
