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

use Spark\Constraint\Blank;

class BlankTest extends \WP_UnitTestCase
{
    private $constraint;

    public function emptyProvider()
    {
        return array(
            array(0),
            array(false),
            array(null),
            array('0'),
            array(''),
            array(array()),
        );
    }

    public function notEmptyProvider()
    {
        return array(
            array(1),
            array(true),
            array(array(null)),
            array('here')
        );
    }

    /**
     * @dataProvider emptyProvider
     */
    public function testBlankValue($val)
    {
        $this->assertTrue($this->constraint->check($val));
    }

    /**
     * @dataProvider notEmptyProvider
     * @expectedException Spark\Constraint\ConstraintViolation
     */
    public function testNotBlankValue($val)
    {
        $this->constraint->check($val);
    }

    public function setUp()
    {
        parent::setUp();

        $this->constraint = new Blank();
    }
}
