<?php

/**
 * This is the model class for table "registopastelaria".
 *
 * The followings are the available columns in table 'registopastelaria':
 * @property integer $ID
 * @property integer $IDRegisto
 * @property string $Montra
 * @property string $Quebras
 * @property string $Vendidos
 * @property string $PesoUnitario
 * @property string $PesoIdeal
 * @property integer $IDArtigoVenda
 * @property integer $IDLoja
 *
 * The followings are the available model relations:
 * @property Artigosvenda $iDArtigoVenda
 * @property Loja $iDLoja
 * @property Registodiario $iDRegisto
 */
class Registopastelaria extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Registopastelaria the static model class
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
		return 'registopastelaria';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('IDRegisto, IDArtigoVenda, IDLoja', 'required'),
			array('IDRegisto, IDArtigoVenda, IDLoja', 'numerical', 'integerOnly'=>true),
			array('Montra, Quebras, Vendidos, PesoUnitario, PesoIdeal', 'length', 'max'=>18),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, IDRegisto, Montra, Quebras, Vendidos, PesoUnitario, PesoIdeal, IDArtigoVenda, IDLoja', 'safe', 'on'=>'search'),
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
			'iDRegisto' => array(self::BELONGS_TO, 'Registodiario', 'IDRegisto'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'IDRegisto' => 'Idregisto',
			'Montra' => 'Montra',
			'Quebras' => 'Quebras',
			'Vendidos' => 'Vendidos',
			'PesoUnitario' => 'Peso Unitario',
			'PesoIdeal' => 'Peso Ideal',
			'IDArtigoVenda' => 'Idartigo Venda',
			'IDLoja' => 'Idloja',
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
		$criteria->compare('IDRegisto',$this->IDRegisto);
		$criteria->compare('Montra',$this->Montra,true);
		$criteria->compare('Quebras',$this->Quebras,true);
		$criteria->compare('Vendidos',$this->Vendidos,true);
		$criteria->compare('PesoUnitario',$this->PesoUnitario,true);
		$criteria->compare('PesoIdeal',$this->PesoIdeal,true);
		$criteria->compare('IDArtigoVenda',$this->IDArtigoVenda);
		$criteria->compare('IDLoja',$this->IDLoja);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}