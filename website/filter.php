<?php
require_once 'db_connection.php';

if (isset($_POST['action'])) {
    $output = '';
    $query = 'SELECT * FROM recipe_proto WHERE Recipe != ""'; // select recipe that exists

    if (isset($_POST["keyword"]) && !empty($_POST["keyword"])) {
        $key = trim($_POST["keyword"]);
        $words = explode(" ", $key);

        foreach ($words as $keywords) {
            $query .= " AND Keyword LIKE '%" . $keywords . "%'";
        }

        if (isset($_POST['price'])) {
            $price_filter = implode("','", $_POST['price']);
            $query .= " AND Cost <= " . $price_filter;
        }

        if (isset($_POST['time'])) {
            $time_filter = implode("','", $_POST['time']);
            $query .= " AND Time <= " . $time_filter;
        }

        if (isset($_POST['rating'])) {
            $rate_filter = implode("','", $_POST['rating']);
            $query .= " AND Rating >= " . $rate_filter;
        }

        // OpenCon() is a function from db_connection php file
        $conn = OpenCon();

        //running the query
        $result = $conn->query($query);


        $num_rows = $result->num_rows;

        if ($num_rows <= 0) {
            $output .= '<div class="no_recipe">
                          <p>Unable to find recipes matching "' . $_POST["keyword"] . '".</p>
                        </div>';
        } else {
            while ($row = $result->fetch_array(MYSQLI_NUM)) {
                $output .= '<div class="recipe">
                            <a href="' . $row[4] . '"><img src="' . $row[2] . '" alt="placeholder"></a>
                            <section class="recipe_info">
                                <h1>' . $row[1] . '</h1>
                                <p class="recipe_desc">' . $row[3] . '</p>
                                <section class="misc">
                                    <p>Price: $' . $row[6] . '</p>
                                    <p>Total time: ' . $row[7] . 'mins</p>
                                    <p>Rating: ' . $row[8] . '/5</p>
                                </section>
                            </section>
                          </div>';
            }
        }
        echo $output;
    } else {
        $output .= '<div class="no_recipe">
                         <p>Unable to find recipes matching "' . $_POST["keyword"] . '".</p>
                    </div>';
        echo $output;
    }
}

