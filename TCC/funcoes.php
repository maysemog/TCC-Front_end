<?php
//essa parte vai ficar responsável para decidir se usuario vai ser tipo 1(user) ou 2 (adm), aqui também tem avisoo refernte se o login foi bem sucedido e depois para apaga-lo. Por fim, redirecionar o adm e user caso o cadstro nãpo seja concluido
function Niveis(){

    if (@isset($_SESSION['usu_id'])){ 

        switch($_SESSION['usu_id']){
    
            case 1:
                $mudaLink = 'user_acesso_user1.php';
                break;
            case 2:
                $mudaLink = 'adm_acesso2.php';
                break;
        }
    }
    else{
        $mudaLink = 'menu.php';
    }
    return $mudaLink;
}
function permiteUsuario1(){

    if ($_SESSION['tipo_usu_id'] != 1) {

        $_SESSION['msg'] = "Área restrita";
        header("Location: menu.php");
    }
}

function permiteUsuario2(){
    
    if (($_SESSION['tipo_usu_id'] != 2) || (!$_SESSION['aut'])) { 

        $_SESSION['msg'] = "Área restrita";
        header("Location:menu.php");
    }
}

function mostraAviso(){

    if(isset($_SESSION['msg'])){
                        
        echo '<div class="alert alert-secondary rounded-0" role="alert">';
        echo $_SESSION['msg'] . '</div>';
        return $_SESSION['msg'];

    }
    if(isset($_SESSION['msgcad'])){

        echo '<div class="alert alert-secondary rounded-0" role="alert">';
        echo $_SESSION['msgcad'] . '</div>';
        return $_SESSION['msgcad'];
    }
}

function apagaAviso(){
    
    if(isset($_SESSION['msg'])){
                        
        unset($_SESSION['msg']);
    }
    if(isset($_SESSION['msgcad'])){

        unset($_SESSION['msgcad']);
    }
}
function mostraBotaoLogout(){
    if (isset($_SESSION['aut']) && $_SESSION['aut']) {
        echo '<li><a href="logout.php">Deslogar</a></li>';
    }
}
?>
