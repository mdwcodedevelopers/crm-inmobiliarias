<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="canonical" href="https://www.administracionwheimar.com/" itemprop="url">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>

  <style>
    @page { margin: 5cm 0 0 0;font-family: "Nunito", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";}
    header { position:fixed; left: 1.5cm; top:-6cm; right:1.5cm; height:6cm; text-align:center; }
    body { margin: 1.5cm 1.5cm; color:#000!important;font-size:.73rem!important;  }
    .page-break { page-break-after: always;  }
    .text-left {  text-align: left !important;   }
    .text-center {  text-align: center !important;  }
    .text-justify {  text-align:justify!important;  }
    *, *::before, *::after {  box-sizing: border-box;   }
    .table {   width: 100%;      color: #858796;  }
    .table td, .table th {   padding: 0.5rem;   vertical-align: middle;   text-align: center;   }
    .table-bordered th, .table-bordered td {   border: 1px solid #e3e6f0;   padding: 0.6rem 1rem; margin:.4rem 0; }
    .header_top{margin-top: 2.5cm; width: 100%;}
    img {margin-top: 0.2rem; position:relative; max-height:4cm!important; border:1px solid #000;}
    hr{color: #e3e6f0!important;}
    .title-company{font-size: 18px!important; margin:0;}
    .bg-primary{ background:#039be5!important; }
  </style>
</head>
<body>
<header>
  @if( $property->ImagePrincipal() != '' )
    <table class="header_top">
      <tbody>
        <tr>
          <td class="text-left" style="width:25%">
            <img src="{{ renderIMG($property->ImagePrincipal()) }}">
          </td>
          <td>
            <p class="text-center"><strong>{{ $property->title }}</strong></p>
            <p class="text-center">{{ $property->information }}</p>
          </td>
        </tr>
      </tbody>
    </table>
  @else
    <table class="header_top">
      <tbody>
        <tr>
          <td>
            <p class="text-center"><strong>{{ $property->title }}</strong></p>
            <p class="text-center">{{ $property->information }}</p>
          </td>
        </tr>
      </tbody>
    </table>
  @endif
</header>
<main>
  <table class="table table-bordered">
    <tbody>
      <tr>
        <td class="bg-primary"><strong>Ubicación</strong></td>
        <td>Provincia: {{ $property->province }}, Localidad: {{ $property->location }}, Sub-división: {{ $property->subdivision_1}}, Sub-división: {{ $property->subdivision_2 }}</td>
      </tr>
      <tr>
        <td class="bg-primary"><strong>Precio</strong></td>
        <td>{{ $property->price }} {{ $property->Currency->name }}</td>
      </tr>
      <tr>
        <td class="bg-primary"><strong>Dimensiones</strong></td>
        <td>{{ $property->dimension }}<sub>m</sub><sup>2</sup></td>
      </tr>
      <tr>
        <td class="bg-primary"><strong>Tipo de Propiedad</strong></td>
        <td>{{ types()[$property->type-1]["name"] }}</td>
      </tr>
      <tr>
        <td class="bg-primary"><strong>Situación Actual</strong></td>
        <td>{{ situations()[$property->situation-1]["name"] }}</td>
      </tr>
      <tr>
        <td class="bg-primary"><strong>Estatus</strong></td>
        <td>{{ $property->Status->name }}</td>
      </tr>
      <tr>
        <td class="bg-primary"><strong>Antigüedad</strong></td>
        <td>{{ antiquity()[$property->antiquity-1]["name"] }}</td>
      </tr>
      <tr>
        <td class="bg-primary"><strong>Condición</strong></td>
        <td>{{ conditions()[$property->condition-1]["name"] }}</td>
      </tr>
      <tr>
        <td class="bg-primary"><strong>Cantidad de Ambientes</strong></td>
        <td>{{ $property->environments }}</td>
      </tr>
      <tr>
        <td class="bg-primary"><strong>Cantidad de Plantas</strong></td>
        <td>{{ $property->plants }}</td>
      </tr>
      <tr>
        <td class="bg-primary"><strong>Cantidad de Baños</strong></td>
        <td>{{ $property->bedrooms }}</td>
      </tr>
      <tr>
        <td class="bg-primary"><strong>Cantidad de Toilettes</strong></td>
        <td>{{ $property->toilettes }}</td>
      </tr>
      <tr>
        <td class="bg-primary"><strong>Cantidad de Tocadores</strong></td>
        <td>{{ $property->dresser }}</td>
      </tr>
      <tr>
        <td class="bg-primary"><strong>Cantidad de Cocheras</strong></td>
        <td>{{ $property->chocheras }}</td>
      </tr>
      <tr>
        <td class="bg-primary"><strong>Ambientes Asociados</strong></td>
        <td>{{ count($property->EnvsOne()) ? envsToString($property->EnvsOne()) : 'Sin Ambientes Asociados' }}</td>
      </tr>
      <tr>
        <td class="bg-primary"><strong>Servicios Asociados</strong></td>
        <td>{{ count($property->Servs()) ? envsToString($property->Servs()) : 'Sin Servicios Asociados' }}</td>
      </tr>
      <tr>
        <td class="bg-primary"><strong>Ambientes Asociados</strong></td>
        <td>{{ count($property->EnvsTwo()) ? envsToString($property->EnvsTwo()) : 'Sin Extras Asociados' }}</td>
      </tr>
    </tbody>
  </table>
</main>

</body>
</html>
