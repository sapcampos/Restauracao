<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<style>
    .notas thead
    {
        background-color: #66AACC;
    }
</style>
<?php /*$this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
    'heading'=>'Bem-vindo',
));*/ ?>
<h2>Bem-Vindo</h2>

<?php //$this->endWidget(); ?>
<?php
if(isset($notas) && count($notas) > 0)
{
    echo "<br/>";
    echo "<br/>";
echo "<h3 style='text-align: right;'>Notas</h3>";
?>
<table class="notas" style="width:100%; border:1px solid #000">
    <thead>
    <tr>
        <th style="width:10%; border-right: 1px solid #000;">Data</th>
        <th style="width:20%; border-right: 1px solid #000;">Fornecedor</th>
        <th style="width:70%">Nota</th>
    </tr>
    </thead>
    <tbody>
    <?php
        foreach($notas as $n)
        {?>
        <tr style="border-bottom: 1px solid #000;">
            <td style="width:10%; border-right: 1px solid #000; padding-left: 5px;"><?php
                $date = new DateTime($n["data"]);
                echo "<a href=\"".$this->createUrl("encomendasFornecedor/update",array("id"=>$n["id"]))."\">".$date->format('Y-m-d')."</a>";?></td>
            <td style="width:20%; border-right: 1px solid #000; padding-left: 5px;"><?php echo $n["nome"];?></td>
            <td style="width:70%; padding-left: 5px;"><?php echo $n["obs"];?></td>
        </tr>
            <?php } ?>
    </tbody>
</table>
<?php } ?>