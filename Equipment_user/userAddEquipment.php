<?php
include("../database/db_conn.php");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all equipment
$sql = "SELECT * FROM equipment";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Equipment</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F5F0DD;
            color: #1D5748;
        }

        h1 {
            color: #1D5748;
            margin-bottom: 20px;
        }

        .container {
            background-color: #FFF8EB;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 40px auto;
        }

        .table {
            background-color: #FFF8EB;
            border: 1px solid #ddd;
        }

        .table th {
            background-color: #1D5748;
            color: #FFF;
            text-align: center;
            padding: 10px;
        }

        .table td {
            text-align: center;
            padding: 8px;
            border: 1px solid #ddd;
        }

        .table tbody tr:nth-child(even) {
            background-color: #fafafa;
        }

        .btn-primary {
            background-color: #1D5748;
            border: none;
            color: #F5F0DD;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #014520;
        }

        input[type="date"],
        input[type="number"] {
            border: 1px solid #ddd;
            padding: 8px;
            border-radius: 5px;
            width: 100%;
        }

        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

        label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Book Equipment</h1>

        <!-- Date Selection -->
        <form method="POST" action="manageEquipmentBooking.php" onsubmit="return validateDate()">
            <div class="mb-4">
                <label for="date" class="form-label">Select Booking Date:</label>
                <input type="date" id="date" name="date" required>
            </div>

            <!-- Equipment Table -->
            <table class="table">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Equipment Name</th>
                        <th>Available Quantity</th>
                        <th>Quantity to Book</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['type']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['equipment']) . "</td>";
                            echo "<td>" . intval($row['quantity']) . "</td>";
                            echo "<td>
                                    <input type='number' name='booking[" . $row['id'] . "]' 
                                    min='0' max='" . intval($row['quantity']) . "' 
                                    value='0'>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' class='text-center'>No equipment available</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-primary">Book Equipment</button>
            </div>
        </form>
    </div>

    <script>
        function validateDate() {
            const dateInput = document.getElementById('date').value;
            if (!dateInput) {
                alert('Please select a date before booking.');
                return false;
            }
            return true;
        }
    </script>

    <?php $conn->close(); ?>
</body>

</html>
