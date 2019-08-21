<!DOCTYPE html>
<html lang="fr">
    <head>
    <meta charset="utf-8"/>
        <meta name="Descritpion" content="Blog de l'écrivain Jean Forteroche"/>
        <meta name="Author" content="Benjamin Monteiro Da Silva"/>
        <meta name="keywords" content="Voyages, livre, roman"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Jean_Forteroche.com</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"/>
        <link rel="stylesheet" href="public\css\accueil.css"/>
        <link rel="stylesheet" href="public\css\authorPage.css"/>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
    <body>
        <header class="mb-5">
            <nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">
                <a class="navbar-brand mr-5" href='/?page=Accueil&method=display'>Jean Forteroche Blog</a>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="collapsibleNavId">
                    <ul class="navbar-nav mr-0 ml-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="/?page=Accueil&method=display">Accueil<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Chapitres</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownId">
                                <a class="dropdown-item" href="/?page=chapitre1&method=display">Chapitre 1</a>
                                <a class="dropdown-item" href="/?page=chapitre2&method=display">Chapitre 2</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-nowrap" href="/?page=author&method=display">A propos de l'auteur</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/?page=contact&method=display">Contact</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <?php
            echo $content;
        ?>
        
    </body>
</html>



