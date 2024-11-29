const prev = document.querySelector("#prev");
const next = document.querySelector("#next");
let carouselVp = document.querySelector("#carousel-vp");
let cCarouselInner = document.querySelector("#cCarousel-inner");
let carouselInnerWidth = cCarouselInner.getBoundingClientRect().width;
let leftValue = 0;
const totalMovementSize =
  parseFloat(
    document.querySelector(".cCarousel-item").getBoundingClientRect().width,
    10
  ) +
  parseFloat(
    window.getComputedStyle(cCarouselInner).getPropertyValue("gap"),
    10
  );
prev.addEventListener("click", () => {
  if (!leftValue == 0) {
    leftValue -= -totalMovementSize;
    cCarouselInner.style.left = leftValue + "px";
  }
});
next.addEventListener("click", () => {
  const carouselVpWidth = carouselVp.getBoundingClientRect().width;
  if (carouselInnerWidth - Math.abs(leftValue) > carouselVpWidth) {
    leftValue -= totalMovementSize;
    cCarouselInner.style.left = leftValue + "px";
  }
});
const mediaQuery510 = window.matchMedia("(max-width: 510px)");
const mediaQuery770 = window.matchMedia("(max-width: 770px)");
mediaQuery510.addEventListener("change", mediaManagement);
mediaQuery770.addEventListener("change", mediaManagement);
let oldViewportWidth = window.innerWidth;
function mediaManagement() {
  const newViewportWidth = window.innerWidth;
  if (leftValue <= -totalMovementSize && oldViewportWidth < newViewportWidth) {
    leftValue += totalMovementSize;
    cCarouselInner.style.left = leftValue + "px";
    oldViewportWidth = newViewportWidth;
  } else if (
    leftValue <= -totalMovementSize &&
    oldViewportWidth > newViewportWidth
  ) {
    leftValue -= totalMovementSize;
    cCarouselInner.style.left = leftValue + "px";
    oldViewportWidth = newViewportWidth;
  }
}

const prev1 = document.querySelector("#prev1");
const next1 = document.querySelector("#next1");
let carouselVp1 = document.querySelector("#carousel-vp1");
let cCarouselInner1 = document.querySelector("#cCarousel-inner1");
let carouselInnerWidth1 = cCarouselInner.getBoundingClientRect().width;
let leftValue1 = 0;
const totalMovementSize1 =
  parseFloat(
    document.querySelector(".cCarousel-item1").getBoundingClientRect().width,
    10
  ) +
  parseFloat(
    window.getComputedStyle(cCarouselInner1).getPropertyValue("gap"),
    10
  );
prev1.addEventListener("click", () => {
  if (!leftValue1 == 0) {
    leftValue1 -= -totalMovementSize;
    cCarouselInner1.style.left = leftValue1 + "px";
  }
});
next1.addEventListener("click", () => {
  const carouselVpWidth = carouselVp1.getBoundingClientRect().width;
  if (carouselInnerWidth1 - Math.abs(leftValue1) > carouselVpWidth) {
    leftValue1 -= totalMovementSize;
    cCarouselInner1.style.left = leftValue1 + "px";
  }
});
const mediaQuery5101 = window.matchMedia("(max-width: 510px)");
const mediaQuery7701 = window.matchMedia("(max-width: 770px)");
mediaQuery510.addEventListener("change", mediaManagement);
mediaQuery770.addEventListener("change", mediaManagement);
let oldViewportWidth1 = window.innerWidth;
function mediaManagement() {
  const newViewportWidth = window.innerWidth;
  if (leftValue1 <= -totalMovementSize && oldViewportWidth < newViewportWidth) {
    leftValue1 += totalMovementSize;
    cCarouselInner1.style.left = leftValue1 + "px";
    oldViewportWidth = newViewportWidth;
  } else if (
    leftValue1 <= -totalMovementSize &&
    oldViewportWidth > newViewportWidth
  ) {
    leftValue1 -= totalMovementSize;
    cCarouselInner1.style.left = leftValue1 + "px";
    oldViewportWidth = newViewportWidth;
  }
}

const prev2 = document.querySelector("#prev2");
const next2 = document.querySelector("#next2");
let carouselVp2 = document.querySelector("#carousel-vp2");
let cCarouselInner2 = document.querySelector("#cCarousel-inner2");
let carouselInnerWidth2 = cCarouselInner.getBoundingClientRect().width;
let leftValue2 = 0;
const totalMovementSize2 =
  parseFloat(
    document.querySelector(".cCarousel-item2").getBoundingClientRect().width,
    10
  ) +
  parseFloat(
    window.getComputedStyle(cCarouselInner2).getPropertyValue("gap"),
    10
  );
prev2.addEventListener("click", () => {
  if (!leftValue2 == 0) {
    leftValue2 -= -totalMovementSize;
    cCarouselInner2.style.left = leftValue2 + "px";
  }
});
next2.addEventListener("click", () => {
  const carouselVpWidth = carouselVp2.getBoundingClientRect().width;
  if (carouselInnerWidth2 - Math.abs(leftValue2) > carouselVpWidth) {
    leftValue2 -= totalMovementSize;
    cCarouselInner2.style.left = leftValue2 + "px";
  }
});
const mediaQuery5102 = window.matchMedia("(max-width: 510px)");
const mediaQuery7702 = window.matchMedia("(max-width: 770px)");
mediaQuery510.addEventListener("change", mediaManagement);
mediaQuery770.addEventListener("change", mediaManagement);
let oldViewportWidth2 = window.innerWidth;
function mediaManagement() {
  const newViewportWidth = window.innerWidth;
  if (leftValue2 <= -totalMovementSize && oldViewportWidth < newViewportWidth) {
    leftValue2 += totalMovementSize;
    cCarouselInner2.style.left = leftValue2 + "px";
    oldViewportWidth = newViewportWidth;
  } else if (
    leftValue2 <= -totalMovementSize &&
    oldViewportWidth > newViewportWidth
  ) {
    leftValue2 -= totalMovementSize;
    cCarouselInner2.style.left = leftValue2 + "px";
    oldViewportWidth = newViewportWidth;
  }
}

