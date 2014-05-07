<?php

class SiteController extends Controller
{
	public $layout='main';

        public function accessRules() {
        //here is the part where you check for self
//        $id = Yii::app()->request->getParam('id');
//        $self = $this->getSelfAccess($id);

        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('forget'),
                 'expression' => 'Yii::app()->user->isGuest',
            ),);
        }
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->layout='index';
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}


	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	//login kalo belum bisa lamar kerja
	public function actionLogin()
	{
		// display the login form
		$this->render('login-first');
	}

	public function actionForget()
	{
		$model=new User;
		if(isset($_POST['User']))
		{
				$model->attributes=$_POST['User'];
				$user = User::model()->find('LOWER(username)=?', array($model->username)); 
				
				if($user!==null){
					//make a verifed code
					$verCode = $user->hashPassword($user->password);
					//save to database
					$connection=Yii::app()->db;
					$sql = "REPLACE INTO sipp_code_user (id_user, verified_code) VALUES ('$user->id' ,'$verCode');";
					$command=$connection->createCommand($sql);
					$rowCount=$command->execute();
					//send to email
					$user->sendMail($model->username, $verCode);
				}
		}
		// display the login form
		$this->render('forget',array('model'=>$model));
	}

	


	
}