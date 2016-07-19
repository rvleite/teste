<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">


                
                <div class="span12">

                
                    <div id="target-1" class="widget">
                        <div class="widget-content">




								 <?php
								if(isset($_POST['Comprar'])){echo 'Comprar';}

								?>


                            

                            <form action="home.php?acao=venda_produtos" method="post" enctype="multipart/form-data" class="navbar-search pull-left form-search">

         					<h3> PESQUISAR USUÁRIO: </h3><input type="text" name="palavra-busca" class="search-query" placeholder="pesquisar">

         					</form>

                        </div> <!-- /widget-content -->
                    </div> <!-- /widget -->

                    <?php
						
						if(isset($_POST['palavra-busca'])){

							$busca = $_POST['palavra-busca'];
							$select = "SELECT * from usuarios WHERE nome LIKE '%$busca%' OR email LIKE '%$busca%' OR login LIKE '%$busca%' OR cpf LIKE '%$busca%' ORDER BY id DESC LIMIT 1";

						}else{

                        $select = "SELECT * from usuarios WHERE NOME = '' ORDER BY id DESC ";

                    	}	

						$contagem = 1;
							try {
							$result = $conn->prepare($select);
							$result->execute();
							$contar = $result->rowCount();
						
								if($contar>0){
									while ($mostrar = $result->FETCH(PDO::FETCH_OBJ)){
										$id = $mostrar-> id;
									$_SESSION['id_compra'] = $id;
               ?>      

  						<div id="target-1" class="widget">
                        <div class="widget-content">

                        <p class="text-center"><h1>Dados do Cliente</h1></p>
                        
		

						<div id="form" style="float:left; width:400px;">
						<label class="form-group" for="foto">Foto:</label>	   
						  <img src="upload/inscritos/<?php echo  $mostrar->foto;?>" width="50" height="30"/><br /><br />
						
						<label for="datanas">Data Nascimento:</label><input type="text"  value="<?php echo $mostrar->datanas;?>">
						<label for="datemat">Data Inscrição:</label><input type="text" value="<?php echo $mostrar->datemat;?>"><br />

						<label class="form-group" ><h1>Endereço</h1></label>
						<label for="cep">Cep:</label><input type="text" value="<?php echo $mostrar->cep;?>"><br />
						<label for="cep">Rua:</label><input type="text" value="<?php echo $mostrar->rua;?>"><br />
						<br />

						<?php
 
// Contabiliza o bonus por usuario

 					
 					$select = $conn->query ("SELECT COUNT(*) AS total FROM tb_vinculos where id_indicou = '$id'");

 					$total = (int) $select->fetchColumn( 0 );



						if ( $total > 0 ){

							echo '<div class="alert alert-success">
									
									<strong>Este Cliente tem '.$total. ' indicações e tem R$ ' .$total * 20 . ' de Bônus!</strong></div> </ br>';

							

						} else {

							echo '<div class="alert alert-danger">
									
									<strong>AVISO!</strong> Este Cliente não tem nenhuma Indicação  </div>';

						}


                    	
						


?>
							</form>
					</div>
  
                        	<div id="form" style="float:right; width:700px;">
						   
						  <label for="nome">Nome do Cliente:</label><input type="text"  value="<?php echo $mostrar->nome;?>">
						
						<label for="datanas">Telefone:</label><input type="text"  value="<?php echo $mostrar->telefone;?>">
						<br />
						<br />
						<label></label>
						<label></label>
						<label></label>
						<label for="datemat">Data Termíno:</label><input type="text" value="<?php echo $mostrar->datemat;?>"><br />
						<br />
						<br />
						


						<label></label>
						<label></label>
						<label class="form-group" ></label>
						<label for="num">Numero:</label><input type="text" value="<?php echo $mostrar->num;?>"><br />
						<label for="bairro">Bairro:</label><input type="text" value="<?php echo $mostrar->bairro;?>"><br />
						<br />

<label></label>
						<label><br><br><br><br><br></label>


					<td class="td-actions"><a href="home.php?acao=venda_produto" class="btn btn-small btn-success"><i class="btn-icon-only icon-edit"> Realizar Compras </i></a>
										

 
							
					</div>
                        	
						</div> <!-- /widget-content -->
                    </div> <!-- /widget -->
					
                     	
                        	
                            
                            
                        </tr>
                        
                        <?php
}
								}else{
								echo '<div class="alert alert-danger">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>AVISO!</strong> Não Existe cliente a pesquisar!  </div>';
								
							 }
							}catch (Exception $e) {
							echo $e;
}
?>

             


</div><!-- span 12 -->




            </div><!-- row -->

           </div>
<!-- /main-inner -->
</div>
<!-- /main -->




</div>
<!-- /main-inner -->
</div>
<!-- /main -->

