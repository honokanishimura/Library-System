<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * 信頼できるプロキシ
     *
     * @var array<int, string>|int|null
     */
    protected $proxies;

    /**
     * 信頼できるヘッダー
     *
     * @var int
     */
    protected $headers = Request::HEADER_FORWARDED;
}
