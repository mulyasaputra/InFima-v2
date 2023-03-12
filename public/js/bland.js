// Mencari tombol "scroll to top"
var scrollToTopBtn = document.querySelector("#scroll-to-top");
let show = scrollToTopBtn.getAttribute("show")
let animateRotate = scrollToTopBtn.getAttribute("animate-rotate")
let getAnimateShow = scrollToTopBtn.getAttribute("animate-show")
const animateShow = (getAnimateShow ? getAnimateShow : 'block');
console.log(show);
switch(animateShow) {
   case 'right':
    showAninateTop = 'show-rtl';
    animateTop = 'rtl';
     break;
   case 'bottom':
    showAninateTop = 'show-btt';
    animateTop = 'btt';
     break;
   case 'bottom-right':
    showAninateTop = 'show-slash';
    animateTop = 'slash';
     break;
   default:
    showAninateTop = 'show-block';
    animateTop = 'block';
 }
 if(animateRotate){scrollToTopBtn.style.cssText = "transform: rotate(300deg)";}

// Ketika user melakukan scroll, cek apakah jarak scroll melebihi 20 piksel
scrollToTopBtn.classList.add(animateTop)
window.addEventListener("scroll", () => {
  if (document.body.scrollTop > show || document.documentElement.scrollTop > show) {
      scrollToTopBtn.classList.add(showAninateTop)
      if(animateRotate){scrollToTopBtn.style.cssText = "transform: rotate(0)";}
   } else {
      scrollToTopBtn.classList.remove(showAninateTop)
      if(animateRotate){scrollToTopBtn.style.cssText = "transform: rotate(300deg)";}
  }
});
scrollToTopBtn.addEventListener("click", () => {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
});

