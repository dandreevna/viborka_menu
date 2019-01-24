$(function(){

    let $res_food = $(".res_food");
    let $res_prod = $(".res_prod");
    let $res_cat = $(".res_cat");
    let $zastavka = $(".zastavka_ajax");

// ----------------------------Наводим красоту-------------------------------------
    
    $('#tabContainer_admin').tabs({
        beforeActivate : function(evt) {
            location.hash=$(evt.currentTarget).attr('href');
        },
        show: 'fadeIn'
    });//end tabs

    $('.btn_admin').button();

// ------------------- Функция ajax - запроса к серверу ---------------------------

    function func_query(parm, fun, callback) {
        
        let data_send = {
            action: 'ajax',
            func: fun,
            func_parm: parm
        };

        $zastavka.css("display","flex");
        // console.log(data_send);
        $.post("/", data_send, function(data_back) {

            if (data_back.status == "Succes") {                       
                callback(data_back.data);
            } else {
                console.log("ошибка запроса")
                 //Ajax запрос вернул ошибку...
            }
        }, 'json')

        $zastavka.css("display","none");
    }

//------------------------------УДАЛЕНИЕ БЛЮД--------------------------------------
    // --------Вывод чекбоксов с блюдами для выбора блюд, которые надо удалить--
    
        func_query('', 'get_NameFoodWithID', function(listfood) {
            $out_content = "";
            if (listfood.length > 0) {

                $div_item = $(".item_food");
                
                for (let i=1; i < listfood.length; i++){
                    $new_item = $div_item.clone().appendTo(".list_food");
                    $new_item.find(".choice_food").attr("value",listfood[i]["id"]); 
                    $new_item.find(".name_food").html(listfood[i]["name"]);
                }

                $div_item.find(".choice_food").attr("value",listfood[0]["id"]);
                $div_item.find(".name_food").html(listfood[0]["name"]);

            } else {
                $out_content = "Блюд не найдено!";
                $(".list_food").html($out_content);
            }
        });
 
    // -----------------------Нажатие на кнопку удалить-------------------------

        let inputs_delete_food = document.getElementsByClassName('choice_food');

        $(".delete_food").on("click", function(e) {

            // создаем массив mass, состощий из id блюд, которые надо удалить 
            let mass = [];
            mass[0] = -1;
            let j = 0;
            for (let i=0; i < inputs_delete_food.length; i++) {
                if (inputs_delete_food[i].checked){     
                        mass[j] = inputs_delete_food[i].value; 
                        j++;
                }
            }

            // запрос на удаление
            if (mass[0] == -1){
                alert("Выберете блюда!")
            }else{
                func_query(mass, 'delete_Food', function(food) {        
                $res_food.html(food); });
                $('.close').trigger("click");
            }
          
        });
    
//----------------------------ДОБАВЛЕНИЕ БЛЮДА-------------------------------------

    // ----------------------------вывод категорий---------------------

        func_query('', 'get_Category', function(listCat) {        
            $out_content = "";
            if (listCat.length > 0) {

                $div_item = $(".item_category_forFood");
                
                for (let i=0; i < listCat.length; i++){
                    $new_item = $div_item.clone().appendTo(".list_category_forFood");
                    $new_item.find(".category_forFood").attr("value",listCat[i]["id"]); 
                    $new_item.find(".name_category_forFood").html(listCat[i]["name"]);
                }

                $div_item.find(".category_forFood").attr("value",0).attr("checked",true);
                $div_item.find(".name_category_forFood").html("категория не выбрана").attr("checked",true);

            } else {
                $out_content = "Категории отсутствуют!";
                $(".list_category_forFood").html($out_content);
            }
        });
       
    // ----------------------------вывод продуктов---------------------

        func_query('', 'get_Products', function(listProd) {        
            $out_content = "";
            if (listProd.length > 0) {

                $div_item = $(".item_product_forFood");
                
                for (let i=1; i < listProd.length; i++){
                    $new_item = $div_item.clone().appendTo(".list_products_forFood");
                    $new_item.find(".product_forFood").attr("name",listProd[i]["id"]); 
                    $new_item.find(".name_product_forFood").html(listProd[i]["name"]);
                }

                $div_item.find(".product_forFood").attr("name",listProd[0]["id"]);
                $div_item.find(".name_product_forFood").html(listProd[0]["name"]);

            } else {
                $out_content = "Продукты отсутствуют!";
                $(".list_products_forFood").html($out_content);
            }
        });
 
    // --------------------------нажатие кнопки добавить---------------

        let inputs_add_food = document.getElementById('name_food');
        let inputs_add_catrgory_for_food = document.getElementsByClassName('category_forFood');
        let inputs_add_products_for_food = document.getElementsByClassName('product_forFood');

        $(".add_food").on("click", function(e) {

            // создаем массив prod, состощий из id продуктов, которые содержатся в доюавляемом блюде 
            let prod = [];
            prod[0] = -1;
            let j = 0;
            for (let i=0; i < inputs_add_products_for_food.length; i++) {
                if (inputs_add_products_for_food[i].checked){     
                        prod[j] = inputs_add_products_for_food[i].name; 
                        j++;
                }
            }

            // cat - id категории нового блюда
            let cat = 0;

            for (let i=0; i < inputs_add_catrgory_for_food.length; i++) {
                if (inputs_add_catrgory_for_food[i].checked){     
                        cat = inputs_add_catrgory_for_food[i].value; 
                        j++;
                }
            }

            // имя блюда
            name_food = inputs_add_food.value;

        // --------запрос на добавление-----------

            let parm = [];
            parm[0] = name_food;
            parm[1] = cat; 
            for (let i = 0; i<prod.length; i++){
                parm[i+2] = prod[i];
            }              
             
            if ((inputs_add_food.value == "")&&(prod[0]==-1)){
                alert("Введите название блюда и добавьте продукты!");

            }else if ((inputs_add_food.value == "")&&(prod[0]!=-1)){
                alert("Введите название блюда!");

            }else if ((inputs_add_food.value != "")&&(prod[0]==-1)){
                alert("Добавьте продукты!");

            }else {

                func_query(parm, 'add_Food', function(data) {        
                    $res_food.html(data);
                });
                $('.close').trigger("click");

                inputs_add_food.value = "";

                for (let i=0; i < inputs_add_products_for_food.length; i++) {
                    inputs_add_products_for_food[i].checked = false;
                }
                inputs_add_catrgory_for_food[0].checked = true;
                
            }
                     
        });

//---------------------------ДОБАВЛЕНИЕ ПРОДУКТА-----------------------------------

    $(".add_prod").on("click", function(e) {

        // получаем имя продукта
        let name_prod = document.getElementById('name_prod');

        // --------запрос на добавление-----------  

        if (name_prod.value == ""){
            alert("Введите название продукта!");

        }else{

            func_query(name_prod.value, 'add_Product', function(data) {        
                $res_prod.html(data);
            });  

            $('.close').trigger("click");

            name_prod.value = "";
        }
    });

//-----------------------------УДАЛЕНИЕ ПРОДУКТА-----------------------------------

    // -----------------------------вывод продуктов------------------

        func_query('', 'get_Products', function(listProd) {        
            $out_content = "";
            if (listProd.length > 0) {

                $div_item = $(".item_product");
                
                for (let i=1; i < listProd.length; i++){
                    $new_item = $div_item.clone().appendTo(".list_products");
                    $new_item.find(".choice_product").attr("name",listProd[i]["id"]); 
                    $new_item.find(".name_product").html(listProd[i]["name"]);
                }

                $div_item.find(".choice_product").attr("name",listProd[0]["id"]);
                $div_item.find(".name_product").html(listProd[0]["name"]);

            } else {
                $out_content = "Продукты отсутствуют!";
                $(".list_products").html($out_content);
            }
        });

    // ------------------------Нажатие на кнопку удалить-------------

        let inputs_delete_product = document.getElementsByClassName('choice_product');

        $(".delete_prod").on("click", function(e) {

            // создаем массив mass, состощий из id продуктов, которые надо удалить 
            let mass = [];
            mass[0] = -1;
            let j = 0;
            for (let i=0; i < inputs_delete_product.length; i++) {
                if (inputs_delete_product[i].checked){     
                        mass[j] = inputs_delete_product[i].name; 
                        j++;
                }
            }
            // запрос на удаление
            if (mass[0] == -1){
                alert("Выберете продукты!")
            }else{
                func_query(mass, 'delete_Product', function(prod) {        
                    $res_prod.html(prod);
                });

                $('.close').trigger("click");
            }

        });

//----------------------------ДОБАВЛЕНИЕ КАТЕГОРИИ---------------------------------

    $(".add_cat").on("click", function(e) {

        // получаем имя категории
        let name_cat = document.getElementById('name_cat');

        // --------запрос на добавление-----------  

        if (name_cat.value == ""){
            alert("Введите название категории!");

        }else{

            func_query(name_cat.value, 'add_Category', function(data) {        
                $res_cat.html(data);
            });  

            $('.close').trigger("click");

            name_cat.value = "";

        }

    });

//-----------------------------УДАЛЕНИЕ КАТЕГОРИИ----------------------------------

    // -----------------------------вывод категорий------------------

        func_query('', 'get_Category', function(listCat) {        
            $out_content = "";
            if (listCat.length > 0) {

                $div_item = $(".item_category");
                
                for (let i=1; i < listCat.length; i++){
                    $new_item = $div_item.clone().appendTo(".list_category");
                    $new_item.find(".category").attr("name",listCat[i]["id"]); 
                    $new_item.find(".name_category").html(listCat[i]["name"]);
                }

                $div_item.find(".category").attr("name",listCat[0]["id"]);
                $div_item.find(".name_category").html(listCat[0]["name"]);

            } else {
                $out_content = "Категории отсутствуют!";
                $(".list_category").html($out_content);
            }
        });

    // ------------------------Нажатие на кнопку удалить-------------

        let inputs_delete_category = document.getElementsByClassName('category');

        $(".delete_cat").on("click", function(e) {
            // создаем массив mass, состощий из id категорий, которые надо удалить 
            let mass = [];
            mass[0] = -1;
            let j = 0;
            for (let i=0; i < inputs_delete_category.length; i++) {
                if (inputs_delete_category[i].checked){     
                        mass[j] = inputs_delete_category[i].name; 
                        j++;
                }
            }
            // запрос на удаление
            if (mass[0] == -1){
                alert("Выберете категории!")
            }else{
                func_query(mass, 'delete_Category', function(cat) {        
                    $res_cat.html(cat);
                });

                $('.close').trigger("click");
            }

        });
       
}); 

