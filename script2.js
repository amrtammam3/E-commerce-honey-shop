// // slider----------------------------------
//
$('.hero-slider').slick({
    autoplay: true,
    infinite: true,
    speed: 300,
    nextArrow: $('.next'),
    prevArrow: $('.prev')

});

const header = document.querySelector('header');
function fixedNavbar(){
    header.classList.toggle('scrolled',window.pageYOffset > 0)
}
fixedNavbar();
window.addEventListener('scroll',fixedNavbar)

let menu = document.querySelector('#menu-btn');
let userBtn = document.querySelector('#user-btn');

menu.addEventListener('click',function (){
    let nav = document.querySelector('.navbar');
    nav.classList.toggle('active');
})

userBtn.addEventListener('click',function (){
    let userBox = document.querySelector('.user-box');
    userBox.classList.toggle('active');
})

let closeBtn = document.querySelector('#close-form');
closeBtn.addEventListener('click',()=>{
    document.querySelector('.update-container').style.display='none';
})




//chat gpt code----------------------------------------------------
// Slider initialization
// $(document).ready(function () {
//     if ($('.hero-slider').length) {
//         $('.hero-slider').slick({
//             autoplay: true,
//             infinite: true,  // Set to true for infinite scrolling
//             speed: 300,
//             nextArrow: $('.next'),
//             prevArrow: $('.prev')
//         });
//     }
// });
//
// // Fixed navbar on scroll
// const header = document.querySelector('header');
// function fixedNavbar() {
//     if (header) {
//         header.classList.toggle('scrolled', window.pageYOffset > 0);
//     }
// }
// fixedNavbar();
// window.addEventListener('scroll', fixedNavbar);
//
// // Menu toggle
// let menu = document.querySelector('#menu-btn');
// if (menu) {
//     menu.addEventListener('click', function () {
//         let nav = document.querySelector('.navbar');
//         if (nav) {
//             nav.classList.toggle('active');
//         }
//     });
// }
//
// // User box toggle
// let userBtn = document.querySelector('#user-btn');
// if (userBtn) {
//     userBtn.addEventListener('click', function () {
//         let userBox = document.querySelector('.user-box');
//         if (userBox) {
//             userBox.classList.toggle('active');
//         }
//     });
// }
//
// // Close button for update container
// let closeBtn = document.querySelector('#close-form');
// if (closeBtn) {
//     closeBtn.addEventListener('click', () => {
//         let updateContainer = document.querySelector('.update-container');
//         if (updateContainer) {
//             updateContainer.style.display = 'none';
//         }
//     });
// }
