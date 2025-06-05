<?php
$db = new SQLite3('quotes.db');

// Create quotes table with visibility flag
$db->exec('CREATE TABLE IF NOT EXISTS quotes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    content TEXT NOT NULL,
    is_public BOOLEAN DEFAULT 1
)');

// Insert initial public quotes
$quotes = [
    "The only way to do great work is to love what you do.",
    "Innovation distinguishes between a leader and a follower.",
    "Stay hungry, stay foolish.",
    "Think different.",
    "Idk, man",
    "this is quote '",
    "this isnt a quote?"
];

$stmt = $db->prepare('INSERT INTO quotes (content, is_public) VALUES (?, 1)');
foreach ($quotes as $quote) {
    $stmt->reset();
    $stmt->bindValue(1, $quote, SQLITE3_TEXT);
    $stmt->execute();
}

// Insert secret quote
$secret_quote = "Here's a secret quote containing the flag: " . getenv('FLAG');
$stmt = $db->prepare('INSERT INTO quotes (content, is_public) VALUES (?, 0)');
$stmt->bindValue(1, $secret_quote, SQLITE3_TEXT);
$stmt->execute();

$db->close();
echo "Database initialized successfully!\n"; 
