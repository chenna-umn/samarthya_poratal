<?php

/**
 * This is the model class for table "coursedetails".
 *
 * The followings are the available columns in table 'coursedetails':
 * @property integer $id
 * @property integer $courseId
 * @property string $title
 * @property string $courseEngVideoLink
 * @property string $courseEngPDF
 * @property string $courseHindiVideoLink
 * @property string $courseHindiPDF
 * @property string $courseTeluguVideoLink
 * @property string $courseTeluguPDF
 * @property string $created_on
 * @property string $updated_on
 * @property integer $status
 * @property integer $order_by
 */
class Coursedetails extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'coursedetails';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('courseId, title, courseEngVideoLink, courseEngPDF, created_on, order_by', 'required'),
			array('courseId, status, order_by', 'numerical', 'integerOnly'=>true),
			array('courseHindiVideoLink, courseHindiPDF, courseTeluguVideoLink, courseTeluguPDF, updated_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, courseId, title, courseEngVideoLink, courseEngPDF, courseHindiVideoLink, courseHindiPDF, courseTeluguVideoLink, courseTeluguPDF, created_on, updated_on, status, order_by', 'safe', 'on'=>'search'),
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
			'courseId' => 'Course',
			'title' => 'Title',
			'courseEngVideoLink' => 'Course Eng Video Link',
			'courseEngPDF' => 'Course Eng Pdf',
			'courseHindiVideoLink' => 'Course Hindi Video Link',
			'courseHindiPDF' => 'Course Hindi Pdf',
			'courseTeluguVideoLink' => 'Course Telugu Video Link',
			'courseTeluguPDF' => 'Course Telugu Pdf',
			'created_on' => 'Created On',
			'updated_on' => 'Updated On',
			'status' => 'Status',
			'order_by' => 'Order By',
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
		$criteria->compare('courseId',$this->courseId);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('courseEngVideoLink',$this->courseEngVideoLink,true);
		$criteria->compare('courseEngPDF',$this->courseEngPDF,true);
		$criteria->compare('courseHindiVideoLink',$this->courseHindiVideoLink,true);
		$criteria->compare('courseHindiPDF',$this->courseHindiPDF,true);
		$criteria->compare('courseTeluguVideoLink',$this->courseTeluguVideoLink,true);
		$criteria->compare('courseTeluguPDF',$this->courseTeluguPDF,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_on',$this->updated_on,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('order_by',$this->order_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Coursedetails the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getCourseDetailsName($id){
            $testObject = Coursedetails::model()->find('id=:id',array('id'=>$id));
            if(isset($testObject) && !empty($testObject)){
                return $testObject->title;
            }
        }
}
