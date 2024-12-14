<?php
include("../database/db_conn.php"); // Include the database connection file
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Feedback Listing</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/navigation.css">
    <link rel="stylesheet" href="../css/homepage.css">
    <script src="../script/adminNavBar.js" defer></script>

    <style>
        /* General Styling */
        body {
        background-color: #f8f9fa;
        font-family: 'Poppins', Arial, sans-serif;
        color: #343a40;
        }

        h2 {
            color: #343a40;
            font-weight: bold;
        }

        nav li:first-child {
            margin-right: auto;
        }

        /* Table Styling */
        table.table {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        table.table th {
            background-color: black;
            color: white;
            text-align: center;
        }

        table.table td {
            text-align: center;
            vertical-align: middle;
        }

        .table-actions a {
            margin-right: 8px;
        }

        /* Status Styling */
        .status-pending {
            color: red;
            font-weight: bold;
        }

        .status-responded {
            color: green;
            font-weight: bold;
        }

        /* Button Styling */
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: all 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        /* Hover Effects */
        tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <!-- Navigation bar -->
    <div id="navbar"></div>

    <div class="container mt-4">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4" style="text-align: center;">
            <h2>Feedback</h2>
            <p>rating graph</p>
        </div>

        <!-- Feedback Table -->
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Service Type</th>
                        <th>Rating</th>
                        <th>Message</th>
                        <th>Submitted Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch feedback from the database
                    $sql = "SELECT id, serviceType, rating, feedbackText, submitted_at, status FROM feedback";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['serviceType']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['rating']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['feedbackText']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['submitted_at']) . "</td>";

                            // Apply conditional styling to the status column
                            $statusClass = ($row['status'] === 'pending') ? 'status-pending' : 'status-responded';
                            echo "<td class='$statusClass'>" . htmlspecialchars(strtoupper($row['status'])) . "</td>";

                            echo "<td class='table-actions'>
                            <a href='replyFeedback.php?feedback_id=" . htmlspecialchars($row['id']) . "' class='btn btn-primary'>Reply</a>
                            </td>";

                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>No feedback found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
    $conn->close(); // Close the database connection after all operations
    ?>
</body>
</html>
