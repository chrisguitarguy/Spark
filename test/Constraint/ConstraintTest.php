<?php
/**
 * Spark
 *
 * @category    WordPress
 * @package     Spark
 * @copyright   2013 Christopher Davis <http://christopherdavis.me>
 * @license     http://opensource.org/licenses/GPL-2.0 GPL-2.0+
 */

namespace Spark\Test\Constraint;

class ConstraintTest extends \WP_UnitTestCase
{
    private $obj;

    /**
     * @expectedException Spark\Constraint\ConstraintViolation
     */
    public function testCheckWithBadValue()
    {
        $this->obj->expects($this->once())
            ->method('_check')
            ->will($this->returnValue(false));

        $this->obj->check('here');
    }

    public function testCheckWithGoodValue()
    {
        $this->obj->expects($this->once())
            ->method('_check')
            ->will($this->returnValue(true));

        $this->assertTrue($this->obj->check('here'));
    }

    public function testGetSetIssetUnset()
    {
        $this->assertFalse(isset($this->obj->key));

        $this->obj->key = 'one';

        $this->assertTrue(isset($this->obj->key));
        $this->assertEquals('one', $this->obj->key);

        unset($this->obj->key);
    }

    /**
     * @expectedException PHPUnit_Framework_Error
     */
    public function testGetWithBadKey()
    {
        $this->obj->key;
    }

    /**
     * @expectedException PHPUnit_Framework_Error
     */
    public function testUnsetWithBadKey()
    {
        unset($this->obj->there);
    }

    public function setUp()
    {
        parent::setUp();
        $this->obj = $this->getMockForAbstractClass('Spark\\Constraint\\Constraint');
    }
}
