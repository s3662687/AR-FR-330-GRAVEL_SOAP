<!DOCTYPE html>
<html>

<head>
    <title>FRUIT BATH</title>
    <meta charset="UTF-8">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->

    <!-- using Google CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <link rel="stylesheet" href="styles/navbar.css"> -->
    <link rel="stylesheet" href="styles/category.css">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" type="text/css" href=".scripts/slick/slick.css">
    <link rel="stylesheet" type="text/css" href=".scripts/slick/slick-theme.css">
    <style type="text/css">
        html,
        body {
            margin: 0;
            padding: 0;
        }

        * {
            box-sizing: border-box;
        }

        .slider {
            width: 50%;
            margin: 100px auto;
        }

        .slick-slide {
            margin: 0px 20px;
        }

        .slick-slide img {
            width: 100%;
        }

        .slick-prev:before,
        .slick-next:before {
            color: black;
        }


        .slick-slide {
            transition: all ease-in-out .3s;
            opacity: .2;
        }

        .slick-active {
            opacity: .5;
        }

        .slick-current {
            opacity: 1;
        }
    </style>
</head>

<body>
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->


    <ul>
        <li><a class="active" href="index.html">Home</a></li>
        <li><a href="recipes.html">Recipes</a></li>
        <li><a href="category.php">Explore</a></li>
        <li><a href="tutorials.html">Tutorials</a></li>
        <li><a href="pantry.html">Pantry</a></li>
        <li><a href="images.html">Images</a></li>
        <li><a href="profile.html">Profile</a></li>
        <li><a href="register.html">Register</a></li>
        <li><a href="login.html">Login</a></li>
    </ul>

    <div class="content">
        <h1 class="heading">Explore cuisine around the world!</h1>
        <h2 class="heading">Region:</h2>

        <section class="autoplay4 slider">
            <?php

                $strJsonFileContents = file_get_contents("data/category.json");
                $array = json_decode($strJsonFileContents);

                for ($index = 0; $index < count($array); $index++) {
                    foreach($array[$index] as $lable=>$value) { 
                        if($lable == "occasion" && $value == "null") {
                            foreach($array[$index] as $lable=>$value) {
                                if($lable == "image") {
                                    $image = $value;
                                }
                                if($lable == "region") { 
                                    $region = $value;
                                }
                            }
            ?>
            <div>
                <a href='category1.php?category=<?= $region ?>'>
                    <img src='<?= $image; ?>'>
                    <p><?= $region; ?></p>
                </a>
            </div>

            <?php        
                        }
                    }
                }
            ?>
        </section>
        

        <h2 class="heading">Occasion:</h2>

        <section class="autoplay3 slider">
        <?php

            $strJsonFileContents = file_get_contents("data/category.json");
            $array = json_decode($strJsonFileContents);

            for ($index = 0; $index < count($array); $index++) {
                foreach($array[$index] as $lable=>$value) { 
                    if($lable == "region" && $value == "null") {
                        foreach($array[$index] as $lable=>$value) {
                            if($lable == "image") {
                                $image = $value;
                            }
                            if($lable == "occasion") { 
                                $occasion = $value;
                            }
                        }
        ?>
            <div>
                <a href='category1.php?category=<?= $occasion ?>'>
                    <img src='<?= $image; ?>'>
                    <p><?= $occasion; ?></p>
                </a>
            </div>

        <?php        
                    }
                }
            }
        ?>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src=".scripts/slick/slick.js" type="text/javascript" charset="utf-8"></script>
    <script src="./scripts/slick.js" type="text/javascript" charset="utf-8"></script>
</body>

</html>