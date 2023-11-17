var f1 = document.getElementById("f1");
var f2 = document.getElementById("f2");
var f3 = document.getElementById("f3");
var f4 = document.getElementById("f4");
var f5 = document.getElementById("f5");
var s1 = document.querySelector(".sobreD1");
var s2 = document.querySelector(".sobreD2");
var s3 = document.querySelector(".sobreD3");
var s4 = document.querySelector(".sobreD4");
var s5 = document.querySelector(".sobreD5");
var posd = 3;
var pos1 = 1;
var pos2 = 2;
var pos3 = 3;
var pos4 = 4;
var pos5 = 5;

function moverposd1D() {
    f1.style.transform = "translateX(608.4px)";
    f1.style.opacity = "1";
    s1.style.opacity = "1";
    s1.style.left = "32%";
    if (posd == 2) {
        if (pos1 == 1) {
            f2.style.transform = "translateX(-304.2px) scale(0.8)";
            f2.style.opacity = "0.2";
            s2.style.left = "0%";
        }
        else if (pos1 == 2) {
            f2.style.transform = "translateX(0) scale(0.9)";
            f2.style.opacity = "0.6";
            s2.style.left = "0%";
        }
        else if (pos1 == 4) {
            f2.style.transform = "translateX(608.6px) scale(0.9)";
            f2.style.opacity = "0.6";
            s2.style.left = "63%";
        }
        else if (pos1 == 5) {
            f2.style.transform = "translateX(912.8px) scale(0.8)";
            f2.style.opacity = "0.2";
            s2.style.left = "63%";
        }
        s2.style.opacity = "0";
        pos2 = pos1;
    }
    else if (posd == 3) {
        if (pos1 == 1) {
            f3.style.transform = "translateX(-608.4px) scale(0.8)";
            f3.style.opacity = "0.2";
            s3.style.left = "0%";
        }
        else if (pos1 == 2) {
            f3.style.transform = "translateX(-304.2px) scale(0.9)";
            f3.style.opacity = "0.6";
            s3.style.left = "0%";
        }
        else if (pos1 == 4) {
            f3.style.transform = "translateX(304.2px) scale(0.9)";
            f3.style.opacity = "0.6";
            s3.style.left = "63%";
        }
        else if (pos1 == 5) {
            f3.style.transform = "translateX(608.6px) scale(0.8)";
            f3.style.opacity = "0.2";
            s3.style.left = "63%";
        }
        s3.style.opacity = "0";
        pos3 = pos1;
    }
    else if (posd == 4) {
        if (pos1 == 1) {
            f4.style.transform = "translateX(-912.8px) scale(0.8)";
            f4.style.opacity = "0.2";
            s4.style.left = "0%";
        }
        else if (pos1 == 2) {
            f4.style.transform = "translateX(-608.6px) scale(0.9)";
            f4.style.opacity = "0.6";
            s4.style.left = "0%";
        }
        else if (pos1 == 4) {
            f4.style.transform = "translateX(0) scale(0.9)";
            f4.style.opacity = "0.6";
            s4.style.left = "63%";
        }
        else if (pos1 == 5) {
            f4.style.transform = "translateX(304.2px) scale(0.8)";
            f4.style.opacity = "0.2";
            s4.style.left = "63%";
        }
        s4.style.opacity = "0";
        pos4 = pos1;
    }
    else if (posd == 5) {
        if (pos1 == 1) {
            f5.style.transform = "translateX(-1217px) scale(0.8)";
            f5.style.opacity = "0.2";
            s5.style.left = "0%";
        }
        else if (pos1 == 2) {
            f5.style.transform = "translateX(-912.8px) scale(0.9)";
            f5.style.opacity = "0.6";
            s5.style.left = "0%";
        }
        else if (pos1 == 4) {
            f5.style.transform = "translateX(-304.2px) scale(0.9)";
            f5.style.opacity = "0.6";
            s5.style.left = "63%";
        }
        else if (pos1 == 5) {
            f5.style.transform = "translateX(0) scale(0.8)";
            f5.style.opacity = "0.2";
            s5.style.left = "63%";
        }
        pos5 = pos1;
        s5.style.opacity = "0";
    }
    pos1 = 3;
    posd = 1;
}

