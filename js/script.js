document.getElementById('resumeForm').addEventListener('input', function() {
    // Получаем данные из формы
    const name = document.querySelector('input[name="name"]').value;
    const email = document.querySelector('input[name="email"]').value;
    const phone = document.querySelector('input[name="phone"]').value;
    const education = document.querySelector('textarea[name="education"]').value;
    const experience = document.querySelector('textarea[name="experience"]').value;
    const skills = document.querySelector('textarea[name="skills"]').value;
    const template = document.querySelector('select[name="template"]').value;

    // Форматируем данные, заменяя переносы строк на <br> для корректного отображения
    const formatText = (text) => text.replace(/\n/g, '<br>');

    // Обновление предпросмотра
    const preview = document.getElementById('preview');
    preview.innerHTML = `
        <div class="resume-template ${template}">
            <div class="resume-header">
                <h2>${name || 'Your Name'}</h2>
                <p>${email || 'your.email@example.com'} | ${phone || '123-456-7890'}</p>
            </div>
            <div class="resume-section">
                <h3>Education</h3>
                <p>${formatText(education) || 'Your education details'}</p>
            </div>
            <div class="resume-section">
                <h3>Experience</h3>
                <p>${formatText(experience) || 'Your experience details'}</p>
            </div>
            <div class="resume-section">
                <h3>Skills</h3>
                <p>${formatText(skills) || 'Your skills'}</p>
            </div>
        </div>
    `;
});