<?php
/**
 *
 * This file is part of Aura for PHP.
 *
 * @license http://opensource.org/licenses/MIT MIT
 *
 */
namespace PenPaper\Delivery;

use Aura\Di\Injection\LazyInterface;

/**
 *
 * Returns the value of a callable when invoked (thereby invoking the callable).
 *
 * @package Aura.Di
 *
 */
class LazyArray implements LazyInterface
{
    /**
     *
     * Array of callables to invoke.
     *
     * @var array
     *
     */
    protected $callables;

    /**
     *
     * Constructor.
     *
     * @param array $callables The callables to invoke.
     *
     */
    public function __construct(array $callables)
    {
        $this->callables = $callables;
    }

    /**
     *
     * Invokes the closure to create the instance.
     *
     * @return object The object created by the closure.
     *
     */
    public function __invoke()
    {
        // convert Lazy objects in the callables
        if (is_array($this->callables)) {
            foreach ($this->callables as $key => $val) {
                if ($val instanceof LazyInterface) {
                    $this->callables[$key] = $val();
                }
            }
        }

        // make the call
        return $this->callables;
    }
}
