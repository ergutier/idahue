<?php
include_once '../../config.php';
header("Content-type: text/css");
?>
body {
    font-family: Arial, sans-serif;
    background-image: url('<?php echo BASE_URL; ?>assets/images/background.jpg');
    background-size: cover;
    color: #333;
}

.container {
    background-color: rgba(255, 255, 255, 0.8);
    padding: 20px;
    margin: 20px auto;
    border-radius: 10px;
    max-width: 800px;
}

h1 {
    color: #2e8b57;
}

a {
    color: #2e8b57;
    text-decoration: none;
    margin-right: 10px;
}

a:hover {
    text-decoration: underline;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 8px;
    text-align: left;
}

th {
    background-color: #2e8b57;
    color: white;
}