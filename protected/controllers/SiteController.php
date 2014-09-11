<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
        if(yii::app()->user->isGuest)
        {
            $this->actionLogin();
        }
        else
        {
            // renders the view file 'protected/views/site/index.php'
            // using the default layout 'protected/views/layouts/main.php'
            //NOTAS
            $connection=Yii::app()->db;
            $sql = "SELECT e.id, e.data, e.obs, f.nome FROM encomenda e LEFT JOIN fornecedores f ON e.idfornecedor = f.id WHERE e.idestado <> 3 AND e.obs <> '' AND e.obs IS NOT NULL ORDER BY e.data DESC";
            $command=$connection->createCommand($sql);
            $rows=$command->queryAll();

            //
            $sql1 = "SELECT c.id, f.nome, c.datacontrolo1, c.datacontrolo2, c.datacontrolo3, c.fim FROM contrato c ";
            $sql1 = $sql1 . " LEFT JOIN funcionarios f ON c.idutilizador = f.id ";
            $sql1 = $sql1 . " WHERE (c.fim IS NULL OR c.fim >= NOW() OR c.fim = '0000-00-00 00:00:00') ";
            $sql1 = $sql1 . " AND ( c.datacontrolo1 <= DATE_ADD(NOW(),INTERVAL 15 DAY) ";
            $sql1 = $sql1 . " OR c.datacontrolo2 <= DATE_ADD(NOW(),INTERVAL 15 DAY) ";
            $sql1 = $sql1 . " OR c.datacontrolo3 <= DATE_ADD(NOW(),INTERVAL 15 DAY) )";
            $command1=$connection->createCommand($sql1);
            $rows1=$command1->queryAll();
            $this->render('index', array("notas" => $rows, "contratos" => $rows1));
        }
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

    public function actionEncomenda()
    {
        if(isset($_POST) && count($_POST))
        {
            $count = 0;
            $arr = $_POST;
            $loja = $arr["loja"];
            $transaction = Yii::app()->db->beginTransaction();
            $req = new Requesicao();
            $req->data = date('Y-m-d H:i:s');
            $req->idloja = $loja;
            $req->iduser = Yii::app()->user->id;
            $ok = true;
            try
            {
                if($req->save())
                {
                    foreach($arr as $a=>$v)
                    {
                        if($this->startsWith($a,"ID_"))
                        {
                            $id = str_replace("ID_","",$a);
                            //echo "[[".$id."]]";
                            $stock = $arr["stock".$id];
                            //$stocks = $arr["stock".$id] . "";
                            $enc = $arr["enc".$id];
                            //$encs = $arr["enc".$id] . "";
                            //echo "<<".$stock."--".$enc.">>";
                            //if((!empty($stock) || !empty($enc)) && ($stock > 0 || $enc > 0))
                            if(is_numeric($stock) && ($stock > -1) || (is_numeric($enc) && $enc > -1))
                            {
                                $reql = new RequesicaoLinha();
                                $reql->encomenda = "0".$enc;
                                $reql->idartigo = $id;
                                $reql->inventario = "0".$stock;
                                $reql->idreq = $req->id;
                                $artigo = Artigos::model()->findByPk($reql->idartigo);
                                if(isset($artigo))
                                {
                                    $reql->idunidadeenc = $artigo->tipounidade_enc;
                                    $reql->idunidadeinv = $artigo->tipounidade_stock;
                                }
                                if($reql->save())
                                {
                                    echo "-->";
                                    $ok = $ok && true;
                                    if($reql->encomenda > 0)
                                    {
                                        $encL = new EncomendaLinha();
                                        $encL->idloja = $loja;
                                        $encL->idartigo = $reql->idartigo;
                                        $encL->quantidade = $reql->encomenda;
                                        $encL->idreqlinha = $reql->id;
                                        $encL->idunidadeenc = $reql->idunidadeenc;
                                        $encL->idunidadeinv = $reql->idunidadeinv;
                                        if(isset($artigo))
                                        {
                                            $encL->idfornecedor = $artigo->idfornecedor;

                                        }
                                        else
                                        {
                                            $encL->idfornecedor = -1;
                                        }
                                        if($encL->save())
                                        {
                                            $ok = $ok && true;
                                        }
                                        else
                                        {
                                            $ok = $ok && false;
                                        }
                                    }
                                    $count++;
                                }
                                else
                                {
                                    print_r( $reql->getErrors());
                                    $ok = $ok && false;
                                }
                            }
                            else
                            {
                                //echo "no sense";
                            }
                        }
                    }
                }
                else
                {
                    //print_r( $req->getErrors());
                    $ok = false;
                }
            }
            catch(Exception $ex)
            {
                $ok = false;
                echo $ex->getMessage();
            }

            if($count < 1)
            {
                $ok = false;
                //echo ":(";
            }
            else
            {
                //echo ":)";
            }

            if($ok == true)
            {
                $transaction->commit();
                Yii::app()->user->setFlash('success', "Encomenda criada com sucesso!");
            }
            else
            {
                $transaction->rollBack();
                Yii::app()->user->setFlash('error', "Erro ao criar encomenda!");
            }
        }

        $id = 1;
        if(isset($_GET["id"]) && !empty($_GET["id"]) && $_GET["id"] > 0)
            $id = $_GET["id"];

        $sql = "SELECT a.id AS 'ID', a.descricao AS 'Descricao', precounidadeencomenda, precounidadeinventario, l.nome AS 'Loja', f.nome AS 'Fornecedor',  ";
        $sql = $sql . "ee.nome AS 'Encomenda', een.nome AS 'Entrega', tu1.nome AS 'Unidade Encomenda', tu2.nome AS 'Unidade Stock' ";
        $sql = $sql . " FROM artigos a ";
        $sql = $sql . " LEFT JOIN artigoloja al ON a.id = al.idartigo ";
        $sql = $sql . " LEFT JOIN fornecedores f ON a.idfornecedor = f.id ";
        $sql = $sql . " LEFT JOIN loja l ON al.idloja = l.id ";
        $sql = $sql . " LEFT JOIN entidadeencomenda ee ON al.idencomenda = ee.id ";
        $sql = $sql . " LEFT JOIN entidadeentrega een ON al.identrega = een.id ";
        $sql = $sql . " LEFT JOIN tipounidade tu1 ON a.tipounidade_enc = tu1.id ";
        $sql = $sql . " LEFT JOIN tipounidade tu2 ON a.tipounidade_stock = tu2.id ";
        $sql = $sql . " WHERE a.activo = 1 AND al.idloja = " . $id . " AND al.activo = 1";
        $sql = $sql . " ORDER BY f.nome ASC, a.descricao ASC ";

        $connection=Yii::app()->db;
        $command=$connection->createCommand($sql);
        $rows=$command->queryAll();

        $sql2 = "SELECT idartigo, inventario, encomenda FROM requesicao_linha WHERE idreq = (SELECT MAX(id) FROM requesicao WHERE idloja = ".$id.");";
        $command2=$connection->createCommand($sql2);
        $rows2=$command2->queryAll();
        $rowsOld = array();
        foreach($rows2 as $r2)
        {
            $rowsOld["i".$r2["idartigo"]] = $r2["inventario"];
            $rowsOld["e".$r2["idartigo"]] = $r2["encomenda"];
        }

        $this->render('encomenda',array('id' => $id,'rows'=>$rows, 'rows2' => $rowsOld));
    }

    public function actionExportExcel($id)
    {

        $sql = "SELECT a.id AS 'ID', a.descricao AS 'Descr', precounidadeencomenda, precounidadeinventario, l.nome AS 'Loja', f.nome AS 'Fornecedor',  ";
        $sql = $sql . "ee.nome AS 'Encomenda', een.nome AS 'Entrega', tu1.nome AS 'UnEncomenda', tu2.nome AS 'UnStock' ";
        $sql = $sql . " FROM artigos a ";
        $sql = $sql . " LEFT JOIN artigoloja al ON a.id = al.idartigo ";
        $sql = $sql . " LEFT JOIN fornecedores f ON a.idfornecedor = f.id ";
        $sql = $sql . " LEFT JOIN loja l ON al.idloja = l.id ";
        $sql = $sql . " LEFT JOIN entidadeencomenda ee ON al.idencomenda = ee.id ";
        $sql = $sql . " LEFT JOIN entidadeentrega een ON al.identrega = een.id ";
        $sql = $sql . " LEFT JOIN tipounidade tu1 ON a.tipounidade_enc = tu1.id ";
        $sql = $sql . " LEFT JOIN tipounidade tu2 ON a.tipounidade_stock = tu2.id ";
        $sql = $sql . " WHERE a.activo = 1 AND al.idloja = " . $id . " AND al.activo = 1";
        $sql = $sql . " ORDER BY f.nome ASC, a.descricao ASC ";

        $connection=Yii::app()->db;
        $command=$connection->createCommand($sql);
        $rows=$command->queryAll();
        $data = array(
            1 => array ('ID', 'Descricao', 'Fornecedor', 'Stock', 'Unidade Stock', 'Encomenda', 'Unidade Encomenda'),
        );
        $i = 2;
        foreach($rows as $r)
        {
            $unStock = "";
            $unEncomenda = "";
            $fornecedor = "";
            $descricao = "";

            $unStock = $r["UnStock"];
            $unEncomenda = $r["UnEncomenda"];
            $fornecedor = $r["Fornecedor"];
            $descricao = $r["Descr"];

            //array_push($data, array($r["ID"],$r["Descricao"],$r["Fornecedor"],'',$r["Unidade Stock"], '', $r["Unidade Encomenda"]));
            array_push($data, array($r["ID"],$descricao,$fornecedor,'',$unStock, '', $unEncomenda));
            $i++;
        }
        /*$data = array(
            1 => array ('Name', 'Surname'),
            array('Schwarz', 'Oliver'),
            array('Test', 'Peter')
        );*/
        $loja = Loja::model()->findByPk($id);

        Yii::import('application.extensions.phpexcel.JPhpExcel');
        $xls = new JPhpExcel('ISO-8859-1', false, 'My Test Sheet');
        $xls->addArray($data);
        $xls->generateXML($loja->nome);
    }



    public function startsWith($haystack, $needle)
    {
        return $needle === "" || strpos($haystack, $needle) === 0;
    }

    public function endsWith($haystack, $needle)
    {
        return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
    }

    public  function actionDate()
    {
        $now = date("Y-m-d H:i:s");
        $now2 = new DateTime($now);
        $dayofWeek = date("N");
        $dayofWeek1 = date("N");
        $dayofWeek += 3;
        //$now2 = $now->add(new DateInterval('P2D'));
        if($dayofWeek >= $dayofWeek1)
        {
            $addDays = 7 + (1-1);
        }
        else
        {
            $addDays = (1-3);
        }
        date_add($now2, date_interval_create_from_date_string(''.$addDays.' days'));
        $now21 = $now2->format("Y-m-d") . " 00:00:00";
        $this->render("date",array('now'=>$now, 'dayofWeek' => $dayofWeek, 'now2' => $now21));
    }

    public function actionCalendarioEntregas()
    {
        $connection=Yii::app()->db;
        $sql = "SELECT ef.id, f.nome AS fornecedor, ef.data, ef.idloja, l.corloja, l.nome from entregafornecedor ef LEFT JOIN fornecedores f ON ef.idfornecedor = f.id";
        $sql = $sql . " LEFT JOIN loja l ON ef.idloja = l.id";
        $command=$connection->createCommand($sql);
        $rows=$command->queryAll();

        $sql1 = "SELECT f.nome, c.fim, c.datacontrolo1, c.datacontrolo2, c.datacontrolo3 FROM contrato c LEFT JOIN funcionarios f ON c.idutilizador = f.id;";
        $command1=$connection->createCommand($sql1);
        $rows1=$command1->queryAll();

        $sql = "SELECT l.corloja, l.nome FROM loja l";
        $command=$connection->createCommand($sql);
        $rows2=$command->queryAll();
        $this->render("calendarioEntregas", array("marcacoes" => $rows, "lojas" => $rows2, "contratos" => $rows1));
    }

    public function actionDocumentos()
    {
        $dataProvider=new CActiveDataProvider('Loja');
        $this->render('documentos',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    public function actionPrintInv($id)
    {
        $sql = "SELECT a.id AS 'ID', a.descricao AS 'Descricao', precounidadeencomenda, precounidadeinventario, l.nome AS 'Loja', f.nome AS 'Fornecedor',  ";
        $sql = $sql . "ee.nome AS 'Encomenda', een.nome AS 'Entrega', tu1.nome AS 'Unidade Encomenda', tu2.nome AS 'Unidade Stock' ";
        $sql = $sql . " FROM artigos a ";
        $sql = $sql . " LEFT JOIN artigoloja al ON a.id = al.idartigo ";
        $sql = $sql . " LEFT JOIN fornecedores f ON a.idfornecedor = f.id ";
        $sql = $sql . " LEFT JOIN loja l ON al.idloja = l.id ";
        $sql = $sql . " LEFT JOIN entidadeencomenda ee ON al.idencomenda = ee.id ";
        $sql = $sql . " LEFT JOIN entidadeentrega een ON al.identrega = een.id ";
        $sql = $sql . " LEFT JOIN tipounidade tu1 ON a.tipounidade_enc = tu1.id ";
        $sql = $sql . " LEFT JOIN tipounidade tu2 ON a.tipounidade_stock = tu2.id ";
        $sql = $sql . " WHERE a.activo = 1 AND al.idloja = " . $id . " AND al.activo = 1";
        $sql = $sql . " ORDER BY f.nome ASC, a.descricao ASC ";
        $this->layout = "none";
        $connection=Yii::app()->db;
        $command=$connection->createCommand($sql);
        $rows=$command->queryAll();
        $loja = Loja::model()->findByPk($id);
        $mpdf = Yii::app()->ePdf->mpdf();
        $mpdf->useSubstitutions = false;
        $mpdf->setAutoTopMargin = 'stretch';
        $mpdf->setAutoBottomMargin = 'strech';
        $mpdf->SetFooter('{PAGENO}');
        $mpdf->WriteHTML($this->render("printInv",array("loja" => $loja, "artigos" => $rows), true));
        $mpdf->Output();

    }

    public function actionPrintEnc($id)
    {
        $sql = "SELECT a.id AS 'ID', a.descricao AS 'Descricao', precounidadeencomenda, precounidadeinventario, l.nome AS 'Loja', f.nome AS 'Fornecedor',  ";
        $sql = $sql . "ee.nome AS 'Encomenda', een.nome AS 'Entrega', tu1.nome AS 'Unidade Encomenda', tu2.nome AS 'Unidade Stock' ";
        $sql = $sql . " FROM artigos a ";
        $sql = $sql . " LEFT JOIN artigoloja al ON a.id = al.idartigo ";
        $sql = $sql . " LEFT JOIN fornecedores f ON a.idfornecedor = f.id ";
        $sql = $sql . " LEFT JOIN loja l ON al.idloja = l.id ";
        $sql = $sql . " LEFT JOIN entidadeencomenda ee ON al.idencomenda = ee.id ";
        $sql = $sql . " LEFT JOIN entidadeentrega een ON al.identrega = een.id ";
        $sql = $sql . " LEFT JOIN tipounidade tu1 ON a.tipounidade_enc = tu1.id ";
        $sql = $sql . " LEFT JOIN tipounidade tu2 ON a.tipounidade_stock = tu2.id ";
        $sql = $sql . " WHERE a.activo = 1 AND al.idloja = " . $id . " AND al.activo = 1";
        $sql = $sql . " ORDER BY f.nome ASC, a.descricao ASC ";
        $this->layout = "none";
        $connection=Yii::app()->db;
        $command=$connection->createCommand($sql);
        $rows=$command->queryAll();
        $loja = Loja::model()->findByPk($id);
        $mpdf = Yii::app()->ePdf->mpdf();
        $mpdf->useSubstitutions = false;
        $mpdf->setAutoTopMargin = 'stretch';
        $mpdf->setAutoBottomMargin = 'strech';
        $mpdf->SetFooter('{PAGENO}');
        $mpdf->WriteHTML($this->render("printEnc",array("loja" => $loja, "artigos" => $rows), true));
        $mpdf->Output();
    }
}