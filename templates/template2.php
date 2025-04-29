<!DOCTYPE html>
<html>
<head>
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            src: url('dompdf/lib/fonts/DejaVuSans.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        .resume-header {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
        }
        .resume-section {
            margin-top: 20px;
            background-color: white;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        h1 {
            font-size: 26px;
            margin: 0;
        }
        h3 {
            font-size: 18px;
            color: #2c3e50;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 5px;
        }
        p {
            margin: 5px 0;
            line-height: 1.5;
        }
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