<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
        <div class="span12">    
            
<?php
			//excluir
			if(isset($_GET['delete'])){
			$id_delete = $_GET['delete'];
			
			// seleciona a imagem
			$seleciona = "SELECT * from tb_produtos WHERE id_produto=:id_delete";
			
			try{
				
					$result = $conn->prepare($seleciona);
					$result->bindParam('id_delete',$id_delete,PDO::PARAM_INT);
					$result->execute();
					$contar = $result->rowCount();
					
					if($contar>0){
						
					$loop = $result->fetchAll();
					foreach ($loop as $exibir){
					}
					
					$fotoDeleta = $exibir['imagem'];
					$arquivo ="upload/produtos/".$fotoDeleta;
					unlink($arquivo);
				
				
				//excluir o registro
				
				$seleciona = "DELETE from tb_produtos WHERE id_produto=:id_delete";
				
				try{
					$result = $conn->prepare($seleciona);
					$result->bindParam('id_delete',$id_delete,PDO::PARAM_INT);
					$result->execute();
					$contar = $result->rowCount();
					
						if($contar>0){
						
					echo '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Produto exluido com sucesso!</strong></div>';
			
			}else{
				echo '<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>Erro ao excluir!</strong> Não foi possível realizar o exclusão!  </div>';
								
				 }
		
			}catch (PDOWException $erro){echo $erro;}
			
			}else{
			}
			}catch (PDOWException $erro){echo $erro;}
			
			}
	 ?>	


		<div class="widget-header">											
		
	 	<form action="home.php?acao=viz_produtos" method="post" enctype="multipart/form-data" class="navbar-search pull-left">

         <h3> PESQUISAR PRODUTO: </h3>	<input type="text" name="palavra-busca" class="search-query" placeholder="pesquisar">

		
       	</form>

		<div class="control-group">
												
		</div>
       
       	</div>
		
</div>

                <div class="span12">
                    <div class="widget widget-table action-table">
                <div class="widget-header"> <i class="icon-th-list"></i>
                    <h3>Produtos Cadastrados</h3>
                </div>
                <!-- /widget-header -->
                <div class="widget-content">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                       		<th> Nº</th>
                       		<th> Código de Barras</th>
                            <th> Nome do produto</th>
                            <th> Data</th>
                            <th> Imagem</th>
                            <th> Exibir</th>
                            <th> Preço Vista</th>
                            <th> Preço Cartão</th>
                            <th> Resumo</th>
                            
                            <th class="td-actions">Edição</th>
                        </tr>
                        </thead>
                        <tbody>
                        
                        <?php
						include("functions/limita-texto.php");

				if(isset($_POST['palavra-busca'])){

					$busca = $_POST['palavra-busca'];
					$select = "SELECT * from tb_produtos WHERE codigo LIKE '%$busca%' OR titulo_prod LIKE '%$busca%' OR nome_fornecedor LIKE '%$busca%' ORDER BY id_produto DESC ";

					}else{


                        $select = "SELECT * from tb_produtos ORDER BY id_produto DESC ";

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
                        	<td> <?php echo $mostrar-> codigo?> </td>
                            <td> <?php echo $mostrar-> titulo_prod?> </td>
                            <td> <?php echo $mostrar-> data?> </td>
                            <td> <img src="upload/produtos/<?php echo $mostrar->imagem;?>" width="50" height="30"/></td>
                            <td> <?php echo $mostrar-> exibir?> </td>
                            <td> <?php echo $mostrar-> preco_vista?> </td>
                            <td> <?php echo $mostrar-> preco_carta?> </td>
                            <td> <?php echo limitarTexto($mostrar-> descricao, $limite=200)?> </td>
                            <td class="td-actions"><a href="home.php?acao=editar_produtos&id_produto=<?php echo $mostrar-> id_produto;?>" class="btn btn-small btn-success"><i class="btn-icon-only icon-edit"> </i></a>
                            
                            <a href="home.php?acao=viz_produtos&delete=<?php echo $mostrar->id_produto;?>" class="btn btn-danger btn-small" onClick="return confirm('Deseja realmente excluir este produto?');"><i class="btn-icon-only icon-remove"> </i></a></td>
                        </tr>
                        
<?php
}
								}else{
								echo '<div class="alert alert-danger">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>AVISO!</strong> Não existe produto cadastrado!  </div>';
								
							 }
							}catch (Exception $e) {
							echo $e;
}
		//	}
			
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