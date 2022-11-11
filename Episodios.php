<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="estilos.css"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <title>Episodios Rick and Morty</title>
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
                 <?php
                $conta=1;
                if (isset($_GET ['Siguiente']) ){
                    //Incrementamos el valor
                    if($_GET['conta'] == 51){
                        $conta=51;
                    }
                    else{
                        $conta += $_GET['conta'];
                    }
                }

                if (isset($_GET ['Regresar']) ){
                    //Disminuimos el valor
                    if($_GET['conta1'] == 1){
                        $conta=1;
                    }
                    else{
                        $conta = $_GET['conta1'] ;
                        $conta-=1;
                    }
                }
            
                ?>
                <form action="Episodios.php" method="get">
                   
                    <div class="input-group-text mt-4 form-control border border-0 text-center bg-dark">
                    <span class=" form-control text-succes border border-0 text-center bg-light">Numero de episodio</span>
                    <input type="text" class="input-group-text  border border-0 border-trasparetn text-center bg-light" name="conta" value="<?php echo $conta?>"> 
                    <!-- <label for="" value="" class="input-group-text  border border-0 border-trasparetn text-center bg-light" name="conta" ><?php echo $conta?></label> -->
                    </div>
                    <input type="submit" class="btn btn-dark mt-3" name="Siguiente" value="Siguiente">
                </form>

                <form action="Episodios.php" method="get">
                    <input type="text" style="display:none"class="input-group-text  border border-0 border-trasparetn text-center bg-light" name="conta1" id="conta1" value="<?php echo $conta?>"> 
                    <input type="submit" class="btn btn-dark mt-3" name="Regresar" value="Regresar" > 
                </form>
                
                <?php
                    $epi = curl_init();
                    curl_setopt($epi, CURLOPT_URL,"https://rickandmortyapi.com/api/episode/".$conta); 
                    curl_setopt($epi, CURLOPT_RETURNTRANSFER,true);
                    $episodio = curl_exec($epi);
                    curl_close($epi);
                    $episo=json_decode($episodio ,true);
                    $episod = $episo['characters'];

                    // echo $episo['name'];
                    echo"<div class='text-center'>
                             <p class='display-4 fw-bold fst-italic'>Capitulo: $episo[name]</p>
                         </div>";
                ?>

            <div class="col-12 d-flex flex-wrap">
                
                <?php

                    // se creo un nuevo curl para poder acceder a la localizacion de cada personaje, pasando la variable del foreach a un nuevo curl
                    foreach($episod as $person){
                        $ch1 = curl_init(); 
                        curl_setopt($ch1, CURLOPT_URL,$person);
                        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
                        $data1 = curl_exec($ch1);
                        $per=json_decode($data1 ,true);
                        curl_close($ch1);
                        
                        echo"<div class='  col-12 col-mb-6 col-lg-4 col-xl-4  rounded border-4'>
                                <div class='card mb-3 mt-3 ms-3 me-3 '>
                                    <img class=' mt-2 rounded-4' src='$per[image]'>
                                    <div class='card-body'>  
                                        <button type='button' class='btn btn-light text-success ms-5 ' data-bs-toggle='modal' data-bs-target=#target$per[id]> Descripcion </button>
                                        <div class='modal fade' id=target$per[id] data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'> 
                                            <div class='modal-dialog'>
                                                <div class='modal-content'>
                                                    <div class='modal-header modalT'>
                                                        <h1 class='modal-title text-center  fs-5 text-dark' id='staticBackdropLabel'>Id: $per[id]</h1>
                                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                    </div>
                                                    <div class='modal-body modalF text-center'>
                                                        <p class=' card-title mt-1 fs-5 fw-bold text-white'>Nombre:$per[name] </p>
                                                        <p class=' card-text mt-1 fs-5 fw-bold text-white'>Status:$per[status] </p>
                                                        <p class=' card-text mt-1 fs-5 fw-bold text-white'>Species:$per[species] </p>
                                                        <p class=' card-text mt-1 fs-5 fw-bold text-white'>Type:$per[type] </p>
                                                        <p class=' card-text mt-1 fs-5 fw-bold text-white'>Gender:$per[gender] </p>
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
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
    

    