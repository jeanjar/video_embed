<?php

namespace VideoEmbed\Providers;

use VideoEmbed\VideoEmbed;

class Vimeo
{
    public static function render($url, $params = [])
    {
        $query = explode('/', $url);
        $id = end($query);
        $realParams = '';

        if(f($params, 'return_id'))
        {
            return $id;
        }

        if (!empty($params))
        {
            foreach ($params as $param => $value)
            {
                if (is_int($param))
                {
                    $realParams .= $value . ' ';
                }
                else
                {
                    $realParams .= $param . '="' . $value . '" ';
                }
            }
        }
        return '<iframe src="//player.vimeo.com/video/' . $id . '"' . $realParams . '></iframe>';
    }
}