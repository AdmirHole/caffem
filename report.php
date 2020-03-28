<?php
    include "actions.php";
    include "header.html";
?>

<head>
    <title>Report</title>
    <script src="js/app.js"></script>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading">Caffe Managment</div>
            <div class="list-group list-group-flush">
                <a href="index.php" class="list-group-item list-group-item-action bg-light">Home</a>
                <a href="stanjeSmjene.php" class="list-group-item list-group-item-action bg-light">Stanje smjene</a>
                <a href="report.php" class="list-group-item list-group-item-action bg-light">Mjesecni izvjestaj</a>
            </div>
        </div>

        <!--Report-->
        <div id="page-content-wrapper">
            <div class="report-content d-flex justify-content-center align-items-center">
                <table class="table table-bordered col-sm-12 table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Naziv</th>
                            <th scope="col" id="utroseno">Utroseno</th>
                            <th scope="col" id="cijutr">Cijena utrosenog</th>
                            <th scope="col">Total</th>
                            <th scope="col">Datum</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                     $myrow = $obj->select_record();
                     for($i = 0; $i < count($myrow); $i++) {
                     foreach ($myrow[$i] as $row) {
                ?>
                        <tr>
                            <td><?php echo $row["name"];?></td>
                            <td><?php echo $row['utroseno'];?> kom</td>
                            <td><?php echo $row['cijena_utro'];?> KM</td>
                            <td><?php echo $row['total_smjene'];?> KM</td>
                            <td><?php echo $row['time'];?></td>
                        </tr>


                        <?php
                     }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>