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

//-------VEICOLI-------
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
  
  var swiper = new Swiper(".featured-slider", {
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
  
  var swiper = new Swiper(".review-slider", {
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


//-------RICERCA-------
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

  if (json.shopping_results.length >= 1) {
    document.querySelector('.negozio-popup').style.display = "flex";
  }

  for(let i = 0; i < json.shopping_results.length; i++) {
      let price=json.shopping_results[i].extracted_price+"€";
      let title=json.shopping_results[i].title;
      let thumbnail=json.shopping_results[i].thumbnail;
      let link=json.shopping_results[i].link;
      let source=json.shopping_results[i].source;
      let negozio=document.querySelector(".negozio-popup");
      let prodotto=document.createElement("section");
      prodotto.classList.add('prodotto');

      let h1_nome=document.createElement("h1");
      h1_nome.textContent=title;
      let h2_prezzo=document.createElement("h2");
      h2_prezzo.textContent=price;
      let a_link=document.createElement("a");
      a_link.href= link;
      let img_thumbnail=document.createElement("img");
      img_thumbnail.src=thumbnail;
      let p_provenienza = document.createElement("p");
      p_provenienza.textContent = 'Venditore: ' + source;

      let btn_compra = document.createElement("button");
      btn_compra.classList.add("addtocart");
      btn_compra.addEventListener('click', purchase);

      btn_compra.addEventListener("click", function(event) {
        const cbtn = event.currentTarget;
        setTimeout(function(){
          cbtn.parentNode.parentNode.style.display = 'none';
        }, 3000);
      });

      //p
      p_btncompra = document.createElement("p");
      p_btncompra.classList.add("cartbtnText");
      p_btncompra.textContent = "Aggiungi al carrello";
      btn_compra.appendChild(p_btncompra);

      a_link.appendChild(img_thumbnail);
      prodotto.appendChild(a_link);

      let div = document.createElement("div");
      let div_inf = document.createElement("div");
      div_inf.classList.add("inf");

      div_inf.appendChild(h1_nome);
      div_inf.appendChild(h2_prezzo);

      div.appendChild(div_inf);
      div.appendChild(p_provenienza);
      div.appendChild(btn_compra);
      prodotto.appendChild(div);

      negozio.appendChild(prodotto);
  }
}

function search(event) {
	event.preventDefault();
	// Leggo il valore del campo di testo
	let content = document.querySelector('#cerca input').value;

  //svuoto il negozio prima di effettuare la nuova ricerca nel caso in cui ci sia stata
  let negozio = document.querySelector('.negozio-popup');
  negozio.innerHTML = "";

	// Verifico che ci sia del testo
	if(content) {
		fetch("curl.php?cerca=" + content).then(onResponse,onError).then(onJson);
  } else {
		alert("Per effettuare la ricerca inserisci del TESTO");
	}
}

//Aggiungo event listener al form per la RICERCA
const cerca = document.querySelector('#cerca');
cerca.addEventListener('submit', search);
//----------------------------------

//-------ADD TO CART BUTTON-------

function onResponset(txt) {
  return txt.text();
}

function onTxt (txt) {
  console.log(txt);
}

function purchase (event) {
    const currbtn = event.currentTarget;
    currbtn.querySelector("p").textContent = "Aggiunto✔️";
    currbtn.classList.add("activee");

    //dati da inviare

    const sec_prodotto = currbtn.parentNode.parentNode;

    const childofprodotto = sec_prodotto.children;

    const img = childofprodotto[0].firstChild.src;
    const titolo = childofprodotto[1].firstChild.firstChild.textContent;
    let prezzo = childofprodotto[1].firstChild.lastChild.textContent;
    prezzo = prezzo.slice(0, prezzo.length - 1);  //converto il prezzo in soli numeri senza il simbolo dell'€
    const quantita = 1;

    
    //invio dati ad addtocart per poi effettuare la query sul db e controlla se l'articolo è gia prensente, in quel caso incrementa la quantita di 1
    fetch("addtocart.php?img=" + img + "&titolo=" + titolo + "&prezzo=" + prezzo + "&quantita=" + quantita).then(onResponset).then(onTxt);
}

//----------------------------------

//-------MOBILE MENU-------

function mobileMenu() {
  let x = document.querySelector("#links-mobile");
  let ricerca = document.querySelector('.ricerca');
  ricerca.style.marginTop = "120px";

  if (x.style.display === "flex") {
    x.style.display = "none";
    ricerca.style.marginTop = "0";
  } else {
    x.style.display = "flex";
  }
}

const mobilebtn = document.querySelector('#mobile-menu');
mobilebtn.addEventListener('click', mobileMenu);

//----------------------------------