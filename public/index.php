<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Laravelのメンテナンスモード確認
if (file_exists(__DIR__.'/../storage/framework/maintenance.php')) {
    require __DIR__.'/../storage/framework/maintenance.php';
}

// Composerのオートローダーを読み込む
require __DIR__.'/../vendor/autoload.php';

// Laravelアプリケーションを起動
$app = require_once __DIR__.'/../bootstrap/app.php';

// HTTPリクエストを処理してレスポンスを返す
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);
