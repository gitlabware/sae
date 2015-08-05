<style type="text/css" media="print">
    @page {
        size: landscape;

    }
    *{
        background-color: white !important;
        margin: 0px !important;
        padding: 0px !important;

    }

    .no-imprime{
        display: none !important;
    }


    .cabecera-r{

    }

    .block{
        margin-left: 0.7cm !important;
        margin-right: 0.7cm !important;
        margin-top: 0.7cm !important;
        border: 0px;
    }
    .fuerte td{
        font-weight: bold !important;
    }

    .CSSTableGenerator {
        margin:0px;padding:0px;
        width:100%;
        border:1px solid #000000;

        -moz-border-radius-bottomleft:0px;
        -webkit-border-bottom-left-radius:0px;
        border-bottom-left-radius:0px;

        -moz-border-radius-bottomright:0px;
        -webkit-border-bottom-right-radius:0px;
        border-bottom-right-radius:0px;

        -moz-border-radius-topright:0px;
        -webkit-border-top-right-radius:0px;
        border-top-right-radius:0px;

        -moz-border-radius-topleft:0px;
        -webkit-border-top-left-radius:0px;
        border-top-left-radius:0px;
    }.CSSTableGenerator table{
        border-collapse: collapse;
        border-spacing: 0;
        width:100%;
        height:100%;
        margin:0px;padding:0px;
    }.CSSTableGenerator tr:last-child td:last-child {
        -moz-border-radius-bottomright:0px;
        -webkit-border-bottom-right-radius:0px;
        border-bottom-right-radius:0px;
    }
    .CSSTableGenerator table tr:first-child td:first-child {
        -moz-border-radius-topleft:0px;
        -webkit-border-top-left-radius:0px;
        border-top-left-radius:0px;
    }
    .CSSTableGenerator table tr:first-child td:last-child {
        -moz-border-radius-topright:0px;
        -webkit-border-top-right-radius:0px;
        border-top-right-radius:0px;
    }.CSSTableGenerator tr:last-child td:first-child{
        -moz-border-radius-bottomleft:0px;
        -webkit-border-bottom-left-radius:0px;
        border-bottom-left-radius:0px;
    }.CSSTableGenerator tr:hover td{
        background-color:#ffffff;


    }
    .CSSTableGenerator td{
        vertical-align:middle !important;

        background-color:#ffffff !important;

        border:1px solid #000000 !important;
        border-width:0px 1px 1px 0px !important;
        padding:1px !important;
        font-size:10px !important;
        font-family:Arial !important;
        color:#000000 !important;
    }.CSSTableGenerator tr:last-child td{
        border-width:0px 1px 0px 0px;
    }.CSSTableGenerator tr td:last-child{
        border-width:0px 0px 1px 0px;
    }.CSSTableGenerator tr:last-child td:last-child{
        border-width:0px 0px 0px 0px;
    }
</style>
<style>
    .CSSTableGenerator {
        margin:0px;padding:0px;
        width:100%;
        border:1px solid #000000;

        -moz-border-radius-bottomleft:0px;
        -webkit-border-bottom-left-radius:0px;
        border-bottom-left-radius:0px;

        -moz-border-radius-bottomright:0px;
        -webkit-border-bottom-right-radius:0px;
        border-bottom-right-radius:0px;

        -moz-border-radius-topright:0px;
        -webkit-border-top-right-radius:0px;
        border-top-right-radius:0px;

        -moz-border-radius-topleft:0px;
        -webkit-border-top-left-radius:0px;
        border-top-left-radius:0px;
    }.CSSTableGenerator table{
        border-collapse: collapse;
        border-spacing: 0;
        width:100%;
        height:100%;
        margin:0px;padding:0px;
    }.CSSTableGenerator tr:last-child td:last-child {
        -moz-border-radius-bottomright:0px;
        -webkit-border-bottom-right-radius:0px;
        border-bottom-right-radius:0px;
    }
    .CSSTableGenerator table tr:first-child td:first-child {
        -moz-border-radius-topleft:0px;
        -webkit-border-top-left-radius:0px;
        border-top-left-radius:0px;
    }
    .CSSTableGenerator table tr:first-child td:last-child {
        -moz-border-radius-topright:0px;
        -webkit-border-top-right-radius:0px;
        border-top-right-radius:0px;
    }.CSSTableGenerator tr:last-child td:first-child{
        -moz-border-radius-bottomleft:0px;
        -webkit-border-bottom-left-radius:0px;
        border-bottom-left-radius:0px;
    }.CSSTableGenerator tr:hover td{
        background-color:#ffffff;


    }
    .CSSTableGenerator td{
        vertical-align:middle;

        background-color:#ffffff;

        border:1px solid #000000;
        border-width:0px 1px 1px 0px;
        padding:2px;
        font-size:10px;
        font-family:Arial;
        color:#000000;
    }.CSSTableGenerator tr:last-child td{
        border-width:0px 1px 0px 0px;
    }.CSSTableGenerator tr td:last-child{
        border-width:0px 0px 1px 0px;
    }.CSSTableGenerator tr:last-child td:last-child{
        border-width:0px 0px 0px 0px;
    }
    .fuerte td{
        font-weight: bold;
    }
    .titulo_t td{
        font-weight: bold;
        text-align: center;
        font-size: 15px;

    }


