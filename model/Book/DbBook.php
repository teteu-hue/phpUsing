<?php

require_once("$rootDir/Database/Database.php");
require_once("$rootDir/model/Book/Book.php");
require_once("$rootDir/model/Book/DbPublisherBook.php");
require_once("$rootDir/model/Book/DbGenderBook.php");

class DbBook extends Database
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getBookById($idBook)
    {

        $sql_search_book = "SELECT * FROM Livro WHERE id_livro = $idBook";
        $queryResult = $this->runSelectQuery($sql_search_book);
        return $queryResult;
    }

    public function getAllBook()
    {

        $sql_search_all_book = "SELECT * FROM Livro";
        $queryResult = $this->runSelectQuery($sql_search_all_book);
        return $queryResult;
    }

    public function insertBook(Book $book)
    {
        $dbg = new DbGenderBook();
        $dbp = new DbPulisherBook();

        if (!$book) {
            die("Please Insert a Book");
        }

        $name = $book->getNameBook();

        $idGender = $dbg->getGenderByName($book->getGenderBook()->getName())->fetch()["id_genero"];
        $idPublisher = $dbp->getPublisherByName($book->getPublisherBook()->getNamePublisher())->fetch()["id_editora"];

        $preco = $book->getPrice();
        $numPage = $book->getNumPage();
        $description = $book->getDescription();
        $sql_insert_book = "INSERT INTO Livro (nome_livro, id_genero, id_editora, preco, numero_paginas, descricao)  
                            VALUES(:nome, :id_genero, :id_editora,:preco, :numero_paginas, :descricao)";

        $p_sql = $this->connection->prepare($sql_insert_book);

        $data = [
            ":nome" => $name,
            ":id_genero" => $idGender,
            ":id_editora" => $idPublisher,
            ":preco" => $preco,
            ":numero_paginas" => $numPage,
            ":descricao" => $description
        ];

        return $p_sql->execute($data);
    }

    public function getBookAndGenderByID($id_book)
    {

        $sql_search_book = "SELECT id_livro, nome_livro, preco, nome_genero, numeroDePaginas
                            FROM Livro 
                            INNER JOIN Genero ON Genero.id_genero = Livro.id_genero
                            WHERE Livro.id_livro = $id_book;
        ";

        $queryResult = $this->runSelectQuery($sql_search_book)[0];
        return $queryResult;
    }

    public function deleteBook($idBook)
    {
        
        $book = $this->getBookById($idBook)->fetch()["id_livro"];
        $sql_delete_book = "DELETE FROM livro WHERE id_livro = $book";
        $p_sql = $this->connection->exec($sql_delete_book);
        return $p_sql;
    }

    public function editBook($idBook, $nameBook, $price, $description, $id_gender, $id_editora, $numPage)
    {
        $sql_update_book = "UPDATE livro 
                              SET 
                              nome_livro = :nome_livro
                              preco = :preco
                              descricao = :descricao
                              id_genero = :id_genero
                              id_editora = :id_editora
                              numero_paginas = :numero_paginas
                              WHERE id_livro = :id_livro";
    }
}
