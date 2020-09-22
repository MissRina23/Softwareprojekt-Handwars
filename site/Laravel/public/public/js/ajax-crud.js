document.addEventListener('DOMContentLoaded', function () {

    var url = "/game";

    id = window.location.pathname.split("/")[2];

    $("#id").keyup(function () {
        var regx = /^[A-Za-z0-9]+$/;
        var str = $.trim($("#id").val());
        if (regx.test(str)) {
	    if ($("#gamelink").hasClass("hovered")) { $("#gamelink").toggleClass("hovered"); }            
            $("#gamelink").html('Go <span>and join your friend</span>');
            $("#gamelink").attr("onclick", "location.href='https://handwars.de/game/" + $("#id").val() + "';");
        } else {
            if (!$("#gamelink").hasClass("hovered")) { $("#gamelink").toggleClass("hovered"); }
            $("#gamelink").html('Invalid join ID');
            $("#gamelink").attr("onclick", "location.href='#';");
        }
    });

    var check = 0;
    function checkPageReload() {
        if (performance.navigation.type == 1 && check === 0) {
            check = 1;
            return 1;
        }
        else {
        return 0;
        }
    }

    var x=0;


    function waitForData() {
        $.get(url + '/' + id + '/getStats', function (data) {

            gameHasPlayers = data.Spieler_1 != null && data.Spieler_2 != null;
            gameHasChoices = data.Choice_Spieler_1 != null && data.Choice_Spieler_2 != null;
            gameHasWinner = data.Winner != null;
            weAreTheHost = $("div.isHost").text() == 1;


            if (!gameHasPlayers) {
                //Wenn man auf der Namenseingabe Seite ist als Host gehts los
                console.log("Game waits for players");

                if (weAreTheHost) { //Wenn du Host bist
                    if ($.isEmptyObject(data)) { //Wenn du noch keinen Namen eingegeben hast
                        $('#joinModal').hide();
                        $('#spinnerwait').hide(); //Share Field
                        $('#spinner').hide();
                        $('#playerModal').show();
                    }
                    else { //Wenn du Host bist und einen Namen eingegeben hast
                        $('#playerModal').hide();
                        $('#joinModal').show();
                        $('#spinnerwait').show();
                    }
                } else { //Wenn du nicht der Host bist
                    if (data.Spieler_2 === null) { //Wenn Spieler2 noch keinen Namen entered hat
                        $('#spinnerwait').hide();
                        $('#spinner').hide();
                        $('#playerModal').show();
                    } else { //Wenn Spieler2 schon einen Namen eingegeben hat
                        $('#playerModal').hide();
                        $('#spinnerwait').show();
                    }
                }

                //IN DIESEM BLOCK HIER IST FOLGENDES PROBLEM: WENN BEIDE SPIELER ZUR FAST GLEICHEN ZEIT
                //EINE AUSWAHL TREFFEN; DANN BLEIBT DER EINE SPIELER SO LANGE BEIM WAITING TODESSTERB H�NGEN
                //BIS DER AJAX 30 SEK REQUEST WIEDER KOMMT --> FIXEN?!
                //Um das Problem zu l�sen, muss man wie gesagt warten oder F5 dr�cken, aber da gibt's doch sicher
                //ne automatische  Variante ;)

            }






            else if (!gameHasChoices) { //Wenn beide Spieler noch nicht ausgew�hlt haben
                $('#joinModal').hide();
                $('#playerModal').hide();
                $('#winnerModal').hide();
                $('#lose').hide();
                $('#win').hide();
                $('#draw').hide();
                $('#lukeDraw').hide();
                $('#vaderDraw').hide();
                $('#leia').hide();
                $('#stormtrooper').hide();
                $('#spinner').hide();
                $('#choiceModal').show(); //Handauswahl


                console.log("Game waits for choices");
                //Score Tabelle wird mit folgenden Methoden bef�llt
                getGamescore();
                setSpieler();
                if (weAreTheHost) { //Wenn ich der Host bin
                    if (data.Choice_Spieler_1 === null) { //Wenn Host noch keine Choice machte
                        $('#spinner').hide();
                    } else {  //Wenn Host eine Choice machte
                        $('#choiceModal').hide();
                        $('#spinner').show();  //Deathstar wait angezeigt
                        setTimeout(function () {
                            if(data.Choice_Spieler_2 != null) {
                                $('#choiceModal').hide();
                                $('#spinner').hide();
                                $('#winnerModal').show();
                            }
                        }, 1000);
                    }
                } else {
                    if (data.Choice_Spieler_2 === null) { //Noch keine Choice gemacht
                        $('#spinner').hide();
                    } else {
                        $('#choiceModal').hide();
                        $('#spinner').show();
                        setTimeout(function () {
                            if(data.Choice_Spieler_1 != null) {
                                $('#choiceModal').hide();
                                $('#spinner').hide();
                                $('#winnerModal').show();
                            }
                        }, 1000);
                    }//Ich bin nicht der Host, also Spieler2
                }
            }







            else if (gameHasWinner) { //Es gibt einen Gewinner
                $('#choiceModal').hide();
                if (checkPageReload() == 1) {
                $('#lose').hide();
                $('#win').hide();
                $('#draw').hide();
                $('#lukeDraw').hide();
                $('#vaderDraw').hide();
                $('#leia').hide();
                $('#stormtrooper').hide();
                $('#spinner').hide();
                }
                if (data.Winner === 'unentschieden') {
                    $('#draw').show();
                    $('#lukeDraw').show();
                    $('#vaderDraw').show();
                }
                else if (weAreTheHost) {
                    check_Spieler1(data.Winner);
                } else {
                    check_Spieler2(data.Winner);
                }




                //Dieser Block wird nur ausgef�hrt, wenn es noch kein Choice Bild im "Choice from..."-Div vorhanden ist
                // --> Also nur einmal! [Wichtig, um Ajax Fehler (Duplizieren der Bilder) zu verhindern]


                $("#Spieler_1_C > img").remove();
                $("#Spieler_2_C > img").remove();
                if (!(document.getElementById('Spieler_1_C').hasChildNodes() && document.getElementById('Spieler_2_C').hasChildNodes())
                    || (document.getElementById('Spieler_1_C').hasChildNodes() && document.getElementById('Spieler_2_C').hasChildNodes()) === null) {


                    switch (data.Choice_Spieler_1) {

                        case "stone":
                            var framePlayer1 = document.getElementById('Spieler_1_C');
                            var img = document.createElement('img');
                            img.src = '../public/img/steinor.png';
                            if (!framePlayer1.contains(img)) {
                                framePlayer1.appendChild(img);
                                break;

                            }
                        case "paper":
                            var framePlayer1 = document.getElementById('Spieler_1_C');
                            var img = document.createElement('img');
                            img.src = '../public/img/papieror.png';
                            if (!framePlayer1.contains(img)) {
                                framePlayer1.appendChild(img);
                                break;

                            }
                        case "scissors":
                            var framePlayer1 = document.getElementById('Spieler_1_C');
                            var img = document.createElement('img');
                            img.src = '../public/img/schereor.png';
                            if (!framePlayer1.contains(img)) {
                                framePlayer1.appendChild(img);
                                break;

                            }
                    }


                    switch (data.Choice_Spieler_2) {

                        case "stone":
                            var framePlayer2 = document.getElementById('Spieler_2_C');
                            var img2 = document.createElement('img');
                            img2.src = '../public/img/steinor.png';
                            if (!framePlayer2.contains(img2)) {
                                framePlayer2.appendChild(img2);
                                break;

                            }
                        case "paper":
                            var framePlayer2 = document.getElementById('Spieler_2_C');
                            var img2 = document.createElement('img');
                            img2.src = '../public/img/papieror.png';
                            if (!framePlayer2.contains(img2)) {
                                framePlayer2.appendChild(img2);
                                break;

                            }
                        case "scissors":
                            var framePlayer2 = document.getElementById('Spieler_2_C');
                            var img2 = document.createElement('img');
                            img2.src = '../public/img/schereor.png';
                            if (!framePlayer2.contains(img2)) {
                                framePlayer2.appendChild(img2);
                                break;

                            }
                    }
                }

                $('#spinner').hide();
//                timer = setTimeout(function () {
//
//               }, 10000);
                $('#winnerModal').show();


            }

            waitForData();
        });

        //var join = document.getElementById("joinModal").offsetLeft;
        //var choice = document.getElementById("playerModal").offsetLeft;
        //var spinnerDeathstar = document.getElementById("spinner").offsetLeft;
        //console.log(join);
        //console.log(choice);
        //console.log(spinnerDeathstar);
        //
        //if(join < 0 && choice < 0 && spinnerDeathstar < 0){
        //    alert("Div is hidden!!");
        //    console.log("divs hidden");
        //    setTimeout(function(){location.reload();}, 1000);
        //}
        //
        //function isHidden(el) {
        //    var style = window.getComputedStyle(el);
        //    return (style.display === 'none')
        //}




        timer = setInterval(function () {
        }, 30000);


    };

    waitForData();
    function getGamescore() {
        $.get(url + '/' + id + '/getScore', function (data) {
            $('#Spieler_1_W').text(data.Siege_Spieler_1);
            $('#Spieler_2_W').text(data.Siege_Spieler_2);
            $('#Draws').text(data.Unentschieden);
            document.getElementById("score").style.display = "block";
        });

        timer = setInterval(function () {
        }, 4000);

    };

    function check_Spieler1($winner) {
        $.get(url + '/' + id + '/getSpieler1', function (data) {
            if ($winner === data.username) {
                $('#spinner').hide();
                $('#win').show();
                $('#leia').show();
            } else {
                $('#spinner').hide();
                $('#lose').show();
                $('#stormtrooper').show();
            }
        })

    }

    function check_Spieler2($winner) {
        $.get(url + '/' + id + '/getSpieler2', function (data) {
            if ($winner === data.username) {
                $('#spinner').hide();
                $('#win').show();
                $('#leia').show();
            } else {
                $('#spinner').hide();
                $('#lose').show();
                $('#stormtrooper').show();
            }
        })
    }

    function setSpieler() {
        $.get(url + '/' + id + '/getSpieler1', function (data) {
            $('#Spieler_1').text(data.username);
            $('#Spieler1').text(data.username);

        });
        $.get(url + '/' + id + '/getSpieler2', function (data) {
            $('#Spieler_2').text(data.username);
            $('#Spieler2').text(data.username);

        });
        timer = setInterval(function () {
        }, 5000);

    }

    $('#join').bind('submit', function (event) {
        event.preventDefault();
        sendjoin();
    });

    $('#submit').bind('click', function (event) {
        event.preventDefault();
    });

    $('#submit').bind('submit', function (event) {
        event.preventDefault();
    });

    $('#id').bind('onpaste', function (event) {
        $("#gamelink").attr("value", "Let's start");
        $("#gamelink").attr("onclick", "location.href='https://handwars.de/game/" + $("#id").val() + "';");
    });

    $('#submitName').bind('click', function (event) {
        event.preventDefault();
        if ((document.forms["join"]["name"].value.trim().length) > 2) {
            sendjoin();
        }
        else {
            document.forms["join"]["name"].style.borderColor = "red";
            var infoMessage = document.getElementById("info");
            infoMessage.style.display = "block";
            infoMessage.innerHTML = "At least 3 characters!";
        }
    });









    function sendjoin() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        $.ajax({
            type: "POST",
            url: url + '/' + id + '/setPlayer',
            data: $('#join').serialize(),
            success: function (msg) {
                console.log("Ajax Befehl sendjoin");
                $("#playerModal").hide();
            },
            error: function () {

                var infoMessage = document.getElementById("info");


                var nameInput = document.forms["join"]["name"].value;


                if (nameInput.length > 15) { //Mehr als 15 Zeichen = ROT
                    document.forms["join"]["name"].style.borderColor = "red";
                    infoMessage.style.display = "block";
                    infoMessage.innerHTML = "Lower than 16 characters!";
                }
            }
        });
    };

    $(".handChoice").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault();

        $.ajax({
            type: "POST",
            url: url + '/' + id + '/setChoice',
            data: $('#choice').serialize(),
            success: function (msg) {
                console.log("Ajax Befehl wird ausgef�hrt von handchoice");
                $("#choiceModal").hide();

                var setting = 0;

                window.setInterval(function () {
                    var spinnerDeathstar = document.getElementById("spinner").style.display == "hidden";
                    //console.log("spinnerDeathstar " + spinnerDeathstar);
                    if (!spinnerDeathstar) {   //Problem ist nur, dass dieser wert IMMMMMMER TRUE IST!!!
                        //console.log("Spinner ist sichtbar");
                        if (gameHasWinner && setting === 0) { //Und hier wird nur ein m
                            //console.log("Spinner sichtbar und es gibt einen Sieger");

                            //setTimeout(function update() {
                                //console.log("Wach auf, es gibt nen Sieger!.");
                                setting = 1;
                            //    waitForData();
                            //}, 5000);
                        }
                    }
                    //else {
                    //    if (spinner == 1) {
                    //        //console.log("Spinner ist nicht sichtbar");
                    //
                    //        if (gameHasWinner) {
                    //            console.log("Spinner nicht sichtbar und es gibt einen Gewinner");
                    //
                    //            $("#choiceModal").hide();
                    //            $("#spinner").hide();
                    //            $("#winnerModal").show();
                    //        }
                    //        else {
                    //            //console.log("Spinner nicht sichtbar und KEIN Gewinner");
                    //
                    //            waitForData();
                    //        }
                    //    }
                    //}
                }, 10000);




                //window.setInterval(function(){
                //    if ($("#spinner:visible").length == 0) {
                //        setTimeout(waitForData(), 10000);
                //    }else{
                //        $("#answer").hide();
                //        $(".pleaseval").show();
                //    }
                //}, 5000);

                //window.setInterval(function(){
                //    if ($("#spinner:visible").length == 0) {
                //        setTimeout(function() {
                //            if(gameHasWinner) {
                //                $('#winnerModal').show();
                //            }
                //        }, 10000);
                //    }else{
                //       console.log("Wir warten gerne noch l�nger.");
                //    }
                //}, 5000);


            },
            error: function (msg) {
                console.log(msg);
                //alert("failure"); Hier werden die Fehlermeldungen gemacht!!!
            }
        });
    });


    $("#newGame").click(function (e) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }

        })

        e.preventDefault();
        $.ajax({
            type: "GET",
            url: url + '/' + id + '/newGame',
            success: function (msg) {
                console.log("AJAX NEW Game");
                $("#winnerModal").hide();
                $("#Spieler_1_C > img").remove();
                $("#Spieler_2_C > img").remove();
            },
            error: function (msg) {
                console.log(msg);
            }
        });

    });

});

