<?php

class ControllerBd
{
    function __construct()
    {
        $resInfo = db::getInstance()->Connect(Config::get('db_user'), Config::get('db_password'), Config::get('db_base'), Config::get('db_host'), Config::get('db_port'));
        if ($resInfo["status"] === "Error") {
            echo $resInfo["message"];
            echo " - " . $resInfo["PDOException_message"];
            exit;
        }

    }

//-----------------------------------Страница пользователя-----------------------------------------

    public function getNameFood() {
        $sql_query = "SELECT name FROM food ORDER BY name";
        $res_query = db::getInstance()->Query($sql_query);
        if ($res_query["status"] === "Succes") {
            return [
                "status" => "Succes",
                "data" => $res_query["data"]->fetchAll()
            ];
        }
        return [
                "status" => "Error",
                "message" => "Ошибка запроса!"
            ];      
    }

    public function getIdFood() {
        $sql_query = "SELECT id FROM food ORDER BY name";
        $res_query = db::getInstance()->Query($sql_query);
        if ($res_query["status"] === "Succes") {
            return [
                "status" => "Succes",
                "data" => $res_query["data"]->fetchAll()
            ];
        }
        return [
                "status" => "Error",
                "message" => "Ошибка запроса!"
            ];
    }

    public function getNameProducts() {
        $sql_query = "SELECT name FROM products ORDER BY name";
        $res_query = db::getInstance()->Query($sql_query);
        if ($res_query["status"] === "Succes") {
            return [
                "status" => "Succes",
                "data" => $res_query["data"]->fetchAll()
            ];
        }
        return [
                "status" => "Error",
                "message" => "Ошибка запроса!"
            ];
    }

    public function getIdProducts() {
        $sql_query = "SELECT id FROM products ORDER BY name";
        $res_query = db::getInstance()->Query($sql_query);
        if ($res_query["status"] === "Succes") {
            return [
                "status" => "Succes",
                "data" => $res_query["data"]->fetchAll()
            ];
        }
        return [
                "status" => "Error",
                "message" => "Ошибка запроса!"
            ];
    }

    public function getNameCategory() {
        $sql_query = "SELECT name FROM category ORDER BY name";
        $res_query = db::getInstance()->Query($sql_query);
        if ($res_query["status"] === "Succes") {
            return [
                "status" => "Succes",
                "data" => $res_query["data"]->fetchAll()
            ];
        }
        return [
                "status" => "Error",
                "message" => "Ошибка запроса!"
            ];
    }

    public function getNameCategoryWithID() {
        $sql_query = "SELECT id, name FROM category ORDER BY name";
        $res_query = db::getInstance()->Query($sql_query);
        if ($res_query["status"] === "Succes") {
            return [
                "status" => "Succes",
                "data" => $res_query["data"]->fetchAll()
            ];
        }
        return [
                "status" => "Error",
                "message" => "Ошибка запроса!"
            ];
    }

    public function getNameFoodWithID() {
        $sql_query = "SELECT id, name FROM food ORDER BY name";
        $res_query = db::getInstance()->Query($sql_query);
        if ($res_query["status"] === "Succes") {
            return [
                "status" => "Succes",
                "data" => $res_query["data"]->fetchAll()
            ];
        }
        return [
                "status" => "Error",
                "message" => "Ошибка запроса!"
            ];
    }

    public function getNameProductsWithID() {
        $sql_query = "SELECT id, name FROM products ORDER BY name";
        $res_query = db::getInstance()->Query($sql_query);
        if ($res_query["status"] === "Succes") {
            return [
                "status" => "Succes",
                "data" => $res_query["data"]->fetchAll()
            ];
        }
        return [
                "status" => "Error",
                "message" => "Ошибка запроса!"
            ];
    }
    
    public function getIdCategory() {
        $sql_query = "SELECT id FROM category ORDER BY name";
        $res_query = db::getInstance()->Query($sql_query);
        if ($res_query["status"] === "Succes") {
            return [
                "status" => "Succes",
                "data" => $res_query["data"]->fetchAll()
            ];
        }
        return [
                "status" => "Error",
                "message" => "Ошибка запроса!"
            ];
    }

    public function getNameFoodByCategory($category) {
        $sql_query = "SELECT name FROM food WHERE category = $category ORDER BY name";
        $res_query = db::getInstance()->Query($sql_query);
        if ($res_query["status"] === "Succes") {
            return [
                "status" => "Succes",
                "data" => $res_query["data"]->fetchAll()
            ];
        }
        return [
                "status" => "Error",
                "message" => "Ошибка запроса!"
            ];
    }

