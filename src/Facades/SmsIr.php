<?php

namespace MohsenSaatchi\SmsIr\Facades;

use Illuminate\Support\Facades\Facade;

class SmsIr extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'smsir';
    }
}