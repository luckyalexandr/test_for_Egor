<?php

namespace frontend\forms;

use yii\base\Model;


class NotificationsForm extends Model
{
    public $undeliverable;
    public $billing_terms;
    public $partner_point_of_sale;
    public $payment_terms;
    public $platform_name;

    public function rules(): array
    {
        return [
            [['billing_terms', 'partner_point_of_sale', 'payment_terms', 'platform_name', 'undeliverable'], 'string'],
            [['undeliverable'], 'required'],
//            [['undeliverable'], 'boolean'],
        ];
    }
}
