<?php

namespace frontend\forms;

use yii\base\Model;

class HeaderForm extends Model
{
    public $accept;
    public $accept_encoding;
    public $user_agent;
    public $customer_session_id;
    public $customer_ip;

    const SCENARIO_CONTENT = 'content';
    const SCENARIO_IP = 'ip';

    public function rules(): array
    {
        return [
            [['accept', 'accept_encoding', 'user_agent', 'customer_session_id'], 'string'],
            ['customer_ip', 'string', 'on' => self::SCENARIO_IP],
            [['accept', 'accept_encoding', 'user_agent'], 'required', 'on' => self::SCENARIO_CONTENT],
            [['accept', 'accept_encoding', 'user_agent', 'customer_ip'], 'required', 'on' => self::SCENARIO_IP],
        ];
    }
}