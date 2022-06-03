<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignUpForm;
use app\models\User;
use app\components\Mailer;
use app\models\Contact;
use app\models\Apartment;
use app\models\Account;
use app\models\AddMoneyForm;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','account'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['account'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post','get'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $query = Apartment::find()->where(["status"=>"FREE"]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>6]);
        $models = $query->offset($pages->offset)
        ->limit($pages->limit)
        ->all();

        return $this->render('index', [
         'models' => $models,
         'pages' => $pages,
    ]);
    }

    public function actionView($id)
    {
        $apartment=Apartment::findOne($id);
        return $this->render('apartment',['model'=>$apartment]);
    }

    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model=new SignUpForm();
        if ($model->load(Yii::$app->request->post())&& $model->validate())
        {
            $user=new User();
            $user->email = $model->email;
            $user->userName = $model->username;
            $user->password = Yii::$app ->security->generatePasswordHash($model->password);

            if ($user->save())
            {
                Yii::$app->user->login($user);
                Mailer::sendMail($user->email,array(
                    'Subject' => 'Регистрация на RentApp',
                    'Letter' => "Вы успешно зарегистрировались " . $user->userName
                ));
                $account=new Account();
                $account->idUser=$user->id;
                $account->save();
                return $this->goHome();
            }
        }
        return $this->render('signup',compact('model'));
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if(!Yii::$app->user->isGuest){
            $model->email=Yii::$app->user->identity->email;
            $model->name =Yii::$app->user->identity->userName;
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            $contact=new Contact();
            $contact->email=$model->email;
            $contact->name=$model->name;
            $contact->subject=$model->subject;
            $contact->body=$model->body;
            if(!Yii::$app->user->isGuest)
            {
                $contact->idUser=Yii::$app->user->identity->id;
            }
            $contact->save();
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionAccount()
    {
        $user=Yii::$app->user->identity;
        $model=Account::find()->where(['idUser'=>$user->id])->one();
        $addmodel=new AddMoneyForm();
        if ($addmodel->load(Yii::$app->request->post()) && $model->validate()) {
            if($model->penalty!=0)
            {
                if($addmodel->sum>=$model->penalty){
                    $addmodel->sum-=$model->penalty;
                    $model->penalty=0;
                    $model->money+=$addmodel->sum;
                }
                else
                {
                    $model->penalty-=$addmodel->sum;
                }
            }
            else{
                $model->money+=$addmodel->sum;
            }
            $model->save();
            return $this->refresh();
        }
        return $this->render('account',['model' => $model,'addmodel'=>$addmodel]);
    }
}
