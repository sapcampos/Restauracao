<?php
/* @var $this ArtigosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Artigos',
);

$this->menu=array(
	array('label'=>'Criar Artigos', 'url'=>array('create')),
	//array('label'=>'Gerir Artigos', 'url'=>array('admin')),
);
?>

<h1>Artigos</h1>

<div style="float:left;">
<?php
$lojas = Loja::model()->findAll();
echo "<select id=\"loja\">";
if($idl !=0 )
    echo "<option value=\"0\">Todas</option>";
else
    echo "<option value=\"0\" SELECTED>Todas</option>";
if($idl ==-1 )
    echo "<option value=\"-1\" SELECTED>Nenhuma</option>";
else
    echo "<option value=\"-1\" >Nenhuma</option>";
foreach($lojas as $l)
{
    $sel = "";
    if($idl == $l->id)
        $sel = " SELECTED ";
    echo "<option value=\"".$l->id."\" $sel>".$l->nome."</option>";
}
echo "</select>";
?>

<?php
$fornecedores = Fornecedores::model()->findAll();
echo "<select id=\"fornecedor\">";
if($idf !=0 )
    echo "<option value=\"0\">Todas</option>";
else
    echo "<option value=\"0\" SELECTED>Todas</option>";
if($idf ==-1 )
    echo "<option value=\"-1\" SELECTED>Nenhuma</option>";
else
    echo "<option value=\"-1\" >Nenhuma</option>";
foreach($fornecedores as $f)
{
    $sel = "";
    if($idf == $f->id)
        $sel = " SELECTED ";
    echo "<option value=\"".$f->id."\" $sel>".$f->nome."</option>";
}
echo "</select>";
?>
</div>
<div style="float:left; padding-left: 20px;">
    <form method="POST">
        Pesquisa:
        <input id="pesq" name="pesq" type="text" value="<?php echo isset($text) ? $text : "";?>"/>
        <input type="submit" value="Pesquisar"/>
    </form>



</div>

<?php /*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));*/

//echo count($dataProvider->getData());

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'id' => 'artigosGrid',
    'columns' => array(
        array(
            'name' => 'Artigo',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->descricao), array("artigos/update", "id" => $data->id))',
        ),
        array(
            'name' => 'Fornecedor',
            'type' => 'raw',
            'value' => 'isset($data->fornecedor0) ? $data->fornecedor0->nome : ""',
        ),
        array(
            'name' => 'Tipo Artigo',
            'type' => 'raw',
            'value' => 'isset($data->tipoartigo0) ? $data->tipoartigo0->nome : ""',
        ),
        array(
            'name' => 'Preço Enc',
            'type' => 'raw',
            'value' => '$data->precounidadeencomenda',
        ),
        array(
            'name' => 'Activo',
            'type' => 'raw',
            'value' => 'CHtml::CheckBox("Activo",$data->activo, array("disabled"=>true,))',
        ),
        array(
            'name' => 'Bloq Enc',
            'type' => 'raw',
            'value' => 'CHtml::CheckBox("Bloqueado",$data->blockorders, array("disabled"=>true,))',
        ),
        array(
            'name' => 'Tem Lojas',
            'type' => 'raw',
            'value' => '$data->TemLoja()',
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{delete}',
            'htmlOptions' => array('class'=>'MyDeleteBtn'),
            'headerHtmlOptions'=>array('class'=>'MyDeleteBtn'),
        ),
    ),
));

?>
<br/>
<br/>
<?php echo CHtml::Link("Imprimir", $this->createUrl('print',array('idl'=>$idl, 'idf' => $idf, 'pesq' => $text)),array("target" => "_BLANK"));?>

<script>
    $( "#loja" ).change(function() {
        idl = $( "#loja" ).val();
        idf = $( "#fornecedor" ).val();
        window.location = "<?php $url=$this->createUrl("artigos/index"); echo $url;?>?idl="+idl+"&idf="+idf;
    });

    $( "#fornecedor" ).change(function() {
        idf = $( "#fornecedor" ).val();
        idl = $( "#loja" ).val();
        window.location = "<?php $url=$this->createUrl("artigos/index"); echo $url;?>?idl="+idl+"&idf="+idf;
    });
</script>
