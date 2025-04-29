<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .resume-header { text-align: center; border-bottom: 1px solid #000; padding-bottom: 10px; }
        .resume-section { margin-top: 20px; }
        h1 { font-size: 24px; margin: 0; }
        h3 { font-size: 18px; color: #333; border-bottom: 1px solid #ccc; padding-bottom: 5px; }
        p { margin: 5px 0; }
    </style>
</head>
<body>
    <div class="resume-header">
        <h1><?php echo htmlspecialchars($resume['name']); ?></h1>
        <p><?php echo htmlspecialchars($resume['email']); ?> | <?php echo htmlspecialchars($resume['phone']); ?></p>
    </div>
    <div class="resume-section">
        <h3>Education</h3>
        <p><?php echo nl2br(htmlspecialchars($resume['education'])); ?></p>
    </div>
    <div class="resume-section">
        <h3>Experience</h3>
        <p><?php echo nl2br(htmlspecialchars($resume['experience'])); ?></p>
    </div>
    <div class="resume-section">
        <h3>Skills</h3>
        <p><?php echo nl2br(htmlspecialchars($resume['skills'])); ?></p>
    </div>
</body>
</html>