<?php

class ControllerPage_Info{

    public function Info()
    {
        $content_page = file_get_contents(Config::get('path_pages').'/info/index.php');
        return $content_page;
    }

}