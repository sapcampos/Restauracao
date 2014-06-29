<?php

class ArtigosController extends Controller
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
				'actions'=>array('create','update','admin','delete', 'print', 'imprimirArtigos', 'imprimirArtigosLista'),
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
		$model=new Artigos;
        $arr = Array();
        $lojas = Loja::model()->findAll();
        foreach($lojas as $l)
        {
            $lojaA = new ArtigoLoja;
            $lojaA->idartigo = -1;
            $lojaA->idloja = $l->id;
            array_push($arr,$lojaA);
        }
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Artigos']))
		{
            $_POST['Artigos']['precounidadeencomenda']= str_replace(",",".",$_POST['Artigos']['precounidadeencomenda']);
			$_POST['Artigos']['precounidadeinventario']= str_replace(",",".",$_POST['Artigos']['precounidadeinventario']  );

			$model->attributes=$_POST['Artigos'];


			if($model->save())
            {
				if(isset($_POST['Loja']))
				{
					$loja_Op = $_POST['Loja'];
					$loja_Op1 = $_POST['LojaEnt'];
					$loja_Op2 = $_POST['LojaEnc'];
					//print_r($_POST['Loja']);
					$arr = array();
					foreach($lojas as $l)
					{
						$condition = array("idartigo" => $model->id, "idloja" => $l->id);
						$l1 = ArtigoLoja::model()->findByAttributes($condition);
						if(!isset($l1))
						{
							$l1 = new ArtigoLoja;
							$l1->idartigo = $model->id;
							$l1->idloja = $l->id;
						}
						$val = 0;
						$val2 = 0;
						$val3 = 0;
						$value = "";
						if(isset($loja_Op["".$l->id.""]))
							$value = $loja_Op["".$l->id.""];

						if($value == "on" || $value == 1)
							$val = 1;

						if(isset($loja_Op1["".$l->id.""]))
							$val2 = $loja_Op1["".$l->id.""];

						if(isset($loja_Op2["".$l->id.""]))
							$val3 = $loja_Op2["".$l->id.""];

						$l1->activo = $val;
						$l1->idencomenda = $val3;
						$l1->identrega = $val2;
						$l1->save();
						array_push($arr, $l1);
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
        $lojas_ = Loja::model()->findAll();
        $idFornecedor = $model->idfornecedor;

		if(isset($_POST['Artigos']))
		{

			$_POST['Artigos']['precounidadeencomenda']= str_replace(",",".",$_POST['Artigos']['precounidadeencomenda']);
			$_POST['Artigos']['precounidadeinventario']= str_replace(",",".",$_POST['Artigos']['precounidadeinventario']  );
			$model->attributes=$_POST['Artigos'];
            if($idFornecedor != $model->idfornecedor)
            {
                $this->updateFornecedorOpen($model->id,$model->idfornecedor);
            }


			if($model->save())
            {
                if(isset($_POST['Loja']))
					$loja_Op = $_POST['Loja'];
                if(isset($_POST['LojaEnc']))
                    $loja_Op1 = $_POST['LojaEnc'];
                if(isset($_POST['LojaEnt']))
                    $loja_Op2 = $_POST['LojaEnt'];

                foreach($lojas_ as $l)
                {
                    $condition = array("idartigo" => $id, "idloja" => $l->id);
                    $l1 = ArtigoLoja::model()->findByAttributes($condition);
                    if(!isset($l1))
                    {
                        $l1 = new ArtigoLoja;
                        $l1->idartigo = $model->id;
                        $l1->idloja = $l->id;
                    }
                    $val = 0;
                    $val2 = 0;
                    $val3 = 0;
                    if($model->activo == 0)
                    {
                        $val = 0;
                    }
                    else
                    {
                        if(isset($loja_Op) && count($loja_Op) > 0 && isset($loja_Op["".$l->id.""]))
                        {
                            $value = $loja_Op["".$l->id.""];
                            if($value == "on" || $value == 1)
                            {
                                $val = 1;
                                echo "(XX0-".$l->id."-)";
                            }
                            else
                            {
                                echo "(XX2-".$l->id."-)";
                            }
                        }
                        else
                        {
                            echo "(XX1-".$l->id."-)";
                        }
                    }

                    if(isset($loja_Op1["".$l->id.""]))
                        $val2 = $loja_Op1["".$l->id.""];

                    if(isset($loja_Op2["".$l->id.""]))
                        $val3 = $loja_Op2["".$l->id.""];

                    $l1->activo = $val;
                    $l1->idencomenda = $val2;
                    $l1->identrega = $val3;
                    $l1->save();
                    if($l1->activo == 0)
                    {
                        $this->deleteEncomendasOpen($model->id, $l->id);
                    }
                    array_push($arr, $l1);
                }
            }
		}
        else
        {

        }

        if(!isset($arr) || count($arr) ==0 )
        {
            foreach($lojas_ as $l)
            {
                $condition = array("idartigo" => $id, "idloja" => $l->id);
                $artL = ArtigoLoja::model()->findAllByAttributes($condition);
                if(!isset($artL) || count($artL)==0)
                {
                    $artL1 = new ArtigoLoja;
                    $artL1->idartigo = $id;
                    $artL1->idloja = $l->id;
                    $artL1->activo = 0;
                    array_push($arr, $artL1);
                    if($artL1->activo == 0)
                    {
                        $this->deleteEncomendasOpen($model->id, $l->id);
                    }
                }
                else
                {
                    array_push($arr, $artL[0]);
                    if($artL[0]->activo == 0)
                    {
                        $this->deleteEncomendasOpen($model->id, $l->id);
                    }
                }
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
        $idl = 0;
        $idf = 0;
        $text = "";
        if((isset($_GET["idf"]) && is_numeric($_GET["idf"]) && $_GET["idf"] != 0) || (isset($_GET["idl"]) && is_numeric($_GET["idl"]) && $_GET["idl"] != 0))
        {
		    if(isset($_GET["idl"]))
            {
                $idl = $_GET["idl"];
            }
            if(isset($_GET["idf"]))
            {
                $idf = $_GET["idf"];
            }
            $criteria = "";
            if($idl > 0 || $idf > 0)
            {
                if($idl > 0)
                {
                    $artigosLoja = ArtigoLoja::model()->findAllByAttributes(array('idloja' => $idl, 'activo' => 1));
                    if(isset($artigosLoja) && count($artigosLoja)>0)
                    {
                        foreach($artigosLoja as $al)
                        {
                            if(empty($criteria))
                                $criteria = $criteria . $al->id;
                            else
                                $criteria = $criteria . "," . $al->idartigo;
                        }
                        if(!empty($criteria))
                            $criteria = " id IN (" . $criteria . ") ";
                    }
                    else
                    {
                        if($idf == 0)
                            $idf = 0;
                        if($idl == 0)
                            $idl = 0;
                    }
                }
                if($idf > 0)
                {
                    if(!empty($criteria))
                    {
                        $criteria = $criteria . " AND idfornecedor = " . $idf;
                    }
                    else
                    {
                        $criteria = $criteria . " idfornecedor = " . $idf;
                    }
                }
            }
            else
            {
                if($idl < 0 && $idf < 0)
                {
                    $sql = "SELECT DISTINCT idartigo FROM ";
                    $sql = $sql . "(SELECT idartigo FROM (SELECT idartigo, sum(activo) as act FROM artigoloja GROUP BY idartigo) t WHERE t.act = 0) l ";
                    $sql = $sql . " UNION SELECT id FROM artigos WHERE id NOT IN (SELECT idartigo FROM artigoloja)";
                    $connection=Yii::app()->db;
                    $command=$connection->createCommand($sql);
                    $rows=$command->queryAll();
                    if(isset($rows) && count($rows)>0)
                    {
                        foreach($rows as $al)
                        {
                            if(empty($criteria))
                                $criteria = $criteria . $al["idartigo"];
                            else
                                $criteria = $criteria . "," . $al["idartigo"];
                        }
                        if(!empty($criteria))
                            $criteria = " id IN (" . $criteria . ") ";
                    }

                }
            }
        }

        if(isset($_POST["pesq"]) && !empty($_POST["pesq"]))
        {
            $text = $_POST["pesq"];
            if(!empty($criteria))
            {
                $criteria = $criteria. " AND descricao like '%" . $_POST["pesq"] . "%' ";
            }
            else
            {
                $criteria = " descricao like '%" . $_POST["pesq"] . "%' ";
            }
        }
        if(!empty($criteria))
        {

            $criteria1=new CDbCriteria(array(
                'condition'=>$criteria,
            ));

            $dataProvider=new CActiveDataProvider('Artigos',
            array(
                'pagination'=>array('pageSize'=>15),
                'criteria'=> $criteria1,
            )
            );
        }
        else
        {
             $dataProvider = new CActiveDataProvider('Artigos');
        }


        $dataProvider->pagination->pageSize=20;

        /*else
        {
		    $dataProvider=new CActiveDataProvider('Artigos');
        }*/
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'idf' => $idf,
            'idl' => $idl,
            'text' => $text,
		));
	}

    /**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Artigos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Artigos']))
			$model->attributes=$_GET['Artigos'];

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
		$model=Artigos::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='artigos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function actionPrint()
    {
        $idl = 0;
        $idf = 0;
        $text = "";
        if((isset($_GET["idf"]) && is_numeric($_GET["idf"]) && $_GET["idf"] != 0) || (isset($_GET["idl"]) && is_numeric($_GET["idl"]) && $_GET["idl"] != 0))
        {
            if(isset($_GET["idl"]))
            {
                $idl = $_GET["idl"];
            }
            if(isset($_GET["idf"]))
            {
                $idf = $_GET["idf"];
            }
            $criteria = "";
            if($idl > 0 || $idf > 0)
            {
                if($idl > 0)
                {
                    $artigosLoja = ArtigoLoja::model()->findAllByAttributes(array('idloja' => $idl, 'activo' => 1));
                    if(isset($artigosLoja) && count($artigosLoja)>0)
                    {
                        foreach($artigosLoja as $al)
                        {
                            if(empty($criteria))
                                $criteria = $criteria . $al->id;
                            else
                                $criteria = $criteria . "," . $al->idartigo;
                        }
                        if(!empty($criteria))
                            $criteria = " id IN (" . $criteria . ") ";
                    }
                    else
                    {
                        if($idf == 0)
                            $idf = 0;
                        if($idl == 0)
                            $idl = 0;
                    }
                }
                if($idf > 0)
                {
                    if(!empty($criteria))
                    {
                        $criteria = $criteria . " AND idfornecedor = " . $idf;
                    }
                    else
                    {
                        $criteria = $criteria . " idfornecedor = " . $idf;
                    }
                }
            }
            else
            {
                if($idl < 0 && $idf < 0)
                {
                    $sql = "SELECT DISTINCT idartigo FROM ";
                    $sql = $sql . "(SELECT idartigo FROM (SELECT idartigo, sum(activo) as act FROM artigoloja GROUP BY idartigo) t WHERE t.act = 0) l ";
                    $sql = $sql . " UNION SELECT id FROM artigos WHERE id NOT IN (SELECT idartigo FROM artigoloja)";
                    $connection=Yii::app()->db;
                    $command=$connection->createCommand($sql);
                    $rows=$command->queryAll();
                    if(isset($rows) && count($rows)>0)
                    {
                        foreach($rows as $al)
                        {
                            if(empty($criteria))
                                $criteria = $criteria . $al["idartigo"];
                            else
                                $criteria = $criteria . "," . $al["idartigo"];
                        }
                        if(!empty($criteria))
                            $criteria = " id IN (" . $criteria . ") ";
                    }

                }
            }
        }

        if(isset($_GET["pesq"]) && !empty($_GET["pesq"]))
        {
            $text = $_GET["pesq"];
            if(!empty($criteria))
            {
                $criteria = $criteria. " AND descricao like '%" . $text . "%' ";
            }
            else
            {
                $criteria = " descricao like '%" . $text . "%' ";
            }
        }
        if(!empty($criteria))
        {

            $criteria1=new CDbCriteria(array(
                'condition'=>$criteria,
            ));

            $dataProvider=new CActiveDataProvider('Artigos',
                array(
                    'pagination'=>array('pageSize'=>15),
                    'criteria'=> $criteria1,
                )
            );
        }
        else
        {
            $dataProvider = new CActiveDataProvider('Artigos');
        }


        $dataProvider->pagination->pageSize=20000;

        /*else
        {
		    $dataProvider=new CActiveDataProvider('Artigos');
        }*/
        $this->layout = 'none';

        $mpdf = Yii::app()->ePdf->mpdf();
        $mpdf->useSubstitutions = false;
        $mpdf->setAutoTopMargin = 'stretch';
        $mpdf->setAutoBottomMargin = 'strech';



        $mpdf->WriteHTML($this->render('_print', array('dataProvider'=>$dataProvider), true));
        $mpdf->Output();
    }

    private function updateFornecedorOpen($idArtigo, $newIdFornecedor)
    {
        try
        {
            $sql = "UPDATE encomenda_linha SET idfornecedor = ". $newIdFornecedor." WHERE idencomenda IS NULL AND idartigo = ". $idArtigo;
            $connection=Yii::app()->db;
            $command=$connection->createCommand($sql);
            $rowCount=$command->execute();
            return true;
        }
        catch(Exception $ex)
        {
            return false;
        }
    }

    private function deleteEncomendasOpen($idArtigo, $idLoja)
    {
        try
        {
            $sql = "DELETE FROM encomenda_linha WHERE idencomenda IS NULL AND idartigo = ". $idArtigo . " AND idloja = " . $idLoja;
            $connection=Yii::app()->db;
            $command=$connection->createCommand($sql);
            $rowCount=$command->execute();
            return true;
        }
        catch(Exception $ex)
        {
            return false;
        }
    }

    public function actionImprimirArtigos()
    {
        $rows = null;
        $lojas = "";
        $fornecedor = "";
        if(isset($_POST) && $this->validPost($_POST))
        {
            foreach($_POST as $key => $val)
            {
                if($key == "fornecedor")
                {
                    $fornecedor = $val;
                }
                if($key != "fornecedor" && $key != "submt")
                {
                    if(!empty($lojas))
                    {
                        $lojas = $lojas . ",".$val."";
                    }
                    else
                    {
                        $lojas = $lojas . "".$val."";
                    }
                }
            }
            if(!empty($lojas) && !empty($fornecedor))
            {
                $sql = "SELECT descricao FROM artigos WHERE id IN (SELECT idartigo FROM artigoloja WHERE idloja IN (".$lojas.") AND activo = 1) AND idfornecedor = " . $fornecedor . " ORDER BY descricao ASC";
                $connection=Yii::app()->db;
                $command=$connection->createCommand($sql);
                $rows=$command->queryAll();
            }
        }
        $this->render("printArtigos",array('rows' => $rows , 'lojas_s' => $lojas, 'fornecedorSel' => $fornecedor));
    }

    private function validPost($arr)
    {
        $f = 0;
        $l = 0;
        foreach($arr as $key=>$val)
        {
            //echo $key . "---" . $val;
            if($key == "fornecedor")
            {
                $f = 1;
            }
            if($key != "fornecedor" && $key == "submt")
            {
                $l++;
            }
        }
        //echo "(".$l.")";
        //echo "(".$f.")";
        if($l > 0 && $f > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function actionImprimirArtigosLista()
    {
        $rows = null;
        if(isset($_GET["loja"]) && isset($_GET["fornecedor"]))
        {
            $loja = $_GET["loja"];
            $fornecedor = $_GET["fornecedor"];
            if(!empty($loja) && !empty($fornecedor))
            {
                try{


                    $sql = "SELECT descricao FROM artigos WHERE id IN (SELECT idartigo FROM artigoloja WHERE idloja IN (".$loja.") AND activo = 1) AND idfornecedor = " . $fornecedor . " ORDER BY descricao ASC";
                    $connection=Yii::app()->db;
                    $command=$connection->createCommand($sql);
                    $rows=$command->queryAll();
                }
                catch(Exception $ex)
                {

                }
            }
        }
        $this->layout = 'none';
        $mpdf = Yii::app()->ePdf->mpdf();
        $mpdf->useSubstitutions = false;
        $mpdf->setAutoTopMargin = 'stretch';
        $mpdf->setAutoBottomMargin = 'strech';
        $mpdf->WriteHTML($this->render('_printLista', array('rows'=>$rows), true));
        $mpdf->Output();
    }
}
