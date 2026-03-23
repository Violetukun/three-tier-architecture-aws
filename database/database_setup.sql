-- 1. Create the database and use it
CREATE DATABASE IF NOT EXISTS diagnostic_center;
USE diagnostic_center;

-- 2. Create the unified table for patient test records
CREATE TABLE IF NOT EXISTS patient_results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reference_number VARCHAR(50) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    test_name VARCHAR(100) NOT NULL,
    exam_date DATE NOT NULL,
    result_status VARCHAR(50) DEFAULT 'Pending',
    result_pdf_key VARCHAR(255)
);

-- 3. Insert Mock Sample Record for testing
INSERT INTO patient_results (reference_number, last_name, test_name, exam_date, result_status, result_pdf_key) 
VALUES ('REF12345', 'DELAPENA', 'Complete Blood Count (CBC)', '2026-10-24', 'Available', 'REF12345.pdf');
