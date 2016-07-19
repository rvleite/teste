<script type="text/javascript">
jQuery(function($){
   $("#date").mask("99/99/9999",{placeholder:"dd/mm/yyyy"});
   
});
</script>


<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">


                <div class="span12">
                    <div id="target-1" class="widget">
                    
                    <div class="widget ">
	      			
	      			<div class="widget-header">
	      				<i class="icon-edit-sign"></i>
	      				<h3>Editar Produtos</h3>
	  				</div> <!-- /widget-header -->
                    
                        <div class="widget-content">
                                                        
                            <?php
							
							//recuperar os dados
							if(!isset($_GET['id_produto'])){header ("Location:home.php?acao=viz_produtos");exit;}
							
							$id_produto = $_GET['id_produto'];
							
							$select = "SELECT * from tb_produtos where id_produto= :id_produto  ";
							
							$contagem = 1;
							try {
							$result = $conn->prepare($select);
							$result->bindParam(':id_produto',$id_produto,PDO::PARAM_INT);
							$result->execute();
							$contar = $result->rowCount();
						
								if($contar>0){
									while ($mostrar = $result->FETCH(PDO::FETCH_OBJ)){
										
										$idPost 				= $mostrar->id_produto;
										$codigo					= $mostrar->codigo;
										$titulo_prod 			= $mostrar->titulo_prod;
										$data 					= $mostrar->data;
										$imagem 				= $mostrar->imagem;
										$descricao 				= $mostrar->descricao;
										$data_vencimento 		= $mostrar->data_vencimento;
										$nome_fornecedor 		= $mostrar->nome_fornecedor;
										$quantidade 			= $mostrar->quantidade;
										$exibir 				= $mostrar->exibir;
										$preco_vista 			= $mostrar->preco_vista;
										$preco_carta 			= $mostrar->preco_carta;
										
										}
								}else{
								echo '<div class="alert alert-danger">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>AVISO!</strong> Não existe produto cadastrado com ID informado!  </div>';
								
							 }
							}catch (Exception $e) {
							echo $e;
}
							
					//Atualizar
					if(isset($_POST['atualizar'])){
						
						$codigo 			=trim(strip_tags($_POST['codigo']));			
						$titulo_prod 		=trim(strip_tags($_POST['titulo_prod']));
						$descricao 			=trim(strip_tags($_POST['descricao']));
						$data 				=trim(strip_tags($_POST['data']));
						$data_vencimento 	=trim(strip_tags($_POST['data_vencimento']));
						$nome_fornecedor 	=trim(strip_tags($_POST['nome_fornecedor']));
						$quantidade 		=trim(strip_tags($_POST['quantidade']));
						$exibir 			=trim(strip_tags($_POST['exibir']));
						$preco_vista		=trim(strip_tags($_POST['preco_vista']));
						$preco_carta		=trim(strip_tags($_POST['preco_carta']));
									

										
									
			if(empty($_FILES['img']['name'])){
				
				//INFO IMAGEM
									
				$file 		= $_FILES['img'];
				$numFile	= count(array_filter($file['name']));
				
				//PASTA
				$folder		= 'upload/produtos';
				
				//REQUISITOS
				$permite 	= array('image/jpeg', 'image/png');
				$maxSize	= 1024 * 1024 * 1;
				
				//MENSAGENS
				$msg		= array();
				$errorMsg	= array(
					1 => 'O arquivo no upload é maior do que o limite definido em upload_max_filesize no php.ini.',
					2 => 'O arquivo ultrapassa o limite de tamanho em MAX_FILE_SIZE que foi especificado no formulário HTML',
					3 => 'o upload do arquivo foi feito parcialmente',
					4 => 'Não foi feito o upload do arquivo'
				);
				
				if($numFile <= 0){
					echo '<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								Selecione uma imagem!
							</div>';
				}
				else if($numFile >=2){
					echo '<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								Você ultrapassou o limite de upload!
							</div>';
				}else{
					for($i = 0; $i < $numFile; $i++){
						$name 	= $file['name'][$i];
						$type	= $file['type'][$i];
						$size	= $file['size'][$i];
						$error	= $file['error'][$i];
						$tmp	= $file['tmp_name'][$i];
						
						$extensao = @end(explode('.', $name));
						$novoNome = rand().".$extensao";
						
						if($error != 0)
							$msg[] = "<b>$name :</b> ".$errorMsg[$error];
						else if(!in_array($type, $permite))
							$msg[] = "<b>$name :</b> Erro imagem não suportada!";
						else if($size > $maxSize)
							$msg[] = "<b>$name :</b> Erro imagem ultrapassa o limite de 5MB";
						else{
							
							if(move_uploaded_file($tmp, $folder.'/'.$novoNome)){
								//$msg[] = "<b>$name :</b> Upload Realizado com Sucesso!";
									
							}else
								$msg[] = "<b>$name :</b> Desculpe! Ocorreu um erro...";
						
						}
						
						foreach($msg as $pop)
						echo '';
							//echo $pop.'<br>';
					}
				}	
							}//se o input file nao estiver vazio
							
							else {
								$novoNome = $imagem;
								}
						
						$update = "UPDATE tb_produtos SET codigo=:codigo, titulo_prod=:titulo_prod, descricao=:descricao, data=:data, data_vencimento=:data_vencimento, nome_fornecedor=:nome_fornecedor, imagem=:imagem, quantidade=:quantidade, exibir=:exibir, preco_vista=:preco_vista, preco_carta=:preco_carta WHERE id_produto =:id_produto";
	
	try {
	$result = $conn->prepare($update);
	$result->bindParam(':id_produto',$id_produto,PDO::PARAM_INT);
	$result->bindParam(':codigo',$codigo,PDO::PARAM_STR);
	$result->bindParam(':titulo_prod',$titulo_prod,PDO::PARAM_STR);
	$result->bindParam(':descricao',$descricao,PDO::PARAM_STR);
	$result->bindParam(':data',$data,PDO::PARAM_STR);
	$result->bindParam(':imagem',$novoNome,PDO::PARAM_STR);
	$result->bindParam(':data_vencimento',$data_vencimento,PDO::PARAM_STR);
	$result->bindParam(':nome_fornecedor',$nome_fornecedor,PDO::PARAM_STR);
	$result->bindParam(':quantidade',$quantidade,PDO::PARAM_INT);
	$result->bindParam(':exibir',$exibir,PDO::PARAM_STR);
	$result->bindParam(':preco_vista',$preco_vista,PDO::PARAM_STR);
	$result->bindParam(':preco_carta',$preco_carta,PDO::PARAM_STR);
	$result->execute();
	$contar = $result->rowCount();

		if($contar>0){
						
			echo '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Produto Atualizado com sucesso!</strong></div>';
			
			}else{
		echo '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Erro ao Atualizar!</strong> Não foi possível atualizar o Produto!  </div>';
		}
	}catch (Exception $e) {
	echo $e;
}
											
	}
							?>
                            
							<div class="tab-pane" id="formcontrols">
								<form id="edit-profile" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
									
										<div class="control-group">											
											<label class="control-label" for="codigo">Código de barras:</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="codigo" value="<?php echo $codigo;?> " name="codigo">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										

										<div class="control-group">											
											<label class="control-label" for="nome_suprimento">Nome Produto:</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="username" value="<?php echo $titulo_prod;?> " name="titulo_prod">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										
										<div class="control-group">											
											<label class="control-label" for="descricao">Resumo do Produto:</label>
											<div class="controls">
												<textarea class="span6" id="descricao" value="" name="descricao" ><?php echo $descricao;?></textarea>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										
										<div class="control-group">											
											<label class="control-label" for="data">Data:</label>
											<div class="controls">
												<input type="text" class="span2" id="date" value="<?php echo $data;?> " name="data">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
                                        
                                        <div class="control-group">											
											<label class="control-label" for="exibir">Exibir:</label>
											<div class="controls">
												<select type="text" class="span1" id="exibir" name="exibir">
                                                <option selected><?php echo $exibir;?></option>
                                                	<?php if ($exibir!='Sim'){echo '<option>Sim</option>';}?>
                                                    <?php if ($exibir!='Não'){echo '<option>Não</option>';}?>
                                                </select>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
                                        <div class="control-group">											
											<label class="control-label" for="imagem">Imagem do Produto:</label>
											<div class="controls">
												<input type="file" class="span6" id="imagem" value="" name="img[]">
                                                <img src="upload/produtos/<?php echo $imagem;?>" width="50" height="30"/>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										<div class="control-group">											
											<label class="control-label" for="data_vencimento">Data:</label>
											<div class="controls">
												<input type="text" class="span2" id="data_vencimento" value="<?php echo $data_vencimento;?> " name="data_vencimento">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->

										<div class="control-group">											
											<label class="control-label" for="nome_fornecedor">Nome do Fornecedor:</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="nome_fornecedor" value="<?php echo $nome_fornecedor;?>" name="nome_fornecedor">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->

                                        <div class="control-group">											
											<label class="control-label" for="quantidade">Quantidade Estoque:</label>
											<div class="controls">
												<input type="text" class="span1" id="quantidade" value="<?php echo $quantidade;?> " name="quantidade">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->

										<div class="control-group">											
											<label class="control-label" for="preco_vista">Preço Vista:</label>
											<div class="controls">
												<input type="text" class="span1" id="preco_vista" value="<?php echo $preco_vista;?> " name="preco_vista">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->

										<div class="control-group">											
											<label class="control-label" for="preco_carta">Preço Cartão:</label>
											<div class="controls">
												<input type="text" class="span1" id="preco_carta" value="<?php echo $preco_carta;?> " name="preco_carta">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
                                        
                                        
                                                                               
										<div class="form-actions">
											<input type="submit" name="atualizar" class="btn btn-primary" value="Atualizar"> 
											<input type="reset" name="cancelar" class="btn" value="Cancelar">
										</div> <!-- /form-actions -->
							
							</form>			
                        </div> <!-- /widget-content -->
                    </div> <!-- /widget -->
                    
                    
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