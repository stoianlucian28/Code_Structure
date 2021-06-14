/*
  /////////////////////////////////////////////////////////////////
  
              Make the navbar sticky after scrolling 
              the page.

  ////////////////////////////////////////////////////////////////
  */

// REMEBER: Come back to this function, I can definetly make it smoother. An example
// being to create the same nav bar and to make it visible only after a certain number 
// of pixels, by this method i can avoid the "jumping of the Get started" after I 
// the navbar becomes sticky

window.onscroll = function() {stickyNav()};

var navbar = document.getElementById("navbar");

function stickyNav() {
  if (document.body.scrollTop > 250 || document.documentElement.scrollTop > 250) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}