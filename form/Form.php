<?php

namespace morlowsk\corephp\form;
use morlowsk\corephp\Model;

/**
 * Summary of Form
 * @author Michal Orlowski
 * @copyright (c) 2023
 */
class Form
{
    public static function begin($action, $method)
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Form();
    }

    public static function end()
    {
        return '</form>';
    }

    public function field(Model $model, $attribute)
    {
        return new InputField($model, $attribute);
    }
}