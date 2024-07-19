<?php

  require '../config/db_connect.php';
  
  session_start();
  
  $_SESSION['page'] = 'Book';
  
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
                        <div class="container-xxl bg-secondary book">
                            
                            <!-- Main Row -->
                            <div class="row gap-4 p-4 py-sm-5 justify-content-center">
                                
                                <!-- <form class="d-flex flex-column gap-4 align-items-center" action="../components/bookingProcess.php" method="POST"> -->
                                    
                                <form class="d-flex flex-column gap-4 align-items-center" action="../pages/pokelist.php" method="POST">
                                    
                                    <h2 class="col-8 display-3 fw-bolder mb-4 text-center">
                                        <span class="lh-3 border-dark border-bottom">
                                            Schedule a Playdate
                                        </span>
                                    </h2>
    
                                    <section class="col-8 form-group d-flex flex-column gap-2">
                                        <label for="apptDate" class="fs-2 fw-bold">Select Date:</label>
                                        <input type="date" name="apptDate" id="apptDate" class="form-control bg-dark text-light border-dark" required>
                                    </section>
    
                                    <section class="col-8 form-group d-flex flex-column gap-2">
                                        <label for="apptTime" class="fs-2 fw-bold">Select Time:</label>
                                        <select name="apptTime" id="apptTime" class="form-select bg-dark text-light" required>
                                            <option value="">Select Time</option>
                                        </select>
                                    </section>
    
                                    <section class="col-8 form-group d-flex flex-column gap-2">
                                        <label for="apptName" class="fs-2 fw-bold">Name:</label>
                                        <input type="text" name="apptName" id="apptName" placeholder="Enter your name" value="<?php echo $account[0]['username']; ?>" class="form-control bg-dark text-light" required>
                                    </section>
                                    
                                    <section class="col-8 form-group d-flex flex-column gap-2">
                                        <label for="apptEmail" class="fs-2 fw-bold">Email:</label>
                                        <input type="email" name="apptEmail" id="apptEmail" placeholder="Enter your email" value="<?php echo $account[0]['email']; ?>" class="form-control bg-dark text-light" required>
                                    </section>
    
                                    <section class="col-8 form-group d-flex justify-content-center mt-4">
                                        <button type="submit" name="schedule" class="btn btn-dark"><span class="fs-5 fw-bold">Schedule Playdate</span></button>
                                    </section>
    
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
                        label {
                            cursor: pointer;
                        }
                        #main-content {
                            background-color: rgba(54,58,62,255);
                        }
                        .book {
                            min-height: 90vh;
                        }
                        #apptTime {
                            background-image: url("data:image/svg+xml;charset=UTF-8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 14 8'><polygon points='0,0 14,0 7,7' style='fill: white;'/></svg>");
                        }
                    </style>

                    <script>
                        const apptDateInput = document.getElementById('apptDate');
                        const apptTimeSelect = document.getElementById('apptTime');
                        
                        function getAvailableSlots(date) {
                            const day = new Date(date).getDay(); // Get the day of the week (0-6)
                            
                            const availableSlots = {
                                // Weekdays (Monday-Friday)
                                1: [
                                    '9:00 AM - 11:00 AM',
                                    '1:00 PM - 3:00 PM',
                                    '4:00 PM - 6:00 PM'
                                ],
                                2: [
                                    '9:00 AM - 11:00 AM',
                                    '1:00 PM - 3:00 PM',
                                    '4:00 PM - 6:00 PM'
                                ],
                                3: [
                                    '9:00 AM - 11:00 AM',
                                    '1:00 PM - 3:00 PM',
                                    '4:00 PM - 6:00 PM'
                                ],
                                4: [
                                    '9:00 AM - 11:00 AM',
                                    '1:00 PM - 3:00 PM',
                                    '4:00 PM - 6:00 PM'
                                ],
                                5: [
                                    '9:00 AM - 11:00 AM',
                                    '1:00 PM - 3:00 PM',
                                    '4:00 PM - 6:00 PM'
                                ],
                                // Saturday
                                6: [
                                    '9:00 AM - 11:00 AM',
                                    '1:00 PM - 3:00 PM',
                                    '4:00 PM - 6:00 PM',
                                    '7:00 PM - 9:00 PM'
                                ],
                                // Sunday (Closed)
                                0: []
                            };
                            
                            return availableSlots[day];
                        }
                        
                        apptDateInput.addEventListener('change', function() {
                            const selectedDate = this.value;
                            const availableSlots = getAvailableSlots(selectedDate);
                            
                            // Clear existing options
                            apptTimeSelect.innerHTML = '';
                            
                            // Add a default option
                            const defaultOption = document.createElement('option');
                            defaultOption.value = '';
                            defaultOption.innerText = 'Select Time';
                            apptTimeSelect.appendChild(defaultOption);
                            
                            // Add available time slots as options
                            availableSlots.forEach(slot => {
                                const option = document.createElement('option');
                                option.value = slot;
                                option.innerText = slot;
                                apptTimeSelect.appendChild(option);
                            });
                        });
                        
                        </script>
            
</html>