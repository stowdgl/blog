<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class UINotification extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'UINotification';
    }
}