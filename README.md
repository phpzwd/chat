# 客服

## install

```sh
composer require phpzwd/chat
```

## Use

* get chat url

```php
<?php
use Phpzwd\Chat;

$config = [
    'app_id' => '240cfa7c1f13798166bffcf5f6b8a3ab',
    'source' => 'pc',
];
$chat = new Chat($config);
$chat_url = $chat->getUrl();
dump($chat_url);
```
