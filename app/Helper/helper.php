<?php

  function types()
  {
    $situation = array(
      [ "id" => "1", "name" => "Casa"],
      [ "id" => "2", "name" => "Departamento"]
    );

    return $situation;
  }

  function situations()
  {
    $situation = array(
      [ "id" => "1", "name" => "Habitada"],
      [ "id" => "2", "name" => "Vacía"]
    );

    return $situation;
  }

  function antiquity()
  {
    $antiquity = array(
      [ "id" => "1", "name" => "A estrenar"],
      [ "id" => "2", "name" => "Años"],
      [ "id" => "3", "name" => "En construcción"]
    );

    return $antiquity;
  }

  function conditions()
  {
    $conditions = array(
    [ "id" => "1", "name" => "Regular"],
    [ "id" => "2", "name" => "A refaccionar"],
    [ "id" => "3", "name" => "Reciclado"],
    [ "id" => "4", "name" => "Bueno"],
    [ "id" => "5", "name" => "Muy bueno"],
    [ "id" => "6", "name" => "Excelente"]
    );

    return $conditions;
  }

  function locationsKeys()
  {
    $locations = array(
    [ "id" => "1", "name" => "En nuestra posesión"],
    [ "id" => "2", "name" => "En la propiedad"],
    [ "id" => "3", "name" => "Portero"],
    [ "id" => "4", "name" => "Agente"],
    [ "id" => "5", "name" => "Desconocido"]
    );

    return $locations;
  }
