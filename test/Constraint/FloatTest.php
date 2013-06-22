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

use Spark\Constraint\Float;

class FloatTest extends \WP_UnitTestCase
{
    private $constraint;

    public function floatProvider()
    {
        return array(
            array('1'),
            array(1.0),
            array('1.0'),
            array('1,000.0'),
            array('1,000')
        );
    }

    public function notFloatProvider()
    {
        return array(
            array('nope'),
            array(false),
            array('a'),
        );
    }

    /**
     * @dataProvider floatProvider
     */
    public function testFloat($val)
    {
        $this->assertTrue($this->constraint->check($val));
    }

    /**
     * @dataProvider notFloatProvider
     * @expectedException Spark\Constraint\ConstraintViolation
     */
    public function testNotFloat($val)
    {
        $this->constraint->check($val);
    }

    public function setUp()
    {
        parent::setUp();

        $this->constraint = new Float();
    }
}
