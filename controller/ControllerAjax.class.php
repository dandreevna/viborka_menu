<?php

class ControllerAjax
{
    private $utm_source = '';
    private $controllerBd;

    function __construct()
    {
        $this->controllerBd = new ControllerBd();
    }

//-----------------------------------Страница пользователя-----------------------------------------

    public function get_NameFoodByCategory($category) {
        $res = $this->controllerBd->getNameFoodByCategory($category);
        if ($res["status"] === "Succes") {
            return $res["data"];
        } else {
            //здесь обработка в случае ошибки
            return $res["message"];
        }
    }

    public function get_NameFoodWithID() {
        $res = $this->controllerBd->getNameFoodWithID();
        if ($res["status"] === "Succes") {
            return $res["data"];
        } else {
            //здесь обработка в случае ошибки
            return $res["message"];
        }
    }

    public function get_NameProductsByFood($food) {
        $res = $this->controllerBd->getNameProductsByFood($food);
        if ($res["status"] === "Succes") {
            return $res["data"];
        } else {
            //здесь обработка в случае ошибки
            return $res["message"];
        }
    }

    public function get_Category() {
        $res_listCategory = $this->controllerBd->getNameCategoryWithID();
        if ($res_listCategory["status"] === "Succes") {
            return $res_listCategory["data"];
        } else {
            //здесь обработка в случае ошибки 
            return $res_listCategory["message"];
        }
    }

    public function get_Products() {
        $res_listProducts = $this->controllerBd->getNameProductsWithID();
        if ($res_listProducts["status"] === "Succes") {
            return $res_listProducts["data"];
        } else {
            //здесь обработка в случае ошибки 
            return $res_listProducts["message"];
        }
    }

    public function get_FoodsIncludProducts($products) {
        $res = $this->controllerBd->getFoodsIncludProducts($products);
        if ($res["status"] === "Succes") {
            return $res["data"];
        } else {
            //здесь обработка в случае ошибки 
            return $res["message"];
        }
    }

    public function get_FoodsNotIncludProducts($products) {
        $res = $this->controllerBd->getFoodsNotIncludProducts($products);
        if ($res["status"] === "Succes") {
            return $res["data"];
        } else {
            //здесь обработка в случае ошибки 
            return $res["message"];
        }
    }

    public function get_IdProducts() {
        $res = $this->controllerBd->getIdProducts();
        if ($res["status"] === "Succes") {
            return $res["data"];
        } else {
            //здесь обработка в случае ошибки 
            return $res["message"];
        }
    }

//-----------------------------------Страница для админа-----------------------------------------

    public function delete_Food($id_Food) {
        $res = $this->controllerBd->deleteFood($id_Food);
        if ($res["status"] === "Succes") {
            return $res["message"];
        } else {
            //здесь обработка в случае ошибки 
            return $res["message"];
        }
    }

    public function add_Food($parm) {
        $res = $this->controllerBd->addFood($parm);
        if ($res["status"] === "Succes") {
            return $res["message"];
        } else {
            //здесь обработка в случае ошибки 
            return $res["message"];
        }
    }

    public function add_Product($name_prod) {
        $res = $this->controllerBd->addProduct($name_prod);
        if ($res["status"] === "Succes") {
            return $res["message"];
        } else {
            //здесь обработка в случае ошибки 
            return $res["message"];
        }
    }

    public function delete_Product($id_product) {
        $res = $this->controllerBd->deleteProduct($id_product);
        if ($res["status"] === "Succes") {
            return $res["message"];
        } else {
            //здесь обработка в случае ошибки 
            return $res["message"];
        }
    }

    public function add_Category($name_cat) {
        $res = $this->controllerBd->addCategory($name_cat);
        if ($res["status"] === "Succes") {
            return $res["message"];
        } else {
            //здесь обработка в случае ошибки 
            return $res["message"];
        }
    }

    public function delete_Category($id_category) {
        $res = $this->controllerBd->deleteCategory($id_category);
        if ($res["status"] === "Succes") {
            return $res["message"];
        } else {
            //здесь обработка в случае ошибки 
            return $res["message"];
        }
    }

    public function get_NameCategoryByFood($food_name) {
        $res = $this->controllerBd->getNameCategoryByFood($food_name);
        if ($res["status"] === "Succes") {
            return $res["data"];
        } else {
            //здесь обработка в случае ошибки 
            return $res["message"];
        }
    }
}