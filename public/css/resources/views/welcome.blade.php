<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Hari Lebaran</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Petemoss&family=Quicksand:wght@300;400;500&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="text-center">
            <img src="giphy.gif" alt="" id="image-alt" width="80vh;">
        </div>
        <div class="image-center">
            <img src="https://c.tenor.com/W8JwWPQ2ExgAAAAj/assalamualaikum-breakfasting.gif" alt="" id="image-gif">
        </div>
        <div class="text-center">
            <p id="text" style="text-align: center;"></p>
        </div>

        <div class="text-center">
            <button type="button" class="next" value="0">Klik disini >>></button>
        </div>
    </div>

    <script src="script.js"></script>


    <!-- ========================================================================== -->
    <!-- ========================================================================== -->
    <!-- ========================================================================== -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        document.onmousedown = disableclick;
        status = "Jangan Ngintip Donk Sayang (by: PRODI INTERSKALA)";

        function disableclick(event) {
            if (event.button == 2) {
                alert(status);
                return false;
            }
        }

    </script>




    <script type="text/javascript">
        window.addEventListener("keydown", function (e) {
            if (e.ctrlKey && (e.which == 65 || e.which == 66 || e.which == 67 || e.which == 73 || e.which ==
                    80 || e.which == 83 || e.which == 85 || e.which == 86)) {
                e.preventDefault()
            }
        });
        document.keypress = function (e) {
            if (e.ctrlKey && (e.which == 65 || e.which == 66 || e.which == 67 || e.which == 73 || e.which == 80 || e
                    .which == 83 || e.which == 85 || e.which == 86)) {}
            return false
        }

    </script>
    <script type="text/javascript">
        document.onkeydown = function (e) {
            e = e || window.event;
            if (e.keyCode == 123 || e.keyCode == 18) {
                return false
            }
        }

    </script>
</body>

</html>
