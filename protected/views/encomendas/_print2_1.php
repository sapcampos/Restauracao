<html>
<head>
    <meta charset="utf-8">
</head>
<body>

<table style="float:left;width:100%;">
    <thead style="margin-bottom:10px;">
    <tr style="background-color:#5e9655;color:#ffffff;font-weight:bold;height:20px;padding:5px;text-align:center;">
        <td colspan="4"></td>
        <?php
        foreach($rows2 as $_id => $val)
        {
            $req = Requesicao::model()->findByPk($_id);
            ?>
            <td colspan="2" style="border-bottom: 1px solid #fff;"><?php echo (isset($req)) ? $req->data : "";?> </td>
        <?php
        }?>
    </tr>
    <tr style="background-color:#5e9655;color:#ffffff;font-weight:bold;height:40px;padding:5px;text-align:center;">
        <td>Fornecedor</td>
        <td style="width:270px;">Artigo</td>
        <td>Encomenda</td>
        <td>Entrega</td>
        <?php
        foreach($rows2 as $_id => $val)
        {?>
            <td>Inv.</td>
            <td>Enc.</td>
        <?php }?>
    </tr>
    </thead>
    <tbody>