</style>
<div class="block">
    <table class="CSSTableGenerator titulo_t">
        <tr>
            <td>
                CUENTAS DE MANTENIMIENTO POR COBRAR - <?php echo $ano; ?>  AL <?php echo $fecha; ?>
            </td>
        </tr>
    </table>
    <table class="CSSTableGenerator">
        <tr class="fuerte">
            <td style="width: 10%; ">Ambiente</td>
            <td style="width: 10%;">Propietario</td>
            <td>A&ntilde;o</td>
            <td>ENE</td>
            <td>FEB</td>
            <td>MAR</td>
            <td>ABR</td>
            <td>MAY</td>
            <td>JUN</td>
            <td>JUL</td>
            <td>AGO</td>
            <td>SEP</td>
            <td>OCT</td>
            <td>NOV</td>
            <td>DIC</td>
            <td>TOTAL</td>
        </tr>
        <?php $total = 0.00; ?>
        <?php foreach ($ambientes as $am): ?>
          <tr>
              <td><?php echo $am['Ambiente']['nombre'] ?></td>
              <td><?php echo $am['User']['nombre'] ?></td>
              <td><?php echo $ano; ?></td>
              <td>
                <?php
                    $monto = $this->requestAction(array('action' => 'get_monto_amb_m', $am['Ambiente']['id'],$fecha,$ano,1));
                    $subtotal = $subtotal + $monto;
                    $total_a[$i] = $total_a[$i] + $monto;
                    $total = $total + $monto;
                    echo $monto;
                    ?>
              </td>
              <td>
                <?php
                    $monto = $this->requestAction(array('action' => 'get_monto_amb_m', $am['Ambiente']['id'],$fecha,$ano,2));
                    $subtotal = $subtotal + $monto;
                    $total_a[$i] = $total_a[$i] + $monto;
                    $total = $total + $monto;
                    echo $monto;
                    ?>
              </td>
              <td>
                <?php
                    $monto = $this->requestAction(array('action' => 'get_monto_amb_m', $am['Ambiente']['id'],$fecha,$ano,3));
                    $subtotal = $subtotal + $monto;
                    $total_a[$i] = $total_a[$i] + $monto;
                    $total = $total + $monto;
                    echo $monto;
                    ?>
              </td>
              <td>
                <?php
                    $monto = $this->requestAction(array('action' => 'get_monto_amb_m', $am['Ambiente']['id'],$fecha,$ano,4));
                    $subtotal = $subtotal + $monto;
                    $total_a[$i] = $total_a[$i] + $monto;
                    $total = $total + $monto;
                    echo $monto;
                    ?>
              </td>
              <td>
                <?php
                    $monto = $this->requestAction(array('action' => 'get_monto_amb_m', $am['Ambiente']['id'],$fecha,$ano,5));
                    $subtotal = $subtotal + $monto;
                    $total_a[$i] = $total_a[$i] + $monto;
                    $total = $total + $monto;
                    echo $monto;
                    ?>
              </td>
              <td>
                <?php
                    $monto = $this->requestAction(array('action' => 'get_monto_amb_m', $am['Ambiente']['id'],$fecha,$ano,6));
                    $subtotal = $subtotal + $monto;
                    $total_a[$i] = $total_a[$i] + $monto;
                    $total = $total + $monto;
                    echo $monto;
                    ?>
              </td>
              <td>
                <?php
                    $monto = $this->requestAction(array('action' => 'get_monto_amb_m', $am['Ambiente']['id'],$fecha,$ano,7));
                    $subtotal = $subtotal + $monto;
                    $total_a[$i] = $total_a[$i] + $monto;
                    $total = $total + $monto;
                    echo $monto;
                    ?>
              </td>
              <td>
                <?php
                    $monto = $this->requestAction(array('action' => 'get_monto_amb_m', $am['Ambiente']['id'],$fecha,$ano,8));
                    $subtotal = $subtotal + $monto;
                    $total_a[$i] = $total_a[$i] + $monto;
                    $total = $total + $monto;
                    echo $monto;
                    ?>
              </td>
              <td>
                <?php
                    $monto = $this->requestAction(array('action' => 'get_monto_amb_m', $am['Ambiente']['id'],$fecha,$ano,9));
                    $subtotal = $subtotal + $monto;
                    $total_a[$i] = $total_a[$i] + $monto;
                    $total = $total + $monto;
                    echo $monto;
                    ?>
              </td>
              <td>
                <?php
                    $monto = $this->requestAction(array('action' => 'get_monto_amb_m', $am['Ambiente']['id'],$fecha,$ano,10));
                    $subtotal = $subtotal + $monto;
                    $total_a[$i] = $total_a[$i] + $monto;
                    $total = $total + $monto;
                    echo $monto;
                    ?>
              </td>
              <td>
                <?php
                    $monto = $this->requestAction(array('action' => 'get_monto_amb_m', $am['Ambiente']['id'],$fecha,$ano,11));
                    $subtotal = $subtotal + $monto;
                    $total_a[$i] = $total_a[$i] + $monto;
                    $total = $total + $monto;
                    echo $monto;
                    ?>
              </td>
              <td>
                <?php
                    $monto = $this->requestAction(array('action' => 'get_monto_amb_m', $am['Ambiente']['id'],$fecha,$ano,12));
                    $subtotal = $subtotal + $monto;
                    $total_a[$i] = $total_a[$i] + $monto;
                    $total = $total + $monto;
                    echo $monto;
                    ?>
              </td>
          </tr>
        <?php endforeach; ?>
        <tr>
            <td></td>
            <td></td>
            <td>TOTALES</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <br>
    <div class="row ocultar-imp">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary col-md-12" onclick="window.print();">IMPRIMIR</button>
        </div>
    </div>
    <br>
</div>