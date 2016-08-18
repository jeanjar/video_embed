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