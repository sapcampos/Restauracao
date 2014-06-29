<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">

    // Load the Visualization API and the piechart package.
    google.load('visualization', '1.0', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);


    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Data', 'Inventário <?php echo "(".$unidadeInv.")";?>', 'Encomenda <?php echo "(".$unidadeEnc.")";?>'],
            <?php
                if(isset($linhas) && count($linhas) > 0)
                {
                    foreach($linhas as $row)
                    {
                        echo "['".$row["data"]."',".$row["inventario"].",".$row["encomenda"]."],";
                    }
                }
            ?>
        ]);

        var options = {
            title: '<?php echo str_replace("'","`",$artigo) . " - ". str_replace("'","`",$loja);?>'
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>

<div style="width:80%; margin:auto; padding-bottom: 50px;">
    Loja:
    <select id="loja">
        <?php
            if(isset($lojas) && count($lojas) > 0)
            {
                foreach($lojas as $l)
                {
                    if($l->id == $idloja)
                    {
                        echo "<option selected value=\"".$l->id."\">".$l->nome."</option>";
                    }
                    else
                    {
                        echo "<option  value=\"".$l->id."\">".$l->nome."</option>";
                    }
                }
            }
    ?>
    </select>

    Artigo:
    <select id="artigo">
        <?php
        if(isset($artigos) && count($artigos) > 0)
        {
            foreach($artigos as $art)
            {
                if($art["id"] == $idartigo)
                {
                    echo "<option selected value=\"".$art["id"]."\">".$art["descricao"]."</option>";
                }
                else
                {
                    echo "<option  value=\"".$art["id"]."\">".$art["descricao"]."</option>";
                }
            }
        }
        ?>
    </select>

    <input type="button" value="Pesquisar" onclick="javascript:pesquisa();">
</div>

<div id="chart_div" style="width:100%; height:500px"></div>

<div>
    <table style="width: 80%; margin: auto;">
        <thead style="border: solid 1px #000000">
            <tr>
                <th>Data</th>
                <th>Inventário <?php echo "(".$unidadeInv.")";?></th>
                <th>Encomenda <?php echo "(".$unidadeEnc.")";?></th>
            </tr>
        </thead>
        <tbody>
        <?php
            if(isset($linhas) && count($linhas) > 0)
            {
                foreach($linhas as $row)
                {
                    echo "<tr style=\"border: solid 1px #000000\"><td style=\"text-align:center;\">".$row["data"]."</td><td style=\"text-align:center;\">".$row["inventario"]."</td><td style=\"text-align:center;\">".$row["encomenda"]."</td></tr>";
                }
            }
        ?>
        </tbody>
    </table>
</div>
<script>
    function pesquisa()
    {
        idloja = $("#loja").val();
        idartigo = $("#artigo").val();
        window.location = "<?php $url=$this->createUrl('encomendas/estatistica'); echo $url;?>?idartigo="+idartigo+"&idloja="+idloja;
    }

    $("#loja").live("change", function() {
        url = '<?php echo $this->createUrl("encomendas/getartigos");?>';
        data = { idloja: $("#loja").val()};
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function(data) {
                $("#artigo").html(data);
            },
            dataType: 'html'
        });
    });
</script>