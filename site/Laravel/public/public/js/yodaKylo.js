//Yoda SCHWEBT, sobald man mit der Maus über "Start a game" geht

var bigScreenSize = window.matchMedia("(min-width: 601px)");
var startBtn = document.getElementById("startButton");
var yoda = document.getElementById("yoda");

var joinBtn = document.getElementById("joinButton");
var kylo = document.getElementById("kyloren");


startBtn.addEventListener('mouseover', yodaHoverBig);

function yodaHoverBig() {

    if(bigScreenSize.matches) {
        yoda.style.animation = "yodaHoverBigScreen 2.5s infinite alternate";
    }
    else {
        yoda.style.animation = "yodaHoverSmallScreen 2.5s infinite alternate";
    }
}
//Yoda HÖRT AUF ZU SCHWEBEN, sobald man mit der Maus weg von "Start a game" geht
startBtn.addEventListener('mouseout', endYodaHover);
function endYodaHover() {
    yoda.style.animation = "0";
}


//KYLOREN ANIMATION
joinBtn.addEventListener('mouseover', kyloHover);
function kyloHover() {
    kylo.style.transition = "all 1s linear";
    kylo.style["-webkit-filter"] = "drop-shadow(15px 0px 25px rgba(185, 34, 34, 0.71))";
}

//Kylo End Animation sobald MouseOver zu Ende
joinBtn.addEventListener('mouseout', endKyloHover);
function endKyloHover() {
    kylo.style["-webkit-filter"] = "";
    window.setTimeout(deactivateTransition,1000);
}
function deactivateTransition() {
    kylo.style.transition = "";
}





