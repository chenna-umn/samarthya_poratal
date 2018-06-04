<?php

/**
 * This is the model class for table "testquestions".
 *
 * The followings are the available columns in table 'testquestions':
 * @property integer $id
 * @property integer $sub_course_id
 * @property integer $course_id
 * @property string $question
 * @property string $option1
 * @property string $option2
 * @property string $option3
 * @property string $option4
 * @property string $answer
 * @property integer $active
 */
class Testquestions extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'testquestions';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('course_id, option1, option2, option3, option4', 'required'),
            array('sub_course_id, course_id, active', 'numerical', 'integerOnly' => true),
            array('question, answer', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, sub_course_id, course_id, question, option1, option2, option3, option4, answer, active', 'safe', 'on' => 'search'),
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
            'sub_course_id' => 'Sub Course',
            'course_id' => 'Course',
            'question' => 'Question',
            'option1' => 'Option1',
            'option2' => 'Option2',
            'option3' => 'Option3',
            'option4' => 'Option4',
            'answer' => 'Answer',
            'active' => 'Active',
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
        $criteria->compare('sub_course_id', $this->sub_course_id);
        $criteria->compare('course_id', $this->course_id);
        $criteria->compare('question', $this->question, true);
        $criteria->compare('option1', $this->option1, true);
        $criteria->compare('option2', $this->option2, true);
        $criteria->compare('option3', $this->option3, true);
        $criteria->compare('option4', $this->option4, true);
        $criteria->compare('answer', $this->answer, true);
        $criteria->compare('active', $this->active);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Testquestions the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getTestQuestions($courseId, $noOfQtns, $testType) {


        if ($testType != 3) {
            $finalQuestions = $questions = $finalArray = array();
            $subCourses = Coursedetails::model()->findAll('courseId=:courseId', array('courseId' => $courseId));

            if (isset($subCourses) && !empty($subCourses)) {
                $indiQuestions = ceil($noOfQtns / count($subCourses));                
                $i = 0;
                foreach ($subCourses as $key => $subCourse) {

                    $testQuestions = Yii::app()->db->createCommand()
                            ->select('s.*')
                            ->from('testquestions s')
                            ->where('s.course_id=:courseId AND sub_course_id=:sub_course_id', array(':courseId' => $courseId, 'sub_course_id' => $subCourse['id']))
                            ->order('RAND()')
                            ->limit($indiQuestions)
                            ->queryAll();
                    $finalQuestions[$i] = $testQuestions;
                    $i++;
                }

                foreach ($finalQuestions as $key => $value) {
                    if (count($value) < $indiQuestions) {
                        for ($i = 0; $i < count($value); $i++) {
                            $questions[] = $value[$i];
                        }
                    } else {
                        for ($i = 0; $i < $indiQuestions; $i++) {
                            $questions[] = $value[$i];
                        }
                    }
                }

                if (count($questions) > $noOfQtns) {
                    $finalArray = array_slice($questions, 0, $noOfQtns);
                } else {
                    $finalArray = array_slice($questions, 0, count($questions));
                }
            }
        } else {
            $testModel = Testresults::model()->find('course_id=:course_id AND test_type_id=:test_type_id AND user_id=:user_id', array('course_id' => $courseId, 'test_type_id' => 1, 'user_id' => Yii::app()->user->memId));
            $testQtsns = explode(",", $testModel->test_questions);
            $finalArray = Yii::app()->db->createCommand()
                    ->select('s.*')
                    ->from('testquestions s')
                    ->where(array('in', 'id', $testQtsns))
                    ->queryAll();
        }
        return $finalArray;
    }

}
