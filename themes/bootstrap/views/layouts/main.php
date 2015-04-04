<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/jquery-ui-1.10.4.custom.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/colorPicker.css" />
    <!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/ui.jqgrid.css" />-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <!--<script src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.jqGrid.min.js" type="text/javascript"></script>-->
    <script src="<?php echo Yii::app()->baseUrl; ?>/js/bootstrap-datetimepicker.min.js"></script>
    <script src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.colorPicker.js" type="text/javascript"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>
</head>

<body>

<?php
if(!Yii::app()->user->isGuest && Yii::app()->user->id == 1)
{
$this->widget('bootstrap.widgets.TbNavbar',array(
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                //array('label'=>'Home', 'url'=>array('/site/index')),
                array('label'=>'Configurações', 'url'=>'#', 'items' => array(
                    array('label'=>'Artigos', 'url'=>array('/artigos/index')),
                    array('label'=>'Listas Artigos', 'url'=>array('/artigos/imprimirArtigos')),
                    array('label'=>'Fornecedores', 'url'=>array('/fornecedores/index')),
                    array('label'=>'Concelhos', 'url'=>array('/concelhos/index')),
                    array('label'=>'Lojas', 'url'=>array('/loja/index')),
                    array('label'=>'Utilizadores', 'url'=>array('/utilizadores/index')),
                    array('label'=>'Ent. Encomenda', 'url'=>array('/entidadeEncomenda/index')),
                    array('label'=>'Ent. Entrega', 'url'=>array('/entidadeEntrega/index')),
                    array('label'=>'Tipo Artigo', 'url'=>array('/tipoArtigo/index')),
                    array('label'=>'Tipo Unidade', 'url'=>array('/tipoUnidade/index')),
                    array('label'=>'Documentos', 'url'=>array('/site/documentos')),
                )),
                array('label'=>'Encomendas', 'url'=>'#', 'items' => array(
                    array('label'=>'Criar Encomenda', 'url'=>array('/site/encomenda')),
                    array('label'=>'Lista Encomenda', 'url'=>array('/encomendas/index')),
                    array('label'=>'Pesq. Encomenda', 'url'=>array('/encomendas/pesquisa')),
                    array('label'=>'Estatisticas', 'url'=>array('/encomendasFornecedor/estatisticas')),
                    array('label'=>'Estatisticas Custos', 'url'=>array('/encomendasFornecedor/estatisticasCusto')),
                    array('label'=>'Graficos Encomendas', 'url'=>array('/encomendas/estatistica')),
                    array('label'=>'Gerador Inventario', 'url'=>array('/encomendas/gerarInventario')),
                    array('label'=>'Info Fornecedor', 'url'=>array('/encomendas/getEvFornecedor')),
                )),
                array('label'=>'Enc. a Fornecedor', 'url'=>'#', 'items' => array(
                    array('label'=>'Criar Enc. Forn.', 'url'=>array('/encomendasFornecedor/create')),
                    array('label'=>'Lista Enc. Forn.', 'url'=>array('/encomendasFornecedor/index')),
                    array('label'=>'Calendário Ent.', 'url'=>array('/site/calendarioEntregas')),
                    array('label'=>'Lista Entregas', 'url'=>array('/entregaFornecedor/index')),

                )),
                array('label'=>'Administrativa', 'url'=>'#', 'items' => array(
                    array('label'=>'Contratos', 'url'=>array('/contrato/index')),
                    array('label'=>'Funcionários', 'url'=>array('/funcionarios/index')),

                )),
                array('label'=>'Registo Diário', 'url'=>'#', 'items' => array(
                    array('label'=>'Lista', 'url'=>array('/Registodiario/index')),
                    array('label'=>'Criar', 'url'=>array('/Registodiario/create')),
                )),
                //array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                //array('label'=>'Contact', 'url'=>array('/site/contact')),
                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
            ),
        ),
    ),
));
}
else if(Yii::app()->user->id > 1)
{
    $this->widget('bootstrap.widgets.TbNavbar',array(
        'items'=>array(
            array(
                'class'=>'bootstrap.widgets.TbMenu',
                'items'=>array(
                    //array('label'=>'Home', 'url'=>array('/site/index')),

                    array('label'=>'Encomendas', 'url'=>'#', 'items' => array(
                        array('label'=>'Artigos', 'url'=>array('/artigos/index')),
                        array('label'=>'Criar Encomenda', 'url'=>array('/site/encomenda')),
                        array('label'=>'Lista Encomenda', 'url'=>array('/encomendas/index')),
                        array('label'=>'Documentos', 'url'=>array('/site/documentos')),
                        array('label'=>'Listas Artigos', 'url'=>array('/artigos/imprimirArtigos')),
                        array('label'=>'Estatisticas', 'url'=>array('/encomendasFornecedor/estatisticas')),
                        array('label'=>'Estatisticas Custos', 'url'=>array('/encomendasFornecedor/estatisticasCusto')),
                        array('label'=>'Graficos Encomendas', 'url'=>array('/encomendas/estatistica')),
                    )),
                    array('label'=>'Registo Diário', 'url'=>'#', 'items' => array(
                        array('label'=>'Lista', 'url'=>array('/Registodiario/index')),
                        array('label'=>'Criar', 'url'=>array('/Registodiario/create')),
                    )),
                    //array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                    //array('label'=>'Contact', 'url'=>array('/site/contact')),
                    array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                ),
            ),
        ),
    ));
}?>

<div class="container" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">

	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
