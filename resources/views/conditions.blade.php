@extends('layouts.app')

@section('content')
    <div>
       
        @guest
            <div class="grey lighten-2 d-flex justify-space-between align-md-center py-3 px-7  flex-column flex-sm-column  flex-md-row  " width="100%">
                <nav class="d-flex  align-start align-md-center ">
                    <ul class="m-0 p-0 d-flex" style="list-style: none">
                        <li class="elemento"><a href="#" class="black--text">Trabajá con nosotros</a></li>
                        <v-divider
                        class="mx-4"
                        inset
                        vertical
                    ></v-divider>
                        <li><a href="#" class="black--text">Institucional</a></li>
                    </ul>
                </nav>
                <div class="d-flex align-start align-md-center blue-grey--text font-weight-medium  flex-column flex-sm-column  flex-md-row mt-5 mt-lg-0 ">
                    <p class="m-0 mr-2">
                        Comunicáte con nosotros: <a href="https://api.whatsapp.com/send?phone=+542204823266" target="_blank">+54 220 482-3266</a> 
                    </p>
                    <p class="m-0">
                        Nuestras redes: 
                        <a href="https://facebook.com/inmobiliariadanielcanepa" target="_blank" class="blue-grey--text"><v-icon class="ml-2">mdi-facebook</v-icon></a>
                        <a href="https://instagram.com/inmobiliariadanielcanepa" target="_blank" class="blue-grey--text"><v-icon class="ml-2">mdi-instagram</v-icon></a>
                    </p>
                </div>
            </div>
            <div class="">
                <nav-guest />
            </div>
        @else
        <div class="">
            <nav-admin title="Home" :role="{{$rol}}" />
        </div>
        @endguest
        <div class="white pb-7">
            <div class="container">
                <h2 class="text-center  font-weight-bold pb-3 blue--text text--darken-4 my-5">Términos y Condiciones de Uso</h2>
                <v-row no-gutters >
                    <v-col cols="12" md="8">
                        <h5 class="my-7">INFORMACIÓN RELEVANTE</h5>
                        <p class="my-5">Es requisito necesario para la adquisición de los productos que se ofrecen en este sitio, 
                            que lea y acepte los siguientes Términos y Condiciones que a continuación se redactan. 
                            El uso de nuestros servicios así como la compra de nuestros productos implicará que usted 
                            ha leído y aceptado los Términos y Condiciones de Uso en el presente documento. 
                            Todas los productos  que son ofrecidos por nuestro sitio web pudieran ser creadas, cobradas, 
                            enviadas o presentadas por una página web tercera y en tal caso estarían sujetas a sus propios 
                            Términos y Condiciones. En algunos casos, para adquirir un producto, será necesario el registro 
                            por parte del usuario, con ingreso de datos personales fidedignos y definición de una contraseña.</p>
                        
                        <p class="my-5">El usuario puede elegir y cambiar la clave para su acceso de administración de la cuenta 
                            en cualquier momento, en caso de que se haya registrado y que sea necesario para la compra de alguno
                             de nuestros productos. www.danielcanepainmobiliaria.com no asume la responsabilidad en caso de que 
                             entregue dicha clave a terceros.</p>    

                        <p class="my-5">Todas las compras y transacciones que se lleven a cabo por medio de este sitio web, 
                            están sujetas a un proceso de confirmación y verificación, el cual podría incluir la verificación 
                            del stock y disponibilidad de producto, validación de la forma de pago, validación de la factura 
                            (en caso de existir) y el cumplimiento de las condiciones requeridas por el medio de pago seleccionado. 
                            En algunos casos puede que se requiera una verificación por medio de correo electrónico.</p>    

                        <p class="my-5">Los precios de los productos ofrecidos en esta Tienda Online es válido solamente en las 
                            compras realizadas en este sitio web.</p>    

                        <h5 class="my-7">LICENCIA</h5>
                        <p class="my-5">Inmobiliaria Daniel Cánepa  a través de su sitio web concede una licencia para que los usuarios 
                            utilicen  los productos que son vendidos en este sitio web de acuerdo a los Términos y Condiciones que 
                            se describen en este documento.</p>
                        
                        <h5 class="my-7">USO NO AUTORIZADO</h5>
                        <p class="my-5">En caso de que aplique (para venta de software, templetes, u otro producto de diseño y programación) 
                            usted no puede colocar uno de nuestros productos, modificado o sin modificar, en un CD, sitio web o ningún otro 
                            medio y ofrecerlos para la redistribución o la reventa de ningún tipo.</p>

                        <h5 class="my-7">PROPIEDAD</h5>
                        <p class="my-5">Usted no puede declarar propiedad intelectual o exclusiva a ninguno de nuestros productos, modificado 
                            o sin modificar. Todos los productos son propiedad  de los proveedores del contenido. En caso de que no se 
                            especifique lo contrario, nuestros productos se proporcionan  sin ningún tipo de garantía, expresa o implícita. 
                            En ningún esta compañía será  responsables de ningún daño incluyendo, pero no limitado a, daños directos, indirectos, 
                            especiales, fortuitos o consecuentes u otras pérdidas resultantes del uso o de la imposibilidad de utilizar nuestros 
                            productos.</p>
                        
                        <h5 class="my-7">POLÍTICA DE REEMBOLSO Y GARANTÍA</h5>
                        <p class="my-5">En el caso de productos que sean  mercancías irrevocables no-tangibles, no realizamos reembolsos después 
                            de que se envíe el producto, usted tiene la responsabilidad de entender antes de comprarlo.  Le pedimos que lea cuidadosamente 
                            antes de comprarlo. Hacemos solamente excepciones con esta regla cuando la descripción no se ajusta al producto. 
                            Hay algunos productos que pudieran tener garantía y posibilidad de reembolso pero este será especificado al comprar 
                            el producto. En tales casos la garantía solo cubrirá fallas de fábrica y sólo se hará efectiva cuando el producto se 
                            haya usado correctamente. La garantía no cubre averías o daños ocasionados por uso indebido. Los términos de la garantía 
                            están asociados a fallas de fabricación y funcionamiento en condiciones normales de los productos y sólo se harán efectivos 
                            estos términos si el equipo ha sido usado correctamente. Esto incluye:</p>
                        
                        <ul class="my-5">
                            <li>De acuerdo a las especificaciones técnicas indicadas para cada producto.</li>
                            <li>En condiciones ambientales acorde con las especificaciones indicadas por el fabricante.</li>
                            <li>En uso específico para la función con que fue diseñado de fábrica.</li>
                            <li>En condiciones de operación eléctricas acorde con las especificaciones y tolerancias indicadas.</li>
                        </ul>

                        <h5 class="my-7">COMPROBACIÓN ANTIFRAUDE</h5>
                        <p class="my-5">La compra del cliente puede ser aplazada para la comprobación antifraude.
                             También puede ser suspendida por más tiempo para una investigación más rigurosa, para evitar transacciones fraudulentas</p>

                        <h5 class="my-7">PRIVACIDAD</h5>
                        <p class="my-5">Este sitio web www.danielcanepainmobiliaria.com garantiza que la información personal que usted envía cuenta 
                            con la seguridad necesaria. Los datos ingresados por usuario o en el caso de requerir una validación de los pedidos 
                            no serán entregados a terceros, salvo que deba ser revelada en cumplimiento a una orden judicial o requerimientos legales.</p>

                        <p class="my-5">La suscripción a boletines de correos electrónicos publicitarios es voluntaria y podría 
                            ser seleccionada al momento de crear su cuenta.</p>

                        <p class="my-5">Inmobiliaria Daniel Cánepa reserva los derechos de cambiar o de modificar estos términos sin previo aviso.</p>

                    </v-col>
                    <v-col cols="12" md="4"></v-col>
                </v-row>
            </div>
        </div>
        <front-footer></front-footer>  
    </div>
@endsection

