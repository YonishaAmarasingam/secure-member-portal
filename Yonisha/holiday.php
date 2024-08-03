<?php
// Include the connection file
require 'conn.php';
session_start();
// URL of the API
$api_url = 'https://data.gov.sg/api/action/datastore_search?resource_id=6228c3c5-03bd-4747-bb10-85140f87168b&limit=10';

// Fetch data from API
$response = file_get_contents($api_url);
if ($response === FALSE) {
    die('Error occurred while fetching data.');
}

// Decode JSON response
$data = json_decode($response, true);
if (isset($data['result']['records'])) {
    $holidays = $data['result']['records'];
} else {
    die('Error decoding JSON response.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Public Holidays</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <style>
        /* Simple styles for the holiday table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>

<main>
    <div class="container">
        <h1>Public Holidays</h1>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Holiday</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($holidays)): ?>
                    <?php foreach ($holidays as $holiday): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($holiday['date']); ?></td>
                            <td><?php echo htmlspecialchars($holiday['day']); ?></td>
                            <td><?php echo htmlspecialchars($holiday['holiday']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No holidays found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
