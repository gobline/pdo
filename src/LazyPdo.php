<?php

/*
 * Gobline Framework
 *
 * (c) Mathieu Decaffmeyer <mdecaffmeyer@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gobline\Pdo;

/**
 * @author Mathieu Decaffmeyer <mdecaffmeyer@gmail.com>
 */
class LazyPdo extends \PDO
{
    private $dsn;
    private $user;
    private $password;
    private $options;
    private $isConnected = false;

    public function __construct($dsn, $user = null, $password = null, $options = null)
    {
        $this->dsn = $dsn;
        $this->user = $user;
        $this->password = $password;
        $this->options = $options;
    }

    public function connect()
    {
        if (!$this->isConnected) {
            parent::__construct($this->dsn, $this->user, $this->password, $this->options);
            $this->isConnected = true;
        }
    }

    public function beginTransaction()
    {
        $this->connect();

        return parent::beginTransaction();
    }
    public function commit()
    {
        $this->connect();

        return parent::commit();
    }
    public function errorCode()
    {
        $this->connect();

        return parent::errorCode();
    }
    public function errorInfo()
    {
        $this->connect();

        return parent::errorInfo();
    }
    public function exec($statement)
    {
        $this->connect();

        return parent::exec($statement);
    }
    public function getAttribute($attribute)
    {
        $this->connect();

        return parent::getAttribute($attribute);
    }
    public static function getAvailableDrivers()
    {
        $this->connect();

        return parent::getAvailableDrivers();
    }
    public function inTransaction()
    {
        if (!$this->isConnected) {
            return false;
        }
        $this->connect();

        return parent::inTransaction();
    }
    public function lastInsertId($name = null)
    {
        $this->connect();

        return parent::lastInsertId($name);
    }
    public function prepare($statement, $driver_options = array())
    {
        $this->connect();

        return parent::prepare($statement, $driver_options);
    }
    public function query($statement)
    {
        $this->connect();

        return parent::query($statement);
    }
    public function quote($string, $parameter_type = \PDO::PARAM_STR)
    {
        $this->connect();

        return parent::quote($string, $parameter_type);
    }
    public function rollBack()
    {
        $this->connect();

        return parent::rollBack();
    }
    public function setAttribute($attribute, $value)
    {
        $this->connect();

        return parent::setAttribute($attribute, $value);
    }
}
