// public/js/invoices-edit.js

document.addEventListener('DOMContentLoaded', function () {

    const form = document.querySelector('form');
    const submitBtn = form.querySelector('button[type="submit"]');
    const fileInput = form.querySelector('input[type="file"]');
    const filePreview = document.createElement('div');
    filePreview.className = 'file-preview';
    fileInput.parentElement.appendChild(filePreview);

    // Show selected file name when user picks a new one
    fileInput.addEventListener('change', function () {
        if (this.files.length > 0) {
            filePreview.textContent = `New file selected: ${this.files[0].name}`;
            filePreview.style.color = '#374151';
        } else {
            filePreview.textContent = '';
        }
    });

    // Client-side required fields check + loading state
    form.addEventListener('submit', function (e) {
        let hasError = false;

        // Reset previous errors
        document.querySelectorAll('.error-message').forEach(el => el.style.display = 'none');

        // Check required fields
        const requiredFields = form.querySelectorAll('[required]');
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                hasError = true;
                let errorEl = field.parentElement.querySelector('.error-message');
                if (!errorEl) {
                    errorEl = document.createElement('div');
                    errorEl.className = 'error-message';
                    errorEl.textContent = 'This field is required';
                    field.parentElement.appendChild(errorEl);
                }
                errorEl.style.display = 'block';
            }
        });

        if (hasError) {
            e.preventDefault();
            return;
        }

        // Disable button & show loading
        submitBtn.disabled = true;
        submitBtn.textContent = 'Updating...';
    });

});