<?php

$db = new SQLite3('quotes.db');
$search = isset($_GET['q']) ? $_GET['q'] : '';
$quotes = [];

if ($search) {
    $query = "SELECT content FROM quotes WHERE is_public = 1 AND content LIKE '%" . $search . "%' LIMIT 3";
    $result = $db->query($query);
} else {
    $result = $db->query('SELECT content FROM quotes WHERE is_public = 1 LIMIT 3');
}

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $quotes[] = $row['content'];
}

$db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Famous Quotes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: #f0f0f0;
        }
        .quote {
            background: white;
            padding: 20px;
            margin: 10px 0;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .search-box {
            width: 100%;
            padding: 10px;
            margin: 20px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <h1>Famous Quotes</h1>
    
    <form method="GET" action="">
        <input type="text" name="q" class="search-box" 
               placeholder="Search quotes..." 
               value="<?php echo htmlspecialchars($search); ?>">
    </form>

    <?php if ($quotes): ?>
        <?php foreach($quotes as $quote): ?>
            <div class="quote"><?php echo htmlspecialchars($quote); ?></div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="quote">No quotes found matching your search.</div>
    <?php endif; ?>
</body>
</html> 
