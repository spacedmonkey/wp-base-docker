<?php
/* Plugin Name: Disable concact in admin
 * Description: Disable concact in admin for gutenberg
 * Author: WordPress
 * Version: 0.1-beta
 */

add_filter( 'js_do_concat', '__return_false');
