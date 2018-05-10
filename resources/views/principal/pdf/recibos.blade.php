<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <style type="text/css">
            table{
                font-size: 8.5px;
                font-family: Helvetica;
            }
            hr{
                border-color: #b9bbbe;
                border-width: 1px;
                border-style: inset;
            }
            .t1{
                font-size: 15px;
            }
            .t2{
                font-size: 8.5px;
            }
            .t3{
                font-size: 13px;
                font-weight: bolder;
                font-family:Courier New ,Courier, monospace;

            }
            body{
                @if($recibo->cancelado==1)
background: url(http://lax.megatravel.com.mx/img/cancelado.png) center no-repeat;
                background-position: 30% 5%;
            @else

            @endif
        }
            div{
                background: url(http://lax.megatravel.com.mx/expo/img/logo_mt.png) center;
                background-repeat: no-repeat;
            }

        </style>

        <title></title>
</head>
<body>
<header class="Content-type:application/pdf"> </header>

<table width='100%'>
    <tr>
        <td>
            <img src='http://lax.megatravel.com.mx/expo/img/logo_mt_.png' width='200px'>
        </td>
        <td colspan="3">
            MEGA TRAVEL OPERADORA, S.A DE C.V<br>
            Calle Trinidad 7 Col.Las Américas<br>
            Mpio.Naucalpan C.P53040 Estado de México<br>
            R.F.C. MTO-171211-CN7<br>
        </td>

        <td>
            <table  width="100%">
                <thead>
                <tr>
                    <th colspan='2'>TIPO DE CAMBIO</th>
                    <td class="t1" align="right"><u><b>{{$recibo->folio}}</b></u></td>
                </tr>
                </thead>
                <tbody>
                <tr class="t2">
                    <td colspan='3'>{{$recibo->fechatc}} {{$recibo->intercam}}</td>
                    <td></td>
                </tr>
                <tr>
                    <th colspan='3'>LUGAR Y FECHA DE EXPEDICIÓN</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan='3'>CIUDAD DE MÉXICO {{$recibo->fechahoy}}</td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
</table>
<hr><hr>
<div>
    <table width='100%' cellpadding='0' cellspacing='0' class='direc'>
        <tr>
            <td>
                Av.Chapultepec No.536<br> Piso 7 Col.Roma Norte<br> Del.Cuahutémoc <br> C.P 06700 Mexico D.F.
            </td>
            <td>
                <table cellpadding='0' cellspacing='0' id="table">
                    <thead>
                    <tr>
                        <th align='left'>&nbsp;CLIENTE: </th>
                        <td colspan='3'><u>{{$recibo->nombre}}</u></td>
                    </tr>
                    <tr>
                        <th align='left'>&nbsp;DIRECCIÓN: </th>
                        <td colspan='3'>{{$recibo->direccion}}, COL. {{$recibo->colonia}}, MUN./DEL.: {{$recibo->mundel}},
                            ESTADO: {{$recibo->estado}}, C.P.: {{$recibo->codigop}}</td>
                    </tr>
                    <tr>
                        <th align='left'>&nbsp;TELS.:</th>
                        <td>{{$recibo->telefono}}</td>
                    </tr>
                    <tr>
                        <th align='left'>&nbsp;R.F.C:</th>
                        <td>&nbsp;{{$recibo->rfc}}</td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td>
                <table cellpadding='0' cellspacing='0'>
                    <thead>
                    <tr>
                        <th align='left'>&nbsp;EJECUTIVO DE VENTAS.:</th>
                    </tr>
                    <tr>
                        <td colspan='3' align='center'>{{$emp->cnombre}} {{$emp->capellidop}}-{{$recibo->iniciales}}</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
    <hr>

    <table width="100%" cellpadding='0' cellspacing='0' class='direc'>
        <tr>
            <th align='left'>EXPEDIENTE</th>
            <th colspan='2' align='left'>PASAJEROS</th>
            <th align='left'>F. SALIDA</th>
            <th colspan='2' align='left'>SERVICIOS</th>
            <th  align='left'>IMPORTE </th>
        </tr>
        <tr>
            <td class="t3">{{$recibo->cid_expediente}}</td>
            <td  colspan='2' align="left">{{$recibo->pasajero}}</td>
            <td align='left'>{{$recibo->fsalida}}</td>
            <td  colspan='2' align='left'>{{$recibo->destino}}</td>
            <td  colspan='2' align='left'>{{$recibo->monto}}  {{$recibo->moneda}}</td>
        </tr>
    </table>
    <hr>
    <table  cellpadding='0' cellspacing='0'>
        <tr >
            <td>&nbsp;<strong>FORMA DE PAGO:</strong></td>
            <td><u>&nbsp;{{$recibo->concepto}}</u></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;<strong>FECHA OP:</strong></td>
            <td>&nbsp;{{$recibo->fechsaop}}</td>
        </tr>
        @if($recibo->concepto=='EFECTIVO')

        @else
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;<strong>BANCO:</strong></td>
                <td>&nbsp;{{$recibo->banco}}</td>
                <td>&nbsp;</td>

            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;<strong>CUENTA:</strong></td>
                <td>&nbsp;{{$recibo->cuenta}}</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;<strong>REFERENCIA/AUT:</strong></td>
                <td>&nbsp;{{$recibo->referencia}}</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        @endif


        <tr>
            <td height='20' colspan='6'>&nbsp;I.V.A. Tasa Cero por ser servicios prestados en el Extranjero.</td>
        </tr>
    </table>
    <table width="100%" cellpadding='0' cellspacing='0' class='direc'>
        <tr>
            <td colspan='4' align='center' style='text-decoration:underline'>Cadena Digital</td>
        </tr>
        <tr>
            <td colspan='4' align='center'>{{$recibo->encrip}}</td>
        </tr>
    </table>
    <hr>
    <table width="100%" cellpadding='0' cellspacing='0' class='direc'>
        <tr class='general'>
            <th colspan='3' align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL CON LETRA</th>
            <th align='center'>&nbsp;&nbsp;&nbsp;TOTAL A PAGAR $ </th>
        </tr>
        <tr class="t2">
            <td colspan='3' align='left'>&nbsp;&nbsp;&nbsp;&nbsp;{{$recibo->letras}}</td>
            <td align='center'>{{$recibo->monto}} {{$recibo->moneda}}</td>
        </tr>
    </table>
    @if($recibo->cancelado==1)
        <hr>
        <table width='100%' cellpadding='0' cellspacing='0'>
            <tr>
                <td colspan='4' align='right'>
                    <table style='font-size:8px;' cellpadding='0' cellspacing='0'>
                        <tr>
                            <td>Cancelado Por &nbsp;</td>
                            <td>{{$recibo->quiencancela}}</td>
                        </tr>
                        <tr>
                            <td>F.Cancelación &nbsp;</td>
                            <td>{{$recibo->fcancela}}</td>
                        </tr>
                        <tr>
                            <td>Motivo &nbsp;</td>
                            <td>{{$recibo->motivocanc}}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    @else
    @endif
</div>
<hr><hr>
<table width='100%' cellpadding='0' cellspacing='0'>
    <tr>
        <td colspan='4' align='justify' style='background: url(http://lax.megatravel.com.mx/expo/img/logo_mt.png) center no-repeat; font-size:7px; color: #666; font-family: 'Times New Roman', Times, serif'>
        EXTRACTO DEL CONTRATO DE ADHESION DE MEGA TRAVEL OPERADORA, S.A. DE C.V. REGISTRO PROFECO 1316-05 LIBRO 2° VOL 1° NO EXPED PFC. B.E. 7/471-2005 DE FECHA 19 DE MAYO DEL 2005. TERCERA.- EL CLIENTE  acepta que la intervención de LA AGENCIA sea única y exclusivamente con carácter de intermediaria entre los prestadores directos de los servicios solicitados y señalados al anverso de este contrato. QUINTA.- EL CLIENTE reconoce y acepta su total obligación y responsabilidad de proporcionar datos veraces y correctos sobre las edades, sexo, nombres o apellidos de los usuarios-turistas, así como de los datos e información completa para la formación del itinerario y la reservación de servicios terrestres y marítimos (hoteles, visitas, autos de alquiler, restaurantes, cruceros, etc.) relevando a LA AGENCIA de cualquier responsabilidad por cambios de itinerario generados por datos mal proporcionados a LA AGENCIA, o por cualquier error en datos proporcionados por EL CLIENTE para la emisión o compra de boletos aéreos como puede ser el caso de edades, sexo nombres, apellidos, fechas, rutas, líneas aéreas, horarios, clases, categorías, etc. apegándose en su caso a las cláusulas de cancelación para servicios aéreos, terrestres, marítimos o de cruceros expresadas en este contrato. SEXTA.- Ambas partes convienen en que  LA AGENCIA  queda relevada de responsabilidades por daños, heridas, accidentes, retrasos o irregularidades que sobrevengan por causas de fuerza mayor o caso fortuito que durante la ejecución de los servicios pudiera ocurrirle a EL CLIENTE por no ser la persona directamente encargada de prestar los servicios correspondientes y por ser solo intermediarias entre estas y EL CLIENTE. SEPTIMA.- EL CLIENTE se compromete a apegarse y a respetar los reglamentos y condiciones de servicio establecidas por cada uno de los prestadores de servicios contratados por intermediación de LA AGENCIA, por lo que LA AGENCIA debe hacer del conocimiento de EL CLIENTE las que sean más importantes y en consecuencia declina cualquier responsabilidad que pudiera derivar por su incumplimiento. Así mismo, EL CLIENTE deberá por medio propios proveerse de los pasaportes o documentos de migración requeridos por las autoridades de los Estados Unidos Mexicanos, y de los países de destino ó de transito, tales como visas, permisos sanitarios, etc. en los casos de viajes internacionales y se compromete a presentarse en los aeropuertos y documentarse ante las aerolíneas con dos horas de anticipación en los casos de vuelos internacionales y con una hora y treinta minutos de anticipación en los vuelos nacionales, salvo la instrucción expresa y por escrito que reciba de LA AGENCIA. DECIMA PRIMERA.- Ambas partes convienen en que el pago de anticipos o liquidación del importe de los servicios objeto de este contrato por parte de EL CLIENTE , así como el uso del contrato mismo, cupones, boletos, cortesías, o cualquier otro documento expedido en su favor con motivo del mismo, implica de su parte la aceptación total del contrato, así como de las condiciones generales de contratación del presente contrato. DECIMA NOVENA.- Una vez que LA AGENCIA recibe por parte de EL CLIENTE el o los importes equivalente al costo de los servicios aéreos, LA AGENCIA cuenta con la autorización inmediata de EL CLIENTE para emitir, expedir o adquirir los boletos aéreos a su nombre, apegándose y aceptando las políticas de cancelación, emisión y venta de boletos de las compañías aéreas nacionales e internacionales, las políticas de expedición, emisión y venta de boletos aéreos de IATA International y a las cláusulas Vigésima Segunda y Vigésima Tercera expresadas en este contrato para el caso de los servicios aéreos. VIGESIMA.- En el caso concreto de excursiones o servicios terrestres, tanto nacionales como internacionales, EL CLIENTE podrá solicitar la cancelación de sus servicios haciéndolo saber única y estrictamente por escrito a LA AGENCIA misma que dará contestación en un lapso no mayor a 72 horas de su recepción comprobable y a falta de respuesta se entenderá que la cancelación ha sidoaceptada por LA AGENCIA admitiendo EL CLIENTE los cargos de cancelación establecidos a continuación: A) Si se efectúa hasta con un mínimo de 31 días antes de la fecha de salida, NO aplica cargos de cancelación. B) Si se efectúa de 30 a 25 días antes de la fecha de salida, un cargo por cancelación del 10% del costo total del servicio. C) Si se efectúa de 24 a 20 días antes de la fecha de salida, un cargo por cancelación del 15% del costo total del servicio. D) Si se efectúa de 19 a 15 días antes de la fecha de salida, un cargo por cancelación del  25% del costo total del servicio. E) Si se efectúa de 14 a 10 días antes de la fecha de salida, un cargo por cancelación del  50% del costo total del servicio. F) Si se efectúa con menos de 10 días antes de la fecha de salida, un cargo por cancelación del 100% del costo total del servicio. VIGESIMA PRIMERA.- En el caso concreto de los servicios contratados con empresas marítimas, navieras o de cruceros, tanto nacionales como extranjeras, EL CLIENTE podrá solicitar la cancelación de sus servicios haciéndolo saber única y estrictamente por escrito a LA AGENCIA misma que dará contestación en un lapso no mayor a 72 horas de su recepción comprobable y a falta de respuesta se entenderá que la cancelación ha sido aceptada por LA AGENCIA admitiendo EL CLIENTE los cargos de cancelación establecidos a continuación: A) Si se efectúa hasta con 17 días antes de la fecha de salida, un cargo por cancelación del 100% del costo total del servicio. B) Si se efectúa de 18 a 47 días antes de la fecha de salida, un cargo por cancelación del  50% del costo total del servicio. C) Si se efectúa con un mínimo de 48 días antes de la fecha de salida, un cargo por cancelación equivalente al total de los depósitos realizados como anticipo para realizar la reservación del servicio. VIGESIMA SEGUNDA.-  En el caso concreto de los servicios contratados con empresas aéreas, tanto nacionales como extranjeras, la política de cancelación opera de la siguiente manera: A) LA AGENCIA cuenta con la autorización del cliente para emitir, expedir, o adquirir los boletos aéreos de conformidad a la cláusula Décimo Novena de este instrumento. B) EL CLIENTE tiene conocimiento pleno y absoluto de que cualquier boleto aéreo ya expedido o emitido por LA AGENCIA o bien que ya haya sido adquirido por LA AGENCIA misma por intermediación de EL CLIENTE no es reembolsable en parte ni en la totalidad de su costo bajo ningún caso o circunstancia. C) Si la solicitud por parte de EL CLIENTE de la cancelación de las reservaciones aéreas se hicieren antes de la emisión, expedición o compra de los boletos aéreos, se aplicarán los cargos de cancelación expresados en la cláusula Vigésima de este instrumento. VIGESIMA TERCERA.- Una vez expedido los boletos aéreos a favor de el usuario-turista o de EL CLIENTE, LA AGENCIA no se responsabiliza por ningún cambio de itinerario, o por cualquier cambio o error en datos proporcionados por EL CLIENTE para la emisión de boletos aéreos como puede ser el caso de nombres, apellidos, edades, sexo, fechas, rutas, líneas aéreas, clases, categorías, etc. ocurriendo lo mismo para el caso de las reservaciones terrestres y de servicios marítimos o de cruceros. VIGESIMA SEXTA.- LA AGENCIA queda relevada de cualquier responsabilidad derivada de convenios adicionales que se hayan celebrado entre EL CLIENTE y los prestadores directos de los servicios, como son transportistas aéreos y terrestres, navieras, cruceros, hoteles, arrendadoras de autos, etc. VIGESIMA SEPTIMA.- Para el caso de que EL CLIENTE contrate los servicios de Mega Travel  Operadora, S.A. de C.V. por cuenta de diversa agencia de viajes, fungiendo la agencia de viajes como intermediaria, ya sea en el interior de la República Mexicana o en el área Metropolitana de la Ciudad de México, la agencia intermediaria tiene la obligación de hacer saber y comunicar por escrito a sus pasajeros acerca de las condiciones de contratación y de todas y cada una de las cláusulas contenidas en el presente instrumento, del mismo modo, la agencia de viajes intermediaria debe hacerle saber a sus pasajeros o usuarios-turistas que ellos se adhieren y sujetan invariablemente a este mismo contrato de adhesión y a las políticas de reservación y cancelación de los prestadores finales de los servicios. EL CONTRATO DE ADHESION INVARIABLEMENTE FORMA PARTE INTEGRAL DE LA DOCUMENTACION DE LOS SERVICIOS ADQUIRIDOS POR EL CLIENTE. EL CONTRATO DE ADHESION PUEDE SER CONSULTADO DIRECTAMENTE EN PROFECO O BIEN EN LAS OFICINAS DE MEGA TRAVEL OPERADORA, S.A. DE C.V. ES SU DERECHO. CUALQUIER PAGO POR ANTICIPO O LIQUIDACION TOTAL DE SERVICIOS IMPLICA LA ACEPTACION Y EL CONOCIMIENTO TOTAL DE LAS CLAUSULAS ENUNCIADAS EN EL CONTRATO DE ADHESION. ESTE ES UNICAMENTE UN EXTRACTO DEL CONTRATO DE ADHESION DE MEGA TRAVEL OPERADORA, S.A. DE C.V. REGISTRO PROFECO 1316-05 LIBRO 2° VOL 1° NO EXPED PFC. B.E. 7/471-2005 DE FECHA 19 DE MAYO DEL 2005.
        </td>
    </tr>
