<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property integer $user_type
 * @property string $created_on
 * @property string $updated_on
 * @property integer $status
 * @property string $staffid
 * @property string $email
 * @property string $designation
 * @property string $activation_link
 * @property string $profilePic
 * @property string $state
 * @property string $state_code
 * @property string $mobile
 * @property string $adhaar
 * @property string $functionary_name
 * @property string $staff_name
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, user_type, created_on', 'required'),
			array('user_type, status', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>250),
			array('password', 'length', 'max'=>64),
			array('staffid', 'length', 'max'=>20),
			array('email, designation, state, functionary_name, staff_name', 'length', 'max'=>500),
			array('state_code, mobile', 'length', 'max'=>10),
			array('adhaar', 'length', 'max'=>12),
			array('updated_on, activation_link, profilePic', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, user_type, created_on, updated_on, status, staffid, email, designation, activation_link, profilePic, state, state_code, mobile, adhaar, functionary_name, staff_name', 'safe', 'on'=>'search'),
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
			'password' => 'Password',
			'user_type' => 'User Type',
			'created_on' => 'Created On',
			'updated_on' => 'Updated On',
			'status' => 'Status',
			'staffid' => 'Staffid',
			'email' => 'Email',
			'designation' => 'Designation',
			'activation_link' => 'Activation Link',
			'profilePic' => 'Profile Pic',
			'state' => 'State',
			'state_code' => 'State Code',
			'mobile' => 'Mobile',
			'adhaar' => 'Adhaar',
			'functionary_name' => 'Functionary Name',
			'staff_name' => 'Staff Name',
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
		$criteria->compare('password',$this->password,true);
		$criteria->compare('user_type',$this->user_type);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_on',$this->updated_on,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('staffid',$this->staffid,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('designation',$this->designation,true);
		$criteria->compare('activation_link',$this->activation_link,true);
		$criteria->compare('profilePic',$this->profilePic,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('state_code',$this->state_code,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('adhaar',$this->adhaar,true);
		$criteria->compare('functionary_name',$this->functionary_name,true);
		$criteria->compare('staff_name',$this->staff_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public function getDistinctUserName() {
        $result = Yii::app()->db->createCommand()
                ->selectDistinct('t.username,t.id')
                ->Join('testresults tr', 'tr.user_id=t.id')
                ->from('user t')
                ->queryAll();
        return $result;
    }
    
    public function getDistinctDesignation() {
        $result = Yii::app()->db->createCommand()
                ->selectDistinct('t.designation')
                ->Join('testresults tr', 'tr.user_id=t.id')
                ->from('user t')
                ->queryAll();
        return $result;
    }

    public function getDistinctStates() {
        $result = Yii::app()->db->createCommand()
                ->selectDistinct('t.state')
                ->Join('testresults tr', 'tr.user_id=t.id')
                ->from('user t')
                ->queryAll();
        return $result;
    }
    public function getDistinctDesignationAll() {
        $result = Yii::app()->db->createCommand()
                ->selectDistinct('u.functionary_name')               
                ->from('user u')
                ->queryAll();
        return $result;
    }
    public function getDistinctStatesAll() {
        $result = Yii::app()->db->createCommand()
                ->selectDistinct('t.state')                
                ->from('user t')
                ->queryAll();
        return $result;
    }
     public function getuserName($id) {
        $result = Yii::app()->db->createCommand()
                ->select('t.username')                
                ->from('user t')
                ->where('id=:id',array(':id'=>$id))
                ->queryRow();
        return $result['username'];
    }
}
