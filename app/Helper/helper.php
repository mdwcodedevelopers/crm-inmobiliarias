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

  function realType($index)
  {
    $type = array(
      1 => "Este contacto es ahora propietario de:",
      2 => "Contacto registrado",
      3 => "Contacto modificado a:",
      4 => "Este contacto ha sido eliminado:",
      5 => "Lista y búsqueda de Contactos:",
      6 => "Nueva búsqueda",
      7 => "El campo ha sido cambiado a: ",
      8 => "Filtrar contactos por: ",
      9 => "Lista de Propiedades",
      10 => "Propiedad registrada:",
      11 => "Formulario de editar propiedad:",
      12 => "Propiedad Modificada a:",
      13 => "Propiedad Eliminada:",
      14 => "Un Contacto está interesado en una propiedad",
      15 => "Evento creado",
      16 => "Invitacion a evento:",
      17 => "Evento eliminado",
      18=> "Evento actualizado",
      19 => "Un Contacto está interesado en tu propiedad:",
    );

    return $type[$index];
  }

  function realTable($id)
  {
    $modules = array(
      1 => "Propiedades",
      2 => "Contactos",
      3 => "Eventos",
      4 => "Oportunidades",
      5 => "Preguntas",
    );

    return $modules[$id];
  }

  function saveReport($type, $table, $status, $info, $property = NULL)
  {
    $report = new \App\Report();
    $report->user_id =  \Auth::user()->id;
    $report->property_id = $property;
    $report->type = realType($type);
    $report->table = realTable($table);
    $report->information = $info;
    $report->status = "$status";
    $report->save();

    return $report;
  }
  function saveNotification($id, $type, $info, $property = NULL)
  {
    $report = new \App\Report();
    $report->user_id =  $id;
    $report->property_id = $property;
    $report->type = realType($type);
    $report->table = "Notificaciones";
    $report->information = $info;
    $report->status = "1";
    $report->save();

    return $report;
  }

  function tagsToString($tags)
  {
    $string = '';

    if( is_array($tags) ):
      foreach ($tags as $value):
        $string .= \App\Tag::select("name")->where("id",$value)->first()->name . " ";
      endforeach;
    else:
      $string = \App\Tag::select("name")->where("id",$tags)->first()->name;
    endif;

    return $string;
  }

  function userToString($id)
  {
    $string = \App\User::select("name")->where("id",$id)->first()->name;

    return $string;
  }

  function statusToString($id)
  {
    $string = \App\Status::selectRaw('name')->where("id",$id)->first()->name;

    return $string;
  }

  function currenciesToString($id)
  {
    $string = \App\Currency::selectRaw('name')->where("id",$id)->first()->name;

    return $string;
  }

  function envsToString($environments)
  {
    $string = '';

    foreach ($environments as $env):
      $string .= \App\Environment::select("name")->where("id",$env)->first()->name . " ";
    endforeach;

    return $string;
  }

  function servicesToString($services)
  {
    $string = '';

    foreach ($services as $service):
      $string .= \App\Service::select("name")->where("id",$service)->first()->name . " ";
    endforeach;

    return $string;
  }

  function renderIMG($path)
  {
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

    return  $base64;
  }
