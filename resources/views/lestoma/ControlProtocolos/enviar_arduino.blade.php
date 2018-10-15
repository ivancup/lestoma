<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enviar</title>
</head>
<body>
    @if(isset($tarea))
        {{ $tarea[0]->id . ','  . $tarea[0]->protocolo->protocolo}}
    @endif
</body>
</html>