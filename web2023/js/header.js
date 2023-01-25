const toggle = document.querySelector('.menu #title');
const detail = document.querySelector('.menu_detail');

toggle.addEventListener('click', ()=>{
  detail.classList.toggle('.active');
})