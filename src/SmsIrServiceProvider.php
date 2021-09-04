<?php

namespace MohsenSaatchi\SmsIr;

use Illuminate\Support\ServiceProvider;

class SmsIrServiceProvider extends ServiceProvider
{
  public function register()
  {
    $this->app->bind('smsir', function($app) {
      return new SmsIr();
    });
  }

  public function boot()
  {
    //
  }
  public function provides()
    {
        return [
            SmsIr::class
        ];
    }
}