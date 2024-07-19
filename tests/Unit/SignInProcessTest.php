<?php

use PHPUnit\Framework\TestCase;

class SignInProcessTest extends TestCase
{
    protected function setUp(): void
    {
        // Start the session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        // Clear session
        $_SESSION = [];
    }

    public function testSignInSuccess()
    {
        // Simulate form submission
        $_POST['signIn'] = true;
        $_POST['email'] = 'ashie.loche@pokedopt.com';
        $_POST['password'] = 'ThisIsMyPokedoptYIPPIE!!!<3';
        $_POST['remember'] = false;

        $host = 'localhost';
        $user = 'root';
        $password = '';
        $db_name = 'pokedopt';

        // Connect to Database
        $conn = mysqli_connect($host, $user, $password, $db_name);

        // Check Connection
        if (!$conn) {
            die('Connection failed: ' . $conn->connect_error);
        }

        $email = mysqli_real_escape_string($conn, $_POST['email']);

        // Select user data
        $query = "SELECT * FROM account WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        mysqli_close($conn);

        if ($user) {
            if (password_verify($_POST['password'], $user['password'])) {
                $_SESSION['userID'] = $user['id'];
            }
        }

        // Assert session has been set correctly
        $this->assertEquals(2, $_SESSION['userID']);
    }

    protected function tearDown(): void
    {
        // Clear session
        $_SESSION = [];
        session_destroy();
    }
}
?>
