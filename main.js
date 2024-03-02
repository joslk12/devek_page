window.addEventListener("resize", resize);
let width = window.innerWidth;

const mainNav = document.getElementById("mainNav");
const respNav = document.getElementById("respNav");
const grupo = document.getElementById("grupo");
const tel = document.getElementById("tel");
const telMob = document.getElementById("telMob");
const mail = document.getElementById("mail");
const mailMob = document.getElementById("mailMob");
const cot = document.getElementById("cot");

respNav.style.display = "none";

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
