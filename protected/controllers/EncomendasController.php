<?php

class EncomendasController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout='//layouts/column2';

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
                'actions'=>array('index','view', 'print', 'print2', 'print3', 'print4', 'createXls', 'gerarInventario', 'inventarioXls', 'inventarioXlsTemp', 'evolucaoFornecedor', 'getEvFornecedor'),
                'users'=>array('@'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','update','admin','delete', 'pesquisa', 'estatistica', 'getartigos'),
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
        $condition0 = array("id" => Yii::app()->user->id);
        $user = Utilizadores::model()->findByAttributes($condition0);
        $cond = "";
        if(isset($user) && $user->tipoutilizador == 3 && isset($user->loja))
        {
            $cond = " r.idloja = " .$user->loja . " ";
        }
        $sql = "SELECT r.id AS id, data, l.nome AS nomeLoja, u.nome AS nomeUser FROM requesicao r ";
        $sql = $sql . " LEFT JOIN loja l ON r.idloja = l.id ";
        $sql = $sql . " LEFT JOIN utilizadores u ON r.iduser = u.id";
        if($cond != "")
        {
            $sql = $sql . " WHERE ".$cond;
        }
        $sql = $sql . " ORDER BY data DESC";

        $id = 0;
        $connection=Yii::app()->db;
        $command=$connection->createCommand($sql);
        $rows=$command->queryAll();
        $this->render('index',array('id' => $id,'rows'=>$rows));

    }

    public function actionUpdate($id)
    {
        $req = Requesicao::model()->findByPk($id);
        if(isset($req))
        {

            if(isset($_POST) && count($_POST) > 0)
            {
                $arr = $_POST;
                $ok = true;
                $transaction = Yii::app()->db->beginTransaction();
                foreach($arr as $a => $v)
                {
                    $idArt = "";
                    if($this->startsWith($a,"ID_"))
                    {
                        unset($reqL);
                        $stock = "";
                        $enc = "";
                        $idArt = str_replace("ID_","",$a);
                        $_reqL = RequesicaoLinha::model()->findAllByAttributes(array("idreq" => $id, "idartigo" => $idArt));

                        if(count($_reqL) > 0)
                        {
                            $reqL = $_reqL[0];
                        }
                        if(isset($reqL) && $reqL->id > 0)
                        {
                            $stock = $arr["stock".$idArt];
                            $enc = $arr["enc".$idArt];
                            if(!is_numeric($stock) || ($stock < -1) || (!is_numeric($enc) || $enc < -1))
                            {
                                $idReqL = $reqL->id;
                                if($reqL->delete())
                                {
                                    $_encL = EncomendaLinha::model()->findAllByAttributes(array("idreqlinha" => $idReqL));
                                    if(count($_encL) > 0)
                                    {
                                        foreach($_encL as $n)
                                        {
                                            $n->delete();
                                        }
                                    }
                                }
                            }
                            else
                            {
                                $reqL->encomenda = "0".$enc;
                                $reqL->inventario = "0".$stock;
                                $reqL->save();
                                $encL = EncomendaLinha::model()->findAllByAttributes(array("idreqlinha" => $reqL->id));
                                if(isset($encL) && count($encL) > 0)
                                {
                                    $enc1L = $encL[0];
                                    $enc1L->quantidade = $reqL->encomenda;
                                    $enc1L->save();
                                }
                                else
                                {
                                    if($reqL->encomenda > 0)
                                    {
                                        $encL = new EncomendaLinha();
                                        $encL->idloja = $req->idloja;
                                        $encL->idartigo = $reqL->idartigo;
                                        $encL->quantidade = $reqL->encomenda;
                                        $encL->idreqlinha = $reqL->id;
                                        $artigo = Artigos::model()->findByPk($reqL->idartigo);
                                        if(isset($artigo))
                                        {
                                            $encL->idunidadeenc = $reqL->idunidadeenc;
                                            $encL->idunidadeinv = $reqL->idunidadeenc;
                                        }
                                        $encL->idfornecedor = $artigo->idfornecedor;
                                        if($encL->save())
                                        {
                                            $ok = $ok && true;
                                        }
                                        else
                                        {
                                            $ok = $ok && false;
                                        }
                                    }
                                }
                            }
                        }
                        else
                        {
                            $stock = $arr["stock".$idArt];
                            $enc = $arr["enc".$idArt];
                            if(is_numeric($stock) && ($stock > -1) || (is_numeric($enc) && $enc > -1))
                            {
                                $reql1 = new RequesicaoLinha();
                                $reql1->encomenda = "0".$enc;
                                $reql1->idartigo = $idArt;
                                $reql1->inventario = "0".$stock;
                                $reql1->idreq = $req->id;
                                $artigo = Artigos::model()->findByPk($reql1->idartigo);
                                if(isset($artigo))
                                {
                                    $reql1->idunidadeenc = $artigo->tipounidade_enc;
                                    $reql1->idunidadeinv = $artigo->tipounidade_stock;
                                }
                                if($reql1->save())
                                {
                                    $ok = $ok && true;
                                    if($reql1->encomenda > 0)
                                    {
                                        $encL = new EncomendaLinha();
                                        $encL->idloja = $req->idloja;
                                        $encL->idartigo = $reql1->idartigo;
                                        $encL->quantidade = $reql1->encomenda;
                                        $encL->idreqlinha = $reql1->id;
                                        $artigo = Artigos::model()->findByPk($reql1->idartigo);
                                        if(isset($artigo))
                                        {
                                            $encL->idfornecedor = $artigo->idfornecedor;
                                            $encL->idunidadeenc = $reql1->idunidadeenc;
                                            $encL->idunidadeinv = $reql1->idunidadeenc;
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
                                }
                                else
                                {
                                    $ok = $ok && false;
                                }
                            }
                        }
                    }

                }
                if($ok)
                {
                    $rqLg = new Reqlog();
                    $rqLg->data = date('Y-m-d H:i:s');
                    $rqLg->idreq = $id;
                    $rqLg->iduser = Yii::app()->user->id;
                    $rqLg->save();
                    $transaction->commit();
                }
                else
                {
                    $transaction->rollBack();
                }
            }

            $connection=Yii::app()->db;
            $sql = "SELECT rl.id AS ID, a.id AS idArtigo, a.descricao, rl.inventario, rl.encomenda, f.nome AS Fornecedor, ee.nome AS Entrega, een.nome AS Encomenda, tu1.nome AS 'Unidade Encomenda',tu2.nome AS 'Unidade Stock' FROM requesicao_linha rl ";
            $sql = $sql . " LEFT JOIN requesicao r ON rl.idreq = r.id ";
            $sql = $sql . " LEFT JOIN artigos a ON rl.idartigo = a.id ";
            $sql = $sql . " LEFT JOIN fornecedores f ON a.idfornecedor = f.id ";
            $sql = $sql . " LEFT JOIN artigoloja al ON a.id = al.idartigo AND r.idloja = al.idloja ";
            $sql = $sql . " LEFT JOIN entidadeentrega ee ON al.identrega = ee.id ";
            $sql = $sql . " LEFT JOIN entidadeencomenda een ON al.idencomenda = een.id ";
            $sql = $sql . " LEFT JOIN tipounidade tu1 ON rl.idunidadeenc = tu1.id ";
            $sql = $sql . " LEFT JOIN tipounidade tu2 ON rl.idunidadeinv = tu2.id ";
            $sql = $sql . " WHERE r.id = " . $id;
            $command=$connection->createCommand($sql);
            $_rows=$command->queryAll();
            $rows1 = array();
            if(count($_rows) > 0)
            {
                foreach($_rows as $r1)
                {
                    $rows1["e".$r1["idArtigo"]] = $r1["encomenda"];
                    $rows1["i".$r1["idArtigo"]] = $r1["inventario"];
                    $rows1["ui".$r1["idArtigo"]] = $r1["Unidade Stock"];
                    $rows1["ue".$r1["idArtigo"]] = $r1["Unidade Encomenda"];
                }
            }

            $req = Requesicao::model()->findByPk($id);

            $sql1 = "SELECT a.id AS 'ID', a.descricao AS 'Descricao', precounidadeencomenda, precounidadeinventario, l.nome AS 'Loja', f.nome AS 'Fornecedor',  ";
            $sql1 = $sql1 . "ee.nome AS 'Encomenda', een.nome AS 'Entrega', tu1.nome AS 'Unidade Encomenda', tu2.nome AS 'Unidade Stock' , a.blockorders AS 'Bloquear'";
            $sql1 = $sql1 . " FROM artigos a ";
            $sql1 = $sql1 . " LEFT JOIN artigoloja al ON a.id = al.idartigo ";
            $sql1 = $sql1 . " LEFT JOIN fornecedores f ON a.idfornecedor = f.id ";
            $sql1 = $sql1 . " LEFT JOIN loja l ON al.idloja = l.id ";
            $sql1 = $sql1 . " LEFT JOIN entidadeencomenda ee ON al.idencomenda = ee.id ";
            $sql1 = $sql1 . " LEFT JOIN entidadeentrega een ON al.identrega = een.id ";
            $sql1 = $sql1 . " LEFT JOIN tipounidade tu1 ON a.tipounidade_enc = tu1.id ";
            $sql1 = $sql1 . " LEFT JOIN tipounidade tu2 ON a.tipounidade_stock = tu2.id ";
            $sql1 = $sql1 . " WHERE ((a.activo = 1 AND al.activo = 1) OR (a.id IN ( SELECT idartigo FROM requesicao_linha WHERE idreq = " . $req->id . "))) AND al.idloja = " . $req->idloja . " ";
            $sql1 = $sql1 . " ORDER BY f.nome ASC, a.descricao ASC ";


            $command=$connection->createCommand($sql1);
            $rows=$command->queryAll();

            $sql2 = "SELECT rl.idartigo, rl.inventario, rl.encomenda, rl.idreq, tu2.nome AS 'Unidade Encomenda', tu1.nome AS 'Unidade Stock' FROM requesicao_linha rl ";
            $sql2 = $sql2 . " LEFT JOIN tipounidade tu2 ON rl.idunidadeenc = tu2.id ";
            $sql2 = $sql2 . " LEFT JOIN tipounidade tu1 ON rl.idunidadeinv = tu1.id ";
            $sql2 = $sql2 . " WHERE idreq = (SELECT MAX(id) FROM requesicao WHERE idloja = ".$req->idloja." AND id < ".$id.");";
            $command2=$connection->createCommand($sql2);
            $rows2=$command2->queryAll();
            $idReq = 0;
            $rowsOld = array();
            foreach($rows2 as $r2)
            {
                $rowsOld["i".$r2["idartigo"]] = $r2["inventario"];
                $rowsOld["e".$r2["idartigo"]] = $r2["encomenda"];
                $rowsOld["ui".$r2["idartigo"]] = $r2["Unidade Stock"];
                $rowsOld["ue".$r2["idartigo"]] = $r2["Unidade Encomenda"];
                if($idReq == 0)
                {
                    $idReq = $r2["idreq"];
                }
            }
            if($idReq > 0)
            {
                $oldReq = Requesicao::model()->findByPk($idReq);
            }
            else
            {
                $oldReq = new Requesicao();
            }

            $resLog = array();
            if(is_numeric($id))
            {
                $sql3 = "SELECT nome,idreq,data FROM reqlog r LEFT JOIN utilizadores u ON r.iduser = u.id";
                $sql3 = $sql3 . " WHERE r.idreq = ". $id ." ORDER BY r.id DESC limit 0,1";
                $command3=$connection->createCommand($sql3);
                $resLog=$command3->queryAll();
            }
        }

        $this->render("update", array("rows" => $rows, 'rows1' => $rows1, 'rows2' => $rowsOld, 'req' => $req, 'oldReq' => $oldReq, 'resLog' => $resLog));
    }


    public function actionPesquisa()
    {
        $idLoja = 0;
        $lojas = Loja::model()->findAll();
        $dataInicio = "";
        $dataFim = "";
        $where = "";
        if(isset($_POST) && count($_POST) > 0)
        {
            if(isset($_POST["datainicio"]) && !empty($_POST["datainicio"]))
            {
                $where = " data >= '" . $_POST["datainicio"] ." 00:00:00' ";
                $dataInicio = $_POST["datainicio"] ." 00:00:00";
            }
            if(isset($_POST["datafim"]) && !empty($_POST["datafim"]))
            {
                if(!empty($where))
                {
                    $where = $where . " AND data <= '" . $_POST["datafim"] ." 23:59:59' ";
                }
                else
                {
                    $where = $where . " data <= '" . $_POST["datafim"] ." 23:59:59' ";
                }
                $dataFim = $_POST["datafim"] ." 23:59:59";
            }
            if(isset($_POST["loja"]) && !empty($_POST["loja"]))
            {
                $idLoja = $_POST["loja"];
            }
        }
        if(!empty($where))
        {
            $where = " AND (" . $where . ")";
        }
        if($idLoja < 1)
        {
            if(isset($lojas) && count($lojas) > 0)
            {
                $idLoja = $lojas[0]->id;
            }
        }

        $connection=Yii::app()->db;
        $sql = "SELECT id FROM requesicao WHERE idloja = ".$idLoja . " ". $where. "  ORDER BY data ASC";
        $command=$connection->createCommand($sql);
        $_rows=$command->queryAll();

        $rowsOld = array();
        foreach($_rows as $r1)
        {
            $sql2 = "SELECT rl.idartigo, rl.inventario, rl.encomenda, rl.idreq, tu1.nome AS 'UE', tu2.nome AS 'US' FROM requesicao_linha rl";
            $sql2 = $sql2 . " LEFT JOIN tipounidade tu1 ON rl.idunidadeenc = tu1.id ";
            $sql2 = $sql2 . " LEFT JOIN tipounidade tu2 ON rl.idunidadeinv = tu2.id ";
            $sql2 = $sql2 . " WHERE idreq = ".$r1["id"]."";
            $command2=$connection->createCommand($sql2);
            $rows2=$command2->queryAll();
            $idReq = 0;
            $rowsOld1 = array();
            foreach($rows2 as $r2)
            {
                if($idReq == 0)
                {
                    $idReq = $r2["idreq"];
                }
                $rowsOld1["i".$r2["idartigo"]] = $r2["inventario"];
                $rowsOld1["e".$r2["idartigo"]] = $r2["encomenda"];
                $rowsOld1["ui".$r2["idartigo"]] = $r2["US"];
                $rowsOld1["ue".$r2["idartigo"]] = $r2["UE"];
            }
            $rowsOld[$idReq] = $rowsOld1;

        }

        $sql1 = "SELECT a.id AS 'ID', a.descricao AS 'Descricao', precounidadeencomenda, precounidadeinventario, l.nome AS 'Loja', f.nome AS 'Fornecedor',  ";
        $sql1 = $sql1 . "ee.nome AS 'Encomenda', een.nome AS 'Entrega', tu1.nome AS 'Unidade Encomenda', tu2.nome AS 'Unidade Stock' ";
        $sql1 = $sql1 . " FROM artigos a ";
        $sql1 = $sql1 . " LEFT JOIN artigoloja al ON a.id = al.idartigo ";
        $sql1 = $sql1 . " LEFT JOIN fornecedores f ON a.idfornecedor = f.id ";
        $sql1 = $sql1 . " LEFT JOIN loja l ON al.idloja = l.id ";
        $sql1 = $sql1 . " LEFT JOIN entidadeencomenda ee ON al.idencomenda = ee.id ";
        $sql1 = $sql1 . " LEFT JOIN entidadeentrega een ON al.identrega = een.id ";
        $sql1 = $sql1 . " LEFT JOIN tipounidade tu1 ON a.tipounidade_enc = tu1.id ";
        $sql1 = $sql1 . " LEFT JOIN tipounidade tu2 ON a.tipounidade_stock = tu2.id ";
        $sql1 = $sql1 . " WHERE a.activo = 1 AND al.idloja = " . $idLoja . " AND al.activo = 1 ";
        if(isset($_rows) && count($_rows) > 0)
        {
        $sql1 = $sql1 . " AND a.id IN (SELECT distinct idartigo FROM requesicao_linha WHERE idreq IN ( ";
        $ids_ = "";
        foreach($_rows as $r)
        {
            if(empty($ids_))
                $ids_ = $r["id"];
            else
                $ids_ = $ids_ . "," . $r["id"];
        }
        $sql1 = $sql1 . $ids_;
        $sql1 = $sql1 . ") ) ";
        }
        $sql1 = $sql1 . " ORDER BY f.nome ASC, a.descricao ASC ";


        $command=$connection->createCommand($sql1);
        $rows=$command->queryAll();

        $this->render("pesquisa", array("rows" => $rows, 'rows2' => $rowsOld, "lojas" => $lojas, "idLoja" => $idLoja, "dataInicio" => $dataInicio, "dataFim" => $dataFim));
    }

    public function startsWith($haystack, $needle)
    {
        return $needle === "" || strpos($haystack, $needle) === 0;
    }

    public function endsWith($haystack, $needle)
    {
        return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
    }

    public function actionPrint($id)
    {
        $this->layout = "none";
        $connection=Yii::app()->db;
        $sql = "SELECT a.descricao, rl.encomenda, tu.nome, f.nome AS 'fornecedor' FROM requesicao_linha rl LEFT JOIN artigos a ON rl.idartigo = a.id ";
        $sql .= " LEFT JOIN tipounidade tu ON rl.idunidadeenc = tu.id ";
        $sql .= " LEFT JOIN fornecedores f ON a.idfornecedor = f.id ";
        $sql .= " WHERE rl.encomenda > 0 AND idreq = " . $id . " ORDER BY f.nome ASC,a.descricao ASC;";
        $command=$connection->createCommand($sql);
        $linhas=$command->queryAll();
        $req = Requesicao::model()->findByPk($id);
        if(isset($req))
        {
            $loja = Loja::model()->findByPk($req->idloja);
        }


        $mpdf = Yii::app()->ePdf->mpdf();
        $mpdf->useSubstitutions = false;
        $mpdf->setAutoTopMargin = 'stretch';
        $mpdf->setAutoBottomMargin = 'strech';
        $mpdf->SetFooter('{PAGENO}');
        $mpdf->WriteHTML($this->render("_print", array("linhas" => $linhas, 'req' => $req, "loja" => $loja),true));
        $mpdf->Output();
    }

    public function actionPrint4($id, $not = 0)
    {
        $this->layout = "none";
        $connection=Yii::app()->db;
        $sql = "SELECT a.descricao, rl.encomenda, tu.nome, f.nome AS 'fornecedor' FROM requesicao_linha rl LEFT JOIN artigos a ON rl.idartigo = a.id ";
        $sql .= " LEFT JOIN tipounidade tu ON rl.idunidadeenc = tu.id ";
        $sql .= " LEFT JOIN fornecedores f ON a.idfornecedor = f.id ";
        $sql .= " LEFT JOIN requesicao r ON rl.idreq = r.id ";
        $sql .= " LEFT JOIN artigoloja al ON a.id = al.idartigo AND r.idloja = al.idloja";
        $sql .= " WHERE rl.encomenda > 0 AND idreq = " . $id . " ";
        if($not == 0)
        {
            $sql .= "AND al.idencomenda = 2";
        }
        else
        {
            $sql .= "AND al.idencomenda <> 2";
        }
        $sql .= " ORDER BY f.nome ASC,a.descricao ASC;";
        $command=$connection->createCommand($sql);
        $linhas=$command->queryAll();
        $req = Requesicao::model()->findByPk($id);
        if(isset($req))
        {
            $loja = Loja::model()->findByPk($req->idloja);
        }


        $mpdf = Yii::app()->ePdf->mpdf();
        $mpdf->useSubstitutions = false;
        $mpdf->setAutoTopMargin = 'stretch';
        $mpdf->setAutoBottomMargin = 'strech';
        $mpdf->SetFooter('{PAGENO}');
        $mpdf->WriteHTML($this->render("_print4", array("linhas" => $linhas, 'req' => $req, "loja" => $loja, 'not' => $not,),true));
        $mpdf->Output();
    }

    public function actionPrint2($loja=0,$di='',$df='')
    {
        try
        {
        $this->layout = "none";
        $idLoja = $loja;
        $lojas = Loja::model()->findAll();
        $dataInicio = $di;
        $dataFim = $df;
        $where = "";

        if(isset($dataInicio) && !empty($dataInicio))
        {
            $where = " data >= '" . $dataInicio ."' ";

        }
        if(isset($dataFim) && !empty($dataFim))
        {
            if(!empty($where))
            {
                $where = $where . " AND data <= '" . $dataFim ."' ";
            }
            else
            {
                $where = $where . " data <= '" . $dataFim ."' ";
            }

        }
        if(isset($idLoja) && !empty($idLoja))
        {
            $idLoja = $loja;
        }

        if(!empty($where))
        {
            $where = " AND (" . $where . ")";
        }
        if($idLoja < 1)
        {
            if(isset($lojas) && count($lojas) > 0)
            {
                $idLoja = $lojas[0]->id;
            }
        }

        $connection=Yii::app()->db;
        $sql = "SELECT id FROM requesicao WHERE idloja = ".$idLoja . " ". $where. "  ORDER BY data ASC";
        $command=$connection->createCommand($sql);
        $_rows=$command->queryAll();

        $rowsOld = array();
        foreach($_rows as $r1)
        {
            $sql2 = "SELECT rl.idartigo, rl.inventario, rl.encomenda, rl.idreq, tu1.nome as 'UE', tu2.nome AS 'UI'  FROM requesicao_linha rl  ";
            $sql2 = $sql2 . " LEFT JOIN tipounidade tu1 ON rl.idunidadeenc = tu1.id ";
            $sql2 = $sql2 . " LEFT JOIN tipounidade tu2 ON rl.idunidadeinv = tu2.id ";
            $sql2 = $sql2 . " WHERE idreq = ".$r1["id"]."";
            $command2=$connection->createCommand($sql2);
            $rows2=$command2->queryAll();
            $idReq = 0;
            $rowsOld1 = array();
            foreach($rows2 as $r2)
            {
                if($idReq == 0)
                {
                    $idReq = $r2["idreq"];
                }
                $rowsOld1["i".$r2["idartigo"]] = $r2["inventario"];
                $rowsOld1["e".$r2["idartigo"]] = $r2["encomenda"];
                $rowsOld1["ui".$r2["idartigo"]] = $r2["UI"];
                $rowsOld1["ue".$r2["idartigo"]] = $r2["UE"];
            }
            $rowsOld[$idReq] = $rowsOld1;

        }

        $sql1 = "SELECT a.id AS 'ID', a.descricao AS 'Descricao', precounidadeencomenda, precounidadeinventario, l.nome AS 'Loja', f.nome AS 'Fornecedor',  ";
        $sql1 = $sql1 . "ee.nome AS 'Encomenda', een.nome AS 'Entrega', tu1.nome AS 'Unidade Encomenda', tu2.nome AS 'Unidade Stock' ";
        $sql1 = $sql1 . " FROM artigos a ";
        $sql1 = $sql1 . " LEFT JOIN artigoloja al ON a.id = al.idartigo ";
        $sql1 = $sql1 . " LEFT JOIN fornecedores f ON a.idfornecedor = f.id ";
        $sql1 = $sql1 . " LEFT JOIN loja l ON al.idloja = l.id ";
        $sql1 = $sql1 . " LEFT JOIN entidadeencomenda ee ON al.idencomenda = ee.id ";
        $sql1 = $sql1 . " LEFT JOIN entidadeentrega een ON al.identrega = een.id ";
        $sql1 = $sql1 . " LEFT JOIN tipounidade tu1 ON a.tipounidade_enc = tu1.id ";
        $sql1 = $sql1 . " LEFT JOIN tipounidade tu2 ON a.tipounidade_stock = tu2.id ";
        $sql1 = $sql1 . " WHERE a.activo = 1 AND al.idloja = " . $idLoja . " AND al.activo = 1 ";
        if(isset($_rows) && count($_rows) > 0)
        {
            $sql1 = $sql1 . " AND a.id IN (SELECT distinct idartigo FROM requesicao_linha WHERE idreq IN ( ";
            $ids_ = "";
            foreach($_rows as $r)
            {
                if(empty($ids_))
                    $ids_ = $r["id"];
                else
                    $ids_ = $ids_ . "," . $r["id"];
            }
            $sql1 = $sql1 . $ids_;
            $sql1 = $sql1 . ") ) ";
        }
        $sql1 = $sql1 . " ORDER BY f.nome ASC, a.descricao ASC ";
        $command=$connection->createCommand($sql1);
        $rows=$command->queryAll();

        $mpdf = Yii::app()->ePdf->mpdf();
        $mpdf->useSubstitutions = false;
        $mpdf->setAutoTopMargin = 'stretch';
        $mpdf->setAutoBottomMargin = 'strech';
        $mpdf->SetFooter('{PAGENO}');

        $html = $this->renderPartial("_print2_1", array("rows" => $rows, 'rows2' => $rowsOld),true);
        $mpdf->WriteHTML($html);
        if(isset($rows) && count($rows)>0)
        {
            $max = count($rows);
            $rem = 0;
            while($rem < $max)
            {
                $exit = 0;
                $next = 20;
                if($rem + $next >= $max)
                {
                    $next = $max - $rem - 1;
                    $exit = 1;
                }
                $end = $rem + $next;
                $html1 = $this->renderPartial("_print2_2", array("row" => $rows, 'rows2' => $rowsOld, "start"=> $rem, "end" => $end),true);
                $mpdf->WriteHTML($html1);
                //echo $html1;
                if($exit == 0)
                    $rem = $end;
                else
                    $rem = $end + 1000000;
            }
            /*foreach($rows as $row)
            {
                try
                {
                    $html1 = $this->renderPartial("_print2_2", array("row" => $row, 'rows2' => $rowsOld, "i"=> $i),true);
                    $mpdf->WriteHTML($html1);

                }
                catch(Exception $ex)
                {

                }
                $i++;
            } */
        }
        $html2 = $this->renderPartial("_print2_3",array(),true);
        //echo $html . $html1 . $html2;
        $mpdf->WriteHTML($html2);
        /*$html = $this->renderPartial("_print2", array("rows" => $rows, 'rows2' => $rowsOld, "idloja" => $idLoja),true);
        $max = strlen($html);
        $rem = 0;
        while($rem < $max)
        {
            $exit = 0;
            $next =  10000;
            if($next >= $max)
            {
                $next = $max - $rem -1;
                $exit = 1;
            }
            $html_ = $html;
            $html1 = substr($html_,$rem, $next);
            $mpdf->WriteHTML($html1);
            //$mpdf->writeHTML("((".$rem."--".$next."--".$max."))");
            if($exit == 0)
                $rem = $rem + $next;
            else
                $rem = $rem + $next + 1000000;


        }
        /*for($i=0; $i < $max/5000; $i++)
        {
            if($i < $max)
            {
                $len = ($i + 1) * 5000;
            }
            else
            {
                $len = $max - ($i * 5000) -1;
            }
            $html1 = substr($html,($i*5000), $len);
            $mpdf->WriteHTML($html1);
        }*/
        //$mpdf->WriteHTML($html);
        $mpdf->Output();
            }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }


    public function actionPrint3($id)
    {
        $req = Requesicao::model()->findByPk($id);
        if(isset($req))
        {
            $connection=Yii::app()->db;
            $sql = "SELECT rl.id AS ID, a.id AS idArtigo, a.descricao, rl.inventario, rl.encomenda, f.nome AS Fornecedor, ee.nome AS Entrega, een.nome AS Encomenda, tu1.nome AS 'Unidade Encomeda',tu2.nome AS 'Unidade Stock' FROM requesicao_linha rl ";
            $sql = $sql . " LEFT JOIN requesicao r ON rl.idreq = r.id ";
            $sql = $sql . " LEFT JOIN artigos a ON rl.idartigo = a.id ";
            $sql = $sql . " LEFT JOIN fornecedores f ON a.idfornecedor = f.id ";
            $sql = $sql . " LEFT JOIN artigoloja al ON a.id = al.idartigo AND r.idloja = al.idloja ";
            $sql = $sql . " LEFT JOIN entidadeentrega ee ON al.identrega = ee.id ";
            $sql = $sql . " LEFT JOIN entidadeencomenda een ON al.idencomenda = een.id ";
            $sql = $sql . "LEFT JOIN tipounidade tu1 ON a.tipounidade_enc = tu1.id LEFT JOIN tipounidade tu2 ON a.tipounidade_stock = tu2.id";
            $sql = $sql . " WHERE r.id = " . $id;
            $command=$connection->createCommand($sql);
            $_rows=$command->queryAll();
            $rows1 = array();
            if(count($_rows) > 0)
            {
                foreach($_rows as $r1)
                {
                    $rows1["e".$r1["idArtigo"]] = $r1["encomenda"];
                    $rows1["i".$r1["idArtigo"]] = $r1["inventario"];
                }
            }

            $req = Requesicao::model()->findByPk($id);

            $sql1 = "SELECT a.id AS 'ID', a.descricao AS 'Descricao', precounidadeencomenda, precounidadeinventario, l.nome AS 'Loja', f.nome AS 'Fornecedor',  ";
            $sql1 = $sql1 . "ee.nome AS 'Encomenda', een.nome AS 'Entrega', tu1.nome AS 'Unidade Encomenda', tu2.nome AS 'Unidade Stock' ";
            $sql1 = $sql1 . " FROM artigos a ";
            $sql1 = $sql1 . " LEFT JOIN artigoloja al ON a.id = al.idartigo ";
            $sql1 = $sql1 . " LEFT JOIN fornecedores f ON a.idfornecedor = f.id ";
            $sql1 = $sql1 . " LEFT JOIN loja l ON al.idloja = l.id ";
            $sql1 = $sql1 . " LEFT JOIN entidadeencomenda ee ON al.idencomenda = ee.id ";
            $sql1 = $sql1 . " LEFT JOIN entidadeentrega een ON al.identrega = een.id ";
            $sql1 = $sql1 . " LEFT JOIN tipounidade tu1 ON a.tipounidade_enc = tu1.id ";
            $sql1 = $sql1 . " LEFT JOIN tipounidade tu2 ON a.tipounidade_stock = tu2.id ";
            $sql1 = $sql1 . " WHERE a.activo = 1 AND al.idloja = " . $req->idloja . " AND al.activo = 1";
            $sql1 = $sql1 . " ORDER BY f.nome ASC, a.descricao ASC ";


            $command=$connection->createCommand($sql1);
            $rows=$command->queryAll();

            $sql2 = "SELECT idartigo, inventario, encomenda, idreq FROM requesicao_linha WHERE idreq = (SELECT MAX(id) FROM requesicao WHERE idloja = ".$req->idloja." AND id < ".$id.");";
            $command2=$connection->createCommand($sql2);
            $rows2=$command2->queryAll();
            $idReq = 0;
            $rowsOld = array();
            foreach($rows2 as $r2)
            {
                $rowsOld["i".$r2["idartigo"]] = $r2["inventario"];
                $rowsOld["e".$r2["idartigo"]] = $r2["encomenda"];
                if($idReq == 0)
                {
                    $idReq = $r2["idreq"];
                }
            }
            if($idReq > 0)
            {
                $oldReq = Requesicao::model()->findByPk($idReq);
            }
            else
            {
                $oldReq = new Requesicao();
            }

            $resLog = array();
            if(is_numeric($id))
            {
                $sql3 = "SELECT nome,idreq,data FROM reqlog r LEFT JOIN utilizadores u ON r.iduser = u.id";
                $sql3 = $sql3 . " WHERE r.idreq = ". $id ." ORDER BY r.id DESC limit 0,1";
                $command3=$connection->createCommand($sql3);
                $resLog=$command3->queryAll();
            }
        }
        $this->layout = 'none';
        $mpdf = Yii::app()->ePdf->mpdf();
        $mpdf->useSubstitutions = false;
        $mpdf->setAutoTopMargin = 'stretch';
        $mpdf->setAutoBottomMargin = 'strech';
        $mpdf->SetFooter('{PAGENO}');
        $html = $this->renderPartial("_print3_1", array(),true);
        $mpdf->WriteHTML($html);
        //$html = $this->renderPartial("_print3", array("rows" => $rows, 'rows1' => $rows1, 'rows2' => $rowsOld, 'req' => $req, 'oldReq' => $oldReq, 'resLog' => $resLog),true);
        //$mpdf->WriteHTML($html);
        if(isset($rows) && count($rows)>0)
        {
            $max = count($rows);
            $rem = 0;
            while($rem < $max)
            {
                $exit = 0;
                $next = 20;
                if($rem + $next >= $max)
                {
                    $next = $max - $rem - 1;
                    $exit = 1;
                }
                $end = $rem + $next;
                $html1 = $this->renderPartial("_print3_2", array("rows" => $rows, 'rows1' => $rows1, 'rows2' => $rowsOld, 'req' => $req, 'oldReq' => $oldReq, 'resLog' => $resLog, "start"=> $rem, "end" => $end),true);
                $mpdf->WriteHTML($html1);
                if($exit == 0)
                    $rem = $end;
                else
                    $rem = $end + 1000000;
            }

        }
        $html2 = $this->renderPartial("_print2_3",array(),true);
        //echo $html . $html1 . $html2;
        $mpdf->WriteHTML($html2);
        //$mpdf->WriteHTML("TESTE".strlen($html));
        $mpdf->Output();
    }

    public function actionEstatistica()
    {
        $idLoja = 0;
        $idArtigo = 0;

        if(isset($_GET["idloja"]) && !empty($_GET["idloja"]) )
        {
            $idLoja = $_GET["idloja"];
        }
        if(isset($_GET["idartigo"]) && !empty($_GET["idartigo"]))
        {
            $idArtigo = $_GET["idartigo"];
        }

        $lojas = Loja::model()->findAllByAttributes(array("activo" => 1));
        if($idLoja < 1)
        {
            $__loja = $lojas[0];
            $idLoja = $__loja->id;
        }

        $_loja = Loja::model()->findByPk($idLoja);
        $loja = "";
        if(isset($_loja))
        {
            $loja = $_loja->nome;
        }
        $connection=Yii::app()->db;

        $sql1 = "SELECT id, descricao from artigos WHERE id IN (SELECT idartigo FROM artigoloja WHERE idloja = ".$idLoja." AND activo = 1) AND activo = 1 ORDER by descricao ASC";
        $command1=$connection->createCommand($sql1);
        $rows1=$command1->queryAll();
        if($idArtigo < 1 && count($rows1) > 0)
        {
            $idArtigo = $rows1[0]["id"];
        }

        $sql = "SELECT  rl.encomenda, rl.inventario,  DATE(r.data) as 'data' FROM requesicao_linha rl  LEFT JOIN requesicao r ON rl.idreq = r.id WHERE rl.idartigo = ".$idArtigo." AND r.idloja = ".$idLoja." LIMIT 0, 1000";
        $command=$connection->createCommand($sql);
        $rows=$command->queryAll();
        $_artigo = Artigos::model()->findByPk($idArtigo);
        $artigo = "";
        $unidadeEnc = "";
        $unidadeInv = "";
        if(isset($_artigo))
        {
            $artigo = $_artigo->descricao;
            $unidadeEnc = $_artigo->unidadeEnc0->nome;
            $unidadeInv = $_artigo->unidadeInv0->nome;;
        }

        $this->render("estatistica",
            array(
                "linhas" => $rows,
                "artigo" => $artigo,
                "loja" => $loja,
                "unidadeEnc" => $unidadeEnc,
                "unidadeInv" => $unidadeInv,
                "lojas" => $lojas,
                "artigos" => $rows1,
                "idloja" => $idLoja,
                "idartigo" => $idArtigo,

            )
        );

    }

    public function actionGetartigos()
    {
        $idLoja = 0;
        if(isset($_POST["idloja"]) && !empty($_POST["idloja"]))
        {
            $idLoja = $_POST["idloja"];
        }
        $connection=Yii::app()->db;
        $sql1 = "SELECT id, descricao from artigos WHERE id IN (SELECT idartigo FROM artigoloja WHERE idloja = ".$idLoja." AND activo = 1) AND activo = 1 ORDER by descricao ASC";
        $command1=$connection->createCommand($sql1);
        $rows1=$command1->queryAll();
        $print = "";
        if(isset($rows1) && count($rows1) > 0)
        {
            $count = 0;
            foreach($rows1 as $art)
            {
                if($count == 0)
                {
                    $print = $print . "<option selected value=\"".$art["id"]."\">".$art["descricao"]."</option>";
                }
                else
                {
                    $print = $print . "<option  value=\"".$art["id"]."\">".$art["descricao"]."</option>";
                }
                $count++;
            }
        }
        echo $print;
    }

    public function actionCreateXls($id)
    {
        $connection=Yii::app()->db;
        $sql = "SELECT rl.id AS 'ReqLinhaID', f.nome AS 'Fornecedor', a.id AS idArtigo, a.descricao, REPLACE(a.precounidadeinventario,'.',',') AS 'Preço', REPLACE(rl.inventario,'.',',')  AS 'Inventario', tu2.nome AS 'Unidade Stock', ";
        $sql = $sql . " ta.nome AS 'Tipo Artigo' FROM requesicao_linha rl ";
        $sql = $sql . " LEFT JOIN requesicao r ON rl.idreq = r.id ";
        $sql = $sql . " LEFT JOIN artigos a ON rl.idartigo = a.id ";
        $sql = $sql . " LEFT JOIN fornecedores f ON a.idfornecedor = f.id ";
        $sql = $sql . " LEFT JOIN artigoloja al ON a.id = al.idartigo AND r.idloja = al.idloja ";
        $sql = $sql . " LEFT JOIN entidadeentrega ee ON al.identrega = ee.id ";
        $sql = $sql . " LEFT JOIN entidadeencomenda een ON al.idencomenda = een.id ";
        $sql = $sql . " LEFT JOIN tipounidade tu1 ON a.tipounidade_enc = tu1.id LEFT JOIN tipounidade tu2 ON a.tipounidade_stock = tu2.id";
        $sql = $sql . " LEFT JOIN tipoartigo ta ON a.tipoartigo = ta.id ";
        $sql = $sql . " WHERE r.id = " . $id;
        $sql = $sql . " ORDER BY ta.ordem ASC, f.nome ASC, a.descricao ASC ";
        $command=$connection->createCommand($sql);
        $req = Requesicao::model()->findByPk($id);
        $loja = "";
        if(isset($req))
        {
            $l = Loja::model()->findByPk($req->idloja);
            if(isset($l))
            {
                $loja = $l->nome;
            }
        }
        $rows=$command->queryAll();
        $this->render("excel", array("loja" => $loja, "data" => $rows));
    }

    public function actionGerarInventario()
    {
        $lojas = Loja::model()->findAll(array(
            'condition' => 'activo=1',

        ));
        $this->render("geraInventario", array("lojas" => $lojas));
    }

    public function actionInventarioXls($id,$inicio,$fim)
    {
        $connection=Yii::app()->db;
        $sql = "SELECT a.tipo, a.referencia, a.descricao, REPLACE(a.precounidadeinventario,'.',',') AS 'Preço', REPLACE(SUM(rl.inventario),'.',',')  AS 'Inventario', tu2.nome AS 'Unidade Stock' ";
        $sql = $sql . "  FROM requesicao_linha rl ";
        $sql = $sql . " LEFT JOIN requesicao r ON rl.idreq = r.id ";
        $sql = $sql . " LEFT JOIN artigos a ON rl.idartigo = a.id ";
        $sql = $sql . " LEFT JOIN fornecedores f ON a.idfornecedor = f.id ";
        $sql = $sql . " LEFT JOIN artigoloja al ON a.id = al.idartigo AND r.idloja = al.idloja ";
        $sql = $sql . " LEFT JOIN entidadeentrega ee ON al.identrega = ee.id ";
        $sql = $sql . " LEFT JOIN entidadeencomenda een ON al.idencomenda = een.id ";
        $sql = $sql . " LEFT JOIN tipounidade tu1 ON a.tipounidade_enc = tu1.id LEFT JOIN tipounidade tu2 ON a.tipounidade_stock = tu2.id";
        $sql = $sql . " LEFT JOIN tipoartigo ta ON a.tipoartigo = ta.id ";
        $sql = $sql . " WHERE r.id in (";
        $sql = $sql . " SELECT r1.id FROM requesicao r1 JOIN (SELECT idloja, max(data) as data FROM requesicao  WHERE idloja in (" . $id . ") AND ";
        $sql = $sql . " data > '" . $inicio . " 00:00:00' and data < '" . $fim . " 23:59:99' GROUP BY idloja) max ";
        $sql = $sql . " ON r1.data = max.data AND r1.idloja = max.idloja GROUP BY r1.idloja, r1.data";
        $sql = $sql . " ) ";
        $sql = $sql . " GROUP BY a.descricao ";
        $sql = $sql . " ORDER BY ta.ordem ASC, f.nome ASC, a.descricao ASC ";
        $command=$connection->createCommand($sql);
        $req = Requesicao::model()->findByPk($id);
        $loja = "";
        if(isset($req))
        {
            $l = Loja::model()->findByPk($req->idloja);
            if(isset($l))
            {
                $loja = $l->nome;
            }
        }
        $rows=$command->queryAll();
        $this->render("excel", array("loja" => $loja, "data" => $rows));
    }

    public function actionInventarioXlsTemp($id,$inicio,$fim)
    {
        $connection=Yii::app()->db;
        $sql = "SELECT a.tipo, a.referencia, a.descricao, REPLACE(SUM(rl.inventario),'.',',')  AS 'Inventario', tu2.nome AS 'Unidade Stock' ";
        $sql = $sql . "  FROM requesicao_linha rl ";
        $sql = $sql . " LEFT JOIN requesicao r ON rl.idreq = r.id ";
        $sql = $sql . " LEFT JOIN artigos a ON rl.idartigo = a.id ";
        $sql = $sql . " LEFT JOIN fornecedores f ON a.idfornecedor = f.id ";
        $sql = $sql . " LEFT JOIN artigoloja al ON a.id = al.idartigo AND r.idloja = al.idloja ";
        $sql = $sql . " LEFT JOIN entidadeentrega ee ON al.identrega = ee.id ";
        $sql = $sql . " LEFT JOIN entidadeencomenda een ON al.idencomenda = een.id ";
        $sql = $sql . " LEFT JOIN tipounidade tu1 ON a.tipounidade_enc = tu1.id LEFT JOIN tipounidade tu2 ON a.tipounidade_stock = tu2.id";
        $sql = $sql . " LEFT JOIN tipoartigo ta ON a.tipoartigo = ta.id ";
        $sql = $sql . " WHERE r.id in (";
        $sql = $sql . " SELECT r1.id FROM requesicao r1 JOIN (SELECT idloja, max(data) as data FROM requesicao  WHERE idloja in (" . $id . ") AND ";
        $sql = $sql . " data > '" . $inicio . " 00:00:00' and data < '" . $fim . " 23:59:99' GROUP BY idloja) max ";
        $sql = $sql . " ON r1.data = max.data AND r1.idloja = max.idloja GROUP BY r1.idloja, r1.data";
        $sql = $sql . " ) ";
        $sql = $sql . " GROUP BY a.descricao ";
        $sql = $sql . " ORDER BY ta.ordem ASC, f.nome ASC, a.descricao ASC ";
        $command=$connection->createCommand($sql);
        $req = Requesicao::model()->findByPk($id);
        $loja = "";
        if(isset($req))
        {
            $l = Loja::model()->findByPk($req->idloja);
            if(isset($l))
            {
                $loja = $l->nome;
            }
        }
        $rows=$command->queryAll();
        $this->render("excel", array("loja" => $loja, "data" => $rows));
    }

    public function actionGetEvFornecedor($id = 0,$inicio = "",$fim = "", $loja = 0)
    {
        $fornecedores = Fornecedores::model()->findAll();
        $lojas = Loja::model()->findAll();
        $fornecedor = null;
        $rows0 = null;
        $rows1 = null;
        $rows2 = null;
        $fornecedor = null;

        if($_REQUEST != null && $id > 0)
        {
            $connection=Yii::app()->db;
            $sql = "SELECT YEAR(e.data) AS 'ano', MONTH(e.data) AS 'mes', el.idartigo as 'artigo', ";
            $sql .= " SUM(el.quantidade) as 'Qt', AVG(el.quantidade) as 'AVG' ";
            $sql .= " FROM encomendalinha el";
            $sql .= " LEFT JOIN encomenda e ON el.idencomenda = e.id";
            $sql .= " LEFT JOIN artigos a ON el.idartigo = a.id";
            $sql .= " WHERE e.id IN (SELECT id FROM encomenda ) AND el.idfornecedor = " . $id . " ";
            if($inicio != "")
            {
                $sql .= " AND  e.data > '" . $inicio . " 00:00:00' ";
            }
            if($fim != "")
            {
                $sql .= " AND  e.data < '" . $fim . " 23:59:99' ";
            }
            if($loja > 0)
            {
                $sql .= " AND  el.idloja =" . $loja . " ";
            }
            $sql .= " GROUP BY  YEAR(e.data) DESC, MONTH(e.data) DESC, idartigo LIMIT 0,100000;";
            $command=$connection->createCommand($sql);
            $rows2=$command->queryAll();

            $sql1 = "SELECT a.id as 'id', a.descricao as 'artigo', tu.nome as 'unidade' from artigos a ";
            $sql1 .= " LEFT JOIN tipounidade tu ON a.tipounidade_enc = tu.id ";
            $sql1 .= " WHERE a.idfornecedor = " . $id . " ";
            if($loja > 0)
            {
                $sql1 .= " AND a.id IN (SELECT idartigo FROM artigoloja WHERE idloja = " . $loja . " AND activo = 1) ";
            }
            $sql1 .= " ORDER BY a.descricao ASC;";
            $command1=$connection->createCommand($sql1);
            $rows0=$command1->queryAll();

            $sql2 = "SELECT YEAR(e.data) AS 'ano', MONTH(e.data) as 'mes' from encomenda e ";
            $sql2 .= " LEFT JOIN encomendalinha el ON el.idencomenda = e.id ";
            $sql2 .= " WHERE el.idfornecedor = " . $id . " ";
            if($inicio != "")
            {
                $sql2 .= " AND  e.data > '" . $inicio . " 00:00:00' ";
            }
            if($fim != "")
            {
                $sql2 .= " AND  e.data < '" . $fim . " 23:59:99' ";
            }
            if($loja > 0)
            {
                $sql2 .= " AND  el.idloja =" . $loja . " ";
            }
            $sql2 .= " GROUP BY YEAR(e.data) ASC, MONTH(e.data) ASC";
            $command2=$connection->createCommand($sql2);
            $rows1 = $command2->queryAll();

            $fornecedor = Fornecedores::model()->findByPk($id);
        }

        $this->render("geraFornecedor", array("fornecedores" => $fornecedores, "lojas" => $lojas,"fornecedor1" => $fornecedor, "rows0" => $rows0, "rows1" => $rows1, "rows2" => $rows2, "inicio" => $inicio, "fim" => $fim, "loja1" => $loja));
    }

    public function actionEvolucaoFornecedor($id,$inicio = "",$fim = "", $loja = 0)
    {
        $connection=Yii::app()->db;
        $sql = "SELECT YEAR(e.data) AS 'ano', MONTH(e.data) AS 'mes', el.idartigo as 'artigo', ";
        $sql .= " SUM(el.quantidade) as 'Qt', AVG(el.quantidade) as 'AVG' ";
        $sql .= " FROM encomendalinha el";
        $sql .= " LEFT JOIN encomenda e ON el.idencomenda = e.id";
        $sql .= " LEFT JOIN artigos a ON el.idartigo = a.id";
        $sql .= " WHERE e.id IN (SELECT id FROM encomenda ) AND el.idfornecedor = " . $id . " ";
        if($inicio != "")
        {
            $sql .= " AND  e.data > '" . $inicio . " 00:00:00' ";
        }
        if($fim != "")
        {
            $sql .= " AND  e.data < '" . $fim . " 23:59:99' ";
        }
        if($loja > 0)
        {
            $sql .= " AND  el.idloja =" . $loja . " ";
        }
        $sql .= " GROUP BY  YEAR(e.data) DESC, MONTH(e.data) DESC, idartigo LIMIT 0,100000;";
        $command=$connection->createCommand($sql);
        $rows2=$command->queryAll();

        $sql1 = "SELECT a.id as 'id', a.descricao as 'artigo', tu.nome as 'unidade' from artigos a ";
        $sql1 .= " LEFT JOIN tipounidade tu ON a.tipounidade_enc = tu.id ";
        $sql1 .= " WHERE a.idfornecedor = " . $id . " ";
        if($loja > 0)
        {
            $sql1 .= " AND a.id IN (SELECT idartigo FROM artigoloja WHERE idloja = " . $loja . " AND activo = 1) ";
        }
        $sql1 .= " ORDER BY a.descricao ASC;";
        $command1=$connection->createCommand($sql1);
        $rows0=$command1->queryAll();

        $sql2 = "SELECT YEAR(e.data) AS 'ano', MONTH(e.data) as 'mes' from encomenda e ";
        $sql2 .= " LEFT JOIN encomendalinha el ON el.idencomenda = e.id ";
        $sql2 .= " WHERE el.idfornecedor = " . $id . " ";
        if($inicio != "")
        {
            $sql2 .= " AND  e.data > '" . $inicio . " 00:00:00' ";
        }
        if($fim != "")
        {
            $sql2 .= " AND  e.data < '" . $fim . " 23:59:99' ";
        }
        if($loja > 0)
        {
            $sql2 .= " AND  el.idloja =" . $loja . " ";
        }
        $sql2 .= " GROUP BY YEAR(e.data) DESC, MONTH(e.data) DESC";
        $command2=$connection->createCommand($sql2);
        $rows1 = $command2->queryAll();

        $fornecedor = Fornecedores::model()->findByPk($id);

        $this->render("excel2", array("fornecedor" => $fornecedor, "rows0" => $rows0, "rows1" => $rows1, "rows2" => $rows2, "inicio" => $inicio, "fim" => $fim, "idloja" => $id));
    }
}