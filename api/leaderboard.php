<?php
include("../api/connect.php");

$query = "SELECT name, email, wpm, cpm, accuracy 
          FROM users
          WHERE wpm IS NOT NULL AND cpm IS NOT NULL AND accuracy IS NOT NULL
          ORDER BY cpm DESC, wpm DESC, accuracy DESC";

$result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Leader Board</title>
    <link rel="stylesheet" href="../css/index.css">
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 30px auto;
            font-family: Arial, sans-serif;
        }

        th, td {
            padding: 12px;
            border: 1px solid #999;
            text-align: center;
        }

        th {
            background-color: #f0f0f0;
        }

        h2 {
            text-align: center;
            font-family: Arial, sans-serif;
        }

        .back{
            float:left;
            padding: 6px 14px;
            background: none;
            border: none;
            font-weight: 600;
            cursor: pointer;
            font-size:20px;
        }
        .btn{
            padding-bottom:50px;
        }
    </style>
</head>
<body>
    
    <div class="btn">
        <a href="../routes/test.php"><button class="back">Back</button></a>
    </div>
    <h2>Typing Speed Leaderboard</h2>
    <table>
        <thead>
            <tr>
                <th>Rank</th>
                <th>Name</th>
                <th>Email</th>
                <th>CPM</th>
                <th>WPM</th>
                <th>Accuracy (%)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rank = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $rank++ . "</td>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . $row['cpm'] . "</td>";
                echo "<td>" . $row['wpm'] . "</td>";
                echo "<td>" . $row['accuracy'] . "</td>";
                echo "</tr>";
            }

            if ($rank === 1) {
                echo "<tr><td colspan='6'>No results found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
