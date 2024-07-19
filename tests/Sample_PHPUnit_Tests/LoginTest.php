<?php

    use PHPUnit\Framework\TestCase;

    class LoginTest extends TestCase {

        public function testSuccessfulLogin() {

            $login = new App\Login;
            $result = $login->authenticate('admin', 'password');
            $this->assertEquals('Login successful', $result);

        }

        public function testFailedLoginWithWrongPassword() {

            $login = new App\Login;;
            $result = $login->authenticate('admin', 'wrongPassword');
            $this->assertEquals('Login failed', $result);

        }

        public function testFailedLoginWithWrongUsername() {

            $login = new App\Login;
            $result = $login->authenticate('wrongUser', 'password');
            $this->assertEquals('Login failed', $result);

        }

    }

?>