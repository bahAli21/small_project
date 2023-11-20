//BAH MAMADOU
// toggle icon navbar
let menuIcon = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');

menuIcon.onclick = () => {
    menuIcon.classList.toggle('bx-x');
    navbar.classList.toggle('active');
}

// scroll sections
let sections = document.querySelectorAll('section');
let navLinks = document.querySelectorAll('header nav a');

// Ajout d'un gestionnaire d'événements à chaque lien
navLinks.forEach(link => {
    link.addEventListener('click', function(event) {
        // Retire la classe 'active' de tous les liens
        navLinks.forEach(link => {
            link.classList.remove('active');
        });
        event.target.classList.add('active');
    });
});


const moreButton = document.getElementById('more');
    const fullText = document.querySelector('.full-txt');

    moreButton.addEventListener('click', () => {
        fullText.style.display = 'block';
        moreButton.style.display = 'none';
    });

  //   //.............. ...Start Profile Popup................
  //
  // document.querySelectorAll('.close').forEach(AllCloser=>{
  //     AllCloser.addEventListener('click',()=>{
  //         document.querySelector('.add-popup').style.display='none'
  //     })
  // });
  //
  // //.................Start Add post Popup................
  // let inputPost = document.querySelector('#add-post');
  //
  // inputPost.addEventListener('click',()=>{
  //
  //   if (event.target === inputPost && inputPost.value === '') {
  //    document.querySelector('.add-post-popup').style.display='flex';
  //  }
  //
  // });

  // const moreButton = document.getElementById('more');
  //   const fullText = document.querySelector('.full-txt');
  //
  //   moreButton.addEventListener('click', () => {
  //       fullText.style.display = 'block';
  //       moreButton.style.display = 'none';
  //   });
