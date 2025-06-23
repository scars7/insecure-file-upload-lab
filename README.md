# File Upload Vulnerability Lab with Mitigation
This is a hands-on cybersecurity project that demonstrates how file upload functionality can be exploited when improperly handled — and how to secure it using best practices.
The project is divided into two parts:

###  Vulnerable Version
- No file extension or MIME type validation
- No file size restriction
- No filename sanitization
- Uploaded files are publicly accessible
- Demonstrates how attackers can upload PHP shells to gain RCE

###  Secure (Mitigated) Version
- Allows only safe file types (e.g., `.jpg`, `.png`, `.pdf`, `.txt`, `.docx`)
- Enforces a 2MB file size limit
- Validates MIME type using `mime_content_type()`
- Sanitizes or randomizes uploaded filenames
- Prevents direct execution of scripts in upload folder
It helps learners understand both how file upload vulnerabilities are exploited, and how to prevent them effectively.


![image](https://github.com/user-attachments/assets/1dbab9dc-388f-4adc-9d6d-109dd98b3820)

##  Disclaimer

This project contains **intentionally vulnerable code** for educational and testing purposes only.  
Do **not** deploy the insecure version on a public or production server.


