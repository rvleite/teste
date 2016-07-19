<?php include("includes/header.php");?>
</head>
<body>
<?php include("includes/topo.php");?>

<?php
    if(isset($_GET["acao"])){
        $acao=$_GET['acao'];

        if ($acao=='welcome')				{include("pages/inicio.php");}
		
		// cadastrar 
		
		if ($acao=='cad_produto')			{include("pages/cad_produto.php");}
		
		if ($acao=='cad_usuario')			{include("pages/cad_usuario.php");}
		
		//Vizualizar
		
		if ($acao=='viz_produtos')			{include("pages/viz_produtos.php");}
		if ($acao=='viz_usuario')			{include("pages/viz_usuario.php");}
		
		//Edição
		
		if ($acao=='editar_produtos')		{include("pages/edit_produtos.php");}
		if ($acao=='editar_usuario')		{include("pages/edit_usuario.php");}

		//venda
		if ($acao=='venda_produtos')		{include("pages/vendas.php");}
		if ($acao=='venda_produto')			{include("pages/venda_produto.php");}
		if ($acao=='add')		    		{include("pages/carrinho.php");}
		if ($acao=='del')		    		{include("pages/carrinho.php");}
		if ($acao=='limpar')	    		{include("pages/carrinho.php");}

		// vincular usuários

		if ($acao=='vincular_usuario')	    {include("pages/vincular_usuario.php");}
		if ($acao=='vincular')	    		{include("pages/indicacao.php");}

		
    }else{
        include("pages/inicio.php");
    }
?>
<?php include("includes/footer.php");?>
</body>
</html>
