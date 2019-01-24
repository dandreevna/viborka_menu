<script src="/js/script_main.js"></script>
<script src="/js/jquery.ui.touch-punch.min.js"></script>

<main class="main_page">

	<div class="zastavka_ajax">
		<div class="wrap_img">
			<img src="/img/preloader.gif"/>
		</div>
	</div>
	<center>
		<div id="tabContainer">
			<ul>
			  <li><a href="#panel1">Категории</a></li>
			  <li><a href="#panel2">Продукты</a></li>
			  </ul>
			<!-- panel 1 -->
			<div id="panel1">
			  	<div class="list_category">
					<div class="item_category">
						<input type="radio" class="choice_category" name="cat" value="">
						<div class="name_category" name=""></div>
					</div>
				</div>
			</div>
			<!-- panel 2 -->
			<div id="panel2">
			  	<div class="list_products">
					<div class="item_product">
						<div class="name_product" name="">
						</div>
						<input type="radio" class="nz" name="" checked>
				        <input type="radio" class="vkl" name="">	
				        <input type="radio" class="iskl" name="">	
					</div> 
		        </div> 
			</div>
		</div>
		
		<div class="block_btn">
			<input class="btn" type="submit" name="subm" id="subm" value="Показать результаты"> 
			<input class="btn_new" type="submit" name="subm_new" id="subm_new" value="New">
		</div>
	</center>	
	
	<div id="rez_modal" title="Найденные блюда">	
		<div class="block_res">
			<div class="res">		
	        </div> 
		</div>
	</div>

</main>