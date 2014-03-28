<?php

/**
 * This is the model class for table "Artigos".
 *
 * The followings are the available columns in table 'Artigos':
 * @property integer $id
 * @property string $descricao
 * @property integer $idfornecedor
 * @property integer $activo
 * @property integer $tipoartigo
 * @property integer $tipounidade_enc
 * @property integer $tipounidade_stock
 * @property float $precounitarioencomenda
 * @property float $precounitarioinventario
 *
 * @property float $fornecedor0;
 * @property float $tipoartigo0;
 * @property integer unidadeEnc0;
 * @property integer unidadeInv0;
 */
class Artigos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Artigos the static model class
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
		return 'artigos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('descricao, idfornecedor, tipounidade_enc, tipounidade_stock', 'required'),
			array('idfornecedor, tipoartigo, activo, tipounidade_enc, tipounidade_stock, tipoartigo', 'numerical', 'integerOnly'=>true),
            array('precounidadeencomenda, precounidadeinventario', 'numerical'),
			array('descricao', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, descricao, idfornecedor, activo, tipounidade_enc, tipounidade_stock', 'safe', 'on'=>'search'),
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
            'fornecedor0'=>array(self::BELONGS_TO, 'Fornecedores', 'idfornecedor'),
            'tipoartigo0'=>array(self::BELONGS_TO, 'TipoArtigo', 'tipoartigo'),
            'unidadeEnc0'=>array(self::BELONGS_TO, 'TipoUnidade', 'tipounidade_enc'),
            'unidadeInv0'=>array(self::BELONGS_TO, 'TipoUnidade', 'tipounidade_stock'),
            'tipoartigo0'=>array(self::BELONGS_TO, 'TipoArtigo', 'tipoartigo'),
            'loja0'=>array(self::HAS_MANY, 'ArtigoLoja', 'idartigo')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'descricao' => 'Produto',
			'idfornecedor' => 'Fornecedor',
			'activo' => 'Activo',
			'tipounidade_enc' => 'Unidade Encomenda',
			'tipounidade_stock' => 'Unidade Inventário',
            'tipoartigo' => 'Tipo Artigo',
            'precounidadeencomenda' => 'Preço Unidade Encomenda',
            'precounidadeinventario' => 'Preço Unidade Inventário',
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
		$criteria->compare('descricao',$this->descricao,true);
		$criteria->compare('idfornecedor',$this->idfornecedor);
		$criteria->compare('activo',$this->activo);

		$criteria->compare('tipounidade_enc',$this->tipounidade_enc);
		$criteria->compare('tipounidade_stock',$this->tipounidade_stock);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function TemLoja()
    {
        $connection=Yii::app()->db;
        $sql = "Select count(*) FROM artigoloja WHERE idartigo = " . $this->id . " AND activo = 1";
        $command=$connection->createCommand($sql);
        $linhas=$command->queryScalar();
        return $linhas;
    }
}