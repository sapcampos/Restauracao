<?php

/**
 * This is the model class for table "Contrato".
 *
 * The followings are the available columns in table 'Contrato':
 * @property integer $id
 * @property integer $idtipocontrato
 * @property integer $idregimetrabalho
 * @property integer $idtipofuncionario
 * @property string $inicio
 * @property string $fim
 * @property integer $idloja
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
			array('id, idtipocontrato, idregimetrabalho, idtipofuncionario, inicio, idloja', 'required'),
			array('id, idtipocontrato, idregimetrabalho, idtipofuncionario, idloja', 'numerical', 'integerOnly'=>true),
			array('fim', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, idtipocontrato, idregimetrabalho, idtipofuncionario, inicio, fim, idloja', 'safe', 'on'=>'search'),
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
			'idtipocontrato' => 'Idtipocontrato',
			'idregimetrabalho' => 'Idregimetrabalho',
			'idtipofuncionario' => 'Idtipofuncionario',
			'inicio' => 'Inicio',
			'fim' => 'Fim',
			'idloja' => 'Idloja',
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}