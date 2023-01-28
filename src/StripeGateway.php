<?php

namespace App;

class StripeGateway implements Gateway
{
    public function create()
    {
        var_dump("Slow loading on the gateway");
    }
}