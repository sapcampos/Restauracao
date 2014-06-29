<form method="post" >
    <?php
    $lojas = Loja::model()->findAllByAttributes(array("activo" => 1));
    ?>
    <strong>Lojas:</strong>
    <br/>
    <table>
    <?php
    $i = 0;
    $selLojas = explode(",", $lojas_s);
    foreach($lojas as $l)
    {
        ?>
        <?php if($i==0){?>
        <tr>
            <?php }?>
            <td style="padding: 10px;"><?php echo $l->nome;?></td>
            <td style="padding: 10px;"><input type="checkbox" name="<?php echo "l".$l->id;?>" value="<?php echo $l->id;?>" <?php if(in_array($l->id, $selLojas)){echo "checked";}else{echo "";} ?>></td>
            <?php if($i==3 ){?>
        </tr>
    <?php $i=0;}
        else{$i++;}?>
    <?php
    }
    ?>
    </table>

    <br/>
    <strong>Fornecedor:</strong>
    <br/>
    <select name="fornecedor">
        <?php
        $forn = Fornecedores::model()->findAll();
        foreach($forn as $f)
        {?>
            <option value="<?php echo $f->id;?>" <?php echo ($f->id == intval($fornecedorSel)) ? "selected" : "";?>><?php echo $f->nome;?></option>
        <?php } ?>
    </select>
    <br/>
    <input name="submt" type="submit" value="Pesquisar"/>
</form>
<div>
    <?php echo CHtml::link("Imprimir", $this->createUrl("artigos/ImprimirArtigosLista", array("loja" => $lojas_s, "fornecedor" => $fornecedorSel)), array("target" => "_BLANK"));?>
    <br/>
    <table style="border: 1px solid #000000">
        <tr><td style="text-align: center;"><strong>Artigo</strong></td></tr>

        <?php
        if(isset($rows))
        {
foreach($rows as $r)
{
    echo "<tr style=\"border: 1px solid #000000\"><td>".$r["descricao"]."</td></tr>";
}
        }?>
    </table>
<?php echo CHtml::link("Imprimir", $this->createUrl("artigos/ImprimirArtigosLista", array("loja" => $lojas_s, "fornecedor" => $fornecedorSel)), array("target" => "_BLANK"));
//echo $lojas_s . "--" . $fornecedorSel;?>
</div>