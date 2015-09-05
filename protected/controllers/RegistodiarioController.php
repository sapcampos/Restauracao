<?php

class RegistodiarioController extends Controller
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
	public function actionCreate($id = 0)
	{
		$model=new Registodiario;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        $userID = Yii::app()->user->id;
        $model->Estado = 0;
        $model->IDUtilizador = $userID;
        $model->Data = date("Y-m-d H:i:s");
        if($id > 0)
        {
            $loja = $id;
        }
        else {
            $loja = 1;
        }
        $model->IDLoja = $loja;

        //$gelados = Artigosvenda::model()->findAllByAttributes(array("tipoartigovenda" => 1, "Activo" => 1, "Deleted" => 0));
        //$pastelaria = Artigosvenda::model()->findAllByAttributes(array("tipoartigovenda" => 2, "Activo" => 1, "Deleted" => 0));
        //$gelados1 = Artigosvendaloja::model()->findAllByAttributes(array("IDLoja" => $id, "Activo" => 1))->iDArtigoVenda->findAllByAttributes(array("tipoartigovenda" => 1, "Activo" => 1, "Deleted" => 0));
        //$pastelaria1 = Artigosvendaloja::model()->findAllByAttributes(array("IDLoja" => $id, "Activo" => 1))->iDArtigoVenda->findAllByAttributes(array("tipoartigovenda" => 1, "Activo" => 1, "Deleted" => 0));
        //$gelados1 = Artigosvenda::model()->artigosvendalojas->findAllByAttributes(array("IDLoja" => $id, "Activo" => 1));
        $criteria = new CDbCriteria;
        $criteria->alias = "t";
        $criteria->compare('tipoartigovenda', 1);
        $criteria->compare('t.Activo', 1);
        $criteria->compare('Deleted', 0);
        $criteria->with = array('artigosvendalojas');
        $criteria->compare( 'artigosvendalojas.IDLoja', $loja, true );
        $criteria->compare( 'artigosvendalojas.Activo', 1, true );
        $criteria->together = true;


        $criteria1 = new CDbCriteria;
        $criteria1->alias = "t";
        $criteria1->compare('tipoartigovenda', 2);
        $criteria1->compare('t.Activo', 1);
        $criteria1->compare('Deleted', 0);
        $criteria1->with = array('artigosvendalojas');
        $criteria1->compare( 'artigosvendalojas.IDLoja', $loja, true );
        $criteria1->compare( 'artigosvendalojas.Activo', 1, true );
        $criteria1->together = true;

        $gelados = Artigosvenda::model()->findAll($criteria);
        $pastelaria = Artigosvenda::model()->findAll($criteria1);

        if(isset($_POST['Registodiario']))
		{
            $model->Estado = 0;
            $model->IDUtilizador = $userID;
			$model->attributes=$_POST['Registodiario'];
			if($model->save())
            {
                if(isset($_POST["ArtigoVenda"])) {
                    $LOJ = $_POST["ArtigoVenda"];
                }

                if(isset($_POST["ArtigoPst"])) {
                    $LOJ1 = $_POST["ArtigoPst"];
                }

                if(isset($_POST["Pasteis"])) {
                    $PST = $_POST["Pasteis"];
                }

                foreach($gelados as $g)
                {
                    $rg = new Registogelado();
                    $rg->IDArtigo = $g->ID;
                    $rg->IDLoja = $model->IDLoja;
                    $rg->IDRegisto = $model->ID;

                    if (isset($LOJ["".$g->ID."inicio"])) {
                        $rg->PesoInicial = $LOJ["".$g->ID."inicio"];
                    } else {
                        $rg->PesoInicial = 0;
                    }

                    if (isset($LOJ["".$g->ID."fim"])) {
                        $rg->PesoFinal = $LOJ["".$g->ID."fim"];
                    } else {
                        $rg->PesoFinal = 0;
                    }

                    if (isset($LOJ["".$g->ID."total"])) {
                        $rg->Variacao = $LOJ["".$g->ID."total"];
                    } else {
                        $rg->Variacao = 0;
                    }
                    $rg->save();
                }

                foreach($pastelaria as $p)
                {
                    $rp = new Registopastelaria();
                    $rp->IDArtigoVenda = $p->ID;
                    $rp->IDLoja = $model->IDLoja;
                    $rp->IDRegisto = $model->ID;
                    $rp->PesoUnitario = $p->PesoIdeal;

                    if (isset($LOJ1["".$p->ID."montra"])) {
                        $rp->Montra = $LOJ1["".$p->ID."montra"];
                    } else {
                        $rp->Montra = 0;
                    }

                    if (isset($LOJ1["".$p->ID."quebras"])) {
                        $rp->Quebras = $LOJ1["".$p->ID."quebras"];
                    } else {
                        $rp->Quebras = 0;
                    }

                    if (isset($LOJ1["".$p->ID."vendidos"])) {
                        $rp->Vendidos = $LOJ1["".$p->ID."vendidos"];
                    } else {
                        $rp->Vendidos = 0;
                    }

                    if (isset($LOJ1["".$p->ID."pesoideal"])) {
                        $rp->PesoIdeal = $LOJ1["".$p->ID."pesoideal"];
                    } else {
                        $rp->PesoIdeal = 0;
                    }
                    $rp->save();
                }
                //print_r($PST);
                for($i = 0; $i < 3; $i++)
                {
                    $pasteis = new Registopasteis();
                    if (isset($PST[($i * -1)."iniciais"])){
                        $pasteis->iniciais = $PST[($i * -1)."iniciais"];
                    } else {
                        $pasteis->iniciais = 0;
                    }
                    //echo "1";
                    if (isset($PST[($i * -1)."cozidos"])){
                        $pasteis->cozidos = $PST[($i * -1)."cozidos"];
                    } else {
                        $pasteis->cozidos = 0;
                    }
                    //echo "2";
                    if (isset($PST[($i * -1)."sobras"])){
                        $pasteis->sobras = $PST[($i * -1)."sobras"];
                    } else {
                        $pasteis->sobras = 0;
                    }
                    //echo "3";
                    if (isset($PST[($i * -1)."horaprod"])){
                        $pasteis->horaprod = $PST[($i * -1)."horaprod"];
                    } else {
                        $pasteis->horaprod = "";
                    }
                    //echo "4";
                    $pasteis->idregisto = $model->ID;

                    $pasteis->save();

                    print_r($pasteis->getErrors());
                    echo "Save->";
                }
                $this->redirect(array('update','id'=>$model->ID));
            }
		}

		$this->render('create',array(
			'model'=>$model,
            'loja' =>$loja,
            'gelados' => $gelados,
            'pastelaria' => $pastelaria,
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
        $loja = $model->IDLoja;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        $gelados = Registogelado::model()->findAllByAttributes(array("IDRegisto" => $model->ID));
        $pastelaria = Registopastelaria::model()->findAllByAttributes(array("IDRegisto" => $model->ID));
        if(isset($_POST['Registodiario']))
        {
            $model->attributes=$_POST['Registodiario'];
            if($model->save())
            {
                if(isset($_POST["ArtigoVenda"])) {
                    $LOJ = $_POST["ArtigoVenda"];
                }
                if(isset($_POST["ArtigoPst"])) {
                    $LOJ1 = $_POST["ArtigoPst"];
                }
                foreach($gelados as $g)
                {
                    if (isset($LOJ["".$g->ID."inicio"])) {
                        $g->PesoInicial = $LOJ["".$g->ID."inicio"];
                    } else {
                        $g->PesoInicial = 0;
                    }

                    if (isset($LOJ["".$g->ID."fim"])) {
                        $g->PesoFinal = $LOJ["".$g->ID."fim"];
                    } else {
                        $g->PesoFinal = 0;
                    }

                    if (isset($LOJ["".$g->ID."total"])) {
                        $g->Variacao = $LOJ["".$g->ID."total"];
                    } else {
                        $g->Variacao = 0;
                    }
                    $g->save();
                }

                foreach($pastelaria as $p)
                {
                    if (isset($LOJ1["".$p->ID."montra"])) {
                        $p->Montra = $LOJ1["".$p->ID."montra"];
                    } else {
                        $p->Montra = 0;
                    }

                    if (isset($LOJ1["".$p->ID."quebras"])) {
                        $p->Quebras = $LOJ1["".$p->ID."quebras"];
                    } else {
                        $p->Quebras = 0;
                    }

                    if (isset($LOJ1["".$p->ID."vendidos"])) {
                        $p->Vendidos = $LOJ1["".$p->ID."vendidos"];

                    } else {
                        $p->Vendidos = 0;

                    }

                    if (isset($LOJ1["".$p->ID."pesoideal"])) {
                        $p->PesoIdeal = $LOJ1["".$p->ID."pesoideal"];
                    } else {
                        $p->PesoIdeal = 0;
                    }
                    $p->save();

                }
                $this->redirect(array('update','id'=>$model->ID));
            }
        }

		$this->render('update',array(
			'model'=>$model,
            'loja' =>$loja,
            'gelados' => $gelados,
            'pastelaria' => $pastelaria,
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
		$dataProvider=new CActiveDataProvider('Registodiario');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Registodiario('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Registodiario']))
			$model->attributes=$_GET['Registodiario'];

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
		$model=Registodiario::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='registodiario-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
