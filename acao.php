<?php 
    require("model/Address/Address.php");
    require("model/Notebook/Notebook.php");
    require("model/Book/Book.php");
    require("Database/books.php");
    require("model/Library/Library.php");
?>

<?php include "header.php" ?>

<?php 

    $genderBook = GenderBook::getGenderBookById($_POST['genderBook'], $genderBooks);

    $library->insertBook(new Book($_POST['nameBook'], $genderBook, floatval($_POST['price']), floatval($_POST['numPage'])));

    echo $library->getBookById(16);
    

?>

<?php include "footer.php" ?>