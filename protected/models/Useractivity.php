<?php

/**
 * This is the model class for table "useractivity".
 *
 * The followings are the available columns in table 'useractivity':
 * @property integer $id
 * @property integer $course_id
 * @property integer $course_sub_link
 * @property integer $pdf_download
 * @property integer $video_view
 * @property string $created_on
 * @property integer $user_id
 * @property string $message
 */
class Useractivity extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'useractivity';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('course_id, course_sub_link, pdf_download, video_view, created_on, user_id', 'required'),
			array('course_id, course_sub_link, pdf_download, video_view, user_id', 'numerical', 'integerOnly'=>true),
			array('message', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, course_id, course_sub_link, pdf_download, video_view, created_on, user_id, message', 'safe', 'on'=>'search'),
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
			'course_sub_link' => 'Course Sub Link',
			'pdf_download' => 'Pdf Download',
			'video_view' => 'Video View',
			'created_on' => 'Created On',
			'user_id' => 'User',
			'message' => 'Message',
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
		$criteria->compare('course_sub_link',$this->course_sub_link);
		$criteria->compare('pdf_download',$this->pdf_download);
		$criteria->compare('video_view',$this->video_view);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('message',$this->message,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Useractivity the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
