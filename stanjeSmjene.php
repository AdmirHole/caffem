<?php
    include "actions.php";
    include "header.html";
?>

<head>
    <script src="app.js"></script>
    <title>Stanje</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <!--Prikaz artikala-->
            <table class="table table-bordered col-sm-12 table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Naziv</th>
                        <th scope="col">Cijena</th>
                        <th scope="col">Grupa</th>
                        <th scope="col">Količina</th>
                        <th scope="col" id="izbrojano">Izbrojano</th>
                        <th scope="col" id="utroseno">Utroseno</th>
                        <th scope="col" id="cijutr">Cijena utrosenog</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                     $myrow = $obj->fetch_record("item");
                     for($i = 0; $i < count($myrow); $i++) {
                     foreach ($myrow[$i] as $row) {
                      
                ?>
                    <tr>
                        <th scope="row"><?php echo $row["id"];?></th>
                        <td><?php echo $row["name"];?></td>
                        <td><?php echo $row['price'];?></td>
                        <td><?php echo $row['group'];?></td>
                        <td id="kolicina<?php echo $row["id"];?>"><?php echo $row['amount'];?></td>
                        <td>
                            <input type="text" class="form-control poljeIzb" placeholder="Količina"
                                aria-label="Količina" aria-describedby="button-addon2">
                        </td>
                        <td></td>
                        <td></td>
                    </tr>


                    <?php
                     }
                    }
                    
                    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><button class="btn btn-primary" id="save">Save</button></td>
                        <th>Total</th>
                        <td id="total"></td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>