function moverposd2D() {
    f2.style.transform = "translateX(304.2px)";
    f2.style.opacity = "1";
    s2.style.opacity = "1";
    s2.style.left = "32%";
    if (posd == 1) {
        if (pos2 == 1) {
            f1.style.transform = "translateX(0) scale(0.8)";
            f1.style.opacity = "0.2";
            s1.style.left = "0%";
        }
        else if (pos2 == 2) {
            f1.style.transform = "translateX(304.2px) scale(0.9)";
            f1.style.opacity = "0.6";
            s1.style.left = "0%";
        }
        else if (pos2 == 4) {
            f1.style.transform = "translateX(912.8px) scale(0.9)";
            f1.style.opacity = "0.6";
            s1.style.left = "63%";
        }
        else if (pos2 == 5) {
            f1.style.transform = "translateX(1217px) scale(0.8)";
            f1.style.opacity = "0.2";
            s1.style.left = "63%";
        }
        s1.style.opacity = "0";
        pos1 = pos2;
    }
    else if (posd == 3) {
        if (pos2 == 1) {
            f3.style.transform = "translateX(-608.6px) scale(0.8)";
            f3.style.opacity = "0.2";
            s3.style.left = "0%";
        }
        else if (pos2 == 2) {
            f3.style.transform = "translateX(-304.2px) scale(0.9)";
            f3.style.opacity = "0.6";
            s3.style.left = "0%";
        }
        else if (pos2 == 4) {
            f3.style.transform = "translateX(304.2px) scale(0.9)";
            f3.style.opacity = "0.6";
            s3.style.left = "63%";
        }
        else if (pos2 == 5) {
            f3.style.transform = "translateX(608.6px) scale(0.8)";
            f3.style.opacity = "0.2";
            s3.style.left = "63%";
        }
        pos3 = pos2;
        s3.style.opacity = "0";
    }
    else if (posd == 4) {
        if (pos2 == 1) {
            f4.style.transform = "translateX(-912.8px) scale(0.8)";
            f4.style.opacity = "0.2";
            s4.style.left = "0%";
        }
        else if (pos2 == 2) {
            f4.style.transform = "translateX(-608.6px) scale(0.9)";
            f4.style.opacity = "0.6";
            s4.style.left = "0%";
        }
        else if (pos2 == 4) {
            f4.style.transform = "translateX(0) scale(0.9)";
            f4.style.opacity = "0.6";

            s4.style.left = "63%";
        }
        else if (pos2 == 5) {
            f4.style.transform = "translateX(304.2px) scale(0.8)";
            f4.style.opacity = "0.2";

            s4.style.left = "63%";
        }
        pos4 = pos2;
        s4.style.opacity = "0";
    }
    else if (posd == 5) {
        if (pos2 == 1) {
            f5.style.transform = "translateX(-1217px) scale(0.8)";
            f5.style.opacity = "0.2";
            s5.style.left = "0%";
        }
        else if (pos2 == 2) {
            f5.style.transform = "translateX(-912.8px) scale(0.9)";
            f5.style.opacity = "0.6";
            s5.style.left = "0%";
        }
        else if (pos2 == 4) {
            f5.style.transform = "translateX(-304.2px) scale(0.9)";
            f5.style.opacity = "0.6";
            s5.style.left = "63%";
        }
        else if (pos2 == 5) {
            f5.style.transform = "translateX(0) scale(0.8)";
            f5.style.opacity = "0.2";
            s5.style.left = "63%";
        }
        pos5 = pos2;
        s5.style.opacity = "0";
    }
    pos2 = 3;
    posd = 2;
}

