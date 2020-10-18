<?php
include 'db_connection.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Search Engine</title>

    <!-- jQuery -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- CSS -->
    <link href="CSS/Result.css" type="text/css" rel="stylesheet">
</head>

<body>
    <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="recipes.html">Recipes</a></li>
        <li><a class="active" href="tutorials.html">Tutorials</a></li>
        <li><a href="pantry.html">Pantry</a></li>
        <li><a href="images.html">Images</a></li>
        <li><a href="profile.html">Profile</a></li>
        <li><a href="register.html">Register</a></li>
        <li><a href="login.html">Login</a></li>
    </ul>

    <main>
        <div class="contain">
            <form action="" method="GET" id="search">
                <!-- search -->
                <input type="text" name="keyword" id="Search_bar" placeholder="Search for recipes" value=<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>>
                <input type="submit" value="Search" name="action" class="submit">
            </form>
        </div>


        <section class="filter">
            <p>Filter by:</p>

            <div class='filter_container'>
                <button onclick="dropdown('price_fil')" class="filterbtn">Price</button>
                <div id="price_fil" class="options">
                    <div class="selectable">
                        <label for="10">$0 to $10</label>
                        <input type="checkbox" name="price[]" value="10" form="search" class="selector price" onchange="checkboxes('price[]','10')" <?php IsChecked('price', '10') ?>>
                    </div>
                    <div class="selectable">
                        <label for="15">$0 to $15</label>
                        <input type="checkbox" name="price[]" value="15" form="search" class="selector price" onchange="checkboxes('price[]','15')" <?php IsChecked('price', '15') ?>>
                    </div>
                    <div class="selectable">
                        <label for="20">$0 to $20</label>
                        <input type="checkbox" name="price[]" value="20" form="search" class="selector price" onchange="checkboxes('price[]','20')" <?php IsChecked('price', '20') ?>>
                    </div>
                </div>
            </div>

            <div class='filter_container'>
                <button onclick="dropdown('time_fil')" class="filterbtn">Total time</button>
                <div id="time_fil" class="options">
                    <div class="selectable">
                        <label for="15">0 to 15 minutes</label>
                        <input type="checkbox" name="time[]" value="15" form="search" class="selector time" onchange="checkboxes('time[]','15')" <?php IsChecked('time', '15') ?>>
                    </div>
                    <div class="selectable">
                        <label for="30">0 to 30 minutes</label>
                        <input type="checkbox" name="time[]" value="30" form="search" class="selector time" onchange="checkboxes('time[]','30')" <?php IsChecked('time', '30') ?>>
                    </div>
                    <div class="selectable">
                        <label for="45">0 to 45 minutes</label>
                        <input type="checkbox" name="time[]" value="45" form="search" class="selector time" onchange="checkboxes('time[]','45')" <?php IsChecked('time', '45') ?>>
                    </div>
                    <div class="selectable">
                        <label for="60">0 to 60 minutes</label>
                        <input type="checkbox" name="time[]" value="60" form="search" class="selector time" onchange="checkboxes('time[]','60')" <?php IsChecked('time', '60') ?>>
                    </div>
                </div>
            </div>

            <div class='filter_container'>
                <button onclick="dropdown('rating_fil')" class="filterbtn">Ratings</button>
                <div id="rating_fil" class="options">
                    <div class="selectable">
                        <label for="0">0/5</label>
                        <input type="checkbox" name="rating[]" value="0" form="search" class="selector rating" <?php IsChecked('rating[]', '0') ?>>
                    </div>
                    <div class="selectable">
                        <label for="1">1/5</label>
                        <input type="checkbox" name="rating[]" value="1" form="search" class="selector rating" <?php IsChecked('rating[]', '1') ?>>
                    </div>
                    <div class="selectable">
                        <label for="2">2/5</label>
                        <input type="checkbox" name="rating[]" value="2" form="search" class="selector rating" <?php IsChecked('rating[]', '2') ?>>
                    </div>
                    <div class="selectable">
                        <label for="3">3/5</label>
                        <input type="checkbox" name="rating[]" value="3" form="search" class="selector rating" <?php IsChecked('rating[]', '3') ?>>
                    </div>
                    <div class="selectable">
                        <label for="4">4/5</label>
                        <input type="checkbox" name="rating[]" value="4" form="search" class="selector rating" <?php IsChecked('rating[]', '4') ?>>
                    </div>
                    <div class="selectable">
                        <label for="5">5/5</label>
                        <input type="checkbox" name="rating[]" value="5" form="search" class="selector rating" <?php IsChecked('rating[]', '5') ?>>
                    </div>
                </div>
            </div>
        </section>

        <div id='result'>

            <?php
            function IsChecked($chkname, $value)
            {
                if (!empty($_GET[$chkname])) {
                    foreach ($_GET[$chkname] as $chkval) {
                        if ($chkval == $value) {
                            // return true;
                            echo 'checked';
                        }
                    }
                }
                echo '';
            }
            ?>
        </div>
    </main>

    <footer>
        <p>©FruitBath 2020</p>
    </footer>

    <!-- jQuery and Ajax -->
    <script type='text/javascript'>
        $(document).ready(function() {
            filter_data();
            // variable classes = class name i.e. price and time
            // Used for checkboxes, for each checkbox that are checked(meaning true/ticked) add it to the array
            // this wont make senses as price and time can only have one boxed ticked at any given time, however
            // if we ever get to the rating part in which multiple rating can be selected then this will still work for that.
            function filter(classes) {
                var filter = [];
                $('.' + classes + ':checked').each(function() {
                    filter.push($(this).val())
                })

                return filter;
            }


            // when the value of checkboxes are changed this will occcur
            $('.selector').change(function() {
                filter_data();
            })

            function filter_data() {
                var action = 'data';
                var keyword = $('#Search_bar').val()
                var price = filter('price');
                var time = filter('time');

                $.ajax({
                    url: 'filter.php', //send all variable(below) to this php file
                    method: 'POST', //method of sending will be POST so use $_POST[]
                    data: {
                        action: action,
                        keyword: keyword,
                        price: price,
                        time: time
                    },

                    // success is a inbult method of ajax/jquery, basically return the result form php file and print it on the dic with the id
                    success: function(response) {
                        $('#result').html(response);
                    }
                });
            }
        });
    </script>

    <!-- Pure JS -->
    <script type='text/javascript'>
        function dropdown(id) {
            var x = document.getElementById(id).style.visibility;
            if (x === "visible") {
                document.getElementById(id).style.visibility = "hidden";
            } else {
                document.getElementById(id).style.visibility = "visible";
            }
        }

        function checkboxes(name, value) {
            var option = document.getElementsByName(name);
            var checking = false;
            for (var i = 0; i < option.length; i++) {
                if (option[i].value === value) {
                    checking = option[i].checked;
                }
            }

            if (checking === true) {
                for (var i = 0; i < option.length; i++) {
                    if (option[i].value !== value) {
                        option[i].checked = false;
                    }
                }
            }
        }
    </script>
</body>

</html>