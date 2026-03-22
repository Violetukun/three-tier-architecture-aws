<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Portal - Upload Results</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; margin: 0; padding: 0; display: flex; flex-direction: column; min-height: 100vh; }
        header { background-color: white; padding: 15px 20px; border-bottom: 4px solid #FFC107; display: flex; justify-content: space-between; align-items: center; }
        .logo img { height: 50px; }
        
        .admin-container { max-width: 600px; margin: 50px auto; background: white; padding: 40px; border-radius: 10px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); flex: 1; width: 100%; }
        .admin-container h2 { color: #333; margin-bottom: 5px; text-align: center; }
        .admin-container p { color: #666; text-align: center; margin-bottom: 30px; font-size: 14px; }
        
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: bold; color: #333; font-size: 14px; }
        .form-group input, .form-group select { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 15px; box-sizing: border-box; }
        .form-group input:focus, .form-group select:focus { outline: none; border-color: #FFC107; }
        
        .file-drop-area { border: 2px dashed #ddd; border-radius: 5px; padding: 30px; text-align: center; background-color: #fafafa; transition: 0.2s; margin-bottom: 20px; cursor: pointer; }
        .file-drop-area:hover { border-color: #FFC107; background-color: #fffdf5; }
        .file-drop-area i { font-size: 40px; color: #ccc; margin-bottom: 10px; }
        
        .btn-upload { background-color: #333; color: #FFC107; border: none; padding: 15px; border-radius: 5px; cursor: pointer; width: 100%; font-size: 16px; font-weight: bold; transition: 0.2s; }
        .btn-upload:hover { background-color: #111; }

        .alert { padding: 15px; border-radius: 5px; margin-bottom: 25px; text-align: center; font-weight: bold; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        
        footer { border-top: 1px solid #ccc; padding: 20px 0; margin-top: auto; font-size: 14px; color: #666; background: white; text-align: center; }
    </style>
</head>
<body>

    <header>
        <div class="logo">
            <img src="images/logo.jpg" onerror="this.src='https://placehold.co/300x80/ffffff/FFC107?text=PREMA+Diagnostic'" alt="Company Logo">
        </div>
        <div>
            <span style="font-weight: bold; color: #333;"><i class="fa-solid fa-user-doctor"></i> Staff Portal</span>
        </div>
    </header>

    <div class="admin-container">
        <h2>Upload Laboratory Result</h2>
        <p>Securely push PDF results to AWS S3 and update patient records.</p>

        <?php if(isset($_GET['success'])): ?>
            <div class="alert alert-success"><i class="fa-solid fa-circle-check"></i> Result uploaded successfully!</div>
        <?php elseif(isset($_GET['error'])): ?>
            <div class="alert alert-error"><i class="fa-solid fa-circle-exclamation"></i> Error: <?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>

        <form action="../backend/upload.php" method="POST" enctype="multipart/form-data">
            
            <div style="display: flex; gap: 15px;">
                <div class="form-group" style="flex: 1;">
                    <label>Reference Number</label>
                    <input type="text" name="ref_number" placeholder="e.g. REF99999" required>
                </div>
                <div class="form-group" style="flex: 1;">
                    <label>Patient Last Name</label>
                    <input type="text" name="last_name" placeholder="e.g. DELAPENA" required>
                </div>
            </div>

            <div class="form-group">
                <label>Test Name</label>
                <select name="test_name" required>
                    <option value="" disabled selected>Select a test...</option>
                    <option value="Complete Blood Count (CBC)">Complete Blood Count (CBC)</option>
                    <option value="Fasting Blood Sugar (FBS)">Fasting Blood Sugar (FBS)</option>
                    <option value="Urinalysis">Urinalysis</option>
                    <option value="Chest X-Ray">Chest X-Ray</option>
                    <option value="Lipid Profile">Lipid Profile</option>
                </select>
            </div>

            <div class="form-group">
                <label>Date of Exam</label>
                <input type="date" name="exam_date" required>
            </div>

            <div class="file-drop-area">
                <i class="fa-solid fa-cloud-arrow-up"></i>
                <p style="margin: 0; color: #333; font-weight: bold;">Select PDF Result File</p>
                <input type="file" name="result_pdf" accept=".pdf" required style="margin-top: 15px;">
            </div>

            <button type="submit" class="btn-upload"><i class="fa-solid fa-upload"></i> Upload & Save to Database</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2026 Diagnostic Center Admin Portal. Internal Use Only.</p>
    </footer>

</body>
</html>
