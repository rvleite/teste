<script type="text/javascript">
jQuery(function($){
   $("#date").mask("99/99/9999",{placeholder:"dd/mm/yyyy"});
   $("#data_vencimento").mask("99/99/9999",{placeholder:"dd/mm/yyyy"});
   
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
	      				<h3>Cadastrar Produtos</h3>
	  				</div> <!-- /widget-header -->
                    
                        <div class="widget-content">
                                                        
                            <?php
								if(isset($_POST['cadastrar'])){

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
						
						$insert = "INSERT INTO tb_produtos (codigo, titulo_prod, descricao, data, imagem, nome_fornecedor, data_vencimento, quantidade, exibir, preco_vista, preco_carta) VALUES (:codigo, :titulo_prod, :descricao, :data, :imagem, :nome_fornecedor, :data_vencimento, :quantidade, :exibir, :preco_vista, :preco_carta)";
	
	try {
	$result = $conn->prepare($insert);
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
            <strong>Produto cadastrado com sucesso!</strong></div>';
			
			}else{
		echo '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Erro ao cadastrar!</strong> Não foi possível realizar o cadastro!  </div>';
		}
	}catch (Exception $e) {
	echo $e;
}
							
					}else
						$msg[] = "<b>$name :</b> Desculpe! Ocorreu um erro...";
				
				}
				
				foreach($msg as $pop)
				echo '';
					//echo $pop.'<br>';
			}
		}
									
								
	
																		
								}
							?>
                            
							<div class="tab-pane" id="formcontrols">
								<form id="edit-profile" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
									
										<div class="control-group">											
											<label class="control-label" for="codigo">Código de Barras:</label>
											<div class="controls">
												<input type="text" class="span6" name="codigo" value="" id="codigo" />
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										<div class="control-group">											
											<label class="control-label" for="nome_suprimento">Produtor:</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="username" value="" name="titulo_prod">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										
										<div class="control-group">											
											<label class="control-label" for="descricao">Resumo do Produto:</label>
											<div class="controls">
												<textarea class="span6" id="descricao" value="" name="descricao"></textarea>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										
										<div class="control-group">											
											<label class="control-label" for="data">Data:</label>
											<div class="controls">
												<input type="text" class="span2" id="date" value="" name="data">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
                                        
                                        <div class="control-group">											
											<label class="control-label" for="exibir">Exibir:</label>
											<div class="controls">
												<select type="text" class="span1" id="exibir" name="exibir">
                                                	<option>Sim</option>
                                                    <option>Não</option>
                                                </select>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
                                        <div class="control-group">											
											<label class="control-label" for="imagem">Imagem do Produto:</label>
											<div class="controls">
												<input type="file" class="span6" id="imagem" value="" name="img[]">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->

										<div class="control-group">											
											<label class="control-label" for="nome_fornecedor">Nome do Fornecedor:</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="nome_fornecedor" value="" name="nome_fornecedor">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->

										<div class="control-group">											
											<label class="control-label" for="data_vencimento">Data de Vencimento:</label>
											<div class="controls">
												<input type="text" class="span2" id="data_vencimento" value="" name="data_vencimento">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
                                        <div class="control-group">											
											<label class="control-label" for="quantidade">Quantidade Estoque:</label>
											<div class="controls">
												<input type="text" class="span1" id="quantidade" value="" name="quantidade">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->

										<div class="control-group">											
											<label class="control-label" for="preco_vista">Preço Vista:</label>
											<div class="controls">
												<input type="text" class="span1" id="preco_vista" value="" name="preco_vista">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->

										<div class="control-group">											
											<label class="control-label" for="preco_carta">Preço Cartão:</label>
											<div class="controls">
												<input type="text" class="span1" id="preco_carta" value="" name="preco_carta">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
                                        
                                                                               
										<div class="form-actions">
											<input type="submit" name="cadastrar" class="btn btn-primary" value="Cadastrar"> 
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