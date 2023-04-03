<?php

namespace frontend\forms;

/**
 * @property HeaderForm $header
 */

class ManageBookingForm extends CompositeForm
{
    public $itinerary_id;
    public $token;

    public function __construct($config = [])
    {
        $this->header = new HeaderForm(['scenario' => HeaderForm::SCENARIO_IP]);
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['itinerary_id', 'token'], 'string'],
            [['itinerary_id', 'token'], 'required'],
        ];
    }

    protected function internalForms(): array
    {
        return ['header'];
    }
}

