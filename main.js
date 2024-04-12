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

// Equipos landing
let equiposPages = 1;
let equiposSize = 1;
let equiposArr = null;
let currentPage = 1;
let equiposPage = null;
let assetFolder = '';

const cardImg1 = document.getElementById('cardImg1');
const cardName1 = document.getElementById('cardName1');
const cardDesc1 = document.getElementById('cardDesc1');
const cardLink1 = document.getElementById('cardLink1');

const cardImg2 = document.getElementById('cardImg2');
const cardName2 = document.getElementById('cardName2');
const cardDesc2 = document.getElementById('cardDesc2');
const cardLink2 = document.getElementById('cardLink2');

const cardImg3 = document.getElementById('cardImg3');
const cardName3 = document.getElementById('cardName3');
const cardDesc3 = document.getElementById('cardDesc3');
const cardLink3 = document.getElementById('cardLink3');

const cardImg4 = document.getElementById('cardImg4');
const cardName4 = document.getElementById('cardName4');
const cardDesc4 = document.getElementById('cardDesc4');
const cardLink4 = document.getElementById('cardLink4');

const elementsPerPage = 4;

const MAQUINARIA_PAGES = [
    'precintadoras',
    'encartonadoras',
    'envolvedoras',
    'selladoras',
    'tuneles',
    'flejadoras',
    'devekAir',
    'accesorios'
];

const PRODUCTOS_EMPAQUE_PAGES = [
    'cintasEmpaque',
    'cintasEspecialidad',
    'peliculas',
    'flejes',
    'poliburbuja'
]

const PAPELERA_FERRETERA_PAGES = [
    'cintasAdhesivas',
    'articulosPapeleria',
    'Flejes'
]

