<?php
namespace App\Providers;
use App\Tools\Alert;
use Illuminate\Support\ServiceProvider;
use App\Tools\UINotification;
class ToolsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('UINotification', function () {
            return new UINotification;
        });
        $this->app->bind('Alert', function () {
            return new Alert;
        });
    }
}