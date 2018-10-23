<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enviar</title>
</head>
<body>
    @if($tarea->isNotEmpty())
        {{  $tarea[0]->protocolo->protocolo . ';'  .  $tarea[0]->id }}
    @endif
</body>
</html>