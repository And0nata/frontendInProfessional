<?php

class Person
{
  private $name;
  private $lastname;
  private $mother;
  private $father;

  function __construct($name, $lastname, $mother, $father)
  {
    $this->name = $name;
    $this->lastname = $lastname;
    $this->mother = $mother;
    $this->father = $father;
  }
  function getName() {
    return $this->name;
  }
  function getLastName() {
    return $this->lastname;
  }
  function getMother() {
    return $this->mother;
  }
  function getFather() {
    return $this->father;
  }
  function getInfo() 
  {
    return "<h3>My family tree </h3><br>" .
    "My name is: " . $this->getName() .
    "<br>My lastname is: " . $this->getLastname() .
    "<br> My father's name is: " . $this->getFather()->getName() . " " .  $this->getFather()->getLastName() .
    "<br> My mother's name is: " . $this->getMother()->getName() . " " . $this->getMother()->getLastName() .
    "<br> My mother's mother name is: " . $this->getMother()->getMother()->getName() . " " .  $this->getMother()->getMother()->getLastName() . 
    "<br> My mother's father name is: " . $this->getMother()->getFather()->getName() . " " .  $this->getMother()->getFather()->getLastName() .
    "<br> My father's mother name is: " . $this->getFather()->getMother()->getName() . " " .  $this->getFather()->getMother()->getLastName() . 
    "<br> My father's father name is: " . $this->getFather()->getFather()->getName() . " " .  $this->getFather()->getFather()->getLastName() ;
  }
}
$yuriy = new Person("Yuriy", "Velesov", null, null);
$yulia = new Person("Yulia", "Velesova", null, null);

$alexey = new Person("alexey", "Ivanov", null, null);
$maria = new Person("Maria", "Ivanova", null, null);

$ivan = new Person("Ivan", "Semenov", $yulia, $yuriy);
$elena = new Person("Elena", "Kazantsev", $maria, $alexey);
$marina = new Person("Marina", "Amonov", $elena, $ivan);

echo $marina->getInfo();
