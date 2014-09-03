<?php

/**
 * This is the model class for table "contrato".
 *
 * The followings are the available columns in table 'contrato':
 * @property integer $id
 * @property integer $idtipocontrato
 * @property integer $idregimetrabalho
 * @property integer $idtipofuncionario
 * @property string $inicio
 * @property string $fim
 * @property integer $idloja
 * @property integer $idutilizador
 * @property integer $ndperex
 * @property string $datacontrolo1
 * @property string $datacontrolo2
 * @property string $datacontrolo3
 * @property integer $activo
 */
class Contrato extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Contrato the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contrato';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idtipocontrato, idregimetrabalho, idtipofuncionario, inicio, idloja, idutilizador', 'required'),
			array('idtipocontrato, idregimetrabalho, idtipofuncionario, idloja, idutilizador, ndperex, activo', 'numerical', 'integerOnly'=>true),
			array('fim, datacontrolo1, datacontrolo2, datacontrolo3', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, idtipocontrato, idregimetrabalho, idtipofuncionario, inicio, fim, idloja, idutilizador, ndperex, datacontrolo1, datacontrolo2, datacontrolo3, activo', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idtipocontrato' => 'Tipo Contrato',
			'idregimetrabalho' => 'Regime Trabalho',
			'idtipofuncionario' => 'Tipo Funcionario',
			'inicio' => 'Inicio',
			'fim' => 'Fim',
			'idloja' => 'Loja',
			'idutilizador' => 'Utilizador',
			'ndperex' => 'Num. dias. periodo exp.',
			'datacontrolo1' => 'Data Controlo1',
			'datacontrolo2' => 'Data Controlo2',
			'datacontrolo3' => 'Data Controlo3',
			'activo' => 'Activo',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('idtipocontrato',$this->idtipocontrato);
		$criteria->compare('idregimetrabalho',$this->idregimetrabalho);
		$criteria->compare('idtipofuncionario',$this->idtipofuncionario);
		$criteria->compare('inicio',$this->inicio,true);
		$criteria->compare('fim',$this->fim,true);
		$criteria->compare('idloja',$this->idloja);
		$criteria->compare('idutilizador',$this->idutilizador);
		$criteria->compare('ndperex',$this->ndperex);
		$criteria->compare('datacontrolo1',$this->datacontrolo1,true);
		$criteria->compare('datacontrolo2',$this->datacontrolo2,true);
		$criteria->compare('datacontrolo3',$this->datacontrolo3,true);
		$criteria->compare('activo',$this->activo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}