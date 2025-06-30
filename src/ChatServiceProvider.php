<?php

namespace Phpzwd\Chat;

use Illuminate\Support\ServiceProvider;

class ChatServiceProvider extends ServiceProvider
{
    public function register()
    {
        $source = realpath(__DIR__.'/../config/chat.php');
        $this->mergeConfigFrom($source, 'chat');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/chat.php' => config_path('chat.php'),
        ]);
    }
}
