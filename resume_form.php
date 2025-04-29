<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}
require 'php/db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Resume</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container resume_main">
        <div class="text-end mb-4">
            <a href="php/logout.php" class="btn btn-danger">Logout</a>
        </div>

        <div id="success-message" class="success-message mt-2"></div>
        <div id="error-message" class="error-message mt-2"></div>

        <div class="resume_main-title">
            <h1 class="resume_main-h1">Create your best resume</h1>
        </div>
        <div class="row">
            <!-- Левая колонка: Форма -->
            <div class="col-md-6">
                <form id="resumeForm" method="POST">
                    <div class="mb-3">
                        <select class="form-select" name="template" id="templateSelect">
                            <option value="template1">Minimalist</option>
                            <option value="template2">Modern</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="name" placeholder="Full Name" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="phone" placeholder="Phone">
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="education" rows="3" placeholder="Education"></textarea>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="experience" rows="3" placeholder="Experience"></textarea>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="skills" rows="3" placeholder="Skills"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary save-resume-btn">Save Resume</button>
                </form>
            </div>
            <!-- Правая колонка: Предпросмотр -->
            <div class="col-md-6">
                <h3 class="preview-title">Preview</h3>
                <div id="preview" class="preview-box"></div>
            </div>
        </div>

        <div class="mt-5">
            <h3>Saved Resumes</h3>
            <div id="pdf-success-message" class="success-message mb-2"></div>
            <div id="pdf-error-message" class="error-message mb-2"></div>
            <div id="saved-resumes-list">
            <?php
            $stmt = $pdo->prepare("SELECT id, name, created_at FROM resumes WHERE user_id = ? ORDER BY created_at DESC");
            $stmt->execute([$_SESSION['user_id']]);
            $resumes = $stmt->fetchAll();
            if (count($resumes) > 0) {
                foreach ($resumes as $resume) {
                    echo '<div class="card mb-2">';
                    echo '<div class="card-body d-flex justify-content-between align-items-center">';
                    echo '<div>';
                    echo '<h5 class="card-title mb-1">' . htmlspecialchars($resume['name']) . '</h5>';
                    echo '<p class="card-text">Created: ' . $resume['created_at'] . '</p>';
                    echo '</div>';
                    echo '<div>';
                    echo '<button class="btn btn-success btn-sm download-pdf-btn" data-resume-id="' . $resume['id'] . '">Download PDF</button>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No resumes saved yet.</p>';
            }
            ?>
            </div>
        </div>
    </div>
    <script src="js/script.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>