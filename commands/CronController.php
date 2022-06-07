<?php
namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use app\components\Mailer;
use app\models\User;
use app\models\Deal;
use app\models\Account;
use app\models\Apartment;


class CronController extends Controller
{
    public function actionTest()
    {
        Mailer::sendMail("cccejurs@gmail.com",array(
            'Subject' => 'CronTest',
            'Letter' => "Test",
        ));
    }
    
    public function actionCron() // Выполняется ежедневно в 12:00
    {
        $deals=Deal::find()->where("DAY(date)=DAY(NOW()) AND status='ACTIVE'")->all();
        foreach($deals as $deal){
            $user=User::find()->where(['id'=>$deal->idUser])->one();
            $apartment=Apartment::findOne($deal->idApartment);
            $date = date("Y-m-d", strtotime($deal->date."+ $deal->monthCount months"));;
            $today= date("Y-m-d");
            echo("$date \n $today");
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

    public function actionPay() // Выполняется ежедневно в 18:00
    {
        $deals=Deal::find()->where("DAY(date)=DAY(NOW())AND status='ACTIVE'")->all();
        foreach($deals as $deal){
            $user=User::find()->where(['id'=>$deal->idUser])->one();
            echo($deal->id);
            echo($user->id);
            $account=Account::find()->where(['idUser'=>$user->id])->one();
            echo($account->id);
            $apartment=Apartment::findOne($deal->idApartment);
            if($account->penalty>0)
            {
                Mailer::sendMail($user->email,array(
                    'Subject' => 'Разрыв договора',
                    'Letter' => "Просрочка платежа составляет более месяца. Ваш договор по аренде $apartment->name расторгнут. \n
                     Баланс счета: $account->money  Штрафы: $account->penalty",
                ));
                $apartment->status='FREE';
                $deal->status="TERMINATE";
                $account->save();
                $apartment->save();
                $deal->save();
                continue;
            }
            $account->money-=$apartment->monthrent;
            if($account->money<0){
                $account->penalty+=$apartment->monthrent/100; // пока так
                Mailer::sendMail($user->email,array(
                    'Subject' => 'Арендная плата',
                    'Letter' => "С вашего счета списаны средства за аренду $apartment->name. Где деньги Лебовски? Лови штраф. \n
                     Баланс счета: $account->money  Штрафы: $account->penalty",
                ));
                $account->save();
                $apartment->save();
                continue;
            }
            Mailer::sendMail($user->email,array(
                'Subject' => 'Арендная плата',
                'Letter' => "С вашего счета списаны средства за аренду $apartment->name. \n
                 Баланс счета: $account->money",));
                 $account->save();
                 $apartment->save();
        }
    }
}
