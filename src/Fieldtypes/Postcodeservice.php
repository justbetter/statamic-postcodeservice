<?php

namespace JustBetter\StatamicPostcodeservice\Fieldtypes;


use Statamic\Fieldtypes\Text;

class Postcodeservice extends Text
{
    protected $postcodeserviceFieldTypes = [
        'postcodeservice_zipcode' => 'Postcodeservice Zipcode',
        'postcodeservice_house_number' => 'Postcodeservice House number',
        'postcodeservice_house_number_addition' => 'Postcodeservice House number addition',
        'postcodeservice_street' => 'Postcodeservice Street',
        'postcodeservice_city' => 'Postcodeservice City'
    ];

    protected $postcodeserviceDefaultFieldType = 'postcodeservice_zipcode';

    protected function configFieldItems(): array
    {
        $config = parent::configFieldItems();

        $config[] = [
            'display' => __('Postcodeservice type'),
            'fields' => [
                'postcodeservice_type' => [
                    'display' => __('Field type'),
                    'instructions' => __('Select the Postcodeservice field type'),
                    'type' => 'select',
                    'default' => $this->postcodeserviceDefaultFieldType,
                    'width' => 50,
                    'options' => $this->postcodeserviceFieldTypes
                ]
            ]
        ];

        return $config;
    }
}
