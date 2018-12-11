<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('app.name') }}</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
        <main class="d-flex flex-column align-items-center justify-content-center">
            <div class="container d-flex justify-content-center align-items-center m-4">
                <form class="form-inline" action="/show" method="POST">
                    @csrf

                    <div class="form-group">
                        <label class="mx-2" for="query">Hashtags: </label>
                        <input class="mx-2 form-control" type="text" name="query" id="query" placeholder="Ex: #fiat #carronovo">
                        <button class="mx-2 btn btn-sm" type="submit"> Procurar</button>
                        <a href="/"> Limpar</a>
                    </div>
                </form>
            </div>
            <div class="container">
                @if (isset($messages))
                    @foreach ($messages as $message)
                        <div class="card m-2 border">
                            <div class="card-body">
                                <h5 class="card-title">{{ $message['user']}} 
                                    @if (!empty($message['url']))
                                        <a href="{{ $message['url'] }}">link</a>
                                    @endif
                                </h4>
                                <p class="card-text">
                                    {{ $message['text'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
       </main>
    </body>
</html>
