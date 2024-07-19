<?php

  require '../config/db_connect.php';
  
  session_start();
  
  $_SESSION['page'] = 'Customer_Care';
  
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
                                
                                <h2 class="col-8 display-3 fw-bolder mb-4 text-center">
                                    <span class="lh-3 border-dark border-bottom">
                                        Customer Care
                                    </span>
                                </h2>

                                <section class="col-10 d-flex flex-column gap-4 align-items-center mb-4">
        
                                    <h3 class="text-dark col-12 mb-0">
                                        <span class="lh3 fw-bold">
                                            Frequently Asked Questions (FAQs)
                                        </span>
                                    </h3>

                                    <section class="accordion accordion-flush bg-dark text-light col-12 mt-0" id="faqAccordion">
    
                                        <section class="accordion-item">
    
                                            <h2 class="accordion-header" id="faq1">
    
                                                <button class="accordion-button collapsed bg-dark text-light fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                    
                                                    What are your business hours?
        
                                                </button>
    
                                            </h2>
                                            
                                            <section id="collapseOne" class="accordion-collapse collapse text-light" aria-labelledby="faq1" data-bs-parent="faqAccordion">

                                                <div class="accordion-body bg-dark">
                                                    
                                                    Our business gours are Monday-Friday, 9:00 AM to 6:00 PM PST and Saturday, 9:00 AM to 9:00 PM PST. 

                                                </div>


                                            </section>
    
                                        </section>

                                        <section class="accordion-item">
    
                                            <h2 class="accordion-header" id="faq2">
    
                                                <button class="accordion-button collapsed bg-dark text-light fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    
                                                    What payment methods do you accept?
        
                                                </button>
    
                                            </h2>
                                            
                                            <section id="collapseTwo" class="accordion-collapse collapse text-light" aria-labelledby="faq2" data-bs-parent="faqAccordion">

                                                <div class="accordion-body bg-dark">
                                                    
                                                    We accept credit cards (Visa, Mastercard, American Express), debit cards, cash, GCash, and PayPal.

                                                </div>


                                            </section>
    
                                        </section>
                                        
                                        <section class="accordion-item">
                                        
                                            <h2 class="accordion-header" id="faq3">
                                        
                                                <button class="accordion-button collapsed bg-dark text-light fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    
                                                    Can I return a Pokemon I've adopted?
                                        
                                                </button>
                                        
                                            </h2>
                                            
                                            <section id="collapseThree" class="accordion-collapse collapse text-light" aria-labelledby="faq3" data-bs-parent="faqAccordion">
                                        
                                                <div class="accordion-body bg-dark">
                                                    
                                                    We understand that sometimes circumstances change. However, due to the real responsibility of caring for a Pokemon, we generally don't accept returns. If you're having trouble caring for your adopted Pokemon, please reach out to us. We may be able to offer resources or find a suitable new home for your Pokemon companion.
                                        
                                                </div>
                                        
                                        
                                            </section>
                                        
                                        </section>
                                        
                                        <section class="accordion-item">
                                        
                                            <h2 class="accordion-header" id="faq4">
                                        
                                                <button class="accordion-button collapsed bg-dark text-light fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                    
                                                    What types of Pokemon can I adopt?
                                        
                                                </button>
                                        
                                            </h2>
                                            
                                            <section id="collapseFour" class="accordion-collapse collapse text-light" aria-labelledby="faq4" data-bs-parent="faqAccordion">
                                        
                                                <div class="accordion-body bg-dark">
                                                    
                                                    We offer a wide variety of Pokemon for adoption, from common favorites like Pikachu and Bulbasaur to rarer Pokemon you might not encounter as often. You can browse our available Pokemon on our website (link to adoption page) or visit us in person to meet our adoptable companions.
                                        
                                                </div>
                                        
                                        
                                            </section>
                                        
                                        </section>
                                        
                                        <section class="accordion-item">
                                        
                                            <h2 class="accordion-header" id="faq5">
                                        
                                                <button class="accordion-button collapsed bg-dark text-light fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                    
                                                    How many Pokémon can I adopt at once?
                                        
                                                </button>
                                        
                                            </h2>
                                            
                                            <section id="collapseFive" class="accordion-collapse collapse text-light" aria-labelledby="faq5" data-bs-parent="faqAccordion">
                                        
                                                <div class="accordion-body bg-dark">
                                                    
                                                    We highly advice that you check if you are capable of caring for multiple Pokémon. However, we only allow a limit of 3 Pokémon per adoptino cycle. As we conduct a weekly assessment of the newly adopted Pokémon to ensure the well being of these creatures.
                                        
                                                </div>
                                        
                                        
                                            </section>
                                        
                                        </section>
    
                                    </section>
                                </section>

                                <form class="col-10 d-flex flex-column gap-4 align-items-center" action="../pages/pokedopt.php" method="POST">

                                    <section class="d-flex flex-column gap-3">
                                        <h3 class="text-dark col-12 mb-0">
                                            <span class="lh3 fw-bold">
                                                Contact Us
                                            </span>
                                        </h3>
    
                                        <h5 class="text-dark col-12 mb-0">
                                            <span class="lh3 fw-bold">
                                                If you can't find the answer to your question in our FAQs, feel free to contact us directly
                                            </span>
                                        </h5>
                                    </section>
                                    
                                    <section class="col-12 form-group d-flex flex-column gap-2">
                                        <label for="ccName" class="fs-4 fw-bold">Name:</label>
                                        <input type="text" name="name" id="ccName" placeholder="Enter your name" value="<?php echo $account[0]['username']; ?>" class="form-control bg-dark text-light border-dark" required>
                                    </section>
                                    
                                    <section class="col-12 form-group d-flex flex-column gap-2">
                                        <label for="ccEmail" class="fs-4 fw-bold">Email:</label>
                                        <input type="email" name="email" id="ccEmail" placeholder="Enter your email" value="<?php echo $account[0]['email']; ?>" class="form-control bg-dark text-light border-dark" required>
                                    </section>
                                    
                                    <section class="col-12 form-group d-flex flex-column gap-2">
                                        <span>
                                        <label for="ccSubject" class="fs-4 fw-bold">Subject:</label>
                                        </span>
                                        <input type="text" name="subject" id="ccSubject" placeholder="Enter your subject here" class="form-control bg-dark text-light border-dark" required>
                                    </section>
                                    
                                    <section class="col-12 form-group d-flex flex-column gap-2">
                                        <label for="message" class="fs-4 fw-bold">Message:</label>
                                        <textarea name="message" id="message" cols="30" rows="10" placeholder="Enter your question here..." class="form-control bg-dark text-light border-dark" required></textarea>

                                    </section>

                                    <section class="col-8 form-group d-flex justify-content-center mt-4">
                                        <button type="submit" name="submit" class="btn btn-dark"><span class="fs-5 fw-bold">Submit</span></button>
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
                        .cc {
                            min-height: 90vh;
                        }
                    </style>
            
</html>