<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\User;
use app\components\Mailer;
use app\models\Contact;
use app\models\ReplyForm;
use yii\data\ActiveDataProvider;
use app\models\AddApartmentForm;
use yii\web\UploadedFile;
use app\models\Apartment;
use app\models\Deal;

class AdminController extends Controller{
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback'=> function($rule,$action){
                            return Yii::$app->user->identity->role==='ADMIN';
                        }
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $dataProvider=new ActiveDataProvider([
            "query"=> Contact::find()->where(['status' =>'ACTIVE']),
            "pagination" => [
                "pageSize" => 20,
            ],
        ]);
        return $this->render('index',['dataProvider'=>$dataProvider]);
    }

    public function actionAddApartment()
    {
        $model=new AddApartmentForm();
        if ($model->load(Yii::$app->request->post()))
        {
            $model->img=UploadedFile::getInstance($model,'img');
            if($model->upload()){
                Yii::$app->session->setFlash('AddFormSubmitted');
                $apartment=new Apartment();
                $apartment->img=$model->imgurl;
                $apartment->name=$model->name;
                $apartment->adress=$model->adress;
                $apartment->description=$model->description;
                $apartment->square=$model->square;
                $apartment->monthrent=$model->monthrent;
                $apartment->save();
            };
            return $this->refresh();
        }
        return $this->render('addapartment',['model' => $model]);

    }
    public function actionReply($id){
        $contact=Contact::findOne($id);
        $model=new ReplyForm();
        $model->email=$contact->email;
        $model->name =$contact->name;
        $model->subject =$contact->subject;
        $model->body =$contact->body;
        if ($model->load(Yii::$app->request->post())&& $model->validate()){
            Yii::$app->session->setFlash('ReplyFormSubmitted');
            Mailer::sendMail($contact->email,array(
                'Subject' => 'Reply '. $contact->subject,
                'Letter' => $model->reply
            ));
            $contact->status="CLOSE";
            $contact->save();
            return $this->refresh();
        }
        return $this->render('check',['model' => $model]);
    }

    public function actionGetDeals(){
        $dataProvider=new ActiveDataProvider([
            "query"=> Deal::find(),
            "pagination" => [
                "pageSize" => 20,
            ],
        ]);
        return $this->render('deals',['dataProvider'=>$dataProvider]);
    }
}