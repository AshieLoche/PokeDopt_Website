<?php

    require '../config/db_connect.php';

    session_start();

    $_SESSION['page'] = 'Profile';

    if (isset($_COOKIE['userID'])) {
        $_SESSION['userID'] = $_COOKIE['userID'];
    }

    if (!isset($_SESSION['userID'])) {
        header('Location: ../pages/guest.php');
        exit;
    }

    {
        
        $query = "SELECT pfp_url, username, bday, gender, mobile, typePreference, regionPreference FROM account WHERE id = {$_SESSION['userID']}";
        
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
                        <div class="container-xxl bg-secondary profile">
                            
                            <!-- Main Row -->
                            <div class="row bigRow gap-3 justify-content-center">

                              <article class="col-md-8 card bg-dark text-light profile_card">

                                <section class="card-body">

                                  <section class="d-flex flex-column align-items-center mb-3">
                                    <img src="<?php echo $account[0]['pfp_url'] ?>" alt="Profile Picture" class="pfp rounded-circle">

                                    <h1 class="display-3 py-2 text-center"><?php echo $account[0]['username']; ?></h1>

                                    <button onclick="location.href='../pages/editProfile.php'" class="btn btn-outline-light">Edit Profile</button>
                                  </section>

                                  <hr class="mb-4">
                                  
                                  <section class="d-flex flex-column flex-md-row mb-2">
                                  
                                    <section class="col-md-6">
                                      <section class="d-flex flex-column gap-1 mb-3">
                                        <span class="h3 fw-bold">Gender:</span>
                                        <h4><?php echo $account[0]['gender']; ?></h4>
                                      </section>
                                      
                                      <section class="d-flex flex-column gap-1 mb-3">
                                        <span class="h3 fw-bold">Mobile Number:</span>
                                        <h4><?php echo $account[0]['mobile']; ?></h4>
                                      </section>
                                    </section>

                                    <section class="col-md-6">
                                      <section class="d-flex flex-column gap-1 mb-3">
                                        <span class="h3 fw-bold">Birhday:</span>
                                        <h4><?php 
                                                $dateObj = DateTime::createFromFormat('Y-m-d', $account[0]['bday']);
                                                if ($dateObj) {
                                                    echo $dateObj->format('F d, Y');
                                                }
                                            ?></h4>
                                      </section>
                                      
                                      <section class="d-flex flex-column gap-1 mb-3">
                                        <span class="h3 fw-bold">Age:</span>
                                        <h4><?php 
                                                $today = new DateTime();
                                                $interval = $today->diff($dateObj);
                                                echo $interval->y;
                                            ?></h4>
                                      </section>

                                    </section>
                                    
                                  </section>
                                  
                                  <section class="d-flex flex-column gap-1 mb-3">
                                      <span class="h3 fw-bold">Preferred Types:</span>
                                  
                                      <section class="d-flex flex-column flex-lg-row">
                                      <ul class="list-group col-12 col-lg-4 mb-0">
                                        <?php
                                          $typePreferences = explode('/', $account[0]['typePreference']);
                                  
                                          if(count($typePreferences) > 0 && !empty($account[0]['typePreference'])) {
                                            for ($i = 0; $i < count($typePreferences); $i++) {
                                              if ($i == 6) {
                                                break;
                                              } else {
                                                echo '<li class="list-group-item bg-dark text-light">' . $typePreferences[$i].'</li>';
                                              }
                                            }
                                          }
                                        ?>
                                      </ul>
                                      <ul class="list-group col-12 col-lg-4 mb-0">
                                        <?php
                                          if(count($typePreferences) > 6 && !empty($account[0]['typePreference'])) {
                                            for ($i = 6; $i < count($typePreferences); $i++) {
                                              if ($i == 12) {
                                                break;
                                              } else {
                                                echo '<li class="list-group-item bg-dark text-light">' . $typePreferences[$i].'</li>';
                                              }
                                            }
                                          }
                                        ?>
                                      </ul>
                                      <ul class="list-group col-12 col-lg-4 mb-0">
                                        <?php
                                          if(count($typePreferences) > 12 && !empty($account[0]['typePreference'])) {
                                            for ($i = 12; $i < count($typePreferences); $i++) {
                                              echo '<li class="list-group-item bg-dark text-light">' . $typePreferences[$i].'</li>';
                                            }
                                          }
                                        ?>
                                      </ul>
                                      </section>
                                  </section>
                                  
                                  <section class="d-flex flex-column gap-1 mb-3">
                                      <span class="h3 fw-bold">Preferred Regions:</span>
                                  
                                      <section class="d-flex flex-column flex-lg-row">
                                      <ul class="list-group col-12 col-lg-4 mb-0">
                                        <?php
                                          $regionPreference = explode('/', $account[0]['regionPreference']);
                                  
                                          if(count($regionPreference) > 0 && !empty($account[0]['regionPreference'])) {
                                            for ($i = 0; $i < count($regionPreference); $i++) {
                                              if ($i == 3) {
                                                break;
                                              } else {
                                                echo '<li class="list-group-item bg-dark text-light">' . $regionPreference[$i].'</li>';
                                              }
                                            }
                                          }
                                        ?>
                                      </ul>
                                      <ul class="list-group col-12 col-lg-4 mb-0">
                                        <?php
                                          if(count($regionPreference) > 3 && !empty($account[0]['regionPreference'])) {
                                            for ($i = 3; $i < count($regionPreference); $i++) {
                                              if ($i == 6) {
                                                break;
                                              } else {
                                                echo '<li class="list-group-item bg-dark text-light">' . $regionPreference[$i].'</li>';
                                              }
                                            }
                                          }
                                        ?>
                                      </ul>
                                      <ul class="list-group col-12 col-lg-4 mb-0">
                                        <?php
                                          if(count($regionPreference) > 6 && !empty($account[0]['regionPreference'])) {
                                            for ($i = 6; $i < count($regionPreference); $i++) {
                                              echo '<li class="list-group-item bg-dark text-light">' . $regionPreference[$i].'</li>';
                                            }
                                          }
                                        ?>
                                      </ul>
                                      </section>
                                  </section>

                                </section>

                              </article>
                              
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
                      background-image: url('../assets/img/others/bg-banner.jpg');background-repeat: no-repeat;
                      background-position: center;
                      background-size: cover;
                    }
                    .profile {
                      background-image: url('../assets/img/others/banner.jpg');background-repeat: no-repeat;
                      background-position: center;
                      background-size: cover;
                    }
                    .profile_card {
                        min-height: 90vh;
                    }
                    .pfp {
                        height: 250px;
                        width: 250px;
                        border-radius: 100%;
                    }
                </style>
            
</html>