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

use Spark\Constraint\Range;

class RangeTest extends \WP_UnitTestCase
{
    private $constraint;

    /**
     * @expectedException Spark\Constraint\ConstraintViolation
     */
    public function testNonNumericValues()
    {
        $this->constraint->check('abcd');
    }

    public function testWithoutMaxOrMin()
    {
        $this->assertTrue($this->constraint->check(0));
    }

    /**
     * @expectedException Spark\Constraint\ConstraintViolation
     */
    public function testWithMin()
    {
        $this->constraint->min = 1;
        $this->constraint->check(0);
    }

    /**
     * @expectedException Spark\Constraint\ConstraintViolation
     */
    public function testWithMax()
    {
        $this->constraint->max = 10;
        $this->constraint->check('11');
    }

    public function testWithMaxAndMin()
    {
        $this->constraint->max = 10;
        $this->constraint->min = 1;
        $this->assertTrue($this->constraint->check(9));
    }

    public function setUp()
    {
        parent::setUp();
        $this->constraint = new Range();
    }
}
