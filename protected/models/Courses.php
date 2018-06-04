<?php

/**
 * This is the model class for table "courses".
 *
 * The followings are the available columns in table 'courses':
 * @property integer $id
 * @property string $courseCode
 * @property string $courseName
 * @property string $courseImage
 * @property string $description
 * @property string $PDFlink
 * @property string $created_on
 * @property string $updated_on
 * @property integer $order_by
 * @property integer $status
 * @property string $courseNumber
 */
class Courses extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'courses';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('courseName, created_on, order_by', 'required'),
			array('order_by, status', 'numerical', 'integerOnly'=>true),
			array('courseCode', 'length', 'max'=>10),
			array('courseNumber', 'length', 'max'=>11),
			array('courseImage, description, PDFlink, updated_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, courseCode, courseName, courseImage, description, PDFlink, created_on, updated_on, order_by, status, courseNumber', 'safe', 'on'=>'search'),
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
			'courseCode' => 'Course Code',
			'courseName' => 'Course Name',
			'courseImage' => 'Course Image',
			'description' => 'Description',
			'PDFlink' => 'Pdflink',
			'created_on' => 'Created On',
			'updated_on' => 'Updated On',
			'order_by' => 'Order By',
			'status' => 'Status',
			'courseNumber' => 'Course Number',
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
		$criteria->compare('courseCode',$this->courseCode,true);
		$criteria->compare('courseName',$this->courseName,true);
		$criteria->compare('courseImage',$this->courseImage,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('PDFlink',$this->PDFlink,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_on',$this->updated_on,true);
		$criteria->compare('order_by',$this->order_by);
		$criteria->compare('status',$this->status);
		$criteria->compare('courseNumber',$this->courseNumber,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Courses the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public function getCourseName($id){
            $testObject = Courses::model()->find('id=:id',array('id'=>$id));
            if(isset($testObject) && !empty($testObject)){
                return $testObject->courseName;
            }
        }
        
        public function getCourseCode($id){
            $testObject = Courses::model()->find('id=:id',array('id'=>$id));
            if(isset($testObject) && !empty($testObject)){
                return $testObject->courseCode;
            }
        }
        public function getCourseNumber($id){
            $testObject = Courses::model()->find('id=:id',array('id'=>$id));
            if(isset($testObject) && !empty($testObject)){
                return $testObject->courseNumber;
            }
        }
}
