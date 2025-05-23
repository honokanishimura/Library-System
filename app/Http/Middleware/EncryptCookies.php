<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * 暗号化を除外するクッキー名
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
