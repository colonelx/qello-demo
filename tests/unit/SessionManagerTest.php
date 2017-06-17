<?php


class SessionManagerTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected $sessionManager;

    protected function _before()
    {
        session_start();
        $this->sessionManager = new \QKidsDemo\Library\SessionManager();
    }

    protected function _after()
    {
        session_destroy();
    }

    // tests
    public function testSetSession()
    {
        $this->sessionManager->set('test', 'value');
        $this->assertEquals('value', $_SESSION['test']);
    }

    public function testGetSession()
    {

        $this->sessionManager->set('test', 'value');
        $value = $this->sessionManager->get('test');
        $this->assertEquals('value', $value);
    }
}