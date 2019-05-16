<?php
namespace App\Tools;




use Illuminate\Support\Facades\Request;
class UINotification{

    const SESSION_KEY = 'notifications';
    private static $notifications = [];
    public static function set($key, $value)
    {
        // Redefine arguments
        $key = (string) $key;
            Request::session()->put($key, $value);
        // Save specific variable to the Notifications array



    }

    public static function get($key)
    {
        $key = (string) $key;
        return Request::session()->get($key)? Request::session()->get($key): null;

    }
    public static function clean($key)
    {
        Request::session()->forget($key);

    }

}
