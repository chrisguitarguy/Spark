<?php
/**
 * Spark
 *
 * @category    WordPress
 * @package     Spark
 * @copyright   2013 Christopher Davis <http://christopherdavis.me>
 * @license     http://opensource.org/licenses/GPL-2.0 GPL-2.0+
 */

namespace Spark\Test;

class SparkTypeTest extends \WP_UnitTestCase
{
    public function testPostTypeManagerAction()
    {
        $spark = new \Spark\Spark();
        $this->assertEquals(99, has_action('init', array($spark['types.post'], 'register')));
    }

    public function testTaxonomyManagerAction()
    {
        $spark = new \Spark\Spark();
        $this->assertEquals(99, has_action('init', array($spark['types.taxonomy'], 'register')));
    }
}
