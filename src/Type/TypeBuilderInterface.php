<?php
/**
 * Spark
 *
 * @category    WordPress
 * @package     Spark
 * @copyright   2013 Christopher Davis <http://christopherdavis.me>
 * @license     http://opensource.org/licenses/GPL-2.0 GPL-2.0+
 */

namespace Spark\Type;

/**
 * Used by TypeManagerInterface to build types.
 *
 * @since   0.1
 * @author  Christopher Davis <http://christopherdavis.me>
 */
interface TypeBuilderInterface
{
    /**
     * Build a type.
     *
     * @since   0.1
     * @access  public
     * @param   Spark\Type\TypeInterface
     */
    public function build(TypeInterface $type);
}
