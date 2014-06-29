<!DOCTYPE html>
<html>
<head>

</head>
<body>
<table style="border: 1px solid #000000">
    <tr><td style="text-align: center;"><strong>Artigo</strong></td></tr>

<?php if(isset($rows))
{
foreach($rows as $r)
{
echo "<tr><td style=\"border-top: 2px solid #000; font-size:11px;\">".$r["descricao"]."</td></tr>";
}
}?>
</table>
</body>
</html>