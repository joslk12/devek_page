window.addEventListener("resize", resize);
window.addEventListener("scroll", scroll);
let width = window.innerWidth;

const mainNav = document.getElementById("mainNav");
const respNav = document.getElementById("respNav");
const grupo = document.getElementById("grupo");
const tel = document.getElementById("tel");
const telMob = document.getElementById("telMob");
const mail = document.getElementById("mail");
const mailMob = document.getElementById("mailMob");
const cot = document.getElementById("cot");

const topContact = document.getElementById('topContact');
const navSec = document.getElementById("navSec");
const navFixed = document.getElementById("navFixed");

respNav.style.display = "none";
navFixed.style.display = "none";

if (width >= 1024 && width < 1408) {
    mainNav.style.display = "none";
    respNav.style.display = ""
} else {
    mainNav.style.display = "";
    respNav.style.display = "none"
}

if (width < 992) {
    grupo.style.display = "none"
} else {
    grupo.style.display = ""
}

if (width <= 768) {
    tel.style.display = "none"
    telMob.style.display = ""
    mail.style.display = "none"
    mailMob.style.display = ""
    cot.style.display = "none"
} else {
    tel.style.display = ""
    telMob.style.display = "none"
    mail.style.display = ""
    mailMob.style.display = "none"
    cot.style.display = ""
}

function resize() {
    let width = window.innerWidth;
    if (width >= 1024 && width < 1408) {
        mainNav.style.display = "none";
        respNav.style.display = ""
    } else {
        mainNav.style.display = "";
        respNav.style.display = "none"
    }

    if (width < 992) {
        grupo.style.display = "none"
    } else {
        grupo.style.display = ""
    }

    if (width <= 768) {
        tel.style.display = "none"
        telMob.style.display = ""
        mail.style.display = "none"
        mailMob.style.display = ""
        cot.style.display = "none"
    } else {
        tel.style.display = ""
        telMob.style.display = "none"
        mail.style.display = ""
        mailMob.style.display = "none"
        cot.style.display = ""
    }
}

function showMenu() {
    if ( mainNav.style.display == "none" || mainNav.style.display == "")
    {
        mainNav.style.display = "block";
    } 
    else {
        mainNav.style.display = "none";
    }  
}

function getPosition( el ) {
    let x = 0;
    let y = 0;
    while( el && !isNaN( el.offsetLeft ) && !isNaN( el.offsetTop ) ) {
    x += el.offsetLeft - el.scrollLeft;
    y += el.offsetTop - el.scrollTop;
    el = el.offsetParent;
    }
    return { top: y, left: x };
}

function scroll() {
    const scrollForFixedNav = navSec.offsetHeight + topContact.offsetHeight;
    if (window.scrollY >= scrollForFixedNav) {
        console.log('puto')
        navFixed.style.display = "block";
    } else {
        navFixed.style.display = "none";
    }
}
