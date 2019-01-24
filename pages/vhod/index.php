<main class="info">
	<script type="text/javascript">
		$(function(){  
			$('.btn_vhod').button();
		});
	</script>
	<center>
		<br>
		<h1>Вход на страницу администратора</h1>
		<br>
		<form method="POST" action="/admin/">
			<table>
				<tr>
			        <td><p class="vhod">Логин:</td>
			        <td><input type="text" name="username"></p></td>
			    </tr>
			    <tr>    
			        <td><p class="vhod">Пароль:</td> 
			        <td><input type="text" name="password"></p></td>
			    </tr>
	        </table>
	        <input type="submit" value="Вход" class="btn_vhod"> 
	        <br>
	        <br>
	    </form>
	</center>
</main>

