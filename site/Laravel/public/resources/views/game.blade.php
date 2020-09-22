@extends('main')

@section('css')
    <link href="{!! asset('public/css/gameStart.css') !!}" rel="stylesheet" type="text/css"/>
@stop

@section('content')

    <?php $url = substr(str_shuffle(MD5(microtime())), 0, 6);
    ?>
    <div id="inhalt">

        <div id="score">
            <div id="table" class="center-block">
                <table class="table">
                    <tr>
                        <td class="lightSpalte">Wins <br><b><span class="lightWhite" id="Spieler_1"></span></b></td>
                        <td class="lightSpalte">Draws</td>
                        <td class="lightSpalte">Wins <br><b><span class="lightWhite" id="Spieler_2"></span></b></td>
                    </tr>
                    <tr>
                        <td><b><span class="points" id="Spieler_1_W"></span></b></td>
                        <td><b><span class="points" id="Draws"></span></b></td>
                        <td><b><span class="points" id="Spieler_2_W"></span></b></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="isHost" style="display:none">{{ Session::get($id) }}</div>

        <div class="container">
            <div id="spinner" class="spinner text-center" style="display:none;">
                <div id="waitingPageContent">
                    <div id="whiteText">Wait for your opponent's choice</div>
                    <img id="deathstar" src="{{secure_asset('public/img/starpics/death.gif')}}">
                </div>
            </div>
        </div>
        <div class="container" id="joinModal">
            <div id="spinnerwait" class="spinner" style="display:none;">
                <br>

                <div id="whiteText">Share this link & wait for your friend</div>
                <div class="form-wrapper cf">
                    <p id="copied"></p>
                    <input type="text" id="sharelinkInput" value="handwars.de/game/{{$id}}" readonly>
                    <button id="cptButton" class="btn" data-clipboard-action="copy"
                            data-clipboard-target="#sharelinkInput">
                        <span class="glyphicon glyphicon-copy">Copy</span>
                    </button>
                </div>
                <img id="hanniUndNanni" src="{{secure_asset('public/img/starpics/HanAndChewie.png')}}">

                <script src="{!! asset('public/js/clipboard.min.js') !!}"></script>
                <script>
                    var clipboard = new Clipboard('.btn');
                    clipboard.on('success', function (e) {
                        console.log(e);
                        var copiedMessage = document.getElementById("copied");
                        copiedMessage.style.display = "block";
                        copiedMessage.innerHTML = "Copied to clipboard!";

                        document.getElementById("sharelinkInput").addEventListener("blur", removeCopiedMessage);
                        function removeCopiedMessage() {
                            var copiedMessage = document.getElementById("copied");
                            copiedMessage.style.display = "none";
                        }
                    });
                    clipboard.on('error', function (e) {
                        console.log(e);
                    });
                </script>


                <div class="addthis_inline_share_toolbox"></div>

            </div>
        </div>
        <div class="container" style="display:none;" id="playerModal">
            <div id="nameQuestionContent" class="jumbotron" style="background:transparent;">
                <p id="info"></p>

                <div id="whatsYourName">What's your name?</div>
                <form name="join" id="join">
                    <div class="form-group center-block">
                        <input autocomplete="off" placeholder='3 to 15 characters' onkeypress="if (event.keyCode == 13) return false;" name="name" id="name" type="text"
                               required>
                    </div>
                    <div class="form-group center-block">
                        <button id="submitName">Let's start <span>the game</span></button>
                    </div>
                </form>
            </div>
            <img id="skywalker" src="{{secure_asset('public/img/starpics/Luke.png')}}">
        </div>

        <div class="container" style="display:none;" id="choiceModal">
            <div class="jumbotron" style="background:transparent;">
                <form id="choice">
                    <div id="choiceText">Choose your hand:</div>
                    <div id="hands" class="form-group center-block">
                        <label>
                            <input class="handChoice" id="schere" type="radio" name="wahl" value="schere"/>
                            <img class="smallHands" id="Schere" src="{{secure_asset('public/img/schereor.png')}}">
                        </label>
                        <label>
                            <input class="handChoice" id="stein" type="radio" name="wahl" value="stein"/>
                            <img class="smallHands" id="Stein" src="{{secure_asset('public/img/steinor.png')}}">
                        </label>
                        <label>
                            <input class="handChoice" id="papier" type="radio" name="wahl" value="papier"/>
                            <img class="smallHands" id="Papier" src="{{secure_asset('public/img/papieror.png')}}">
                        </label>
                    </div>
                </form>
            </div>
        </div>

        <div class="container" style="display:none;" id="winnerModal">
            <div style="background:transparent;">
                <form id="winnerForm">
                    <div class="form-group center-block">
                        <img id="draw" src="{{secure_asset('public/img/draw.png')}}" alt="DRAW">
                        <img class="loser" id="lose" src="{{secure_asset('public/img/youlose.png')}}" alt="YOU LOSE">
                        <img id="win" src="{{secure_asset('public/img/youwin.png')}}" alt="YOU WIN">

                        <div id="choiceResult">
                            <p id="playerAuswahl1" class="choiceResult">Choice from <span id="Spieler1"></span> : <span
                                        id="Spieler_1_C"></span></p>

                            <p id="playerAuswahl2" class="choiceResult">Choice from <span id="Spieler2"></span>: <span
                                        id="Spieler_2_C"></span></p>
                        </div>
                    </div>
                    <div class="form-group center-block">
                        <button id="newGame">Play again</button>
                    </div>
                </form>
            </div>
            <img id="lukeDraw" src="{{secure_asset('public/img/starpics/lukeDraw.png')}}">
            <img id="vaderDraw" src="{{secure_asset('public/img/starpics/vaderDraw.png')}}">
            <img id="leia" src="{{secure_asset('public/img/starpics/Leia.png')}}">
            <img id="stormtrooper" class="Alex" src="{{secure_asset('public/img/starpics/stormtrooper.png')}}">
        </div>

    </div>
@stop

@section('javascript')
    <script type="text/javascript" src="{!! asset('public/js/game.js') !!}"></script>
@stop
