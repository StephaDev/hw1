//-------LOGIN POPUP FORM-------
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

const loga = document.querySelectorAll(".accedi");
for (let i=0; i < loga.length; i++) {
  loga[i].addEventListener('click', openLogForm);
}

const logb = document.querySelector(".accedi-btn");
logb.addEventListener('click', openLogForm);

const cancelbtn = document.querySelector(".cancel");
cancelbtn.addEventListener('click', closeLogForm);

//----------------------------------


//-------IMAGE GRID (per i brand) USANDO LE API DI KLAZIFY-------

const key ='eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNDI1MTFkNTJiZTIwNzQyMWQxY2M2MDU1ZjQ3NzM0ZjljMGY5NTVlN2RkOGU3NjhiNjJiZTQxOWRmNjEwZTZjMmE4MTQzNDEzODJhZjk5MjMiLCJpYXQiOjE2NTM2NjI0MDgsIm5iZiI6MTY1MzY2MjQwOCwiZXhwIjoxNjg1MTk4NDA4LCJzdWIiOiI2MjczIiwic2NvcGVzIjpbXX0.x3PqZEiax0HQAvNsspBt3Zmn52uaFQmru7JZMwXIU8poGNTE4ZCMGtOgRdeFWt_RhD68ERe8ppSaceYv-8TeWA';
const img_grid = document.querySelector('.image-grid');

function onResponse(response)
{
  return response.json();
}

function onError(error) 
{
  console.log(error);
}

function onNike(json)
{ 
  console.log(json);

  let logourl = json.domain.logo_url;
  let name = json.objects.company.name;

  let branddiv = document.createElement('div');
  let brandlogo = document.createElement('img');
  let brandname = document.createElement('p');

  brandlogo.src = logourl;
  brandname.textContent = name;

  branddiv.appendChild(brandlogo);
  branddiv.appendChild(brandname);

  img_grid.appendChild(branddiv);

}

function onNvidia(json)
{ 
  console.log(json);

  let logourl = json.domain.logo_url;
  let name = json.objects.company.name;

  let branddiv = document.createElement('div');
  let brandlogo = document.createElement('img');
  let brandname = document.createElement('p');

  brandlogo.src = logourl;
  brandname.textContent = name;

  branddiv.appendChild(brandlogo);
  branddiv.appendChild(brandname);

  img_grid.appendChild(branddiv);

}

function onSamsung(json)
{ 
  console.log(json);

  let logourl = json.domain.logo_url;
  let name = json.objects.company.name;

  let branddiv = document.createElement('div');
  let brandlogo = document.createElement('img');
  let brandname = document.createElement('p');

  brandlogo.src = logourl;
  brandname.textContent = name;

  branddiv.appendChild(brandlogo);
  branddiv.appendChild(brandname);

  img_grid.appendChild(branddiv);

}

function onNivea(json)
{ 
  console.log(json);

  let logourl = json.domain.logo_url;
  let name = json.objects.company.name;

  let branddiv = document.createElement('div');
  let brandlogo = document.createElement('img');
  let brandname = document.createElement('p');

  brandlogo.src = logourl;
  brandname.textContent = name;

  branddiv.appendChild(brandlogo);
  branddiv.appendChild(brandname);

  img_grid.appendChild(branddiv);

}


//JavaScript Jquery AJAX
const settings = {
  "async": true,
  "crossDomain": true,
  "method": "POST",
  "headers": {
    "Accept": "application/json",
    "Content-Type": "application/json",
    "Authorization": "Bearer " + key,
    "cache-control": "no-cache"
  }
}
              
fetch("https://www.klazify.com/api/categorize?url=http://www.nike.com", settings).then(onResponse, onError).then(onNike);
fetch("https://www.klazify.com/api/categorize?url=http://nvidia.com", settings).then(onResponse, onError).then(onNvidia);
fetch("https://www.klazify.com/api/categorize?url=http://samsung.com", settings).then(onResponse, onError).then(onSamsung);
fetch("https://www.klazify.com/api/categorize?url=http://nivea.com ", settings).then(onResponse, onError).then(onNivea);


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
