//Bei WhatsyourName Abfrage - Check, Ob weniger als 16 Zeichen

document.getElementsByName("join")[0].addEventListener('input', changeBorder);

function changeBorder() {
    var infoMessage = document.getElementById("info");
    var nameInput = document.forms["join"]["name"].value;

    if (nameInput.length > 15) { //Mehr als 15 Zeichen = ROT
        infoMessage.style.display = "block";
        infoMessage.innerHTML = "Lower than 16 characters!";
        document.forms["join"]["name"].style.borderColor = "red";
    }
    else if ((((nameInput.trim().length) > 0) && (nameInput.trim().length) < 3) || (nameInput.trim().length) == 0) {
        document.forms["join"]["name"].style.borderColor = "red";
    }

    if (((nameInput.length < 16))) {
        if (infoMessage.innerHTML == "Lower than 16 characters!") infoMessage.style.display = "none";
        if ((((nameInput.trim().length > 2) && nameInput.trim().length < 16) || nameInput === "")) {
            document.forms["join"]["name"].style.borderColor = "#ffff33";
            infoMessage.style.display = "none";
        }
    }
}


//Wenn man den Input verl�sst

document.getElementsByName("join")[0].addEventListener('focusout', doWegBorder);

function doWegBorder() {
    var nameInput = document.forms["join"]["name"].value;
    var infoMessage = document.getElementById("info");

    if ((nameInput.length < 16) && nameInput.trim().length > 0) {
        if (((nameInput.trim().length > 2) && (nameInput.trim().length < 16) || (nameInput.trim().length) == 0)) {
            document.forms["join"]["name"].style.borderColor = "";
            infoMessage.style.display = "none";
            document.forms["join"]["name"].style.borderColor = "#ffff33";
        }
    }
}

