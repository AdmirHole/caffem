
$(document).ready(function () {

    var kol2;
    var row;
    var kol;
    $(".poljeIzb").on({
        "keyup": function () {

            //Izbrojano 
            kol2 = parseInt($(this).val());

            row = $(this).closest("tr"); // Finds the closest row <tr> 

            //Cijena artikla
            var cijena = row.find("td:nth-child(3)").html();

            //Kolicina u skladistu
            kol = parseInt(row.find("td:nth-child(5)").html());
            //console.log(cijena);


            //Utroseno
            var utroseno = kol - kol2;
            //console.log("Utroseno " + utroseno);
            var utrosenotd = row.find("td:nth-child(7)").text(utroseno);

            //Cijena utrosenog artikla
            var cijutr = utroseno * cijena;
            //console.log(cijutr + "KM");
            var cijutrtd = row.find("td:nth-child(8)").text(cijutr + " KM");

            var arr = [];

            $('tr:not(:last) td:nth-child(8)').each(function () {
                var data = parseInt($(this).html());
                arr.push(data);
            });
            var sum = 0;
            for (var i = 0; i < arr.length; i++) {
                sum += arr[i] << 0;
            }
            $("#total").html(sum + " KM");




        },
        //Funkcija koja insertuje novu vrijednost u bazu!!!
        "change": function () {

            var id = row.find("th:first").html();
            //console.log(kol2);

            if (kol2 < kol & kol2 !== 0) {
                $.post("actions.php", {
                    id: id,
                    kol: kol2
                },
                    function (data, status) {

                        var cont = $(data).find("#kolicina" + id).text();
                        //console.log(cont);
                        $("#kolicina" + id).empty().append(cont);


                    });
            } else {
                alert("Warning");
            }
        }
    });

    //Spasavanje u bazu za mjesecni izvjestaj

    $("#save").click(function () {
        $("table tbody tr:not(:last)").each(function () {
            var id_art = parseInt($(this).find("th:nth-child(1)").html());
            var utroseno = parseInt($(this).find("td:nth-child(7)").html());
            var cijUtro = parseInt($(this).find("td:nth-child(8)").html());
            var total = parseInt($("#total").html());
            //console.log(utroseno);
            if (utroseno > 0) {
                $.post("actions.php", {
                    id_item: id_art,
                    utroseno: utroseno,
                    cijena_utro: cijUtro,
                    total_smjene: total
                },
                    function (data, status) {
                        console.log(status);
                    });
            }
        });
    });
});
