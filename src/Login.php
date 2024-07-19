<?php

    namespace App;
    
    class Login {

        private $users = [
            'admin' => 'password'
        ];

        public function authenticate($username, $password) {
            if (isset($this->users[$username]) && $this->users[$username] === $password) {
                return 'Login successful';
            }
            return 'Login failed';
        }

    }

?>