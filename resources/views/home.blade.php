<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Cidadão de Olho</title>
        <link rel="icon" href="{{ asset('img/icon.png') }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
        <script src="{{ asset('js/app.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('.collapse').on('show.bs.collapse', function () {
                    $('.collapse.show').each(function(){
                        $(this).collapse('hide');
                    });
                });
            });
        </script>
    </head>

    <header>
        <div class="navbar navbar-dark bg-dark shadow-sm">
            <div class="container d-flex justify-content-between">
                <a href="/" class="navbar-brand d-flex align-items-center">
                <strong>CIDADÃO DE OLHO</strong>
                </a>
                </button>
            </div>
        </div>
    </header>
    <body>
        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading mt-3">Cidadão de Olho</h1>
                <p class="lead text-muted">APIs desse site sendo consumidas:</p>
                <p>
                    <a class="btn btn-primary my-2" data-toggle="collapse" href="#collapse-gastadores" role="button" aria-expanded="false" aria-controls="collapse-gastadores">/api/gastadores</a>
                    <a class="btn btn-secondary my-2" data-toggle="collapse" href="#collapse-redesSociais" role="button" aria-expanded="false" aria-controls="collapse-redesSociais">/api/redesSociais</a>
                </p>
                <div class="collapse" id="collapse-gastadores">
                    <div class="card card-body list-group">
                        @foreach ($gastadores as $dep)
                            <a class="list-group-item-action center ml-2" data-toggle="list" id="list-gastadores-list" href="#list-gastadores" role="tab" aria-controls="gastadores">
                                <div class="textbox">
                                    <p class="alignleft"><strong>Nome:</strong> {{ $dep->nome }}</p>
                                    <p class="alignright"><strong>Gasto:</strong> R$ {{ number_format ($dep->gasto, 2) }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="collapse" id="collapse-redesSociais">
                    <div class="card card-body list-group">
                        @foreach ($redesMaisUsadas as $rede)
                            <a class="list-group-item-action center ml-2" data-toggle="list" id="list-gastadores-list" href="#list-gastadores" role="tab" aria-controls="gastadores">
                                <div class="textbox">
                                    <p class="alignleft"><strong>Nome:</strong> {{ $rede->nome }}</p>
                                    <p class="alignright"><strong>Usuários:</strong> {{ $rede->usuarios }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </body>
    </main>

    <footer class="text-muted">
        <div class="container text-center">
            <p>Desafio Técnico - Codificar Sistemas Tecnológicos</p>
            <p><a href="https://github.com/edujunqueira" target="_blank"><i class="fa fa-github" aria-hidden="true"></i> edujunqueira</a></p>
        </div>
    </footer>


</html>
