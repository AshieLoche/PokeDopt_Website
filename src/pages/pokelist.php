<?php

  require '../config/db_connect.php';
  
  session_start();
  
  $_SESSION['page'] = 'Pokelist';
  
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
      
      // Free results From Memory
      mysqli_free_result($result);
      
    }
    
  }
  
  {
    
    $select_query = "SELECT * FROM likes WHERE user_id = {$_SESSION['userID']}";
    
    if (!mysqli_query($conn, $select_query)) {
      die('Query error: ' . mysqli_error($conn));
    } else {
      // Make Query & Get Result
      $result = mysqli_query($conn, $select_query);
      
      // Fetch the Resulting Rows as an Array
      $likes = mysqli_fetch_all($result, MYSQLI_ASSOC);
      
      // Free results From Memory
      mysqli_free_result($result);
      
      mysqli_close($conn);
      
    }
    
  }

?>

<!DOCTYPE html>
<html lang="en">
                    
                    <!-- Header Nav -->
                    <?php require '../components/headerNav.php' ?>
                    <!-- Header Nav -->

                    <!-- Main -->
                    <main id="main-content">
                      
                      <!-- Main Container -->
                      <div class="container-xxl bg-secondary pokelistDiv">
                        
                        <!-- Main Row -->
                        <div class="row gap-5 p-4 py-sm-5 justify-content-center">
                          
                          <?php foreach ($pokemons as $pokemon) { ?>
                            
                            <?php 
                              $likeList = [];
                              foreach ($likes as $like) {
                                if ($like['pokemon_id'] == $pokemon['id']) {
                                  array_push($likeList, $like['pokemon_id']);
                                  break;
                                }
                              }
                            ?>
                            
                            <?php if (in_array($pokemon['id'], $likeList)): ?>
                              
                              <?php if (is_null($pokemon['adoption_time'])): ?>
                                    
                                <!-- PokéList Card -->
                                <article class="card pokelist_card bg-dark text-light border-dark rounded-5 d-flex flex-row p-0 col-10 col-sm-9" data-bs-toggle="modal" data-bs-target="#<?php echo $pokemon['name']; ?>Modal">
                                  
                                  <section class="col-0 col-sm-8 p-0 d-flex align-items-center gap-3 rounded-start-5">
                                    
                                    <img src="<?php echo $pokemon['img'] ?>" alt="<?php echo $pokemon['name'] ?>" class="card-img-top img rounded-start-5 border-end pokeImg">
                                    
                                    <p class="card-header display-3 border-0">
                                      <?php echo $pokemon['name']; ?>
                                    </p>
                                    
                                  </section>
                                  
                                  <form action="../components/likeProcess.php" method="POST" class="col-0 col-sm-4 rounded-end-5 d-flex justify-content-end align-items-center p-4">
                                    
                                    <input type="hidden" name="pokemonID" value="<?php echo $pokemon['id']; ?>">
                                    
                                    <!-- Pokémon Card Heart Button -->
                                    <button class="btn btn-outline-light border-0 p-0 px-2 heart" type="submit" name="heart" value="heart">
                                      
                                      <!-- Pokémon Card Heart Button Icon -->
                                      <i class="card-header p-0 bi 
                                        <?php 
                                          if (in_array($pokemon['id'], $likeList)) {
                                            echo 'bi-suit-heart-fill';
                                          } else {
                                            echo 'bi-suit-heart';
                                          }
                                        ?>
                                      display-3 border-0"></i>
                                      <!-- Pokémon Card Heart Button Icon -->
                                      
                                    </button>
                                    <!-- Pokémon Card Heart Button -->
                                    
                                  </form>
                                  
                                </article>
                                <!-- PokéList Card -->                 
                                
                                <!-- PokéList Modal -->
                                <article class="modal fade" id="<?php echo $pokemon['name'] ?>Modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
                                  
                                  <!-- Sign Up Modal Dialog -->
                                  <section class="modal-dialog d-flex justify-content-center align-items-center m-0">
                                    
                                    <!-- Sign Up Modal Content -->
                                    <section class="modal-content bg-secondary">
                                      
                                      <!-- Sign Up Modal Header -->
                                      <section class="modal-header bg-dark text-light">
                                        
                                        <p class="card-header display-3 fw-bolder border-0">
                                          PokéList
                                        </p>
                                        
                                        <!-- Sign Up Modal Header Close -->
                                        <button class="btn-close bg-light me-1" type="button" data-bs-dismiss="modal" aria-labelledby="Close"></button>
                                        <!-- Sign Up Modal Header Close -->
                                        
                                      </section>
                                      <!-- Sign Up Modal Header -->
                                      
                                      <!-- Sign Up Modal Body -->
                                      <section class="modal-body fw-bold p-0">

                                        <img src="<?php echo $pokemon['img']; ?>" alt="<?php echo $pokemon['name']; ?>" class="card-img-top border-bottom">

                                      </section>
                                      <!-- Sign Up Modal Body -->
                                      
                                      <!-- Sign Up Modal Footer -->
                                      <section class="modal-footer bg-dark d-flex justify-content-start">
                                        
                                        <section class="col-12 d-flex justify-content-between p-3 m-0 border-bottom border-light">
                                          <section class="card-title display-3 fw-bolder text-light">
                                            <?php echo $pokemon['name']; ?>
                                          </section>
                                          <form action="../components/likeProcess.php" method="POST" class="col-4 d-flex justify-content-end align-items-center">
                                            
                                            <input type="hidden" name="pokemonID" value="<?php echo $pokemon['id']; ?>">
                                            
                                            <!-- Pokémon Card Heart Button -->
                                            <button class="btn btn-outline-light border-0 p-0 px-2 heart" type="submit" name="heart" value="heart">
                                              
                                              <!-- Pokémon Card Heart Button Icon -->
                                              <i class="card-header p-0 bi 
                                              <?php 
                                                if (in_array($pokemon['id'], $likeList)) {
                                                  echo 'bi-suit-heart-fill';
                                                } else {
                                                  echo 'bi-suit-heart';
                                                }
                                                ?>
                                              display-3 border-0"></i>
                                              <!-- Pokémon Card Heart Button Icon -->
                                              
                                            </button>
                                            <!-- Pokémon Card Heart Button -->
                                              
                                          </form>
                                        </section>

                                        <section class="card-text text-light d-flex align-items-center p-2 gap-2">
                                            <span class="display-4 fs-1 fw-bold species">
                                              <?php echo $pokemon['species']; ?>
                                            </span>
                                            <span class="display-5 fs-2 types">
                                              - <?php echo $pokemon['type1'];?>/<?php echo $pokemon['type2']; ?>
                                            </span>
                                        </section>

                                        <section class="card-text text-light display-5 fs-4 lh-sm p-3 pt-0 m-0">
                                          <?php echo $pokemon['description']; ?>
                                        </section>
                                                      
                                      </section>
                                      
                                    </section>
                                              
                                  </section>
                                              
                                </article>
                                <!-- PokéList Modal -->

                              <?php endif; ?>
                                                
                            <?php endif; ?>

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
                  
                  <style>
                    #main-content {
                      background-color: rgba(54,58,62,255);
                    }
                    .pokelist_card {
                      cursor: pointer;
                      max-height: 100px;
                      overflow: scroll;
                    }
                    .pokelist_card::-webkit-scrollbar {
                      display: none;
                    }
                    .pokelistDiv {
                      min-height: 90vh;
                    }
                    .pokeImg {
                      height: 100px;
                      width: 150px;
                    }
                  </style>
            
</html>