</table>
<hr><hr>
<table width='100%'>
    <tr>
        <td valign='middle'>
            <center><img src='http://lax.megatravel.com.mx/expo/img/rfcmega.jpg' width='100' height='100'></center>
        </td>
        <td rowspan='4' align='justify' style='font-size:7px;  color: #666; font-family: 'Times New Roman', Times, serif;' valign='top'>
        Documentos que sirven como comprobantes fiscales

        1.2.4.4 Para los efectos del artículo 29 del CFF, los siguientes documentos servirán como comprobantes fiscales respecto de los servicios amparados por ellos.

        I. Las copias de boletos de pasajeros, guías aéreas de cargo, órdenes de cargos misceláneos y comprobantes de cargo  por exceso de equipaje, expedidos por las líneas aéreas en formatos aprobados por la Secretaría de Comunicación y Transportes o por la Internacional Air Transport Association “IATA”.

        II. Los notas de cargo a agencias de viaje o a otras líneas aéreas.

        III. Las copias de boletos de pasajero expedidos por las líneas de transporte terrestre de pasajeros en formatos aprobados por la Secretaria de Comunicaciones y Transporte o por la Internacional Air Transport Association “IATA”, CFF 29,29, A, RCFF, 37, (RMF 2007 2,4,6) comprobante de agencias de viajes.

        1.2.4.5 Para los efectos de los artículos 29 y 29A del CFF y 37 de su Reglamento, las agencias de viajes se abstendrán de emitir comprobantes en los términos de dichos preceptos, respecto de las operaciones que realicen en calidad de comisionistas de prestadores de servicios y que vayan a ser prestados por estos últimos. En este caso deberán emitir únicamente los llamados “voucher de servicio”  que acrediten la contratación de tales servicios ante los prestadores de los mismos, cuando se requiera.

        Tampoco emitirán comprobantes respecto de los ingresos por concepto de comisiones que perciban de la línea aérea y de las notas de crédito que estás les expidan. Tales ingresos se comprobarán con los reportes de boletaje vendidos de vuelos nacionales o internacionales que elaboren las propias agencias de viajes la Internacional Air Transport Association “IATA”  respectivamente en los que se precise por líneas aéreas y por agencia de viajes, el número de boletos vendidos, el importe de las comisiones y créditos correspondientes. Dichos reportes y notas de crédito servirán a las líneas aéreas para comprobar la deducción y el acreditamiento que preceda conforme a las disposiciones fiscales.
        CFF 29,29, A, RCFF, 37, (RMF 2007 2,4,16)
        </td>
    </tr>
</table>
</td>
</tr>
</table>
</body>
</html>