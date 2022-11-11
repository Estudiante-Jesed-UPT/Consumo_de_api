<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <title>Rick and Morty</title>
</head>
<body>
    <div class="p-2 bg-black">
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link active text-light" aria-current="page" href="personajes.php">Personajes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-light" href="Episodios.php">Episodios</a>
                </li>
            </ul>
    </div>
    <div class="text-center">
       <p class="display-1 fw-bold fst-italic"> Rick and Morty </p> 
    </div>

    <?php
        $epi = curl_init();
        curl_setopt($epi, CURLOPT_URL,"https://rickandmortyapi.com/api/episode/1"); 
        curl_setopt($epi, CURLOPT_RETURNTRANSFER,true);
        $episodio = curl_exec($epi);
        curl_close($epi);
        $episo=json_decode($episodio ,true);
        $episod = $episo['characters'];

        echo"<div class='text-center'>
                <p class='display-4 fw-bold fst-italic'>Capitulo: $episo[name]</p>
             </div>";
    ?>

    
    <!-- Espacio para poder mostrar el nombre del espisodio -->
    <div class="container">
        <div class="row ">
            <div class="col-8 mt-5 d-flex flex-wrap">
                <?php
                    // curl de episodios
                    
                    // se creo un nuevo curl para poder acceder a la localizacion de cada personaje, pasando la variable del foreach a un nuevo curl
                    foreach($episod as $person){
                        $ch1 = curl_init(); 
                        curl_setopt($ch1, CURLOPT_URL,$person);
                        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
                        $data1 = curl_exec($ch1);
                        curl_close($ch1);
                        $per=json_decode($data1, true);
                                               
                        echo"<div class='  col-12 col-mb-6 col-lg-4 col-xl-4  rounded border-4'>
                            <div class='card mb-3 mt-3 ms-3 me-3'> 
                                <img class=' mt-2 rounded-4' src='$per[image]'>
                                <div class='card-body'> 
                                    <button type='button' class='btn btn-light text-success form-control mb-4 rounded' data-bs-toggle='modal' data-bs-target=#target$per[id]> Detalles </button>
                                    <div class='modal fade' id=target$per[id] data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='modal' aria-hidden='true'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>
                                                <div class='modal-header modalT'>
                                                    <h1 class='modal-title fs-5 text-dark' id='modal'>Detalles</h1>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>
                                                <div class='modal-body modalF text-center'>
                                                    <p class=' text-light mt-1 fs-5 fw-bold'>Nombre: $per[name] </p>
                                                    <p class=' text-light mt-1 fs-5 fw-bold'>ID: $per[id] </p>
                                                    <p class=' text-light mt-1 fs-5 fw-bold'> Estatus: $per[status]</p>
                                                    <p class=' text-light mt-1 fs-5 fw-bold'>Specie: $per[species]</p>
                                                    <p class=' text-light mt-1 fs-5 fw-bold'>Gender: $per[gender]</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";

                    }
                    
                ?>
            </div>
               <!-- En esta etiqueta de php es utilizada para poder generar los personajes de forma aleatoria -->
            <?php
                 $tipo = rand(1, 826);
                 $tipo2 = rand(1, 826);
                 $tipo3 = rand(1, 826);
                 //curl de personajes aleatorio
                 $ch = curl_init(); 
                 curl_setopt($ch, CURLOPT_URL,"https://rickandmortyapi.com/api/character/"."[".$tipo.",".$tipo2.",".$tipo3."]");
                 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                 $data = curl_exec($ch);
                 curl_close($ch);
                 $personajes = json_decode($data);
            ?>
            <div class="col-4 mt-5">
                <?php
                     foreach($personajes as $personaje){ 
                        echo"<div class='text-center container border rounded fondo mb-4 '>";
                            echo"<img class='rounded-4 mt-4 mb-4' src='$personaje->image'>";
                            echo"<button type='button' class='btn btn-light form-control mb-4 rounded text-success' data-bs-toggle='modal' data-bs-target=#target$personaje->id> Detalles </button>";
                            echo"<div class='modal fade' id=target$personaje->id data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>";
                               echo"<div class='modal-dialog' > 
                                        <div class='modal-content'>
                                            <div class='modal-header modalT'>
                                            <h1 class='modal-title fs-5' id='staticBackdropLabel'>Detalles</h1>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body modalF'>
                                                <p class='mt-1 fs-5 text-light fw-bold'>Nombre:  $personaje->name </p>
                                                <p class='mt-1 fs-5 text-light fw-bold'>ID: $personaje->id </p>
                                                <p class='mt-1 fs-5 text-light fw-bold'> Estatus: $personaje->status</p>
                                                <p class='mt-1 fs-5 text-light fw-bold'>Specie: $personaje->species</p>
                                                <p class='mt-1 fs-5 text-light fw-bold'>Gender: $personaje->gender</p>
                                            </div>
                                        </div>
                                    </div>";
                            echo"</div>";
                        echo"</div>";
                    }
                ?>
            </div>
            </div>
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
