<?php

class LowonganController extends Controller {

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
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('apply'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'create', 'update'),
                'expression' => '$user->isSuperAdmin()',
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'create', 'update'),
                'expression' => '$user->isAdmin()',
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
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
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Lowongan;
        $rendertahap2 = false;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $tahaps = Tahap::model()->findAll();
        $sss = null;
        if (isset($_POST['LowonganTahap'])) {
            $lowonganTahapsMasuk = array();
            $valid = true;
            //nyari LowonganTahap satu satu
            foreach ($_POST['LowonganTahap'] as $j => $modelp) {
                //kalo LowonganTahap oke
                if (isset($_POST['LowonganTahap'][$j])) {
                    //inisialisasi
                    $lowonganTahapsMasuk[$j] = LowonganTahap::model();
                    $lowonganTahapsMasuk[$j] = new LowonganTahap; // if you had static model only
                    $lowonganTahapsMasuk[$j]->attributes = $modelp;
                    //$lowonganTahapsMasuk[$j]->id_lowongan = $model->id;
                    //$lowonganTahapsMasuk[$j]->id_tahap =$modelp['id'];
                   // $valid=$lowonganTahapsMasuk[$j]->validate() && $valid;
                    if (strlen(trim(CUploadedFile::getInstanceByName('LowonganTahap[' . $j . '][file_tugas]'))) > 0) {
                        $sss = CUploadedFile::getInstanceByName('LowonganTahap[' . $j . '][file_tugas]');
                        $lowonganTahapsMasuk[$j]->file_tugas = $lowonganTahapsMasuk[$j]->id_lowongan . '-' . $lowonganTahapsMasuk[$j]->id_tahap . '.pdf';
                        if (strlen(trim($lowonganTahapsMasuk[$j]->file_tugas)) > 0) {
                            $sss->saveAs(Yii::app()->basePath . '/../file_tugas/' . $lowonganTahapsMasuk[$j]->file_tugas);
                        }
                    }
                }
            }

            if ($valid) {
                $i = 0;
                while (isset($lowonganTahapsMasuk[$i])) {
                    $lowonganTahapsMasuk[$i]->save(false); // models have already been validated                           
                    $i++;
                }
            }
            //kalo sukses
            if ($valid){
                    Yii::app()->user->setFlash('notification', 'Lowongan berhasil di buat !');
        
            } else {
                    Yii::app()->user->setFlash('notification', 'Lowongan gagal di simpan. Pastikan sesuai format !');
        
            }
            
        }
        if (isset($_POST['Lowongan'], $_POST['Tahap'])) {
            $model->attributes = $_POST['Lowongan'];
            //$model->new = 1;
            if ($model->save()) {
                $lowonganTahaps = array();
                $valid = true;
                //nyari tahap apa aja yang di pilih
                foreach ($_POST['Tahap'] as $j => $modelp) {
                    //kalo tahap ada 
                    if (isset($_POST['Tahap'][$j])) {
                        //kalo check bok yang dicentang aja yang dibuat objek
                        if ($modelp['nama'] == 1) {
                            $lowonganTahaps[$j] = lowonganTahap::model();
                            $lowonganTahaps[$j] = new lowonganTahap; // if you had static model only
                            $lowonganTahaps[$j]->attributes = $modelp;
                            $lowonganTahaps[$j]->id_lowongan = $model->id;
                            $lowonganTahaps[$j]->id_tahap = $modelp['id'];
                        }
                        // $lowonganTahaps[$j]->id_tahap= $_POST['Tahap'][$j]->id;
                        // $valid=$pengalamans[$j]->validate() && $valid;
                    }
                }
                // if ($valid) {
                //     $i=0;
                //     while (isset($pengalamans[$i])) {
                //     	$pengalamans[$i++]->save(false);// models have already been validated
                //     }
                // trigger_error(" save pengalamans");
                //     }
                $this->render('createLowonganTahap', array(
                    'idLowongan' => $model->id, 'tahaps' => $lowonganTahaps,
                ));
                $rendertahap2 = true;
            }
        }
        //load tahaps
        //kalo ngga load rander tahap2
        if (!$rendertahap2) {
            $this->render('create', array(
                'model' => $model, 'tahaps' => $tahaps,
            ));
        }
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

        if (isset($_POST['Lowongan'])) {
            $model->attributes = $_POST['Lowongan'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
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
        $dataProvider = new CActiveDataProvider('Lowongan');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Lowongan('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Lowongan']))
            $model->attributes = $_GET['Lowongan'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * apply 
     */
    public function actionApply($id) {
        //cek udah isi data diri belum
        //jika belum lempar ke isi data diri
        $userID = Yii::app()->user->id;
        $pelamar = Pelamar::model()->findByPk($userID);
        if ($pelamar == null) {
            //Yii::app()->user->setFlash('isi data diri dulu');
            Yii::app()->user->setFlash('notification', 'Silahkan isi data diri dahulu sebelum apply lowongan');
            $this->redirect(array('pelamar/create'));
        } else {
            $apply = new Lamaran();
            $apply->id_pelamar = $userID;
            $apply->id_lowongan = $id;
            $apply->insert();
            Yii::app()->user->setFlash('notification', 'Selamat anda sudah berhasil apply lowongan');
            $this->redirect(array('lowongan/view', 'id' => $id));
        }
        //jika udah maka simpan ke dalam lamaran
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Lowongan the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Lowongan::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Lowongan $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'lowongan-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
