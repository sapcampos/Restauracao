<?php

class ArtigosvendaController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Artigosvenda;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        //$condition = array('activo' => 1);
        $lojas = Loja::model()->findAll();
		if(isset($_POST['Artigosvenda']))
		{
			$model->attributes=$_POST['Artigosvenda'];
			if($model->save()) {
                if(isset($_POST['Loja'])) {
                    $LOJ = $_POST['Loja'];
                }
                foreach($lojas as $l)
                {
                    $avl = new Artigosvendaloja();
                    $l1 = Artigosvendaloja::model()->findAllByAttributes(array('IDArtigoVenda'=>$model->ID, 'IDLoja' => $l->id));
                    //print_r($l1);
                    if(isset($l1) && count($l1) > 0)
                    {
                        $avl = $l1[0];
                    }
                    $avl->IDArtigoVenda = $model->ID;
                    $avl->IDLoja = $l->id;
                    //print_r($LOJ);
                    if(isset($LOJ) && isset($LOJ["'$l->id'"]))
                    {
                        //echo "1";
                        $avl->Activo = 1;
                    }
                    else{
                        //echo "0";
                        $avl->Activo = 0;
                    }
                    $avl->save();
                }
                $this->redirect(array('update', 'id' => $model->ID));
            }
		}

		$this->render('create',array(
			'model'=>$model,
            'lojas'=>$lojas,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
        $lojas = Loja::model()->findAll();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        //print_r($_POST);
		if(isset($_POST['Artigosvenda']))
		{
			$model->attributes=$_POST['Artigosvenda'];

			if($model->save())
            {
                if(isset($_POST['Loja'])) {
                    $LOJ = $_POST['Loja'];
                }
                foreach($lojas as $l)
                {
                    $avl = new Artigosvendaloja();
                    $l1 = Artigosvendaloja::model()->findAllByAttributes(array('IDArtigoVenda'=>$model->ID, 'IDLoja' => $l->id));
                    //print_r($l1);
                    if(isset($l1) && count($l1) > 0)
                    {
                        $avl = $l1[0];
                    }
                    $avl->IDArtigoVenda = $model->ID;
                    $avl->IDLoja = $l->id;
                    //print_r($LOJ);
                    if(isset($LOJ) && isset($LOJ["'$l->id'"]))
                    {
                        //echo "1";
                        $avl->Activo = 1;
                    }
                    else{
                        //echo "0";
                        $avl->Activo = 0;
                    }
                    $avl->save();
                }
                $this->redirect(array('update','id'=>$model->ID));
            }
		}

		$this->render('update',array(
			'model'=>$model,
            'lojas'=>$lojas,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
        $l = Artigosvendaloja::model()->findAllByAttributes(array('IDArtigoVenda'=>$id));
        foreach($l as $l1)
        {
            $l1->delete();
        }
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Artigosvenda');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Artigosvenda('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Artigosvenda']))
			$model->attributes=$_GET['Artigosvenda'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Artigosvenda::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='artigosvenda-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
