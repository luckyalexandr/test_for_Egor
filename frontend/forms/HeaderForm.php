<?php

namespace frontend\forms;

use yii\base\Model;

class HeaderForm extends Model
{
    public $accept;
    public $accept_encoding;
    public $user_agent;
    public $customer_session_id;

    public function rules(): array
    {
        return [
            [['accept', 'accept_encoding', 'user_agent', 'customer_session_id'], 'string'],
            [['accept', 'accept_encoding', 'user_agent'], 'required'],
        ];
    }
}