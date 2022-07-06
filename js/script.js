let navbar = document.querySelector('.header .flex .navbar');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   profile.classList.remove('active');
}

let profile = document.querySelector('.header .flex .profile');

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
   navbar.classList.remove('active');
}

window.onscroll = () =>{
   profile.classList.remove('active');
   navbar.classList.remove('active');
}

/*==================== SHOW SCROLL UP ====================*/
function scrollUp() {
   const scrollUp = document.getElementById('scroll-up');
   // When the scroll is higher than 200 viewport height, add the show-scroll class to the a tag with the scroll-top class
   if (this.scrollY >= 200) scrollUp.classList.add('show-scroll');
   else scrollUp.classList.remove('show-scroll')
}
window.addEventListener('scroll', scrollUp)

// SCROLL TO TOP ENDS HERE