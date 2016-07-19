<?php
if(isset($_REQUEST['sair'])){
session_destroy();
session_unset(['usuarilog']);
session_unset(['senhalog']);

header("Location: index.php");

	
}
?>