<?php

namespace VideoEmbed;

use VideoEmbed\Providers\Vimeo;
use VideoEmbed\Providers\Youtube;

class VideoEmbed
{

    public static $list = [
        'youtube' => Youtube::class,
        'youtu'   => Youtube::class,
        'vimeo'   => Vimeo::class,
    ];

    public static function render($url, $params = [])
    {
        foreach (self::$list as $host => $class)
        {
            if (preg_match('/' . $host . '/i', $url))
            {
                return call_user_func_array([$class, 'render'], [$url, $params]);
            }
        }
    }
}