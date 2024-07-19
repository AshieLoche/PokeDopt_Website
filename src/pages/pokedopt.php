<?php

    require '../config/db_connect.php';

    session_start();

    $_SESSION['page'] = 'Pokedopt';

    if (isset($_COOKIE['userID'])) {
        $_SESSION['userID'] = $_COOKIE['userID'];
    }

    if (!isset($_SESSION['userID'])) {
        header('Location: ../pages/guest.php');
        exit;
    }

    // Pokemon Table
    {

        // Select Pokemon Data
        $query = 
        "SELECT
            pokemon.id,
            pokemon.name,
            species.species,
            pokemon.description,
            pokemon.img,
            type1.type as type1,
            type2.type as type2,
            pokemon.adoption_time
        FROM
            pokedopt.pokemon as pokemon,
            pokedopt.species as species,
            pokedopt.type as type1,
            pokedopt.type as type2
        WHERE
            pokemon.species_id = species.id AND
            species.type1_id = type1.id AND
            species.type2_id = type2.id";

        // SQL Check
        if (!mysqli_query($conn, $query)) {
            die('Query error: ' . mysqli_error($conn));
        } else {
            // Make Query & Get Result
            $result = mysqli_query($conn, $query);

            // Fetch the Resulting Rows as an Array
            $pokemons = mysqli_fetch_all($result, MYSQLI_ASSOC);

        }

    }

    {
        
        $query = "SELECT * FROM likes WHERE user_id = {$_SESSION['userID']}";
        
        if (!mysqli_query($conn, $query)) {
            die('Query error: ' . mysqli_error($conn));
        } else {
            // Make Query & Get Result
            $result = mysqli_query($conn, $query);

            // Fetch the Resulting Rows as an Array
            $likes = mysqli_fetch_all($result, MYSQLI_ASSOC);

            // Free results From Memory
            mysqli_free_result($result);
            
        }

    }

    // FOR FUTURE ADMIN
    // {
    //     $query = 
    //     "SELECT 
    //         role.role 
    //     FROM 
    //         account as account, 
    //         role as role 
    //     WHERE
    //         account.role_id = role.id AND
    //         role.id = {$_SESSION['userID']}";
        
    //     if (!mysqli_query($conn, $query)) {
    //         die('Query error: ' . mysqli_error($conn));
    //     } else {
    //         // Make Query & Get Result
    //         $result = mysqli_query($conn, $query);

    //         // Fetch the Resulting Rows as an Array
    //         $likes = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //         // Free results From Memory
    //         mysqli_free_result($result);

    //         mysqli_close($conn);
            
    //     }

    // }

?>

