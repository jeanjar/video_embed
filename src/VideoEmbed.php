<?php

namespace VideoEmbed;

use VideoEmbed\Providers\Vimeo;
use VideoEmbed\Providers\Youtube;

class VideoEmbed
{
    public static function f($type, $variable_name, $filter = FILTER_DEFAULT, $options = null)
    {
        if (is_array($type))
        {
            if (isset($type[$variable_name]))
            {
                return filter_var($type[$variable_name], $filter, $options);
            }
            return null;
        }
        return filter_input($type, $variable_name, $filter, $options);
    }

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