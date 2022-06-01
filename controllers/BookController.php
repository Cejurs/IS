<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\User;
use app\components\Mailer;
use yii\data\ActiveDataProvider;
use app\models\Apartment;
use app\models\Deal;
use app\models\BookingForm;

class BookController extends Controller{
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],

                    ],
                ],
            ],
        ];
    }
    public function actionBook($id)
    {
        $apartment=Apartment::findOne($id);
        if($apartment->status=="BOOKED"){
            Yii::$app->session->setFlash('ApartamentBooked');
        }
        $user=Yii::$app->user->identity;
        $model=new BookingForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            Yii::$app->session->setFlash('BookFormSubmitted');
            $deal=new Deal();
            $deal->idUser=$user->id;
            $deal->idApartment=$apartment->id;
            $deal->monthCount=$model->monthcount;
            $deal->date=date("Y-m-d"); 
            if($deal->save()){
                $apartment->status="BOOKED";
                $apartment->save();
            }
            return $this->refresh();
        }
        return $this->render('book', [
            'model' => $model,
        ]);
    }
}