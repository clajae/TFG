/* HEADERS SLIDE CONVERSION */

window.addEventListener("scroll", function() {

    // TEACHER PERSONAL INFO HEADER
    let headerWithoutBannerOnlyNav = document.querySelector(".mainBannerWithoutBannerOnlyNav");
    headerWithoutBannerOnlyNav.classList.toggle("stickyWithoutBannerOnlyNav", window.scrollY > 0);
})

window.addEventListener("scroll", function() {

    // THE REST PAGES
    let headerWithBackgroundImage = document.querySelector(".nav");
    headerWithBackgroundImage.classList.toggle("stickyWithBackgroundImage", window.scrollY > 0);
})

/* ----------------------------------------------------------- */


/* EFECTO SLIDER VIDEO MAIN BANNER */

var videoBanner1 = document.getElementById('mainBanner__video1');
var videoBanner2 = document.getElementById('mainBanner__video2');

videoBanner1.onended = function () {
    videoBanner2.play();
    videoBanner1.style.opacity=0;
    videoBanner2.style.opacity=1;
}

videoBanner2.onended = function () {
    videoBanner1.play();
    videoBanner2.style.opacity=0;
    videoBanner1.style.opacity=1;
}

/* ----------------------------------------------------------- */


/* SCROLLBAR ANIMATIONS*/

window.addEventListener('DOMContentLoaded', function() {
    let miDiv = document.querySelector('.right__socialMedia');
    miDiv.classList.add('aparecer');

    window.addEventListener('scroll', function() {
        let posicionScroll = window.scrollY;
        let mitadPagina = document.documentElement.scrollHeight / 3;

        if (posicionScroll > mitadPagina) {
            miDiv.classList.add('oculto');
        } else {
            miDiv.classList.remove('oculto');
        }
    });
});



/* ----------------------------------------------------------- */



/* EFECTO CARTA CONTENEDORES CURSO */

/* CONTENEDOR 1 */

let el1 = document.getElementById('contEfect1')
let height1 = el1.clientHeight
let width1 = el1.clientWidth

el1.addEventListener('mousemove', (evt) => {
    let {layerX, layerY} = evt

    let yRotation = (
        (layerX - width1 / 2) / width1
    ) * 20

    let xRotation = (
        (layerY - height1 / 2) / height1
    ) * 20

    let string1 = `
    perspective(500px)
    scale(1)
    rotateX(${xRotation}deg)
    rotateY(${yRotation}deg)`

    el1.style.transform = string1

})

el1.addEventListener('mouseout', () => {
    el1.style.transform = `
    perspective(500px)
    scale(1)
    rotateX(0)
    rotateY(0)`
})

/* CONTENEDOR 2 */

let el2 = document.getElementById('contEfect2')
let height2 = el2.clientHeight
let width2 = el2.clientWidth

el2.addEventListener('mousemove', (evt) => {
    let {layerX, layerY} = evt

    let yRotation = (
        (layerX - width2 / 2) / width2
    ) * 20

    let xRotation = (
        (layerY - height2 / 2) / height2
    ) * 20

    let string2 = `
    perspective(500px)
    scale(1)
    rotateX(${xRotation}deg)
    rotateY(${yRotation}deg)`

    el2.style.transform = string2

})

el2.addEventListener('mouseout', () => {
    el2.style.transform = `
    perspective(500px)
    scale(1)
    rotateX(0)
    rotateY(0)`
})

/* CONTENEDOR 3 */

let el3 = document.getElementById('contEfect3')
let height3 = el3.clientHeight
let width3 = el3.clientWidth

el3.addEventListener('mousemove', (evt) => {
    let {layerX, layerY} = evt

    let yRotation = (
        (layerX - width3 / 2) / width3
    ) * 20

    let xRotation = (
        (layerY - height3 / 2) / height3
    ) * 20

    let string3 = `
    perspective(500px)
    scale(1)
    rotateX(${xRotation}deg)
    rotateY(${yRotation}deg)`

    el3.style.transform = string3

})

el3.addEventListener('mouseout', () => {
    el3.style.transform = `
    perspective(500px)
    scale(1)
    rotateX(0)
    rotateY(0)`
})

/* CONTENEDOR 4 */

let el4 = document.getElementById('contEfect4')
let height4 = el4.clientHeight
let width4 = el4.clientWidth

el4.addEventListener('mousemove', (evt) => {
    let {layerX, layerY} = evt

    let yRotation = (
        (layerX - width4 / 2) / width4
    ) * 20

    let xRotation = (
        (layerY - height4 / 2) / height4
    ) * 20

    let string4 = `
    perspective(500px)
    scale(1)
    rotateX(${xRotation}deg)
    rotateY(${yRotation}deg)`

    el4.style.transform = string4

})

el4.addEventListener('mouseout', () => {
    el4.style.transform = `
    perspective(500px)
    scale(1)
    rotateX(0)
    rotateY(0)`
})

/* CONTENEDOR 5 */

let el5 = document.getElementById('contEfect5')
let height5 = el5.clientHeight
let width5 = el5.clientWidth

el5.addEventListener('mousemove', (evt) => {
    let {layerX, layerY} = evt

    let yRotation = (
        (layerX - width5 / 2) / width5
    ) * 20

    let xRotation = (
        (layerY - height5 / 2) / height5
    ) * 20

    let string5 = `
    perspective(500px)
    scale(1)
    rotateX(${xRotation}deg)
    rotateY(${yRotation}deg)`

    el5.style.transform = string5

})

