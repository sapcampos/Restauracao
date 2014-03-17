<?php

/**
 * This is the model class for table "entregaFornecedor".
 *
 * The followings are the available columns in table 'entregaFornecedor':
 * @property integer $id
 * @property integer $idfornecedor
 * @property integer $idloja
 * @property string $data
 *
 * @property Loja $idloja0
 * @property Fornecedor $idfornecedor0
 */
class EntregaFornecedor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EntregaFornecedor the static model class
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
		return 'entregafornecedor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idfornecedor, idloja, data', 'required'),
			array('idfornecedor, idloja', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, idfornecedor, idloja, data', 'safe', 'on'=>'search'),
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
            'idloja0' => array(self::BELONGS_TO, 'Loja', 'idloja'),
            'idfornecedor0' => array(self::BELONGS_TO, 'Fornecedores', 'idfornecedor'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idfornecedor' => 'Fornecedor',
			'idloja' => 'Loja',
			'data' => 'Data',
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
		$criteria->compare('idfornecedor',$this->idfornecedor);
		$criteria->compare('idloja',$this->idloja);
		$criteria->compare('data',$this->data,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}