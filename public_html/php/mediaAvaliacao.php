<?php
$somaAvaliacoes = "SELECT sum(vl_voto) FROM voto WHERE cd_trabalho = $cd_trabalho";
$soma = $conexao->consultar($somaAvaliacoes);

    if($soma[0][0] <> null) {
                
                $qtVotos = $conexao->consultar("SELECT count(vl_voto) FROM voto WHERE cd_trabalho = $cd_trabalho");
                $total =  (int)$soma[0][0];
                $divide = (int)$qtVotos[0][0];
                $media = $total/$divide;
                $media = number_format($media, 1);
                $decimal = explode('.', $media);
                $comparar = $decimal[1];                
                
                if($comparar <=5 ) { $media = floor($media);}
                if($comparar > 5) { $media = ceil($media); }
    }

?>