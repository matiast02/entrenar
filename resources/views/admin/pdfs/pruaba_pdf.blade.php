<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Clientes</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="{{ URL::asset('css/pdf.css')}}" rel="stylesheet" type="text/css">
</head>

<body>

<div class="col-md-12">

    <div class="header" >
        <table width="100%">
            <tr>
                <td width="55%"><img src="{{ URL::asset('images/logo_light.png')}}" height="35px" width="160px"></td>
                <td>Ericsson Internal <br>
                    METHOD OF PROCEDURE (29)
                </td>
            </tr>
        </table>
    </div>


    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Reporte de Cliente - <?=  $date; ?></h3>
        </div><!-- /.box-header -->

        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 40px">id</th>
                    <th style="width: 40px">Nombre</th>
                    <th style="width: 40px">Apellido</th>
                </tr>
                </thead>

                <tbody>

                <?php foreach($data as $cliente){ ?>

                <tr>
                    <td style="width: 10px" ><?= $cliente->id; ?></td>
                    <td><?= $cliente->nombre; ?></td>
                    <td><?= $cliente->apellido; ?></td>
                </tr>

                <?php  } ?>

                </tbody>
            </table>
        </div><!-- /.box-body -->

        <div class="box-footer clearfix">
            <h1>Los pibes piolas</h1>
        </div>

    </div><!-- /.box -->


</div>





    <div class="col-md-12">
        <div id="header" >
            <table width="100%">
                <tr>
                    <td width="55%"><img src="{{ URL::asset('images/logo_light.png')}}" height="35px" width="160px"></td>
                    <td>Ericsson Internal <br>
                        METHOD OF PROCEDURE (29)
                    </td>
                </tr>
            </table>

            <table width="100%" border="1">
                <tr>
                    <td>Prepared (Subject resp) <br>
                        TAM/
                    </td>
                    <td colspan="2">No.</td>
                </tr>
                <tr>
                    <td>Approved (Document resp)  |Checked </td>
                    <td>Checked Date  | Rev</td>
                    <td>Reference</td>
                </tr>
            </table>
        </div>

        <div id="content">
            <p>the first page</p>
            <p style="page-break-before: always;">the second page</p>
        </div>

        <div class="footer">
            <h1>Hola Guachin</h1>
        </div>
    </div>

</body>
</html>
