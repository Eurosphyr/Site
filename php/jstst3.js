var sL = document.getElementById("setaL");
var sR = document.getElementById("setaR");
var tX1 = document.querySelector(".tSN");
var tX2 = document.querySelector(".tSP");
var tX3 = document.querySelector(".tSSN");
var tP = document.querySelector(".prof");
var tN = document.querySelector(".nos");
var tS = document.querySelector(".somos");
var explic1 = document.querySelector(".explic1");
var explic2 = document.querySelector(".explic2");
var tela = 2;
function mudarL() {
    if (tela == 2) {
        tX1.style.transform = "translateX(300px)";
        tX1.style.opacity = "0";
        tN.style.transform = "translateX(300px)";
        tN.style.opacity = "0";
        sL.style.opacity = "0";
        sL.style.opacity = "0";
        sR.style.opacity = "1";
        tX2.style.transform = "translateX(0)";
        tX2.style.opacity = "1";
        tP.style.opacity = "1";
        tP.style.transform = "translate(120px)";
        tP.style.zIndex = "3";
        tN.style.zIndex = "0";
        explic1.style.transform = "translateX(400px)";
        explic2.style.transform = "translateX(0)";
        explic1.style.opacity = "0";
        explic2.style.opacity = "1";
        tela = 1;
    }
    else if (tela == 3) {
        tN.style.transform = "translateX(0)";
        tN.style.opacity = "1";
        tX1.style.transform = "translateX(0)";
        tX1.style.opacity = "1";
        tX3.style.transform = "translateX(300px)";
        tX3.style.opacity = "0";
        sR.style.opacity = "1";
        explic1.style.opacity = "1";
        explic2.style.opacity = "0";
        explic2.style.transform = "translateX(0)";
        explic1.style.transform = "translateX(0)";
        tS.style.transform = "translateX(300px)";
        tS.style.opacity = "0";
        tN.style.zIndex = "3";
        tS.style.zIndex = "0";
        tela = 2;
    }
}

function mudarR() {
    if (tela == 2) {

        tX1.style.opacity = "0";
        tN.style.transform = "translateX(-300px)";
        tN.style.opacity = "0";
        tX1.style.transform = "translateX(-300px)";
        tX1.style.opacity = "0";
        tX3.style.transform = "translateX(0px)";
        tX3.style.opacity = "1";
        sR.style.opacity = "0";
        explic1.style.opacity = "0";
        explic1.style.transform = "translateX(-400px)";
        tS.style.transform = "translateX(100px)";
        tS.style.opacity = "1";
        tS.style.zIndex = "3";
        tN.style.zIndex = "0";
        tela = 3;
    }
    else if (tela == 1) {
        tX1.style.opacity = "1";
        tX1.style.transform = "translateX(0)";
        tN.style.transform = "translateX(0)";
        tN.style.opacity = "1";
        sL.style.opacity = "1";
        tX2.style.transform = "translateX(-300)";
        tX2.style.opacity = "0";
        tX1.style.transform = "translateX(0)";
        tX1.style.opacity = "1";
        tP.style.opacity = "0";
        tP.style.transform = "translate(0)";
        tN.style.zIndex = "3";
        tP.style.zIndex = "0";
        explic1.style.transform = "translateX(0)";
        explic2.style.transform = "translateX(-400px)"
        explic2.style.opacity = "0";
        explic1.style.opacity = "1";
        
        tela = 2;
    }
}

sR.addEventListener("click", mudarR);

sL.addEventListener("click", mudarL);