function moverposd3D() {
    f3.style.transform = "translateX(0)";
    f3.style.opacity = "1";
    s3.style.opacity = "1";
    s3.style.left = "32%";
    if (posd == 1) {
        if (pos3 == 1) {
            f1.style.transform = "translateX(0) scale(0.8)";
            f1.style.opacity = "0.2";
            s1.style.left = "0%";
        }
        else if (pos3 == 2) {
            f1.style.transform = "translateX(304.2px) scale(0.9)";
            f1.style.opacity = "0.6";
            s1.style.left = "0%";
        }
        else if (pos3 == 4) {
            f1.style.transform = "translateX(912.8px) scale(0.9)";
            f1.style.opacity = "0.6";
            s1.style.left = "63%";
        }
        else if (pos3 == 5) {
            f1.style.transform = "translateX(1217px) scale(0.8)";
            f1.style.opacity = "0.2";
            s1.style.left = "63%";
        }
        pos1 = pos3;
        s1.style.opacity = "0";
    }
    else if (posd == 2) {
        if (pos3 == 1) {
            f2.style.transform = "translateX(-304.2px) scale(0.8)";
            f2.style.opacity = "0.2";
            s2.style.left = "0%";
        }
        else if (pos3 == 2) {
            f2.style.transform = "translateX(0) scale(0.9)";
            f2.style.opacity = "0.6";
            s2.style.left = "0%";
        }
        else if (pos3 == 4) {
            f2.style.transform = "translateX(608.6px) scale(0.9)";
            f2.style.opacity = "0.6";
            s2.style.left = "63%";
        }
        else if (pos3 == 5) {
            f2.style.transform = "translateX(912.8px) scale(0.8)";
            f2.style.opacity = "0.2";
            s2.style.left = "63%";
        }
        pos2 = pos3;
        s2.style.opacity = "0";
    }
    else if (posd == 4) {
        if (pos3 == 1) {
            f4.style.transform = "translateX(-912.8px) scale(0.8)";
            f4.style.opacity = "0.2";
            s4.style.left = "0%";
        }
        else if (pos3 == 2) {
            f4.style.transform = "translateX(-608.6px) scale(0.9)";
            f4.style.opacity = "0.6";
            s4.style.left = "0%";
        }
        else if (pos3 == 4) {
            f4.style.transform = "translateX(0) scale(0.9)";
            f4.style.opacity = "0.6";
            s4.style.left = "63%";
        }
        else if (pos3 == 5) {
            f4.style.transform = "translateX(304.2px) scale(0.8)";
            f4.style.opacity = "0.2";
            s4.style.left = "63%";
        }
        pos4 = pos3;
        s4.style.opacity = "0";
    }
    else if (posd == 5) {
        if (pos3 == 1) {
            f5.style.transform = "translateX(-1217px) scale(0.8)";
            f5.style.opacity = "0.2";
            s5.style.left = "0%";
        }
        else if (pos3 == 2) {
            f5.style.transform = "translateX(-912.8px) scale(0.9)";
            f5.style.opacity = "0.6";
            s5.style.left = "0%";
        }
        else if (pos3 == 4) {
            f5.style.transform = "translateX(-304.4px) scale(0.9)";
            f5.style.opacity = "0.6";
            s5.style.left = "63%";
        }
        else if (pos3 == 5) {
            f5.style.transform = "translateX(0) scale(0.8)";
            f5.style.opacity = "0.2";
            s5.style.left = "63%";
        }
        pos5 = pos3;
        s5.style.opacity = "0";
    }
    pos3 = 3;
    posd = 3;
}

function moverposd4D() {
    f4.style.transform = "translateX(-304.2px)";
    f4.style.opacity = "1";
    s4.style.opacity = "1";
    s4.style.left = "32%";
    if (posd == 1) {
        if (pos4 == 1) {
            f1.style.transform = "translateX(0) scale(0.8)";
            f1.style.opacity = "0.2";
            s1.style.left = "0%";
        }
        else if (pos4 == 2) {
            f1.style.transform = "translate(304.2px) scale(0.9)";
            f1.style.opacity = "0.6";
            s1.style.left = "0%";
        }
        else if (pos4 == 4) {
            f1.style.transform = "translateX(912.8px) scale(0.9)";
            f1.style.opacity = "0.6";
            s1.style.left = "0%";
        }
        else if (pos4 == 5) {
            f1.style.transform = "translateX(1217px) scale(0.8)";
            f1.style.opacity = "0.2";
            s1.style.left = "63%";
        }
        pos1 = pos4;
        s1.style.opacity = "0";
    }
    else if (posd == 2) {
        if (pos4 == 1) {
            f2.style.transform = "translateX(-304.2px) scale(0.8)";
            f2.style.opacity = "0.2";
            s2.style.left = "0%";
        }
        else if (pos4 == 2) {
            f2.style.transform = "translateX(0) scale(0.9)";
            f2.style.opacity = "0.6";
            s2.style.left = "0%";
        }
        else if (pos4 == 4) {
            f2.style.transform = "translateX(608.6px) scale(0.9)";
            f2.style.opacity = "0.6";
            s2.style.left = "63%";
        }
        else if (pos4 == 5) {
            f2.style.transform = "translateX(912.8px) scale(0.8)";
            f2.style.opacity = "0.2";
            s2.style.left = "63%";
        }
        pos2 = pos4;
        s2.style.opacity = "0";
    }
    else if (posd == 3) {
        if (pos4 == 1) {
            f3.style.transform = "translateX(-608.6px) scale(0.8)";
            f3.style.opacity = "0.2";
            s3.style.left = "0%";
        }
        else if (pos4 == 2) {
            f3.style.transform = "translateX(-304.2px) scale(0.9)";
            f3.style.opacity = "0.6";
            s3.style.left = "0%";
        }
        else if (pos4 == 4) {
            f3.style.transform = "translateX(304.4px) scale(0.9)";
            f3.style.opacity = "0.6";
            s3.style.left = "63%";
        }
        else if (pos4 == 5) {
            f3.style.transform = "translateX(608.6px) scale(0.8)";
            f3.style.opacity = "0.2";
            s3.style.left = "63%";
        }
        pos3 = pos4;
        s3.style.opacity = "0";
    }
    else if (posd == 5) {
        if (pos4 == 1) {
            f5.style.transform = "translateX(-1217px) scale(0.8)";
            f5.style.opacity = "0.2";
            s5.style.left = "0%";
        }
        else if (pos4 == 2) {
            f5.style.transform = "translateX(-912.8px) scale(0.9)";
            f5.style.opacity = "0.6";
            s5.style.left = "0%";
        }
        else if (pos4 == 4) {
            f5.style.transform = "translateX(-304.4px) scale(0.9)";
            f5.style.opacity = "0.6";
            s5.style.left = "63%";
        }
        else if (pos4 == 5) {
            f5.style.transform = "translateX(0) scale(0.8)";
            f5.style.opacity = "0.2";
            s5.style.left = "63%";
        }
        pos5 = pos4;
        s5.style.opacity = "0";
    }
    pos4 = 3;
    posd = 4;
}

