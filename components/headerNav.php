<?php

    require '../config/db_connect.php';

    {
        // Select Pokemon Data
        $query = "SELECT type FROM type";

        // SQL Check
        if (!mysqli_query($conn, $query)) {
            die('Query error: ' . mysqli_error($conn));
        } else {
            // Make Query & Get Result
            $result = mysqli_query($conn, $query);

            // Fetch the Resulting Rows as an Array
            $types = mysqli_fetch_all($result, MYSQLI_ASSOC);

            // Free results From Memory
            mysqli_free_result($result);

        }
    }

    {
        
        $query = "SELECT species FROM species";
        
        if (!mysqli_query($conn, $query)) {
            die('Query error: ' . mysqli_error($conn));
        } else {
            // Make Query & Get Result
            $result = mysqli_query($conn, $query);

            // Fetch the Resulting Rows as an Array
            $species = mysqli_fetch_all($result, MYSQLI_ASSOC);

            // Free results From Memory
            mysqli_free_result($result);

            mysqli_close($conn);
            
        }

    }


?>

    <head>
        <!-- Meta -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Meta -->
        
        <!-- Bootstrap CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <!-- Bootstrap CDN -->
        
        <!-- Bootstrap Icon CDN -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <!-- Bootstrap Icon CDN -->
        
        <!-- Website Header -->
        <link rel="icon" type="image/x-icon" href="../assets/img/icons/favicon.ico">
        <title>PokéDopt</title>
        <!-- Website Header -->
        
        <!-- External CSS -->
        <link rel="stylesheet" href="../styles/components.css">
        <!-- External CSS -->

    </head>

    <body class="bg-secondary">
        
        <!-- Page Container -->
        <div class="container-fluid">

            <!-- Page Row -->
            <div class="row">

                <!-- Primary Section -->
                <section class="primary col-md-10 order-md-2 p-0">

                    <!-- Header Nav -->
                    <nav class="navbar navbar-collapse navbar-dark bg-dark p-2 pt-4 border-bottom" id="header-nav">
                        
                        <!-- Header Nav Container -->
                        <div class="container-xxl p-0">
                            
                            <!-- Header Nav Row -->
                            <div class="row col-12 m-0">

                                <!-- Header Nav Action Buttons (Search, Filter) -->
                                <section class="col-6 col-md-4 order-2 order-md-1 d-flex justify-content-start align-items-center gap-2 gap-md-3 p-2 ps-md-3" id="searchFilterSection">

                                    <button onclick="location.href='../pages/profile.php'" class="navbar-toggler btn btn-outline-light border-0 p-2 d-none" id="profileBack">
                                        <i class="bi bi-arrow-left-circle fs-2"></i>
                                    </button>
                                    
                                    <button onclick="location.href='../pages/pokelist.php'" class="navbar-toggler btn btn-outline-light border-0 p-2 d-none" id="pokelistBack">
                                        <i class="bi bi-arrow-left-circle fs-2"></i>
                                    </button>
                                    
                                    <!-- Header Nav Search Button -->
                                    <button id="search_toggler" class="navbar-toggler btn btn-outline-light border-0 p-2" type="button" data-bs-toggle="collapse" data-bs-target="#search" aria-controls="search" aria-expanded="false" aria-label="Toggle Search Bar">

                                        <!-- Header Nav Search Icon -->
                                        <i class="bi bi-search fs-2" id="search-icon"></i>
                                        <!-- Header Nav Search Icon -->

                                    </button>
                                    <!-- Header Nav Search Button -->

                                    <!-- Header Nav Filter Button -->
                                    <button id="filters_toggler" class="navbar-toggler btn btn-outline-light border-0 p-2" type="button" data-bs-toggle="collapse" data-bs-target="#filters" aria-controls="filters" aria-expanded="false" aria-label="Toggle Filters">

                                        <!-- Header Nav Filter Icon -->
                                        <i class="bi bi-funnel-fill fs-2"></i>
                                        <!-- Header Nav Filter Icon -->

                                    </button>
                                    <!-- Header Nav Filter Button -->
                                    
                                </section>
                                <!-- Header Nav Action Buttons (Search, Filter) -->

                                <!-- Header Nav Logo -->
                                <section class="col-md-4 order-1 order-md-2 d-flex justify-content-center align-items-center" id="logoSection">

                                    <!-- Header Nav Logo Link -->
                                    <button onclick="location.href='../pages/pokedopt.php'" class="navbar-brand btn btn-outline-light border-0 m-0 p-2 d-flex gap-2" id="header-nav-logo-link">

                                        <!-- Header Nav Logo Icon -->
                                        <img src="../assets/img/icons/pokedopt.ico" alt="PokéDopt Icon" class="img" id="header-nav-logo-icon">
                                        <!-- Header Nav Logo Icon -->

                                        <!-- Header Nav Logo Title -->
                                        <span class="h1 fs-bold m-0 fs-2 lh-1">
                                            PokéDopt
                                        </span>
                                        <!-- Header Nav Logo Title -->
                                        
                                    </button>
                                    <!-- Header Nav Logo Link -->

                                </section>
                                <!-- Header Nav Logo -->
                                
                                <!-- Header Nav Action Buttons (Notif, PokéList, Sign In, Sign Up) -->
                                <section class="col-6 col-md-4 order-3 d-flex justify-content-end align-itmes-center gap-2 gap-md-3 p-2 pe-md-3" id="actionBtns">

                                    <!-- Header Nav Notif Button -->
                                    <button class="navbar-toggler btn btn-outline-light border-0 p-2" id="notif" disabled>

                                        <!-- Header Notif Button Icon -->
                                        <i class="bi bi-bell-fill fs-2"></i>
                                        <!-- Header Notif Button Icon -->

                                    </button>
                                    <!-- Header Nav Notif Button -->
                                    
                                    <!-- Header Nav PokéList Button -->
                                    <button onclick="location.href='../pages/pokelist.php'" class="navbar-toggler btn btn-outline-light p-2 d-none" id="pokelist_btn">
                                        
                                        <!-- Header Nav PokéList Title -->
                                        <span class="fw-bold fs-4" id="pokelist">
                                            PokéList
                                        </span>
                                        <!-- Header Nav PokéList Title -->
                                    
                                    </button>
                                    <!-- Header Nav PokéList Button -->

                                    
                                    <button onclick="location.href='../pages/book.php'" class="navbar-toggler btn btn-outline-light p-2 d-none" id="book_btn">
                                        
                                        <!-- Header Nav PokéList Title -->
                                        <span class="fw-bold fs-4" id="book">
                                            Schedule a Playdate
                                        </span>
                                        <!-- Header Nav PokéList Title -->
                                    
                                    </button>

                                    <form action="../components/logout.php" method="POST" class="p-0 m-0 d-flex align-items-center d-none" id="logout_form">
                                        
                                        <!-- Header Nav PokéList Button -->
                                        <button class="navbar-toggler btn btn-outline-light p-2" tpye="submit" id="logout_btn" name="logout" value="logout" form="logout_form">
                                        
                                            <!-- Header Nav PokéList Title -->
                                            <span class="fw-bold fs-4" id="logout">
                                                Logout
                                            </span>
                                            <!-- Header Nav PokéList Title -->
                                        
                                        </button>
                                        <!-- Header Nav PokéList Button -->

                                    </form>

                                    <!-- Header Nav Sign Up Button -->
                                    <button class="navbar-toggler btn btn-outline-light p-2 d-none d-xl-block" id="signUp_btn" data-bs-toggle="modal" data-bs-target="#sign_up_modal">

                                        <!-- Header Nav Sign Up Title -->
                                        <span class="fw-bold fs-4">
                                            Sign Up
                                        </span>
                                        <!-- Header Nav Sign Up Title -->

                                    </button>
                                    <!-- Header Nav Sign Up Button -->

                                    <!-- Header Nav Sign In Button -->
                                    <button class="navbar-toggler btn btn-outline-light p-2" id="signIn_btn" data-bs-toggle="modal" data-bs-target="#sign_in_modal" autofocus>

                                        <!-- Header Nav Sign In Title -->
                                        <span class="fw-bold fs-4">
                                            Sign In
                                        </span>
                                        <!-- Header Nav Sign In Title -->

                                    </button>
                                    <!-- Header Nav Sign In Button -->

                                </section>
                                <!-- Header Nav Action Buttons (Notif, PokéList, Sign In, Sign Up) -->

                                <!-- Header Nav Search Bar & Filters -->
                                <section class="collapse navbar-collapse col-12 order-4 mt-3 mb-3" id="search">
                                    
                                    <!-- Header Nav Search Bar -->
                                    <input type="text" class="form-control nav-item bg-transparent text-light fs-4" id="search_bar" placeholder="Search..." aria-label="Search Bar">
                                    <!-- Header Nav Search Bar -->

                                </section>
                                <!-- Header Nav Search Bar & Filters -->

                                <!-- Header Nav Search Bar & Filters -->
                                <section class="collapse navbar-collapse col-12 order-4 mb-3 text-light" id="filters">

                                    <section class="border rounded">
                                        
                                        <h3 class="text-center p-3 border-bottom">Filters</h3>
                                        
                                        <section class="d-flex flex-column gap-3 m-3">
                                            
                                            <fieldset id="typesSelect" class="border rounded p-3">
                                                
                                                <legend class="fw-bold pb-2 border-bottom text-center">Types</legend>
                                                
                                                <section class="p-2 d-flex flex-wrap justify-content-center gap-2">

                                                    <?php foreach ($types as $type) { ?>
                                                        
                                                        <?php if (ucfirst(strtolower($type['type'])) != "Null"): ?>
                                                            <button class="btn btn-outline-light type" value="<?php echo ucfirst(strtolower($type['type'])); ?>">
                                                                <span class="fw-bold fs-5">
                                                                    <?php echo ucfirst(strtolower($type['type'])); ?>
                                                                </span>
                                                            </button>
                                                        <?php endif ?>
                                                    <?php } ?>
                                                    
                                                </section>
        
                                            </fieldset>

                                            <fieldset id="speciesSelect" class="border rounded p-3">
                                                
                                                <legend class="fw-bold pb-2 border-bottom text-center">Species</legend>

                                                <section class="p-2 d-flex flex-wrap justify-content-center gap-2">
                                                    <?php foreach ($species as $speciesSingular) { ?>
                                                        <button class="btn btn-outline-light species" value="<?php echo $speciesSingular['species']; ?>">
                                                            <span class="fw-bold fs-5">
                                                                <?php echo $speciesSingular['species']; ?>
                                                            </span>
                                                        </button>
                                                    <?php } ?>

                                                </section>
                                            
                                            </fieldset>

                                        </section>

                                    </section>

                                </section>
                                <!-- Header Nav Search Bar & Filters -->

                            </div>
                            <!-- Header Nav Row -->

                        </div>
                        <!-- Header Nav Container -->

                    </nav>
                    <!-- Header Nav -->

