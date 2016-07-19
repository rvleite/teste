




<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
            <div class="span12">    


			
		<div class="widget-header">											
		
	 	<form action="home.php?acao=vincular_usuario" method="post" enctype="multipart/form-data" class="navbar-search pull-left">

         <h3> PESQUISAR USUÁRIOS: </h3>	<input type="text" name="palavra-busca" class="search-query" placeholder="pesquisar">

		
       	</form>

		<div class="control-group">
												
		</div>
       
       	</div>

</div>


                <div class="span12">
                    <div class="widget widget-table action-table">
                <div class="widget-header"> <i class="icon-th-list"></i>
                    <h3>Usuários a serem vínculados</h3>
                </div>
                <!-- /widget-header -->
                <div class="widget-content">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                       		<th> Nº</th>
                            <th> Nome do Usuário</th>
                            <th> E-mail</th>
                            <th> Foto</th>
                            <th> Login</th>
                          
                            
                            
                            
                            <th class="td-actions">Edição </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
						include("functions/limita-texto.php");

						if(isset($_POST['palavra-busca'])){

							$busca = $_POST['palavra-busca'];
							$select = "SELECT * from usuarios WHERE nome LIKE '%$busca%' OR email LIKE '%$busca%' OR login LIKE '%$busca%' OR cpf LIKE '%$busca%' ORDER BY id DESC ";

						}else{

                        $select = "SELECT * from usuarios ORDER BY id DESC ";

                    	}	

						$contagem = 1;
							try {
							$result = $conn->prepare($select);
							$result->execute();
							$contar = $result->rowCount();
						
								if($contar>0){
									while ($mostrar = $result->FETCH(PDO::FETCH_OBJ)){
									
               ?>         
                        <tr>
                        	<td> <?php echo $contagem++?> </td>
                            <td> <?php echo $mostrar-> nome?> </td>
                            <td> <?php echo $mostrar-> email?> </td>
                            <td> <img src="upload/inscritos/<?php echo $mostrar->foto;?>" width="50" height="30"/></td>
                            <td> <?php echo $mostrar-> login?> </td>
                            
                           
                            <td class="td-actions"><a href="home.php?acao=vincular&id=<?php echo $mostrar-> id;?>" class="btn btn-small btn-success"><i class="btn-icon-only icon-edit"> </i></a></td>
                        </tr>
                        
<?php
}
								}else{
								echo '<div class="alert alert-danger">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>AVISO!</strong> Não existe usuarios cadastrado!  </div>';
								
							 }
							}catch (Exception $e) {
							echo $e;
}
?>
                        </tbody>
                    </table>
                </div>
                <!-- /widget-content -->
            </div>
            <!-- /widget -->

                    
                </div><!-- span 12 -->


            </div><!-- row -->


            

        </div>
        <!-- /span6 -->
    </div>
    <!-- /row -->
</div>
<!-- /container -->
</div>
<!-- /main-inner -->
</div>
<!-- /main -->