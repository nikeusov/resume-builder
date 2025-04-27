// Обработка предпросмотра резюме
const resumeForm = document.getElementById('resumeForm');
if (resumeForm) {
    resumeForm.addEventListener('input', function() {
        const name = document.querySelector('input[name="name"]').value;
        const email = document.querySelector('input[name="email"]').value;
        const phone = document.querySelector('input[name="phone"]').value;
        const education = document.querySelector('textarea[name="education"]').value;
        const experience = document.querySelector('textarea[name="experience"]').value;
        const skills = document.querySelector('textarea[name="skills"]').value;
        const template = document.querySelector('select[name="template"]').value;

        const formatText = (text) => text.replace(/\n/g, '<br>');

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
}

// Обработка формы регистрации
document.addEventListener('DOMContentLoaded', function() {
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        // Очистка сообщения об ошибке при любом изменении в форме
        registerForm.addEventListener('input', function() {
            const errorMessage = document.getElementById('error-message');
            errorMessage.textContent = '';
        });

        // Обработка отправки формы
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const form = this;
            const errorMessage = document.getElementById('error-message');
            errorMessage.textContent = ''; // Оставляем очистку и здесь для надежности

            const formData = new FormData(form);

            fetch('php/register.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    errorMessage.style.color = '#28a745';
                    errorMessage.textContent = 'Registration successful!';
                    form.reset();
                    setTimeout(() => {
                        window.location.href = 'login.html';
                    }, 1500);
                } else {
                    errorMessage.style.color = '#dc3545';
                    errorMessage.textContent = data.message;
                }
            })
            .catch(error => {
                errorMessage.textContent = 'An error occurred. Please try again.';
            });
        });
    }
});