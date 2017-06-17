<?php


class UserRegistrationValidatorTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    protected $validator;

    protected function _before()
    {
        $this->validator = new \QKidsDemo\Validation\UserRegistrationValidator();
    }

    protected function _after()
    {
    }

    // tests
    public function testUserRegistrationValidData()
    {
        $inputs = $this->getInputs('test@example.com', 'password', 'First', 'Last');

        $isValid = $this->validator->assert($inputs);

        $this->assertTrue($isValid);
    }

    public function testUserRegistrationInvalidEmail()
    {
        $inputs = $this->getInputs('not.an.email', 'password', 'First', 'Last');

        $isValid = $this->validator->assert($inputs);
        $errors = $this->validator->errors();

        $this->assertFalse($isValid);
        $this->assertEquals(1, sizeof($errors));
    }

    public function testUserRegistationShortPassword()
    {
        $inputs = $this->getInputs('test@example.com', '123', 'First', 'Last');

        $isValid = $this->validator->assert($inputs);
        $errors = $this->validator->errors();

        $this->assertFalse($isValid);
        $this->assertEquals(1, sizeof($errors));
    }

    public function testUserRegistationLongPassword()
    {
        $inputs = $this->getInputs('test@example.com', '12345678901234567890123', 'First', 'Last');

        $isValid = $this->validator->assert($inputs);
        $errors = $this->validator->errors();

        $this->assertFalse($isValid);
        $this->assertEquals(1, sizeof($errors));
    }

    public function testUserRegistationPasswordSpecialChars()
    {
        $inputs = $this->getInputs('test@example.com', 'pass$$w0rd', 'First', 'Last');

        $isValid = $this->validator->assert($inputs);
        $errors = $this->validator->errors();

        $this->assertFalse($isValid);
        $this->assertEquals(1, sizeof($errors));
    }

    public function testUserRegistrationFirstNameWhiteSpace()
    {
        $inputs = $this->getInputs('test@example.com', 'password', 'Fi rt', 'Last');

        $isValid = $this->validator->assert($inputs);
        $errors = $this->validator->errors();

        $this->assertFalse($isValid);
        $this->assertEquals(1, sizeof($errors));
    }

    public function testUserRegistrationFirstNameInvalidSymbols()
    {
        $inputs = $this->getInputs('test@example.com', 'password', 'Fi#rt', 'Last');

        $isValid = $this->validator->assert($inputs);
        $errors = $this->validator->errors();

        $this->assertFalse($isValid);
        $this->assertEquals(1, sizeof($errors));
    }

    public function testUserRegistrationFirstNameShort()
    {
        $inputs = $this->getInputs('test@example.com', 'password', 'Fi', 'Last');

        $isValid = $this->validator->assert($inputs);
        $errors = $this->validator->errors();

        $this->assertFalse($isValid);
        $this->assertEquals(1, sizeof($errors));
    }

    public function testUserRegistrationFirstNameLong()
    {
        $inputs = $this->getInputs('test@example.com', 'password', 'Abcdefghijklmnopqrstuvwxyz', 'Last');

        $isValid = $this->validator->assert($inputs);
        $errors = $this->validator->errors();

        $this->assertFalse($isValid);
        $this->assertEquals(1, sizeof($errors));
    }

    public function testUserRegistrationLastNameWhiteSpace()
    {
        $inputs = $this->getInputs('test@example.com', 'password', 'First', 'La st');

        $isValid = $this->validator->assert($inputs);
        $errors = $this->validator->errors();

        $this->assertFalse($isValid);
        $this->assertEquals(1, sizeof($errors));
    }

    public function testUserRegistrationLastNameInvalidSymbols()
    {
        $inputs = $this->getInputs('test@example.com', 'password', 'First', 'L@st');

        $isValid = $this->validator->assert($inputs);
        $errors = $this->validator->errors();

        $this->assertFalse($isValid);
        $this->assertEquals(1, sizeof($errors));
    }

    public function testUserRegistrationLastNameShort()
    {
        $inputs = $this->getInputs('test@example.com', 'password', 'First', 'Las');

        $isValid = $this->validator->assert($inputs);
        $errors = $this->validator->errors();

        $this->assertFalse($isValid);
        $this->assertEquals(1, sizeof($errors));
    }

    public function testUserRegistrationLastNameLong()
    {
        $inputs = $this->getInputs('test@example.com', 'password', 'First', 'Abcdefghijklmnopqrstuvwxyz');

        $isValid = $this->validator->assert($inputs);
        $errors = $this->validator->errors();

        $this->assertFalse($isValid);
        $this->assertEquals(1, sizeof($errors));
    }

    private function getInputs($email, $password, $firstName, $lastName)
    {
        return [
            'email' => $email,
            'password' => $password,
            'first_name' => $firstName,
            'last_name' => $lastName
        ];
    }
}