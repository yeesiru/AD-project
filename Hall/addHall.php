<?php
include("../database/db_conn.php");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hallId = $_POST['hallId'];
    $name = $_POST['name'];
    $capacity = $_POST['capacity'];
    $location = $_POST['location'];
    $facility = $_POST['facility'];

    // Insert the new hall entry into the database
    $sql = "INSERT INTO halls (hallId, name, capacity, location, facility) VALUES ('$hallId', '$name', '$capacity', '$location', '$facility')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Success!',
                    text: 'Hall added successfully.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'manageHall.php';
                    }
                });
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'Error adding new hall record: " . $conn->error . "',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Hall Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">   
    <link rel="stylesheet" href="../css/hall.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container" style="width: auto;">
        <a href="./manageHall.php" class="btn btn-secondary mb-3">Back to Home</a>
        <br>
        <h1 style="text-align: center;">Add New Hall</h1>

        <div class="hall-table justify-content-center">
            <form id="addHallForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                
                <div class="form-group hall-input">
                    <label for="hallId" class="form-label">Hall ID: </label>
                    <input type="text" id="hallId" name="hallId" required>
                </div>

                <div class="form-group hall-input">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group hall-input">
                    <label for="capacity" class="form-label">Capacity: </label>
                    <input type="number" id="capacity" name="capacity" required min="1" max="500">
                </div>

                <div class="form-group hall-input">
                    <label for="location" class="form-label">Location: </label>
                    <input type="text" id="location" name="location" required>
                </div>

                <div class="form-group hall-input">
                    <label for="facility" class="form-label">Facility:</label>
                    <input type="text" id="facility" name="facility" required>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Add Hall</button>
            </form>
        </div>
    </div>

    <?php
    $conn->close();
    ?>
</body>

</html>