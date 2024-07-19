<?php

    use PHPUnit\Framework\TestCase;

    class SignInProcessTest extends TestCase {
        
        public function testSignInSuccess()
        {
            // Simulate form submission
            $_POST['signIn'] = true;
            $_POST['email'] = 'ashie.loche@pokedopt.com';
            $_POST['password'] = 'ThisIsMyPokedoptYIPPIE!!!<3';
            $_POST['remember'] = false;
    
            // Include the script to process the form
            include '../../src/processes/signInProcess.php';
    
            // Assert session has been set correctly
            $this->assertEquals(1, $_SESSION['userID']);
        }

    }

?>