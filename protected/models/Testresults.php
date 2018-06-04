<?php

/**
 * This is the model class for table "testresults".
 *
 * The followings are the available columns in table 'testresults':
 * @property integer $id
 * @property integer $user_id
 * @property integer $course_id
 * @property integer $test_type_id
 * @property integer $total_questions
 * @property integer $total_marks
 * @property integer $obtained_marks
 * @property string $result
 * @property string $attempted_on
 * @property string $time_consumed
 * @property string $test_questions
 */
class Testresults extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'testresults';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, course_id, test_type_id, total_questions, total_marks, obtained_marks, result, attempted_on, time_consumed, test_questions', 'required'),
			array('user_id, course_id, test_type_id, total_questions, total_marks, obtained_marks', 'numerical', 'integerOnly'=>true),
			array('result', 'length', 'max'=>20),
			array('time_consumed', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, course_id, test_type_id, total_questions, total_marks, obtained_marks, result, attempted_on, time_consumed, test_questions', 'safe', 'on'=>'search'),
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
			'test_type_id' => 'Test Type',
			'total_questions' => 'Total Questions',
			'total_marks' => 'Total Marks',
			'obtained_marks' => 'Obtained Marks',
			'result' => 'Result',
			'attempted_on' => 'Attempted On',
			'time_consumed' => 'Time Consumed',
			'test_questions' => 'Test Questions',
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
		$criteria->compare('test_type_id',$this->test_type_id);
		$criteria->compare('total_questions',$this->total_questions);
		$criteria->compare('total_marks',$this->total_marks);
		$criteria->compare('obtained_marks',$this->obtained_marks);
		$criteria->compare('result',$this->result,true);
		$criteria->compare('attempted_on',$this->attempted_on,true);
		$criteria->compare('time_consumed',$this->time_consumed,true);
		$criteria->compare('test_questions',$this->test_questions,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Testresults the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getTestScoreById($testId,$userId,$result,$couseId){
            
            $result = Yii::app()->db->createCommand()
                ->select('t.total_marks,t.obtained_marks')                
                ->from('testresults t')
                ->where('test_type_id=:test_type_id AND course_id=:course_id AND user_id=:user_id AND result=:result',
                            array(':test_type_id'=>$testId,'course_id'=>$couseId,'user_id'=>$userId,'result'=>$result))
                ->queryRow();
            return $result;
            
        }
}
