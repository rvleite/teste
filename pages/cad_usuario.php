<script type="text/javascript">
jQuery(function($){
   $("#datanas").mask("99/99/9999",{placeholder:"dd/mm/yyyy"});
   $("#datemat").mask("99/99/9999",{placeholder:"dd/mm/yyyy"});
});
</script>

<script src="http://code.jquery.com/jquery-1.7.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
<script src="js/gmaps.js" type="text/javascript"></script>
<script src="js/cep.js" type="text/javascript"></script>

   
   <script>
            $(function(){
                wscep({map: 'map1',auto:true});
                wsmap('08615-000','555','map2');
            })
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
	      				<h3>Cadastrar Usuários</h3>
	  				</div> <!-- /widget-header -->
                    
                        <div class="widget-content">
                                                        
                            <?php
								if(isset($_POST['cadastrar'])){
									
									$nome	 		=trim(strip_tags($_POST['nome']));
									$email	 		=trim(strip_tags($_POST['email']));
									$login		 	=trim(strip_tags($_POST['login']));
									$senha	 		=trim(strip_tags($_POST['senha']));
									$datanas 		=trim(strip_tags($_POST['datanas']));
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
		else if($numFile >= 2){
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
									
						$insert = "INSERT INTO usuarios (foto, nome, email, datanas, sexo, cpf, telefone, operadora, cep, uf, cidade, bairro, rua, num, datemat, indicacao, perfil, login, senha) VALUES (:foto, :nome, :email, :datanas, :sexo, :cpf, :telefone, :operadora, :cep, :uf, :cidade, :bairro, :rua, :num, :datemat, :indicacao, :perfil, :login, :senha)";
	
	try {
	$result = $conn->prepare($insert);
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
						
			/*echo '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Produto cadastrado com sucesso!</strong></div>';*/
            echo '<script>
			alert("Cadastro realizado com sucesso.");
			opcao = prompt("Deseja adicionar o usuário a um grupo? S ou N?");
			if (opcao == "S"){
				location.href="home.php?acao=vincular_usuario";
			}else{
		         location.href="home.php";
		        }
		</script>';
			
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
											<label class="control-label" for="foto">Foto:</label>
											<div class="controls">
												<input type="file" class="span6" id="foto" value="" name="img[]">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										<div class="control-group">											
											<label class="control-label" for="nome">Nome do Usuário:</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="nome" value="" name="nome" required>
                                                <p class="help-block">* Campo Obrigatório</p>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
                                        
                                        <div class="control-group">											
											<label class="control-label" for="email">E-mail:</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="email" value="" name="email">
                                            </div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										
										<div class="control-group">											
											<label class="control-label" for="datanas">Data de aniversário:</label>
											<div class="controls">
												<input type="text" class="span2" id="datanas" value="" name="datanas">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
                                        
                                        <div class="control-group">											
											<label class="control-label" for="sexo">Sexo:</label>
											<div class="controls">
												<select type="text" class="span2" id="sexo" name="sexo">
                                                	<option>Selecione</option>
                                                    <option>Feminino</option>
                                                    <option>Masculino</option>
                                                </select>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
                                        
                                        <div class="control-group">											
											<label class="control-label" for="cpf">CPF:</label>
											<div class="controls">
												<input type="text" class="span2" id="cpf" value="" name="cpf">
                                                
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
                                        
                                        <div class="controls-group">											
											<label class="control-label" for="telefone">Telefone:</label>
											<div class="controls">
												<input type="text" class="span2" id="telefone" value="" name="telefone">
                                                
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">
								
							</div>
                                        
                                       <div class="control-group">											
											<label class="control-label" for="operadora">Operadora:</label>
											<div class="controls">
												<select type="text" class="span2" id="operadora" name="operadora">
                                                	<option>SELECIONE A OPERADORA</option>
                                                    <option>OI</option>
                                                    <option>TIM</option>
                                                    <option>VIVO</option>
                                                    <option>CLARO</option>
                                                    <option>Nextel</option>
                                                </select>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
                                        
            
				                    <div class="control-group">

				                        <div class="control-group">
				                            <div class="input-prepend cep-label">
				                                <label class="control-label" for="cep">CEP:</label>
				                                <div class="controls">
				                                <input id="cep" name="cep" type="text" maxlength="9" placeholder="Informe o CEP" class="span1" />
				                            </div>
				                            </div>
											<div class="control-group">
												
											</div>
				                            <div class="control-group">
				                                <label class="control-label" for="rua">Rua:</label>
				                                <div class="controls">
				                                <input id="rua" name="rua" type="text" placeholder="Nome da Rua / Logradouro" class="span4" />
				                            </div>
				                            </div>

				                            <div class="control-group">
				                                <label class="control-label" for="num">Nº:</label>
				                                <div class="controls">
				                                <input id="num" name="num" type="text" placeholder="Número" />
				                            </div>
				                            </div>

				                            <div class="control-group">
				                                <label class="control-label" for="bairro">Bairro:</label>
				                                <div class="controls">
				                                <input id="bairro" name="bairro" type="text" placeholder="Bairro" />
				                            </div>
				                            </div>

				                            <div class="control-group">
				                                <label class="control-label" for="cidade">Cidade:</label>
				                                <div class="controls">
				                                <input id="cidade" name="cidade" type="text" placeholder="Cidade" />
				                            </div>
				                            </div>

				                            <div class="control-group">
				                                <label class="control-label" for="uf">UF:</label>
				                                <div class="controls">
				                                <input id="uf" name="uf" type="text" placeholder="UF" class="span1"/>
				                            </div>
				                        </div>

				                    </div>

										<div class="control-group">											
											<label class="control-label" for="datemat">Data Matrícula:</label>
											<div class="controls">
												<input type="text" class="span2" id="datemat" value="" name="datemat">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
                                        
                                        <div class="control-group">											
											<label class="control-label" for="indicacao">Referência Domiciliar:</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="indicacao" value="" name="indicacao">
                                              
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
                                        
                                        
                                    <div class="control-group">											
											<label class="control-label" for="login">login:</label>
											<div class="controls">
												<input type="text" class="span2" id="login" value="" name="login" required>
                                                <p class="help-block">* Campo Obrigatório</p>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->   
                                        
                                        <div class="control-group">											
											<label class="control-label" for="senha">Senha:</label>
											<div class="controls">
												<input type="text" class="span2" id="senha" value="" name="senha" required>
                                                <p class="help-block">* Campo Obrigatório</p>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->  
                                        
                                        <div class="control-group">											
											<label class="control-label" for="rpt_senha">Repita a senha:</label>
											<div class="controls">
												<input type="text" class="span2" id="rpt_senha" value="" name="rpt_senha">
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
                                                	<option>CLIENTE</option>
                                                	<option>ADMINISTRADOR</option>
                                                    
                                                </select>
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