$(document).ready(function() {

    {

        const pfp = $('#pfp');
        const editPfp = $('#editPfp');
        // const pokeImg = $('#addPokeImg'); //FOR FUTURE ADMIN
        origPfp = pfp.attr('src');
        origEditPfP = editPfp.attr('src');
        // origPokeImg = pokeImg.attr('src');
        let newPfpData;
        let newEditPfpData;
        // let newPokeImgData; //FOR FUTURE ADMIN

        function setOriginalPfp() {
            pfp.attr('src', origPfp);
            newPfpData = '';
        }

        function setOriginalEditPfp() {
            editPfp.attr('src', origEditPfP);
            newEditPfpData = '';
        }
        
        //FOR FUTURE ADMIN
        // function setOriginalPokeImg() {
        //     pokeImg.attr('src', origPokeImg);
        //     newPokeImgData = '';
        // }
        
        $("#pfpFile").on('change', function(e) {
            const file = e.target.files[0];

            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();

                $(reader).on('load', function(e) {
                    newPfpData = e.target.result;
                    pfp.attr('src', newPfpData);
                });
                
                reader.readAsDataURL(file);
            } else if (newPfpData) {

                alert("Please select an image file (png or jpg) only.");
                pfp.attr('src', newPfpData);

            } else {
                alert("Please select an image file (png or jpg) only.");
                setOriginalPfp();
            }
        });

        $("#editPfpFile").on('change', function(e) {
            const file = e.target.files[0];

            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();

                $(reader).on('load', function(e) {
                    newEditPfpData = e.target.result;
                    editPfp.attr('src', newEditPfpData);
                });
                
                reader.readAsDataURL(file);
            } else if (newEditPfpData) {

                alert("Please select an image file (png or jpg) only.");
                editPfp.attr('src', newEditPfpData);

            } else {
                alert("Please select an image file (png or jpg) only.");
                setOriginalEditPfp();
            }
        });

         //FOR FUTURE ADMIN
        // $("#addPokeImgFile").on('change', function(e) {
        //     const file = e.target.files[0];

        //     if (file && file.type.startsWith('image/')) {
        //         const reader = new FileReader();

        //         $(reader).on('load', function(e) {
        //             newPokeImgData = e.target.result;
        //             pokeImg.attr('src', newPokeImgData);
        //         });
                
        //         reader.readAsDataURL(file);
        //     } else if (newPokeImgData) {

        //         alert("Please select an image file (png or jpg) only.");
        //         pokeImg.attr('src', newPokeImgData);

        //     } else {
        //         alert("Please select an image file (png or jpg) only.");
        //         setOriginalPokeImg();
        //     }
        // });

        $('#clear').click(setOriginalPfp);
        $('#editClear').click(setOriginalEditPfp);
        // $('#pokeImgClear').click(setOriginalPokeImg);  //FOR FUTURE ADMIN

    }

    // Search and Filters
    {

        searchResult = '';
        const selectedTypes = [];
        const selectedSpecies = [];
    
        $("#search_bar").on("input", function() {
            searchResult = $(this).val().toLowerCase().trim();
    
            filterByName();
        });
        
        $("button.type").click(function() {
            const value = $(this).val().toLowerCase();
            const typeFiltered = $(this).hasClass('btn-light');
          
            if (typeFiltered) {
              // Remove value from selectedTypes if previously selected
              selectedTypes.splice(selectedTypes.indexOf(value), 1);
              $(this).removeClass("btn-light").addClass("btn-outline-light");
            } else {
              // Add value to selectedTypes if newly selected
              selectedTypes.push(value);
              $(this).removeClass("btn-outline-light").addClass("btn-light");
            }
    
            filter();
            filterByName();
    
        });
    
        $("button.species").click(function() {
            const value = $(this).val().toLowerCase();
            const speciesFiltered = $(this).hasClass('btn-light');
          
            if (speciesFiltered) {
                // Remove value from selectedSpecies if previously selected
                selectedSpecies.splice(selectedSpecies.indexOf(value), 1);
                $(this).removeClass("btn-light").addClass("btn-outline-light");
            } else {
                // Add value to selectedSpecies if newly selected
                selectedSpecies.push(value);
                $(this).removeClass("btn-outline-light").addClass("btn-light");
            }
            
            filter();
            filterByName();
    
        });
    
        function filter() {
            const pokemonCards = $('.pokemon_card');
            pokemonCards.hide();
    
            if (selectedTypes.length > 0) {
                for (let currentIndex = 0; currentIndex < pokemonCards.length; currentIndex++) {
                    const pokemonCard = pokemonCards.eq(currentIndex);
                    const cardTypes = pokemonCard.find('.types').text().toLowerCase().trim();
    
                    for (let currentIndex = 0; currentIndex < selectedTypes.length; currentIndex++) {
                        const type = selectedTypes[currentIndex];
                        if (cardTypes.indexOf(type) > -1) {
                            pokemonCard.show();
                            break;
                        }
                        
                    }
                    
                }
    
            }
    
            if (selectedSpecies.length > 0) {
                for (let currentIndex = 0; currentIndex < pokemonCards.length; currentIndex++) {
                    const pokemonCard = pokemonCards.eq(currentIndex);
                    const cardSpecies = pokemonCard.find('.species').text().toLowerCase().trim();
    
                    for (let currentIndex = 0; currentIndex < selectedSpecies.length; currentIndex++) {
                        const species = selectedSpecies[currentIndex];
                        if (cardSpecies.indexOf(species) > -1) {
                            pokemonCard.show();
                            break;
                        }
                        
                    }
                    
                }
    
            }
    
            if (selectedSpecies.length == 0 && selectedTypes.length == 0 && searchResult == 0) {
                pokemonCards.show();
            }
            
        }
    
        function filterByName() {
            const pokemonCards = $('.pokemon_card');
            pokemonCards.hide();
            
            if (searchResult.length > 0) {
                for (let currentIndex = 0; currentIndex < pokemonCards.length; currentIndex++) {
                    const pokemonCard = pokemonCards.eq(currentIndex);
                    const cardName = pokemonCard.find('.pokemon_name').text().toLowerCase().trim();
    
                    if (cardName.indexOf(searchResult) > -1) {
                        pokemonCard.show();
                    }
                    
                }
            } else {
                filter();
            }
        }

    }


    // Sign Up Requirements
    {

        let password = '';
        let complete = false;
        const reqs = {
            'username': false,
            'password': false,
            'confirm_password': false,
            'mobile': false
        }

        function reqCheck() {

            for (const key in reqs) {
                if (!reqs[key]) {
                    complete = false;
                    break;
                } else {
                    complete = true;
                    continue;
                }
            }

            (complete) ? $("#signUp_submit").prop("disabled", false) : $("#signUp_submit").prop("disabled", true);

        }

        reqCheck();
        
        $('#username').click(function() {
            $('#uname_reqs').removeClass('d-none');
        });

        $('#username').on('input', function() {
            let username = $(this).val().trim();
            let usernamePattern = /^\w{6,20}$/;

            (/^.{6,20}$/.test(username)) ? $("#uname_len").addClass('text-light') : $("#uname_len").removeClass('text-light');

            (/^\w+$/.test(username)) ? $("#uname_special").addClass('text-light') : $("#uname_special").removeClass('text-light');

            (usernamePattern.test(username)) ? reqs['username'] = true : reqs['username'] = false;

            reqCheck();

        });
        
        $(document).click(function(event){
            if ($(event.target).closest("#username").length === 0 &&
            $(event.target).closest("#uname_reqs").length === 0) {
                $('#uname_reqs').addClass('d-none');
            }
        });
        
        $(document).on('blur', function(event){
            if ($(event.target).closest("#username").length === 0 &&
            $(event.target).closest("#uname_reqs").length === 0) {
                $('#uname_reqs').addClass('d-none');
            }
        });

        $('#password').click(function() {
            $('#pass_reqs').removeClass('d-none');
        });

        $('#password').on('input', function() {
            password = $(this).val().trim();

            let passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[\w\W]{8,}$/;

            (/^.{8,}$/.test(password)) ? $('#pass_len').addClass('text-light') : $('#pass_len').removeClass('text-light');

            (/^(?=.*[a-z])(?=.*[A-Z]).+$/.test(password)) ? $('#pass_case').addClass('text-light') : $('#pass_case').removeClass('text-light');

            (/^(?=.*\d).+$/.test(password)) ? $('#pass_digit').addClass('text-light') : $('#pass_digit').removeClass('text-light');
            
            (/^(?=.*[\W_]).+$/.test(password)) ? $('#pass_special').addClass('text-light') : $('#pass_special').removeClass('text-light');

            (passwordPattern.test(password)) ? reqs['password'] = true : reqs['password'] = false;

            reqCheck();

        });
        
        $(document).click(function(event){
            if ($(event.target).closest("#password").length === 0 &&
            $(event.target).closest("#pass_reqs").length === 0) {
                $('#pass_reqs').addClass('d-none');
            }
        });

        $('#confirm_password').click(function() {
            $('#confirm_pass_reqs').removeClass('d-none');
        });

        $('#confirm_password').on('input', function() {
            let confirm_password = $(this).val().trim();

            if (password == confirm_password) {
                $('#confirm_pass_match').addClass('text-light');
                reqs['confirm_password'] = true;
            } else {
                $('#confirm_pass_match').removeClass('text-light');
                reqs['confirm_password'] = false;
            }

            reqCheck();

        });

        $(document).click(function(event){
            if ($(event.target).closest("#confirm_password").length === 0 &&
            $(event.target).closest("#confirm_pass_reqs").length === 0) {
                $('#confirm_pass_reqs').addClass('d-none');
            }
        });

        $('#mobile').click(function() {
            $('#mobile_reqs').removeClass('d-none');
        });

        $('#mobile').on('input', function() {
            let mobile = $(this).val().trim();

            if (mobile.length == 10) {
                $('#mobile_reqs').addClass('text-light');
                reqs['mobile'] = true;
            } else {
                $('#mobile_reqs').removeClass('text-light');
                reqs['mobile'] = false;
            }

            reqCheck();

        });

        $(document).click(function(event){
            if ($(event.target).closest("#mobile").length === 0 &&
            $(event.target).closest("#mobile_reqs").length === 0) {
                $('#mobile_reqs').addClass('d-none');
            }
        });

    }
    // Sign Up Requirements

    // Heart Mechanics
    let heartIcon;
    let hearted = false;

    $("button.heart").click(function() {
        heartIcon = $(this).find("i");
        hearted = heartIcon.hasClass("bi-suit-heart-fill");

        if (hearted) {
            heartIcon.removeClass("bi-suit-heart-fill").addClass("bi-suit-heart");
        } else {
            heartIcon.removeClass("bi-suit-heart").addClass("bi-suit-heart-fill");
        }
    });
    // Heart Mechanics

    // Side Toggle Mechanics
    {
        const sideNav = $('#side-nav');
        const sideNavToggler = $('#side-nav-toggler');
        const sideNavTogglerIcon = $('#side-nav-toggler-icon');

        $(sideNavToggler).click(function() {
            sideNavToggle();
        });

        function sideNavToggle() {
            if (sideNav.get(0).classList.contains('side-nav-expanded')) {
                sideNav.removeClass('side-nav-expanded').addClass('side-nav-shrunk');

                if (sideNavTogglerIcon.get(0).classList.contains("bi-box-arrow-in-down-left")) {
                    sideNavTogglerIcon.removeClass('bi-box-arrow-in-down-left').addClass('bi-box-arrow-up-right');
                }
            } else {
                sideNav.removeClass('side-nav-shrunk').addClass('side-nav-expanded');

                if (sideNavTogglerIcon.get(0).classList.contains("bi-box-arrow-up-right")) {
                    sideNavTogglerIcon.removeClass('bi-box-arrow-up-right').addClass('bi-box-arrow-in-down-left');
                }
            }
        }

        $(window).on('resize', function(){
            if ($(window).width() < 768 && sideNav.get(0).classList.contains('side-nav-shrunk') && sideNavTogglerIcon.get(0).classList.contains("bi-box-arrow-up-right")) {
                sideNav.removeClass('side-nav-shrunk').addClass('side-nav-expanded');
                sideNavTogglerIcon.removeClass('bi-box-arrow-up-right').addClass('bi-box-arrow-in-down-left');
            } 
        });
    }
    // Side Toggle Mechanics

    // Horizontal Button Carousel Scrolling (< MD)
    {

        $(window).on('resize', function() {
            scrolling();
        });
        
        scrolling();

        function scrolling() {
            if ($('.btn-carousel').outerHeight() < $(document).outerHeight()) {
                $('section.btn-carousel').on('wheel', function(event) {
                    $(this).scrollLeft($(this).scrollLeft() + (event.originalEvent.deltaY * 60));
                    event.preventDefault();
                });
            } else {
                $('section.btn-carousel').off('wheel');
            }

            
            $('.pokelist_card').on('wheel', function(event) {
                $(this).scrollLeft($(this).scrollLeft() + (event.originalEvent.deltaY * 60));
                event.preventDefault();
            });
        }

    }
    // Horizontal Button Carousel Scrolling (< MD)

    // Modal Transfer
    {
        let signToggler;
        let signToggled = false;
    
        $(".sign-toggler").click(function() {
            signToggler = $(this).find("span");
            signToggled = signToggler.text() == "<";
    
            if (signToggled) {
                signToggler.text(">");
                $(this).parent().parent().find('button.modal-switch').fadeOut('fast', 'swing');
            } else {
                signToggler.text("<");
                $(this).parent().parent().find('button.modal-switch').fadeIn('fast', 'swing');
            }
        });
    }
    // Modal Transfer

});