    public function getIdFoodByCategory($category) {
        $sql_query = "SELECT id FROM food WHERE category = $category ORDER BY name";
        $res_query = db::getInstance()->Query($sql_query); 
        if ($res_query["status"] === "Succes") {
            return [
                "status" => "Succes",
                "data" => $res_query["data"]->fetchAll()
            ];
        }
        return [
                "status" => "Error",
                "message" => "Ошибка запроса!"
            ];   
    }

    public function getNameProductsByFood($food) {
        $sql_query = "SELECT product FROM catalog WHERE food = $food";
        $res_query = db::getInstance()->Query($sql_query); 

        if ($res_query["status"] === "Error") {
            return [
                "status" => "Error",
                "message" => "Ошибка первого запроса!"
            ];
        }

        $id_products = $res_query["data"]->fetchAll();
        $name_str="";
        for ($i=0; $i<count($id_products); $i++){
            $name_str .= "(id = ";
            $name_str .= $id_products[$i]["product"];
            $name_str .= ")";
            if ($i < count($id_products)-1){
                $name_str .=" or ";
            }
        }

        $sql_query2 = "SELECT name
            FROM products
            WHERE  $name_str";

        $res_query2 = db::getInstance()->Query($sql_query2); 

        if ($res_query["status"] === "Succes") {
            return [
                "status" => "Succes",
                "data" => $res_query2["data"]->fetchAll()
            ];
        }

        return [
                "status" => "Error",
                "message" => "Ошибка второго запроса!"
            ];   
    }

    public function getFoodsNotIncludProducts($products = array()) {
        $products_str = implode(",", $products);
        
        $sql_query =
        "
        CREATE TEMPORARY TABLE tmp AS (
            SELECT food, product
            FROM catalog
            WHERE product IN($products_str)
            GROUP BY food
        )
        ";

        $res_query1 = db::getInstance()->Query($sql_query);

        if ($res_query1["status"] === "Error") {
            return [
                "status" => "Error",
                "message" => "Ошибка первого запроса!"
            ];
        }

        $sql_query = "SELECT food FROM tmp";
        $res_query2 = db::getInstance()->Query($sql_query);
    
        if ($res_query2["status"] === "Error") {
            return [
                "status" => "Error",
                "message" => "Ошибка второго запроса!"
            ];
        }

        $foods = $res_query2["data"]->fetchAll();
    
        $foods_str="";
        for ($i=0; $i<count($foods); $i++){
            $foods_str .= $foods[$i]["food"];
            if ($i < count($foods)-1){
                $foods_str .=",";
            }
        }

        $sql_query = "SELECT food
            FROM catalog
            WHERE food not IN($foods_str)
            GROUP BY food";
        $res_query3 = db::getInstance()->Query($sql_query);

        if ($res_query3["status"] === "Error") {
            return [
                "status" => "Error",
                "message" => "Ошибка третьего запроса!"
            ];
        }

        $id = $res_query3["data"]->fetchAll();

        $name_str="";
        for ($i=0; $i<count($id); $i++){
            $name_str .= "(id = ";
            $name_str .= $id[$i]["food"];
            $name_str .= ")";
            if ($i < count($id)-1){
                $name_str .=" or ";
            }
        }

        $sql_query = "SELECT name
            FROM food
            WHERE  $name_str";

        $res_query4 = db::getInstance()->Query($sql_query);

        if ($res_query4["status"] === "Succes") {
            return [
                "status" => "Succes",
                "data" => $res_query4["data"]->fetchAll()
            ];
        }

        return [
                "status" => "Error",
                "message" => "Ошибка четвертого запроса!"
            ];
    }

    public function getFoodsIncludProducts($products = array()) {

        $products_str = implode(",", $products);
        
        $sql_query =
        "
        CREATE TEMPORARY TABLE tmp AS (
            SELECT food,
                COUNT(*) as count
            FROM catalog
            WHERE product IN($products_str)
            GROUP BY food
        )
        ";

        $res_query1 = db::getInstance()->Query($sql_query);
        
        if ($res_query1["status"] === "Error") {
            return [
                "status" => "Error",
                "message" => "Ошибка первого запроса!"
            ];
        }

        $count_products = count($products);

        $sql_query = "SELECT tmp.food, food.name FROM tmp,food WHERE count=$count_products and tmp.food=food.id";

        $res_query2 = db::getInstance()->Query($sql_query);
        
        if ($res_query2["status"] === "Succes") {
            return [
                "status" => "Succes",
                "data" => $res_query2["data"]->fetchAll()
            ];
        }

        return [
                "status" => "Error",
                "message" => "Ошибка второго запроса!"
            ];
    }

