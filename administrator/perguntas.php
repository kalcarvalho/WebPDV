<?php
include_once '../domain/TipoEquipamento.class.php';
include_once '../domain/Pergunta.class.php';
include_once '../persistence/TipoEquipamentoDAO.class.php';
include_once '../persistence/PerguntaDAO.class.php';

$td = new TipoEquipamentoDAO($system);
$tt = new TipoEquipamento();
$pd = new PerguntaDAO($system);
$pp = new Pergunta();

$rs = $td->listAll();

$sel = '';

if ($rs) {
    foreach ($rs as $tt) {
        $sel .= '<option value="' . $tt->getCodigo() . '">' . $tt->getDescricao() . '</option>';
    }
}

if (count($_POST) > 0) {
    $list = $pd->findByTipoEquipamento($_POST['equipamento_id']);
}
?>
<div class="content">
    <div class="painel-perguntas">
        <p><label></label><input name="submit" class="button" type="submit" value="Novo CheckList"></p>
    </div>
    <div class="painel-perguntas">
        <form action="index.php?p=perguntas" method="POST" class="form-perguntas">
            <p><label>Tipo de Equipamento</label>
                <select name="equipamento_id" class="field">
<?php echo $sel; ?>
                </select>
                <input name="submit" class="button" type="submit" value="Listar Perguntas">
            </p>
        </form>
    </div>
<?php if ($list) { ?>
    <table cellspacing="0">
        <tr class="header" >
            <th>Número</th>
            <th class="pergunta">Pergunta</th>
        </tr>
        <?php foreach($list as $pp) {?>
            <tr class="<?php echo ($i++ % 2 == 0 ? 'even' : 'odd'); ?>">
                <td class="id"><?php echo $pp->getCodigo(); ?></td>
                <td><?php echo $pp->getDescricao(); ?></td>
            </tr>
        <?php } ?>
    </table>
<?php } ?>
</div>

