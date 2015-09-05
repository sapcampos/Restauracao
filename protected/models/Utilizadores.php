<?php

/**
 * This is the model class for table "Utilizadores".
 *
 * The followings are the available columns in table 'Utilizadores':
 * @property integer $id
 * @property string $nome
 * @property string $username
 * @property string $password
 * @property integer $activo
 * @property integer $tipoutilizador
 * @property integer $loja
 *
 * @property integer $tipoutilizador0;
 * @property integer $loja0;
 */
class Utilizadores extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Utilizadores the static model class
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
		return 'utilizadores';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nome, username, password', 'required'),
            array('activo, tipoutilizador, loja', 'numerical', 'integerOnly'=>true),
			array('nome', 'length', 'max'=>128),
			array('username, password', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nome, username, password, activo, tipoutilizador, loja', 'safe', 'on'=>'search'),
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
            'tipoutilizador0'=>array(self::BELONGS_TO, 'Tipoutilizador', 'tipoutilizador'),
            'loja0'=>array(self::BELONGS_TO, 'Loja', 'loja'),
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
			'username' => 'Username',
			'password' => 'Password',
			'activo' => 'Activo',
            'tipoutilizador' => 'Tipo Utilizador',
            'loja' => 'Loja'
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('activo',$this->activo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}