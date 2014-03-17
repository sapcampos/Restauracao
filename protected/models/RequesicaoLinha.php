<?php

/**
 * This is the model class for table "requesicao_linha".
 *
 * The followings are the available columns in table 'requesicao_linha':
 * @property string $id
 * @property integer $idartigo
 * @property double $inventario
 * @property double $encomenda
 * @property integer $processada
 * @property integer $idreq
 * @property integer $idunidadeenc
 * @property integer $idunidadeinv
 */
class RequesicaoLinha extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RequesicaoLinha the static model class
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
		return 'requesicao_linha';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idartigo, idreq', 'required'),
			array('idartigo, processada, idreq, idunidadeenc, idunidadeinv', 'numerical', 'integerOnly'=>true),
			array('inventario, encomenda', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, idartigo, inventario, encomenda, processada, idreq, idunidadeenc, idunidadeinv', 'safe', 'on'=>'search'),
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
			'idartigo' => 'Idartigo',
			'inventario' => 'Inventario',
			'encomenda' => 'Encomenda',
			'processada' => 'Processada',
			'idreq' => 'Idreq',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('idartigo',$this->idartigo);
		$criteria->compare('inventario',$this->inventario);
		$criteria->compare('encomenda',$this->encomenda);
		$criteria->compare('processada',$this->processada);
		$criteria->compare('idreq',$this->idreq);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}