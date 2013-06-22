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

use Spark\Constraint\Integer;

class IntegerTest extends \WP_UnitTestCase
{
    private $constraint;

    public function intProvider()
    {
        return array(
            array('1'),
            array(0),
            array(1)
        );
    }

    public function notIntProvider()
    {
        return array(
            array('nope'),
            array('0x12'), // we don't allow hex
            array('0666'), // we also don't allow octals
        );
    }

    /**
     * @dataProvider notIntProvider
     * @expectedException Spark\Constraint\ConstraintViolation
     */
    public function testNotInt($val)
    {
        $this->constraint->check($val);
    }

    /**
     * @dataProvider intProvider
     */
    public function testInt($val)
    {
        $this->assertTrue($this->constraint->check($val));
    }

    public function setUp()
    {
        parent::setUp();
        $this->constraint = new Integer();
    }
}