    public function getFullCatalog() {
        $sql_query = "SELECT * FROM catalog";
        $fullCatalog_array = db::getInstance()->Select($sql_query);
        return $fullCatalog_array;
    }

    public function getProductByCategory($category) {
        $sql_query = "SELECT id FROM food WHERE category = $category";
        $res_query1 = db::getInstance()->Query($sql_query); 
        if ($res_query1["status"] === "Error") {
            return [
                "status" => "Error",
                "message" => "Ошибка запроса!"
            ];
        }

        $id_foods = $res_query1["data"]->fetchAll();
        return $id_foods[2]["id"];
    }

//-----------------------------------Страница для админа-----------------------------------------

    public function addCategory($name_cat) {
        $name_cat = htmlspecialchars($name_cat);
        $sql_query_rep = "SELECT  COUNT(*) FROM `category` WHERE `name` = '$name_cat'";
        
        $res_query_rep = db::getInstance()->Query($sql_query_rep); 

        $count = $res_query_rep["data"]->fetchAll()[0]["COUNT(*)"];
        if ($count==0){
            $sql_query = "INSERT INTO `category` (`name`) VALUES ('$name_cat')";
            
            $res_query = db::getInstance()->Query($sql_query);        

            if ($res_query["status"] === "Succes") {
                return [
                    "status" => "Succes",
                    "message" => "Категория добавена!"
                ];
            }
            return [
                    "status" => "Error",
                    "message" => "Ошибка запроса!"
                ];
        }else{
            return [
                    "status" => "Succes",
                    "message" => "Данная категория уже добавлена!"
                ];
        }   
    }

    public function addProduct($name_prod) {
        $name_prod = htmlspecialchars($name_prod);
        $sql_query_rep = "SELECT  COUNT(*) FROM `products` WHERE `name` = '$name_prod'";
        $res_query_rep = db::getInstance()->Query($sql_query_rep);
        $count = $res_query_rep["data"]->fetchAll()[0]["COUNT(*)"];
        if ($count==0){
            $sql_query = "INSERT INTO `products` (`name`) VALUES ('$name_prod')";
            $res_query = db::getInstance()->Query($sql_query); 
            if ($res_query["status"] === "Succes") {
                return [
                    "status" => "Succes",
                    "message" => "Продукт добавлен!"
                ];
            }
            return [
                    "status" => "Error",
                    "message" => "Ошибка запроса!"
                ];   
        }else{
            return [
                    "status" => "Succes",
                    "message" => "Данный продукт уже добавлен!"
                ];
        }   
    }

    public function addFood($parm) {
        $parm[0] = htmlspecialchars($parm[0]);  
        $sql_query_rep = "SELECT COUNT(*) FROM `food` WHERE `name` = '$parm[0]'";
        $res_query_rep = db::getInstance()->Query($sql_query_rep);
        $count = $res_query_rep["data"]->fetchAll()[0]["COUNT(*)"];
        if ($count==0){
            $category = $parm[1];
            $name_food = $parm[0];
            $sql_query1 = "SELECT MAX(id) AS id FROM food";
            $res_query1 = db::getInstance()->Query($sql_query1); 
            $idmax = $res_query1["data"]->fetchAll()[0]["id"];
            $idmax++;

            if ($res_query1["status"] === "Error") {
                return [
                    "status" => "Error",
                    "message" => "Ошибка первого запроса!"
                ];
            }

            $sql_query2 = "INSERT INTO `food` (`name`,`category`) VALUES ('$name_food', '$category')";
            $res_query2 = db::getInstance()->Query($sql_query2); 
            
            if ($res_query2["status"] === "Error") {
                return [
                    "status" => "Error",
                    "message" => "Ошибка второго запроса!"
                ];
            }

            for($i = 2; $i < count($parm); $i++){
                $sql_query3 = "INSERT INTO `catalog` (`food`,`product`) VALUES ('$idmax', '$parm[$i]')";
                $res_query3 = db::getInstance()->Query($sql_query3);
            }

            if ($res_query3["status"] === "Error") {
                return [
                    "status" => "Error",
                    "message" => "Ошибка третьего запроса!"
                ];
            }

            return [
                    "status" => "Succes",
                    "message" => "Блюдо добавлено!"
                ];

        }else{
            return [
                    "status" => "Succes",
                    "message" => "Данное блюдо уже добавлено!"
                ];
        }        
        
    }
    
