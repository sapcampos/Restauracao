<?php

/**
 * This is the model class for table "registogelado".
 *
 * The followings are the available columns in table 'registogelado':
 * @property integer $ID
 * @property integer $IDArtigo
 * @property integer $IDLoja
 * @property integer $IDRegisto
 * @property string $PesoInicial
 * @property string $PesoFinal
 * @property string $Variacao
 *
 * The followings are the available model relations:
 * @property Registodiario $iDRegisto
 * @property Artigosvenda $iDArtigo
 * @property Loja $iDLoja
 */
class Registogelado extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Registogelado the static model class
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
		return 'registogelado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('IDArtigo, IDLoja, IDRegisto', 'required'),
			array('IDArtigo, IDLoja, IDRegisto', 'numerical', 'integerOnly'=>true),
			array('PesoInicial, PesoFinal, Variacao', 'length', 'max'=>18),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, IDArtigo, IDLoja, IDRegisto, PesoInicial, PesoFinal, Variacao', 'safe', 'on'=>'search'),
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
			'iDRegisto' => array(self::BELONGS_TO, 'C19Restauração.RegistoDiario', 'IDRegisto'),
			'iDArtigo' => array(self::BELONGS_TO, 'Artigosvenda', 'IDArtigo'),
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
			'IDArtigo' => 'Idartigo',
			'IDLoja' => 'Idloja',
			'IDRegisto' => 'Idregisto',
			'PesoInicial' => 'Peso Inicial',
			'PesoFinal' => 'Peso Final',
			'Variacao' => 'Variacao',
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
		$criteria->compare('IDArtigo',$this->IDArtigo);
		$criteria->compare('IDLoja',$this->IDLoja);
		$criteria->compare('IDRegisto',$this->IDRegisto);
		$criteria->compare('PesoInicial',$this->PesoInicial,true);
		$criteria->compare('PesoFinal',$this->PesoFinal,true);
		$criteria->compare('Variacao',$this->Variacao,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}