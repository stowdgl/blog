<?php
namespace App\Tools;

class Alert{
public static function success($message, $seconds = 3)
    {
        // Redefine vars
        $message = (string) $message;
        $seconds    = (int) $seconds;

        echo '<script type="text/javascript">
                Messenger().post({
                    type: "success",
                    message: "'.$message.'",                    
                    hideAfter: '.$seconds.'
                });
             </script>';
    }

public static function warning($message, $seconds = 3)
    {
        // Redefine vars
        $message = (string) $message;
        $seconds    = (int) $seconds;

        echo '<script type="text/javascript">
                Messenger().post({
                    type: "info",
                    message : "'.$message.'",
                    hideAfter: '.$seconds.'
                });
             </script>';
    }


   public static function error($message, $seconds = 3)
    {
        // Redefine vars
        $message = (string) $message;
        $seconds    = (int) $seconds;

        echo '<script type="text/javascript">
                Messenger().post({
                    type: "error",
                    message : "'.$message.'",
                    hideAfter: '.$seconds.'
                });
             </script>';
    }
}
