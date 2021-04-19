<?php

  function types()
  {
    $situation = array(
      [ "id" => 1, "name" => "Casa"],
      [ "id" => 2, "name" => "Departamento"]
    );

    return $situation;
  }

  function situations()
  {
    $situation = array(
      "1" => "Habitada",
      "2" => "Vacía",
    );

    return $situation;
  }

  function antiquity()
  {
    $antiquity = array(
      "1" => "A estrenar",
      "2" => "Años",
      "3" => "En construcción",
    );

    return $antiquity;
  }

  function conditions()
  {
    $conditions = array(
      "1" => "Regular",
      "2" => "A refaccionar",
      "3" => "Reciclado",
      "4" => "Bueno",
      "5" => "Muy bueno",
      "6" => "Excelente",
    );

    return $conditions;
  }

  function locationsKeys()
  {
    $locations = array(
      "1" => "En nuestra posesión",
      "2" => "En la propiedad",
      "3" => "Portero",
      "4" => "Agente",
      "5" => "Desconocido",
    );

    return $locations;
  }
