<!-- Sign Up Modal -->
<article class="modal fade" id="sign_up_modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
  
  <!-- Sign Up Modal Dialog -->
  <section class="modal-dialog d-flex justify-content-center align-items-center m-0">

    <!-- Sign Up Modal Content -->
    <section class="modal-content bg-secondary">

      <!-- Sign Up Modal Header -->
      <section class="modal-header bg-dark text-light">
        
        <!-- Sign Up Modal Header Elements -->
        <span class="col-11 d-flex justify-content-start align-items-center p-0 gap-2">
          
          <!-- Sign Up Modal Header Icon -->
          <img class="img" src="../assets/img/icons/pokedopt.ico" alt="PokéDopt Icon" id="sign-icon">
          <!-- Sign Up Modal Header Icon -->

          <!-- Sign Up Modal Header Title -->
          <h5 class="modal-title" id="modal-title">PokéDopt: Sign Up</h5>
          <!-- Sign Up Modal Header Title -->
          
          <!-- Sign Up Modal Header Switch Modal Toggler -->
          <button class="btn btn-outline-light border-0 sign-toggler" type="button" title="Switch to Sign In">
            
            <!-- Sign Up Modal Header Switch Modal Toggler Icon -->
            <span class="fs-4 lh-1 p-0">></span>
            <!-- Sign Up Modal Header Switch Modal Toggler Icon -->

          </button>
          <!-- Sign Up Modal Header Switch Modal Toggler -->

          <!-- Sign Up Modal Header Switch Modal -->
          <button class="btn btn-outline-light modal-switch" data-bs-toggle="modal" data-bs-target="#sign_in_modal" autofocus>

            <!-- Sign Up Modal Header Switch Modal Title -->
            <span class="fs-4">
              Sign In
            </span>
            <!-- Sign Up Modal Header Switch Modal Title -->

          </button>
          <!-- Sign Up Modal Header Switch Modal -->

        </span>
        <!-- Sign Up Modal Header Elements -->
        
        <!-- Sign Up Modal Header Close -->
        <button class="btn-close bg-light me-1" type="button" data-bs-dismiss="modal" aria-labelledby="Close"></button>
        <!-- Sign Up Modal Header Close -->

      </section>
      <!-- Sign Up Modal Header -->
      
      <!-- Sign Up Modal Body -->
      <section class="modal-body fw-bold">

        <!-- Sign Up Modal Body Form -->
        <form action="../processes/signUpProcess.php" id="signUp_form" method="POST" enctype="multipart/form-data" class="d-flex flex-column gap-3">
          
          <!-- Account Credentials Fieldset -->
          <fieldset class="text-dark d-flex flex-column gap-2">
  
            <!-- Account Credentials Fieldset Legend -->
            <legend class="border-bottom border-dark">Account Credentials:</legend>
            <!-- Account Credentials Fieldset Legend -->
  
            <!-- Account Credentials Email -->
            <input type="email" class="form-control bg-dark text-light border-dark" id="email" placeholder="Email" name="email" autocomplete="off" required>
            <!-- Account Credentials Email -->
  
            <!-- Account Credentials Password -->
            <input type="password" class="form-control bg-dark text-light border-dark" id="password" placeholder="Password" name="password" required>
            <!-- Account Credentials Password -->

            <!-- Password Requirements -->
            <section class="d-none" id="pass_reqs">
              <p class="m-0" id="pass_len">
                - Must be at least 8 characters long
              </p>
              <p class="m-0" id="pass_case">
                - Must be a combination of upper & lower case
              </p>
              <p class="m-0" id="pass_digit">
                - Must have at least 1 digit
              </p>
              <p class="m-0" id="pass_special">
                - Must have at least 1 special character
              </p>
            </section>
            <!-- Password Requirements -->
  
            <!-- Account Credentials Confirm Password -->
            <input type="password" class="form-control bg-dark text-light border-dark" id="confirm_password" placeholder="Confirm Password" name="confirm_password" required>
            <!-- Account Credentials Confirm Password -->

            <!-- Confirm Password Requirements -->
            <section class="d-none" id="confirm_pass_reqs">
              <p class="m-0" id="confirm_pass_match">
                - Must match password
              </p>
            </section>
            <!-- Confirm Password Requirements -->
  
          </fieldset>
          <!-- Account Credentials Fieldset -->
        
          <!-- Personal Information Fieldset -->
          <fieldset class="text-dark d-flex flex-column gap-2">
  
            <!-- Personal Information Fieldset Legend -->
            <legend class="border-bottom border-dark">Personal Information:</legend>
            <!-- Personal Information Fieldset Legend -->

            <section class="p-3 d-flex gap-3">
              <label for="pfpFile" class="bg-dark col-3" style="cursor: pointer; height: 150px; width: 150px; border-radius: 100%;">
                <img src="..\assets\pfp\default.png" alt="Ashie_Loche" id="pfp" class="pfp" style="height: 150px; width: 150px; border-radius: 100%;">
                <input type="file" name="pfpFile" id="pfpFile" class="d-none">
              </label>
              
              <section class="d-flex flex-column gap-2 justify-content-center col-8">
                <h3 class="border-bottom border-dark fw-bold pb-2">Profile Pic</h3>
                <input class="btn btn-dark" id="clear" type="button" value="Clear">
              </section>
            </section>
            

            <!-- Account Credentials Username -->
            <input type="text" class="form-control bg-dark text-light border-dark" id="username" placeholder="Username" name="username" autocomplete="off" required>
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
            
            <select id="gender" name="gender" class="form-select bg-dark text-white border border-secondary" style="cursor: pointer;">
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="Non-Binary">Non-Binary</option>
            </select>

            <!-- Personal Information Birthday -->
            <section class="input-group">
              
              <!-- Personal Information Birthday Icon -->
              <span class="input-group-text bg-dark text-light border-dark" title="Birthday">
                <i class="bi bi-cake2 fs-5"></i>
              </span>
              <!-- Personal Information Birthday Icon -->
              
              <!-- Personal Information Birthday Date -->
              <input type="date" class="form-control bg-dark text-light border-dark" name="bday" required>
              <!-- Personal Information Birthday Date -->
              
            </section>
            <!-- Personal Information Birthday -->

            <!-- Personal Information Mobile -->
            <section class="input-group">

              <!-- Personal Information Last Mobile Prefix -->
              <span class="input-group-text bg-dark text-light border-dark">+63</span>
              <!-- Personal Information Last Mobile Prefix -->

              <!-- Personal Information Last Mobile Number -->
              <input type="tel" class="form-control bg-dark text-light border-dark" id="mobile" placeholder="Mobile Number" name="mobile" pattern="[0-9]{10}" required>
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
            
            <button id="type_toggler" class="btn btn-dark form-control p-2" type="button" data-bs-toggle="collapse" data-bs-target="#types" aria-controls="types" aria-expanded="false" aria-label="Toggle Types">
              Type Preference/s
            </button>

            <section class="collapse navbar-collapse bg-dark text-light rounded p-3" id="types">
              <section class="d-flex">
                
                <section class="d-flex flex-column gap-3 col-4">
                  <span class="input-group d-flex justify-content-center gap-2">
                    <input type="checkbox" name="type[]" id="Fire" value="Fire">
                    <label for="Fire">Fire</label>
                  </span>

                  <span class="input-group d-flex justify-content-center gap-2">
                    <input type="checkbox" name="type[]" id="Water" value="Water">
                    <label for="Water">Water</label>
                  </span>
                  
                  <span class="input-group d-flex justify-content-center gap-2">
                    <input type="checkbox" name="type[]" id="Electric" value="Electric">
                    <label for="Electric">Electric</label>
                  </span>

                  <span class="input-group d-flex justify-content-center gap-2">
                    <input type="checkbox" name="type[]" id="Grass" value="Grass">
                    <label for="Grass">Grass</label>
                  </span>

                  <span class="input-group d-flex justify-content-center gap-2">
                    <input type="checkbox" name="type[]" id="Ice" value="Ice">
                    <label for="Ice">Ice</label>
                  </span>
                  
                  <span class="input-group d-flex justify-content-center gap-2">
                    <input type="checkbox" name="type[]" id="Fighting" value="Fighting">
                    <label for="Fighting">Fighting</label>
                  </span>
                </section>
                
                <section class="d-flex flex-column gap-3 col-4">
                  <span class="input-group d-flex justify-content-center gap-2">
                    <input type="checkbox" name="type[]" id="Poison" value="Poison">
                    <label for="Poison">Poison</label>
                  </span>

                  <span class="input-group d-flex justify-content-center gap-2">
                    <input type="checkbox" name="type[]" id="Ground" value="Ground">
                    <label for="Ground">Ground</label>
                  </span>
                  
                  <span class="input-group d-flex justify-content-center gap-2">
                    <input type="checkbox" name="type[]" id="Flying" value="Flying">
                    <label for="Flying">Flying</label>
                  </span>

                  <span class="input-group d-flex justify-content-center gap-2">
                    <input type="checkbox" name="type[]" id="Psychic" value="Psychic">
                    <label for="Psychic">Psychic</label>
                  </span>

                  <span class="input-group d-flex justify-content-center gap-2">
                    <input type="checkbox" name="type[]" id="Bug" value="Bug">
                    <label for="Bug">Bug</label>
                  </span>
                  
                  <span class="input-group d-flex justify-content-center gap-2">
                    <input type="checkbox" name="type[]" id="Normal" value="Normal">
                    <label for="Normal">Normal</label>
                  </span>
                </section>
                
                <section class="d-flex flex-column gap-3 col-4">
                  <span class="input-group d-flex justify-content-center gap-2">
                    <input type="checkbox" name="type[]" id="Rock" value="Rock">
                    <label for="Rock">Rock</label>
                  </span>

                  <span class="input-group d-flex justify-content-center gap-2">
                    <input type="checkbox" name="type[]" id="Ghost" value="Ghost">
                    <label for="Ghost">Ghost</label>
                  </span>
                  
                  <span class="input-group d-flex justify-content-center gap-2">
                    <input type="checkbox" name="type[]" id="Dragon" value="Dragon">
                    <label for="Dragon">Dragon</label>
                  </span>

                  <span class="input-group d-flex justify-content-center gap-2">
                    <input type="checkbox" name="type[]" id="Dark" value="Dark">
                    <label for="Dark">Dark</label>
                  </span>

                  <span class="input-group d-flex justify-content-center gap-2">
                    <input type="checkbox" name="type[]" id="Steel" value="Steel">
                    <label for="Steel">Steel</label>
                  </span>
                  
                  <span class="input-group d-flex justify-content-center gap-2">
                    <input type="checkbox" name="type[]" id="Fairy" value="Fairy">
                    <label for="Fairy">Fairy</label>
                  </span>
                </section>

              </section>
            </section>

            <button id="region_toggler" class="btn btn-dark form-control p-2" type="button" data-bs-toggle="collapse" data-bs-target="#regions" aria-controls="regions" aria-expanded="false" aria-label="Toggle Regions">
              Region Preference/s
            </button>
            
            <section class="collapse navbar-collapse bg-dark text-light rounded p-3" id="regions">
              <section class="d-flex">
                
                <section class="d-flex flex-column gap-3 col-4">

                  <span class="input-group d-flex justify-content-center gap-2">
                    <input type="checkbox" name="region[]" id="Kanto" value="Kanto">
                    <label for="Kanto">Kanto</label>
                  </span>

                  <span class="input-group d-flex justify-content-center gap-2">
                    <input type="checkbox" name="region[]" id="Johto" value="Johto">
                    <label for="Johto">Johto</label>
                  </span>
                  
                  <span class="input-group d-flex justify-content-center gap-2">
                    <input type="checkbox" name="region[]" id="Hoenn" value="Hoenn">
                    <label for="Hoenn">Hoenn</label>
                  </span>
                </section>
                
                <section class="d-flex flex-column gap-3 col-4">

                  <span class="input-group d-flex justify-content-center gap-2">
                    <input type="checkbox" name="region[]" id="Sinnoh" value="Sinnoh">
                    <label for="Sinnoh">Sinnoh</label>
                  </span>

                  <span class="input-group d-flex justify-content-center gap-2">
                    <input type="checkbox" name="region[]" id="Unovah" value="Unovah">
                    <label for="Unovah">Unovah</label>
                  </span>
                  
                  <span class="input-group d-flex justify-content-center gap-2">
                    <input type="checkbox" name="region[]" id="Kalos" value="Kalos">
                    <label for="Kalos">Kalos</label>
                  </span>
                </section>
                
                <section class="d-flex flex-column gap-3 col-4">
                  <span class="input-group d-flex justify-content-center gap-2">
                    <input type="checkbox" name="region[]" id="Alola" value="Alola">
                    <label for="Alola">Alola</label>
                  </span>

                  <span class="input-group d-flex justify-content-center gap-2">
                    <input type="checkbox" name="region[]" id="Galar" value="Galar">
                    <label for="Galar">Galar</label>
                  </span>
                  
                  <span class="input-group d-flex justify-content-center gap-2">
                    <input type="checkbox" name="region[]" id="Paldea" value="Paldea">
                    <label for="Paldea">Paldea</label>
                  </span>
                </section>

              </section>
            </section>
  
          </fieldset>
          <!-- Personal Information Fieldset -->

        </form>
        <!-- Sign Up Modal Body Form -->

      </section>
      <!-- Sign Up Modal Body -->
      
      <!-- Sign Up Modal Footer -->
      <section class="modal-footer bg-dark d-flex justify-content-between">

        <!-- Auto Sign In Fieldset -->
        <fieldset class="text-light fs-5">

          <!-- Auto Sign In Checkbox -->
          <input type="checkbox" name="remember" id="remember_signUp" class="remember" value="remember" form="signUp_form">
          <!-- Auto Sign In Checkbox -->
          
          <!-- Auto Sign In Label -->
          <label for="remember_signUp">Remember me for 30 days</label>
          <!-- Auto Sign In Label -->
          
        </fieldset>
        <!-- Auto Sign In Fieldset -->
        
        <!-- Sign Up Modal Submit -->
        <button class="btn btn-secondary fw-bolder" type="submit" form="signUp_form" name="signUp" id="signUp_submit">Submit</button>
        <!-- Sign Up Modal Submit -->

      </section>
      <!-- Sign Up Modal Footer -->

    </section>
    <!-- Sign Up Modal Content -->

  </section>
  <!-- Sign Up Modal Dialog -->

</article>
<!-- Sign Up Modal -->