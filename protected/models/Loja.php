<?php

/**
 * This is the model class for table "Loja".
 *
 * The followings are the available columns in table 'Loja':
 * @property integer $id
 * @property string $nome
 * @property integer $idconcelho
 * @property integer $activo
 * @property string $corloja
 *
 * The followings are the available model relations:
 * @property Concelhos $idconcelho0
 */
class Loja extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Loja the static model class
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
		return 'loja';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idconcelho', 'required'),
			array('idconcelho, activo', 'numerical', 'integerOnly'=>true),
			array('nome', 'length', 'max'=>128),
            array('corloja', 'length', 'max'=>16),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nome, idconcelho, activo, corloja', 'safe', 'on'=>'search'),
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
			'idconcelho0' => array(self::BELONGS_TO, 'Concelhos', 'idconcelho'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nome' => 'Nome',
			'idconcelho' => 'Idconcelho',
			'activo' => 'Activo',
            'corloja' => 'Côr Loja',
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
		$criteria->compare('nome',$this->nome,true);
		$criteria->compare('idconcelho',$this->idconcelho);
		$criteria->compare('activo',$this->activo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}