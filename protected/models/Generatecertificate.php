<?php

/**
 * This is the model class for table "generatecertificate".
 *
 * The followings are the available columns in table 'generatecertificate':
 * @property integer $id
 * @property integer $user_id
 * @property integer $course_id
 * @property string $courseName
 * @property string $marks
 * @property string $created_on
 * @property string $certificate_unique_id
 */
class Generatecertificate extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'generatecertificate';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, course_id, courseName, marks, created_on', 'required'),
			array('user_id, course_id', 'numerical', 'integerOnly'=>true),
			array('courseName', 'length', 'max'=>500),
			array('marks, certificate_unique_id', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, course_id, courseName, marks, created_on, certificate_unique_id', 'safe', 'on'=>'search'),
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
			'course_id' => 'Course',
			'courseName' => 'Course Name',
			'marks' => 'Marks',
			'created_on' => 'Created On',
			'certificate_unique_id' => 'Certificate Unique',
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
		$criteria->compare('course_id',$this->course_id);
		$criteria->compare('courseName',$this->courseName,true);
		$criteria->compare('marks',$this->marks,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('certificate_unique_id',$this->certificate_unique_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Generatecertificate the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
        public function generateUniqueNumber(){
            $uniqueCode='MGNREGA-OLP'.rand(1000000000, 9999999999);
            $user = Generatecertificate::model()->find('certificate_unique_id=:certificate_unique_id',array('certificate_unique_id'=>$uniqueCode));
                    if(isset($user) && !empty($user)){
                       $uniqueCode =  Generatecertificate::model()->generateUniqueNumber();
                    }else{
                        $uniqueCode = $uniqueCode;
                    }
                    
                    return $uniqueCode;
        }
}
