<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <title>personajes</title>
</head>
<body>
    <div class="p-2 bg-black">
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link active text-light" aria-current="page" href="index.php">Home</a>
            </li>
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

   
    <div class="container">
        <div class="row">
            <div class="col-8 border rounded border-4 mt-5">
                <h1 class="mt-5 text-center"><p> Personaje</p></h1>
                <!-- Elemento para mandar a llamar los personajes -->
                <div>
                    <form action="personajes.php" method="post">
                        <input class="form-control" type="number"  min="1" max="826" name="NumPerson" placeholder="Ingresa el id del personaje a buscar" required>
                        <input type="submit" class=" mt-4 btn btn-success" value="Buscar " >
                    </form>
                </div>
                <?php
                    $recibir = $_POST["NumPerson"];

                    echo"<p class='fw-bold fst-italic display-6 mt-4'> El ID del personaje que buscaste es: $recibir </p>";

                    $Lop = curl_init();
                    curl_setopt($Lop, CURLOPT_URL, "https://rickandmortyapi.com/api/character/".$recibir);
                    curl_setopt($Lop, CURLOPT_RETURNTRANSFER, true);
                    $cache = curl_exec($Lop);
                    curl_close($Lop);
                    $vis = json_decode($cache);

                    echo"<div class='fondo'> 
                            <center>
                                <img class=' mt-4 rounded ' src='$vis->image'>
                                <div class=' text-light fw-bold fst-italic display-6 mt-4'> Nombre: $vis->name  </div>
                                <div class=' text-light fw-bold fst-italic display-6 mt-4'>Id: $vis->id  </div>
                                <div class=' text-light fw-bold fst-italic display-6 mt-4'>Estatus: $vis->status  </div>
                                <div class=' text-light fw-bold fst-italic display-6 mt-4 mb-5 '>Genero: $vis->gender  </div> 
                            </center>
                        </div>";
                    

                   
                ?>
            </div>
            <div class="col-4 mt-5 ">
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
            
                <?php
                     foreach($personajes as $personaje){ 
                        echo"<div class='text-center container border rounded modalF mb-4 '>";
                            echo"<img class='rounded-4 mt-4 mb-4' src='$personaje->image'>";
                            echo"<button type='button' class='btn btn-light text-success form-control mb-4 rounded' data-bs-toggle='modal' data-bs-target=#target$personaje->id> Detalles </button>";
                            echo"<div class='modal fade' id=target$personaje->id data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>";
                               echo"<div class='modal-dialog' > 
                                        <div class='modal-content'>
                                            <div class='modal-header modalT'>
                                            <h1 class='modal-title fs-5' id='staticBackdropLabel'>Detalles</h1>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body modalF'>
                                                <p class='text-light mt-1 fs-5 fw-bold'>Nombre:  $personaje->name </p>
                                                <p class='text-light mt-1 fs-5 fw-bold'>ID: $personaje->id </p>
                                                <p class='text-light mt-1 fs-5 fw-bold'> Estatus: $personaje->status</p>
                                                <p class='text-light mt-1 fs-5 fw-bold'>Specie: $personaje->species</p>
                                                <p class='text-light mt-1 fs-5 fw-bold'>Gender: $personaje->gender</p>
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