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

// Обработка форм регистрации и логина
document.addEventListener('DOMContentLoaded', function() {
    // Обработка формы регистрации
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        // Очистка сообщений и подсветки при изменении полей
        registerForm.addEventListener('input', function(e) {
            const errorMessage = document.getElementById('error-message');
            const successMessage = document.getElementById('success-message');
            errorMessage.textContent = '';
            errorMessage.classList.remove('active');
            successMessage.textContent = '';
            successMessage.classList.remove('active');
            if (e.target.name === 'email') {
                e.target.style.borderColor = '';
            }
        });

        // Обработка отправки формы
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const form = this;
            const errorMessage = document.getElementById('error-message');
            const successMessage = document.getElementById('success-message');
            errorMessage.textContent = '';
            errorMessage.classList.remove('active');
            successMessage.textContent = '';
            successMessage.classList.remove('active');

            const formData = new FormData(form);

            fetch('php/register.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    successMessage.textContent = 'Registration successful!';
                    successMessage.classList.add('active');
                    form.reset();
                    setTimeout(() => {
                        window.location.href = 'login.html';
                    }, 1500);
                } else {
                    errorMessage.textContent = data.message;
                    errorMessage.classList.add('active');
                    if (data.message === 'User with this email is already registered') {
                        form.querySelector('input[name="email"]').style.borderColor = '#dc3545';
                    }
                }
            })
            .catch(error => {
                errorMessage.textContent = 'An error occurred. Please try again.';
                errorMessage.classList.add('active');
            });
        });
    }

    // Обработка формы логина
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        // Очистка сообщений и подсветки при изменении полей
        loginForm.addEventListener('input', function(e) {
            const errorMessage = document.getElementById('error-message');
            const successMessage = document.getElementById('success-message');
            errorMessage.textContent = '';
            errorMessage.classList.remove('active');
            successMessage.textContent = '';
            successMessage.classList.remove('active');
            if (e.target.name === 'email') {
                e.target.style.borderColor = '';
            }
        });

        // Обработка отправки формы
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const form = this;
            const errorMessage = document.getElementById('error-message');
            const successMessage = document.getElementById('success-message');
            errorMessage.textContent = '';
            errorMessage.classList.remove('active');
            successMessage.textContent = '';
            successMessage.classList.remove('active');

            const formData = new FormData(form);

            fetch('php/login.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    successMessage.textContent = 'Login successful!';
                    successMessage.classList.add('active');
                    form.reset();
                    setTimeout(() => {
                        window.location.href = 'resume_form.php';
                    }, 1500);
                } else {
                    errorMessage.textContent = data.message;
                    errorMessage.classList.add('active');
                    if (data.message === 'Invalid email or password') {
                        form.querySelector('input[name="email"]').style.borderColor = '#dc3545';
                    }
                }
            })
            .catch(error => {
                errorMessage.textContent = 'An error occurred. Please try again.';
                errorMessage.classList.add('active');
            });
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const successMessage = document.getElementById('success-message');
    if (successMessage && successMessage.textContent) {
        successMessage.classList.add('active');
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const errorMessage = document.getElementById('error-message');
    if (errorMessage && errorMessage.textContent) {
        errorMessage.classList.add('active');
    }
});