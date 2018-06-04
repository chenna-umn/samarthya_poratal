<?php

/**
 * This is the model class for table "assigntests".
 *
 * The followings are the available columns in table 'assigntests':
 * @property integer $id
 * @property integer $course_id
 * @property integer $test_id
 * @property integer $duration
 * @property integer $total_questions
 * @property integer $total_marks
 * @property integer $pass_marks
 * @property string $created_on
 * @property string $updated_on
 * @property integer $status
 */
class Assigntests extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'assigntests';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('course_id, test_id, duration, total_questions, total_marks, pass_marks, created_on, updated_on', 'required'),
			array('course_id, test_id, duration, total_questions, total_marks, pass_marks, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, course_id, test_id, duration, total_questions, total_marks, pass_marks, created_on, updated_on, status', 'safe', 'on'=>'search'),
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
			'course_id' => 'Course',
			'test_id' => 'Test',
			'duration' => 'Duration',
			'total_questions' => 'Total Questions',
			'total_marks' => 'Total Marks',
			'pass_marks' => 'Pass Marks',
			'created_on' => 'Created On',
			'updated_on' => 'Updated On',
			'status' => 'Status',
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
		$criteria->compare('course_id',$this->course_id);
		$criteria->compare('test_id',$this->test_id);
		$criteria->compare('duration',$this->duration);
		$criteria->compare('total_questions',$this->total_questions);
		$criteria->compare('total_marks',$this->total_marks);
		$criteria->compare('pass_marks',$this->pass_marks);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_on',$this->updated_on,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Assigntests the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
