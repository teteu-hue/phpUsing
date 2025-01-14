<?php require_once("header.php") ?>
<link rel="stylesheet" href="/php07/LibrarySystem/css/menu-admin.css">

<?php

require_once("header.php");

require_once("../controller/RootDir/RootDir.php");

$rootDir = RootDir::getRealPath();

require_once("$rootDir/model/Book/DbPublisherBook.php");

$dbp = new DbPulisherBook();
$publishers = $dbp->getAllPublisher();

?>

<div class="row">
    <div class="col"></div>
    <div class="col d-flex flex-column">
        <h1 class="text-title">
            Editora
        </h1>

        <div class="list-group list-group-flush d-flex justify-content-evenly">

            <div class="list-group-item">
                <a href="formCreatePublisher.php" class="btn btn-success buttom-item">
                    <i class="fa-solid fa-plus"></i>
                    <span class="button-action">Criar</span>
                </a>
            </div>

        </div>

        <div class="list-group list-group-flush">
            <div class="list-group-item">

                <div class="btn-group dropdown list-items">

                    <button class="btn btn-light buttom-publisher" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Lista de Editoras
                    </button>

                    <div class="dropdown-menu container-publisher">

                    <?php foreach($publishers as $row){ ?>
                        <div class="dropdown-item  list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold"><?php echo $row["nome_editora"]; ?></div>
                            </div>
                            <div class="d-flex justify-content-evenly" style="width: 10rem;">

                                <form method="POST" action="/php07/LibrarySystem/controller/Publisher/delete.php?id_editora=<?php echo $row['id_editora']?>">
                                    <button type="submit" class="badge bg-danger rounded-pill">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </form>

                                <form method="POST" action="/php07/LibrarySystem/controller/Publisher/get.php?id_editora=<?php echo $row['id_editora']?>">
                                    <button type="submit" class="badge bg-warning rounded-pill">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                </form>
                                
                            </div>
                        </div>
                    <?php }?>


                    </div>

                </div>

            </div>
        </div>

    </div>
    <div class="col"></div>
</div>

<?php
unset($dbp);
require_once("footer.php"); 
?>
