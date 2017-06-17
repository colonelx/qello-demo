<?php

namespace QKidsDemo\Validation;

use Respect\Validation\Exceptions\NestedValidationException;
use \Respect\Validation\Validator as V;

class UserRegistrationValidator
{
    protected $rules = [];
    protected $messages = [];
    protected $errors = [];

    public function __construct()
    {
        $this->initRules();
        $this->initMessages();
    }

    public function initRules()
    {
        $this->rules['email'] = V::email();
        $this->rules['password'] = V::alnum()->noWhitespace()->length(4, 20)->setName('Password');
        $this->rules['first_name'] = V::alpha()->noWhitespace()->length(4, 20)->setName('First name');
        $this->rules['last_name'] = V::alpha()->noWhitespace()->length(4, 20)->setName('Last name');
    }

    public function initMessages()
    {
        $this->messages = [
            'alpha'                 => '{{name}} must only contain alphabetic characters.',
            'alnum'                 => '{{name}} must only contain alpha numeric characters and dashes.',
            'noWhitespace'          => '{{name}} must not contain white spaces.',
            'length'                => '{{name}} must length between {{minValue}} and {{maxValue}}.',
            'email'                 => 'Please make sure you typed a correct email address.'
        ];
    }

    public function assert(array $inputs)
    {
        foreach ($this->rules as $rule => $validator) {
            try {
                $validator->assert($inputs[$rule]);
            } catch (NestedValidationException $ex) {
                $this->errors = $ex->findMessages($this->messages);
                return false;
            }
        }

       return true;
    }

    public function addApiError($error)
    {
        $this->errors['api'] = $error;
    }

    public function errors()
    {
        $errors = [];
        foreach($this->errors as $type => $error) {
            if (!empty($error)) {
                $errors[] = $error;
            }
        }
        return $errors;
    }
}