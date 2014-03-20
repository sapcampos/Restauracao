<?php

class EncomendasFornecedorController extends Controller
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
                'actions'=>array('create','update','admin','delete', 'print'),
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
    public function actionIndex()
    {
        /*$sql = "SELECT r.id AS id, data, l.nome AS nomeLoja, u.nome AS nomeUser FROM requesicao r ";
        $sql = $sql . " LEFT JOIN loja l ON r.idloja = l.id ";
        $sql = $sql . " LEFT JOIN Utilizadores u ON r.iduser = u.id";
        $sql = $sql . " ORDER BY data DESC";
        */
        $sql = "SELECT e.id, f.nome, e.data, ee.nome as 'nomeEstado' FROM encomenda e LEFT JOIN estadoencomenda ee ON e.idestado = ee.id LEFT JOIN fornecedores f ON e.idfornecedor = f.id";
        if(isset($_POST) && count($_POST) > 0)
        {
            $where = "";
            if(isset($_POST["idfornecedor"]) && !empty($_POST["idfornecedor"]))
            {
                $where = $where . " f.id = " . $_POST["idfornecedor"];
            }
            if(isset($_POST["datainicio"]) && !empty($_POST["datainicio"]))
            {
                if(empty($where))
                {
                    $where = $where . " e.data >= '" . $_POST["datainicio"] . "' " ;
                }
                else
                {
                    $where = $where . " AND e.data >= " . $_POST["datainicio"] . "' ";
                }
            }
            if(isset($_POST["datafim"]) && !empty($_POST["datafim"]))
            {
                if(empty($where))
                {
                    $where = $where . " e.data <= '" . $_POST["datafim"] ."' ";
                }
                else
                {
                    $where = $where . " AND e.data <= " . $_POST["datafim"] . "' ";
                }
            }
            if(!empty($where))
            {
                $sql = $sql . " WHERE " . $where;
            }
        }
        $sql = $sql . " ORDER BY e.id DESC";
        $id = 0;
        $connection=Yii::app()->db;
        $command=$connection->createCommand($sql);
        $rows=$command->queryAll();
        $this->render('index',array('id' => $id,'rows'=>$rows));

    }

    public function actionCreate($id = 0)
    {
        $connection=Yii::app()->db;
        if(isset($_POST) && count($_POST) > 0)
        {
            if($this->checkvalues($_POST))
            {

                /*$sql1 = "SELECT id, nome FROM restauracao.loja WHERE activo = 1 AND id NOT iN (6,7) ORDER BY nome ASC;";
                $command1=$connection->createCommand($sql1);
                $rows1=$command1->queryAll();
*/
                if($_POST["fornecedorId"] != 0 )
                {
                    $id = $_POST["fornecedorId"];
/*
                    $sql2 = "SELECT id, descricao FROM artigos WHERE idfornecedor = ".$id.";";
                    $command2=$connection->createCommand($sql2);
                    $rows2=$command2->queryAll();
  */

                    $ids = "";
                    if(isset($_POST["ids"]))
                    {
                        $ids = $_POST["ids"];
                    }

                    $transaction=$connection->beginTransaction();
                    try
                    {
                        $encF = new Encomenda();
                        $encF->data = date('Y-m-d H:i:s');
                        $encF->idfornecedor = $id;
                        if($encF->save())
                        {
                            $encId = $encF->id;
                            foreach($_POST as $key=>$val)
                            {
                                if($key != "fornecedorId" && $key !="fornecedor" && !empty($val) && intval($val) > 0)
                                {
                                    $encL = new Encomendalinhas();
                                    $encL->idencomenda = $encId;
                                    $encL->idfornecedor = $id;
                                    $arrInfo = explode("-",$key);
                                    if(isset($arrInfo[0]) && isset($arrInfo[1]) && !empty($arrInfo[0]) && !empty($arrInfo[1]))
                                    {
                                        $encL->idartigo = $arrInfo[0];
                                        $encL->idloja = $arrInfo[1];
                                        $encL->quantidade = $val;
                                        if(!$encL->save())
                                        {
                                            $ex = new Exception("");
                                            throw $ex;
                                        }
                                    }
                                }
                            }
                            if(!empty($ids))
                            {
                                $sqlUpdate = "UPDATE encomenda_linha SET idencomenda = " . $encF->id . " WHERE id IN (" . $ids .")";
                                $command=$connection->createCommand($sqlUpdate);
                                $rowsUp=$command->execute();
                            }
                            $transaction->commit();
                            $this->criarAgendamento($encF);
                            $this->redirect('create');
                        }

                   }
                   catch(Exception $ex)
                   {
                       $transaction->rollback();
                   }

                }
            }
            else
            {
                //mensagem nao tinha nada para gravar: tudo a zeros
            }
        }
        $sql3 = "SELECT id, nome FROM fornecedores WHERE id IN (SELECT idfornecedor FROM encomenda_linha WHERE idencomenda IS NULL AND quantidade > 0);";
        $command3=$connection->createCommand($sql3);
        $rows3=$command3->queryAll();
        $idFornecedor = -1;
        if(!empty($id) && $id > 0 && !isset($_POST) && count($_POST) == 0 )
        {
            $idFornecedor = $id;
        }
        elseif(!empty($id) && $id > 0)
        {
            $idFornecedor = $id;
        }
        elseif(isset($rows3) && count($rows3) > 0)
        {
            $idFornecedor = $rows3[0]["id"];
        }

        $sql = "SELECT quantidade AS quantidade, CONCAT(idartigo,'-',idloja) as 'index', id FROM encomenda_linha WHERE idencomenda IS NULL AND quantidade > 0 AND idfornecedor = ".$idFornecedor.";";
        $command=$connection->createCommand($sql);
        $rowsX=$command->queryAll();
        $rows = array();
        $ids = "";
        foreach($rowsX as $r)
        {
            if(isset($r["index"]) && isset($rows[$r["index"]]) && $rows[$r["index"]] > 0)
            {
                $rows[$r["index"]] = $rows[$r["index"]] + $r["quantidade"];
            }
            else
            {
                $rows[$r["index"]] = $r["quantidade"];
            }
            if(empty($ids))
            {
                $ids = $r["id"];
            }
            else
            {
                $ids = $ids . ",".$r["id"];
            }
        }


        $sql1 = "SELECT id, nome FROM loja WHERE activo = 1 AND id NOT iN (6,7) ORDER BY nome ASC;";
        $command1=$connection->createCommand($sql1);
        $rows1=$command1->queryAll();

        if($id == 0 && count($rows3) > 0)
        {
            $id = $rows3[0]["id"];
        }
        $sql2 = "SELECT id, descricao FROM artigos WHERE idfornecedor = ".$id."  AND id IN (SELECT idartigo FROM encomenda_linha WHERE idencomenda is NULL AND quantidade > 0);";
        $command2=$connection->createCommand($sql2);
        $rows2=$command2->queryAll();


        $this->render("create", array("rows" => $rows, "rows1" => $rows1, "rows2" => $rows2, "rows3" => $rows3, "id" => $id, "ids" => $ids) );

    }

    public function actionUpdate($id)
    {
        $connection=Yii::app()->db;

        if(isset($_POST) && count($_POST) > 0)
        {
            $enc = Encomenda::model()->findByPk($id);
            $enc->idestado = $_POST["estado"];
            $enc->obs = $_POST["obs"];
            $enc->save();
        }

        $sql = "SELECT quantidade AS quantidade, CONCAT(idartigo,'-',idloja) as 'index', id FROM encomenda_linha WHERE idencomenda = ". $id ." AND quantidade > 0;";
        $command=$connection->createCommand($sql);
        $rowsX=$command->queryAll();
        $rows = array();
        $ids = "";
        foreach($rowsX as $r)
        {
            if(isset($r["index"]) && isset($rows[$r["index"]]) && $rows[$r["index"]] > 0)
            {
                $rows[$r["index"]] = $rows[$r["index"]] + $r["quantidade"];
            }
            else
            {
                $rows[$r["index"]] = $r["quantidade"];
            }
            if(empty($ids))
            {
                $ids = $r["id"];
            }
            else
            {
                $ids = $ids . ",".$r["id"];
            }
        }

        $sql1 = "SELECT f.nome, f.id , e.data, e.idestado, e.obs FROM encomenda e LEFT JOIN fornecedores f ON e.idfornecedor = f.id WHERE e.id = ". $id ." ;";
        $command1=$connection->createCommand($sql1);
        $rows4=$command1->queryAll();
        $nome = "";
        $data = "";
        $idestado = 0;
        $obs = "";
        $fornecedor = 0;
        foreach($rows4 as $r)
        {
            $nome = $r["nome"];
            $data = $r["data"];
            $fornecedor = $r["id"];
            $idestado = $r["idestado"];
            $obs = $r["obs"];
        }


        $sql1 = "SELECT id, nome FROM loja WHERE activo = 1 AND id NOT iN (7) ORDER BY nome ASC;";
        $command1=$connection->createCommand($sql1);
        $rows1=$command1->queryAll();

        $sql2 = "SELECT id, descricao FROM artigos WHERE id in (SELECT idartigo FROM encomenda_linha WHERE idencomenda = " . $id . " AND quantidade > 0);";
        $command2=$connection->createCommand($sql2);
        $rows2=$command2->queryAll();

        $sql3 = "SELECT id, nome FROM estadoencomenda;";
        $command3=$connection->createCommand($sql3);
        $rows3=$command3->queryAll();



        $this->render("update", array("rows" => $rows, "rows1" => $rows1, "rows2" => $rows2, "id" => $id, "ids" => $ids, "nome" => $nome, "data" => $data, "rows3" => $rows3, "obs" => $obs, "idestado" => $idestado) );

    }

    private function checkvalues($arrayPost)
    {
        $counter = 0;
        foreach($arrayPost as $key=>$val)
        {
            if($key != "fornecedorId" && $key !="fornecedor")
            {
                $counter = $counter + $val;
            }
        }
        //echo $counter;
        if($counter > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function actionPrint($id)
    {
        $this->layout = 'none';
        $mpdf = Yii::app()->ePdf->mpdf();
        $mpdf->useSubstitutions = false;
        $mpdf->setAutoTopMargin = 'stretch';
        $mpdf->setAutoBottomMargin = 'strech';

        $connection=Yii::app()->db;

        $sql = "SELECT el.quantidade AS quantidade, CONCAT(el.idartigo,'-',el.idloja) as 'index', el.id, tu.nome AS unidade ";
        $sql = $sql . " FROM encomenda_linha el ";
        $sql = $sql . " LEFT JOIN artigos a ON el.idartigo = a.id ";
        $sql = $sql . " LEFT JOIN tipounidade tu ON a.tipounidade_enc = tu.id ";
        $sql = $sql . " WHERE el.quantidade > 0 AND idencomenda = ". $id ." ;";
        $command=$connection->createCommand($sql);
        $rowsX=$command->queryAll();
        $rows = array();
        $rowsUnidades = array();
        $ids = "";
        foreach($rowsX as $r)
        {
            if(isset($r["index"]) && $rows[$r["index"]] > 0)
            {
                $rows[$r["index"]] = $rows[$r["index"]] + $r["quantidade"];
            }
            else
            {
                $rows[$r["index"]] = $r["quantidade"];
            }
            //$rowsUnidades["index"] = $r["unidade"];
        }
        $sql1 = "SELECT id, nome FROM loja WHERE activo = 1 AND id NOT iN (7) AND id IN (SELECT distinct idloja FROM encomendalinha WHERE idencomenda = ".$id.") ORDER BY nome ASC;";
        $command1=$connection->createCommand($sql1);
        $rows1=$command1->queryAll();

        $sql1 = "SELECT f.nome, f.id , e.data, e.idestado, e.obs FROM encomenda e LEFT JOIN fornecedores f ON e.idfornecedor = f.id WHERE e.id = ". $id ." ;";
        $command1=$connection->createCommand($sql1);
        $rows4=$command1->queryAll();
        $nome = "";
        $data = "";
        $idestado = 0;
        $obs = "";
        $fornecedor = 0;
        foreach($rows4 as $r)
        {
            $nome = $r["nome"];
            $data = $r["data"];
            $fornecedor = $r["id"];
            $idestado = $r["idestado"];
            $obs = $r["obs"];
        }

        $sql2 = "SELECT a.id, a.descricao, tu.nome AS unidade FROM artigos a LEFT JOIN tipounidade tu ON a.tipounidade_enc = tu.id WHERE a.id in (SELECT idartigo FROM encomenda_linha WHERE idencomenda = " . $id . " AND quantidade > 0);";
        $command2=$connection->createCommand($sql2);
        $rows2=$command2->queryAll();

        $mpdf->WriteHTML($this->render('print', array("rows" => $rows, "rows1" => $rows1, "rows2" => $rows2, "fornecedor" => $nome, "data" => $data,"rowsUnidades" => $rowsUnidades), true));
        $mpdf->Output();


    }

    private function GetDate($day)
    {
        if($day >=0)
        {
            $now = date("Y-m-d H:i:s");
            $now2 = new DateTime($now);
            $dayofWeek = date("N");
            if($dayofWeek >= $day)
            {
                $addDays = 7 + ($day - $dayofWeek);
            }
            else
            {
                $addDays = ($day - $dayofWeek);
            }
            date_add($now2, date_interval_create_from_date_string(''.$addDays.' days'));
            $now21 = $now2->format("Y-m-d") . " 00:00:00";
            return $now21;
        }
        else
        {
            return "";
        }
    }

    private function criarAgendamento($req)
    {
        if($req->id > 0 && $req->idfornecedor > 0 && $req->idfornecedor != 1)
        {
            $connection=Yii::app()->db;
            $transaction=$connection->beginTransaction();
            try
            {
                //$forn = Fornecedores::model()->findByPk($req->idfornecedor);
                $sql = "SELECT distinct idloja FROM encomendalinha WHERE idencomenda = " . $req->id;
                $command=$connection->createCommand($sql);
                $rows=$command->queryAll();
                foreach($rows as $row)
                {
                    $entF = new EntregaFornecedor();
                    $entF->idloja = $row["idloja"];
                    $entF->idfornecedor = $req->idfornecedor;
                    $dia = Lojaentregafornecedor::model()->findAllByAttributes(array("idloja" => $row["idloja"], "idfornecedor" => $req->idfornecedor));
                    $diaEntrega = "-1";
                    if(isset($dia) && count($dia)>0)
                    {
                        $diaEntrega = $dia[0]->diaentrega;
                    }
                    $entF->data = $this->GetDate($diaEntrega);
                    $entF->save();
                }
                $transaction->commit();
            }
            catch(Exception $ex)
            {
                $transaction->rollback();
            }
        }
    }

    public function actionNaoProcessadas()
    {
        $sql = "SELECT el.id, el.idloja, l.nome AS 'loja',el.quantidade, el.idfornecedor, f.nome AS 'fornecedor' ,";
        $sql = $sql . " r.data, r.id AS 'req', a.descricao FROM encomenda_linha el LEFT JOIN loja l ON el.idloja = l.id ";
        $sql = $sql . " LEFT JOIN requesicao_linha rl ON el.idreqlinha = rl.id";
        $sql = $sql . " LEFT JOIN requesicao r ON rl.idreq = r.id";
        $sql = $sql . " LEFT JOIN fornecedores f ON el.idfornecedor = f.id";
        $slq = $sql . " LEFT JOIN artigos a ON rl.idartigo = a.id";
        $sql = $sql . " WHERE el.idencomenda IS NULL;";

        $sql1 = "SELECT idloja, loja FROM (".$sql.") t GROUP BY idloja";
        $connection=Yii::app()->db;
        $command=$connection->createCommand($sql1);
        $lojas=$command->queryAll();
    }

}