<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .error {
            color: #FF0000;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <?php
    $name = $description = $price = $photo = "";
    $nameErr = $descriptionErr = $priceErr = $photoErr = "";
    $valid_name = $valid_description = $valid_price = $valid_photo = false;


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["name"])) {
            $nameErr = "Name is Required";
            $valid_name = false;
        } else {
            $name = test_input($_POST["name"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameErr = "Only letters and white space allowed";
                $valid_name = false;
            } else {
                $valid_name = true;
            }
        }

        if (empty($_POST["description"])) {
            $descriptionErr = "description is Required";
            $valid_description = false;
        } else {
            $description = test_input($_POST["description"]);
            $valid_description = true;
        }

        if (empty($_POST["price"])) {
            $priceErr = "price is Required";
            $valid_price = false;
        } else {
            $price = test_input($_POST["price"]);
            $valid_price = true;
        }

        if (empty($_POST["photo"])) {
            //$photoErr = "Photo is required";
        } else {
            $photo = test_input($_POST["photo"]);
            $valid_photo = true;
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    ?>


    <section class="row justify-content-center">
        <section class="row mt-3 bg-col-12 col-sm-6 com-md-4 ">
            <h2 class="fw-bold">Add Data</h2>
            <p><span class="error">* required field</span></p>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                <div class="mb-3">
                    <label for="name">Name:</label><span class="error">*
                        <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                        <?php if (isset($nameErr)) { ?><p><?php echo $nameErr ?></p><?php } ?></span>

                </div>

                <div class="mb-3">
                    <label for="name">Price:</label><span class="error">*
                        <input type="number" class="form-control" name="price" value="<?php echo $price; ?>">
                        <?php if (isset($priceErr)) { ?><p><?php echo $priceErr ?></p><?php } ?></span>
                </div>

                <div class="mb-3">
                    <label for="name">Description:</label><span class="error">*
                        <textarea class="form-control" name="description" value="<?php echo $description; ?>"></textarea>
                        <?php if (isset($descriptionErr)) { ?><p><?php echo $descriptionErr ?></p><?php } ?></span>
                </div>

                <div class="mb-3">
                    <label for="name">Images:</label><span class="error">*
                        <input type="file" accept="image/*" name="photo" onchange="loadFile(event)" value="<?php echo $photo; ?>">
                        <img id="output" />
                        <script>
                            var loadFile = function(event) {
                                var output = document.getElementById('output');
                                output.src = URL.createObjectURL(event.target.files[0]);
                                output.onload = function() {
                                    URL.revokeObjectURL(output.src) // free memory
                                }
                            };
                        </script>
                    </span>
                </div>

                <div class="col-12 ">
                    <input class="btn btn-dark" type="submit" name="submit" value="Add">
                </div>
            </form>
        </section>
    </section>

    <?php
    if ($valid_name && $valid_description && $valid_price && $valid_photo == true) {
        echo $name;
        echo "<br>";
        echo $description;
        echo "<br>";
        echo $price;
        echo "<br>";
        echo $photo;
        include 'insert_data.php';
    }
    ?>
</body>

</html>