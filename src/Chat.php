<?php

namespace Phpzwd\Chat;

class Chat
{
    private array $configs = [
        'base_url' => 'https://chat.ibisaas.com/#/client',
        'app_id' => '',
        'source' => 'pc',
    ];

    /**
     * @throws \Exception
     */
    public function __construct(array $config)
    {
        if (empty($config['app_id'])) {
            throw new \Exception('app_id 不能为空');
        }

        $this->configs = array_merge($this->configs, $config);
    }

    /**
     * 获取聊天地址.
     */
    public function getUrl(): string
    {
        $baseUrl = trim($this->configs['base_url'], '?');
        $params = $this->configs;
        unset($params['base_url']);

        return $baseUrl.'?'.http_build_query($params);
    }
}
