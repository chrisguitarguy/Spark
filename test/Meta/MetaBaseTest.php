<?php
/**
 * Spark
 *
 * @category    WordPress
 * @package     Spark
 * @copyright   2013 Christopher Davis <http://christopherdavis.me>
 * @license     http://opensource.org/licenses/GPL-2.0 GPL-2.0+
 */

namespace Spark\Test\Meta;

class MetaBaseTest extends \WP_UnitTestCase
{
    private $obj;

    public function testGetSetPrefix()
    {
        $this->assertSame($this->obj, $this->obj->setPrefix('here'));
        $this->assertEquals('here', $this->obj->getPrefix());
    }

    /**
     * @depends testGetSetPrefix
     */
    public function testBuildKey()
    {
        $this->obj->setPrefix('here');
        $this->assertEquals('_here_key', $this->obj->buildKey('key'));
    }

    public function setUp()
    {
        parent::setUp();

        $this->obj = $this->getMockForAbstractClass('Spark\\Meta\\MetaBase');
    }
}
