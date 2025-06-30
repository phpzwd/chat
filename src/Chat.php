<?php

namespace Phpzwd\Chat;

use Phpzwd\Chat\Exceptions\InvalidArgumentException;

class Chat
{
    protected string $app_id;
    protected string $source;
    protected string $base_url;

    /**
     * @throws InvalidArgumentException
     */
    public function __construct(string $base_url, string $app_id, string $source)
    {
        if (empty($base_url) || empty($app_id) || empty($source)) {
            throw new InvalidArgumentException('All parameters must be non-empty strings.');
        }

        $this->base_url = rtrim($base_url, '?');
        $this->app_id = $app_id;
        $this->source = $source;
    }

    public function getUrl(): string
    {
        $params = [
            'app_id' => $this->app_id,
            'source' => $this->source,
        ];

        return $this->base_url.'?'.http_build_query($params);
    }
}
