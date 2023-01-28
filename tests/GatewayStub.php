<?php

namespace Tests;

use App\Gateway;

class GatewayStub implements Gateway
{
    public function create()
    {
        return 'receipt-stub';
    }
}