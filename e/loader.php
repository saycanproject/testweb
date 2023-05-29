<?php
class Loader {
    function view($filename, $data = null) {
        if($data) {
            extract($data);
        }

        include ROOT . '/v/' . $filename;
    }

    function model($model) {
        include ROOT . '/m/' . strtolower($model) . '.php';
        return new $model;
    }
}