    public function deleteCategory($id_category) {

        for($i = 0; $i < count($id_category); $i++){
            $sql_query1 = "DELETE FROM `category` WHERE id = $id_category[$i]";
            $res_query1 = db::getInstance()->Query($sql_query1);
            if ($res_query1["status"] === "Error") {
                return [
                    "status" => "Error",
                    "message" => "Ошибка 1 запроса!"
                ];
            }

            $sql_query2 = "SELECT `id` FROM `food` WHERE `category`=$id_category[$i]";
            $res_query2 = db::getInstance()->Query($sql_query2);
            if ($res_query2["status"] === "Error") {
                return [
                    "status" => "Error",
                    "message" => "Ошибка 2 запроса!"
                ];
            }
            $id_food = $res_query2["data"]->fetchAll();
            if (count($id_food)!=0){
                $id_str="";
                for ($j=0; $j<count($id_food); $j++){
                    $id_str .= "(id = ";
                    $id_str .= $id_food[$j]["id"];
                    $id_str .= ")";
                    if ($j < count($id_food)-1){
                        $id_str .=" or ";
                    }
                }
                $sql_query3 = "UPDATE food SET `category`=0 WHERE $id_str";
                $res_query3 = db::getInstance()->Query($sql_query3);
                if ($res_query3["status"] === "Error") {
                    return [
                        "status" => "Error",
                        "message" => "Ошибка 3 запроса!"
                    ];
                }
            }
        }

        return [
                "status" => "Succes",
                "message" => "Категории удалены!"
            ];
    }

    public function deleteProduct($id_product) {

        $id_str="";
        $product_str="";

        for ($j=0; $j<count($id_product); $j++){
            $id_str .= "(id = ";
            $id_str .= $id_product[$j];
            $id_str .= ")";
            $product_str .= "(product = ";
            $product_str .= $id_product[$j];
            $product_str .= ")";
            if ($j < count($id_product)-1){
                $id_str .=" or ";
                $product_str .=" or ";
            }
        }
        
        $sql_query1 = "DELETE FROM `products` WHERE $id_str";
        $res_query1 = db::getInstance()->Query($sql_query1);

        if ($res_query1["status"] === "Error") {
            return [
                "status" => "Error",
                "message" => "Ошибка первого запроса!"
            ];
        }

        $sql_query2 = "DELETE FROM `catalog` WHERE $product_str";
        $res_query2 = db::getInstance()->Query($sql_query2);

        if ($res_query2["status"] === "Error") {
            return [
                "status" => "Error",
                "message" => "Ошибка первого запроса!"
            ];
        }

        return [
                "status" => "Succes",
                "message" => "Продукты удалены!"
            ];
     }

    public function deleteFood($id_Food) {
        $id_str="";
        $food_str="";

        for ($j=0; $j<count($id_Food); $j++){
            $id_str .= "(id = ";
            $id_str .= $id_Food[$j];
            $id_str .= ")";
            $food_str .= "(food = ";
            $food_str .= $id_Food[$j];
            $food_str .= ")";
            if ($j < count($id_Food)-1){
                $id_str .=" or ";
                $food_str .=" or ";
            }
        }
        
        $sql_query1 = "DELETE FROM `food` WHERE $id_str";
        $res_query1 = db::getInstance()->Query($sql_query1);

        if ($res_query1["status"] === "Error") {
            return [
                "status" => "Error",
                "message" => "Ошибка первого запроса!"
            ];
        }

        $sql_query2 = "DELETE FROM `catalog` WHERE $food_str";
        $res_query2 = db::getInstance()->Query($sql_query2);

        if ($res_query2["status"] === "Error") {
            return [
                "status" => "Error",
                "message" => "Ошибка первого запроса!"
            ];
        }
        
        return [
                "status" => "Succes",
                "message" => "Блюда удалены!"
            ];
    }

    public function getNameCategoryByFood($food_name) {
        $sql_query1 = "SELECT category FROM food WHERE name = '$food_name'";
        $res_query1 = db::getInstance()->Query($sql_query1); 
        if ($res_query1["status"] === "Error") {
            return [
                "status" => "Error",
                "message" => "Ошибка первого запроса!"
            ];
        }

        $id_category = $res_query1["data"]->fetchAll()[0]["category"];

        if ($id_category == 0){
            return [
                "status" => "Succes",
                "data" => "категория не выбрана"
            ];
        }

        $sql_query2 = "SELECT name FROM category WHERE id = $id_category";
        $res_query2 = db::getInstance()->Query($sql_query2); 
        if ($res_query1["status"] === "Error") {
            return [
                "status" => "Error",
                "message" => "Ошибка второго запроса!"
            ];
        }

        $name_category = $res_query2["data"]->fetchAll()[0]["name"];
        return [
                "status" => "Succes",
                "data" => $name_category
            ];
    }
    
}