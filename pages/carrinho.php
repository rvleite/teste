<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
        <div class="span12">  

<?php

      //$id = $_SESSION['id_compra'];
       
      if(!isset($_SESSION['carrinho'])):
         $_SESSION['carrinho'] = array();
      endif;
       
      //adiciona produto
       
      if(isset($_GET['acao'])):
          
         //ADICIONAR CARRINHO

       

         if($_GET['acao'] == 'add'):
           $id_produto = isset($_GET['id_produto']) ? intval($_GET['id_produto']) : null;
                     
            if(!isset($_SESSION['carrinho'][$id_produto])):
               $_SESSION['carrinho'][$id_produto] = 1;
            else:
               $_SESSION['carrinho'][$id_produto] += 1;
            endif;
         endif;

          
         //REMOVER CARRINHO
         if($_GET['acao'] == 'del'):
            $id = intval($_GET['id_produto']);
            if(isset($_SESSION['carrinho'][$id])):
               unset($_SESSION['carrinho'][$id]);
            endif;
         endif;

          
//Você clicou em limpar carrinho
if($_GET['acao'] == 'limpar'):

      unset($_SESSION['carrinho']);

  endif; //acao limpar


endif;

//Quando Clicar em Alterar quantidade



if($_GET['acao'] == 'Alter'):

        if(isset($_POST['alterar_qtd'])):
          $valor = intval($_POST($quant));
          $id_produto = intval($_POST[$id_produto]);

          if ($valor <= 0):   

                unset($_SESSION['carrinho'][$id_produto]);

            else:

              if (!empty($_SESSION['carrinho'][$id_produto])):

                  $_SESSION['carrinho'][$id_produto] = $valor;

                else:

              endif;

            endif; // valor <= 0

        endif; // final isset quant

endif;






       /*  //ALTERAR QUANTIDADE tentando de outro jeito
         if($_GET['acao'] == 'Alter'):
            if(is_array($_POST['prod'])):
               foreach($_POST['prod'] as $id => $qtd):
                  $id  = intval($id);
                  $qtd = intval($qtd);
                  if(!empty($qtd) || $qtd <> 0):
                     $_SESSION['carrinho'][$id] = $qtd;
                  else:
                     unset($_SESSION['carrinho'][$id]);
                  endif;
               endforeach;
            endif;
         endif;
       
      endif;

      */
       
       
?>
   




                           
<div class="span12">
    
               
                  <div class="widget widget-table action-table">
                <div class="widget-header"> <i class="icon-th-list"></i>
                    <h3>Carrinho de compra</h3>
                     
                </div>
                <!-- /widget-header -->
                <div class="widget-content">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th width="50"> Quantidade</th>
                            <th> Código de Barras</th>
                            <th> Nome do suplemento Alimentar</th>
                            <th> Imagem</th>
                            <th> Preço Vista</th>
                            <th> Subtotal Vista</th>
                            <th> Preço Cartão</th>
                            <th> Subtotal Cartão</th>
                            

                            
                            <th class="td-actions">Remover</th>
                        </tr>
                        </thead>

                        <tfoot>
                               <tr>
                                <td colspan="5"><a href="home.php?acao=venda_produto">Continuar Comprando</a></td>
                               <tr>
                                <td colspan="3" class="td-actions"><a href="home.php?acao=limpar"><input type="submit" value="Limpar Carrinho" /></td> 
                        </tfoot>

                        <tbody>

          
                     
                      
    
            <?php
              $totalcart=0;
              $totalvista=0;

        
                    if(empty($_SESSION['carrinho'])):
                        echo '<tr><td colspan="5">Não há produto no carrinho</td></tr>';

                     else:                    

                         foreach($_SESSION['carrinho'] as $id => $qtd):

                            $select = $conn->prepare("SELECT * from tb_produtos WHERE id_produto = :id_produto");
                            $select->bindValue(":id_produto",$id);
                            $select->execute();
                            $mostrar = $select->fetch(PDO::FETCH_ASSOC);
                            $subtocart = $mostrar['preco_carta']*$qtd;
                            $subtovista = $mostrar['preco_vista']*$qtd;

                            $totalcart += $mostrar['preco_carta'] * $qtd;
                            $totalvista += $mostrar['preco_vista'] * $qtd;

                                             
                       
             ?>         
                            <tr>
                              <td>
                                  <input type="text" class="span1" value="<?php echo $qtd; ?>" name="quant"/> 
                                 
                                  <input type="hidden" name="id_produto" value="<?php echo $mostrar['id_produto'];?>"/>

                              </td>

                              <td> <?php echo $mostrar['codigo'];?> </td>
                                <td> <?php echo $mostrar['titulo_prod'];?> </td>
                                <td> <img src="upload/produtos/<?php echo $mostrar['imagem'];?>" width="50" height="30"/></td>
                                <td><?php echo "R$ " .number_format($mostrar['preco_vista'],2,",",".");?> </td>
                                <td><?php echo "R$ " . number_format($subtovista,2,",",".");?> </td>
                                <td><?php echo "R$ " . number_format($mostrar['preco_carta'],2,",",".");?> </td>
                                <td><?php echo "R$ " . number_format($subtocart,2,",",".");?> </td>


                                <td class="td-actions"><a href="home.php?acao=del&id_produto=<?php echo $mostrar['id_produto'];?>" class="btn btn-small btn-danger"><i class="btn-icon-only icon-trash"> </i></a>
                                
                                </td>
                            </tr>
                        
                        <?php 
                          
                                endforeach;


                    endif;
                        ?>
                         <tr>
                            <td colspan="5" ><h3>Total a Pagar</h3></td>
               
                            <td><?php echo "R$ " . number_format($totalvista,2,",",".");?></td>  
                            <td></td>
                            <td><?php echo "R$ " . number_format($totalcart,2,",",".");?></td>


                         </tr>
          

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

