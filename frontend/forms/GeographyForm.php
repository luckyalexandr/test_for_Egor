<?php

namespace frontend\forms;

/**
 * @property HeaderForm $header
 */

class GeographyForm extends CompositeForm
{
    public $language;
    public $region_id;
    public $include;
    public $billing_terms;
    public $partner_point_of_sale;
    public $payment_terms;
    public $platform_name;
    public $supply_source;

    public function __construct($config = [])
    {
        $this->header = new HeaderForm(['scenario' => HeaderForm::SCENARIO_CONTENT]);
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['language', 'include', 'supply_source', 'billing_terms', 'partner_point_of_sale', 'payment_terms', 'platform_name'], 'string'],
            [['language', 'include', 'region_id'], 'required'],
        ];
    }

    protected function internalForms(): array
    {
        return ['header'];
    }
}
