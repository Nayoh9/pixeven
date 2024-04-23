<!-- ** BOOTSTRAP SCRIPT ** -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- ** BOOTSTRAP SCRIPT ** -->



<!-- **FILE READER SCRIPT ** -->

<script>
    const fileInput = document.getElementById("file_to_upload");
    const preview = document.getElementById("preview");

    fileInput.addEventListener("change", () => {
        const fr = new FileReader();
        fr.readAsDataURL(fileInput.files[0]);
        fr.addEventListener("load", () => {
            console.log(preview.children.length);
            for (let i = 0; i < preview.children.length; i++) {
                preview.removeChild(preview.children[i]);
            }
            const url = fr.result;
            const img = new Image();
            img.setAttribute("class", "project_picture");
            img.src = url;
            preview.appendChild(img);
        })
    })
</script>

<!-- ** FILE READER SCRIPT ** -->

<!-- ** TYNE MCE SCRIPT ** -->

<!-- Place the first <script> tag in your HTML's <head> -->
<script src="https://cdn.tiny.cloud/1/<?= $tiny_mce_key ?>/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<script>
    tinymce.init({
        selector: 'textarea', // change this value according to your HTML
        menubar: 'file edit view'
    });
</script>

<!-- ** TYNE MCE SCRIPT ** -->