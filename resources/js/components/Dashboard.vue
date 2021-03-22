<template>
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="card text-white bg-success mb-4" style="max-width: 15rem;">
                    <div class="card-header text-center">Propiedades Vendidas</div>
                    <div class="card-body">
                        <h5 class="card-title text-center">5</h5>
                    </div>
                </div>

            </div>
            <div class="col-sm">
                <div class="card text-white bg-info" style="max-width: 15rem;">
                    <div class="card-header text-center">Interesados</div>
                    <div class="card-body">
                        <h5 class="card-title text-center">16</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card text-white bg-warning" style="max-width: 15rem;">
                    <div class="card-header text-center">Categorias</div>
                    <div class="card-body">
                        <h5 class="card-title text-center">16</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card text-white bg-success mb-4" style="max-width: 15rem;">
                    <div class="card-header text-center">Mensajes</div>
                    <div class="card-body">
                        <h5 class="card-title text-center">52</h5>
                    </div>
                </div>

            </div>
          </div>



    </div>

</template>

<script>
    const gradients = [
      ['#42b3f4'],
    ]

    export default {
      data: () => ({
        width: 2,
        radius: 10,
        padding: 8,
        lineCap: 'round',
        gradient: gradients[5],
        value: [0, 2, 5, 9, 5, 10, 3, 5, 0, 0, 1, 8, 2, 9, 0],
        gradientDirection: 'top',
        gradients
      })
    }
  </script>
