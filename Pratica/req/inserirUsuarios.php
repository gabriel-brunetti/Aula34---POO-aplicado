<?php

    include('DB.php');
    include('Utils.php');

    Utils::criarUsuario('administrador@teste', 'teste', 1);
    Utils::criarUsuario('usuario@teste', 'teste', 2);
    Utils::criarUsuario('espectador@teste', 'teste', 3);
?>