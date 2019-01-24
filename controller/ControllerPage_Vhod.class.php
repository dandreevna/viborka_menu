<?php

class ControllerPage_Vhod
{

    public function Vhod()
    {
        $content_page = file_get_contents(Config::get('path_pages').'/vhod/index.php');
        return $content_page;
    }

}