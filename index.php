<?php
// DELIBERATELY VULNERABLE FILE UPLOAD - FOR SECURITY TESTING ONLY
$upload_dir = "uploads/";

// Create upload directory if it doesn't exist
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true); // Insecure permissions
}

// Process file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $target_file = $upload_dir . basename($_FILES['malicious_file']['name']);
    
    // No file type validation - accepts ANY file type
    if (move_uploaded_file($_FILES['malicious_file']['tmp_name'], $target_file)) {
        $message = "File uploaded successfully!<br>";
        $message .= "Access it at: <a href='$target_file'>$target_file</a>";
    } else {
        $message = "File upload failed!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vulnerable File Upload</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        .container { border: 1px solid #ccc; padding: 20px; border-radius: 5px; }
        .message { padding: 10px; margin-bottom: 15px; border-radius: 3px; }
        .success { background-color: #dff0d8; border: 1px solid #d6e9c6; }
        .error { background-color: #f2dede; border: 1px solid #ebccd1; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Vulnerable File Upload</h1>
        <p>This is a deliberately insecure file upload form for security testing purposes.</p>
        
        <?php if (isset($message)): ?>
            <div class="message <?php echo strpos($message, 'failed') !== false ? 'error' : 'success' ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        
        <form method="post" enctype="multipart/form-data">
            <h3>Upload a File:</h3>
            <input type="file" name="malicious_file">
            <br><br>
            <input type="submit" value="Upload File">
        </form>
        
        <hr>
        
        <h3>Test Commands (After Uploading PHP Shell):</h3>
        <p>Upload <code>shell.php</code> then visit:</p>
        <code>
            /uploads/shell.php?cmd=whoami<br>
            /uploads/shell.php?cmd=ls -la<br>
            /uploads/shell.php?cmd=cat /etc/passwd
        </code>
    </div>
</body>
</html>