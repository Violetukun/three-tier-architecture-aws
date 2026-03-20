CREATE DATABASE IF NOT EXISTS diagnostic_center;
USE diagnostic_center;

CREATE TABLE patient_results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reference_number VARCHAR(50) NOT NULL UNIQUE,
    last_name VARCHAR(100) NOT NULL,
    result_status VARCHAR(50) DEFAULT 'Pending',
    result_pdf_key VARCHAR(255)
);

-- Insert a test patient so we can try logging in
INSERT INTO patient_results (reference_number, last_name, result_status) 
VALUES ('REF12345', 'DELAPENA', 'Available');

UPDATE patients SET result_pdf_key = 'results/REF12345.pdf' WHERE reference_number = 'REF12345';
