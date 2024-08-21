const edit = document.getElementById("editForm");

if (edit) {
    const titleInput = document.getElementById("title");
    const titleError = titleInput.nextElementSibling;

    const aboutDescriptionInput = document.getElementById("about_description");
    const aboutDescriptionError = aboutDescriptionInput.nextElementSibling;

    const ratingInput = document.getElementById("rating");
    const ratingError = ratingInput.nextElementSibling;

    const aboutInput = document.getElementById("about");
    const aboutError = aboutInput.nextElementSibling;
    const aboutCharCount = document.getElementById("about-char-count"); // Moved it inside the block

    const dateInput = document.getElementById("date");
    const dateError = dateInput.nextElementSibling;

    const completeInput = document.getElementById("complete");
    const completeError = completeInput.nextElementSibling;

    const aboutCharLimit = 2500;

    edit.addEventListener("submit", (ev) => {
        let errors = false;
        if (titleInput.value.trim() === "") {
            titleError.classList.remove('hidden');
            errors = true;
        } else {
            titleError.classList.add('hidden');
        }
        if (aboutDescriptionInput.value.trim() === "") {
            aboutDescriptionError.classList.remove('hidden');
            errors = true;
        } else {
            aboutDescriptionError.classList.add('hidden');
        }

        if (aboutInput.value.trim() === "") {
            aboutError.classList.remove('hidden');
            errors = true;
        } else {
            aboutError.classList.add('hidden');
        }

        // Check for the character limit in 'about' field
        if (aboutInput.value.length > aboutCharLimit) {
            aboutError.classList.remove('hidden');
            errors = true;
        } else {
            aboutError.classList.add('hidden');
        }
        
        // Update character count indicator
        aboutCharCount.innerText = `${aboutCharLimit - aboutInput.value.length} characters left`;

        // Check for the date input
        if (dateInput.value.trim() === "") {
            dateError.classList.remove('hidden');
            errors = true;
        } else {
            dateError.classList.add('hidden');
        }

        // IF THERE ARE ERRORS, PREVENT FORM SUBMISSION
        if (errors) {
            ev.preventDefault();
        }
    });

    // Add event listener for input change in 'about' field
    aboutInput.addEventListener('input', () => {
        // Truncate the input if it exceeds the character limit
        if (aboutInput.value.length > aboutCharLimit) {
            aboutInput.value = aboutInput.value.substring(0, aboutCharLimit);
        }
        // Check for the character limit in 'about' field
        if (aboutInput.value.length > aboutCharLimit) {
            aboutError.classList.remove('hidden');
            errors = true;
        } else {
            aboutError.classList.add('hidden');
        }

        // Update character count indicator
        aboutCharCount.innerText = `${aboutCharLimit - aboutInput.value.length} characters left`;
    });
}
