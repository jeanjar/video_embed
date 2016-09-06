<?php

namespace VideoEmbed\Providers;

use VideoEmbed\VideoEmbed;

class Vimeo
{

    public static function getSimpleThumbnail($id)
    {
        $data = json_decode(file_get_contents(sprintf('https://vimeo.com/api/v2/video/%s.json', $id)), true);
        return f($data, 'thumbnail_large');
    }

    public static function render($url, $params = [])
    {
        $query = explode('/', trim($url));
        $id = end($query);
        $realParams = '';

        if(f($params, 'return_id'))
        {
            return $id;
        }

        if(f($params, 'return_thumbnail'))
        {
            return self::getSimpleThumbnail($id);
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