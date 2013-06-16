<?php
/**
 * Spark
 *
 * @category    WordPress
 * @package     Spark
 * @copyright   2013 Christopher Davis <http://christopherdavis.me>
 * @license     http://opensource.org/licenses/GPL-2.0 GPL-2.0+
 */

/**
 * Hooked into `plugins_loaded` to kick off the process.
 *
 * @since   0.1
 * @uses    do_action
 * @return  void
 */
function spark_load()
{
    $spark = spark('__self');
    $spark['autoloader']->addNamespace('Spark', __DIR__)
        ->register();

    do_action('spark_loaded', $spark);
}

/**
 * A little syntatic sugar around Spark\Spark::get
 *
 * @since   0.1
 * @return  Spark\Spark
 */
function spark($name)
{
    return \Spark\Spark::get($name);
}
