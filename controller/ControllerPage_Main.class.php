<?php

class ControllerPage_Main
{

    public function Main()
    {
        $content_page = file_get_contents(Config::get('path_pages').'/main/index.php');
        return $content_page;
    }

}