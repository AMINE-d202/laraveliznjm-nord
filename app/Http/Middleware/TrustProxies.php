<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Fideloper\Proxy\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    /**
     *
     * @var array
     */
    protected $proxies;

    /**
     *
     * @var string
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}
