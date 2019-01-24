<?php

class ControllerPage_Error404
{

    public function Error404()
    {
        $content_page = file_get_contents(Config::get('path_pages').'/error404/index.php');
        return $content_page;
    }
}