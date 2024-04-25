    <!-- ** BOOTSTRAP SCRIPT ** -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- **FILE READER SCRIPT ** -->
    <script>
        const fileInput = document.getElementById("file_to_upload");
        const preview = document.getElementById("preview");

        fileInput.addEventListener("change", () => {
            const fr = new FileReader();
            fr.readAsDataURL(fileInput.files[0]);
            fr.addEventListener("load", () => {
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

    <!-- ** TINY MCE SCRIPT ** -->
    <!-- Place the first <script> tag in your HTML's <head> -->
    <script src="https://cdn.tiny.cloud/1/<?= $tiny_mce_key ?>/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
    <script>
        tinymce.init({
            selector: 'textarea', // change this value according to your HTML
            menubar: 'file edit view',
        });
    </script>

    <!-- **HANDLE MODAL SCRIPT** -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const delete_button = document.getElementById("delete_button");
            const modify_button = document.getElementById("modify_button");
            const modify_target_form = document.getElementById("modify_target_form");
            const target_name = document.getElementById("project_data_container").getAttribute("data-title");

            const modal_header = document.getElementById("modal-header");
            const modal_body = document.getElementById("modal-body");
            const modal_save = document.getElementById("modal-save");

            const modified = "<?= $modified_target; ?>";
            const deleted = "<?= $deleted_target; ?>";

            modify_button.addEventListener("click", () => {
                modal_header.innerHTML = ` Modification de "${target_name}"`;
                modal_body.innerHTML = `Êtes-vous sûr de vouloir modifier "${target_name}" ?`;
                modal_save.innerHTML = "Sauvegarder les changements";

                modify_target_form.setAttribute("action", modified);
                modal_save.setAttribute("class", "btn btn-primary");
            });

            delete_button.addEventListener("click", () => {
                modal_header.innerHTML = `Suppression de "${target_name}"`;
                modal_body.innerHTML = `Êtes-vous sûr de vouloir supprimer "${target_name}" ?`;
                modal_save.innerHTML = `Supprimer "${target_name}"`

                modify_target_form.setAttribute("action", deleted);
                modal_save.setAttribute("class", "btn btn-danger");
            })
        })
    </script>