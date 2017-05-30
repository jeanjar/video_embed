<?php

if (!function_exists('f'))
{
    function f($type, $variable_name, $filter = FILTER_DEFAULT, $options = null)
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
}

if(!function_exists('getProtocol'))
{
    function getProtocol()
    {
        $protocol = 'http';
        if(f($_SERVER, 'HTTPS') and f($_SERVER, 'HTTPS') == 'on' and
            f($_SERVER, 'SERVER_PORT') and f($_SERVER,'SERVER_PORT') == '443'
        )
        {
            $protocol .= 's';
        }

        return $protocol;
    }
}