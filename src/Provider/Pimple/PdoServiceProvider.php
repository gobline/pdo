<?php

/*
 * Mendo Framework
 *
 * (c) Mathieu Decaffmeyer <mdecaffmeyer@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mendo\Pdo\Provider\Pimple;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Mendo\Pdo\LazyPdo;

/**
 * @author Mathieu Decaffmeyer <mdecaffmeyer@gmail.com>
 */
class PdoServiceProvider implements ServiceProviderInterface
{
    private $reference;

    public function __construct($reference = 'pdo')
    {
        $this->reference = $reference;
    }

    public function register(Container $container)
    {
        $reference = $this->reference;

        $container[$reference.'.lazy'] = true;
        $container[$reference.'.username'] = null;
        $container[$reference.'.password'] = null;
        $container[$reference.'.options'] = array();

        $container[$reference] = function ($c) use ($reference) {
            if (empty($c[$reference.'.dsn'])) {
                throw new \Exception('dsn not specified');
            }

            $dsn = $c[$reference.'.dsn'];
            $username = $c[$reference.'.username'];
            $password = $c[$reference.'.password'];
            $options = $c[$reference.'.options'];

            if ($c[$reference.'.lazy']) {
                return new LazyPdo($dsn, $username, $password, $options);
            }

            return new \PDO($dsn, $username, $password, $options);
        };
    }
}
