# File Upload Vulnerability Lab with Mitigation
This is a hands-on cybersecurity project that demonstrates how file upload functionality can be exploited when improperly handled — and how to secure it using best practices.
The project is divided into two parts:

###  Vulnerable Version
- No file extension or MIME type validation
- No file size restriction
- No filename sanitization
- Uploaded files are publicly accessible
- Demonstrates how attackers can upload PHP shells to gain RCE(Remote Code Execution)

###  Secure (Mitigated) Version
- Allows only safe file types (e.g., `.jpg`, `.png`, `.pdf`, `.txt`, `.docx`)
- Enforces a 2MB file size limit
- Validates MIME type using `mime_content_type()`
- Sanitizes or randomizes uploaded filenames
- Prevents direct execution of scripts in upload folder
It helps learners understand both how file upload vulnerabilities are exploited, and how to prevent them effectively.

### Key Files & Folders

| File/Folder        | Purpose                                                                                                      |
|--------------------|--------------------------------------------------------------------------------------------------------------|
| `index.php`        | Main UI page with upload form and embedded PHP upload handler (both vulnerable and secure logic in comments) |
| `uploads/`         | Directory where uploaded files are stored and publicly accessible in the vulnerable version                  |
| `.htaccess`        | Used in the vulnerable version to force Apache to treat non-`.php` files (e.g., `.jpg`) as PHP for execution |
| `shell.php` (payload) | Malicious test file used to demonstrate command execution via `?cmd=whoami`                               |
-------------------------------------------------------------------------------------------------------------------------------------



1. **Clone the Repo**
   ```bash
   git clone https://github.com/your-username/file-upload-vulnerability-lab.git
   
2. **Set It Up**
- Move the folder to your XAMPP/htdocs/ directory
- Start Apache from the XAMPP Control Panel
- Open in your browser:
``http://localhost/file-upload-vulnerability-lab/``

3. **Try It Out**
- Upload test files like .php, .jpg.php, etc.
- Toggle between vulnerable and secure code blocks in index.php



## Screenshot
![image](https://github.com/user-attachments/assets/8df707c9-56a7-4bff-b8de-abcfe8f2d593)



##  Disclaimer

This project contains **intentionally vulnerable code** for educational and testing purposes only.  
Do **not** deploy the insecure version on a public or production server.