<script>
    if (<?php echo isset($_SESSION['userID']) ? 'true' : 'false'; ?>) {
        document.getElementById("signUp_btn").classList.remove('d-xl-block');
        document.getElementById("signIn_btn").classList.add('d-none');

        if (<?php echo $_SESSION['page'] == 'Profile' ? 'true' : 'false'; ?>) {
            document.getElementById("pokelist_btn").classList.add('d-none');
            document.getElementById("logout_form").classList.remove('d-none');
            document.getElementById("search_toggler").classList.add('d-none');
            document.getElementById("filters_toggler").classList.add('d-none');
        } else if (<?php echo $_SESSION['page'] == 'EditProfile' ? 'true' : 'false'; ?>) {
            document.getElementById("profileBack").classList.remove('d-none');
            document.getElementById("search_toggler").classList.add('d-none');
            document.getElementById("filters_toggler").classList.add('d-none');
            document.getElementById("notif").classList.add('d-none');
        } else if (<?php echo $_SESSION['page'] == 'Pokelist' ? 'true' : 'false'; ?>) {
            document.getElementById("book_btn").classList.remove('d-none');
            document.getElementById("search_toggler").classList.add('d-none');
            document.getElementById("filters_toggler").classList.add('d-none');
        } else if (<?php echo $_SESSION['page'] == 'Book' ? 'true' : 'false'; ?>) {
            document.getElementById("pokelistBack").classList.remove('d-none');
            document.getElementById("search_toggler").classList.add('d-none');
            document.getElementById("filters_toggler").classList.add('d-none');
            document.getElementById("notif").classList.add('d-none');
        } else if (<?php echo $_SESSION['page'] == 'About_Us' || $_SESSION['page'] == 'Customer_Care' ? 'true' : 'false'; ?>) {
            document.getElementById("search_toggler").classList.add('d-none');
            document.getElementById("filters_toggler").classList.add('d-none');
            document.getElementById("notif").classList.add('d-none');
            document.getElementById("pokelist_btn").classList.add('d-none');
        } else {
            document.getElementById("book_btn").classList.add('d-none');
            document.getElementById("pokelist_btn").classList.remove('d-none');
            document.getElementById("logout_form").classList.add('d-none');
            document.getElementById("profileBack").classList.add('d-none');
            document.getElementById("pokelistBack").classList.add('d-none');
            document.getElementById("search_toggler").classList.remove('d-none');
            document.getElementById("filters_toggler").classList.remove('d-none');
            document.getElementById("notif").classList.remove('d-none');
        }
    } else {
        document.getElementById("pokelist_btn").classList.add('d-none');
        document.getElementById("logout_form").classList.add('d-none');
        document.getElementById("signUp_btn").classList.add('d-xl-block');
        document.getElementById("signIn_btn").classList.remove('d-none');
        document.getElementById("search_toggler").classList.add('d-none');
        document.getElementById("filters_toggler").classList.add('d-none');
        document.getElementById("notif").classList.add('d-none');
    } 

</script>  