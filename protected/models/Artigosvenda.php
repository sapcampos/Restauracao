<?php

/**
 * This is the model class for table "artigosvenda".
 *
 * The followings are the available columns in table 'artigosvenda':
 * @property integer $ID
 * @property string $Nome
 * @property string $PesoIdeal
 * @property integer $Activo
 * @property integer $Deleted
 *
 * The followings are the available model relations:
 * @property Artigosvendaloja[] $artigosvendalojas
 * @property Registogelado[] $registogelados
 */
class Artigosvenda extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Artigosvenda the static model class
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
		return 'artigosvenda';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Nome', 'required'),
			array('Activo, Deleted', 'numerical', 'integerOnly'=>true),
			array('Nome', 'length', 'max'=>150),
			array('PesoIdeal', 'length', 'max'=>18),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, Nome, PesoIdeal, Activo, Deleted', 'safe', 'on'=>'search'),
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
			'artigosvendalojas' => array(self::HAS_MANY, 'Artigosvendaloja', 'IDArtigoVenda'),
			'registogelados' => array(self::HAS_MANY, 'Registogelado', 'IDArtigo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'Nome' => 'Nome',
			'PesoIdeal' => 'Peso Ideal',
			'Activo' => 'Activo',
			'Deleted' => 'Deleted',
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
		$criteria->compare('Nome',$this->Nome,true);
		$criteria->compare('PesoIdeal',$this->PesoIdeal,true);
		$criteria->compare('Activo',$this->Activo);
		$criteria->compare('Deleted',$this->Deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}