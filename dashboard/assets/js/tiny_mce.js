tinymce.init({
    selector: 'textarea',
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code wordcount'
    ],
    toolbar: 'undo redo | formatselect | bold italic underline | image | forecolor | alignleft aligncenter alignjustify | bullist numlist outdent indent | removeformat | link | code'
});

