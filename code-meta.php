<?php
/**
 * Plugin Name:     CodeMilitant Meta Tag Generator
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

require('/usr/share/nginx/html/wp-content/plugins/code-meta/includes/autoloader.php');
$test = new CodeMilitant\CodeMeta\Src\MyTest();
