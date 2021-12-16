<?php

class articles
{
  private $refarticles;
  private $label;
  private $description;
  private $current_stock;
  private $alerte_stock;
  private $sell_price;
  private $id_category;
  private $id_picture;


  function __construct($_refarticles, $_label, $_description, $_current_stock, $_alerte_stock, $_sell_price, $_id_category, $_id_picture)
  {
    $this->refarticles = $_refarticles;
    $this->label = $_label;
    $this->description = $_description;
    $this->current_stock = $_current_stock;
    $this->alerte_stock = $_alerte_stock;
    $this->sell_price = $_sell_price;
    $this->id_category = $_id_category;
    $this->id_picture = $_id_picture;
  }

  public function getRefarticles()
  {
    return $this->refarticles;
  }
  public function getLable()
  {
    return   $this->label;
  }
  public function getDescription()
  {
    return $this->description;
  }
  public function getCurrentstock()
  {
    return $this->current_stock;
  }
  public function getAlertestock()
  {
    return $this->alerte_stock;
  }
  public function getSellprice()
  {
    return $this->sell_price;
  }
  public function getIdcategory()
  {
    return $this->id_category;
  }
  public function getIdpicture()
  {
    return $this->id_picture;
  }
  public function setRefarticles($_refarticles)
  {
    return $this->refarticles = $_refarticles;
  }
  public function setLable($_label)
  {
    return $this->label = $_label;
  }
  public function setDescription($_description)
  {
    return $this->description = $_description;
  }
  public function setCurrentstock($_current_stock)
  {
    $this->current_stock = $_current_stock;
  }
  public function setAlertestock($_alerte_stock)
  {
    $this->alerte_stock = $_alerte_stock;
  }
  public function setSellprice($_sell_price)
  {
    $this->sell_price = $_sell_price;
  }
  public function setIdcategory($_id_category)
  {
    $this->id_category = $_id_category;
  }
  public function setIdpicture($_id_picture)
  {
    $this->id_picture = $_id_picture;
  }
}
?>