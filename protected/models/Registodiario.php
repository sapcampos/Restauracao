<?php

/**
 * This is the model class for table "registodiario".
 *
 * The followings are the available columns in table 'registodiario':
 * @property integer $ID
 * @property integer $IDLoja
 * @property string $Data
 * @property integer $IDUtilizador
 * @property integer $Estado
 */
class Registodiario extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Registodiario the static model class
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
		return 'registodiario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('IDLoja, Data, IDUtilizador', 'required'),
			array('IDLoja, IDUtilizador, Estado', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, IDLoja, Data, IDUtilizador, Estado', 'safe', 'on'=>'search'),
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
			'ID' => 'ID',
			'IDLoja' => 'Idloja',
			'Data' => 'Data',
			'IDUtilizador' => 'Idutilizador',
			'Estado' => 'Estado',
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

		$criteria->compare('ID',$this->ID);
		$criteria->compare('IDLoja',$this->IDLoja);
		$criteria->compare('Data',$this->Data,true);
		$criteria->compare('IDUtilizador',$this->IDUtilizador);
		$criteria->compare('Estado',$this->Estado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}