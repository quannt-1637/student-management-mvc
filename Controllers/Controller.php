<?php

class Controller extends Database
{
    public static function CreateView($viewName)
    {
        include_once "./Views/$viewName.php";
    }

    public static function view($viewName, $variables = [])
    {
        if (count($variables)) {
            extract($variables);
        }

        include_once "./Views/$viewName.php";
    }
}
