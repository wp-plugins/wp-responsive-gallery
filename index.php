<?php 
/**
 * Plugin Name: WP Responsive Gallery
 * Plugin URI: http://pluginriver.com
 * Description: Redirect Buy Button on product pages to Amazon, No API required
 * Version: 4.0
 * Author: zafar ullah joiya
 * Author URI: http://pluginriver.com/
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: pr-responsive-gallery
 */

/*

  Copyright (C) 2015  zafar ullah joiya  zafarullah212@gmail.com

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.
*/
 require_once('plugin.class.php');
  if(class_exists('Pr_Responsive_Gallery')){
  	$just_intilize = new Pr_Responsive_Gallery;
  }
 ?>