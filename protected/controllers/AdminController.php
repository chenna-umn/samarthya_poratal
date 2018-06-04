<?php

class AdminController extends Controller {

    public $layout = 'admin';
    public $defaultAction = 'index';

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {

        ini_set('max_execution_time', 300);
        if (isset(Yii::app()->user->userId)) {
            $this->layout = '//layouts/admin';
            Yii::app()->user->setState("adminmenu", "course");
            Yii::app()->user->setState("adminsubmenu", "courselist");
            $criteria = new CDbCriteria();
            $criteria->order = 'updated_on DESC';
            $count = Courses::model()->count($criteria);
            $pages = new CPagination($count);
            // results per page
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);
            $models = Courses::model()->findAll($criteria, array('order' => 'updated_on DESC'));
            $count = Courses::model()->count($criteria);
            $this->render('index', array(
                'models' => $models,
                'pages' => $pages, 'count' => $count
            ));
        } else {
            $this->layout = '//layouts/main';
            $this->redirect(array('site/index'));
        }
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        $this->layout = '//layouts/error';
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * This is the action to create a category.
     */
    public function actionCreate() {
        if (isset(Yii::app()->user->userId)) {
            //date_default_timezone_set("Asia/Calcutta");
            Yii::app()->user->setState("adminmenu", "course");
            Yii::app()->user->setState("adminsubmenu", "createcourse");
            $model = new Courses();

            if (isset($_POST['Courses'])) {
                $model->attributes = $_POST['Courses'];
                $model->created_on = date('Y-m-d h:i:s');
                $model->updated_on = date('Y-m-d h:i:s');
                if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
                    $uploaddir = 'uploads/courseImages/';
                    $uploadfile = $uploaddir . basename(date('Y-m-d-H-i') . "_" . $_FILES['image']['name']);
                    $filename = basename(date('Y-m-d-H-i') . "_" . $_FILES['image']['name']);
                    if ((is_dir('uploads/courseImages/'))) {
                        
                    } else {
                        mkdir('uploads/courseImages/', 0777, true);
                    }
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
                        
                    }
                    $model->courseImage = $filename;
                }
                if (isset($_FILES['PDFlink']['name']) && !empty($_FILES['PDFlink']['name'])) {
                    $uploaddir = 'uploads/coursePDF/';
                    $uploadfile = $uploaddir . basename(date('Y-m-d-H-i') . "_" . $_FILES['PDFlink']['name']);
                    $filename1 = basename(date('Y-m-d-H-i') . "_" . $_FILES['PDFlink']['name']);
                    if ((is_dir('uploads/coursePDF/'))) {
                        
                    } else {
                        mkdir('uploads/coursePDF/', 0777, true);
                    }
                    if (move_uploaded_file($_FILES['PDFlink']['tmp_name'], $uploadfile)) {
                        
                    }
                    $model->PDFlink = $filename1;
                }

                if ($model->validate()) {
                    if ($model->save()) {
                        $model->courseCode = 'OLP_00' . $model->id;
                        if ($model->validate()) {
                            if ($model->save()) {
                                
                            }
                        }
                        Yii::app()->user->setFlash('success', "New Course Added Successfully");
                        $this->redirect(array('admin/index'));
                    }
                } else {
                    Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Adding New Courses...Please Try Later...!");
                    $this->redirect(array('admin/create'));
                }
            }
            $this->render('create');
        } else {
            $this->layout = '//layouts/main';
            $this->redirect(array('site/index'));
        }
    }

    public function actionUpdateCourse($id) {
        if (isset(Yii::app()->user->userId)) {
            Yii::app()->user->setState("adminmenu", "course");
            Yii::app()->user->setState("adminsubmenu", "createcourse");
            $model = Courses::model()->findByPk($id);
//                    echo "<pre>";
//                    print_r($_POST['Courses']);exit;
            if (isset($_POST['Courses'])) {
                $model->attributes = $_POST['Courses'];
                $model->updated_on = date('Y-m-d h:i:s');
                if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
                    $uploaddir = 'uploads/courseImages/';
                    $uploadfile = $uploaddir . basename(date('Y-m-d-H-i') . "_" . $_FILES['image']['name']);
                    $filename = basename(date('Y-m-d-H-i') . "_" . $_FILES['image']['name']);
                    if ((is_dir('uploads/courseImages/'))) {
                        
                    } else {
                        mkdir('uploads/courseImages/', 0777, true);
                    }
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
                        
                    }
                    $model->courseImage = $filename;
                }
                if (isset($_FILES['PDFlink']['name']) && !empty($_FILES['PDFlink']['name'])) {
                    $uploaddir = 'uploads/coursePDF/';
                    $uploadfile = $uploaddir . basename(date('Y-m-d-H-i') . "_" . $_FILES['PDFlink']['name']);
                    $filename1 = basename(date('Y-m-d-H-i') . "_" . $_FILES['PDFlink']['name']);
                    if ((is_dir('uploads/coursePDF/'))) {
                        
                    } else {
                        mkdir('uploads/coursePDF/', 0777, true);
                    }
                    if (move_uploaded_file($_FILES['PDFlink']['tmp_name'], $uploadfile)) {
                        
                    }
                    $model->PDFlink = $filename1;
                }
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::app()->user->setFlash('success', "Course Updated Successfully");
                        $this->render('update', array('model' => $model));
                    }
                } else {
                    Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Adding Updating Course...Please Try Later...!");
                    $this->render('update', array('model' => $model));
                }
            } else {
                $this->render('update', array('model' => $model));
            }
        } else {
            $this->layout = '//layouts/main';
            $this->redirect(array('site/index'));
        }
    }

    public function actionDeleteCourse() {
        if (Yii::app()->user->isAdmin) {
            if (isset($_POST['id'])) {
                $model = Courses::model()->deleteByPk($_POST['id']);
                if ($model) {
                    echo "success";
                } else {
                    echo "failed";
                }
            }
        }
    }

    public function actionMakeStatusCourse() {
        if (Yii::app()->user->isAdmin) {
            if (isset($_POST['id'])) {
                $model = Courses::model()->findByPk($_POST['id']);
                if ($model->status == 1) {
                    $model->status = 0;
                } else {
                    $model->status = 1;
                }
                $model->updated_on = date('Y-m-d h:i:s');
                if ($model->validate()) {
                    if ($model->save()) {
                        echo "success";
                    } else {
                        echo "failed";
                    }
                }
            }
        }
    }

    public function actionCourseDetails() {

        ini_set('max_execution_time', 300);
        if (isset(Yii::app()->user->userId)) {
            $this->layout = '//layouts/admin';
            Yii::app()->user->setState("adminmenu", "course");
            Yii::app()->user->setState("adminsubmenu", "coursedetails");

            $criteria = new CDbCriteria();
            $criteria->select = 't.*,courses.courseName as courseName';
            $criteria->join = 'JOIN courses ON courses.id = t.courseId';
            $count = Coursedetails::model()->count($criteria);
            $pages = new CPagination($count);
            // results per page
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);
//                        print_r($criteria);exit;
            $pageSize = $to = 10;
            $from = 0;
            if (isset($_GET['page'])) {
                $from = ($_GET['page'] - 1) * $pageSize;
                $to = ($_GET['page']) * $pageSize;
            }

            $models = Yii::app()->db->createCommand()
                    ->select('s.*,c.courseName as courseName')
                    ->from('coursedetails s')
                    ->leftJoin('courses c', 'c.id=s.courseId')
                    ->order('s.updated_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
//                        $models=Subcategory::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
            $count = Coursedetails::model()->count($criteria);

            $this->render('courseDetails', array(
                'models' => $models,
                'pages' => $pages, 'count' => $count
            ));
        } else {
            $this->layout = '//layouts/main';
            $this->redirect(array('site/index'));
        }
    }

    public function actionSearchByCourse($id) {
        Yii::app()->user->setState("adminmenu", "course");
        Yii::app()->user->setState("adminsubmenu", "coursedetails");
        $criteria = new CDbCriteria();
        $criteria->select = 't.*,courses.courseName as courseName';
        $criteria->join = 'JOIN courses ON courses.id = t.courseId';
        $criteria->order = 'updated_on DESC';
        if ($id != "All") {
            $criteria->condition = "courseId=:value";
            $criteria->params = array(':value' => $id);
        }
        $count = Coursedetails::model()->count($criteria);
        $pages = new CPagination($count);
        // results per page
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
        if ($id != "All") {
            $models = Yii::app()->db->createCommand()
                    ->select('s.*,c.courseName as courseName')
                    ->from('coursedetails s')
                    ->join('courses c', 'c.id=s.courseId')
                    ->where('s.courseId=:courseId', array(':courseId' => $id))
                    ->order('updated_on desc')
                    ->queryAll();
        } else {
            $models = Yii::app()->db->createCommand()
                    ->select('s.*,c.courseName as courseName')
                    ->from('coursedetails s')
                    ->join('courses c', 'c.id=s.courseId')
                    ->order('updated_on desc')
                    ->queryAll();
        }

        $count = Coursedetails::model()->count($criteria);
        $this->render('courseDetails', array(
            'models' => $models,
            'pages' => $pages, 'count' => $count, 'courseId' => $id
        ));
    }

    /**
     * This is the action to create a category.
     */
    public function actionCreateCourseDetails() {
        //date_default_timezone_set("Asia/Calcutta");
        if (isset(Yii::app()->user->userId)) {
            Yii::app()->user->setState("adminmenu", "coursedetails");
            Yii::app()->user->setState("adminsubmenu", "createcoursedetails");
            $model = new Coursedetails();

            if (isset($_POST['Coursedetails'])) {
                $model->attributes = $_POST['Coursedetails'];
                $model->created_on = date('Y-m-d h:i:s');
                $model->updated_on = date('Y-m-d h:i:s');
                if (isset($_FILES['courseEngPDF']['name']) && !empty($_FILES['courseEngPDF']['name'])) {
                    $uploaddir = 'uploads/coursePDF/';
                    $uploadfile = $uploaddir . basename(date('Y-m-d-H-i') . "_" . $_FILES['courseEngPDF']['name']);
                    $filename = basename(date('Y-m-d-H-i') . "_" . $_FILES['courseEngPDF']['name']);
                    if ((is_dir('uploads/coursePDF/'))) {
                        
                    } else {
                        mkdir('uploads/coursePDF/', 0777, true);
                    }
                    if (move_uploaded_file($_FILES['courseEngPDF']['tmp_name'], $uploadfile)) {
                        
                    }
                    $model->courseEngPDF = $filename;
                }
                if (isset($_FILES['courseHindiPDF']['name']) && !empty($_FILES['courseHindiPDF']['name'])) {
                    $uploaddir = 'uploads/coursePDF/';
                    $uploadfile = $uploaddir . basename(date('Y-m-d-H-i') . "_" . $_FILES['courseHindiPDF']['name']);
                    $filename1 = basename(date('Y-m-d-H-i') . "_" . $_FILES['courseHindiPDF']['name']);
                    if ((is_dir('uploads/coursePDF/'))) {
                        
                    } else {
                        mkdir('uploads/coursePDF/', 0777, true);
                    }
                    if (move_uploaded_file($_FILES['courseHindiPDF']['tmp_name'], $uploadfile)) {
                        
                    }
                    $model->courseHindiPDF = $filename1;
                }
                if (isset($_FILES['courseTeluguPDF']['name']) && !empty($_FILES['courseTeluguPDF']['name'])) {
                    $uploaddir = 'uploads/coursePDF/';
                    $uploadfile = $uploaddir . basename(date('Y-m-d-H-i') . "_" . $_FILES['courseTeluguPDF']['name']);
                    $filename2 = basename(date('Y-m-d-H-i') . "_" . $_FILES['courseTeluguPDF']['name']);
                    if ((is_dir('uploads/coursePDF/'))) {
                        
                    } else {
                        mkdir('uploads/coursePDF/', 0777, true);
                    }
                    if (move_uploaded_file($_FILES['courseTeluguPDF']['tmp_name'], $uploadfile)) {
                        
                    }
                    $model->courseTeluguPDF = $filename2;
                }
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::app()->user->setFlash('success', "New Course Added Successfully");
                        $this->redirect(array('admin/courseDetails'));
                    }
                } else {
                    Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Adding New Courses...Please Try Later...!");
                    $this->redirect(array('admin/createCourseDetails'));
                }
            }

            $this->render('createCourseDetails');
        } else {
            $this->layout = '//layouts/main';
            $this->redirect(array('site/index'));
        }
    }

    public function actionUpdateCourseDetails($id) {
        //date_default_timezone_set("Asia/Calcutta");
        if (isset(Yii::app()->user->userId)) {
            $model = Coursedetails::model()->findByPk($id);
            Yii::app()->user->setState("adminmenu", "coursedetails");
            Yii::app()->user->setState("adminsubmenu", "createcoursedetails");
            if (isset($_POST['Coursedetails'])) {
                $model->attributes = $_POST['Coursedetails'];
                $model->created_on = date('Y-m-d h:i:s');
                $model->updated_on = date('Y-m-d h:i:s');
                if (isset($_FILES['courseEngPDF']['name']) && !empty($_FILES['courseEngPDF']['name'])) {
                    $uploaddir = 'uploads/coursePDF/';
                    $uploadfile = $uploaddir . basename(date('Y-m-d-H-i') . "_" . $_FILES['courseEngPDF']['name']);
                    $filename = basename(date('Y-m-d-H-i') . "_" . $_FILES['courseEngPDF']['name']);
                    if ((is_dir('uploads/coursePDF/'))) {
                        
                    } else {
                        mkdir('uploads/coursePDF/', 0777, true);
                    }
                    if (move_uploaded_file($_FILES['courseEngPDF']['tmp_name'], $uploadfile)) {
                        
                    }
                    $model->courseEngPDF = $filename;
                }
                if (isset($_FILES['courseHindiPDF']['name']) && !empty($_FILES['courseHindiPDF']['name'])) {
                    $uploaddir = 'uploads/coursePDF/';
                    $uploadfile = $uploaddir . basename(date('Y-m-d-H-i') . "_" . $_FILES['courseHindiPDF']['name']);
                    $filename1 = basename(date('Y-m-d-H-i') . "_" . $_FILES['courseHindiPDF']['name']);
                    if ((is_dir('uploads/coursePDF/'))) {
                        
                    } else {
                        mkdir('uploads/coursePDF/', 0777, true);
                    }
                    if (move_uploaded_file($_FILES['courseHindiPDF']['tmp_name'], $uploadfile)) {
                        
                    }
                    $model->courseHindiPDF = $filename1;
                }
                if (isset($_FILES['courseTeluguPDF']['name']) && !empty($_FILES['courseTeluguPDF']['name'])) {
                    $uploaddir = 'uploads/coursePDF/';
                    $uploadfile = $uploaddir . basename(date('Y-m-d-H-i') . "_" . $_FILES['courseTeluguPDF']['name']);
                    $filename2 = basename(date('Y-m-d-H-i') . "_" . $_FILES['courseTeluguPDF']['name']);
                    if ((is_dir('uploads/coursePDF/'))) {
                        
                    } else {
                        mkdir('uploads/coursePDF/', 0777, true);
                    }
                    if (move_uploaded_file($_FILES['courseTeluguPDF']['tmp_name'], $uploadfile)) {
                        
                    }
                    $model->courseTeluguPDF = $filename2;
                }
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::app()->user->setFlash('success', "Course Updated Successfully");
                        $this->render('updateCourseDetails', array('model' => $model));
                    }
                } else {
                    Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Adding New Courses...Please Try Later...!");
                    $this->render('updateCourseDetails', array('model' => $model));
                }
            }
            $this->render('updateCourseDetails', array('model' => $model));
        } else {
            $this->layout = '//layouts/main';
            $this->redirect(array('site/index'));
        }
    }

    public function actionDeleteCourseDetails() {
        if (Yii::app()->user->isAdmin) {
            if (isset($_POST['id'])) {
                $model = Coursedetails::model()->deleteByPk($_POST['id']);
                if ($model) {
                    echo "success";
                } else {
                    echo "failed";
                }
            }
        }
    }

    public function actionMakeStatusCourseDetails() {
        if (Yii::app()->user->isAdmin) {
            if (isset($_POST['id'])) {
                $model = Coursedetails::model()->findByPk($_POST['id']);
                if ($model->status == 1) {
                    $model->status = 0;
                } else {
                    $model->status = 1;
                }
                $model->updated_on = date('Y-m-d h:i:s');
                if ($model->validate()) {
                    if ($model->save()) {
                        echo "success";
                    } else {
                        echo "failed";
                    }
                }
            }
        }
    }

    public function actionTests() {

        ini_set('max_execution_time', 300);
        if (isset(Yii::app()->user->userId)) {
            $this->layout = '//layouts/admin';
            Yii::app()->user->setState("adminmenu", "tests");
            Yii::app()->user->setState("adminsubmenu", "testslist");
            $criteria = new CDbCriteria();
            $criteria->order = 'updated_on DESC';
            $count = Tests::model()->count($criteria);
            $pages = new CPagination($count);
            // results per page
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);
            $models = Tests::model()->findAll($criteria, array('order' => 'updated_on DESC'));
            $count = Tests::model()->count($criteria);
            $this->render('tests', array(
                'models' => $models,
                'pages' => $pages, 'count' => $count
            ));
        } else {
            $this->layout = '//layouts/main';
            $this->redirect(array('site/index'));
        }
    }

    public function actiontestQuestions() {

        ini_set('max_execution_time', 300);
        if (isset(Yii::app()->user->userId)) {
            $this->layout = '//layouts/admin';
            Yii::app()->user->setState("adminmenu", "tests");
            Yii::app()->user->setState("adminsubmenu", "uploadqtns");
            $criteria = new CDbCriteria();
            $criteria->order = 'id DESC';
            $count = Testquestions::model()->count($criteria);
            $pages = new CPagination($count);
            // results per page
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);
            $models = Testquestions::model()->findAll($criteria, array('order' => 'id DESC'));
            $count = Testquestions::model()->count($criteria);
            $this->render('testsQuestions', array(
                'models' => $models,
                'pages' => $pages, 'count' => $count
            ));
        } else {
            $this->layout = '//layouts/main';
            $this->redirect(array('site/index'));
        }
    }

    public function actionCreateTest() {
        //date_default_timezone_set("Asia/Calcutta");
        if (isset(Yii::app()->user->userId)) {
            Yii::app()->user->setState("adminmenu", "tests");
            Yii::app()->user->setState("adminsubmenu", "createtests");
            $model = new Tests();

            if (isset($_POST['Tests'])) {
                $model->attributes = $_POST['Tests'];
                $model->created_on = date('Y-m-d h:i:s');
                $model->updated_on = date('Y-m-d h:i:s');
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::app()->user->setFlash('success', "New Course Added Successfully");
                        $this->redirect(array('admin/Tests'));
                    }
                } else {
                    Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Adding New Courses...Please Try Later...!");
                    $this->redirect(array('admin/createTest'));
                }
            }
            $this->render('createTest');
        } else {
            $this->layout = '//layouts/main';
            $this->redirect(array('site/index'));
        }
    }

    public function actioncreateTestQuestions() {
        //date_default_timezone_set("Asia/Calcutta");
        if (isset(Yii::app()->user->userId)) {
            Yii::app()->user->setState("adminmenu", "tests");
            Yii::app()->user->setState("adminsubmenu", "createqtns");
            $i = 1;

            if (isset($_FILES['uploadFile']['name']) && !empty($_FILES['uploadFile']['name'])) {
                $uploaddir = 'uploads/testQuestionsFiles/';
                $uploadfile = $uploaddir . basename(date('Y-m-d-H-i') . "_" . $_FILES['uploadFile']['name']);
                $filename = basename(date('Y-m-d-H-i') . "_" . $_FILES['uploadFile']['name']);
                if ((is_dir('uploads/testQuestionsFiles/'))) {
                    
                } else {
                    mkdir('uploads/testQuestionsFiles/', 0777, true);
                }
                if (move_uploaded_file($_FILES['uploadFile']['tmp_name'], $uploadfile)) {
                    
                }
                include 'sm_assets/excel_reader/excel_reader.php';
                $excel = new PhpExcelReader;
                $excel->read('uploads/testQuestionsFiles/' . $filename);
                $nr_sheets = count($excel->sheets);

                foreach ($excel->sheets[0]['cells'] as $key => $value) {                    
                    $testQtns = new Testquestions();
                    $testQtns->course_id = $value[1];
                    $testQtns->sub_course_id = $value[2];
                    $testQtns->question = $value[3];
                    $testQtns->option1 = $value[4];
                    $testQtns->option2 = $value[5];
                    $testQtns->option3 = $value[6];
                    $testQtns->option4 = $value[7];
                    $testQtns->answer = $value[8];
                    $testQtns->active = $value[9];
                    if ($testQtns->validate()) {
                        if ($testQtns->save()) {
                            
                        }
                    }
                    $i++;
                }
                 Yii::app()->user->setFlash('success', 'Totally ' . $i . ' are added Successfully.');
            }
           
            $this->render('createTestQuestions');
        } else {
            $this->layout = '//layouts/main';
            $this->redirect(array('site/index'));
        }
    }

    public function actionUpdateTest($id) {
        if (isset(Yii::app()->user->userId)) {
            Yii::app()->user->setState("adminmenu", "tests");
            Yii::app()->user->setState("adminsubmenu", "createtests");
            $model = Tests::model()->findByPk($id);
//                    echo "<pre>";
//                    print_r($_POST['Courses']);exit;
            if (isset($_POST['Tests'])) {
                $model->attributes = $_POST['Tests'];
                $model->updated_on = date('Y-m-d h:i:s');
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::app()->user->setFlash('success', "Course Updated Successfully");
                        $this->render('updatetest', array('model' => $model));
                    }
                } else {
                    Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Adding Updating Course...Please Try Later...!");
                    $this->render('updatetest', array('model' => $model));
                }
            } else {
                $this->render('updatetest', array('model' => $model));
            }
        } else {
            $this->layout = '//layouts/main';
            $this->redirect(array('site/index'));
        }
    }

    public function actionDeleteTest() {
        if (Yii::app()->user->isAdmin) {
            if (isset($_POST['id'])) {
                $model = Tests::model()->deleteByPk($_POST['id']);
                if ($model) {
                    echo "success";
                } else {
                    echo "failed";
                }
            }
        }
    }

    public function actionMakeStatusTest() {
        if (Yii::app()->user->isAdmin) {
            if (isset($_POST['id'])) {
                $model = Tests::model()->findByPk($_POST['id']);
                if ($model->status == 1) {
                    $model->status = 0;
                } else {
                    $model->status = 1;
                }
                $model->updated_on = date('Y-m-d h:i:s');
                if ($model->validate()) {
                    if ($model->save()) {
                        echo "success";
                    } else {
                        echo "failed";
                    }
                }
            }
        }
    }

    public function actionAssignTest() {

        ini_set('max_execution_time', 300);
        if (isset(Yii::app()->user->userId)) {
            $this->layout = '//layouts/admin';
            Yii::app()->user->setState("adminmenu", "tests");
            Yii::app()->user->setState("adminsubmenu", "assigntest");

            $criteria = new CDbCriteria();
            $criteria->select = 't.*,courses.courseName as courseName,tests.test_name as testName';
            $criteria->join = 'JOIN courses ON courses.id = t.course_id';
            $criteria->join = 'JOIN tests ON tests.id = t.test_id';
            $count = Assigntests::model()->count($criteria);
            $pages = new CPagination($count);
            // results per page
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);
//                        print_r($criteria);exit;
            $pageSize = $to = 10;
            $from = 0;
            if (isset($_GET['page'])) {
                $from = ($_GET['page'] - 1) * $pageSize;
                $to = ($_GET['page']) * $pageSize;
            }

            $models = Yii::app()->db->createCommand()
                    ->select('s.*,c.courseName as courseName,t.test_name as testName')
                    ->from('assigntests s')
                    ->leftJoin('courses c', 'c.id=s.course_id')
                    ->leftJoin('tests t', 't.id=s.test_id')
                    ->order('s.updated_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
//                        $models=Subcategory::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
            $count = Assigntests::model()->count($criteria);

            $this->render('assignTest', array(
                'models' => $models,
                'pages' => $pages, 'count' => $count
            ));
        } else {
            $this->layout = '//layouts/main';
            $this->redirect(array('site/index'));
        }
    }

    public function actionDeleteAssignTest() {
        if (Yii::app()->user->isAdmin) {
            if (isset($_POST['id'])) {
                $model = Assigntests::model()->deleteByPk($_POST['id']);
                if ($model) {
                    echo "success";
                } else {
                    echo "failed";
                }
            }
        }
    }

    public function actionMakeStatusAssignTest() {
        if (Yii::app()->user->isAdmin) {
            if (isset($_POST['id'])) {
                $model = Assigntests::model()->findByPk($_POST['id']);
                if ($model->status == 1) {
                    $model->status = 0;
                } else {
                    $model->status = 1;
                }
                $model->updated_on = date('Y-m-d h:i:s');
                if ($model->validate()) {
                    if ($model->save()) {
                        echo "success";
                    } else {
                        echo "failed";
                    }
                }
            }
        }
    }

    public function actionCreateAssignTest() {
        //date_default_timezone_set("Asia/Calcutta");
        if (isset(Yii::app()->user->userId)) {
            Yii::app()->user->setState("adminmenu", "tests");
            Yii::app()->user->setState("adminsubmenu", "createassigntest");
            $model = new Assigntests();
            if (isset($_POST['Assigntests'])) {
                $model->attributes = $_POST['Assigntests'];
                $model->created_on = date('Y-m-d h:i:s');
                $model->updated_on = date('Y-m-d h:i:s');
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::app()->user->setFlash('success', "New Course Assigned Successfully");
                        $this->redirect(array('admin/AssignTest'));
                    }
                } else {
                    Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Adding New Course Assignment...Please Try Later...!");
                    $this->redirect(array('admin/createAssignTest'));
                }
            }
            $this->render('createAssignTest');
        } else {
            $this->layout = '//layouts/main';
            $this->redirect(array('site/index'));
        }
    }

    public function actionUpdateAssignTest($id) {
        if (isset(Yii::app()->user->userId)) {
            Yii::app()->user->setState("adminmenu", "tests");
            Yii::app()->user->setState("adminsubmenu", "createtests");
            $model = Assigntests::model()->findByPk($id);
            if (isset($_POST['Assigntests'])) {
                $model->attributes = $_POST['Assigntests'];
                $model->updated_on = date('Y-m-d h:i:s');
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::app()->user->setFlash('success', "Test Assignment Updated Successfully");
                        $this->render('updateAssignTest', array('model' => $model));
                    }
                } else {
                    Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Adding Updating Test Assignment...Please Try Later...!");
                    $this->render('updateAssignTest', array('model' => $model));
                }
            } else {
                $this->render('updateAssignTest', array('model' => $model));
            }
        } else {
            $this->layout = '//layouts/main';
            $this->redirect(array('site/index'));
        }
    }

    public function actionSearchByCourseForAssign($id) {
        Yii::app()->user->setState("adminmenu", "tests");
        Yii::app()->user->setState("adminsubmenu", "assigntest");
        $criteria = new CDbCriteria();
        $criteria->select = 't.*,courses.courseName as courseName,tests.test_name as testName';
        $criteria->join = 'JOIN courses ON courses.id = t.course_id';
        $criteria->join = 'JOIN tests ON tests.id = t.test_id';
        $criteria->order = 'updated_on DESC';
        if ($id != "All") {
            $criteria->condition = "course_id=:value";
            $criteria->params = array(':value' => $id);
        }
        $count = Assigntests::model()->count($criteria);
        $pages = new CPagination($count);
        // results per page
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
        if ($id != "All") {
            $models = Yii::app()->db->createCommand()
                    ->select('s.*,c.courseName as courseName,t.test_name as testName')
                    ->from('assigntests s')
                    ->join('courses c', 'c.id=s.course_id')
                    ->join('tests t', 't.id=s.test_id')
                    ->where('s.course_id=:course_id', array(':course_id' => $id))
                    ->order('updated_on desc')
                    ->queryAll();
        } else {
            $models = Yii::app()->db->createCommand()
                    ->select('s.*,c.courseName as courseName,t.test_name as testName')
                    ->from('assigntests s')
                    ->join('courses c', 'c.id=s.course_id')
                    ->join('tests t', 't.id=s.test_id')
                    ->order('updated_on desc')
                    ->queryAll();
        }

        $count = Assigntests::model()->count($criteria);
        $this->render('assignTest', array(
            'models' => $models,
            'pages' => $pages, 'count' => $count, 'courseId' => $id
        ));
    }

    public function actionSearchByTestForAssign($id) {
        Yii::app()->user->setState("adminmenu", "tests");
        Yii::app()->user->setState("adminsubmenu", "assigntest");
        $criteria = new CDbCriteria();
        $criteria->select = 't.*,courses.courseName as courseName,tests.test_name as testName';
        $criteria->join = 'JOIN courses ON courses.id = t.course_id';
        $criteria->join = 'JOIN tests ON tests.id = t.test_id';
        $criteria->order = 'updated_on DESC';
        if ($id != "All") {
            $criteria->condition = "test_id=:value";
            $criteria->params = array(':value' => $id);
        }
        $count = Assigntests::model()->count($criteria);
        $pages = new CPagination($count);
        // results per page
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
        if ($id != "All") {
            $models = Yii::app()->db->createCommand()
                    ->select('s.*,c.courseName as courseName,t.test_name as testName')
                    ->from('assigntests s')
                    ->join('courses c', 'c.id=s.course_id')
                    ->join('tests t', 't.id=s.test_id')
                    ->where('s.test_id=:test_id', array(':test_id' => $id))
                    ->order('updated_on desc')
                    ->queryAll();
        } else {
            $models = Yii::app()->db->createCommand()
                    ->select('s.*,c.courseName as courseName,t.test_name as testName')
                    ->from('assigntests s')
                    ->join('courses c', 'c.id=s.course_id')
                    ->join('tests t', 't.id=s.test_id')
                    ->order('updated_on desc')
                    ->queryAll();
        }

        $count = Assigntests::model()->count($criteria);
        $this->render('assignTest', array(
            'models' => $models,
            'pages' => $pages, 'count' => $count, 'testId' => $id
        ));
    }

    public function actionUserDetails() {

        ini_set('max_execution_time', 300);
        if (isset(Yii::app()->user->userId)) {
            $this->layout = '//layouts/admin';
            Yii::app()->user->setState("adminmenu", "userdetails");
            $criteria = new CDbCriteria();
            $criteria->select = 't.*';
            $count = User::model()->count($criteria);
            $pages = new CPagination($count);
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);

            $pageSize = $to = 10;
            $from = 0;
            if (isset($_GET['page'])) {
                $from = ($_GET['page'] - 1) * $pageSize;
                $to = ($_GET['page']) * $pageSize;
            }

            $models = Yii::app()->db->createCommand()
                    ->select('s.*')
                    ->from('user s')
                    ->order('s.updated_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
            $count = User::model()->count($criteria);
            $this->render('userDetails', array(
                'models' => $models,
                'pages' => $pages, 'count' => $count
            ));
        } else {
            $this->layout = '//layouts/main';
            $this->redirect(array('site/index'));
        }
    }

    public function actionsearchByDesignationsReportsUserDetails($id) {

        ini_set('max_execution_time', 300);
        $this->layout = '//layouts/admin';
        Yii::app()->user->setState("adminmenu", "userdetails");
        $criteria = new CDbCriteria();
        if ($id != "All") {
            $criteria->select = 't.*';
            $criteria->condition = 'functionary_name=:functionary_name';
            $criteria->params = array(':functionary_name' => $id);
        } else {
            $criteria->select = 't.*';
        }
        $count = User::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
        $pageSize = $to = 10;
        $from = 0;
        if (isset($_GET['page'])) {
            $from = ($_GET['page'] - 1) * $pageSize;
            $to = ($_GET['page']) * $pageSize;
        }
        if ($id != "All") {
            $models = Yii::app()->db->createCommand()
                    ->select('s.*')
                    ->from('user s')
                    ->where('functionary_name=:functionary_name', array(':functionary_name' => $id))
                    ->order('s.updated_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        } else {
            $models = Yii::app()->db->createCommand()
                    ->select('s.*')
                    ->from('user s')
                    ->order('s.updated_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        }
        $count = User::model()->count($criteria);
        $this->render('userDetails', array(
            'models' => $models,
            'pages' => $pages, 'count' => $count, 'designationId' => $id
        ));
    }

    public function actionsearchByStateReportsUserDetails($id) {

        ini_set('max_execution_time', 300);
        $this->layout = '//layouts/admin';
        Yii::app()->user->setState("adminmenu", "userdetails");
        $criteria = new CDbCriteria();
        if ($id != "All") {
            $criteria->select = 't.*';
            $criteria->condition = 'state=:state';
            $criteria->params = array(':state' => $id);
        } else {
            $criteria->select = 't.*';
        }
        $count = User::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
        $pageSize = $to = 10;
        $from = 0;
        if (isset($_GET['page'])) {
            $from = ($_GET['page'] - 1) * $pageSize;
            $to = ($_GET['page']) * $pageSize;
        }
        if ($id != "All") {
            $models = Yii::app()->db->createCommand()
                    ->select('s.*')
                    ->from('user s')
                    ->where('state=:state', array(':state' => $id))
                    ->order('s.updated_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        } else {
            $models = Yii::app()->db->createCommand()
                    ->select('s.*')
                    ->from('user s')
                    ->order('s.updated_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        }
        $count = User::model()->count($criteria);
        $this->render('userDetails', array(
            'models' => $models,
            'pages' => $pages, 'count' => $count, 'stateId' => $id
        ));
    }

    public function actionReports() {

        ini_set('max_execution_time', 300);
        if (isset(Yii::app()->user->userId)) {
            $this->layout = '//layouts/admin';
            Yii::app()->user->setState("adminmenu", "usertestdetails");
            $criteria = new CDbCriteria();
            $criteria->select = 't.*,courses.courseName as courseName,user.username as userName,tests.test_name as testName,user.designation as designation,user.state as state';
            $criteria->join = 'LEFT JOIN courses ON courses.id = t.course_id';
            $criteria->join = 'LEFT JOIN user ON user.id = t.user_id';
            $criteria->join = 'LEFT JOIN tests ON tests.id = t.test_type_id';
            $count = Testresults::model()->count($criteria);
            $pages = new CPagination($count);
            // results per page
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);
//                        print_r($criteria);exit;
            $pageSize = $to = 10;
            $from = 0;
            if (isset($_GET['page'])) {
                $from = ($_GET['page'] - 1) * $pageSize;
                $to = ($_GET['page']) * $pageSize;
            }

            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.test_name as testName,u.designation as designation,u.state as state')
                    ->from('testresults t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('tests ts', 'ts.id=t.test_type_id')
                    ->order('t.attempted_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
//                        $models=Subcategory::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
            $count = Testresults::model()->count($criteria);

            $this->render('reports', array(
                'models' => $models,
                'pages' => $pages, 'count' => $count
            ));
        } else {
            $this->layout = '//layouts/main';
            $this->redirect(array('site/index'));
        }
    }

    public function actionloginHistory() {

        ini_set('max_execution_time', 300);
        if (isset(Yii::app()->user->userId)) {
            $this->layout = '//layouts/admin';
            Yii::app()->user->setState("adminmenu", "logindetails");
            $criteria = new CDbCriteria();
            $criteria->select = 't.*,user.username as userName,user.id as userId';
            $criteria->join = 'LEFT JOIN user ON user.id = t.user_id';
            $criteria->group = 't.user_id';
            $criteria->order = 't.login_time DESC,t.id DESC';
            $count = Loginhistory::model()->count($criteria);
            $pages = new CPagination($count);
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);

            $pageSize = $to = 10;
            $from = 0;
            if (isset($_GET['page'])) {
                $from = ($_GET['page'] - 1) * $pageSize;
                $to = ($_GET['page']) * $pageSize;
            }

            $models = Yii::app()->db->createCommand()
                    ->select('l.*,u.username as userName,u.id as userId')
                    ->from('loginhistory l')
                    ->leftJoin('user u', 'u.id=l.user_id')
                    ->limit($pageSize, $from)
                    ->group('l.user_id')
                    ->order('l.login_time desc,l.id desc')
                    ->queryAll();
            $count = Loginhistory::model()->count($criteria);
            $this->render('loginHistory', array(
                'models' => $models,
                'pages' => $pages, 'count' => $count
            ));
        } else {
            $this->layout = '//layouts/main';
            $this->redirect(array('site/index'));
        }
    }

    public function actionuserLoginHistory($id) {

        ini_set('max_execution_time', 300);
        if (isset(Yii::app()->user->userId)) {
            $this->layout = '//layouts/admin';
            Yii::app()->user->setState("adminmenu", "logindetails");
            $criteria = new CDbCriteria();
            $criteria->select = 't.*';
            $criteria->condition = 't.user_id=:user_id';
            $criteria->params = array(':user_id' => $id);
            $count = Loginhistory::model()->count($criteria);
            $pages = new CPagination($count);
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);

            $pageSize = $to = 10;
            $from = 0;
            if (isset($_GET['page'])) {
                $from = ($_GET['page'] - 1) * $pageSize;
                $to = ($_GET['page']) * $pageSize;
            }

            $models = Yii::app()->db->createCommand()
                    ->select('l.*')
                    ->from('loginhistory l')
                    ->where('l.user_id=:user_id', array(':user_id' => $id))
                    ->limit($pageSize, $from)
                    ->queryAll();
            $count = Loginhistory::model()->count($criteria);
            $this->render('loginHistoryUser', array(
                'models' => $models,
                'pages' => $pages, 'count' => $count, 'userId' => $id
            ));
        } else {
            $this->layout = '//layouts/main';
            $this->redirect(array('site/index'));
        }
    }

    public function actionsearchByUserNameReports($id) {
        $this->layout = '//layouts/admin';
        Yii::app()->user->setState("adminmenu", "usertestdetails");

        $criteria = new CDbCriteria();
        $criteria->select = 't.*,courses.courseName as courseName,user.username as userName,tests.test_name as testName,user.designation as designation,user.state as state';
        $criteria->join = 'LEFT JOIN courses ON courses.id = t.course_id';
        $criteria->join = 'LEFT JOIN user ON user.id = t.user_id';
        $criteria->join = 'LEFT JOIN tests ON tests.id = t.test_type_id';
        if ($id != "All") {
            $criteria->condition = "user_id=:value";
            $criteria->params = array(':value' => $id);
        }
        $count = Testresults::model()->count($criteria);
        $pages = new CPagination($count);
        // results per page
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
//                        print_r($criteria);exit;
        $pageSize = $to = 10;
        $from = 0;
        if (isset($_GET['page'])) {
            $from = ($_GET['page'] - 1) * $pageSize;
            $to = ($_GET['page']) * $pageSize;
        }
        if ($id != "All") {
            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.test_name as testName,u.designation as designation,u.state as state')
                    ->from('testresults t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('tests ts', 'ts.id=t.test_type_id')
                    ->where('t.user_id=:user_id', array(':user_id' => $id))
                    ->order('t.attempted_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        } else {
            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.test_name as testName,u.designation as designation,u.state as state')
                    ->from('testresults t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('tests ts', 'ts.id=t.test_type_id')
                    ->order('t.attempted_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        }

//                        $models=Subcategory::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
        $count = Testresults::model()->count($criteria);

        $this->render('reports', array(
            'models' => $models,
            'pages' => $pages, 'count' => $count, 'userId' => $id
        ));
    }

    public function actionsearchByDesignationsReports($id) {
        $this->layout = '//layouts/admin';
        Yii::app()->user->setState("adminmenu", "usertestdetails");

        $criteria = new CDbCriteria();

        if ($id != "All") {
            $criteria->select = 't.*,courses.courseName as courseName,user.username as userName,tests.test_name as testName,user.designation as designation,user.state as state';
            $criteria->join = 'LEFT JOIN courses ON courses.id = t.course_id';
            $criteria->join = 'LEFT JOIN tests ON tests.id = t.test_type_id ';
            $criteria->join = 'LEFT JOIN user ON user.id = t.user_id AND user.designation=:email';
            $criteria->params = array(':email' => $id);
        } else {
            $criteria->select = 't.*,courses.courseName as courseName,user.username as userName,tests.test_name as testName,user.designation as designation,user.state as state';
            $criteria->join = 'LEFT JOIN courses ON courses.id = t.course_id';
            $criteria->join = 'LEFT JOIN tests ON tests.id = t.test_type_id ';
            $criteria->join = 'LEFT JOIN user ON user.id = t.user_id';
        }
        $count = Testresults::model()->count($criteria);
        $pages = new CPagination($count);
        // results per page
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
//                        print_r($criteria);exit;
        $pageSize = $to = 10;
        $from = 0;
        if (isset($_GET['page'])) {
            $from = ($_GET['page'] - 1) * $pageSize;
            $to = ($_GET['page']) * $pageSize;
        }
        if ($id != "All") {
            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.test_name as testName,u.designation as designation,u.state as state')
                    ->from('testresults t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('tests ts', 'ts.id=t.test_type_id')
                    ->where('u.designation=:designation', array(':designation' => $id))
                    ->order('t.attempted_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        } else {
            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.test_name as testName,u.designation as designation,u.state as state')
                    ->from('testresults t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('tests ts', 'ts.id=t.test_type_id')
                    ->order('t.attempted_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        }

//                        $models=Subcategory::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
        $count = Testresults::model()->count($criteria);

        $this->render('reports', array(
            'models' => $models,
            'pages' => $pages, 'count' => $count, 'designationId' => $id
        ));
    }

    public function actionsearchByStateReports($id) {
        $this->layout = '//layouts/admin';
        Yii::app()->user->setState("adminmenu", "usertestdetails");

        $criteria = new CDbCriteria();

        if ($id != "All") {
            $criteria->select = 't.*,courses.courseName as courseName,user.username as userName,tests.test_name as testName,user.designation as designation,user.state as state';
            $criteria->join = 'LEFT JOIN courses ON courses.id = t.course_id';
            $criteria->join = 'LEFT JOIN tests ON tests.id = t.test_type_id ';
            $criteria->join = 'LEFT JOIN user ON user.id = t.user_id AND user.state=:state';
            $criteria->params = array(':state' => $id);
        } else {
            $criteria->select = 't.*,courses.courseName as courseName,user.username as userName,tests.test_name as testName,user.designation as designation,user.state as state';
            $criteria->join = 'LEFT JOIN courses ON courses.id = t.course_id';
            $criteria->join = 'LEFT JOIN tests ON tests.id = t.test_type_id ';
            $criteria->join = 'LEFT JOIN user ON user.id = t.user_id';
        }
        $count = Testresults::model()->count($criteria);
        $pages = new CPagination($count);
        // results per page
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
//                        print_r($criteria);exit;
        $pageSize = $to = 10;
        $from = 0;
        if (isset($_GET['page'])) {
            $from = ($_GET['page'] - 1) * $pageSize;
            $to = ($_GET['page']) * $pageSize;
        }
        if ($id != "All") {
            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.test_name as testName,u.designation as designation,u.state as state')
                    ->from('testresults t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('tests ts', 'ts.id=t.test_type_id')
                    ->where('u.state=:state', array(':state' => $id))
                    ->order('t.attempted_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        } else {
            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.test_name as testName,u.designation as designation,u.state as state')
                    ->from('testresults t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('tests ts', 'ts.id=t.test_type_id')
                    ->order('t.attempted_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        }

//                        $models=Subcategory::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
        $count = Testresults::model()->count($criteria);

        $this->render('reports', array(
            'models' => $models,
            'pages' => $pages, 'count' => $count, 'stateId' => $id
        ));
    }

    public function actionsearchByCourseReports($id) {
        $this->layout = '//layouts/admin';
        Yii::app()->user->setState("adminmenu", "usertestdetails");

        $criteria = new CDbCriteria();

        if ($id != "All") {
            $criteria->select = 't.*,courses.courseName as courseName,user.username as userName,tests.test_name as testName,user.designation as designation,user.state as state';
            $criteria->join = 'LEFT JOIN courses ON courses.id = t.course_id  AND t.course_id=:courses';
            $criteria->join = 'LEFT JOIN tests ON tests.id = t.test_type_id ';
            $criteria->join = 'LEFT JOIN user ON user.id = t.user_id';
            $criteria->params = array(':courses' => $id);
        } else {
            $criteria->select = 't.*,courses.courseName as courseName,user.username as userName,tests.test_name as testName,user.designation as designation,user.state as state';
            $criteria->join = 'LEFT JOIN courses ON courses.id = t.course_id';
            $criteria->join = 'LEFT JOIN tests ON tests.id = t.test_type_id ';
            $criteria->join = 'LEFT JOIN user ON user.id = t.user_id';
        }
        $count = Testresults::model()->count($criteria);
        $pages = new CPagination($count);
        // results per page
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
//                        print_r($criteria);exit;
        $pageSize = $to = 10;
        $from = 0;
        if (isset($_GET['page'])) {
            $from = ($_GET['page'] - 1) * $pageSize;
            $to = ($_GET['page']) * $pageSize;
        }
        if ($id != "All") {
            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.test_name as testName,u.designation as designation,u.state as state')
                    ->from('testresults t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('tests ts', 'ts.id=t.test_type_id')
                    ->where('t.course_id=:course_id', array(':course_id' => $id))
                    ->order('t.attempted_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        } else {
            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.test_name as testName,u.designation as designation,u.state as state')
                    ->from('testresults t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('tests ts', 'ts.id=t.test_type_id')
                    ->order('t.attempted_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        }

//                        $models=Subcategory::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
        $count = Testresults::model()->count($criteria);

        $this->render('reports', array(
            'models' => $models,
            'pages' => $pages, 'count' => $count, 'courseId' => $id
        ));
    }

    public function actionsearchByTestTypeReports($id) {
        $this->layout = '//layouts/admin';
        Yii::app()->user->setState("adminmenu", "usertestdetails");

        $criteria = new CDbCriteria();

        if ($id != "All") {
            $criteria->select = 't.*,courses.courseName as courseName,user.username as userName,tests.test_name as testName,user.designation as designation,user.state as state';
            $criteria->join = 'LEFT JOIN courses ON courses.id = t.course_id';
            $criteria->join = 'LEFT JOIN tests ON tests.id = t.test_type_id   AND t.test_type_id=:test_type_id';
            $criteria->join = 'LEFT JOIN user ON user.id = t.user_id';
            $criteria->params = array(':test_type_id' => $id);
        } else {
            $criteria->select = 't.*,courses.courseName as courseName,user.username as userName,tests.test_name as testName,user.designation as designation,user.state as state';
            $criteria->join = 'LEFT JOIN courses ON courses.id = t.course_id';
            $criteria->join = 'LEFT JOIN tests ON tests.id = t.test_type_id ';
            $criteria->join = 'LEFT JOIN user ON user.id = t.user_id';
        }
        $count = Testresults::model()->count($criteria);
        $pages = new CPagination($count);
        // results per page
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
//                        print_r($criteria);exit;
        $pageSize = $to = 10;
        $from = 0;
        if (isset($_GET['page'])) {
            $from = ($_GET['page'] - 1) * $pageSize;
            $to = ($_GET['page']) * $pageSize;
        }
        if ($id != "All") {
            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.test_name as testName,u.designation as designation,u.state as state')
                    ->from('testresults t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('tests ts', 'ts.id=t.test_type_id')
                    ->where('t.test_type_id=:test_type_id', array(':test_type_id' => $id))
                    ->order('t.attempted_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        } else {
            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.test_name as testName,u.designation as designation,u.state as state')
                    ->from('testresults t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('tests ts', 'ts.id=t.test_type_id')
                    ->order('t.attempted_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        }

//                        $models=Subcategory::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
        $count = Testresults::model()->count($criteria);

        $this->render('reports', array(
            'models' => $models,
            'pages' => $pages, 'count' => $count, 'testId' => $id
        ));
    }

    public function actionValidateCertificate() {

        ini_set('max_execution_time', 300);
        if (isset(Yii::app()->user->userId)) {
            $this->layout = '//layouts/admin';
            Yii::app()->user->setState("adminmenu", "certificate");
            $criteria = new CDbCriteria();
            $criteria->select = 't.*';
            $criteria->join = 'LEFT JOIN user ON user.id = t.user_id';
            $criteria->group = 't.user_id,t.course_id';
            $criteria->order = 't.attempted_on desc';
            $count = Testresults::model()->count($criteria);
            $pages = new CPagination($count);
            // results per page
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);
//                        print_r($criteria);exit;
            $pageSize = $to = 10;
            $from = 0;
            if (isset($_GET['page'])) {
                $from = ($_GET['page'] - 1) * $pageSize;
                $to = ($_GET['page']) * $pageSize;
            }

            $models = Yii::app()->db->createCommand()
                    ->select('t.*')
                    ->from('testresults t')
                    ->group('t.user_id,t.course_id')
                    ->order('t.attempted_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
//                        $models=Subcategory::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
            $count = Testresults::model()->count($criteria);

            $this->render('validateCertificate', array(
                'models' => $models,
                'pages' => $pages, 'count' => $count
            ));
        } else {
            $this->layout = '//layouts/main';
            $this->redirect(array('site/index'));
        }
    }

    public function actionviewCertificate($courseId, $userId) {

        ini_set('max_execution_time', 300);
        if (isset(Yii::app()->user->userId)) {
            $this->layout = '//layouts/admin';
            $postTestScore = Testresults::model()->getTestScoreById(2, $userId, 'Pass', $courseId);
            $user = User::model()->findByPk($userId);
            $course = Courses::model()->findByPk($courseId);
            $this->render('viewCertificate', array(
                'postTestScore' => $postTestScore,
                'user' => $user, 'course' => $course
            ));
        } else {
            $this->layout = '//layouts/main';
            $this->redirect(array('site/index'));
        }
    }

    public function actiongenerateCertificate($courseId, $userId) {

        ini_set('max_execution_time', 300);
        if (isset(Yii::app()->user->userId)) {
            $this->layout = '//layouts/admin';
            $postTestScore = Testresults::model()->getTestScoreById(2, $userId, 'Pass', $courseId);
            $user = User::model()->findByPk($userId);
            $course = Courses::model()->findByPk($courseId);
            $checkGenereteCert= Generatecertificate::model()->find('user_id=:user_id AND course_id=:course_id',array('user_id'=>$user->id,'course_id'=>$course->id));
                if(isset($checkGenereteCert) && !empty($checkGenereteCert)){
                    $uniqueCode=$checkGenereteCert->certificate_unique_id;
                }else{
                    $uniqueCode=Generatecertificate::model()->generateUniqueNumber();;
                    
                }
            require_once('sm_assets/mailer/PHPMailerAutoload.php');
            $mail = new PHPMailer();
            //$body             = file_get_contents('contents.html');
            $body = '<!-- 
                                                                                     * Template Name: Unify - Responsive Bootstrap Template
                                                                                     * Description: Business, Corporate, Portfolio and Blog Theme.
                                                                                     * Version: 1.6
                                                                                     * Author: @htmlstream
                                                                                     * Website: http://htmlstream.com
                                                                                     -->
                                                                                    <!doctype html>
                                                                                    <html xmlns="http://www.w3.org/1999/xhtml">
                                                                                    <head>
                                                                                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                                                                    <title>OLP Certificate</title>

                                                                                    <style type="text/css">
                                                                                        .ReadMsgBody {width: 100%; background-color: #ffffff;}
                                                                                        .ExternalClass {width: 100%; background-color: #ffffff;}
                                                                                        body     {width: 100%; background-color: #ffffff; margin:0; padding:0; -webkit-font-smoothing: antialiased;font-family: Arial, Helvetica, sans-serif}
                                                                                        table {border-collapse: collapse;}

                                                                                        @media only screen and (max-width: 640px)  {
                                                                                                        body[yahoo] .deviceWidth {width:440px!important; padding:0;}    
                                                                                                        body[yahoo] .center {text-align: center!important;}  
                                                                                                }

                                                                                        @media only screen and (max-width: 479px) {
                                                                                                        body[yahoo] .deviceWidth {width:280px!important; padding:0;}    
                                                                                                        body[yahoo] .center {text-align: center!important;}  
                                                                                                }
                                                                                    </style>
                                                                                    </head>
                                                                                    <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix" style="font-family: Arial, Helvetica, sans-serif">

                                                                                    <!-- Wrapper -->
                                                                                    <div style="width:800px; height:550px; padding:20px; text-align:center; border: 10px solid #787878">
    <div style="width:750px; height:500px; padding:20px; text-align:center; border: 5px solid #787878">
    <div class="row">
            <img src="' . Yii::app()->params['domainName'].Yii::app()->request->baseUrl . '/sm_assets/assets/images/samarthya-logo.jpg" />
             <img src="' . Yii::app()->params['domainName'].Yii::app()->request->baseUrl . '/sm_assets/assets/images/emblem-img.jpg" />
    <div>
          
   <span style="text-align:right;margin-right:20px;right:0px">Certificate Id : '.$uniqueCode.'</span>            
   <br><br>
    <span style="font-size:50px; font-weight:bold">Certificate of Completion</span>
    <br><br>
       <span style="font-size:25px"><i>This is to certify that</i></span>
       <br><br>
       <span style="font-size:30px"><b>' . $user->staff_name . '</b></span><br/><br/>
       <span style="font-size:25px"><i>has completed the course</i></span> <br/><br/>
       <span style="font-size:30px">' . $course->courseName . '</span> <br/><br/>
       <span style="font-size:20px">with score of <b>' . $postTestScore['obtained_marks'] . '/' . $postTestScore['total_marks'] . '</b></span> <br/><br/>
      <br/><br/>
      
       <span style="font-size:16px;padding-left: 15px; padding-right: 15px;">Minister of Rural Development</span> <span style="font-size:16px;padding-left: 15px; padding-right: 15px;">Secretary (MoRD)</span> 
       <span style="font-size:16px;padding-left: 15px; padding-right: 15px;">Join-Secretary (MoRD)</span><br/>
       </div>
</div> 
                                                                                    <!-- End Wrapper -->
                                                                                    </body>
                                                                                    </html>';
            $obtained_marks = $postTestScore['obtained_marks'];
            $total_marks = $postTestScore['total_marks'];


            require('sm_assets/fpdf/WriteHTML.php');

        $pdf = new PDF_HTML();

        $pdf->AliasNbPages();
        $pdf->SetAutoPageBreak(true, 15);

        $pdf->AddPage();
        $pdf->Image('sm_assets/assets/images/samarthya-logo.jpg',10,10,90,20);
        $pdf->Image('sm_assets/assets/images/emblem-img.jpg',110,10,70,20);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->WriteHTML("<br><br><br><para><h1>Certificate Id : $uniqueCode </h1></para><br><br>");

        $pdf->SetFont('Arial', 'B', 36);            
        $pdf->WriteHTML2("<br><h1>Certificate of Completion</h1><br><br>");
        $pdf->SetFont('Arial', 'I', 24); 
        $pdf->WriteHTML2("<para>This is to certify that</para><br>");
         $pdf->SetFont('Arial', 'B', 24);
        $pdf->WriteHTML2("<para>$user->staff_name</para><br>");
        $pdf->SetFont('Arial', 'I', 20);
        $pdf->WriteHTML2("<para>has completed the course</para><br>");
        $pdf->SetFont('Arial', 'B', 20);
        $pdf->WriteHTML2("<para>$course->courseName</para><br>");
        $pdf->WriteHTML2("<para>with score of $obtained_marks / $total_marks</para><br><br>");
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->WriteHTML2("<para>Minister of Rural Development         Secretary (MoRD)      Join-Secretary (MoRD)</para>");
//$pdf->Output(); 
        $filename ='uploads/certificates/'.$uniqueCode.date('mdyhis').'.pdf';
//echo $filename;exit;
        $pdf->Output($filename, 'F');
            
            
            $mail->IsSMTP(); // telling the class to use SMTP
            $mail->Host = Yii::app()->params['emailHost']; // SMTP server
//                                            $mail->SMTPDebug  = 2;                   // 2 = messages only
            $mail->SMTPAuth = true;                  // enable SMTP authentication
            $mail->Host = Yii::app()->params['emailHost']; // sets the SMTP server
            //$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
            $mail->Username = Yii::app()->params['emailUserName']; // SMTP account username
            $mail->Password =Yii::app()->params['emailPassword'];
            $mail->SetFrom(Yii::app()->params['emailUserName'], 'OLP');
            $mail->AddReplyTo(Yii::app()->params['emailUserName'], "OLP");
            $mail->Subject = "OLP Certificate";
            //                    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
            $mail->MsgHTML($body);        // SMTP password
//                                    $mail->SMTPSecure = 'tls';
            $mail->SMTPKeepAlive = true;                                                 // Enable encryption, 'ssl' also accepted
            $mail->Port = 587;
            $address = $user->email;
            $mail->AddAddress($address, $user->email);
            $mail->AddAttachment($filename);
            //$mail->SMTPDebug  = 1;     
            $mail->isHTML(true);
            if (!$mail->Send()) {
                Yii::app()->user->setFlash('error', "Something Went Wrong While Sending Certificate.");
            } else {
                
                
                $genCertificate = new Generatecertificate();
                $genCertificate->user_id = $user->id;
                $genCertificate->courseName = $course->courseName;
                $genCertificate->course_id = $course->id;
                $genCertificate->certificate_unique_id = $uniqueCode;
                $genCertificate->marks = $postTestScore['obtained_marks'] . '/' . $postTestScore['total_marks'];
                $genCertificate->created_on = date('Y-m-d h:i:s');
                if ($genCertificate->validate()) {
                    if ($genCertificate->save()) {
                        
                    }
                }
                Yii::app()->user->setFlash('success', 'Certificate Sent to ' . $user->username . ' for the Course ' . $course->courseName);
            }

            $this->layout = '//layouts/admin';
            Yii::app()->user->setState("adminmenu", "certificate");
            $criteria = new CDbCriteria();
            $criteria->select = 't.*';
            $criteria->join = 'LEFT JOIN user ON user.id = t.user_id';
            $criteria->group = 't.user_id,t.course_id';
            $criteria->order = 't.attempted_on desc';
            $count = Testresults::model()->count($criteria);
            $pages = new CPagination($count);
            // results per page
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);
//                        print_r($criteria);exit;
            $pageSize = $to = 10;
            $from = 0;
            if (isset($_GET['page'])) {
                $from = ($_GET['page'] - 1) * $pageSize;
                $to = ($_GET['page']) * $pageSize;
            }

            $models = Yii::app()->db->createCommand()
                    ->select('t.*')
                    ->from('testresults t')
                    ->group('t.user_id,t.course_id')
                    ->order('t.attempted_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
//                        $models=Subcategory::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
            $count = Testresults::model()->count($criteria);

            $this->render('validateCertificate', array(
                'models' => $models,
                'pages' => $pages, 'count' => $count
            ));
        } else {
            $this->layout = '//layouts/main';
            $this->redirect(array('site/index'));
        }
    }

    public function actiongeneratedCertificate() {

        ini_set('max_execution_time', 300);
        if (isset(Yii::app()->user->userId)) {
            $this->layout = '//layouts/admin';
            Yii::app()->user->setState("adminmenu", "gencertificate");
            $criteria = new CDbCriteria();
            $criteria->select = 't.*';
            $criteria->order = 't.id DESC';
            $count = Generatecertificate::model()->count($criteria);
            $pages = new CPagination($count);
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);

            $pageSize = $to = 10;
            $from = 0;
            if (isset($_GET['page'])) {
                $from = ($_GET['page'] - 1) * $pageSize;
                $to = ($_GET['page']) * $pageSize;
            }

            $models = Yii::app()->db->createCommand()
                    ->select('l.*')
                    ->from('generatecertificate l')
                    ->limit($pageSize, $from)
                    ->order('l.id desc')
                    ->queryAll();
            $count = Generatecertificate::model()->count($criteria);
            $this->render('genCertificate', array(
                'models' => $models,
                'pages' => $pages, 'count' => $count
            ));
        } else {
            $this->layout = '//layouts/main';
            $this->redirect(array('site/index'));
        }
    }
    
    public function actioncheckCertificate() {

        ini_set('max_execution_time', 300);
        if (isset(Yii::app()->user->userId)) {
            $this->layout = '//layouts/admin';
            Yii::app()->user->setState("adminmenu", "valicertificate");
            $models = new User();
            if (isset($_POST['searchvalue'])) {
                $models = Yii::app()->db->createCommand()
                        ->select('l.*,u.*')
                        ->from('generatecertificate l')
                        ->leftJoin('user u', 'u.id=l.user_id')
                        ->where('l.certificate_unique_id=:certificate_unique_id', array('certificate_unique_id' => $_POST['searchvalue']))
                        ->order('l.id desc')
                        ->queryRow();
                if (isset($models) && !empty($models)) {
                    Yii::app()->user->setFlash('success', 'Certificate is generated for given code');
                } else {
                    Yii::app()->user->setFlash('error', 'No Certificate was generated for given code till now');
                }
                $this->render('valiCertificate', array(
                'models' => $models,'code'=>$_POST['searchvalue']));
            }else{
                $this->render('valiCertificate', array(
                'models' => $models));
            }

            
        } else {
            $this->layout = '//layouts/main';
            $this->redirect(array('site/index'));
        }
    }

    public function actionExportuserDetails() {
        if (isset(Yii::app()->user->userId)) {
            
            $models = Yii::app()->db->createCommand()
                    ->select('s.*')
                    ->from('user s')
                    ->order('s.updated_on desc')
                    ->queryAll();            
            /** Error reporting */
//            $phpExcelPath = Yii::getPathOfAlias('ext.phpexcel.Classes');
//
//            // Turn off our amazing library autoload 
//            spl_autoload_unregister(array('YiiBase', 'autoload'));
//
//            //
//            // making use of our reference, include the main class
//            // when we do this, phpExcel has its own autoload registration
//            // procedure (PHPExcel_Autoloader::Register();)
//            include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
spl_autoload_unregister(array('YiiBase','autoload'));
 Yii::import('ext.PHPExcel.Classes.PHPExcel', true);
 spl_autoload_register(array('YiiBase','autoload')); 

// Create new PHPExcel object
            $objPHPExcel = new PHPExcel();

// Set document properties
            $objPHPExcel->getProperties()->setCreator("OLP")
                    ->setLastModifiedBy("OLP")
                    ->setTitle("Office 2007 XLSX Document")
                    ->setSubject("Office 2007 XLSX Document")
                    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                    ->setKeywords("office 2007 openxml php")
                    ->setCategory("OLP Document");


// Add some data
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'User Name')
                    ->setCellValue('B1', 'Designation')
                    ->setCellValue('C1', 'Staff-Id')
                    ->setCellValue('D1', 'Mobile')
                    ->setCellValue('E1', 'State');

// Miscellaneous glyphs, UTF-8

            if (isset($models) && !empty($models)) {
                $i = 2;
                foreach ($models as $key => $value) {
                    $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A' . $i, $value['username'])
                            ->setCellValue('B' . $i, $value['designation'])
                            ->setCellValue('C' . $i, $value['staffid'])
                            ->setCellValue('D' . $i, $value['mobile'])
                            ->setCellValue('E' . $i, $value['state']);
                    $i++;
                }
            }
// Rename worksheet
            $objPHPExcel->getActiveSheet()->setTitle('User-Details'. date('d-m-Y'));


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
            header('Content-Type: application/vnd.ms-excel');
            header("Content-Disposition: attachment;Filename=User-Details-" .date('d-m-Y') .".xls");
            header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
            header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header('Pragma: public'); // HTTP/1.0

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
            exit;
            
            
            
        } else {
            $this->layout = '//layouts/main';
            $this->redirect(array('site/index'));
        }
    }

    public function actionExportReports() {
        if (isset(Yii::app()->user->userId)) {           
            
            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.test_name as testName,u.designation as designation,u.state as state')
                    ->from('testresults t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('tests ts', 'ts.id=t.test_type_id')
                    ->order('t.attempted_on desc')
                    ->queryAll();            
            /** Error reporting */
//            $phpExcelPath = Yii::getPathOfAlias('ext.phpexcel.Classes');
//
//            // Turn off our amazing library autoload 
//            spl_autoload_unregister(array('YiiBase', 'autoload'));
//
//            //
//            // making use of our reference, include the main class
//            // when we do this, phpExcel has its own autoload registration
//            // procedure (PHPExcel_Autoloader::Register();)
//            include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
spl_autoload_unregister(array('YiiBase','autoload'));
 Yii::import('ext.PHPExcel.Classes.PHPExcel', true);
 spl_autoload_register(array('YiiBase','autoload')); 

// Create new PHPExcel object
            $objPHPExcel = new PHPExcel();

// Set document properties
            $objPHPExcel->getProperties()->setCreator("OLP")
                    ->setLastModifiedBy("OLP")
                    ->setTitle("Office 2007 XLSX Document")
                    ->setSubject("Office 2007 XLSX Document")
                    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                    ->setKeywords("office 2007 openxml php")
                    ->setCategory("OLP Document");


// Add some data
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'User Name')
                    ->setCellValue('B1', 'Designation')
                    ->setCellValue('C1', 'State')
                    ->setCellValue('D1', 'Course')
                    ->setCellValue('E1', 'Test Name')
                    ->setCellValue('F1', 'Obtained Score')
                    ->setCellValue('G1', 'Total Score')
                    ->setCellValue('H1', 'Result');

// Miscellaneous glyphs, UTF-8

            if (isset($models) && !empty($models)) {
                $i = 2;
                foreach ($models as $key => $value) {
                    $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A' . $i, $value['userName'])
                            ->setCellValue('B' . $i, $value['designation'])
                            ->setCellValue('C' . $i, $value['state'])
                            ->setCellValue('D' . $i, $value['courseName'])
                            ->setCellValue('E' . $i, $value['testName'])
                            ->setCellValue('F' . $i, $value['obtained_marks'])
                            ->setCellValue('G' . $i, $value['total_marks'])
                            ->setCellValue('H' . $i, $value['result']);
                    $i++;
                }
            }



// Rename worksheet
            $objPHPExcel->getActiveSheet()->setTitle('Test-Results-'. date('d-m-Y'));


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
            header('Content-Type: application/vnd.ms-excel');
            header("Content-Disposition: attachment;Filename=Test-Results--" .date('d-m-Y') .".xls");
            header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
            header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header('Pragma: public'); // HTTP/1.0

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
            exit;
        } else {
            $this->layout = '//layouts/main';
            $this->redirect(array('site/index'));
        }
    }

    public function actionExportLoginHistory() {
        if (isset(Yii::app()->user->userId)) {            
           $models = Yii::app()->db->createCommand()
                    ->select('l.*,u.username as userName,u.id as userId')
                    ->from('loginhistory l')
                    ->leftJoin('user u', 'u.id=l.user_id')
                    ->group('l.user_id')
                    ->order('l.login_time desc,l.id desc')
                    ->queryAll();
            if (isset($models) && !empty($models)) {
                $i = 2;
                $status = 'Not Logged Out Successfully.';
                foreach ($models as $key => $value) {
                    $loginHistory = Loginhistory::model()->getLastLoginTime($value['user_id']);
                    $user[$i] = User::model()->getuserName($value['user_id']);
                    $logintime[$i] = $loginHistory[0]['login_time'];
                    if (isset($loginHistory[0]['logout_time']) && !empty($loginHistory[0]['logout_time'])) {                       
                        $logouttime[$i] = $loginHistory[0]['logout_time'];
                    } else {
                        $logouttime[$i] = $status;
                    }
                    $i++;
                }
            }
            /** Error reporting */
//            $phpExcelPath = Yii::getPathOfAlias('ext.phpexcel.Classes');
//
//            // Turn off our amazing library autoload 
//            spl_autoload_unregister(array('YiiBase', 'autoload'));
//
//            //
//            // making use of our reference, include the main class
//            // when we do this, phpExcel has its own autoload registration
//            // procedure (PHPExcel_Autoloader::Register();)
//            include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
spl_autoload_unregister(array('YiiBase','autoload'));
 Yii::import('ext.PHPExcel.Classes.PHPExcel', true);
 spl_autoload_register(array('YiiBase','autoload')); 

// Create new PHPExcel object
            $objPHPExcel = new PHPExcel();

// Set document properties
            $objPHPExcel->getProperties()->setCreator("OLP")
                    ->setLastModifiedBy("OLP")
                    ->setTitle("Office 2007 XLSX Document")
                    ->setSubject("Office 2007 XLSX Document")
                    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                    ->setKeywords("office 2007 openxml php")
                    ->setCategory("OLP Document");


// Add some data
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'User Name')
                    ->setCellValue('B1', 'Logged In Time')
                    ->setCellValue('C1', 'Logged Out Time');

// Miscellaneous glyphs, UTF-8

            if (isset($models) && !empty($models)) {
                $i = 2;
                foreach ($models as $key => $value) {
                    $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A' . $i, $user[$i])
                            ->setCellValue('B' . $i, $logintime[$i])
                            ->setCellValue('C' . $i, $logouttime[$i]);
                    $i++;
                }
            }

// Rename worksheet
            $objPHPExcel->getActiveSheet()->setTitle('Login-History-'. date('d-m-Y'));


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
            header('Content-Type: application/vnd.ms-excel');
            header("Content-Disposition: attachment;Filename=Login-History-" .date('d-m-Y') .".xls");
            header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
            header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header('Pragma: public'); // HTTP/1.0

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
            exit; 
        } else {
            $this->layout = '//layouts/main';
            $this->redirect(array('site/index'));
        }
    }

    public function actionExportvisitedCourse() {
        if (isset(Yii::app()->user->userId)) {            
           $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.title as courseTitle')
                    ->from('useractivity t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('coursedetails ts', 'ts.id=t.course_sub_link')
                    ->order('t.created_on desc')                   
                    ->queryAll();
            
            
            /** Error reporting */
//            $phpExcelPath = Yii::getPathOfAlias('ext.phpexcel.Classes');
//
//            // Turn off our amazing library autoload 
//            spl_autoload_unregister(array('YiiBase', 'autoload'));
//
//            //
//            // making use of our reference, include the main class
//            // when we do this, phpExcel has its own autoload registration
//            // procedure (PHPExcel_Autoloader::Register();)
//            include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
spl_autoload_unregister(array('YiiBase','autoload'));
 Yii::import('ext.PHPExcel.Classes.PHPExcel', true);
 spl_autoload_register(array('YiiBase','autoload')); 

// Create new PHPExcel object
            $objPHPExcel = new PHPExcel();

// Set document properties
            $objPHPExcel->getProperties()->setCreator("OLP")
                    ->setLastModifiedBy("OLP")
                    ->setTitle("Office 2007 XLSX Document")
                    ->setSubject("Office 2007 XLSX Document")
                    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                    ->setKeywords("office 2007 openxml php")
                    ->setCategory("OLP Document");


// Add some data
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'User Name')
                    ->setCellValue('B1', 'Viewed Date')
                    ->setCellValue('C1', 'Course')
                    ->setCellValue('D1', 'Description');

// Miscellaneous glyphs, UTF-8

            if (isset($models) && !empty($models)) {
                $i = 2;
                foreach ($models as $key => $value) {
                    $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A' . $i, $value['userName'])
                            ->setCellValue('B' . $i, $value['created_on'])
                            ->setCellValue('C' . $i, $value['courseName'])
                            ->setCellValue('D' . $i, $value['message']);
                    $i++;
                }
            }

// Rename worksheet
            $objPHPExcel->getActiveSheet()->setTitle('Visited-History-'. date('d-m-Y'));


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
            header('Content-Type: application/vnd.ms-excel');
            header("Content-Disposition: attachment;Filename=Visited-History-" .date('d-m-Y') .".xls");
            header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
            header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header('Pragma: public'); // HTTP/1.0

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
            exit; 
        } else {
            $this->layout = '//layouts/main';
            $this->redirect(array('site/index'));
        }
    }
    
    public function actionExportUserLoginHistory($id) {
        if (isset(Yii::app()->user->userId)) {
            $models = Yii::app()->db->createCommand()
                    ->select('l.*')
                    ->from('loginhistory l')
                    ->where('l.user_id=:user_id', array(':user_id' => $id))
                    ->queryAll();
            if (isset($models) && !empty($models)) {
                $i = 2;
                $status = 'Not Logged Out Successfully.';
                foreach ($models as $key => $value) {
                    $user[$i] = User::model()->getuserName($id);
                    $logintime[$i] = $value['login_time'];
                    if (isset($value['logout_time']) && !empty($value['logout_time'])) {                       
                        $logouttime[$i] = $value['logout_time'];
                    } else {
                        $logouttime[$i] = $status;
                    }
                    $i++;
                }
            }
            /** Error reporting */
//            $phpExcelPath = Yii::getPathOfAlias('ext.phpexcel.Classes');
//
//            // Turn off our amazing library autoload 
//            spl_autoload_unregister(array('YiiBase', 'autoload'));
//
//            //
//            // making use of our reference, include the main class
//            // when we do this, phpExcel has its own autoload registration
//            // procedure (PHPExcel_Autoloader::Register();)
//            include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
spl_autoload_unregister(array('YiiBase','autoload'));
 Yii::import('ext.PHPExcel.Classes.PHPExcel', true);
 spl_autoload_register(array('YiiBase','autoload')); 

// Create new PHPExcel object
            $objPHPExcel = new PHPExcel();

// Set document properties
            $objPHPExcel->getProperties()->setCreator("OLP")
                    ->setLastModifiedBy("OLP")
                    ->setTitle("Office 2007 XLSX Document")
                    ->setSubject("Office 2007 XLSX Document")
                    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                    ->setKeywords("office 2007 openxml php")
                    ->setCategory("OLP Document");


// Add some data
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'User Name')
                    ->setCellValue('B1', 'Logged In Time')
                    ->setCellValue('C1', 'Logged Out Time');

// Miscellaneous glyphs, UTF-8

            if (isset($models) && !empty($models)) {
                $i = 2;
                foreach ($models as $key => $value) {
                    $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A' . $i, $user[$i])
                            ->setCellValue('B' . $i, $logintime[$i])
                            ->setCellValue('C' . $i, $logouttime[$i]);
                    $i++;
                }
            }



// Rename worksheet
            $objPHPExcel->getActiveSheet()->setTitle('UserLoginHistory-'. date('d-m-Y'));


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
            header('Content-Type: application/vnd.ms-excel');
            header("Content-Disposition: attachment;Filename=UserLoginHistory-" .date('d-m-Y') .".xls");
            header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
            header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header('Pragma: public'); // HTTP/1.0

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
            exit;
        } else {
            $this->layout = '//layouts/main';
            $this->redirect(array('site/index'));
        }
    }

    public function actionExportvalidateCertificate() {
        if (isset(Yii::app()->user->userId)) {
            $models = Yii::app()->db->createCommand()
                    ->select('t.*')
                    ->from('testresults t')
                    ->group('t.user_id,t.course_id')
                    ->order('t.attempted_on desc')
                    ->queryAll();
            if (isset($models) && !empty($models)) {
                $i = 2;
                foreach ($models as $key => $value) {
                    $preTestScore = $postTestScore = $assesmentScore = array();
                    $preTestScore = Testresults::model()->getTestScoreById(1, $value['user_id'], 'Not Applicable', $value['course_id']);
                    $assesmentScore = Testresults::model()->getTestScoreById(2, $value['user_id'], 'Pass', $value['course_id']);
                    $postTestScore = Testresults::model()->getTestScoreById(3, $value['user_id'], 'Not Applicable', $value['course_id']);
                    if (isset($preTestScore) && !empty($preTestScore) && isset($postTestScore) && !empty($postTestScore) && isset($assesmentScore) && !empty($assesmentScore)) {
                        $modelnew[] = $value;
                        $user[$i] = User::model()->getuserName($value['user_id']);
                        $course[$i] = Courses::model()->getCourseName($value['course_id']);
                        $preTestScoreobt[$i] = $preTestScore['obtained_marks'];
                        $postTestScoreobt[$i] = $postTestScore['obtained_marks'];
                        $assesmentScoreobt[$i] = $assesmentScore['obtained_marks'];
                        $preTestScoretotal[$i] = $preTestScore['total_marks'];
                        $postTestScoretotal[$i] = $postTestScore['total_marks'];
                        $assesmentScoretotal[$i] = $assesmentScore['total_marks'];
                        $i++;
                    }
                }
            }
//        Yii::import('application.extensions.PHPExcel.*');
//        //include 'PHPExcel/IOFactory.php';
////        include('PHPExcel/Classes/PHPExcel.php');
//
//            /** Error reporting */
//            $phpExcelPath = Yii::getPathOfAlias('ext.phpexcel.Classes');
//
//            // Turn off our amazing library autoload 
//            spl_autoload_unregister(array('YiiBase', 'autoload'));
 spl_autoload_unregister(array('YiiBase','autoload'));
 Yii::import('ext.PHPExcel.Classes.PHPExcel', true);
 spl_autoload_register(array('YiiBase','autoload')); 
            //
            // making use of our reference, include the main class
            // when we do this, phpExcel has its own autoload registration
            // procedure (PHPExcel_Autoloader::Register();)
//            include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');


// Create new PHPExcel object
            $objPHPExcel = new PHPExcel();

// Set document properties
            $objPHPExcel->getProperties()->setCreator("OLP")
                    ->setLastModifiedBy("OLP")
                    ->setTitle("Office 2007 XLSX Document")
                    ->setSubject("Office 2007 XLSX Document")
                    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                    ->setKeywords("office 2007 openxml php")
                    ->setCategory("OLP Document");


// Add some data
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'User Name')
                    ->setCellValue('B1', 'Course name')
                    ->setCellValue('C1', 'Pre Test Obtained Score')
                    ->setCellValue('D1', 'Pre Test Total Score')
                    ->setCellValue('E1', 'Assessment Test Obtained  Score')
                    ->setCellValue('F1', 'Assessment Test Total Score')
                    ->setCellValue('G1', 'Post Test Obtained Score')
                    ->setCellValue('H1', 'Post Test Total Score');

// Miscellaneous glyphs, UTF-8

            if (isset($modelnew) && !empty($modelnew)) {
                $i = 2;
                foreach ($modelnew as $key => $value) {
                    $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A' . $i, $user[$i])
                            ->setCellValue('B' . $i, $course[$i])
                            ->setCellValue('C' . $i, $preTestScoreobt[$i])
                            ->setCellValue('D' . $i, $preTestScoretotal[$i])
                            ->setCellValue('E' . $i, $assesmentScoreobt[$i])
                            ->setCellValue('F' . $i, $assesmentScoretotal[$i])
                            ->setCellValue('G' . $i, $postTestScoreobt[$i])
                            ->setCellValue('H' . $i, $postTestScoretotal[$i]);
                    $i++;
                }
            }



// Rename worksheet
            $objPHPExcel->getActiveSheet()->setTitle('validate-Certificate-' . date('d-m-Y'));


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
            header('Content-Type: application/vnd.ms-excel');
            header("Content-Disposition: attachment;Filename=validate-Certificate-" . date('d-m-Y') . ".xls");
            header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
            header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header('Pragma: public'); // HTTP/1.0

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
            exit;
        } else {
            $this->layout = '//layouts/main';
            $this->redirect(array('site/index'));
        }
    }

    public function actionExportgeneratedCertificate() {
        if (isset(Yii::app()->user->userId)) {
            $models = Yii::app()->db->createCommand()
                    ->select('l.*')
                    ->from('generatecertificate l')
                    ->order('l.id desc')
                    ->queryAll();
            if (isset($models) && !empty($models)) {
                $i = 2;
                foreach ($models as $key => $value) {
                    $user[$i] = User::model()->getuserName($value['user_id']);
                    $i++;
                }
            }
            /** Error reporting */
//            $phpExcelPath = Yii::getPathOfAlias('ext.phpexcel.Classes');
//
//            // Turn off our amazing library autoload 
//            spl_autoload_unregister(array('YiiBase', 'autoload'));
//
//            //
//            // making use of our reference, include the main class
//            // when we do this, phpExcel has its own autoload registration
//            // procedure (PHPExcel_Autoloader::Register();)
//            include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
spl_autoload_unregister(array('YiiBase','autoload'));
 Yii::import('ext.PHPExcel.Classes.PHPExcel', true);
 spl_autoload_register(array('YiiBase','autoload')); 

// Create new PHPExcel object
            $objPHPExcel = new PHPExcel();

// Set document properties
            $objPHPExcel->getProperties()->setCreator("OLP")
                    ->setLastModifiedBy("OLP")
                    ->setTitle("Office 2007 XLSX Document")
                    ->setSubject("Office 2007 XLSX Document")
                    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                    ->setKeywords("office 2007 openxml php")
                    ->setCategory("OLP Document");


// Add some data
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'User Name')
                    ->setCellValue('B1', 'Course name')
                    ->setCellValue('C1', 'Score')
                    ->setCellValue('D1', 'Generated On');

// Miscellaneous glyphs, UTF-8

            if (isset($models) && !empty($models)) {
                $i = 2;
                foreach ($models as $key => $value) {
                    $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A' . $i, $user[$i])
                            ->setCellValue('B' . $i, $value['courseName'])
                            ->setCellValue('C' . $i, $value['marks'])
                            ->setCellValue('D' . $i, $value['created_on']);
                    $i++;
                }
            }



// Rename worksheet
            $objPHPExcel->getActiveSheet()->setTitle('generate-Certificate-' . date('d-m-Y'));


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
            header('Content-Type: application/vnd.ms-excel');
            header("Content-Disposition: attachment;Filename=generate-Certificate-" . date('d-m-Y') . ".xls");
            header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
            header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header('Pragma: public'); // HTTP/1.0

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
            exit;
        } else {
            $this->layout = '//layouts/main';
            $this->redirect(array('site/index'));
        }
    }

    public function actionImportXLS() {
        include 'sm_assets/excel_reader/excel_reader.php';
        $excel = new PhpExcelReader;
        $excel->read('sm_assets/excel_reader/test.xls');
        $nr_sheets = count($excel->sheets);
        echo "<pre>";
        print_r($excel->sheets[0]);
    }

    public function actionvisitedCourse() {

        ini_set('max_execution_time', 300);
        if (isset(Yii::app()->user->userId)) {
            $this->layout = '//layouts/admin';
            Yii::app()->user->setState("adminmenu", "visitedcourse");
            $criteria = new CDbCriteria();
            $criteria->select = 't.*,courses.courseName as courseName,user.username as userName,coursedetails.title as courseTitle';
            $criteria->join = 'LEFT JOIN courses ON courses.id = t.course_id';
            $criteria->join = 'LEFT JOIN user ON user.id = t.user_id';
            $criteria->join = 'LEFT JOIN coursedetails ON coursedetails.id = t.course_sub_link';
            $count = Useractivity::model()->count($criteria);
            $pages = new CPagination($count);
            // results per page
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);
//                        print_r($criteria);exit;
            $pageSize = $to = 10;
            $from = 0;
            if (isset($_GET['page'])) {
                $from = ($_GET['page'] - 1) * $pageSize;
                $to = ($_GET['page']) * $pageSize;
            }

            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.title as courseTitle')
                    ->from('useractivity t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('coursedetails ts', 'ts.id=t.course_sub_link')
                    ->order('t.created_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
//                        $models=Subcategory::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
            $count = Useractivity::model()->count($criteria);

            $this->render('memberactivityAll', array(
                'models' => $models,
                'pages' => $pages, 'count' => $count
            ));
        } else {
            $this->layout = '//layouts/main';
            $this->redirect(array('site/index'));
        }
    }

    public function actionvisitedCourseByUserName($id) {
        $this->layout = '//layouts/admin';
        Yii::app()->user->setState("adminmenu", "visitedcourse");

        $criteria = new CDbCriteria();
        $criteria->select = 't.*,courses.courseName as courseName,user.username as userName,coursedetails.title as courseTitle';
        $criteria->join = 'LEFT JOIN courses ON courses.id = t.course_id';
        $criteria->join = 'LEFT JOIN user ON user.id = t.user_id';
        $criteria->join = 'LEFT JOIN coursedetails ON coursedetails.id = t.course_sub_link';
        if ($id != "All") {
            $criteria->condition = "user_id=:value";
            $criteria->params = array(':value' => $id);
        }
        $count = Useractivity::model()->count($criteria);
        $pages = new CPagination($count);
        // results per page
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
//                        print_r($criteria);exit;
        $pageSize = $to = 10;
        $from = 0;
        if (isset($_GET['page'])) {
            $from = ($_GET['page'] - 1) * $pageSize;
            $to = ($_GET['page']) * $pageSize;
        }
        if ($id != "All") {
            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.title as courseTitle')
                    ->from('useractivity t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('coursedetails ts', 'ts.id=t.course_sub_link')
                    ->where('t.user_id=:user_id', array(':user_id' => $id))
                    ->order('t.created_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        } else {
            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.title as courseTitle')
                    ->from('useractivity t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('coursedetails ts', 'ts.id=t.course_sub_link')
                    ->order('t.created_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        }

//                        $models=Subcategory::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
        $count = Useractivity::model()->count($criteria);

        $this->render('memberactivityAll', array(
            'models' => $models,
            'pages' => $pages, 'count' => $count, 'userId' => $id
        ));
    }

    public function actionvisitedCourseByCourse($id) {
        $this->layout = '//layouts/admin';
        Yii::app()->user->setState("adminmenu", "visitedcourse");

        $criteria = new CDbCriteria();
        $criteria->select = 't.*,courses.courseName as courseName,user.username as userName,coursedetails.title as courseTitle';
        $criteria->join = 'LEFT JOIN courses ON courses.id = t.course_id';
        $criteria->join = 'LEFT JOIN user ON user.id = t.user_id';
        $criteria->join = 'LEFT JOIN coursedetails ON coursedetails.id = t.course_sub_link';
        if ($id != "All") {
            $criteria->condition = "course_id=:value";
            $criteria->params = array(':value' => $id);
        }
        $count = Useractivity::model()->count($criteria);
        $pages = new CPagination($count);
        // results per page
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
//                        print_r($criteria);exit;
        $pageSize = $to = 10;
        $from = 0;
        if (isset($_GET['page'])) {
            $from = ($_GET['page'] - 1) * $pageSize;
            $to = ($_GET['page']) * $pageSize;
        }
        if ($id != "All") {
            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.title as courseTitle')
                    ->from('useractivity t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('coursedetails ts', 'ts.id=t.course_sub_link')
                    ->where('t.course_id=:course_id', array(':course_id' => $id))
                    ->order('t.created_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        } else {
            $models = Yii::app()->db->createCommand()
                    ->select('t.*,c.courseName as courseName,u.username as userName,ts.title as courseTitle')
                    ->from('useractivity t')
                    ->leftJoin('courses c', 'c.id=t.course_id')
                    ->leftJoin('user u', 'u.id=t.user_id')
                    ->leftJoin('coursedetails ts', 'ts.id=t.course_sub_link')
                    ->order('t.created_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();
        }

//                        $models=Subcategory::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
        $count = Useractivity::model()->count($criteria);

        $this->render('memberactivityAll', array(
            'models' => $models,
            'pages' => $pages, 'count' => $count, 'userId' => $id
        ));
    }
    
    public function actiontestYouTube(){
        $this->layout = '//layouts/admin';
        $this->render('youtube');
    }
    
    public function actionpdfgenerate() {
//         require_once 'sm_assets/html2fpdf/html2fpdf.php';

        require('sm_assets/fpdf/WriteHTML.php');

        $pdf = new PDF_HTML();

        $pdf->AliasNbPages();
        $pdf->SetAutoPageBreak(true, 15);

        $pdf->AddPage();
//$pdf->Image('sm_assets/assets/images/samarthya-logo.jpg',10,10,90,20);
//$pdf->Image('sm_assets/assets/images/emblem-img.jpg',110,10,70,20);
        $pdf->SetFont('Arial', 'B', 14);
//        $pdf->WriteHTML();

        $pdf->SetFont('Arial', 'B', 7);
        $htmlTable = '<TABLE>
<TR>
<TD>Name:</TD>
<TD>asdas</TD>
</TR>
<TR>
<TD>Email:</TD>
<TD>dasdasd</TD>
</TR>
<TR>
<TD>URl:</TD>
<TD>adasda</TD>
</TR>
<TR>
<TD>Comment:</TD>
<TD>adadad</TD>
</TR>
</TABLE>';
        $pdf->WriteHTML2("<br><br><br>$htmlTable");
        $pdf->SetFont('Arial', 'B', 6);
//$pdf->Output(); 
        $filename ='uploads/certificates/test122222.pdf';
//echo $filename;exit;
        $pdf->Output($filename, 'F');
    }
}

