@extends('main')

@section('content')
    <div class="container">
        <p>Der Gewinner ist :</p>
        <?php $winner = DB::table('games')->where('url', $id)->value('Winner');
        echo $winner;
        ?>
    </div>

    <button>Noch eine Runde</button>
@stop