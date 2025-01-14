<?php
include_once "GenderBook.php";
include_once "PublisherBook.php";

Class Book
{
    private int $idBook;
    private string $nameBook;
    private GenderBook $genderBook;
    private PublisherBook $publisherBook;
    private float $price;
    private int $numPage;
    private string $description;

    public function __construct($nameBook, $genderBook, $publisherBook, $price, int $numPage, $description){
        $this->nameBook = $nameBook;
        $this->genderBook = $genderBook;
        $this->price = $price;
        $this->numPage = $numPage;
        $this->description = $description;
        $this->publisherBook = $publisherBook;
    }

    /* GETTERS AND SETTERS */

    public function getIdBook() : int 
    {
        return $this->idBook;
    }

    public function getNameBook()
    {
        return $this->nameBook;
    }

    public function setNameBook($nameBook)
    {
        $this->nameBook = $nameBook;
    }

    public function getGenderBook()
    {
        return $this->genderBook;
    }

    public function getPublisherBook(){
        return $this->publisherBook;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getNumPage()
    {
        return $this->numPage;
    }

    public function setNumPage($numPage)
    {
        $this->numPage = $numPage;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    /* GETTERS AND SETTER */

    public function getInfoBook() : void
    {
        echo "The Id is: " . $this->getIdBook() . "<br>";
        echo "The Name of Book is: " . $this->getNameBook() . "<br>";
        echo "The Gender of Book is: " . $this->getGenderBook()->getName() . "<br>";
        echo "The Number of page is: " . $this->getNumPage() . "<br>";
    }
}

?>