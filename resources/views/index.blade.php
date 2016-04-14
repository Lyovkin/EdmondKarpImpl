<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Алгоритм Эдмондса - Карпа</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2 class="title">Алгоритм нахождения максимальной стоимости пути Эдмондса - Карпа.</h2>
    <hr />
    <div class="col-md-12 col-md-offset-3">
        <form class="form-inline" role="form" method="GET" action="/">
            <div class="form-group">
                <label for="start">Начало пути:</label>
                <select name="start" class="form-control" id="start">
                    @foreach($names as $key => $name)
                        <option value="{{$name}}">{{$name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="end">Конец пути:</label>
                <select name="end" class="form-control" id="end">
                    @foreach($names as $key => $name)
                        <option value="{{$name}}">{{$name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-default">Выполнить</button>
        </form>
        @if(isset($max))
            <h4 style="margin-left: 60px;">Максимальная стоимость пути: <span class="badge"> {{ $max }}</span></h4>
        @endif
        @if(isset($in) && (isset($out)))
            <h4 style="margin-left: 90px;">Путь следования из <strong>{{ $out }}</strong> в <strong>{{ $in }}</strong></h4>
        @endif
    </div>
    <div class="row">
        <div class="col-md-9 col-md-offset-2">
            <img src="{{ $startGraph }}" height="750px" >
            {{-- <img src="{{ $residualGraph }}" >--}}
            @if(isset($endGraph))
                <img src="{{ $endGraph }}" height="750px" style="margin-left: 110px;" >
            @endif
        </div>
    </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>