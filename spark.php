<?php
/**
 * Plugin Name: Spark
 * Plugin URI: https://github.com/chrisguitarguy/Spark
 * Description: A framework for getting sh!t done with WordPress.
 * Version: 0.1
 * Text Domain: spark
 * Author: Christopher Davis
 * Author URI: http://christopherdavis.me
 * License: MIT
 *
 * Copyright (c) 2013 Christopher Davis <http://christopherdavis.me>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 *
 * @category    WordPress
 * @author      Christopher Davis <http://christopherdavis.me>
 * @copyright   2013 Christopher Davis
 * @license     http://opensource.org/licenses/MIT MIT
 */

!defined('ABSPATH') && exit;

// we need PHP 5.3
if (version_compare(phpversion(), '5.3.3', '<')) {
    return;
}

define('SPARK_TD', 'spark-framework');
define('SPARK_ROOT', dirname(__FILE__));
define('SPARK_URL', plugin_dir_url(__FILE__));


require_once SPARK_ROOT . '/lib/Pimple.php';
require_once SPARK_ROOT . '/src/Autoloader.php';
require_once SPARK_ROOT . '/src/Spark.php';
require_once SPARK_ROOT . '/src/core.php';

add_action('plugins_loaded', 'spark_load', 5);
add_action('after_setup_theme', 'spark_load_theme', 5);
