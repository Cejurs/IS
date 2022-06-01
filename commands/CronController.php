<?php
namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use app\components\Mailer;
use app\models\User;
use app\models\Deal;
use app\models\Apartment;


class CronController extends Controller
{
    public function actionTest()
    {
        $deals=Deal::find()->where("DAY(date)=DAY(NOW())AND status='ACTIVE'")->all();
        foreach($deals as $deal){
            $user=User::find()->where(['id'=>$deal->idUser])->one();
            $apartment=Apartment::findOne($deal->idApartment);
            $date = date("Y-m", strtotime($deal->date."+ $deal->monthCount months"));
            echo $date;
        }
    }
    public function actionCron()
    {
        $deals=Deal::find()->where("DAY(date)=DAY(NOW()) AND status='ACTIVE'")->all();
        foreach($deals as $deal){
            $user=User::find()->where(['id'=>$deal->idUser])->one();
            $apartment=Apartment::findOne($deal->idApartment);
            $date = date("Y-m", strtotime($deal->date."+ $deal->monthCount months"));;
            //$today= date("Y-m");
            $today="2023-06";
            if($date===$today){
                Mailer::sendMail($user->email,array(
                    'Subject' => 'Срок аренды истек',
                    'Letter' => "Срок вашей аренды недвижимости под названием: $apartment->name истек",
                ));
                $apartment->status="FREE";
                $apartment->save();
                $deal->status="CLOSE";
                $deal->save();
                continue;
            };
            Mailer::sendMail($user->email,array(
                'Subject' => 'Арендная плата',
                'Letter' => "Сегодня в 18:00 с вашего счета будет списано: $apartment->monthrent $ в счет оплаты аренды $apartment->name",
            ));
        }
    }

    public function actionPay()
    {
        $deals=Deal::find()->where("DAY(date)=DAY(NOW())AND status='ACTIVE'")->all();
        foreach($deals as $deal){
            if($deal)
            $user=User::find()->where(['id'=>$deal->idUser])->one();
            $apartment=Apartment::findOne($deal->idApartment);
            Mailer::sendMail($user->email,array(
                'Subject' => 'Арендная плата',
                'Letter' => "Сегодня в 18:00 с вашего счета будет списано: $apartment->monthrent $",
            ));
        }
    }
}
