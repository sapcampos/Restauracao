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

<?php
if(isset($notas) && count($notas) > 0)
{
    echo "<br/>";
    echo "<br/>";
    echo "<h3 style='text-align: right;'>Notas Administrativas</h3>";
    ?>
    <table class="notas" style="width:100%; border:1px solid #000">
        <thead>
        <tr>
            <th style="width:15%; border-right: 1px solid #000;">Data</th>
            <th style="width:85%; border-right: 1px solid #000;">Mensagem</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($contratos as $c)
        {?>
            <tr style="border-bottom: 1px solid #000;">
                <td style="width:10%; border-right: 1px solid #000; padding-left: 5px;"><?php
                    if($c["fim"] != '0000-00-00 00:00:00')
                    {

                    }else
                    {
                        $msg = "";
                        $date = new DateTime();
                        $date->add(new DateInterval('P15D'));
                        $controlDate = $date->format('Y-m-d');
                        $d1 = new DateTime($c["datacontrolo1"]);
                        $d2 = new DateTime($c["datacontrolo2"]);
                        $d3 = new DateTime($c["datacontrolo3"]);
                        $dataregistar = $controlDate;
                        $msg = "";
                        if($d3 < $controlDate)
                        {
                            $dataregistar = $c["datacontrolo3"];
                            $msg = " 3ª mês periodo experimental";
                        }
                        elseif($d2 < $controlDate)
                        {
                            $dataregistar = $c["datacontrolo2"];
                            $msg = " 2ª mês periodo experimental";
                        }
                        else
                        {
                            $dataregistar = $c["datacontrolo1"];
                            $msg = " 1ª mês periodo experimental";
                        }
                        $_dataamostrar = new DateTime($dataregistar);
                        $_dataamostrar = $_dataamostrar->format('Y-m-d');
                    }
                    echo "<a href=\"".$this->createUrl("contrato/update",array("id"=>$c["id"]))."\">".$_dataamostrar."</a>";?></td>
                <td style="width:20%; border-right: 1px solid #000; padding-left: 5px;"><?php echo $c["nome"] . $msg;?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } ?>