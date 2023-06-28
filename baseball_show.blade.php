<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
  @if($item != null)
    <table>
        <tr><th>Player ID: </th><td>{{$item->playerID}}</td></tr>
        <tr><th>Lastname: </th><td>{{$item->lastname}}</td></tr>
        <tr><th>Firstname: </th><td>{{$item->firstname}}</td></tr>
        <tr><th>IP: </th><td>{{$item->ip}}</td></tr>
        <tr><th>BB: </th><td>{{$item->bb}}</td></tr>
        <tr><th>SO: </th><td>{{$item->so}}</td></tr>
        <tr><th>DB: </th><td>{{$item->db}}</td></tr>
        <tr><th>HR: </th><td>{{$item->hr}}</td></tr>
        <tr><th>FIP: </th><td>{{$item->fip}}</td></tr>
    </table>
    @else
      There is no record.
    @endif
</body>
</html>
