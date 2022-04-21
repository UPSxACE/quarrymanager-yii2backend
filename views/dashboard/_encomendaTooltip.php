<?php

?>

<?php
$estado = $modelEncomenda->ultimoEstadoId();
switch($estado){
    case 1: //estado = pendente
        $dica = 'Confira os dados';
        $botao = '<a href="/dashboard/encomendas/' . $modelEncomenda->id . '/step" class="btn btn-secondary w-100" style="font-size: 1.5rem">Conferi os dados</a>';
        break;
    case 2: // estado = dados confirmados
        $dica = 'Confira o stock';
        $botao = '<a href="/dashboard/encomendas/' . $modelEncomenda->id . '/step" class="btn btn-secondary w-100" style="font-size: 1.5rem">Conferi o stock</a>';
        break;
    case 3: // estado stock confirmado
        $dica = 'Pronto para validação';
        $botao = '<a href="/dashboard/encomendas/' . $modelEncomenda->id . '/step" class="btn btn-secondary w-100" style="font-size: 1.5rem">Validar encomenda</a>';
        break;
    case 4: // estado = aguardar pagamento
        $dica = 'À espera do pagamento do cliente';
        $botao = '<a href="/dashboard/encomendas/' . $modelEncomenda->id . '/step" class="btn btn-secondary w-100" style="font-size: 1.5rem">Confirmar pagamento</a>';
        break;
    case 5: // estado = pagamento confirmado
        $dica = 'Mobilize o stock';
        $botao = '<a href="/dashboard/encomendas/' . $modelEncomenda->id . '/step" class="btn btn-secondary w-100" style="font-size: 1.5rem">Mobilizei o stock</a>';
        break;
    case 6: //estado = em espera
        $dica = 'Agende as recolhas';
        $botao = '<a href="/dashboard/encomendas/' . $modelEncomenda->id . '/step" class="btn btn-secondary w-100" style="font-size: 1.5rem">Agendei as recolhas</a>';
        break;
    case 7: //estado = recolhas agendadas
        $dica = '';
        $botao = '';
        break;
    case 8: //estado = recebido
        $dica = 'À espera do feedback do Cliente';
        $botao = '';
        break;
    case 9: //estado = finalizado
        $dica = 'Cliente apresentou feedback';
        $botao = '';
        break;
    case 10: //estado = cancelado
        $dica = '';
        $botao = '';
        break;

}
?>
<div class="dashboardInnerDiv h-100">
    <div class="p-3">
        <div class="pb-2">
            <span class="h3"><i>O</i> <strong>Status: </strong></span class="h3"><span class="h3"><?= $modelEncomenda->ultimoEstadoNome() ?></span class="h3"><span class="h3"> (<?= $dica ?>)</span>
        </div>


        <?= $botao ?>
    </div>

</div>


