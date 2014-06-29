[
<?php foreach($rows as $row)
{?>
{id:"<?php echo $row["id"]; ?>",data:"<?php echo $row["data"]; ?>",fornecedor:"<?php echo $row["nome"]; ?>",estado:"<?php echo $row["nomeEstado"]; ?>"},
<?php } ?>
]