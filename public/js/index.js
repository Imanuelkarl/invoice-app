// Better practice: add event listener in JS instead of inline onchange
// (You can remove the onchange attribute from select if you use this)
document.addEventListener("DOMContentLoaded", function () {
    const statusSelect = document.getElementById("payment_status");
    const form = document.getElementById("filter-form");

    if (statusSelect && form) {
        statusSelect.addEventListener("change", function () {
            form.submit();
        });
    }

    // Optional: show loading text on filter button during submit
    form?.addEventListener("submit", function () {
        const btn = this.querySelector('button[type="submit"]');
        if (btn) {
            btn.disabled = true;
            btn.textContent = "Filtering...";
        }
    });
});
