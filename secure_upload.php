<?php
// SECURE FILE UPLOAD IMPLEMENTATION
$upload_dir = "uploads/";
$allowed_mime_types = ['image/jpeg', 'image/png', 'application/pdf'];
$allowed_extensions = ['jpg', 'jpeg', 'png', 'pdf'];
$max_file_size = 2 * 1024 * 1024; // 2MB

// Secure directory creation
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0755, true); // Restrictive permissions
    file_put_contents($upload_dir . '.htaccess', "deny from all\nphp_flag engine off");
}

// Process upload
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_FILES['user_file'];
    $file_name = basename($file['name']);
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];

    // Generate safe filename
    $safe_name = bin2hex(random_bytes(8)) . '.' . $file_ext;
    $target_path = $upload_dir . $safe_name;

    // Validation checks
    $errors = [];
    
    // 1. Check for upload errors
    if ($file_error !== UPLOAD_ERR_OK) {
        $errors[] = "Upload error: " . $file_error;
    }

    // 2. Verify file extension
    if (!in_array($file_ext, $allowed_extensions)) {
        $errors[] = "Invalid file extension";
    }

    // 3. Check MIME type
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($file_tmp);
    if (!in_array($mime, $allowed_mime_types)) {
        $errors[] = "Invalid file type";
    }

    // 4. Validate file size
    if ($file_size > $max_file_size) {
        $errors[] = "File too large (max 2MB)";
    }

    // 5. Verify image content (for images)
    if (strpos($mime, 'image') === 0) {
        $image_info = getimagesize($file_tmp);
        if (!$image_info) {
            $errors[] = "Invalid image file";
        }
    }

    // Process upload if no errors
    if (empty($errors)) {
        if (move_uploaded_file($file_tmp, $target_path)) {
            // For images: recreate to strip metadata
            if (strpos($mime, 'image') === 0) {
                $original = imagecreatefromstring(file_get_contents($target_path));
                switch ($mime) {
                    case 'image/jpeg':
                        imagejpeg($original, $target_path, 90);
                        break;
                    case 'image/png':
                        imagepng($original, $target_path);
                        break;
                }
                imagedestroy($original);
            }

            $message = "<div class='success'>File uploaded safely as: " . htmlspecialchars($safe_name) . "</div>";
        } else {
            $errors[] = "File move failed";
        }
    }

    if (!empty($errors)) {
        $message = "<div class='error'>" . implode("<br>", array_map('htmlspecialchars', $errors)) . "</div>";
    }
}
?>
