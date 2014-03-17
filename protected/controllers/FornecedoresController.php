<?php

class FornecedoresController extends Controller
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
		$model=new Fornecedores;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

        $arr = array();
        $lojas = Loja::model()->findAllByAttributes(array('activo' => 1));
        foreach($lojas as $l)
        {
            $lef = new Lojaentregafornecedor();
            $lef->diaentrega = -1;
            $lef->idfornecedor = -1;
            $lef->idloja = $l->id;
            $arr[$l->id] = $lef;
        }
		if(isset($_POST['Fornecedores']))
		{
			$model->attributes=$_POST['Fornecedores'];
			if($model->save())
            {
                foreach($_POST['Lojaentregafornecedor'] as $i=>$item1)
                {
                    $item = new Lojaentregafornecedor();
                    if(isset($_POST['Lojaentregafornecedor'][$i]))
                    {
                        $item->attributes=$_POST['Lojaentregafornecedor'][$i];
                        $item->idfornecedor = $model->id;
                        $item->idloja = $i;
                        if($item->validate())
                        {
                            $item->save();
                        }
                        else {
                        }
                    }
                }
				$this->redirect(array('update','id'=>$model->id));
            }
		}

		$this->render('create',array(
			'model'=>$model,
            'arr' => $arr,
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
        $arr = array();
        $lojas1 = Loja::model()->findAllByAttributes(array('activo' => 1));
        //print_r($lojas1);
        foreach($lojas1 as $l)
        {
            $criteria=new CDbCriteria;
            $criteria->condition='idloja=:idL AND idfornecedor=:idF';
            $criteria->params=array(':idL'=>$l->id, 'idF'=>$id );
            $item = Lojaentregafornecedor::model()->find($criteria);
            if(isset($item))
            {
                $arr[$l->id] = $item;
            }
            else
            {
                $arr[$l->id] = new Lojaentregafornecedor();
                $arr[$l->id]->idloja = $l->id;
            }
        }
		if(isset($_POST['Fornecedores']))
		{
			$model->attributes=$_POST['Fornecedores'];
			if($model->save())
            {
                if(isset($_POST['Lojaentregafornecedor']))
                {
                    $valid=true;

                    foreach($_POST['Lojaentregafornecedor'] as $i=>$item1)
                    {
                        if(isset($_POST['Lojaentregafornecedor'][$i]))
                        {
                            $criteria=new CDbCriteria;
                            $criteria->condition='idloja=:idL AND idfornecedor=:idF';
                            $criteria->params=array(':idL'=>$i, 'idF'=>$id );
                            $item = Lojaentregafornecedor::model()->find($criteria);
                            if(!isset($item))
                            {
                                $item = new Lojaentregafornecedor();
                                $item->idloja = $i;
                                $item->idfornecedor = $model->id;
                            }
                            $item->attributes=$_POST['Lojaentregafornecedor'][$i];
                            if($item->validate())
                            {
                                $item->save();
                            }
                            else
                            {
                                //throw new Exception("Erro ao gravar tradução noticia", "", "");
                            }
                        }
                    }
                }
				$this->redirect(array('update','id'=>$model->id));
            }
		}

		$this->render('update',array(
			'model'=>$model,
            'arr' => $arr,
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
		$dataProvider=new CActiveDataProvider('Fornecedores');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Fornecedores('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Fornecedores']))
			$model->attributes=$_GET['Fornecedores'];

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
		$model=Fornecedores::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='fornecedores-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