<!DOCTYPE html>
<html lang="en">
                    
                    <!-- Header Nav -->
                    <?php require '../components/headerNav.php' ?>
                    <!-- Header Nav -->

                    <!-- Main -->
                    <main id="main-content" class="bg-secondary">

                        <!-- Main Container -->
                        <div class="container-fluid">
                            
                            <!-- Main Row -->
                            <div class="row gap-5 p-4 py-sm-5 justify-content-center">
                                
                                <!-- FOR FUTURE ADMIN -->
                                <!-- <article class="card pokeCard bg-dark text-light border-dark rounded-5 col-sm-10 col-md-8 col-lg-6 col-xl-4 col-xxl-3 p-0 pokemon_card">
                    
                                    <img src="../assets/img/others/banner.jpg" class="card-img-top img rounded-top-5 border-bottom">

                                    <section class="card-body pt-3 px-4 pb-5">
                                        
                                        <div class="border-bottom pb-2 p-0 mb-3 container fluid">

                                            <div class="d-flex justify-content-between p-0">

                                                <p class="card-header display-3 col-10 col-lg-9 pokemon_name fw-bolder ps-0">
                                                    Add Name
                                                </p>

                                                <span class="col-2 col-lg-3 d-flex justify-content-end align-items-center p-0">
                                                
                                                    <button class="btn btn-outline-light border-0 p-0 px-2"  data-bs-toggle="modal"  data-bs-target="#AddModal">
                                                        <i class="card-header p-0 display-3 border-0 bi bi-plus-circle"></i>
                                                    </button>
                                                </span>

                                            </div>

                                        </div>
                                        
                                        <section class="card-title display-4 fs-2">
                                            <span class="fs-1 fw-bold species">
                                              Add Species
                                            </span>
                                            <span class="display-5 fs-2 types">
                                              - Add Type/s
                                            </span>
                                        </section>
                                        
                                        <section class="card-text display-5 fs-4 lh-sm">
                                            Add Description
                                        </section>

                                    </section>

                                </article> -->

                                <?php foreach ($pokemons as $pokemon) { ?>

                                    <?php if (is_null($pokemon['adoption_time'])): ?>

                                        <!-- Pokémon Card -->
                                        <article class="card pokeCard bg-dark text-light border-dark rounded-5 col-sm-10 col-md-8 col-lg-6 col-xl-4 col-xxl-3 p-0 pokemon_card">
                                            
                                            <!-- Pokémon Card Image -->
                                            <img src="<?php echo $pokemon['img']; ?>" alt="<?php echo $pokemon['name']; ?>" class="card-img-top img rounded-top-5 border-bottom">
                                            <!-- Pokémon Card Image -->

                                            <!-- Pokémon Card Body -->
                                            <section class="card-body pt-3 px-4 pb-5">
                                                
                                                <!-- Pokémon Card Header Container -->
                                                <div class="border-bottom mb-2 container-fluid">

                                                    <!-- Pokémon Card Header Row -->
                                                    <div class="row">

                                                        <!-- Pokémon Card Header -->
                                                        <p class="card-header fs-1 col-10 col-lg-9 p-0 text-decoration-none border-0 pokemon_name fw-bolder">
                                                            <?php echo $pokemon['name']; ?>
                                                        </p>
                                                        <!-- Pokémon Card Header -->

                                                        <!-- Pokémon Card Heart Button Span -->
                                                        <span class="col-2 col-lg-3 d-flex justify-content-end align-items-center p-0">
                                                        
                                                            <form action="../processes/likeProcess.php" method="POST">
                                                                
                                                                <input type="hidden" name="pokemonID" value="<?php echo $pokemon['id']; ?>">

                                                                <!-- Pokémon Card Heart Button -->
                                                                <button class="btn btn-outline-light border-0 p-0 px-2 heart" type="submit" name="heart" value="heart">
    
                                                                    <!-- Pokémon Card Heart Button Icon -->
                                                                    <i class="card-header p-0 bi 
                                                                    <?php 
                                                                        $likeList = [];
                                                                        foreach ($likes as $like) {
                                                                            if ($like['pokemon_id'] == $pokemon['id']) {
                                                                                array_push($likeList, $like['pokemon_id']);
                                                                                break;
                                                                            }
                                                                        }

                                                                        if (in_array($pokemon['id'], $likeList)) {
                                                                            echo 'bi-suit-heart-fill';
                                                                        } else {
                                                                            echo 'bi-suit-heart';
                                                                        }
                                                                    ?>
                                                                     fs-1 m-0 border-0"></i>
                                                                    <!-- Pokémon Card Heart Button Icon -->
                                                                    
                                                                </button>
                                                                <!-- Pokémon Card Heart Button -->

                                                            </form>

                                                        </span>
                                                        <!-- Pokémon Card Heart Button Span -->

                                                    </div>
                                                    <!-- Pokémon Card Header Row -->

                                                </div>
                                                <!-- Pokémon Card Header Container -->
                                                
                                                <!-- Pokémon Card Title -->
                                                <section class="card-title p-0">
                                                    <span class="fw-bold fs-4 species">
                                                      <?php echo $pokemon['species']; ?>
                                                    </span>
                                                    <span class="types fs-5">
                                                      - <?php echo $pokemon['type1'];?>/<?php echo $pokemon['type2']; ?>
                                                    </span>
                                                </section>
                                                <!-- Pokémon Card Title -->
                                                
                                                <!-- Pokémon Card Description -->
                                                <section class="card-text">
                                                    <p class="fs-5">
                                                    <?php echo $pokemon['description']; ?>
                                                    </p>
                                                </section>
                                                <!-- Pokémon Card Description -->

                                            </section>
                                            <!-- Pokémon Card Body -->

                                        </article>
                                        <!-- Pokémon Card -->

                                    <?php endif ?>

                                <?php } ?>

                            </div>
                            <!-- Main Row -->

                        </div>
                        <!-- Main Container -->

                    </main>
                    <!-- Main -->

                    <!-- Footer -->
                    <?php require '../components/footer.php' ?>
                    <!-- Footer -->

                </section>
                <!-- Primary Section -->
                
                <!-- Side Nav -->
                <?php require '../components/sideNav.php' ?>
                <!-- Side Nav -->
                
                <!-- Sign In Modal -->
                <?php require '../components/signIn.php' ?>
                <!-- Sign In Modal -->

                <!-- Sign Up Modal -->
                <?php require '../components/signUp.php' ?>
                <!-- Sign Up Modal -->


                <!-- FOR FUTURE ADMIN -->
                <!-- <article class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">

                  <section class="modal-dialog d-flex justify-content-center align-items-center m-0">
                    
                    <section class="modal-content bg-secondary">
                      
                      <section class="modal-header bg-dark text-light">
                        
                        <p class="card-header display-3 fw-bolder border-0">
                          PokéList
                        </p>
                        
                        
                        <button class="btn-close bg-light me-1" type="button" data-bs-dismiss="modal" aria-labelledby="Close"></button>
                        
                      </section>
                      

                      <form action="../processes/add.php" method="POST" class="p-0"enctype="multipart/form-data" id="editProfile_Form">

                        <section class="modal-body fw-bold p-0">
                            
                            <label for="addPokeImgFile" style="cursor: pointer;" class="text-center">
                                <img src="../assets/img/others/banner.jpg" alt="" id="addPokeImg" class="card-img-top border-bottom pfp bg-dark">

                                <p class="bg-dark text-light fs-3 border-3 border-dark m-0">
                                    + Add Image
                                </p>
        
                                <input type="file" name="pokeImgFile" id="addPokeImgFile" class="d-none">
                            </label>

                            <input class="col-12 btn btn-dark border-top" id="pokeImgClear" type="button" value="Clear" style="border-radius: 0;">

                        </section>
                        
                        <section class="modal-footer bg-dark d-flex flex-column align-items-start">
                            
                            <section class="col-12 d-flex card-title text-light flex-row justify-content-between p-3 ps-2 border-bottom border-light">
                                <input type="text" class="form-control addControl bg-secondary text-black border-secondary display-3 fw-bolder" id="addName" placeholder="+Add Name" name="addName" autocomplete="off" required>
                                
                                <span class="col-6 d-flex justify-content-end align-items-center p-0">
                                    <button class="btn btn-outline-light border-0 p-0 px-2" type="submit">
                                        <i class="card-header p-0 display-3 border-0 bi bi-plus-circle"></i>
                                    </button>
                                </span>
                            </section>
                            <section class="p-2 d-flex align-items-center gap-2">
                                <input type="text" class="form-control addControl bg-secondary text-black border-secondary fw-bold " id="addSpecies" placeholder="+Add Species" name="addSpecies" autocomplete="off" required>
                                -
                                <input type="text" class="form-control addControl bg-secondary text-black border-secondary" id="addTypes" placeholder="+Add Types" name="addTypes" autocomplete="off" required>
                            </section>

                            <section class="text-light display-5 fs-4 lh-sm p-3 pt-0 m-0">
                                <textarea name="addDescription" id="addDescription" cols="100" rows="5" class="form-control addControl bg-secondary text-black border-secondary" placeholder="+Add Description..."></textarea>
                            </section>
                                        
                        </section>
                      </form>
                      
                      
                    </section>
                              
                  </section>
                              
                </article> -->
            
</html>