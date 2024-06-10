/* APARECER LISTADO DE OPCIONES DE BARRA DE NAVEGACIÓN */

// LINKS
let cursosLink = document.getElementById('cursosLink');
let profesoresLink = document.getElementById('profesoresLink');
let quienSomosLink = document.getElementById('quienSomosLink');

// LISTADOS
let navClosed1 = document.querySelector('.nav__closed1__list1');
let navClosed2 = document.querySelector('.nav__closed2__list1');
let navClosed3 = document.querySelector('.nav__closed3__list1');

// ------------------------------- //
cursosLink.addEventListener('mouseover', function () {
    navClosed1.style.display = 'inline-flex';
    navClosed1.style.flexDirection = 'column';
    setTimeout(() => {
        navClosed1.style.opacity = '1';
    }, 10);
});

cursosLink.addEventListener('mouseleave', function () {
    navClosed1.style.opacity = '0';
    navClosed1.addEventListener('transitionend', function transitionEnd() {
        navClosed1.style.display = 'none';
        navClosed1.removeEventListener('transitionend', transitionEnd);
    });
});

// ------------------------------- //

profesoresLink.addEventListener('mouseover', function () {
    navClosed2.style.display = 'inline-flex';
    navClosed2.style.flexDirection = 'column';
    setTimeout(() => {
        navClosed2.style.opacity = '1';
    }, 10);
});

profesoresLink.addEventListener('mouseleave', function () {
    navClosed2.style.opacity = '0';
    navClosed2.addEventListener('transitionend', function transitionEnd2() {
        navClosed2.style.display = 'none';
        navClosed2.removeEventListener('transitionend', transitionEnd2);
    });
});

// ------------------------------- //
quienSomosLink.addEventListener('mouseover', function () {
    navClosed3.style.display = 'inline-flex';
    navClosed3.style.flexDirection = 'column';
    setTimeout(() => {
        navClosed3.style.opacity = '1';
    }, 10);
});

quienSomosLink.addEventListener('mouseleave', function () {
    navClosed3.style.opacity = '0';
    navClosed3.addEventListener('transitionend', function transitionEnd3() {
        navClosed3.style.display = 'none';
        navClosed3.removeEventListener('transitionend', transitionEnd3);
    });
});


/* SLDIER NUESTRAS ÚLTIMAS NOVEDADES */

let sliderNovedadesContainer = document.querySelector('.nuestrasUltimasNovedades__container--slider');
let sliderNovedades = document.querySelector('.nuestrasUltimasNovedades__container--sliderMain');
let buttonNovedadesLeft = document.getElementById('indexSlider__button-left');
let buttonNovedadesRight = document.getElementById('indexSlider__button-right');

function getCSSVariableValue(variableName) {
    return getComputedStyle(document.documentElement).getPropertyValue(variableName);
}
  
let slideNovedadesTransform = getCSSVariableValue('--slideNovedades-transform');

let slideNovedadesElements = document.querySelectorAll('.nuestrasUltimasNovedades__container--slider__element');
let slideNovedadesCounter = 0;
  
let direction = {
    right: 'right',
    left: 'left'
};

let reorderNovedadesSlide = () => {
    if (slideNovedadesCounter == slideNovedadesElements.length - 1) {
        sliderNovedades.appendChild(sliderNovedadesElements[0]); // Mover el primer elemento al final del slider
        slideNovedadesCounter = 0; // Reiniciar el contador
    }
}

let moveNovedadesSlide = (directionNovedades) => {
    if (directionNovedades === direction.left) {
        slideNovedadesCounter--;
        if (slideNovedadesCounter < 0) {
            slideNovedadesCounter = slideNovedadesElements.length - 1; 
        }
    } else if (directionNovedades === direction.right) {
        slideNovedadesCounter++;
        if (slideNovedadesCounter >= slideNovedadesElements.length) {
            slideNovedadesCounter = 0; // Envolver al primer elemento al llegar al último
        }
    }

    sliderNovedades.style.transform = `translateX(-${slideNovedadesCounter * slideNovedadesElements[0].offsetWidth}px)`;
}

buttonNovedadesRight.addEventListener('click', () => moveNovedadesSlide(direction.right));
buttonNovedadesLeft.addEventListener('click', () => moveNovedadesSlide(direction.left));

sliderNovedades.addEventListener('transitionend', reorderNovedadesSlide);


// Función para mover automáticamente el slider cada 8 segundos
let autoMoveSlider = () => {
    moveNovedadesSlide(direction.right);
}

// Intervalo para mover automáticamente el slider cada 8 segundos
let sliderInterval = setInterval(autoMoveSlider, 8000);

// Detener el intervalo al pasar el mouse sobre el slider
sliderNovedades.addEventListener('mouseenter', () => {
    clearInterval(sliderInterval);
});

// Reanudar el intervalo al retirar el mouse del slider
sliderNovedades.addEventListener('mouseleave', () => {
    sliderInterval = setInterval(autoMoveSlider, 8000);
});


// SLIDER COMENTARIOS DE LOS ALUMNOS
