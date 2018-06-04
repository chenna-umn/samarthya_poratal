<?php

/**
 * This is the model class for table "tests".
 *
 * The followings are the available columns in table 'tests':
 * @property integer $id
 * @property string $test_name
 * @property string $created_on
 * @property string $updated_on
 * @property integer $status
 * @property integer $display_on_top
 */
class Tests extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tests';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('test_name, created_on, updated_on', 'required'),
            array('status, display_on_top', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, test_name, created_on, updated_on, status, display_on_top', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'test_name' => 'Test Name',
            'created_on' => 'Created On',
            'updated_on' => 'Updated On',
            'status' => 'Status',
            'display_on_top' => 'Display On Top',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('test_name', $this->test_name, true);
        $criteria->compare('created_on', $this->created_on, true);
        $criteria->compare('updated_on', $this->updated_on, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('display_on_top', $this->display_on_top);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Tests the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getTestName($id) {
        $testObject = Tests::model()->find('id=:id AND display_on_top=:display_on_top', array('id' => $id, 'display_on_top' => 1));
        if (isset($testObject) && !empty($testObject)) {
            return $testObject->test_name;
        }
    }

    public function getTestName1($id) {
        $testObject = Tests::model()->find('id=:id', array('id' => $id));
        if (isset($testObject) && !empty($testObject)) {
            return $testObject->test_name;
        }
    }

    public function getTestStatus($courseId, $testId) {
        $status = 1;
        $message = '';
        $data = array();
        $course = Courses::model()->findByPk($courseId);
        $subLinks = Coursedetails::model()->findAll('courseId=:courseId',array('courseId'=>$courseId));
        
        $userPdfViewed = Yii::app()->db->createCommand()
                                        ->selectDistinct('u.*')
                                        ->from('useractivity u')
                                        ->where('course_id=:course_id AND pdf_download=:pdf_download AND user_id=:user_id', array(':course_id'=>$courseId, ':pdf_download'=>1,'user_id'=>Yii::app()->user->memId))                                      
                                        ->group('course_sub_link')
                                        ->queryAll();
        $userVideoViewed = Yii::app()->db->createCommand()
                                        ->selectDistinct('u.*')
                                        ->from('useractivity u')
                                        ->where('course_id=:course_id AND video_view=:video_view AND user_id=:user_id', array(':course_id'=>$courseId, ':video_view'=>1,'user_id'=>Yii::app()->user->memId))                                      
                                        ->group('course_sub_link')
                                        ->queryAll();
        
        if ($testId == 2) {
            $testModel = Testresults::model()->find('course_id=:course_id AND test_type_id=:test_type_id AND user_id=:user_id AND result=:result', array('course_id' => $courseId, 'test_type_id' => $testId, 'user_id' => Yii::app()->user->memId, 'result' => 'Pass'));

            $checkPreTest = Testresults::model()->find('course_id=:course_id AND test_type_id=:test_type_id AND user_id=:user_id', array('course_id' => $courseId, 'test_type_id' => 1, 'user_id' => Yii::app()->user->memId));
            if (isset($testModel) && !empty($testModel)) {
                $message = 'You Have Already Taken ' . Tests::model()->getTestName1($testModel->test_type_id) . ' in Course ' . Courses::model()->getCourseNumber($testModel->course_id) . ' (' . Courses::model()->getCourseNumber($testModel->course_id) . ') ';
                $status = 0;
            } else if (!isset($checkPreTest) && empty($checkPreTest)) {
                $message = 'Please Complete ' . Tests::model()->getTestName1(1) . ' in Course ' . Courses::model()->getCourseNumber($course->id) . ' (' . Courses::model()->getCourseName($course->id) . ') ';
                $status = 0;
            } else if(isset($checkPreTest) && !empty ($checkPreTest)){
                if(count($subLinks)>count($userPdfViewed)){
                    $message = 'You Have Not Downloaded all PDFs for ' . Tests::model()->getTestName1(1) . ' in Course ' . Courses::model()->getCourseNumber($course->id) . ' (' . Courses::model()->getCourseName($course->id) . ') ';
                    $status = 0;
                }else if(count($subLinks)>count($userVideoViewed)){
                    $message = 'You Have Not seen all videos for ' . Tests::model()->getTestName1(1) . ' in Course ' . Courses::model()->getCourseNumber($course->id) . ' (' . Courses::model()->getCourseName($course->id) . ') ';
                    $status = 0;
                }
            }
        } else {
            $testModel = Testresults::model()->find('course_id=:course_id AND test_type_id=:test_type_id AND user_id=:user_id', array('course_id' => $courseId, 'test_type_id' => $testId, 'user_id' => Yii::app()->user->memId));
            if (isset($testModel) && !empty($testModel)) {
                $message = 'You Have Already Taken ' . Tests::model()->getTestName1($testModel->test_type_id) . ' in Course ' . Courses::model()->getCourseNumber($testModel->course_id) . ' (' . Courses::model()->getCourseName($testModel->course_id) . ') ';
                $status = 0;
            }
        }

        $data['status'] = $status;
        $data['message'] = $message;
        return $data;
    }
    
    
    public function getPreTestStatus($courseId, $testId) {
        $status = 1;
        $message = '';
        $data = array();       
        
            $testModel = Testresults::model()->find('course_id=:course_id AND test_type_id=:test_type_id AND user_id=:user_id', array('course_id' => $courseId, 'test_type_id' => $testId, 'user_id' => Yii::app()->user->memId));
            
            if (empty($testModel)) {
                $message = 'Please complete  ' . Tests::model()->getTestName1(1) . ' in Course ' . Courses::model()->getCourseNumber($courseId) . ' (' . Courses::model()->getCourseName($courseId) . ') to access the details';
                $status = 0;
            }
        

        $data['status'] = $status;
        $data['message'] = $message;
        return $data;
    }

}
