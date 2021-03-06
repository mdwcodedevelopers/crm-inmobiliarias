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
                <h2 class="text-center  font-weight-bold pb-3 blue--text text--darken-4 my-5">Política de privacidad</h2>
                <v-row no-gutters >
                    <v-col cols="12" md="8" class="pr-5" style="border-right: #c0c0c0 solid 1px;">
                        <h5 class="my-7">POLÍTICA DE PRIVACIDAD</h5>
                        <p class="my-5">El presente Política de Privacidad establece los términos en que Inmobiliaria Daniel Cánepa
                           usa y protege la información que es proporcionada por sus usuarios al momento de utilizar 
                           su sitio web. Esta compañía está comprometida con la seguridad de los datos de sus usuarios. 
                           Cuando le pedimos llenar los campos de información personal con la cual usted pueda ser 
                           identificado, lo hacemos asegurando que sólo se empleará de acuerdo con los términos 
                           de este documento. Sin embargo esta Política de Privacidad puede cambiar con el tiempo 
                           o ser actualizada por lo que le recomendamos y enfatizamos revisar continuamente esta 
                           página para asegurarse que está de acuerdo con dichos cambios.</p>
                        
                        <h5 class="my-7">Uso de la información recogida</h5>
                        <p class="my-5">Nuestro sitio web emplea la información con el fin de proporcionar el mejor 
                            servicio posible, particularmente para mantener un registro de usuarios, de pedidos en 
                            caso que aplique, y mejorar nuestros productos y servicios.  Es posible que sean enviados 
                            correos electrónicos periódicamente a través de nuestro sitio con ofertas especiales, 
                            nuevos productos y otra información publicitaria que consideremos relevante para usted o 
                            que pueda brindarle algún beneficio, estos correos electrónicos serán enviados a la 
                            dirección que usted proporcione y podrán ser cancelados en cualquier momento.</p>
                        
                        <p class="my-5">Inmobiliaria Daniel Cánepa está altamente comprometido para cumplir con el 
                            compromiso de mantener su información segura. Usamos los sistemas más avanzados y los 
                            actualizamos constantemente para asegurarnos que no exista ningún acceso no autorizado.</p>
                        
                        <h5 class="my-7">Cookies</h5>
                        <p class="my-5">Una cookie se refiere a un fichero que es enviado con la finalidad de solicitar 
                            permiso para almacenarse en su ordenador, al aceptar dicho fichero se crea y la cookie sirve 
                            entonces para tener información respecto al tráfico web, y también facilita las futuras 
                            visitas a una web recurrente. Otra función que tienen las cookies es que con ellas las web 
                            pueden reconocerte individualmente y por tanto brindarte el mejor servicio personalizado de su web.</p>
                        
                        <p class="my-5">Nuestro sitio web emplea las cookies para poder identificar las páginas que son visitadas 
                            y su frecuencia. Esta información es empleada únicamente para análisis estadístico y después la 
                            información se elimina de forma permanente. Usted puede eliminar las cookies en cualquier momento 
                            desde su ordenador. Sin embargo las cookies ayudan a proporcionar un mejor servicio de los sitios web, 
                            estás no dan acceso a información de su ordenador ni de usted, a menos de que usted así lo quiera y 
                            la proporcione directamente, visitas a una web . Usted puede aceptar o negar el uso de cookies, 
                            sin embargo la mayoría de navegadores aceptan cookies automáticamente pues sirve para tener un mejor 
                            servicio web. También usted puede cambiar la configuración de su ordenador para declinar las cookies.
                             Si se declinan es posible que no pueda utilizar algunos de nuestros servicios.</p>
                        
                        <h5 class="my-7">Enlaces a Terceros</h5>
                        <p class="my-5">Este sitio web pudiera contener en laces a otros sitios que pudieran ser de su interés. 
                            Una vez que usted de clic en estos enlaces y abandone nuestra página, ya no tenemos control sobre 
                            al sitio al que es redirigido y por lo tanto no somos responsables de los términos o privacidad 
                            ni de la protección de sus datos en esos otros sitios terceros. Dichos sitios están sujetos a sus 
                            propias políticas de privacidad por lo cual es recomendable que los consulte para confirmar que 
                            usted está de acuerdo con estas.</p>
                        
                        <h5 class="my-7">Control de su información personal</h5>
                        <p class="my-5">En cualquier momento usted puede restringir la recopilación o el uso de la información 
                            personal que es proporcionada a nuestro sitio web.  Cada vez que se le solicite rellenar un formulario, 
                            como el de alta de usuario, puede marcar o desmarcar la opción de recibir información por correo electrónico.  
                            En caso de que haya marcado la opción de recibir nuestro boletín o publicidad usted puede cancelarla en cualquier momento.</p>
                        
                        <p class="my-5">Esta compañía no venderá, cederá ni distribuirá la información personal que es recopilada 
                            sin su consentimiento, salvo que sea requerido por un juez con un orden judicial.</p>
                        
                        <p class="my-5">Inmobiliaria Daniel Cánepa se reserva el derecho de cambiar los términos 
                            de la presente Política de Privacidad en cualquier momento.</p>
                        
                    </v-col>
                    <v-col cols="12" md="4">
                        <aside-terms></aside-terms>
                    </v-col>
                </v-row>
            </div>
        </div>
        <front-footer></front-footer>  
    </div>
@endsection


