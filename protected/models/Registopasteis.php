<?php

/**
 * This is the model class for table "registopasteis".
 *
 * The followings are the available columns in table 'registopasteis':
 * @property integer $id
 * @property integer $idregisto
 * @property integer $iniciais
 * @property integer $cozidos
 * @property integer $sobras
 * @property string $horaprod
 */
class Registopasteis extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Registopasteis the static model class
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
		return 'registopasteis';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idregisto, horaprod', 'required'),
			array('idregisto, iniciais, cozidos, sobras', 'numerical', 'integerOnly'=>true),
			array('horaprod', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, idregisto, iniciais, cozidos, sobras, horaprod', 'safe', 'on'=>'search'),
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
			'idregisto' => 'Idregisto',
			'iniciais' => 'Iniciais',
			'cozidos' => 'Cozidos',
			'sobras' => 'Sobras',
			'horaprod' => 'Horaprod',
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
		$criteria->compare('idregisto',$this->idregisto);
		$criteria->compare('iniciais',$this->iniciais);
		$criteria->compare('cozidos',$this->cozidos);
		$criteria->compare('sobras',$this->sobras);
		$criteria->compare('horaprod',$this->horaprod,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}