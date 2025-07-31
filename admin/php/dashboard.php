<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "Wizard@mn";
$dbname = "prisa";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from database
$sql = "SELECT * FROM your_table_name";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Database Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 2px 3px rgba(0,0,0,0.1);
            background-color: white;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #2c3e50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e9e9e9;
        }
        .no-data {
            text-align: center;
            margin: 20px;
            font-style: italic;
        }
    </style>
</head>
<body>
    <h1>Database Records</h1>
    
    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <?php 
                    // Display column headers
                    $field_info = $result->fetch_fields();
                    foreach ($field_info as $field): ?>
                        <th><?php echo ucfirst(str_replace("_", " ", $field->name)); ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Reset pointer after getting field info
                $result->data_seek(0);
                
                // Display data rows
                while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <?php foreach($row as $value): ?>
                            <td><?php echo htmlspecialchars($value); ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-data">No records found in the database.</p>
    <?php endif; ?>
    
    <?php
    // Close connection
    $conn->close();
    ?>
</body>
</html>
