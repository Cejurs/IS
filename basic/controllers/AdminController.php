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
            "query"=> Contact::find(),
            "pagination" => [
                "pageSize" => 20,
            ],
        ]);
        return $this->render('index',['dataProvider'=>$dataProvider]);
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
}