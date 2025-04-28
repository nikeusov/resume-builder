<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Resume</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container resume_main">
        <div class="text-end mb-4">
            <a href="php/logout.php" class="btn btn-danger">Logout</a>
        </div>

        <?php if (isset($_GET['success'])): ?>
        <div id="success-message" class="success-message mt-2">
            <?php echo htmlspecialchars('Resume saved successfully!'); ?></div>
        <?php elseif (isset($_GET['error'])): ?>
        <div id="error-message" class="error-message mt-2">
            <?php
        if ($_GET['error'] == 'required_fields') {
            echo htmlspecialchars('All required fields must be filled.');
        } else {
            echo htmlspecialchars('An error occurred while saving the resume.');
        }
        ?>
        </div>
        <?php endif; ?>

        <div class="resume_main-title">
            <h1 class="resume_main-h1">Create your best resume</h1>
        </div>
        <div class="row">
            <!-- Левая колонка: Форма -->
            <div class="col-md-6">
                <form id="resumeForm" action="php/save_resume.php" method="POST">
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
    </div>
    <script src="js/script.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>