const MAQUINARIA = [
    {  
        clasificacion: 'precintadoras',
        codigo: 'BL-220A',
        nombre: 'Precintadora Monoformato BL-220A',
        cardDesc: 'Hasta 25 cajas por minuto con un peso menor a 16 Kg.',
        img: '1. Precintadora Monoformato BL-220A.png',
    },
    {
        clasificacion: 'precintadoras',
        codigo: 'DT-420A',
        nombre: 'Precintadora Monoformato DT-420A',
        cardDesc: 'Hasta 25 cajas por minuto con peso mayor a 18 Kg.',
        img: '2. Precintadora Monoformato DT-420A.png'
    },
    {
        clasificacion: 'precintadoras',
        codigo: 'BL-220Z',
        nombre: 'Precintadora Monoformato BL-220Z',
        cardDesc: 'Hasta 20 cajas por minuto con un peso mayor a 18 kg y menor a 25 kg.',
        img: '3. Precintadora Monoformato BL-220Z.png'
    },
    {
        clasificacion: 'precintadoras',
        codigo: 'BL-220T',
        nombre: 'Precintadora Monoformato Automática BL-220T',
        cardDesc: 'Hasta 25 cajas por minuto con un peso mayor a 18 kg y menor a 25 kg.',
        img: '4. Precintadora Monoformato Automática BL-220T.png'
    },
    {
        clasificacion: 'encartonadoras',
        codigo: 'E9',
        nombre: 'Encartonadora E9',
        cardDesc: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.',
        img: '1. Encartonadora E9.png'
    },
    {
        clasificacion: 'encartonadoras',
        codigo: 'E15_E35',
        nombre: 'Encartonadora E15 / E35',
        cardDesc: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.',
        img: '2. Encartonadora E15_E35.png'
    },
    {
        clasificacion: 'envolvedoras',
        codigo: '2000',
        nombre: 'Envolvedora 2000',
        cardDesc: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.',
        img: '1. Envolvedora 2000.png'
    },
    {
        clasificacion: 'envolvedoras',
        codigo: '2000A',
        nombre: 'Envolvedora 2000A',
        cardDesc: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.',
        img: '2. Envolvedora 2000A.png'
    },
    {
        clasificacion: 'flejadoras',
        codigo: 'BA20',
        nombre: 'Flejadora Semiautomática Básica BA20',
        cardDesc: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.',
        img: '1. Flejadora Semiautomática Básica BA20.png'
    },
    {
        clasificacion: 'flejadoras',
        codigo: 'PL20',
        nombre: 'Flejadora Semiautomática Plus PL20',
        cardDesc: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.',
        img: '2. Flejadora Semiautomática Plus PL20.png'
    },
    {
        clasificacion: 'flejadoras',
        codigo: '995',
        nombre: 'Flejadora Automática 995',
        cardDesc: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.',
        img: '3. Flejadora Automática 995.png'
    },
    {
        clasificacion: 'selladoras',
        codigo: 'YSD5540',
        nombre: 'Selladomo YSD5540',
        cardDesc: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.',
        img: '1. Selladomo YSD5540.png'
    },
    {
        clasificacion: 'selladoras',
        codigo: '34C',
        nombre: 'Selladora Semiautomática 34C',
        cardDesc: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.',
        img: '2. Selladora Semiautomática 34C.png'
    },
    {
        clasificacion: 'selladoras',
        codigo: 'SF6451-S',
        nombre: 'Selladora Automática SF6451-S',
        cardDesc: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.',
        img: '3. Selladora Automática  SF6451-S.png'
    },
    {
        clasificacion: 'selladoras',
        codigo: 'YSL5045',
        nombre: 'Selladora Semiautomática YSL5045',
        cardDesc: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.',
        img: '4. Selladora Semiautomática YSL5045.png'
    },
    {
        clasificacion: 'selladoras',
        codigo: 'SP24',
        nombre: 'Selladora de Pedal SP24',
        cardDesc: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.',
        img: '5. Selladora de Pedal SP24.png'
    },
    {
        clasificacion: 'selladoras',
        codigo: 'YSL6045S',
        nombre: 'Selladora Semiautomática YSL6045S',
        cardDesc: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.',
        img: '6. Selladora Semiautomática YSL6045S.png'
    },
    {
        clasificacion: 'selladoras',
        codigo: 'YC6030',
        nombre: 'Selladora de Cortina YC6030',
        cardDesc: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.',
        img: '7. Selladora de Cortina YC6030.png'
    },
    {
        clasificacion: 'selladoras',
        codigo: 'SC8040',
        nombre: 'Selladora de Cortina SC8040',
        cardDesc: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.',
        img: '8. Selladora de Cortina SC8040.png'
    },
    {
        clasificacion: 'selladoras',
        codigo: 'VF3500',
        nombre: 'Selladora Automática VF3500',
        cardDesc: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.',
        img: '9. Selladora Automática VF3500.png'
    },
    {
        clasificacion: 'selladoras',
        codigo: 'SC8040A',
        nombre: 'Selladora de Cortina SC8040A',
        cardDesc: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.',
        img: '10. Selladora de Cortina SC8040A.png'
    },
    {
        clasificacion: 'tuneles',
        codigo: 'YT5030',
        nombre: 'Túnel de Encogimiento YT5030',
        cardDesc: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.',
        img: '1. Túnel de Encogimiento YT5030.png'
    },
    {
        clasificacion: 'tuneles',
        codigo: 'YT4525',
        nombre: 'Túnel de Encogimiento YT4525',
        cardDesc: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.',
        img: '2. Túnel de Encogimiento YT4525.png'
    },
    {
        clasificacion: 'tuneles',
        codigo: 'YTM1230',
        nombre: 'Túnel de Manga YTM1230',
        cardDesc: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.',
        img: '3. Túnel de Manga YTM1230.png'
    },
    {
        clasificacion: 'tuneles',
        codigo: 'YT6040',
        nombre: 'Túnel de Encogimiento YT6040',
        cardDesc: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.',
        img: '4. Túnel de Encogimiento YT6040.png'
    },
    {
        clasificacion: 'tuneles',
        codigo: 'P6050',
        nombre: 'Túnel de Encogimiento P6050',
        cardDesc: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.',
        img: '5. Túnel de Encogimiento P6050.png'
    },
    {
        clasificacion: 'devekAir',
        codigo: 'DevekAir',
        nombre: 'Devek Air',
        cardDesc: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.',
        img: '1. Devek Air.png'
    },
    {
        clasificacion: 'accesorios',
        codigo: '50F1545',
        nombre: 'Banda Transportadora Flexible Extendible 50F1545',
        cardDesc: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.',
        img: '1. Banda Transportadora Flexible Extendible 50F1545.png'
    },
    {
        clasificacion: 'accesorios',
        codigo: '50B195',
        nombre: 'Banda Transportadora de Rodillos Libres 50B195',
        cardDesc: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.',
        img: '2. Banda Transportadora de Rodillos Libres 50B195.png'
    },
    {
        clasificacion: 'accesorios',
        codigo: 'Despachador de Escritorio',
        nombre: 'Despachador de Escritorio',
        cardDesc: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.',
        img: '3. Despachador de Escritorio.png'
    },
    {
        clasificacion: 'accesorios',
        codigo: 'Despachador de Cinta Gorila',
        nombre: 'Despachador de Cinta Gorila',
        cardDesc: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.',
        img: '4. Despachador de Cinta Gorila.png'
    },
    {
        clasificacion: 'accesorios',
        codigo: 'Aplicadores de Cinta de Empaque de Uso Ligero',
        nombre: 'Aplicadores de Cinta de Empaque de Uso Ligero',
        cardDesc: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.',
        img: '5. Aplicadores de Cinta de Empaque de Uso Ligero.png'
    },
    {
        clasificacion: 'accesorios',
        codigo: 'Aplicadores de Cinta de Empaque de Uso Rudo',
        nombre: 'Aplicadores de Cinta de Empaque de Uso Rudo',
        cardDesc: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.',
        img: '6. Aplicadores de Cinta de Empaque de Uso Rudo.png'
    },
    {
        clasificacion: 'accesorios',
        codigo: 'Aplicador de Película Strech',
        nombre: 'Aplicador de Película Strech',
        cardDesc: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.',
        img: '7. Aplicador de Película Strech.png'
    },
    {
        clasificacion: 'accesorios',
        codigo: 'Aplicador de Fleje Manual',
        nombre: 'Aplicador de Fleje Manual',
        cardDesc: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.',
        img: '8. Aplicador de Fleje Manual.png'
    },
    {
        clasificacion: 'accesorios',
        codigo: 'Equipo de Flejado Manual',
        nombre: 'Equipo de Flejado Manual',
        cardDesc: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.',
        img: '9. Equipo de Flejado Manual.png'
    },
]

