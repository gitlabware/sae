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
        padding:7px;
        font-size:10px;
        font-family:Arial;
        font-weight:bold;
        color:#000000;
    }.CSSTableGenerator tr:last-child td{
        border-width:0px 1px 0px 0px;
    }.CSSTableGenerator tr td:last-child{
        border-width:0px 0px 1px 0px;
    }.CSSTableGenerator tr:last-child td:last-child{
        border-width:0px 0px 0px 0px;
    }
</style>
<div class="block">
    <table class="CSSTableGenerator">
        <tr>
            <td></td>
            <td>
                <span class="text-success" style="font-size: 16px;">RECIBO</span><br>
                <span class="text-success" style="font-size: 14px;">INGRESO POR MANTENIMIENTO Y OTROS</span>
            </td>
        </tr>
    </table>
    <table class="CSSTableGenerator" style="margin-top:-1px;">
        <tr>
            <td><span class="text-success">Propietario: </span></td>
            <td><?php echo $recibo['Propietario']['nombre'];?></td>
            <td>
                <span class="text-success">FECHA: <?php echo date('d/m/Y');?></span>
            </td>
        </tr>
    </table>
    <table class="CSSTableGenerator" style="margin-top:-1px;">
        <tr>
            <td><span class="text-success">Pagador: </span></td>
            <td><?php 
            if(!empty($recibo['Recibo']['inquilino'])){
              echo $recibo['Inquilino']['User']['nombre'].' (Inquilino)';
            }else{
              echo $recibo['Propietario']['nombre'].' (Propietario)';
            }
            ?></td>
            <td>
                <span class="text-success">Nro: <?php echo $recibo['Recibo']['numero'];?></span>
            </td>
        </tr>
    </table>
    <table class="CSSTableGenerator" style="margin-top:-1px;">
        <tr>
            <td><span>Nro</span></td>
            <td><span>Concepto</span></td>
            <td><span>Importe Total Bs</span></td>
        </tr>
        <?php $i = 0;$total_i = 0.00;?>
        <?php foreach ($pagos as $pa):$i++;?>
        <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $pa['Concepto']['nombre'];?></td>
            <td><?php echo $pa[0]['imp_total'];?></td>
        </tr>
        <?php $total_i = $total_i + $pa[0]['imp_total'];?>
        <?php endforeach;?>
        <tr>
            <td></td>
            <td>TOTAL BOLIVIANOS</td>
            <td><?php echo $total_i;?></td>
        </tr>
    </table>
</div>