<?php

namespace App\Lib\Utilities;

class MemcachedService
{
    private static $instance;
    private $memcached;
    
    public function __construct()
    {
        $this->memcached = new \Memcached();
        $this->memcached->addServer('localhost', 11211);
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getWithFallback($key, $fallback, $ttl = 3600)
    {
        // Гетим значения, если их нет - сетим их и возвращаем
        $value = $this->memcached->get($key);
        if (!$value) {
            try {
                $value = $fallback();
                $this->memcached->set($key, $value, $ttl);
            } catch (\Exception $e) {
                error_log('Ошибка Memcached для ключа: ' . $key . ' , ' . $e->getMessage());
                return null;
            }
        }
        return $value;
    }
}
