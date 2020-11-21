<?php

namespace App\Carnovo\Cars\Infrastructure\Http\Controller;

class HealthController
{
    public function __construct()
    {

    }

    public function __invoke()
    {
        dd("ok");
    }
}