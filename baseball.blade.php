<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <table border="1">
        <tr id="header"><th>ID</th><th>Name</th><th><a href="{{route('sort',['sort'=>'game'])}}">Games</a></th><th><a href="{{route('sort',['sort'=>'batter'])}}">Batter</a></th><th><a href="{{route('sort',['sort'=>'ip'])}}">IP</a></th><th><a href="{{route('sort',['sort'=>'so'])}}">SO</a></th>
        <th><a href="{{route('sort',['sort'=>'bb'])}}">BB</a></th><th><a href="{{route('sort',['sort'=>'ib'])}}">IBB</a></th><th><a href="{{route('sort',['sort'=>'db'])}}">DB</a></th><th><a href="{{route('sort',['sort'=>'hit'])}}">Hit</a></th><th><a href="{{route('sort',['sort'=>'hr'])}}">HR</a></th><th><a href="{{route('sort',['sort'=>'wild'])}}">Wild pitch</a></th><th><a href="{{route('sort',['sort'=>'k9'])}}">K9</a></th>
        <th><a href="{{route('sort',['sort'=>'bb9'])}}">BB9</a></th><th><a href="{{route('sort',['sort'=>'hr9'])}}">HR9</a></th><th><a href="{{route('sort',['sort'=>'fip'])}}">FIP</a></th><th><a href="{{route('sort',['sort'=>'babip'])}}">BABIP</a></th></tr>
        @foreach ($items as $item)
            <tr>
            {{--
                <td><?php var_dump($item); ?></td>
            --}}    
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->game}}</td>
                <td>{{$item->batter}}</td>
                <td>{{$item->ip}}</td>
                <td>{{$item->so}}</td>
                <td>{{$item->bb}}</td>
                <td>{{$item->ib}}</td>
                <td>{{$item->db}}</td>
                <td>{{$item->hit}}</td>
                <td>{{$item->hr}}</td>
                <td>{{$item->wild}}</td>
                <td>{{$item->k9}}</td>
                <td>{{$item->bb9}}</td>
                <td>{{$item->hr9}}</td>
                <td>{{$item->fip}}</td>
                <td>{{$item->babip}}</td>
                
            </tr>
        @endforeach
    </table>

    
</body>
</html>
