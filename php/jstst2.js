var fp1 = document.getElementById("p1");
var fp2 = document.getElementById("p2");
var fp3 = document.getElementById("p3");
var fp4 = document.getElementById("p4");
var fp5 = document.getElementById("p5");
var p1 = document.querySelector(".sobreP1");
var p2 = document.querySelector(".sobreP2");
var p3 = document.querySelector(".sobreP3");
var p4 = document.querySelector(".sobreP4");
var p5 = document.querySelector(".sobreP5");
var meio = 3;
var pop1 = 1;
var pop2 = 2;
var pop3 = 3;
var pop4 = 4;
var pop5 = 5;

function moverMeio1D() {
    fp1.style.transform = "translateX(608.4px)";
    fp1.style.opacity = "1";
    p1.style.opacity = "1";
    p1.style.left = "32%";
    if (meio == 2) {
        if (pop1 == 1) {
            fp2.style.transform = "translateX(-304.2px) scale(0.8)";
            fp2.style.opacity = "0.2";
            p2.style.left = "0%";
        }
        else if (pop1 == 2) {
            fp2.style.transform = "translateX(0) scale(0.9)";
            fp2.style.opacity = "0.6";
            p2.style.left = "0%";
        }
        else if (pop1 == 4) {
            fp2.style.transform = "translateX(608.6px) scale(0.9)";
            fp2.style.opacity = "0.6";
            p2.style.left = "63%";
        }
        else if (pop1 == 5) {
            fp2.style.transform = "translateX(912.8px) scale(0.8)";
            fp2.style.opacity = "0.2";
            p2.style.left = "63%";
        }
        p2.style.opacity = "0";
        pop2 = pop1;
    }
    else if (meio == 3) {
        if (pop1 == 1) {
            fp3.style.transform = "translateX(-608.4px) scale(0.8)";
            fp3.style.opacity = "0.2";
            p3.style.left = "0%";
        }
        else if (pop1 == 2) {
            fp3.style.transform = "translateX(-304.2px) scale(0.9)";
            fp3.style.opacity = "0.6";
            p3.style.left = "0%";
        }
        else if (pop1 == 4) {
            fp3.style.transform = "translateX(304.2px) scale(0.9)";
            fp3.style.opacity = "0.6";
            p3.style.left = "63%";
        }
        else if (pop1 == 5) {
            fp3.style.transform = "translateX(608.6px) scale(0.8)";
            fp3.style.opacity = "0.2";
            p3.style.left = "63%";
        }
        p3.style.opacity = "0";
        pop3 = pop1;
    }
    else if (meio == 4) {
        if (pop1 == 1) {
            fp4.style.transform = "translateX(-912.8px) scale(0.8)";
            fp4.style.opacity = "0.2";
            p4.style.left = "0%";
        }
        else if (pop1 == 2) {
            fp4.style.transform = "translateX(-608.6px) scale(0.9)";
            fp4.style.opacity = "0.6";
            p4.style.left = "0%";
        }
        else if (pop1 == 4) {
            fp4.style.transform = "translateX(0) scale(0.9)";
            fp4.style.opacity = "0.6";
            p4.style.left = "63%";
        }
        else if (pop1 == 5) {
            fp4.style.transform = "translateX(304.2px) scale(0.8)";
            fp4.style.opacity = "0.2";
            p4.style.left = "63%";
        }
        p4.style.opacity = "0";
        pop4 = pop1;
    }
    else if (meio == 5) {
        if (pop1 == 1) {
            fp5.style.transform = "translateX(-1217px) scale(0.8)";
            fp5.style.opacity = "0.2";
            p5.style.left = "0%";
        }
        else if (pop1 == 2) {
            fp5.style.transform = "translateX(-912.8px) scale(0.9)";
            fp5.style.opacity = "0.6";
            p5.style.left = "0%";
        }
        else if (pop1 == 4) {
            fp5.style.transform = "translateX(-304.2px) scale(0.9)";
            fp5.style.opacity = "0.6";
            p5.style.left = "63%";
        }
        else if (pop1 == 5) {
            fp5.style.transform = "translateX(0) scale(0.8)";
            fp5.style.opacity = "0.2";
            p5.style.left = "63%";
        }
        pop5 = pop1;
        p5.style.opacity = "0";
    }
    pop1 = 3;
    meio = 1;
}

