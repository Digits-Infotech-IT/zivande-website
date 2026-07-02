<html>
<head>
    <title>Contact Us - TrackMe</title>
    <style>
body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      font-size: 10px;
      background: #f4f6f9;
    }
    :root{
      --bg: #ffffff;
      --card: #fbfdff;
      --accent: #0b74de;
      --muted: #555;
      --border: #e6e9ef;
      --radius: 6px;
      --gap: 3px;
      --fs: 10px; /* maximum font size for entire page */
    }
    header {
      background: #333;
      color: #fff;
      padding: 20px;
      text-align: center;
    }
    table {
      width: 80%;
      margin: 20px auto;
      border-collapse: collapse;
      font-size: var(--fs);
    }
    th, td {
      padding: 10px;
      border: 1px solid #ddd;
      text-align: left;
    }
    th {
      background: #f2f2f2;
    }

    </style>
</head>
<body>
    <header>
        <h3>Enquiries</h3>
    </header>   
<?php

$jsonData = file_get_contents('contacts/enquiries.json', true);
$data = [];
//$data = json_decode($jsonData);
$data = json_decode($jsonData, true);
//var_dump($data);
echo '<table border="1">';
echo '<thead><tr><th>Name</th><th>Email</th><th>Message</th><th>Date</th></tr></thead>';
echo '<tbody>';

// 4. Loop through each record
if (!empty($data)) {
    foreach ($data as $record) {
        echo '<tr>';
        // Use htmlspecialchars for security against XSS
        echo '<td>' . htmlspecialchars($record['name']) . '</td>';
        echo '<td>' . htmlspecialchars($record['email']) . '</td>';
        echo '<td>' . htmlspecialchars($record['message']) . '</td>';
        echo '<td>' . htmlspecialchars($record['timestamp']) . '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="4">No records found</td></tr>';
}

echo '</tbody></table>';
?>
    <div id="data-container">
    </div>
</body>
</html>