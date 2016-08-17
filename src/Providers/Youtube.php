<?php

namespace VideoEmbed\Providers;

use VideoEmbed\VideoEmbed;

class Youtube
{
    public static function render($url, $params = array())
    {
        $parsed = parse_url($url);
        if (VideoEmbed::f($parsed, 'host') == 'youtu.be')
        {
            $embed = str_replace('/', '', VideoEmbed::f($parsed, 'path'));
        }
        elseif (in_array(VideoEmbed::f($parsed, 'host'), array('youtube.com', 'www.youtube.com')))
        {
            $query = explode('&', $parsed['query']);
            $id = false;
            foreach ($query as $q)
            {
                if (substr($q, 0, 2) == 'v=')
                {
                    $id = $q;
                    break;
                }
            }
            if (!$id)
            {
                return '';
            }
            $embed = str_replace('v=', '', $id);
        }
        else
        {
            return false;
        }

        if (VideoEmbed::f($params, 'return_id'))
        {
            return $embed;
        }

        return '<iframe width="' . VideoEmbed::f($params, 'width') . '" height="' . VideoEmbed::f($params, 'height') . '" src="//www.youtube.com/embed/' . $embed . '" frameborder="0" allowfullscreen></iframe>';
    }

}