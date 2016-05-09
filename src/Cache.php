<?php
namespace cache;

/**
 * Class Cache
 * @package cache
 */
class Cache
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * Cache constructor.
     */
    public function __construct()
    {}

    /**
     * @param string $key
     * @return bool
     */
    protected function exists($key)
    {
        return isset($this->data[$key]);
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function get($key)
    {
        return $this->exists($key) ? $this->data[$key] : null;
    }

    /**
     * @param string $key
     * @param mixed|null $value
     */
    public function put($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function remove($key)
    {
        if ($this->exists($key)) {
            unset($this->data[$key]);

            return true;
        }

        return false;
    }
}
