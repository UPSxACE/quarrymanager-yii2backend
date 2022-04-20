<?php

?>

<?php
$estado = $modelEncomenda->ultimoEstadoId();
switch($estado){
    case 1: //estado = pendente
        $dica = 'Confira os dados';
        $botao = '<a href="/dashboard/encomendas-action-tooltip-step" class="btn btn-secondary">Conferi os dados</a>';
        break;
    case 2: // estado = dados confirmados
        $dica = 'Confira o stock';
        $botao = '<a href="/dashboard/encomendas-action-tooltip-step" class="btn btn-secondary">Conferi o stock</a>';
        break;
    case 3: // estado stock confirmado
        $dica = 'Pronto para validação';
        $botao = '<a href="/dashboard/encomendas-action-tooltip-step" class="btn btn-secondary">Validar encomenda</a>';
        break;
    case 4: // estado = aguardar pagamento
        $dica = 'À espera do pagamento do cliente';
        $botao = '<a href="/dashboard/encomendas-action-tooltip-step" class="btn btn-secondary">Confirmar pagamento</a>';
        break;
    case 5: // estado = pagamento confirmado
        $dica = 'Mobilize o stock';
        $botao = '<a href="/dashboard/encomendas-action-tooltip-step" class="btn btn-secondary">Mobilizei o stock</a>';
        break;
    case 6: //estado = em espera
        $dica = 'Agende as recolhas';
        $botao = '<a href="/dashboard/encomendas-action-tooltip-step" class="btn btn-secondary">Agendei as recolhas</a>';
        break;
    case 7: //estado = recolhas agendadas
        $dica = '';
        $botao = '';
        break;
    case 8: //estado = recebido
        $dica = 'À espera do feedback do Cliente';
        $botao = '';
    case 9: //estado = finalizado
        $dica = 'Cliente apresentou feedback';
        $botao = '';
    case 10: //estado = cancelado
        $dica = '';
        $botao = '';

}
?>

<div class="dashboardInnerDiv h-100">
    <span><i>O</i> Status: </span><span><?= $modelEncomenda->ultimoEstadoNome() ?></span><span> (<?= $dica ?>)</span>
    <br>
    <?= $botao ?>
</div>


