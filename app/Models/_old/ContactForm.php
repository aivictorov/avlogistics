<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $firm;
    public $gruz;
    public $name;
    public $size;
    public $massa;
    public $phone;
    public $pack;
    public $place;
    public $email;
    public $from;
    public $to;
    public $dopinfo;
    public $verifyCode;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['firm', 'gruz', 'name', 'phone', 'email', 'from', 'to'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            /*['verifyCode', 'captcha'],*/

            [['size','massa', 'pack', 'place', 'dopinfo'], 'safe']
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string  $email the target email address
     * @return boolean whether the model passes validation
     */

    public function contact($email)
    {
        if ($this->validate()) {



            $bodydata = "Наименование организации: $this->firm
Наименование груза: $this->gruz
Контактное лицо: $this->name
Габаритны размер груза: $this->size
Масса: $this->massa
Телефон: $this->phone
Вид упаковки: $this->pack
Количество мест: $this->place
E-mail: $this->email
Пункт отправления: $this->from
Пункт назначения: $this->to
Дополнительная информация: $this->dopinfo";


            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([$this->email => $this->name])
                ->setSubject(Yii::t('adminka', 'Заявка с сайта'))
                ->setTextBody($bodydata)
                ->send();

            return true;
        } else {
            return false;
        }
    }
}
