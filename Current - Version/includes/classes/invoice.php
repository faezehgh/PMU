<?php

class invoice
{
  private $id_invoice;
  private $id_order;
  private $tva;

  function __construct($_id_invoice, $_id_order, $_tva)
  {
    $this->id_invoice = $_id_invoice;
    $this->id_order = $_id_order;
    $this->tva = $_tva;
  }
  public function getId_invoice()
  {
    return $this->id_invoice;
  }
  public function getId_order()
  {
    return   $this->id_order;
  }
  public function getTva()
  {
    return $this->tva;
  }
  public function setId_invoice($_id_invoice)
  {
    return $this->id_invoice = $_id_invoice;
  }
  public function setId_order($_id_order)
  {
    return $this->id_order = $_id_order;
  }
  public function setTva($_tva)
  {
    return $this->tva = $_tva;
  }
}
