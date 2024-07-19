<?php

    require '../config/db_connect.php';

    session_start();

    $errorMessage = '';
    $errors = array(
        'username' => '',
        'email' => '',
        'mobile' => ''
    );

    if (isset($_POST['heart'])) {

        $select_query = "SELECT * FROM likes WHERE pokemon_id = '{$_POST['pokemonID']}' AND user_id = '{$_SESSION['userID']}'";
        
        $insert_query = "INSERT INTO likes (pokemon_id, user_id)
        VALUES ({$_POST['pokemonID']}, {$_SESSION['userID']})";

        $delete_query = "DELETE FROM likes WHERE pokemon_id = '{$_POST['pokemonID']}' AND user_id = '{$_SESSION['userID']}'";

        if (!mysqli_query($conn, $select_query)) {
            die('Query error: ' . mysqli_error($conn));
        } else {
            // Make Query & Get Result
            $result = mysqli_query($conn, $select_query);

            // Fetch the Resulting Rows as an Array
            $user = mysqli_fetch_all($result, MYSQLI_ASSOC);

            // Free results From Memory
            mysqli_free_result($result);

            // SQL Check
            if (!mysqli_query($conn, (count($user) == 0) ? $insert_query : $delete_query)) {
                die('Query error: ' . mysqli_error($conn));
            } else {
                
                // Close Connection
                mysqli_close($conn);
                
                ($_SESSION['page'] == 'Pokedopt') ? header('Refresh: 0; URL=../pages/pokedopt.php') : header('Refresh: 0; URL=../pages/pokelist.php');
                exit;
    
            }
            
        }

    }

?>