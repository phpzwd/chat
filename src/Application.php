<?php

namespace Phpzwd\Chat;

use Phpzwd\Chat\Config as AppConfig;
use Phpzwd\Chat\Contracts\Config;
use Phpzwd\Chat\Exceptions\InvalidArgumentException;

class Application
{
    protected ?Chat $chat = null;

    private Config $config;

    private static ?Application $instance = null;

    /**
     * @throws InvalidArgumentException
     * @throws \Exception
     */
    private function __construct(array|Config|null $config = null)
    {
        if (! $config) {
            $config = config('chat');

            if (! $config || ! is_array($config)) {
                throw new \Exception('config not found');
            }
        }
        $this->config = is_array($config) ? new AppConfig($config) : $config;
    }

    /**
     * get Application Object.
     *
     * @throws InvalidArgumentException
     */
    public static function getInstance(array|Config|null $config = null): Application
    {
        if (self::$instance === null) {
            self::$instance = new self($config);
        }

        return self::$instance;
    }

    public function getConfig(): Config
    {
        return $this->config;
    }

    public function setConfig(Config $config): static
    {
        $this->config = $config;

        return $this;
    }

    /**
     * create chat.
     *
     * @throws InvalidArgumentException
     */
    public function createChat(): Chat
    {
        if (! $this->chat) {
            $base_url = $this->config->get('base_url') ?? 'https://chat.ibisaas.com/#/client';
            $appId = $this->config->get('app_id');
            $source = $this->config->get('source') ?? 'pc';

            if (! is_string($appId) || empty($appId)) {
                throw new InvalidArgumentException("Missing required config: 'app_id'");
            }

            $this->chat = new Chat($base_url, $appId, $source);
        }

        return $this->chat;
    }
}