function moverMeio2D() {
    fp2.style.transform = "translateX(304.2px)";
    fp2.style.opacity = "1";
    p2.style.opacity = "1";
    p2.style.left = "32%";
    if (meio == 1) {
        if (pop2 == 1) {
            fp1.style.transform = "translateX(0) scale(0.8)";
            fp1.style.opacity = "0.2";
            p1.style.left = "0%";
        }
        else if (pop2 == 2) {
            fp1.style.transform = "translateX(304.2px) scale(0.9)";
            fp1.style.opacity = "0.6";
            p1.style.left = "0%";
        }
        else if (pop2 == 4) {
            fp1.style.transform = "translateX(912.8px) scale(0.9)";
            fp1.style.opacity = "0.6";
            p1.style.left = "63%";
        }
        else if (pop2 == 5) {
            fp1.style.transform = "translateX(1217px) scale(0.8)";
            fp1.style.opacity = "0.2";
            p1.style.left = "63%";
        }
        p1.style.opacity = "0";
        pop1 = pop2;
    }
    else if (meio == 3) {
        if (pop2 == 1) {
            fp3.style.transform = "translateX(-608.6px) scale(0.8)";
            fp3.style.opacity = "0.2";
            p3.style.left = "0%";
        }
        else if (pop2 == 2) {
            fp3.style.transform = "translateX(-304.2px) scale(0.9)";
            fp3.style.opacity = "0.6";
            p3.style.left = "0%";
        }
        else if (pop2 == 4) {
            fp3.style.transform = "translateX(304.2px) scale(0.9)";
            fp3.style.opacity = "0.6";
            p3.style.left = "63%";
        }
        else if (pop2 == 5) {
            fp3.style.transform = "translateX(608.6px) scale(0.8)";
            fp3.style.opacity = "0.2";
            p3.style.left = "63%";
        }
        pop3 = pop2;
        p3.style.opacity = "0";
    }
    else if (meio == 4) {
        if (pop2 == 1) {
            fp4.style.transform = "translateX(-912.8px) scale(0.8)";
            fp4.style.opacity = "0.2";
            p4.style.left = "0%";
        }
        else if (pop2 == 2) {
            fp4.style.transform = "translateX(-608.6px) scale(0.9)";
            fp4.style.opacity = "0.6";
            p4.style.left = "0%";
        }
        else if (pop2 == 4) {
            fp4.style.transform = "translateX(0) scale(0.9)";
            fp4.style.opacity = "0.6";

            p4.style.left = "63%";
        }
        else if (pop2 == 5) {
            fp4.style.transform = "translateX(304.2px) scale(0.8)";
            fp4.style.opacity = "0.2";

            p4.style.left = "63%";
        }
        pop4 = pop2;
        p4.style.opacity = "0";
    }
    else if (meio == 5) {
        if (pop2 == 1) {
            fp5.style.transform = "translateX(-1217px) scale(0.8)";
            fp5.style.opacity = "0.2";
            p5.style.left = "0%";
        }
        else if (pop2 == 2) {
            fp5.style.transform = "translateX(-912.8px) scale(0.9)";
            fp5.style.opacity = "0.6";
            p5.style.left = "0%";
        }
        else if (pop2 == 4) {
            fp5.style.transform = "translateX(-304.2px) scale(0.9)";
            fp5.style.opacity = "0.6";
            p5.style.left = "63%";
        }
        else if (pop2 == 5) {
            fp5.style.transform = "translateX(0) scale(0.8)";
            fp5.style.opacity = "0.2";
            p5.style.left = "63%";
        }
        pop5 = pop2;
        p5.style.opacity = "0";
    }
    pop2 = 3;
    meio = 2;
}

