<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

class PreventRequestsDuringMaintenance extends Middleware
{
    /**
     * メンテナンスモード中でもアクセス可能なルート
     *
     * @var array<int, string>
     */
    protected $except = [
        // 例: '/status'
    ];
}
