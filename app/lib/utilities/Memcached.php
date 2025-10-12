<?php

namespace App\Lib\Utilities;

class MemcachedService
{
    private static $instance;
    private $memcached;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
        $this->memcached = new \Memcached();
        $this->memcached->addServer('memcached', 11211);

        if (!$this->memcached->ping()) {
            throw new \RuntimeException('Ошибка подключения к memcached');
        }
    }

    public function getWithFallback($key, callable $fallback, int $ttl = 3600)
    {
        $value = $this->memcached->get($key);
        if ($value === false) {
            try {
                $value = $fallback();
                $this->memcached->set($key, $value, $ttl);
            } catch (\Exception $e) {
                // Логируем ошибку и возвращаем null
                error_log("Ошибка при получении данных для ключа {$key}: " . $e->getMessage());
                return null;
            }
        }
        return $value;
    }

    public function invalidate($key)
    {
        return $this->memcached->delete($key);
    }
}
