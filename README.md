# Statamic Postcodeservice

> This addon adds Postcodeservice field types to the Form Builder.

## Installation

``` bash
composer require justbetter/statamic-postcodeservice
```

## Configuration

Add the following items to your .env, these settings consist of the Client ID and the Secure Code provided by Postcodeservice.

``` dotenv
POSTCODESERVICE_CLIENT_ID=""
POSTCODESERVICE_SECURE_CODE=""
```

## How to Use

### Form settings

When building a form it's now possible to make use of the Postcodeservice fields.
When selecting the Postcodeservice field you need to select the according field type, these consist of:

- Zipcode (Required)
- House number (Required)
- House number addition (Optional)
- Street (Required)
- City (Required)


Make sure to add all the required field types to your form as they are needed for this to work.

### Tags

To add this functionality to your form you have to use our Postcodeservice tag.
At the bottom of your form view you need to add the following tag:

#### Antlers
``` php
{{ postcodeservice:initPostcodeservice :formId="form_handle" }}
```
#### Blade
``` php
{!! Statamic::tag('postcodeservice:initPostcodeservice')->param('formId', $form->handle)->fetch() !!}
```

Make sure you're using the correct variable when passing the formId, this variable should be the handle of your form. i.e 'contact'.
