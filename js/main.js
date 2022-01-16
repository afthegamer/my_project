"use strict";

/***********************************************************************************/
/* *********************************** DATA ****************************************/
/***********************************************************************************/
const header = document.querySelector("#chocolatine");
let objet = document.querySelectorAll(" #myBtn, #myBtn2, #myBtn3, #myBtn4");
let back = document.querySelectorAll("#close,#close2,#close3,#close4");
/***********************************************************************************/
/* ********************************** FONCTIONS ************************************/
/***********************************************************************************/
//function which display the item to select and will hide the header at the same time
function chocolatine() {
    document.querySelector("#" + this.value).classList.remove("hidden");
    header.classList.add("hidden");
}
//function which will close the displayed article by hiding it again and will redisplay the header
function returnNav() {
    this.parentNode.parentNode.classList.add("hidden");
    header.classList.remove("hidden");
}

/************************************************************************************/
/********************************** CODE PRINCIPAL **********************************/
/************************************************************************************/
//parameter that will launch the chocolatine function
objet.forEach((obj) => {
    obj.addEventListener("click", chocolatine);
});
//parameter that will launch the returnNav function
back.forEach((back) => {
    back.addEventListener("click", returnNav);
});