<?php

/**
 * This is the model class for table "encomenda_linha".
 *
 * The followings are the available columns in table 'encomenda_linha':
 * @property integer $id
 * @property integer $idloja
 * @property integer $idartigo
 * @property double $quantidade
 * @property integer $idencomenda
 * @property integer $idreqlinha
 * @property integer $idfornecedor
 * @property integer $idunidadeenc
 * @property integer $idunidadeinv
 */
class EncomendaLinha extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EncomendaLinha the static model class
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
		return 'encomenda_linha';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idloja, idartigo, quantidade, idreqlinha, idfornecedor', 'required'),
			array('idloja, idartigo, idencomenda, idreqlinha, idfornecedor, idunidadeenc, idunidadeinv', 'numerical', 'integerOnly'=>true),
			array('quantidade', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, idloja, idartigo, quantidade, idencomenda, idreqlinha, idfornecedor, idunidadeenc, idunidadeinv', 'safe', 'on'=>'search'),
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
			'idloja' => 'Idloja',
			'idartigo' => 'Idartigo',
			'quantidade' => 'Quantidade',
			'idencomenda' => 'Idencomenda',
			'idreqlinha' => 'Idreqlinha',
			'idfornecedor' => 'Idfornecedor',
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
		$criteria->compare('idloja',$this->idloja);
		$criteria->compare('idartigo',$this->idartigo);
		$criteria->compare('quantidade',$this->quantidade);
		$criteria->compare('idencomenda',$this->idencomenda);
		$criteria->compare('idreqlinha',$this->idreqlinha);
		$criteria->compare('idfornecedor',$this->idfornecedor);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}