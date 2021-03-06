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

use Spark\Constraint\BooleanFalse;

class BooleanFalseTest extends \WP_UnitTestCase
{
    private $constraint;

    public function trueProvider()
    {
        return array(
            array(true),
            array('true'),
            array('1'),
            array(1),
            array('yes'),
            array('on'),
        );
    }

    public function falseProvider()
    {
        return array(
            array('false'),
            array(false),
            array(null),
            array('no'),
            array('asdf'),
            array(0)
        );
    }

    /**
     * @dataProvider falseProvider
     */
    public function testFalse($val)
    {
        $this->assertTrue($this->constraint->check($val));
    }

    /**
     * @dataProvider trueProvider
     * @expectedException Spark\Constraint\ConstraintViolation
     */
    public function testTrue($val)
    {
        $this->constraint->check($val);
    }

    public function setUp()
    {
        parent::setUp();

        $this->constraint = new BooleanFalse();
    }
}
