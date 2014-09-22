<?php

class ContratoController extends Controller
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
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
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
		$model=new Contrato;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        $model->ndperex = 90;
        $model->idtipofuncionario = 1;
        $model->inicio = date('Y-m-d') + ' 00:00:00';
		if(isset($_POST['Contrato']))
		{
			$model->attributes=$_POST['Contrato'];
            $model->inicio=$_POST['Contrato']['inicio'];
            $model->fim=$_POST['Contrato']['fim'];
            $days1 = intval(($model->ndperex/3)) -1 ;
            $days2 = (intval(($model->ndperex/3))*2) - 1;
            $days3 = (intval(($model->ndperex))) - 1;
            $date1 = date('Y-m-d', strtotime($model->inicio. ' + ' . $days1 .' days'));
            $date2 = date('Y-m-d', strtotime($model->inicio. ' + ' . $days2 .' days'));
            $date3 = date('Y-m-d', strtotime($model->inicio. ' + ' . $days3 .' days'));
            $model->datacontrolo1 = $date1;
            $model->datacontrolo2 = $date2;
            $model->datacontrolo3 = $date3;
			if($model->save())
				$this->redirect(array('update','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Contrato']))
		{
            //print_r($_POST['Contrato']);
			$model->attributes=$_POST['Contrato'];
            $model->inicio=$_POST['Contrato']['inicio'];
            $model->fim=$_POST['Contrato']['fim'];
            //$model->inicio = $model->inicio + ' 00:00:00';
            //echo "---".$model->inicio."---";
            $days1 = intval(($model->ndperex/3)) -1 ;
            $days2 = (intval(($model->ndperex/3))*2) - 1;
            $days3 = (intval(($model->ndperex))) - 1;
            $date1 = date('Y-m-d', strtotime($model->inicio. ' + ' . $days1 .' days'));
            $date2 = date('Y-m-d', strtotime($model->inicio. ' + ' . $days2 .' days'));
            $date3 = date('Y-m-d', strtotime($model->inicio. ' + ' . $days3 .' days'));
            $model->datacontrolo1 = $date1;
            $model->datacontrolo2 = $date2;
            $model->datacontrolo3 = $date3;
			if($model->save())
				$this->redirect(array('update','id'=>$model->id));
            else
            {
                print_r($model->getErrors());
            }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
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
		$dataProvider=new CActiveDataProvider('Contrato');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Contrato('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Contrato']))
			$model->attributes=$_GET['Contrato'];

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
		$model=Contrato::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='contrato-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
