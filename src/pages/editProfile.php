<?php

    require '../config/db_connect.php';

    session_start();

    $_SESSION['page'] = 'EditProfile';

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

      $typeArray = explode('/', $account[0]['typePreference']); 
      $regionArray = explode('/',  $account[0]['regionPreference']); 

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
                            <div class="row gap-3 p-4 py-sm-5 justify-content-center">

                                <form action="../processes/editProfileProcess.php" method="POST" class="row gap-3 p-4 py-sm-5 justify-content-center" enctype="multipart/form-data" id="editProfile_Form">
                                    
                                    <section class="d-flex flex-column flex-sm-row pb-2 justify-content-center align-items-center gap-4">
                                        <label for="editPfpFile" style="cursor: pointer;">
                                            <img src="<?php echo $account[0]['pfp_url']; ?>" alt="" id="editPfp" class="pfp bg-dark">
                                            
                                            <input type="hidden" name="currentPfp" value="<?php echo $account[0]['pfp_url']; ?>">

                                            <input type="file" name="pfpFile" id="editPfpFile" class="d-none">
                                        </label>
                                        
                                        <section class="d-flex flex-column gap-2 justify-content-center">
                                            <h1 class="display-3 fw-bold pb-3 border-bottom border-dark"><?php echo $account[0]['username']; ?></h1>
                                            <input class="btn btn-dark" id="editClear" type="button" value="Clear">
                                        </section>
                                    </section>
    
                                    <!-- Account Credentials Username -->
                                    <input type="text" class="form-control bg-dark text-light border-dark" id="editUsername" placeholder="Username" name="username" value="<?php echo $account[0]['username'] ?>" autocomplete="off" required>
                                    <!-- Account Credentials Username -->
                                    
                                    <!-- Username Requirements -->
                                    <section class="d-none" id="uname_reqs">
                                      <p class="m-0" id="uname_len">
                                        - Must be between 6 - 20 characters long
                                      </p>
                                      <p class="m-0" id="uname_special">
                                        - Must not contain special characters except for an optional underscore "_"
                                      </p>
                                    </section>
                                    <!-- Username Requirements -->
                                    
                                    <select id="editGender" name="gender" class="form-select bg-dark text-white border border-secondary" style="cursor: pointer;">
                                      <option value="Male">Male</option>
                                      <option value="Female">Female</option>
                                      <option value="Non-Binary">Non-Binary</option>
                                    </select>
                                    
                                    <!-- Personal Information Birthday -->
                                    <section class="input-group p-0">
                                      
                                      <!-- Personal Information Birthday Icon -->
                                      <span class="input-group-text bg-dark text-light border-dark" title="Birthday">
                                        <i class="bi bi-cake2 fs-5"></i>
                                      </span>
                                      <!-- Personal Information Birthday Icon -->
                                      
                                      <!-- Personal Information Birthday Date -->
                                      <input type="date" class="form-control bg-dark text-light border-dark" name="bday" value="<?php echo $account[0]['bday']; ?>" required>
                                      <!-- Personal Information Birthday Date -->
                                      
                                    </section>
                                    <!-- Personal Information Birthday -->
                                    
                                    <!-- Personal Information Mobile -->
                                    <section class="input-group p-0">
                        
                                      <!-- Personal Information Last Mobile Prefix -->
                                      <span class="input-group-text bg-dark text-light border-dark">+63</span>
                                      <!-- Personal Information Last Mobile Prefix -->
                        
                                      <!-- Personal Information Last Mobile Number -->
                                      <input type="tel" class="form-control bg-dark text-light border-dark" id="editMobile" placeholder="Mobile Number" name="mobile" pattern="[0-9]{10}" value="<?php echo preg_replace('/^\d{2}/', '', $account[0]['mobile']); ?>" required>
                                      <!-- Personal Information Last Mobile Number -->
                        
                                    </section>
                                    <!-- Personal Information Mobile -->
                                    
                                    <!-- Mobile Requirements -->
                                    <section class="d-none" id="mobile_reqs">
                                      <p class="m-0" id="mobile_len">
                                        - Must be a valid number
                                      </p>
                                    </section>
                                    <!-- Mobile Requirements -->
                                    
                                    <button id="editType_toggler" class="btn btn-dark form-control p-2" type="button" data-bs-toggle="collapse" data-bs-target="#types" aria-controls="types" aria-expanded="false" aria-label="Toggle Types">
                                      Type Preference/s
                                    </button>
                                    
                                    <section class="collapse navbar-collapse bg-dark text-light rounded p-3" id="types">
                                      <section class="d-flex">
                                        <section class="d-flex flex-column gap-3 col-4">
                                          <?php
                                          $types = array('Fire', 'Water', 'Electric', 'Grass', 'Ice', 'Fighting');
                                          foreach ($types as $type) {
                                            $isChecked = (in_array($type, $typeArray)) ? 'checked' : '';  // Check if type is present
                                    
                                            echo "<span class='input-group d-flex justify-content-center gap-2'>
                                                    <input type='checkbox' name='type[]' id='edit$type' value='$type' $isChecked>
                                                    <label for='edit$type'>$type</label>
                                                  </span>";
                                          }
                                          ?>
                                        </section>
                                    
                                        <section class="d-flex flex-column gap-3 col-4">
                                          <?php
                                          $types = array('Poison', 'Ground', 'Flying', 'Psychic', 'Bug', 'Normal');
                                          foreach ($types as $type) {
                                            $isChecked = (in_array($type, $typeArray)) ? 'checked' : '';
                                    
                                            echo "<span class='input-group d-flex justify-content-center gap-2'>
                                                    <input type='checkbox' name='type[]' id='edit$type' value='$type' $isChecked>
                                                    <label for='edit$type'>$type</label>
                                                  </span>";
                                          }
                                          ?>
                                        </section>
                                    
                                        <section class="d-flex flex-column gap-3 col-4">
                                          <?php
                                          $types = array('Rock', 'Ghost', 'Dragon', 'Dark', 'Steel', 'Fairy');
                                          foreach ($types as $type) {
                                            $isChecked = (in_array($type, $typeArray)) ? 'checked' : '';
                                    
                                            echo "<span class='input-group d-flex justify-content-center gap-2'>
                                                    <input type='checkbox' name='type[]' id='edit$type' value='$type' $isChecked>
                                                    <label for='edit$type'>$type</label>
                                                  </span>";
                                          }
                                          ?>
                                        </section>
                                      </section>
                                    </section>
    
                                    <button id="editRegion_toggler" class="btn btn-dark form-control p-2" type="button" data-bs-toggle="collapse" data-bs-target="#editRegions" aria-controls="editRegions" aria-expanded="false" aria-label="Toggle Edit Regions">
                                      Region Preference/s
                                    </button>
    
                                    <section class="collapse navbar-collapse bg-dark text-light rounded p-3" id="editRegions">
                                        <section class="d-flex">
                                            <section class="d-flex flex-column gap-3 col-4">
                                                <?php
                                                $regions = array('Kanto', 'Johto', 'Hoenn');
                                                foreach ($regions as $region) {
                                                    $isChecked = (in_array($region, $regionArray)) ? 'checked' : '';  // Check if region is present
                                                    
                                                    echo "<span class='input-group d-flex justify-content-center gap-2'>
                                                        <input type='checkbox' name='region[]' id='edit$region' value='$region' $isChecked>
                                                        <label for='edit$region'>$region</label>
                                                        </span>";
                                                }
                                                ?>
                                            </section>
                                        
                                          <section class="d-flex flex-column gap-3 col-4">
                                            <?php
                                            $regions = array('Sinnoh', 'Unovah', 'Kalos');
                                            foreach ($regions as $region) {
                                              $isChecked = (in_array($region, $regionArray)) ? 'checked' : '';
                                      
                                              echo "<span class='input-group d-flex justify-content-center gap-2'>
                                                      <input type='checkbox' name='region[]' id='edit$region' value='$region' $isChecked>
                                                      <label for='edit$region'>$region</label>
                                                    </span>";
                                            }
                                            ?>
                                          </section>
                                          
                                          <section class="d-flex flex-column gap-3 col-4">
                                            <?php
                                            $regions = array('Alola', 'Galar', 'Paldea');
                                            foreach ($regions as $region) {
                                              $isChecked = (in_array($region, $regionArray)) ? 'checked' : '';
                                      
                                              echo "<span class='input-group d-flex justify-content-center gap-2'>
                                                      <input type='checkbox' name='region[]' id='edit$region' value='$region' $isChecked>
                                                      <label for='edit$region'>$region</label>
                                                    </span>";
                                            }
                                            ?>
                                          </section>
                                        </section>
                                    </section>
    
                                    <span class="d-flex justify-content-end">
                                        <button class="btn btn-dark fw-bolder" type="submit" form="editProfile_Form" name="save" id="editProfile">Save</button>
                                    </span>
                                    
                                </form>
                                

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
                  .profile {
                    min-height: 90vh;
                  }
                  .pfp {
                    height: 250px;
                    width: 250px;
                    border-radius: 100%;
                  }
                  #editGender {
                    background-image: url("data:image/svg+xml;charset=UTF-8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 14 8'><polygon points='0,0 14,0 7,7' style='fill: white;'/></svg>");
                  }
                  </style>                                
                <script>
                    // Select the dropdown element
                    const genderSelect = document.getElementById("editGender");
                    
                    // Set the selected value based on PHP variable (assuming $account[0]['gender'] is defined)
                    genderSelect.value = "<?php echo $account[0]['gender']; ?>";
                </script>

</html>