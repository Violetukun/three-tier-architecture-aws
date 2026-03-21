CREATE DATABASE IF NOT EXISTS diagnostic_center;
USE diagnostic_center;

CREATE TABLE patient_results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reference_number VARCHAR(50) NOT NULL UNIQUE,
    last_name VARCHAR(100) NOT NULL,
    result_status VARCHAR(50) DEFAULT 'Pending',
    result_pdf_key VARCHAR(255)
);

-- Note: 'REF12345.pdf' assumes you uploaded the file directly to the main S3 bucket folder.
INSERT INTO patient_results (reference_number, last_name, result_status, result_pdf_key) 
VALUES ('REF12345', 'DELAPENA', 'Available', 'REF12345.pdf');
