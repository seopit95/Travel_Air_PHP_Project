function slide_js(){
  function main_slide(){
  let slideShow = document.querySelector('.main_slide')
  let slideImage = document.querySelectorAll('.main_slide img')
  let currentIndex = 0
  let timer = 0
  let slideCount = slideImage.length

  for(let i=0; i<slideImage.length; i++){
    let newIndex = i * 100 + '%'
    slideImage[i].style.left = newIndex
  }

  function moveSlide(index){
    currentIndex = index
    let newIndex = index * -100 +'%'
    slideShow.style.left = newIndex
  }
  moveSlide(0)

  function slideTimer(){
    timer = setInterval(function(){
      let newIndex = (currentIndex + 1) % slideCount
      moveSlide(newIndex)
    }, 5000)
  }
  slideTimer()

  slideShow.addEventListener('mouseenter', ()=>{
    clearInterval(timer)
  })
  slideShow.addEventListener('mouseleave', ()=>{
    slideTimer()
  })
}
main_slide()

  function travel_slide(){
    let slideShow = document.querySelector('.travel_slide')
    let slideImage = document.querySelectorAll('.travel_slide a img')
    let prev = document.querySelector('.prev')
    let next = document.querySelector('.next')
    let currentIndex = 0
    let timer = 0
    let slideCount = slideImage.length

    for(let i=0; i<slideImage.length; i++){
      let newIndex = i * 280 + 'px'
      slideImage[i].style.left = newIndex
    }

    function moveSlide(index){
      currentIndex = index
      let newIndex = index * -280 +'px'
      slideShow.style.left = newIndex
    }
    moveSlide(0)

    function slideTimer(){
      timer = setInterval(function(){
        let newIndex = (currentIndex + 1) % slideCount
        if(newIndex > slideCount - 7){
          newIndex = slideCount - 7
        }
        moveSlide(newIndex)
      }, 4000)
    }
    slideTimer()

    slideShow.addEventListener('mouseenter', ()=>{
      clearInterval(timer)
    })
    slideShow.addEventListener('mouseleave', ()=>{
      slideTimer()
    })
    prev.addEventListener('mouseenter', ()=>{
      clearInterval(timer)
    })
    prev.addEventListener('mouseleave', ()=>{
      clearInterval(timer)
    })
    next.addEventListener('mouseenter', ()=>{
      clearInterval(timer)
    })
    next.addEventListener('mouseleave', ()=>{
      clearInterval(timer)
    })

    prev.addEventListener('click', (e)=>{
      e.preventDefault()
      currentIndex = currentIndex - 1
      if(currentIndex < 0){
        currentIndex = 0
      }
      moveSlide(currentIndex)
    })

    next.addEventListener('click', (e)=>{
      e.preventDefault()
      currentIndex = currentIndex + 1
      if(currentIndex > slideCount - 7){
        currentIndex = slideCount - 7
      }
      moveSlide(currentIndex)
    })
    
  }
  travel_slide()
}