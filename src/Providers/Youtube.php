<?php

namespace VideoEmbed\Providers;

class Youtube
{

    public static function getSimpleThumbnail($id)
    {
        return sprintf('http://img.youtube.com/vi/%s/hqdefault.jpg', $id);
    }

    public static function render($url, $params = array())
    {
        $parsed = parse_url(trim($url));
        if (f($parsed, 'host') == 'youtu.be')
        {
            $embed = str_replace('/', '', f($parsed, 'path'));
        }
        elseif (in_array(f($parsed, 'host'), array('youtube.com', 'www.youtube.com')))
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

        if (f($params, 'return_id'))
        {
            return $embed;
        }

        if(f($params, 'return_thumbnail'))
        {
            return self::getSimpleThumbnail($embed);
        }

        return '<iframe width="' . f($params, 'width') . '" height="' . f($params, 'height') . '" src="//www.youtube.com/embed/' . $embed . '" frameborder="0" allowfullscreen></iframe>';
    }

}