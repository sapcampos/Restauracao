<?php
/**
 * Created by PhpStorm.
 * User: sapc
 * Date: 01/12/13
 * Time: 22:47
 */
?>
<form method="post">
<h2>Fornecedor: <?php echo $nome;?></h2><!--<br/>-->
<h4>Data: <?php echo $data;?></h4>
<br/>
    <table style="float:left;width:100%;" cellspacing=5>
        <thead style="margin-bottom:10px;">
        <tr style="background-color:#5e9655;color:#ffffff;font-weight:bold;height:40px;padding:5px;text-align:center;">
            <td>Artigo</td>
            <?php
            foreach($rows1 as $r1)
            {
                $codeAviludo = "";
                if($isAviludo)
                {
                    switch($r1["id"])
                    {
                        case 1:
                            $codeAviludo = "(401927 M2)";
                            break;
                        case 2:
                            $codeAviludo = "(401927 M1)";
                            break;
                        case 3:
                            $codeAviludo = "(403630 M1)";
                            break;
                        case 5:
                            $codeAviludo = "(402467 M1)";
                            break;
                        case 9:
                            $codeAviludo = "(402467 M3)";
                            break;
                        case 10:
                            $codeAviludo = "(406434 M1)";
                            break;
                        case 11:
                            $codeAviludo = "(406719 M1)";
                            break;
                    }
                }
                echo "<td>".$r1["nome"]."";
                if($codeAviludo != "")
                {
                    echo "<br/>".$codeAviludo;
                }
                echo "</td>";
            }
            ?>
        </tr>
        </thead>
        <tbody>
        <?php
        $i = 0;
        foreach($rows2 as $r2)
        {
            if($i%2 == 0)
            {
                echo "<tr style=\"background-color:#bbeae6\">";
                $color = "#ccc";
            }
            else
            {
                echo "<tr>";
                $color = "#e6e6e6";
            }
            echo "<td>&nbsp;".$r2["descricao"]."</td>";
            foreach($rows1 as $r1)
            {

                if(isset($rows[$r2["id"]."-".$r1["id"]]))
                    echo "<td style=\"text-align:center;vertical-align:middle;\"><input type=\"number\" step=\"any\" name=\"".$r2["id"]."-".$r1["id"]."\" value=\"".$rows[$r2["id"]."-".$r1["id"]]."\" style=\"width:50px;text-align:right;\"/></td>";
                else
                    echo "<td style=\"text-align:center;vertical-align:middle;\"><input type=\"number\" step=\"any\" name=\"".$r2["id"]."-".$r1["id"]."\" value=\"0\" style=\"width:50px;text-align:right;\"/></td>";
            }
            echo "</tr>";
            $i++;
        }


        ?>
        </tbody>
    </table>
    <br/>
    <div style="width:100%;float:left;">
        Estado:
        <select name="estado">
            <?php
            foreach($rows3 as $r3)
            {
                if($idestado == $r3["id"])
                {
                    echo "<option value=\"".$r3["id"]."\" SELECTED>".$r3["nome"]."</option>";
                }
                else
                {
                    echo "<option value=\"".$r3["id"]."\" >".$r3["nome"]."</option>";
                }
            }
            ?>
        </select>
    </div>
    <br/>
    <div style="width:100%;float:left;">
    Obs:
    <textarea name="obs" style="width:500px; height: 150px;"><?php echo $obs;?></textarea>
    </div>
    <!--<input type="submit" value="Gravar"/>-->
    <?php /*$this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Gravar',
        'type'=>'submit', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'normal', // null, 'large', 'small' or 'mini'
    ));*/ ?>
    <input type="submit" value="Gravar" />
    <div style="width:100%">
        <div style="text-align:right;">
            <?php echo CHtml::link("[Imprimir]",$this->createUrl("print", array("id"=>$id)), array("target" => "_BLANK"));?>
                &nbsp;&nbsp;

            <?php echo CHtml::link("[Imprimir Com Preços]",$this->createUrl("print", array("id"=>$id, "price" => 1)), array("target" => "_BLANK"));?>
        </div>
    </div>

</form>
