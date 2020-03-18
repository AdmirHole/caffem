<?php
include "actions.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    <title>CaffeM</title>
</head>

<body>
    <div class="container">
        <div class="row">

            <!--Forma za update artikla-->
            <?php
                if (isset($_GET["editart"])) {

                    $id = $_GET["editart"] ?? null;
                    $where = array("id"=>$id,);
                    $row = $obj->select("item",$where);

                ?>
            <form class="col-sm-4" action="actions.php" method="POST">
                <div class="form-group">
                    <label for="formGroupExampleInput">Naziv</label>
                    <input type="text" name="naziv" class="form-control" id="formGroupExampleInput" placeholder="Naziv"
                        value="<?php echo $row["name"]?>">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Cijena</label>
                    <input type="text" name="cijena" class="form-control" id="formGroupExampleInput2"
                        placeholder="Cijena" value="<?php echo $row["price"] ?>">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput3">Grupa</label>
                    <input type="text" name="grupa" class="form-control" id="formGroupExampleInput3"
                        placeholder="Grupa" value="<?php echo $row["group"] ?>">
                    <input type="hidden" name="id" value="<?php echo $row["id"];?>">
                </div>
                <button type="submit" name="updateart" class="btn btn-primary">Update</button>
            </form>
            <?php
                }else{
            ?>
            <form class="col-sm-4" action="actions.php" method="POST">
                <div class="form-group">
                    <label for="formGroupExampleInput">Naziv</label>
                    <input type="text" name="naziv" class="form-control" id="formGroupExampleInput" placeholder="Naziv">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Cijena</label>
                    <input type="text" name="cijena" class="form-control" id="formGroupExampleInput2"
                        placeholder="Cijena">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput3">Grupa</label>
                    <input type="text" name="grupa" class="form-control" id="formGroupExampleInput3"
                        placeholder="Grupa">
                </div>
                <button type="submit" name="insertart" class="btn btn-primary">Add Item</button>
            </form>
            <?php
                }
            ?>

            <!--Prikaz artikala-->
            <table class="table table-bordered col-sm-8 table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Naziv</th>
                        <th scope="col">Cijena</th>
                        <th scope="col">Grupa</th>
                        <th scope="col">Količina</th>
                        <th scope="col">Ulaz</th>
                        <th scope="col">#</th>

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
                        <td><?php echo $row['amount'];?></td>
                        <td>
                            <form action="actions.php" method="POST">
                                <div class="input-group mb-3">

                                    <input type="hidden" name="addid" value=<?php echo $row["id"]?>>
                                    <input type="text" class="form-control" name="kolicina" placeholder="Količina"
                                        aria-label="Količina" aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit"
                                            id="button-addon<?php echo $i++;?> " name="addkol">Add</button>
                                    </div>
                                </div>
                            </form>
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="index.php?editart=<?php echo $row["id"]?>"
                                role="button">Edit</a>
                            <a class="btn btn-primary btn-sm" href="actions.php?delart=<?php echo $row["id"]?>"
                                role="button">Delete</a>
                        </td>
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

</html>