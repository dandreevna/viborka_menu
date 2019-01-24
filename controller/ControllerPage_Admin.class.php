<?php

class ControllerPage_Admin
{

    public function Admin()
    {
        $content_page = file_get_contents(Config::get('path_pages').'/admin/index.php');
        return $content_page;
    }

}