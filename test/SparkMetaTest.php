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

class SparkMetaTest extends \WP_UnitTestCase
{
    private $spark;

    public function metaNameProvider()
    {
        return array(
            array('post'),
            array('comment'),
            array('user'),
        );
    }

    /**
     * @dataProvider metaNameProvider
     */
    public function testMetaExists($name)
    {
        $name = "meta.{$name}";

        $this->assertTrue(isset($this->spark[$name]));
        $this->assertInstanceOf('Spark\\Meta\\MetaInterface', $this->spark[$name]);
    }

    public function setUp()
    {
        parent::setUp();
        $this->spark = new \Spark\Spark(array('prefix' => 'spark'));
    }
}
