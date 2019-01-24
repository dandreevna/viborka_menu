<?php

class ControllerPage_Food
{

    public function Food()
    {
        $content_page = file_get_contents(Config::get('path_pages').'/food/index.php');
        return $content_page;
    }

}