<?php

  require '../config/db_connect.php';
  
  session_start();
  
  $_SESSION['page'] = 'About_Us';
  
  if (isset($_COOKIE['userID'])) {
    $_SESSION['userID'] = $_COOKIE['userID'];
  }
  
  if (!isset($_SESSION['userID'])) {
    header('Location: ../pages/guest.php');
    exit;
  }
  
  {
    
    $query = "SELECT email, username FROM account WHERE id = {$_SESSION['userID']}";
      
    if (!mysqli_query($conn, $query)) {
        die('Query error: ' . mysqli_error($conn));
    } else {
        // Make Query & Get Result
        $result = mysqli_query($conn, $query);

        // Fetch the Resulting Rows as an Array
        $account = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
                        <div class="container-xxl bg-secondary cc">
                            
                            <!-- Main Row -->
                            <div class="row gap-4 p-4 py-sm-5 justify-content-center">

                                <section class="d-flex flex-column flex-md-row bg-dark text-light p-4 mb-4">

                                    <section class="col-md-6 mb-4 mb-md-0 pe-3">
                                        <h2 class="display-6 fw-bolder mb-4">
                                            <span class="lh-5 border-light border-bottom">
                                            About PokéDopt
                                            </span>
                                        </h2>
                                        <p class="fs-5">
                                            At PokéDopt, our hearts go out to abandoned Pokémon. We've witnessed countless trainers discarding their companions simply because they weren't suited for battle. We believe every Pokémon deserves a loving home, regardless of their battling prowess.
                                        </p>
                                        <p class="fs-5">
                                            That's why we created PokéDopt - a Pokémon adoption center dedicated to finding forever homes for Pokémon who are abandoned, neglected, or forgotten. We understand that Pokémon are more than just pets; they're loyal companions and cherished family members. Our mission is to provide these special creatures with a second chance at happiness and reunite them with responsible individuals who will love and care for them.
                                        </p>
                                    </section>
                                    
                                    <section class="col-md-6 text-center d-flex align-items-center p-0 m-0">
                                        <img src="../assets/img/others/banner.jpg" alt="Image of a Pokemon adoption center" class="img-fluid rounded mx-auto d-block m-0">
                                    </section>
                                </section>

                                <section class="bg-dark text-light p-4">
                                    <h2 class="col-12 p-0 display-6 fw-bolder mb-4 text-center">
                                        <span class="lh-3 border-light border-bottom">
                                            Our Mission
                                        </span>
                                    </h2>
                                    
                                    <section class="row row-cols-1 row-cols-md-2 gx-4 gy-4">
                                        <section class="col">
                                            <h3><i class="bi bi-balloon-heart"></i> Matching the Perfect Pokémon</h3>
                                            <p>We take the time to understand your lifestyle and preferences to ensure you find the perfect Pokémon companion. Whether you're a seasoned trainer, a creative artist, a loving parent, or an adventurous child, we have a Pokémon waiting to join your journey.</p>
                                        </section>
                                        <section class="col">
                                            <h3><i class="bi bi-balloon-heart"></i> Helping Pokémon Heal</h3>
                                            <p>Many of the Pokémon in our care have experienced trauma from abandonment or neglect. Our team provides them with love, care, and support to help them overcome their past and adjust to their new lives.</p>
                                        </section>
                                        <section class="col">
                                            <h3><i class="bi bi-balloon-heart"></i> Educating Potential Adopters</h3>
                                            <p>We believe that knowledge is key to building strong bonds with Pokémon. We offer educational resources and workshops to help you understand Pokémon care, training, and communication.</p>
                                        </section>
                                        
                                    </section>
                                </section>
                            
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
                        label {
                            cursor: pointer;
                        }
                        #main-content {
                            background-color: rgba(54,58,62,255);
                        }
                        .cc {
                            min-height: 90vh;
                        }
                    </style>
            
</html>