el5.addEventListener('mouseout', () => {
    el5.style.transform = `
    perspective(500px)
    scale(1)
    rotateX(0)
    rotateY(0)`
})

/* CONTENEDOR 6 */

let el6 = document.getElementById('contEfect6')
let height6 = el6.clientHeight
let width6 = el6.clientWidth

el6.addEventListener('mousemove', (evt) => {
    let {layerX, layerY} = evt

    let yRotation = (
        (layerX - width6 / 2) / width6
    ) * 20

    let xRotation = (
        (layerY - height6 / 2) / height6
    ) * 20

    let string6 = `
    perspective(500px)
    scale(1)
    rotateX(${xRotation}deg)
    rotateY(${yRotation}deg)`

    el6.style.transform = string6

})

el6.addEventListener('mouseout', () => {
    el6.style.transform = `
    perspective(500px)
    scale(1)
    rotateX(0)
    rotateY(0)`
})

/* CONTENEDOR 7 */

let el7 = document.getElementById('contEfect7')
let height7 = el7.clientHeight
let width7 = el7.clientWidth

el7.addEventListener('mousemove', (evt) => {
    let {layerX, layerY} = evt

    let yRotation = (
        (layerX - width7 / 2) / width7
    ) * 20

    let xRotation = (
        (layerY - height7 / 2) / height7
    ) * 20

    let string7 = `
    perspective(500px)
    scale(1)
    rotateX(${xRotation}deg)
    rotateY(${yRotation}deg)`

    el7.style.transform = string7

})

el7.addEventListener('mouseout', () => {
    el7.style.transform = `
    perspective(500px)
    scale(1)
    rotateX(0)
    rotateY(0)`
})

/* RESULTADOS ESTUDIANTES CARROUSEL */

let swiper = new Swiper('.js-testimonials-slider', {
    grabCursor: true,
    spaceBetween: 30,
    pagination: {
        el: '.js-testimonials-pagination',
        clickable: true
    },
    breakpoints: {
        800:{
            slidesPerView: 2
        },
        1248:{
            slidesPerView: 3
        }
    }
});

/* CAMBIO DE IMAGENES */

function changeImage(element) {
    let bigImage = document.getElementById('bigImage');
    let bigImageSrc = bigImage.src;
    bigImage.src = element.src;

    // Ponemos la imagen grande en el lugar de la imagen pequeña clickeada
    element.src = bigImageSrc;
  }

function changeImage2(element) {
    let bigImage2 = document.getElementById('bigImage2');
    let bigImageSrc2 = bigImage2.src;
    bigImage2.src = element.src;
  
    // Ponemos la imagen grande en el lugar de la imagen pequeña clickeada
    element.src = bigImageSrc2;
}
  
function changeImage3(element) {
    let bigImage3 = document.getElementById('bigImage3');
    let bigImageSrc3 = bigImage3.src;
    bigImage3.src = element.src;
  
    // Ponemos la imagen grande en el lugar de la imagen pequeña clickeada
    element.src = bigImageSrc3;
}

function changeImage4(element) {
    let bigImage4 = document.getElementById('bigImage4');
    let bigImageSrc4 = bigImage4.src;
    bigImage4.src = element.src;
  
    // Ponemos la imagen grande en el lugar de la imagen pequeña clickeada
    element.src = bigImageSrc4;
}

function changeImage5(element) {
    let bigImage5 = document.getElementById('bigImage5');
    let bigImageSrc5 = bigImage5.src;
    bigImage5.src = element.src;
  
    // Ponemos la imagen grande en el lugar de la imagen pequeña clickeada
    element.src = bigImageSrc5;
}

function changeImage6(element) {
    let bigImage6 = document.getElementById('bigImage6');
    let bigImageSrc6 = bigImage6.src;
    bigImage6.src = element.src;
  
    // Ponemos la imagen grande en el lugar de la imagen pequeña clickeada
    element.src = bigImageSrc6;
}


/* CONTENEDORES DE NUESTRA METODOLOGÍA */

function toggleContent(btnNumber) {
    // Oculta todos los contenidos
    var contents = document.getElementsByClassName("loQueOfrecenNuestrosCursos__smallInfo");
    for (var i = 0; i < contents.length; i++) {
      contents[i].classList.add("loQueOfrecenNuestrosCursos--btn--hidden");
    }
    
    // Quita la clase 'active' de todos los botones
    var buttons = document.getElementsByClassName("loQueOfrecenNuestrosCursos--btn");
    for (var i = 0; i < buttons.length; i++) {
      buttons[i].classList.remove("loQueOfrecenNuestrosCursos--btn--active");
    }
    
    // Muestra el contenido correspondiente al botón clicado
    var contentToShow = document.getElementById("smallInfoContent" + btnNumber);
    contentToShow.classList.remove("loQueOfrecenNuestrosCursos--btn--hidden");
    
    // Agrega la clase 'active' al botón clicado
    var btnClicked = document.querySelector(".loQueOfrecenNuestrosCursos--btn:nth-child(" + btnNumber + ")");
    btnClicked.classList.add("loQueOfrecenNuestrosCursos--btn--active");
}
  