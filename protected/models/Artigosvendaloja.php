<?php

/**
 * This is the model class for table "artigosvendaloja".
 *
 * The followings are the available columns in table 'artigosvendaloja':
 * @property integer $ID
 * @property integer $IDArtigoVenda
 * @property integer $IDLoja
 * @property bool $activo
 *
 * The followings are the available model relations:
 * @property Artigosvenda $iDArtigoVenda
 * @property Loja $iDLoja
 */
class Artigosvendaloja extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Artigosvendaloja the static model class
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
		return 'artigosvendaloja';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('IDArtigoVenda, IDLoja', 'required'),
			array('IDArtigoVenda, IDLoja', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, IDArtigoVenda, IDLoja, activo', 'safe', 'on'=>'search'),
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
			'iDArtigoVenda' => array(self::BELONGS_TO, 'Artigosvenda', 'IDArtigoVenda'),
			'iDLoja' => array(self::BELONGS_TO, 'Loja', 'IDLoja'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'IDArtigoVenda' => 'Idartigo Venda',
			'IDLoja' => 'Idloja',
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

		$criteria->compare('ID',$this->ID);
		$criteria->compare('IDArtigoVenda',$this->IDArtigoVenda);
		$criteria->compare('IDLoja',$this->IDLoja);
        $criteria->compare('activo',$this->activo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}