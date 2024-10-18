
    // Function to convert text to slug
    function convertToSlug(text) {
        return text
            .toLowerCase()
            .replace(/[^\w ]+/g, '')    // Remove special characters
            .replace(/\s+/g, '-');      // Replace spaces with dashes
    }

    // Event listener for name input field
    document.getElementById('name').addEventListener('input', function () {
        let name = this.value;
        document.getElementById('slug').value = convertToSlug(name);
    });

// Image Preview
    function previewImage(event) {
        var imagePreview = document.getElementById('imagePreview');
        var file = event.target.files[0];
        
        if (file) {
            var reader = new FileReader();

            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block'; // Show the image preview
            }

            reader.readAsDataURL(file);
        }
    }