respNav.style.display = "none";
navFixed.style.display = "none";
navFixed.style.width = width + "px";

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
    navFixed.style.width = width + "px";
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
        navFixed.style.display = "flex";
    } else {
        navFixed.style.display = "none";
    }
}

async function getNumberPages(elementsLength) {
    return Math.ceil(elementsLength / elementsPerPage);
}

async function getEquiposPerPage(page) {
    const initialPos = page === 1 ? 0 : page * elementsPerPage - elementsPerPage;
    const finalPos = initialPos + elementsPerPage < equiposSize ? initialPos + elementsPerPage : equiposSize;
    let equiposArray = equiposArr.slice(initialPos, finalPos);
    const equiposLength = equiposArray.length;
    if (equiposLength <  elementsPerPage) {
      for (let index = 0; index < elementsPerPage; index++) {
        const element = equiposArray[index];
        if (!element) {
          equiposArray.push({});
        }
      }
    }
    return equiposArray;
}

async function setPages(pages) {
    equiposPages = pages;
}

async function setEquipos(equiposToAssing) {
    equiposArr = equiposToAssing;
}

async function setEquiposCarousel() {
    if (JSON.stringify(equiposPage[0]) != '{}') {
        cardImg1.style.display = '';
        cardName1.style.display = '';
        cardDesc1.style.display = '';
        cardLink1.style.display = '';
        cardImg1.src = window.location.origin + assetFolder + equiposPage[0].img;
        cardImg1.alt = equiposPage[0].img;
        cardName1.innerText = equiposPage[0].nombre;
        cardDesc1.innerText = equiposPage[0].cardDesc;
    }
    else
    {
        cardImg1.style.display = 'none';
        cardName1.style.display = 'none';
        cardDesc1.style.display = 'none';
        cardLink1.style.display = 'none';
    }
    if (JSON.stringify(equiposPage[1]) != '{}') {
        cardImg2.style.display = '';
        cardName2.style.display = '';
        cardDesc2.style.display = '';
        cardLink2.style.display = '';
        cardImg2.src = assetFolder + equiposPage[1].img;
        cardImg2.alt = equiposPage[1].alt;
        cardName2.innerText = equiposPage[1].nombre;
        cardDesc2.innerText = equiposPage[1].cardDesc;
    }
    else
    {
        cardImg2.style.display = 'none';
        cardName2.style.display = 'none';
        cardDesc2.style.display = 'none';
        cardLink2.style.display = 'none';
    }
    if (JSON.stringify(equiposPage[2]) != '{}') {
        cardImg3.style.display = '';
        cardName3.style.display = '';
        cardDesc3.style.display = '';
        cardLink3.style.display = '';
        cardImg3.src = assetFolder + equiposPage[2].img;
        cardImg3.alt = equiposPage[2].alt;
        cardName3.innerText = equiposPage[2].nombre;
        cardDesc3.innerText = equiposPage[2].cardDesc;
    }
    else
    {
        cardImg3.style.display = 'none';
        cardName3.style.display = 'none';
        cardDesc3.style.display = 'none';
        cardLink3.style.display = 'none';
    }
    if (JSON.stringify(equiposPage[3]) != '{}') {
        cardImg4.style.display = '';
        cardName4.style.display = '';
        cardDesc4.style.display = '';
        cardLink4.style.display = '';
        cardImg4.src = assetFolder + equiposPage[3].img;
        cardImg4.alt = equiposPage[3].alt;
        cardName4.innerText = equiposPage[3].nombre;
        cardDesc4.innerText = equiposPage[3].cardDesc;
    }
    else
    {
        cardImg4.style.display = 'none';
        cardName4.style.display = 'none';
        cardDesc4.style.display = 'none';
        cardLink4.style.display = 'none';
    }
}

