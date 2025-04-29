<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}
require 'php/db_connect.php';

if (!isset($_GET['resume_id'])) {
    header("Location: resume_form.php");
    exit;
}

$resume_id = $_GET['resume_id'];
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM resumes WHERE id = ? AND user_id = ?");
$stmt->execute([$resume_id, $user_id]);
$resume = $stmt->fetch();

if (!$resume) {
    header("Location: resume_form.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Resume</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container resume_main">
        <div class="text-end mb-4 back-btn">
            <a href="resume_form.php" class="btn btn-secondary back-r_btn">Back to Resumes</a>
            <a href="php/logout.php" class="btn btn-danger">Logout</a>
        </div>

        <div id="success-message" class="success-message mt-2"></div>
        <div id="error-message" class="error-message mt-2"></div>

        <div class="resume_main-title">
            <h1 class="resume_main-h1">Edit Resume</h1>
        </div>
        <div class="row">
            <!-- Левая колонка: Форма -->
            <div class="col-md-6">
                <form id="editResumeForm" method="POST">
                    <input type="hidden" name="resume_id" value="<?php echo $resume['id']; ?>">
                    <div class="mb-3">
                        <select class="form-select" name="template" id="templateSelect">
                            <option value="template1" <?php echo $resume['template'] === 'template1' ? 'selected' : ''; ?>>Minimalist</option>
                            <option value="template2" <?php echo $resume['template'] === 'template2' ? 'selected' : ''; ?>>Modern</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="name" placeholder="Full Name" value="<?php echo htmlspecialchars($resume['name']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo htmlspecialchars($resume['email']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="phone" placeholder="Phone" value="<?php echo htmlspecialchars($resume['phone']); ?>">
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="education" rows="3" placeholder="Education"><?php echo htmlspecialchars($resume['education']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="experience" rows="3" placeholder="Experience"><?php echo htmlspecialchars($resume['experience']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="skills" rows="3" placeholder="Skills"><?php echo htmlspecialchars($resume['skills']); ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary save-resume-btn">Update Resume</button>
                </form>
            </div>
            <!-- Правая колонка: Предпросмотр -->
            <div class="col-md-6">
                <h3 class="preview-title">Preview</h3>
                <div id="preview" class="preview-box"></div>
            </div>
        </div>
    </div>
    <script src="js/script.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>