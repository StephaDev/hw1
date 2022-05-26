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

//-------RIMUOVI PRODOTTI-------

function rimuovi (event) {
  const buttonrimuovi = event.currentTarget;

  const box = buttonrimuovi.parentNode.parentNode;
  let id = box.id;  //prendo l'id del prodotto per rimuoverlo dal db

  box.remove();
  calcaggtotale();

  fetch("removefromcart.php?id=" + id); //effettuo rimozione del prodotto chiamando la pagina removefromcart
}

const btnremove = document.querySelectorAll(".btn-area");
for (let i = 0; i < btnremove.length; i++) {
  btnremove[i].addEventListener('click', rimuovi);
}

//----------------------------------

//-------CALCOLA E AGGIORNA TOTALE-------

function calcaggtotale () {
  const neg = document.querySelector('.box');
  let costispedizione = 0;

  if (neg != null) {
    costispedizione = 5;
  }

  let totalearticoli = document.querySelector('#totale');
  let tassa = document.querySelector('#tassa');
  let totaleart = 0;
  let spedizione = document.querySelector('#spedizione');
  let totale = document.querySelector('#ammontare');

  let divbox = document.querySelectorAll('.box');

  for (let i = 0; i < divbox.length; i++) {
    let prezzo = divbox[i].lastElementChild.getElementsByTagName('h4')[0];
    let quantita = divbox[i].lastElementChild.querySelector('.unit').firstElementChild.value;
    
    //estraggo il valore numerico dalla stringa
    let prezzonumerico = prezzo.innerHTML.match(/\d/g);
    prezzonumerico = prezzonumerico.join("");
    prezzonumericointero = parseInt(prezzonumerico);

    //aggiorno il totale
    totaleart += prezzonumericointero * quantita;
  }
  //totale articoli
  totalearticoli.innerHTML = totaleart + '€';

  //tassa
  let valoretassa = (totaleart * (22/100));
  tassa.innerHTML = valoretassa + '€';

  //spedizione
  spedizione.innerHTML = costispedizione + '€';

  //ammontare totale
  totale = totaleart + valoretassa + costispedizione;
  ammontare.innerHTML = totale + '€';

}

//chiamo la funzione all'apertura della pagina per fare il calcolo in base ai prodotti presenti
calcaggtotale();

//----------------------------------

//-------AGGIORNA QUANTITA-------

function aggquantita (event) {
  calcaggtotale();
  
  const quantita_prodotto = event.currentTarget;
  const id_prodotto = quantita_prodotto.parentNode.parentNode.parentNode.id;

  fetch("aggiornaquantita.php?quantita=" + quantita_prodotto.value + "&id=" + id_prodotto);
}

let quantitainput = document.querySelectorAll('.unit input');
for (let i = 0; i < quantitainput.length; i++) {
  quantitainput[i].addEventListener('blur', aggquantita);
}


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