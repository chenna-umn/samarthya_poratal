<?php

/**
 * This is the model class for table "nicdata".
 *
 * The followings are the available columns in table 'nicdata':
 * @property integer $id
 * @property string $username
 * @property string $firstname
 * @property string $lastname
 * @property string $staffid
 * @property string $designation
 * @property string $email
 * @property string $mobile
 * @property string $state
 * @property string $created_on
 * @property integer $status
 * @property string $state_code
 * @property string $aadhaar_no
 */
class Nicdata extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'nicdata';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, firstname, lastname, staffid, designation, email, mobile, state, created_on', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('username, staffid, designation, email, state', 'length', 'max'=>500),
			array('firstname, lastname', 'length', 'max'=>250),
			array('mobile, state_code', 'length', 'max'=>10),
			array('aadhaar_no', 'length', 'max'=>12),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, firstname, lastname, staffid, designation, email, mobile, state, created_on, status, state_code, aadhaar_no', 'safe', 'on'=>'search'),
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
			'username' => 'Username',
			'firstname' => 'Firstname',
			'lastname' => 'Lastname',
			'staffid' => 'Staffid',
			'designation' => 'Designation',
			'email' => 'Email',
			'mobile' => 'Mobile',
			'state' => 'State',
			'created_on' => 'Created On',
			'status' => 'Status',
			'state_code' => 'State Code',
			'aadhaar_no' => 'Aadhaar No',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('staffid',$this->staffid,true);
		$criteria->compare('designation',$this->designation,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('state_code',$this->state_code,true);
		$criteria->compare('aadhaar_no',$this->aadhaar_no,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Nicdata the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
