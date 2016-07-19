<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">


                <div class="span12">
                    <div id="target-1" class="widget">
                    
                    <div class="widget ">
	      			
	      			<div class="widget-header">
	      				<i class="icon-edit-sign"></i>
	      				<h3>Indicação de Usuário</h3>
	  				</div> <!-- /widget-header -->
                    
                        <div class="widget-content">




<?php
		
$select = "SELECT * FROM usuarios WHERE id = (SELECT MAX(id) FROM usuarios)";
										
			try {
			$result = $conn->prepare($select);
			$result->bindParam(':id',$id,PDO::PARAM_INT);
			$result->execute();
			$contar = $result->rowCount();
						
			if($contar>0){
			while ($mostrar = $result->FETCH(PDO::FETCH_OBJ)){

				$id_usuario			 = $mostrar->id;
				$nome_usuario		 = $mostrar->nome;

																
					}
				
			}else{
											echo '<div class="alert alert-danger">
												<button type="button" class="close" data-dismiss="alert">×</button>
												<strong>AVISO!</strong> Não existe usuario cadastrado com ID informado!  </div>';
											
										 }
										}catch (Exception $e) {
										echo $e;
			}

?>

<?php
			 
			
				if(!isset($_GET['id'])){header ("Location:home.php?acao=viz_usuario");exit;}
					
							
							
							$id = $_GET['id'];
							
							$select = "SELECT * from usuarios where id=:id";
							
							$contagem = 1;
							$bonus = 30;
							try {
							$result = $conn->prepare($select);
							$result->bindParam(':id',$id,PDO::PARAM_INT);
							$result->execute();
							$contar = $result->rowCount();

								if($contar>0){
									while ($mostrar = $result->FETCH(PDO::FETCH_OBJ)){
										
										$id_indicou			= $mostrar->id;
										$nome_indicou		= $mostrar->nome;
										$email_indicou		= $mostrar->email;
												
										}
								}
								else{
									echo '<div class="alert alert-danger">
										<button type="button" class="close" data-dismiss="alert">×</button>
										<strong>AVISO!</strong> Não existe usuario cadastrado com ID informado!  </div>';
								}
								
								
							}catch (Exception $e) {
							echo $e;
							}
		

						if(isset($_POST['vincular'])):
							
									
								$bonus; 					
								$id_indicou				=trim(strip_tags($_POST['id_indicou']));//id do usuario que indicou
								$nome_indicou	 		=trim(strip_tags($_POST['nome_indicou']));
								$email_indicou	 		=trim(strip_tags($_POST['email_indicou']));
								$id_usuario				=trim(strip_tags($_POST['id_usuario'])); //id do usuario cadastrado
								$nome_usuario	 		=trim(strip_tags($_POST['nome_usuario']));
							


							$insert = "INSERT INTO tb_vinculos (id_indicou, nome_indicou, email_indicou, id_usuario, nome_usuario, bonus) VALUES (:id_indicou, :nome_indicou,  :email_indicou, :id_usuario, :nome_usuario, :bonus )";
						
						try {
						$result = $conn->prepare($insert);
						$result->bindParam(':bonus',$bonus,PDO::PARAM_INT);
						$result->bindParam(':id_indicou',$id_indicou,PDO::PARAM_INT);
						$result->bindParam(':nome_indicou',$nome_indicou,PDO::PARAM_STR);
						$result->bindParam(':email_indicou',$email_indicou,PDO::PARAM_STR);
						$result->bindParam(':id_usuario',$id_usuario,PDO::PARAM_INT);
						$result->bindParam(':nome_usuario',$nome_usuario,PDO::PARAM_STR);
						$result->execute();
						$contar = $result->rowCount();
												

						if($contar>0){
										
							echo '<div class="alert alert-success">
				            <button type="button" class="close" data-dismiss="alert">×</button>
				            <strong>Indicação cadastrado com sucesso!</strong></div>';
				            echo '<script>location.href="home.php";</script>';
							
							}else{
						echo '<div class="alert alert-danger">
				            <button type="button" class="close" data-dismiss="alert">×</button>
				            <strong>Erro ao cadastrar!</strong> Não foi possível realizar o cadastro!  </div>';
						}
				}
	catch (Exception $e) {
	echo $e;

}
endif;



?>

<div class="tab-pane" id="formcontrols">
	<form id="edit-profile" class="form-horizontal" action="" method="post" enctype="multipart/form-data">

  		

  		<div class="control-group">											
			<label class="control-label" for="id_indicou">Identificação de Indicou:</label>
			<div class="controls">
				<input type="text" class="span2" id="id_indicou" value="<?php echo $id_indicou;?>" name="id_indicou">
    		</div> <!-- /controls -->				
   		</div> <!-- /control-group --> 




  		<div class="control-group">											
			<label class="control-label" for="nome_indicou">Usuário Indicou:</label>
			<div class="controls">
				<input type="text" class="span2" id="nome_indicou" value="<?php echo $nome_indicou;?>" name="nome_indicou">
    		</div> <!-- /controls -->				
   		</div> <!-- /control-group -->  

   <div class="control-group">											
			<label class="control-label" for="email_indicou">E-mail Indicou:</label>
			<div class="controls">
				<input type="text" class="span2" id="email_indicou" value="<?php echo $email_indicou;?>" name="email_indicou">
    		</div> <!-- /controls -->				
   </div> <!-- /control-group -->  

    <div class="control-group">											
			<label class="control-label" for="id_usuario">Identificação do Usuário:</label>
			<div class="controls">
				<input type="text" class="span2" id="id_usuario" value="<?php echo $id_usuario;?>" name="id_usuario">
    		</div> <!-- /controls -->				
   </div> <!-- /control-group -->  


    <div class="control-group">											
			<label class="control-label" for="nome_usuario">Nome do Usuário:</label>
			<div class="controls">
				<input type="text" class="span2" id="nome_usuario" value="<?php echo $nome_usuario;?>" name="nome_usuario">
    		</div> <!-- /controls -->				
   </div> <!-- /control-group -->  

                                
    <div class="form-actions">
		<input type="submit" name="vincular" class="btn btn-primary" value="vincular">
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