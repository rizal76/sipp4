<?php

class UserController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        //here is the part where you check for self
        $id = Yii::app()->request->getParam('id');
        $self = $this->getSelfAccess($id);

        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('captcha', 'loginPage'),
                'users' => array('*'),
            ),
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => $self,
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'forget'),
                //'users'=>array('*'),
                'expression' => 'Yii::app()->user->isGuest',
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('updateAdmin', 'viewAdmin', 'delete', 'admin', 'createAdmin'),
                'expression' => '$user->isSuperAdmin()',
            //'users'=>array('admin'),
            ),
            // array('allow', // allow admin user to perform 'admin' and 'delete' actions
            // 	'actions'=>array('admin','delete'),
            // 	'users'=>array('admin'),
            // ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    protected function getSelfAccess($id) {
        $allow = array();

        if (!Yii::app()->user->isGuest) { //if it is user, check if it is self
            if ($id == Yii::app()->user->id)
            //return true;
                $allow[] = Yii::app()->user->getName();
        }
        return $allow;
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionViewAdmin($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id), 'admin' => $this->loadModelAdmin($id)
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new User;
        $daftar = false;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            // if(Yii::app()->user->isSuperAdmin()) {
            // 	$model->level_id=1;
            // }
            // else {
            //$model->scenario = 'create';
            $model->level_id = 0;
            //}

            if ($model->save()) {
                $daftar = true;
                $this->render('sukses', array('model' => $model,));
            }
        }
        if (!$daftar) {

            $this->render('create', array(
                'model' => $model,
            ));
        }
    }

    public function actionCreateAdmin() {
        $model = new User;
        $admin = new Admin;
        if (isset($_POST['User'], $_POST['Admin'])) {
            $model->attributes = $_POST['User'];
            $model->level_id = 1;
            if ($model->save()) {
                $admin->attributes = $_POST['Admin'];
                $numClients = Yii::app()->db->createCommand("SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'yii_sipp' AND   TABLE_NAME = 'sipp_user'")->queryScalar() - 1;
                $admin->id_user = $numClients;
                $admin->save();
                $this->redirect(array('user/admin'));
            }
        }

        $this->render('createAdmin', array(
            'model' => $model, 'admin' => $admin,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'], $_POST['Admin'])) {
            $model->attributes = $_POST['User'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /* Untuk update admin
     */

    public function actionUpdateAdmin($id) {
        $model = $this->loadModel($id);
        $admin = $this->loadModelAdmin($id);

        if (isset($_POST['User'], $_POST['Admin'])) {
            $model->attributes = $_POST['User'];
            //$admin->updateDepartemen($id,$newUsedLeaves); // function in model for updating data.
            if ($model->save()) {
                $admin->id_user = $id;
                $admin->departemen = $_POST['Admin']['departemen'];
                $admin->save();
                $this->redirect(array('user/admin'));
            }
        }

        $this->render('updateAdmin', array(
            'model' => $model, 'admin' => $admin,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('User');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new User('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionLoginPage() {
        $this->render('login');
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadModelAdmin($id) {
        $model = Admin::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'Admin tidak ada.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param User $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /* For captcha
     */

    public function actions() {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
        );
    }

    public function actionForget() {
        $model = new User;
        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $user = User::model()->find('LOWER(username)=?', array($model->username));
            //cek jika 
        
            if ($user != null) {
                //make a verifed code
                $verCode = $user->hashPassword($user->password);
                //save to database
                $connection = Yii::app()->db;
                $sql = "REPLACE INTO sipp_code_user (id_user, verified_code) VALUES ('$user->id' ,'$verCode');";
                $command = $connection->createCommand($sql);
                $rowCount = $command->execute();
                //send to email
                $user->sendMail($model->username, $verCode);
                Yii::app()->user->setFlash('success', "Sukses ! Silahkan periksa inbox email anda");
            } else {
                Yii::app()->user->setFlash('error', "Gagal ! Email tidak terdaftar ! ");
            }
        }
        // display the login form
        $this->render('forget', array('model' => $model));
    }

}
