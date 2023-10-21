(function ($) {
    "use strict";

    // Dropdown on mouse hover
    $(document).ready(function () {
        function toggleNavbarMethod() {
            if ($(window).width() > 992) {
                $('.navbar .dropdown').on('mouseover', function () {
                    $('.dropdown-toggle', this).trigger('click');
                }).on('mouseout', function () {
                    $('.dropdown-toggle', this).trigger('click').blur();
                });
            } else {
                $('.navbar .dropdown').off('mouseover').off('mouseout');
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);
    });


    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Portfolio isotope and filter
    var portfolioIsotope = $('.portfolio-container').isotope({
        itemSelector: '.portfolio-item',
        layoutMode: 'fitRows'
    });

    $('#portfolio-flters li').on('click', function () {
        $("#portfolio-flters li").removeClass('active');
        $(this).addClass('active');

        portfolioIsotope.isotope({filter: $(this).data('filter')});
    });


    // Post carousel
    $(".post-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        dots: false,
        loop: true,
        nav : true,
        navText : [
            '<i class="fa fa-angle-left" aria-hidden="true"></i>',
            '<i class="fa fa-angle-right" aria-hidden="true"></i>'
        ],
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:2
            }
        }
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        center: true,
        autoplay: true,
        smartSpeed: 2000,
        dots: true,
        loop: true,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:3
            }
        }
    });

})(jQuery);
 /* Pop up Message */
//  document.addEventListener("DOMContentLoaded", function() {
//     var popupContainer = document.getElementById("popup-container");
//     var popupMessage = document.getElementById("popup-message");

//     function showPopup() {
//         popupContainer.style.display = "flex";
//     }

    // function hidePopup() {
    //     popupContainer.style.display = "none";
    // }

//     function setCookie(cname, cvalue, exdays) {
//         var d = new Date();
//         d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
//         var expires = "expires=" + d.toUTCString();
//         document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
//     }

//     function getCookie(cname) {
//         var name = cname + "=";
//         var decodedCookie = decodeURIComponent(document.cookie);
//         var ca = decodedCookie.split(';');
//         for (var i = 0; i < ca.length; i++) {
//             var c = ca[i];
//             while (c.charAt(0) == ' ') {
//                 c = c.substring(1);
//             }
//             if (c.indexOf(name) == 0) {
//                 return c.substring(name.length, c.length);
//             }
//         }
//         return "";
//     }

//     // Check if the cookie exists
//     var userSeenPopup = getCookie("popup_seen");
//     if (!userSeenPopup) {
//         // Show the pop-up if the user hasn't seen it before
//         showPopup();
//         // Set the "popup_seen" cookie to remember that the user has seen the pop-up
//         setCookie("popup_seen", "true", 1); // Expires in 1 day
//     }

//     // Hide the pop-up when clicked outside the message
//     popupContainer.addEventListener("click", hidePopup);
//     popupMessage.addEventListener("click", function(event) {
//         event.stopPropagation();
//     });
// });

// document.addEventListener("DOMContentLoaded", function() {
//     var popupContainer = document.getElementById("popup-container");
//     var popupMessage = document.getElementById("popup-message");

//     function showPopup() {
//       popupContainer.style.display = "flex";
//     }

//     function hidePopup() {
//       popupContainer.style.display = "none";
//     }

//     // Show the pop-up when the page loads
//     showPopup();

//     // Hide the pop-up when clicked outside the message
//     popupContainer.addEventListener("click", hidePopup);
//     popupMessage.addEventListener("click", function(event) {
//       event.stopPropagation();
//     });
//   });

//     // Check if the pop-up has been shown before
//     if (!sessionStorage.getItem('popupShown')) {
//         // Display the pop-up
//         document.getElementById('popup-container').style.display = 'block';

//         // Set a flag in sessionStorage to indicate the pop-up has been shown
//         sessionStorage.setItem('popupShown', 'true');
//     } else {
//         // Hide the pop-up
//         document.getElementById('popup-container').style.display = 'none';
//     }



