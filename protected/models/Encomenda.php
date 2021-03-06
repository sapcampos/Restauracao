<?php

/**
 * This is the model class for table "encomenda".
 *
 * The followings are the available columns in table 'encomenda':
 * @property integer $id
 * @property integer $idfornecedor
 * @property string $data
 * @property integer $idestado
 * @property string $obs
 *
 * The followings are the available model relations:
 * @property Estadoencomenda $idestado0
 * @property Fornecedores $idfornecedor0
 */
class Encomenda extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Encomenda the static model class
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
		return 'encomenda';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idfornecedor, data', 'required'),
			array('idfornecedor, idestado', 'numerical', 'integerOnly'=>true),
            array('obs', 'length', 'max'=>1024),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, idfornecedor, data, idestado, obs', 'safe', 'on'=>'search'),
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
            'idestado0' => array(self::BELONGS_TO, 'Estadoencomenda', 'idestado'),
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
			'idfornecedor' => 'Idfornecedor',
			'data' => 'Data',
            'idestado' => 'Estado',
            'obs' => 'Observações',
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
		$criteria->compare('data',$this->data,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}