<?php

class igsd_CharField
{
    public function __construct($maxLength)
    {
        $this->maxLength = (int)$maxLength;
    }

    public function validate($value)
    {
        $value = $this->stringFactory->makeString($value);
    }
}

class igsd_EmailField
{
    public function __construct($maxLength)
    {
        $this->validator = igds_EmailValidator()->and->igsd_LengthValidator();
    }

    public function validate($value)
    {
        return $this->validator->validates($value);
    }
}

class UserRegistrationForm extends igs_Form
{
    public function __construct()
    {
        parent::__construct();
    }

    public function validate($values)
    {

    }

    public function render()
    {
        $this->username = $this->charField($maxLength = 64);
        $this->email = $this->emailField($maxLength = 64);
        $this->answer = $this->choiceField($choices = array(
            'a', 'b', 'c',
        ));
    }
}
