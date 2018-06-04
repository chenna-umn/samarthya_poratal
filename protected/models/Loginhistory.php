<?php

/**
 * This is the model class for table "loginhistory".
 *
 * The followings are the available columns in table 'loginhistory':
 * @property integer $id
 * @property integer $user_id
 * @property string $login_time
 * @property string $logout_time
 * @property string $logout_comment
 */
class Loginhistory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'loginhistory';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, login_time', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('logout_comment', 'length', 'max'=>500),
			array('logout_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, login_time, logout_time, logout_comment', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'login_time' => 'Login Time',
			'logout_time' => 'Logout Time',
			'logout_comment' => 'Logout Comment',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('login_time',$this->login_time,true);
		$criteria->compare('logout_time',$this->logout_time,true);
		$criteria->compare('logout_comment',$this->logout_comment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Loginhistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public function getLastLoginTime($userId){
             $models = Yii::app()->db->createCommand()
                ->select('l.*')
                ->from('loginhistory l') 
               ->where('l.user_id=:user_id',array('user_id'=>$userId))
                ->order('l.login_time desc')
                ->limit(1)
                ->queryAll();
             return $models;
        }
       
        
}
