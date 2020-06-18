<?php

spl_autoload_register(
    function ($className) {
        if (class_exists($className, false)) {
            return;
        }

        if (file_exists('./classes/' . $className . '.php')) {
            include_once './classes/' . $className . '.php';
        } elseif (file_exists('./Controllers/' . $className . '.php')) {
            include_once './Controllers/' . $className . '.php';
        } else {
            throw new Exception('File ' . $className . ' not found.');
        }

        if (!class_exists($className, false)) {
            throw new Exception('Class ' . $className . ' not found.');
        }
    }
);
