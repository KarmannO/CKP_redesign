<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 06.03.2017
 * Time: 5:18
 */

namespace frontend\models;


use common\models\Ckp;
use common\models\CkpBinding;
use common\models\User;
use yii\base\Model;
use frontend\components\activities\ActivityHandler;

class CkpRegisterForm extends Model
{
    public $full_name;
    public $short_name;
    public $address;
    public $organization;
    public $director_full_name;
    public $director_degree;
    public $director_rank;
    public $director_position;
    public $director_phone;
    public $director_fax;

    public function rules()
    {
        return [
            ['full_name', 'required', 'message' => 'Поле не должно быть пустым'],
            ['short_name', 'required', 'message' => 'Поле не должно быть пустым'],
            ['address', 'required', 'message' => 'Поле не должно быть пустым'],
            ['organization', 'required', 'message' => 'Поле не должно быть пустым'],
            [['director_full_name', 'director_degree', 'director_rank', 'director_position', 'director_phone', 'director_fax'], 'default']
        ];
    }

    public function attributeLabels()
    {
        return [
            'full_name' => 'Полное наименование ЦКП *',
            'short_name' => 'Сокращённое наименование ЦКП *',
            'organization' => 'Организация, на базе которого развёрнут ЦКП *',
            'address' => 'Адрес *',
            'director_full_name' => 'ФИО руководителя',
            'director_degree' => 'Учёная степень руководителя',
            'director_rank' => 'Учёное звание руководителя',
            'director_position' => 'Должность руководителя',
            'director_phone' => 'Контактный телефон руководителя',
            'director_fax' => 'Контактный факс руководителя'
        ];
    }

    public function register()
    {
        if(!$this->validate()) {
            return null;
        }

        $ckp = new Ckp();
        $ckp->validation_status = 2;
        $ckp->short_name = 'ЦКП '.$this->short_name;
        $ckp->full_name = $this->full_name;
        $ckp->address = $this->address;
        $ckp->organization = $this->organization;

        $ckp->director_full_name = $this->director_full_name;
        $ckp->director_degree = $this->director_degree;
        $ckp->director_rank = $this->director_rank;
        $ckp->director_position = $this->director_position;
        $ckp->director_phone = $this->director_phone;
        $ckp->director_fax = $this->director_fax;

        $saved_ckp = $ckp->save();
        if($saved_ckp)
        {
            $binding = new CkpBinding();
            $binding->ckp_id = $ckp->id;
            $binding->user_id = User::getCurrentUser()->id;
            $binding->save();

            $info = ActivityHandler::handleNewCkp($ckp->id,
                    \Yii::$app->user->identity->id,
                    $ckp->full_name
                    );
            ActivityHandler::register_activity(1, $info);
            return $saved_ckp;
        }
        else
            return null;
    }
}