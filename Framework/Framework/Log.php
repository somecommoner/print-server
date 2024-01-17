<?php 

namespace App;

function Log($message) {
    Log::Info($message);
}

class Log {

    public static function Info($message) {

        global $_settings;

        if ($_settings['LOG_LEVEL'] >= 1)
            Log::Write("[Info]: $message");
    }

    public static function Error($message) {

        global $_settings;

        if ($_settings['LOG_LEVEL'] >= 0)
            Log::Write("[Error]: $message");
    }

    public static function Warning($message) {

        global $_settings;
        
        if ($_settings['LOG_LEVEL'] >= 2)
            Log::Write("[Warning]: $message");
    }

    public static function Critical($message) {

        global $_settings;

        if ($_settings['LOG_LEVEL'] >= 3)
            Log::Write("[Critical]: $message");
    }

    public static function Debug($message) {

        global $_settings;

        if ($_settings['LOG_LEVEL'] >= 4)
            Log::Write("[Debug]: $message");
    }

    public static function Write($string) {

        if (trim($string,"\n") == $string)
            $string = "$string\n";
        
        global $_settings;

        try {
            file_put_contents($_settings['LOG_FILE'], date("Y-m-d H:i:s")." - $string", FILE_APPEND | LOCK_EX);
        } catch (\Throwable $t) {
            \App\Error($t->getMessage()." at ".$t->getFile().":".$t->getLine()."\n");
        }
    }
}