function moverMeio3D() {
    fp3.style.transform = "translateX(0)";
    fp3.style.opacity = "1";
    p3.style.opacity = "1";
    p3.style.left = "32%";
    if (meio == 1) {
        if (pop3 == 1) {
            fp1.style.transform = "translateX(0) scale(0.8)";
            fp1.style.opacity = "0.2";
            p1.style.left = "0%";
        }
        else if (pop3 == 2) {
            fp1.style.transform = "translateX(304.2px) scale(0.9)";
            fp1.style.opacity = "0.6";
            p1.style.left = "0%";
        }
        else if (pop3 == 4) {
            fp1.style.transform = "translateX(912.8px) scale(0.9)";
            fp1.style.opacity = "0.6";
            p1.style.left = "63%";
        }
        else if (pop3 == 5) {
            fp1.style.transform = "translateX(1217px) scale(0.8)";
            fp1.style.opacity = "0.2";
            p1.style.left = "63%";
        }
        pop1 = pop3;
        p1.style.opacity = "0";
    }
    else if (meio == 2) {
        if (pop3 == 1) {
            fp2.style.transform = "translateX(-304.2px) scale(0.8)";
            fp2.style.opacity = "0.2";
            p2.style.left = "0%";
        }
        else if (pop3 == 2) {
            fp2.style.transform = "translateX(0) scale(0.9)";
            fp2.style.opacity = "0.6";
            p2.style.left = "0%";
        }
        else if (pop3 == 4) {
            fp2.style.transform = "translateX(608.6px) scale(0.9)";
            fp2.style.opacity = "0.6";
            p2.style.left = "63%";
        }
        else if (pop3 == 5) {
            fp2.style.transform = "translateX(912.8px) scale(0.8)";
            fp2.style.opacity = "0.2";
            p2.style.left = "63%";
        }
        pop2 = pop3;
        p2.style.opacity = "0";
    }
    else if (meio == 4) {
        if (pop3 == 1) {
            fp4.style.transform = "translateX(-912.8px) scale(0.8)";
            fp4.style.opacity = "0.2";
            p4.style.left = "0%";
        }
        else if (pop3 == 2) {
            fp4.style.transform = "translateX(-608.6px) scale(0.9)";
            fp4.style.opacity = "0.6";
            p4.style.left = "0%";
        }
        else if (pop3 == 4) {
            fp4.style.transform = "translateX(0) scale(0.9)";
            fp4.style.opacity = "0.6";
            p4.style.left = "63%";
        }
        else if (pop3 == 5) {
            fp4.style.transform = "translateX(304.2px) scale(0.8)";
            fp4.style.opacity = "0.2";
            p4.style.left = "63%";
        }
        pop4 = pop3;
        p4.style.opacity = "0";
    }
    else if (meio == 5) {
        if (pop3 == 1) {
            fp5.style.transform = "translateX(-1217px) scale(0.8)";
            fp5.style.opacity = "0.2";
            p5.style.left = "0%";
        }
        else if (pop3 == 2) {
            fp5.style.transform = "translateX(-912.8px) scale(0.9)";
            fp5.style.opacity = "0.6";
            p5.style.left = "0%";
        }
        else if (pop3 == 4) {
            fp5.style.transform = "translateX(-304.4px) scale(0.9)";
            fp5.style.opacity = "0.6";
            p5.style.left = "63%";
        }
        else if (pop3 == 5) {
            fp5.style.transform = "translateX(0) scale(0.8)";
            fp5.style.opacity = "0.2";
            p5.style.left = "63%";
        }
        pop5 = pop3;
        p5.style.opacity = "0";
    }
    pop3 = 3;
    meio = 3;
}

function moverMeio4D() {
    fp4.style.transform = "translateX(-304.2px)";
    fp4.style.opacity = "1";
    p4.style.opacity = "1";
    p4.style.left = "32%";
    if (meio == 1) {
        if (pop4 == 1) {
            fp1.style.transform = "translateX(0) scale(0.8)";
            fp1.style.opacity = "0.2";
            p1.style.left = "0%";
        }
        else if (pop4 == 2) {
            fp1.style.transform = "translate(304.2px) scale(0.9)";
            fp1.style.opacity = "0.6";
            p1.style.left = "0%";
        }
        else if (pop4 == 4) {
            fp1.style.transform = "translateX(912.8px) scale(0.9)";
            fp1.style.opacity = "0.6";
            p1.style.left = "63%";
        }
        else if (pop4 == 5) {
            fp1.style.transform = "translateX(1217px) scale(0.8)";
            fp1.style.opacity = "0.2";
            p1.style.left = "63%";
        }
        pop1 = pop4;
        p1.style.opacity = "0";
    }
    else if (meio == 2) {
        if (pop4 == 1) {
            fp2.style.transform = "translateX(-304.2px) scale(0.8)";
            fp2.style.opacity = "0.2";
            p2.style.left = "0%";
        }
        else if (pop4 == 2) {
            fp2.style.transform = "translateX(0) scale(0.9)";
            fp2.style.opacity = "0.6";
            p2.style.left = "0%";
        }
        else if (pop4 == 4) {
            fp2.style.transform = "translateX(608.6px) scale(0.9)";
            fp2.style.opacity = "0.6";
            p2.style.left = "63%";
        }
        else if (pop4 == 5) {
            fp2.style.transform = "translateX(912.8px) scale(0.8)";
            fp2.style.opacity = "0.2";
            p2.style.left = "63%";
        }
        pop2 = pop4;
        p2.style.opacity = "0";
    }
    else if (meio == 3) {
        if (pop4 == 1) {
            fp3.style.transform = "translateX(-608.6px) scale(0.8)";
            fp3.style.opacity = "0.2";
            p3.style.left = "0%";
        }
        else if (pop4 == 2) {
            fp3.style.transform = "translateX(-304.2px) scale(0.9)";
            fp3.style.opacity = "0.6";
            p3.style.left = "0%";
        }
        else if (pop4 == 4) {
            fp3.style.transform = "translateX(304.4px) scale(0.9)";
            fp3.style.opacity = "0.6";
            p3.style.left = "63%";
        }
        else if (pop4 == 5) {
            fp3.style.transform = "translateX(608.6px) scale(0.8)";
            fp3.style.opacity = "0.2";
            p3.style.left = "63%";
        }
        pop3 = pop4;
        p3.style.opacity = "0";
    }
    else if (meio == 5) {
        if (pop4 == 1) {
            fp5.style.transform = "translateX(-1217px) scale(0.8)";
            fp5.style.opacity = "0.2";
            p5.style.left = "0%";
        }
        else if (pop4 == 2) {
            fp5.style.transform = "translateX(-912.8px) scale(0.9)";
            fp5.style.opacity = "0.6";
            p5.style.left = "0%";
        }
        else if (pop4 == 4) {
            fp5.style.transform = "translateX(-304.4px) scale(0.9)";
            fp5.style.opacity = "0.6";
            p5.style.left = "63%";
        }
        else if (pop4 == 5) {
            fp5.style.transform = "translateX(0) scale(0.8)";
            fp5.style.opacity = "0.2";
            p5.style.left = "63%";
        }
        pop5 = pop4;
        p5.style.opacity = "0";
    }
    pop4 = 3;
    meio = 4;
}

