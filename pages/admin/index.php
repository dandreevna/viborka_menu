<script src="/js/script_admin.js"></script>

<main>

    <div class="zastavka_ajax">
        <div class="wrap_img">
            <img src="/img/preloader.gif"/>
        </div>
    </div>      

    <div id="tabContainer_admin">
        <ul>
          <li><a href="#panel1">new бл.</a></li>
          <li><a href="#panel3">new прод.</a></li>
          <li><a href="#panel5">new кат.</a></li>
          <li><a href="#panel2">del бл.</a></li>
          <li><a href="#panel4">del прод.</a></li>        
          <li><a href="#panel6">del кат.</a></li>
          </ul>
        <div id="panel1">
            <h2>Введите название нового блюда:</h2>
            <input type="text" name="dob_bludo" id="name_food">
            <div>
                <div id="food_float">             
                    <h2 id="prod_vib">Выберете продукты:</h2>                
                    <div class="list_products_forFood list_admin">
                        <div class="item_product_forFood">
                            <input type="checkbox" class="product_forFood" name="">
                            <span class="name_product_forFood"></span>
                        </div>
                    </div> 
                </div>
                
                <div>
                    <h2>Выберете категорию:</h2>         
                    <div class="list_category_forFood list_admin">
                        <div class="item_category_forFood">
                            <input type="radio" class="category_forFood" name="cat" value="">
                            <span class="name_category_forFood"></span>
                        </div>
                    </div>
                </div>
            </div>    
            <input  type="submit"  class="btn_admin add_food" value="Добавить блюдо"> 
            <div class="res_food">
            </div>  
        </div>
        <div id="panel2">
            <h2>Выберете блюда, которые хотите удалить</h2>       
            <div class="list_food list_admin">
                <div class="item_food">
                    <input type="checkbox" class="choice_food" name="food" value="">
                    <span class="name_food"></span>
                </div>
            </div>
        
            <input type="submit" name="delete_food" class="btn_admin delete_food" value="Удалить">
                           
            <div class="res_food">
            </div>
        </div>
        <div id="panel3">
                <h2>Название нового продукта:</h2>
                <input type="text" id="name_prod" name="dob_prod"><br>
                <input type="submit" name="add_prod" class="btn_admin add_prod" value="Добавить"> 
            <div class="res_prod">
            </div> 
        </div>
        <div id="panel4">
            <h2>Выберете продукты, которые хотите удалить</h2>
            <div class="list_products list_admin">
                <div class="item_product">
                    <input type="checkbox" class="choice_product" name="">
                    <span class="name_product"></span>
                </div>
            </div>
            <input type="submit" class="btn_admin delete_prod" name="delete_prod" value="Удалить">
            <div class="res_prod">
            </div> 
        </div>
        <div id="panel5">
            <h2>Название новой категории:</h2>
            <input type="text" id="name_cat" name="dob_kat"><br>                
            <input type="submit" name="subm_dob_kat" class="btn_admin add_cat" value="Добавить">
            <div class="res_cat">
            </div>
        </div>
        <div id="panel6">
            <h2>Выберете категории, которые хотите удалить</h2>
            <div class="list_category list_admin">
                <div class="item_category">
                    <input type="checkbox" class="category" name="">
                    <span class="name_category"></span>
                </div>
            </div>
            <input type="submit" class="btn_admin delete_cat" name="subm_ud_kat" value="Удалить">                 
            <div class="res_cat">
            </div> 
        </div>
    </div>

</main>









