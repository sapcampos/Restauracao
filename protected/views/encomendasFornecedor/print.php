<style type="text/css" xmlns="http://www.w3.org/1999/html">

table{
border-collapse:collapse;
border:1px solid #000000;
}

table td{
border:1px solid #000000;
}

.title{
    color: #ffffff;
    /*font-weight: bold;*/
}
</style>
<div style="width: 100%; text-align: center;">
<h1>Nota de Encomenda</h1>
</div>
<br/>
<div style="width=100%;">
    <div style="width:110px;float:left;">
        <img src="<?php echo Yii::app()->baseUrl."/images/iceitmrpizza.jpeg"; ?>" width="100px" height="75px"/>
    </div>
    <div style="float:left; font-size: 10px; width:300px; font-family: Verdana, Arial, sans-serif;">
        VIVAINFUSÃO, LDA (NIF <i>509010423</i>)
        <br/>
        SABORES DO FUTURO,LDA (NIF <i>508173787</i>)
        <br/>
        VIVA A COMIDA,LDA (NIF <i>50730719</i>)
        <br/>
        VERDADEIRAS TENTAÇÕES,LDA (NIF <i>509153151</i>)
        <br/>
    </div>
    <div style="float:left; width:250px;font-size: 10px; font-family: Verdana, Arial, sans-serif;">
        <strong></srong>Escritório</strong>
        <br/>
        <strong>Morada:</strong>
        <br/>
        Alva Park, n.º 2 Fracção B
        <br/>
        2445-012 Pataias
        <br/>
        <strong>Contactos:</strong>
        <br/>
        <strong>Telef.</strong>244 092 000/Fax: 244 828 281
        <br/>
        <strong>Tlm:</strong> 936 572 713
        <br/>
        <strong>Email:</strong>
        <br/>
            vivainfusao@sapo.pt
        <br/>
            saboresdofuturo@sapo.pt

    </div>
</div>
<h3>Fornecedor: <?php echo $fornecedor;?></h3>
<br/>
<div style="font-size: 11px;">
    <strong>Data: <?php echo $data;?></strong>
</div>
<br/>
<br/>

<table style="float:left;width:100%;font-size:12px;" cellspacing=2>
    <thead style="margin-bottom:10px;">
    <tr style="background-color:#666;color:#ffffff;font-weight:bold;height:40px;padding:5px;text-align:center;">
        <td class="title" style="width:40%;">Artigo</td>
        <td class="title" style="width:10%;">Unidade</td>
        <?php
        $width = 60/count($rows1);
        foreach($rows1 as $r1)
        {
            echo "<td class=\"title\" style=\"width:".$width."%;text-align:center;\">".$r1["nome"]."</td>";
        }
        ?>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($rows2 as $r2)
    {
        echo "<tr>";
        echo "<td style=\"text-align:left;vertical-align:middle;\">&nbsp;".$r2["descricao"]."</td>";
        echo "<td style=\"text-align:left;vertical-align:middle;\">&nbsp;".$r2["unidade"]."</td>";
        foreach($rows1 as $r1)
        {

            if(isset($rows[$r2["id"]."-".$r1["id"]]))
                echo "<td style=\"text-align:center;vertical-align:middle;\">".$rows[$r2["id"]."-".$r1["id"]]."</td>";
            else
                echo "<td style=\"text-align:center;vertical-align:middle;\">--</td>";
        }
        echo "</tr>";
        $i++;
    }
    echo "--->";
    print_r($rowsUnidades);
    ?>
    </tbody>
</table>