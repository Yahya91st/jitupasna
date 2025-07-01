<?php
echo "Starting table rename process...\n";

try {
    echo "Connecting to database...\n";
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=jitupasna', 'root', '');
    echo "Connected successfully!\n";
    
    // Tables to rename (only those without foreign key dependencies)
    $renames = [
        'users' => 'users_old',
        'cache' => 'cache_old', 
        'cache_locks' => 'cache_locks_old',
        'failed_jobs' => 'failed_jobs_old',
        'job_batches' => 'job_batches_old', 
        'jobs' => 'jobs_old',
        'password_reset_tokens' => 'password_reset_tokens_old',
        'sessions' => 'sessions_old',
        'migrations' => 'migrations_old',
        'penilaian' => 'penilaian_old',
        'rekapitulasi' => 'rekapitulasi_old'
    ];
    
    foreach($renames as $oldName => $newName) {
        echo "Processing table: $oldName\n";
        // Check if table exists
        $stmt = $pdo->query("SHOW TABLES LIKE '$oldName'");
        if($stmt->rowCount() > 0) {
            echo "Renaming table: $oldName -> $newName\n";
            $pdo->exec("RENAME TABLE `$oldName` TO `$newName`");
            echo "✓ Successfully renamed $oldName\n";
        } else {
            echo "⚠ Table $oldName does not exist\n";
        }
    }
    
    echo "\nAll table renames completed!\n";
    
} catch(Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
}
?>
