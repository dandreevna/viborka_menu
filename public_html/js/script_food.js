$(function(){  
    let $dev_res = $(".res");
    let $zastavka = $(".zastavka_ajax");

//----------------------------------выбор блюд - ui-----------------------------------------

    $('#tabContainer').tabs({
        beforeActivate : function(evt) {
            location.hash=$(evt.currentTarget).attr('href');
        },
        show: 'fadeIn'
    });//end tabs
    
    $('#subm').button();

    $('#rez_modal').dialog({
        autoOpen: false,
    });//end dialog

    $('#subm').click(function() {
        $('#rez_modal').dialog('open');
    }); // end click

//----------------------------------Вывод всех блюд-----------------------------------------
        
    let data_send_cat = {
        action: 'ajax',
        func: 'get_NameFoodWithID',
        func_parm: ''
    };

    $.post("/", data_send_cat, function(data_back) {

        if (data_back.status == "Succes") {
            //Ajax запрос выполнился успешно
            let listfood = data_back.data;
            $out_content = "";
            if (listfood.length > 0) {

                $div_item = $(".item_food");
                
                for (let i=1; i < listfood.length; i++){
                    $new_item = $div_item.clone().appendTo(".list_food");
                    $new_item.find(".choice_food").attr("value",listfood[i]["id"]); 
                    $new_item.find(".name_food").html(listfood[i]["name"]);
                    $new_item.find(".name_food").attr("name",listfood[i]["id"]);
                }

                $div_item.find(".choice_food").attr("value",listfood[0]["id"]).attr("checked",true);
                $div_item.find(".name_food").html(listfood[0]["name"]);
                $div_item.find(".name_food").attr("name",listfood[0]["id"]);
                $div_item.find(".name_food").css('background','#65E765');

            } else {
                $out_content = "Блюд не найдено!";
                $(".list_food").html($out_content);
            }

        } else {
             //Ajax запрос вернул ошибку...
        }

    }, 'json');
    
// --------------------------Нажатие кнопки Показать состав---------------------------------

    let inputs_food = document.getElementsByName('food');

    $(".btn_food").on("click", function(e) {

        $dev_res.html('');
        // food - номер отмеченного блюда
        let food = 0;
        for (let i=0; i < inputs_food.length; i++) {
            if (inputs_food[i].checked){     
                    food = inputs_food[i].value; 
            }
        }

        let products = [];
        products[0] = 0;

        let data_send = {
            action: 'ajax',
            func: 'get_NameProductsByFood',
            func_parm: food
        };

        $.post("/", data_send, function(data_back) {
            
            for (let i = 0; i < data_back.data.length; i++){
                products[i] = data_back.data[i].name; 
                $dev_res.append(products[i]);
                $dev_res.append('<br>');
            } 
            $zastavka.css("display","none");
            if (products[0] == 0){
                $dev_res.append("Подходящих блюд не обнаружено, измените параметры поиска");
            }

        }, 'json')

    }); //end on

//------------------------------------Выбор блюда-------------------------------------------

    $('.list_food').on('click', '.name_food', function(){
        $('.name_food').each(function(){
            $(this).css('background','#ccc');                     
        }); //end each

        let id_food = $(this).attr("name");
        $('input.choice_food[value='+id_food+']').prop("checked", "true");
        $('.name_food[name='+id_food+']').css('background','#65E765');
          
    }); //end on

}); //end ready

