<?php

namespace frontend\forms;

/**
 * @property HeaderForm $header
 */

class GeographyForm extends CompositeForm
{
    public $language;
    public $brand_id;
    public $business_model;
    public $category_id_exclude;
    public $chain_id;
    public $country_code;
    public $date_added_end;
    public $date_added_start;
    public $date_updated_end;
    public $date_updated_start;
    public $include;
    public $multi_unit;
    public $property_id;
    public $property_rating_max;
    public $property_rating_min;
    public $supply_source;
    public $billing_terms;
    public $partner_point_of_sale;
    public $payment_terms;
    public $platform_name;

    public function __construct($config = [])
    {
        $this->header = new HeaderForm();
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['language', 'brand_id', 'business_model', 'category_id_exclude', 'chain_id', 'country_code', 'include', 'property_id', 'supply_source', 'billing_terms', 'partner_point_of_sale', 'payment_terms', 'platform_name'], 'string'],
            [['date_added_end', 'date_added_start', 'date_updated_end', 'date_updated_start'], 'date', 'format' => 'Y-mm-dd'],
            [['language', 'supply_source'], 'required'],
            [['property_rating_max', 'property_rating_min'], 'double'],
            [['multi_unit'], 'boolean'],
        ];
    }

    protected function internalForms(): array
    {
        return ['header'];
    }
}

//curl -X GET "https://test.ean.com/v3/properties/content?language=language%3Den-US&brand_id=15%2C+64%2C+73%2C+84&business_model=business_model%3Dexpedia_collect%26business_model%3Dproperty_collect&category_id_exclude=category_id_exclude%3D3%26category_id_exclude%3D1&chain_id=chain_id%3D-6%26chain_id%3D1&country_code=country_code%3DUS%26country_code%3DJP&date_added_end=date_added_end%3D2018-12-31&date_added_start=date_added_start%3D2018-09-15&date_updated_end=date_updated_end%3D2018-12-31&date_updated_start=date_updated_start%3D2018-09-15&include=include%3Dproperty_ids%26include%3Daddress&multi_unit=true&property_id=property_id%3D19248%26property_id%3D20321&property_rating_max=property_rating_max%3D5.0&property_rating_min=property_rating_min%3D2.5&supply_source=supply_source%3Dvrbo" \
// -H "Accept: application/json" \
// -H "Accept: application/json" \
// -H "Accept-Encoding: gzip" \
// -H "User-Agent: TravelNow/3.30.112" \
