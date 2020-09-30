<?php
// db connection
$mysqli = new mysqli('localhost', 'root', '', 'ratings');
//post data towards the db values if submit button is pressed
if (isset($_POST['rating'])) {
    $feedback = $_POST['feedback'];
    $email = $_POST['email'];
    $rating = $_POST['rating'];
    $query = "Insert into feedback (rating, feedback, email) VALUES (?,?,?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('iss', $rating, $feedback, $email);
    $stmt->execute();
    $msg = "<div class='alert alert-success'>Rating Sucessfully Added</div>";
    $stmt->close();
}
//funtion to calculate average of the all of the star ratings of the entries 
function getAverageRating()
{
    global $mysqli;
    $query = "select avg(rating) as avg from feedback";
    $stmt = $mysqli->prepare($query);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['avg'];
        }
    }
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <title>Title</title>
</head>

<body>
    <div class="container">
        <h2>Reviews</h2>
        <!--if statement to present a successful submission -->
        <?php if (isset($msg)) {
            echo $msg;
        } ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="">Rating</label>
                <div id="rateYo"></div>
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="form-group">
                <label for="">Feedback</label>
                <input type="text" class="form-control" name="feedback">
                <input type="hidden" name="rating" id="rating">
            </div>
            <button class="submit">Submit</button>
        </form>
    </div>
    <!-- -->
    <div class="container">
        <h2>User Feedback</h2>

        <!-- div for average rating-->
        <div id='avgRating'></div>
        <?php
        // query to db to get all feedback
        $query = "select * from feedback";
        // sends query to the db
        $stmt = $mysqli->prepare($query);
        // if it is performed, 
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                // if results is greater than 0, while fetching the associated data
                while ($row = $result->fetch_assoc()) {
        ?>
                    <!-- div row for comments that are stored in the db and printed-->
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNzRkOTg4YzgyZCB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE3NGQ5ODhjODJkIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMy4xNzE4NzUiIHk9IjM2LjUiPjY0eDY0PC90ZXh0PjwvZz48L2c+PC9zdmc+" alt="place for user photo">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <div class="rateYo-<?php echo $row['id'] ?>"></div>
                            </h4>
                            <!--function to print out the star rating for an entry-->
                            <script>
                                $(function() {
                                    $(".rateYo-<?php echo $row['id'] ?>").rateYo({
                                        readOnly: true,
                                        rating: <?php echo $row['rating']; ?>,
                                    });
                                });
                            </script>
                            <!-- echo out the feedback and email of an entry-->
                            <?php
                            echo $row['feedback']; ?>
                            <br>
                            by <?php echo $row['email']; ?>
                        </div>
                    </div>
        <?php
                }
            }
        }
        ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

    <script>
        // function for presenting star rating
        $(function() {
            $("#rateYo").rateYo({
                fullStar: true,
                onSet: function(rating, rateYolnstance) {
                    $("#rating").val(rating);
                }
            });
        });
        // function for presenting average star ratings
        $("#avgRating").rateYo({
            readOnly: true,
            rating: '<?php echo getAverageRating(); ?>'
        });
    </script>
</body>

</html>

<!-- References
https://rateyo.fundoocode.ninja/
https://getbootstrap.com/docs/3.3/components/#media
    -->