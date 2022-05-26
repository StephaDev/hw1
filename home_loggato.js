//-------CAMBIA PROFILO LOGIN POPUP-------
function scrollOFF() {
    document.body.classList.add("no-scroll");
  }
  
  function scrollON() {
    document.body.classList.remove("no-scroll");
  }
  
  function opacityModeON() {
    document.querySelector(".overlay").classList.remove('hidden');
  }
  
  function opacityModeOFF() {
    document.querySelector(".overlay").classList.add('hidden');
  }
  
  function openLogForm() {
    opacityModeON();
    scrollOFF();
    document.getElementById("Login").style.display = "block";
  }
    
  function closeLogForm() {
    document.getElementById("Login").style.display = "none";
    if (document.getElementById("err")!= null) document.getElementById("err").style.display = "none";
    opacityModeOFF();
    scrollON();
  }

const cambiap = document.querySelectorAll(".cambiap");
for (let i = 0; i < cambiap.length; i++) {
  cambiap[i].addEventListener('click', openLogForm);
}

const cancelbtn = document.querySelector(".cancel");
cancelbtn.addEventListener('click', closeLogForm);
//----------------------------------

//-------DROPDOWN MENU-------
function dropON() {
    document.getElementById("myDropdown").style.display = 'block';
  }
  
  // Chiudo il dropdown menu se l'utente clicca al di fuori di esso
  window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        document.getElementById("myDropdown").style.display = 'none';
    }
  }

  function mobileDropDown() {
    let x = document.querySelector("#myDropdown2");

    if (x.style.display === "block") {
      x.style.display = "none";
    } else {
      x.style.display = "block";
    }
  }
  
  const dropbtn = document.querySelector(".dropbtn");
  dropbtn.addEventListener('click', dropON);

  const dropbtnmob = document.querySelector(".dropbtnm");
  dropbtnmob.addEventListener('click', mobileDropDown);
//----------------------------------

//-------SWIPER-------
var swiper = new Swiper(".vehicles-slider", {
    grabCursor: true,
    centeredSlides: true,  
    spaceBetween: 20,
    loop:true,
    autoplay: {
      delay: 9500,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable:true,
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
    },
  });
//----------------------------------


//-------API UNSPLASH-------

function onResponse(response)
{
  return response.json();
}

function onError(error) 
{
  console.log(error);
}

function onJson(json)
{ 
  console.log(json);

  if (json.results.length >= 1) {
    for(let i=0;i<json.results.length;i++)
    {
      let imgurl = json.results[i].urls.regular;
      
      let div_swipersb = document.createElement("div");
      div_swipersb.classList.add("swiper-slide");
      div_swipersb.classList.add("box");

      let img = document.createElement("img");
      img.src = imgurl;

      div_swipersb.appendChild(img);

      let swiper_wp = document.querySelector("#abbigliamento .swiper-wrapper");
      swiper_wp.appendChild(div_swipersb);
    }
  }

}

fetch("abbigliamento_home.php").then(onResponse,onError).then(onJson);  //ABBIGLIAMENTO


function onJson2(json)
{ 
  console.log(json);

  if (json.results.length >= 1) {
    for(let i=0;i<json.results.length;i++)
    {
      let imgurl = json.results[i].urls.regular;
      
      let div_swipersb = document.createElement("div");
      div_swipersb.classList.add("swiper-slide");
      div_swipersb.classList.add("box");

      let img = document.createElement("img");
      img.src = imgurl;

      div_swipersb.appendChild(img);

      let swiper_wp = document.querySelector("#tecnologia .swiper-wrapper");
      swiper_wp.appendChild(div_swipersb);
    }
  }

}

fetch("tecnologia_home.php").then(onResponse,onError).then(onJson2);  //TECNOLOGIA


function onJson3(json)
{ 
  console.log(json);

  if (json.results.length >= 1) {
    for(let i=0;i<json.results.length;i++)
    {
      let imgurl = json.results[i].urls.regular;
      
      let div_swipersb = document.createElement("div");
      div_swipersb.classList.add("swiper-slide");
      div_swipersb.classList.add("box");

      let img = document.createElement("img");
      img.src = imgurl;

      div_swipersb.appendChild(img);

      let swiper_wp = document.querySelector("#estetica .swiper-wrapper");
      swiper_wp.appendChild(div_swipersb);
    }
  }

}

fetch("estetica_home.php").then(onResponse,onError).then(onJson3);  //ESTETICA


//----------------------------------


//-------MOBILE MENU-------

function mobileMenu() {
  let x = document.querySelector("#links-mobile");
  if (x.style.display === "flex") {
    x.style.display = "none";
  } else {
    x.style.display = "flex";
  }
}

const mobilebtn = document.querySelector('#mobile-menu');
mobilebtn.addEventListener('click', mobileMenu);

//----------------------------------