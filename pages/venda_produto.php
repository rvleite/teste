
<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">


                
                <div class="span12">

                
                    <div id="target-1" class="widget">
                        <div class="widget-content">
                            

                           
<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">

<div class="span12">





         <div class="widget-header">											
		
	 	<form action="home.php?acao=venda_produto" method="post" enctype="multipart/form-data" class="navbar-search pull-left form-search">

         <h3> PESQUISAR PRODUTO: </h3>	<input type="text" name="palavra-busca1" class="search-query" placeholder="pesquisar">
        
        
		
       	</form>

		<div class="control-group">
												
		</div>
       
       	</div>
		


 				
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
                            <th> Nome do Produto</th>
                            <th> Data</th>
                            <th> Imagem</th>
                            <th> Exibir</th>
                            <th> Resumo</th>
                            
                            <th class="td-actions">Comprar</th>
                        </tr>
                        </thead>
                        <tbody>'

                       
    
                        <?php
						include("functions/limita-texto.php");

				if(isset($_POST['palavra-busca1'])){

					$busca = $_POST['palavra-busca1'];
					$select = "SELECT * from tb_produtos WHERE codigo LIKE '%$busca%' OR titulo_prod LIKE '%$busca%' OR nome_fornecedor LIKE '%$busca%' ORDER BY id_produto DESC ";

					}else{


                        $select = "SELECT * from tb_produtos  ";

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
                            <td> <?php echo limitarTexto($mostrar-> descricao, $limite=200)?> </td>
                            <td class="td-actions"><a href="home.php?acao=add&id_produto=<?php echo $mostrar-> id_produto;?>" class="btn btn-small btn-success"><i class="btn-icon-only icon-shopping-cart"> </i></a>
                            
                            </td>
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
<!-- /main-inner -->
</div>
<!-- /main -->

