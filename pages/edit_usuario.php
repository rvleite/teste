<script type="text/javascript">
jQuery(function($){
   $("#datanas").mask("99/99/9999",{placeholder:"dd/mm/yyyy"});
   $("#datemat").mask("99/99/9999",{placeholder:"dd/mm/yyyy"});
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
	      				<i class="icon-user"></i>
	      				<h3>Editar Usuário</h3>
	  				</div> <!-- /widget-header -->
                    
                        <div class="widget-content">
                                                        
                            <?php
								
								//recuperar os dados
							if(!isset($_GET['id'])){header ("Location:home.php?acao=viz_usuario");exit;}
							
							$id = $_GET['id'];
							
							$select = "SELECT * from usuarios where id=:id";
							
							$contagem = 1;
							try {
							$result = $conn->prepare($select);
							$result->bindParam(':id',$id,PDO::PARAM_INT);
							$result->execute();
							$contar = $result->rowCount();
						
								if($contar>0){
									while ($mostrar = $result->FETCH(PDO::FETCH_OBJ)){
										
										$id_usuario 		= $mostrar->id;
										$nome		 		= $mostrar->nome;
										$email 				= $mostrar->email;
										$datanas			= $mostrar->datanas;
										$sexo 				= $mostrar->sexo;
										$cpf 				= $mostrar->cpf;
										$foto 				= $mostrar->foto;
										$telefone 			= $mostrar->telefone;
										$operadora 			= $mostrar->operadora;
										$cep 				= $mostrar->cep;
										$uf 				= $mostrar->uf;
										$cidade 			= $mostrar->cidade;
										$bairro 			= $mostrar->bairro;
										$rua 				= $mostrar->rua;
										$num 				= $mostrar->num;
										$datemat 			= $mostrar->datemat;
										$indicacao 			= $mostrar->indicacao;
										$perfil 			= $mostrar->perfil;
										$login 				= $mostrar->login;
										$senha 				= $mostrar->senha;
										
										}
								}else{
								echo '<div class="alert alert-danger">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>AVISO!</strong> Não existe usuario cadastrado com ID informado!  </div>';
								
							 }
							}catch (Exception $e) {
							echo $e;
							}
							
							//Atualizar
								if(isset($_POST['atualizar'])){
									
									$nome	 		=trim(strip_tags($_POST['nome']));
									$email	 		=trim(strip_tags($_POST['email']));
									$datanas		=trim(strip_tags($_POST['datanas']));
									$sexo		 	=trim(strip_tags($_POST['sexo']));
									$cpf	 		=trim(strip_tags($_POST['cpf']));
									$telefone	 	=trim(strip_tags($_POST['telefone']));
									$operadora 		=trim(strip_tags($_POST['operadora']));
									$cep 			=trim(strip_tags($_POST['cep']));
									$uf 			=trim(strip_tags($_POST['uf']));
									$cidade 		=trim(strip_tags($_POST['cidade']));
									$bairro 		=trim(strip_tags($_POST['bairro']));
									$rua 			=trim(strip_tags($_POST['rua']));
									$num 			=trim(strip_tags($_POST['num']));
									$datemat		=trim(strip_tags($_POST['datemat']));
									$indicacao	 	=trim(strip_tags($_POST['indicacao']));
									$perfil	 		=trim(strip_tags($_POST['perfil']));
									$login		 	=trim(strip_tags($_POST['login']));
									$senha	 		=trim(strip_tags($_POST['senha']));
									
		
		if(empty($_FILES['img']['name'])){
										
		//INFO IMAGEM
		
		$file 		= $_FILES['img'];
		$numFile	= count(array_filter($file['name']));
		
		//PASTA
		$folder		= 'upload/inscritos';
		
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
						$novoNome = $foto;
						}
									
					$update = "UPDATE usuarios SET foto=:foto, nome=:nome, email=:email, datanas=:datanas, sexo=:sexo, cpf=:cpf, telefone=:telefone, operadora=:operadora, cep=:cep, uf=:uf, cidade=:cidade, bairro=:bairro, rua=:rua, num=:num, datemat=:datemat, indicacao=:indicacao, perfil=:perfil, login=:login, senha=:senha WHERE id =:id";
	
	try {
	$result = $conn->prepare($update);
	$result->bindParam(':id',$id,PDO::PARAM_INT);
	$result->bindParam(':foto',$novoNome,PDO::PARAM_STR);
	$result->bindParam(':nome',$nome,PDO::PARAM_STR);
	$result->bindParam(':email',$email,PDO::PARAM_STR);
	$result->bindParam(':datanas',$datanas,PDO::PARAM_STR);
	$result->bindParam(':sexo',$sexo,PDO::PARAM_STR);
	$result->bindParam(':cpf',$cpf,PDO::PARAM_STR);
	$result->bindParam(':telefone',$telefone,PDO::PARAM_STR);
	$result->bindParam(':operadora',$operadora,PDO::PARAM_STR);
	$result->bindParam(':cep',$cep,PDO::PARAM_STR);
	$result->bindParam(':uf',$uf,PDO::PARAM_STR);
	$result->bindParam(':cidade',$cidade,PDO::PARAM_STR);
	$result->bindParam(':bairro',$bairro,PDO::PARAM_STR);
	$result->bindParam(':rua',$rua,PDO::PARAM_STR);
	$result->bindParam(':num',$num,PDO::PARAM_STR);
	$result->bindParam(':datemat',$datemat,PDO::PARAM_STR);
	$result->bindParam(':indicacao',$indicacao,PDO::PARAM_STR);
	$result->bindParam(':perfil',$perfil,PDO::PARAM_STR);
	$result->bindParam(':login',$login,PDO::PARAM_STR);
	$result->bindParam(':senha',$senha,PDO::PARAM_STR);
	$result->execute();
	$contar = $result->rowCount();

		if($contar>0){
						
			echo '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Usuário Atualizado com sucesso!</strong></div>';
			
			}else{
		echo '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Erro ao Atualizar!</strong> Não foi possível atualizar o cadastro!  </div>';
		}
	}catch (Exception $e) {
	echo $e;
}
	
			
			}
			
																		
								
							?>
                            
							<div class="tab-pane" id="formcontrols">
								<form id="edit-profile" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
									
                                    <div class="control-group">											
											<label class="control-label" for="foto">Foto:</label>
											<div class="controls">
												<input type="file" class="span6" id="foto" name="img[]">
                                                <img src="upload/inscritos/<?php echo $foto;?>" width="50" height="30"/>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										<div class="control-group">											
											<label class="control-label" for="nome">Nome do Usuário:</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="nome" value="<?php echo $nome;?>" name="nome" required>
                                                <p class="help-block">* Campo Obrigatório</p>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
                                        
                                        <div class="control-group">											
											<label class="control-label" for="email">E-mail:</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="email" value="<?php echo $email;?>" name="email">
                                            </div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										
										<div class="control-group">											
											<label class="control-label" for="datanas">Data de aniversário:</label>
											<div class="controls">
												<input type="text" class="span2" id="datanas" value="<?php echo $datanas;?>" name="datanas">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
                                        
                                        <div class="control-group">											
											<label class="control-label" for="sexo">Sexo:</label>
											<div class="controls">
												<select type="text" class="span2" id="sexo" name="sexo">
                                                	<option selected><?php echo $sexo;?></option>
                                                	<?php if ($sexo!='Feminino'){echo '<option>Feminino</option>';}?>
                                                    <?php if ($sexo!='Masculino'){echo '<option>Masculino</option>';}?>
                                                </select>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
                                        
                                        <div class="control-group">											
											<label class="control-label" for="cpf">CPF:</label>
											<div class="controls">
												<input type="text" class="span2" id="cpf" value="<?php echo $cpf;?>" name="cpf">
                                                
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
                                        
                                        <div class="controls-group">											
											<label class="control-label" for="telefone">Telefone:</label>
											<div class="controls">
												<input type="text" class="span2" id="telefone" value="<?php echo $telefone;?>" name="telefone">
                                                
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
                                        
                                       <div class="control-group">											
											<label class="control-label" for="operadora">Operadora:</label>
											<div class="controls">
												<select type="text" class="span2" id="operadora" name="operadora">
                                                <option selected><?php echo $operadora;?></option>
                                                	<?php if ($operadora!='OI'){echo '<option>OI</option>';}?>
                                                    <?php if ($operadora!='TIM'){echo '<option>TIM</option>';}?>
                                                    <?php if ($operadora!='VIVO'){echo '<option>VIVO</option>';}?>
                                                    <?php if ($operadora!='CLARO'){echo '<option>CLARO</option>';}?>
                                                    <?php if ($operadora!='Nextel'){echo '<option>Nextel</option>';}?>
                                                	
                                                </select>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->

										 <div class="control-group">

				                        <div class="control-group">
				                            <div class="input-prepend cep-label">
				                                <label class="control-label" for="cep">CEP:</label>
				                                <div class="controls">
				                                <input id="cep" value="<?php echo $cep;?>" name="cep" type="text" maxlength="9" placeholder="Informe o CEP" class="span1" />
				                            </div>
				                            </div>
											<div class="control-group">
												
											</div>
				                            <div class="control-group">
				                                <label class="control-label" for="rua">Rua:</label>
				                                <div class="controls">
				                                <input id="rua" value="<?php echo $rua;?>" name="rua" type="text" placeholder="Nome da Rua / Logradouro" class="span4" />
				                            </div>
				                            </div>

				                            <div class="control-group">
				                                <label class="control-label" for="num">Nº:</label>
				                                <div class="controls">
				                                <input id="num"  value="<?php echo $num;?>" name="num" type="text" placeholder="Número" />
				                            </div>
				                            </div>

				                            <div class="control-group">
				                                <label class="control-label" for="bairro">Bairro:</label>
				                                <div class="controls">
				                                <input id="bairro" value="<?php echo $bairro;?>" name="bairro" type="text" placeholder="Bairro" />
				                            </div>
				                            </div>

				                            <div class="control-group">
				                                <label class="control-label" for="cidade">Cidade:</label>
				                                <div class="controls">
				                                <input id="cidade" value="<?php echo $cidade;?>" name="cidade" type="text" placeholder="Cidade" />
				                            </div>
				                            </div>

				                            <div class="control-group">
				                                <label class="control-label" for="uf">UF:</label>
				                                <div class="controls">
				                                <input id="uf" value="<?php echo $uf;?>" name="uf" type="text" placeholder="UF" class="span1"/>
				                            </div>
				                        </div>

				                    </div>

				                    <div class="control-group">											
											<label class="control-label" for="indicacao">Referência:</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="indicacao" value="<?php echo $indicacao;?>" name="indicacao">
                                                
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
                                        
                       
										<div class="control-group">											
											<label class="control-label" for="datemat">Data Matrícula:</label>
											<div class="controls">
												<input type="text" class="span2" id="datemat" value="<?php echo $datemat;?>" name="datemat">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
                                        
                                        <div class="control-group">											
											<label class="control-label" for="indicacao">Referência:</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="indicacao" value="<?php echo $indicacao;?>" name="indicacao">
                                                
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
                                        
                                        
                                    <div class="control-group">											
											<label class="control-label" for="login">login:</label>
											<div class="controls">
												<input type="text" class="span2" id="login" value="<?php echo $login;?>" name="login" required>
                                                <p class="help-block">* Campo Obrigatório</p>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->   
                                        
                                        <div class="control-group">											
											<label class="control-label" for="senha">Senha:</label>
											<div class="controls">
												<input type="password" class="span2" id="senha" value="<?php echo $senha;?>" name="senha">
                                            </div> <!-- /controls -->				
										</div> <!-- /control-group -->  
                                        
                                                                                 
                                        
                                        <div class="control-group">											
											<label class="control-label" for="biometria">Biometria</label>
											<div class="controls">
												<input type="file" class="span6" id="biometria" value="" name="biometria">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
                                                                
                                         <div class="control-group">											
											<label class="control-label" for="perfil">Acesso:</label>
											<div class="controls">
												<select type="text" class="span2" id="perfil" name="perfil">
                                                	<option>ADMINISTRADOR</option>
                                                    <option>USUÁRIO</option>
                                                </select>
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