function moverMeio5D() {
    fp5.style.transform = "translateX(-608.6px)";
    fp5.style.opacity = "1";
    p5.style.opacity = "1";
    p5.style.left = "32%";
    if (meio == 1) {
        if (pop5 == 1) {
            fp1.style.transform = "translateX(0) scale(0.8)";
            fp1.style.opacity = "0.2";
            p1.style.left = "0%";
        }
        else if (pop5 == 2) {
            fp1.style.transform = "translateX(304.2px) scale(0.9)";
            fp1.style.opacity = "0.6";
            p1.style.left = "0%";
        }
        else if (pop5 == 4) {
            fp1.style.transform = "translateX(912.8px) scale(0.9)";
            fp1.style.opacity = "0.6";
            p1.style.left = "63%";
        }
        else if (pop5 == 5) {
            fp1.style.transform = "translateX(1217px) scale(0.8)";
            fp1.style.opacity = "0.2";
            p1.style.left = "63%";
        }
        pop1 = pop5;
        p1.style.opacity = "0";
    }
    else if (meio == 2) {
        if (pop5 == 1) {
            fp2.style.transform = "translateX(-304.2px) scale(0.8)";
            fp2.style.opacity = "0.2";
            p2.style.left = "0%";
        }
        else if (pop5 == 2) {
            fp2.style.transform = "translateX(0) scale(0.9)";
            fp2.style.opacity = "0.6";
            p2.style.left = "0%";
        }
        else if (pop5 == 4) {
            fp2.style.transform = "translateX(608.6px) scale(0.9)";
            fp2.style.opacity = "0.6";
            p2.style.left = "63%";
        }
        else if (pop5 == 5) {
            fp2.style.transform = "translateX(912.8px) scale(0.8)";
            fp2.style.opacity = "0.2";
            p2.style.left = "63%";
        }
        pop2 = pop5;
        p2.style.opacity = "0";
    }
    else if (meio == 3) {
        if (pop5 == 1) {
            fp3.style.transform = "translateX(-608.6px) scale(0.8)";
            fp3.style.opacity = "0.2";
            p3.style.left = "0%";
        }
        else if (pop5 == 2) {
            fp3.style.transform = "translateX(-304.2px) scale(0.9)";
            fp3.style.opacity = "0.6";
            p3.style.left = "0%";
        }
        else if (pop5 == 4) {
            fp3.style.transform = "translateX(304.2px) scale(0.9)";
            fp3.style.opacity = "0.6";
            p3.style.left = "63%";
        }
        else if (pop5 == 5) {
            fp3.style.transform = "translateX(608.6px) scale(0.8)";
            fp3.style.opacity = "0.2";
            p3.style.left = "63%";
        }
        pop3 = pop5;
        p3.style.opacity = "0";
    }
    else if (meio == 4) {
        if (pop5 == 1) {
            fp4.style.transform = "translateX(-912.8px) scale(0.8)";
            fp4.style.opacity = "0.2";
            p4.style.left = "0%";
        }
        else if (pop5 == 2) {
            fp4.style.transform = "translateX(-608.6px) scale(0.9)";
            fp4.style.opacity = "0.6";
            p4.style.left = "0%";
        }
        else if (pop5 == 4) {
            fp4.style.transform = "translateX(0) scale(0.9)";
            fp4.style.opacity = "0.6";
            p4.style.left = "63%";
        }
        else if (pop5 == 5) {
            fp4.style.transform = "translateX(304.2px) scale(0.8)";
            fp4.style.opacity = "0.2";
            p4.style.left = "63%";
        }
        pop4 = pop5;
        p4.style.opacity = "0";
    }
   
    pop5 = 3;
    meio = 5;
}

fp5.addEventListener("click", moverMeio5D)

fp4.addEventListener("click", moverMeio4D);

fp3.addEventListener("click", moverMeio3D);

fp2.addEventListener("click", moverMeio2D);

fp1.addEventListener("click", moverMeio1D);