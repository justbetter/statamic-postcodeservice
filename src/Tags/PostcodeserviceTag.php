<?php

namespace JustBetter\StatamicPostcodeservice\Tags;

use Statamic\Statamic;
use Statamic\Tags\Tags;

class PostcodeserviceTag extends Tags
{
    protected static $handle = 'postcodeservice';

    public function initPostcodeservice(): string
    {
        $formId = $this->params->get('formId');
        $form = Statamic::tag('form:' . $formId)->fetch();

        if (!$form) {
            return '';
        }

        $fields = $this->getPostcodeserviceFields($form);

        return view('justbetter-postcodeservice::tags.postcodeservice', ['postcodeserviceFields' => $fields]);
    }

    public function getPostcodeserviceFields(array $form): array
    {
        $postcodeserviceFields = [];

        if (!isset($form['fields']) || !$form['fields']) {
            return [];
        }

        foreach ($form['fields'] as $field) {
            if (!isset($field['input_type']) || !isset($field['handle']) || ($field['type'] ?? '') !== 'postcodeservice') {
                continue;
            }

            $postcodeserviceFields[$field['input_type']] = $field['handle'];
        }

        return $postcodeserviceFields;
    }
}
