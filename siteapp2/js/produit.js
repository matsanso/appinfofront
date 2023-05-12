const slides = document.querySelector('.slides');
const prevBtn = document.querySelector('.prev');
const nextBtn = document.querySelector('.next');

let slidePosition = 0;

const nextSlide = () => {
  if (slidePosition === 2) {
    slidePosition = 0;
  } else {
    slidePosition++;
  }
  slides.style.transform = `translateX(-${slidePosition * 100}%)`;
};

const prevSlide = () => {
  if (slidePosition === 0) {
    slidePosition = 2;
  } else {
    slidePosition--;
  }
  slides.style.transform = `translateX(-${slidePosition * 100}%)`;
};

nextBtn.addEventListener('click', nextSlide);
prevBtn.addEventListener('click', prevSlide);