async function setAssetFolder(folder) {
    assetFolder = folder;
}

async function setEquiposSize(size) {
    equiposSize = size;
}

async function nextPage() {
    let productoPages = [];
    if(window.location.href.includes('MaquinariaDeEmpaque')){
        productoPages = MAQUINARIA_PAGES;
    }
    if(window.location.href.includes('ProductosDeEmpaque')){
        productoPages = PRODUCTOS_EMPAQUE_PAGES;
    }
    const productoIndex = window.location.href.lastIndexOf('/');
    const htmlIndex = window.location.href.indexOf('.html');
    const pagina = window.location.href.substring(productoIndex + 1, htmlIndex);
    const productoPagesIndex = productoPages.indexOf(pagina);
    if (productoPagesIndex == productoPages.length - 1) {
        window.location.href = productoPages[0] + '.html';
    } else {
        window.location.href = productoPages[productoPagesIndex + 1] + '.html';
    }
}
  
async function previousPage() {
    let productoPages = [];
    if(window.location.href.includes('MaquinariaDeEmpaque')){
        productoPages = MAQUINARIA_PAGES;
    }
    if(window.location.href.includes('ProductosDeEmpaque')){
        productoPages = PRODUCTOS_EMPAQUE_PAGES;
    }
    const productoIndex = window.location.href.lastIndexOf('/');
    const htmlIndex = window.location.href.indexOf('.html');
    const pagina = window.location.href.substring(productoIndex + 1, htmlIndex);
    const productoPagesIndex = productoPages.indexOf(pagina);
    if (productoPagesIndex == 0) {
        window.location.href = productoPages[productoPages.length - 1] + '.html';
    } else {
        window.location.href = productoPages[productoPagesIndex - 1] + '.html';
    }
}