<?php
/**
 * Created by PhpStorm.
 * User: sapc
 * Date: 01/12/13
 * Time: 22:47
 */
//print_r($rows);
?>
<form method="post">
<?php if(isset($rows3)){?>
<select id="fornecedor" name="fornecedor">
    <?php

        foreach($rows3 as $r3)
        {
            $sel = "";
            if ($r3["id"] == $id)
                $sel = "selected";
            echo "<option value=\"".$r3["id"]."\" $sel>".$r3["nome"]."</option>";
        }
    ?>
</select>
<?php } ?>
<table style="float:left;width:100%;" cellspacing=5>
    <thead style="margin-bottom:10px;">
        <tr style="background-color:#5e9655;color:#ffffff;font-weight:bold;height:40px;padding:5px;text-align:center;">
            <td>Artigo</td>
            <?php
                foreach($rows1 as $r1)
                {
                    echo "<td>".$r1["nome"]."</td>";
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
                echo "<td style=\"text-align:center;vertical-align:middle;\"><input type=\"text\" name=\"".$r2["id"]."-".$r1["id"]."\" value=\"".$rows[$r2["id"]."-".$r1["id"]]."\" style=\"width:50px;text-align:right;\"/></td>";
            else
                echo "<td style=\"text-align:center;vertical-align:middle;\"><input type=\"text\" name=\"".$r2["id"]."-".$r1["id"]."\" value=\"0\" style=\"width:50px;text-align:right;\"/></td>";
        }
        echo "</tr>";
        $i++;
    }


    ?>
    </tbody>
</table>

<input type="hidden" value="<?php
    if(isset($ids))
        echo $ids;
    else
        echo "";
?>" name="ids" />
<script>
    $( "#fornecedor" ).change(function() {
    idf = $( "#fornecedor" ).val();
    window.location = "<?php $url=$this->createUrl("encomendasFornecedor/create"); echo $url;?>?id="+idf;
    });
</script>
<input type="hidden" name="fornecedorId" value="<?php echo $id;?>"/>
<?php
?>
<input type="submit" value="Gravar"/>
</form>