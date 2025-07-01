<?php
echo "Starting to drop conflicting tables...\n";

try {
    echo "Connecting to database...\n";
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=jitupasna', 'root', '');
    echo "Connected successfully!\n";
    
    // Tables that were created during the partial migration
    $tablesToDrop = [
        'rekapitulasi',
        'cache',
        'cache_locks', 
        'failed_jobs',
        'job_batches',
        'jobs',
        'migrations',
        'password_reset_tokens',
        'sessions',
        'users'
    ];
    
    foreach($tablesToDrop as $table) {
        echo "Processing table: $table\n";
        // Check if table exists
        $stmt = $pdo->query("SHOW TABLES LIKE '$table'");
        if($stmt->rowCount() > 0) {
            echo "Dropping table: $table\n";
            $pdo->exec("DROP TABLE `$table`");
            echo "✓ Successfully dropped $table\n";
        } else {
            echo "⚠ Table $table does not exist\n";
        }
    }
    
    echo "\nAll conflicting tables dropped!\n";
    
} catch(Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
}
?>
