<?php
include "actions.php";
include "header.html";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>CaffeM</title>
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

        <div id="page-content-wrapper">

            <!--Forma za update artikla-->
            <?php
                if (isset($_GET["editart"])) {

                    $id = $_GET["editart"] ?? null;
                    $where = array("id"=>$id,);
                    $row = $obj->select("item",$where);

                ?>
            <div class="insForma d-flex justify-content-start align-items-center">
                <form class="col-sm-4" action="actions.php" method="POST">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Naziv</label>
                        <input type="text" name="naziv" class="form-control" id="formGroupExampleInput"
                            placeholder="Naziv" value="<?php echo $row["name"]?>">
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
            </div>
            <?php
                }else{
            ?>
            <div class="insForma d-flex justify-content-start align-items-center">
                <form class="col-sm-4" action="actions.php" method="POST">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Naziv</label>
                        <input type="text" name="naziv" class="form-control" id="formGroupExampleInput"
                            placeholder="Naziv">
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
            </div>
            <?php
                }
            ?>

            <!--Prikaz artikala-->
            <div class="artikal d-flex justify-content-center align-items-center">
                <table class="table table-bordered col-sm-12 table-hover">
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
                            <td style="display: flex; flex-direction: row; flex-wrap: wrap; justify-content: center; align-items: center; align-content: stretch; ">
                                <a href="index.php?editart=<?php echo $row["id"]?>"
                                    role="button"><span style="color: #393232; border: 1px solid black; border-radius: 5px; font-size: 20px; display: flex; justify-content: center; align-items: center; flex-wrap: wrap; padding: 5px"><i class="fas fa-user-edit"></i></span></a>
                                <a href="actions.php?delart=<?php echo $row["id"]?>"
                                    role="button"><span style="color: #393232; border: 1px solid black; border-radius: 5px; font-size: 20px; display: flex; justify-content: center; align-items: center; flex-wrap: wrap; width:50%; padding: 5px"><i class="fas fa-trash-alt"></i></span></a>
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
    </div>

</body>

</html>