function moverposd5D() {
    f5.style.transform = "translateX(-608.6px)";
    f5.style.opacity = "1";
    s5.style.opacity = "1";
    s5.style.left = "32%";
    if (posd == 1) {
        if (pos5 == 1) {
            f1.style.transform = "translateX(0) scale(0.8)";
            f1.style.opacity = "0.2";
            s1.style.left = "0%";
        }
        else if (pos5 == 2) {
            f1.style.transform = "translateX(304.2px) scale(0.9)";
            f1.style.opacity = "0.6";
            s1.style.left = "0%";
        }
        else if (pos5 == 4) {
            f1.style.transform = "translateX(912.8px) scale(0.9)";
            f1.style.opacity = "0.6";
            s1.style.left = "63%";
        }
        else if (pos5 == 5) {
            f1.style.transform = "translateX(1217px) scale(0.8)";
            f1.style.opacity = "0.2";
            s1.style.left = "63%";
        }
        pos1 = pos5;
        s1.style.opacity = "0";
    }
    else if (posd == 2) {
        if (pos5 == 1) {
            f2.style.transform = "translateX(-304.2px) scale(0.8)";
            f2.style.opacity = "0.2";
            s2.style.left = "0%";
        }
        else if (pos5 == 2) {
            f2.style.transform = "translateX(0) scale(0.9)";
            f2.style.opacity = "0.6";
            s2.style.left = "0%";
        }
        else if (pos5 == 4) {
            f2.style.transform = "translateX(608.6px) scale(0.9)";
            f2.style.opacity = "0.6";
            s2.style.left = "63%";
        }
        else if (pos5 == 5) {
            f2.style.transform = "translateX(912.8px) scale(0.8)";
            f2.style.opacity = "0.2";
            s2.style.left = "63%";
        }
        pos2 = pos5;
        s2.style.opacity = "0";
    }
    else if (posd == 3) {
        if (pos5 == 1) {
            f3.style.transform = "translateX(-608.6px) scale(0.8)";
            f3.style.opacity = "0.2";
            s3.style.left = "0%";
        }
        else if (pos5 == 2) {
            f3.style.transform = "translateX(-304.2px) scale(0.9)";
            f3.style.opacity = "0.6";
            s3.style.left = "0%";
        }
        else if (pos5 == 4) {
            f3.style.transform = "translateX(304.2px) scale(0.9)";
            f3.style.opacity = "0.6";
            s3.style.left = "63%";
        }
        else if (pos5 == 5) {
            f3.style.transform = "translateX(608.6px) scale(0.8)";
            f3.style.opacity = "0.2";
            s3.style.left = "63%";
        }
        pos3 = pos5;
        s3.style.opacity = "0";
    }
    else if (posd == 4) {
        if (pos5 == 1) {
            f4.style.transform = "translateX(-912.8px) scale(0.8)";
            f4.style.opacity = "0.2";
            s4.style.left = "0%";
        }
        else if (pos5 == 2) {
            f4.style.transform = "translateX(-608.6px) scale(0.9)";
            f4.style.opacity = "0.6";
            s4.style.left = "0%";
        }
        else if (pos5 == 4) {
            f4.style.transform = "translateX(0) scale(0.9)";
            f4.style.opacity = "0.6";
            s4.style.left = "63%";
        }
        else if (pos5 == 5) {
            f4.style.transform = "translateX(304.2px) scale(0.8)";
            f4.style.opacity = "0.2";
            s4.style.left = "63%";
        }
        pos4 = pos5;
        s4.style.opacity = "0";
    }
   
    pos5 = 3;
    posd = 5;
}

f5.addEventListener("click", moverposd5D)

f4.addEventListener("click", moverposd4D);

f3.addEventListener("click", moverposd3D);

f2.addEventListener("click", moverposd2D);

f1.addEventListener("click", moverposd1D);