<?php
    include "actions.php";
    include "header.html";
?>

<head>
    <title>Report</title>
    <script src="app.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <!--Report-->
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
</body>