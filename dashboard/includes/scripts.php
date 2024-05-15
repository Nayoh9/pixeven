    <!-- ** BOOTSTRAP SCRIPT ** -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- **FILE READER SCRIPT ** -->
    <script>
        const fileInput = document.getElementById("file_to_upload");
        const preview = document.getElementById("preview");

        fileInput.addEventListener("change", () => {
            if (fileInput.files.length > 0) {
                file = fileInput.files[0];


                const fr = new FileReader();

                fr.readAsDataURL(file);
                fr.addEventListener("load", () => {
                    for (let i = 0; i < preview.children.length; i++) {
                        preview.removeChild(preview.children[i]);
                    }
                    const url = fr.result;
                    const img = new Image();

                    img.setAttribute("class", "form_asset");
                    img.src = url;
                    preview.appendChild(img);
                });


            }
        });


        const filesInput = document.getElementById("files_to_upload");
    </script>


    <!-- ONE CLICK DISABLE BUTTON SCRIPT  -->

    <script>
        const validate_project_button = document.getElementById("valid_project_button")
        const validate_project_form = document.getElementById("valid_project_form");

        validate_project_form.addEventListener("submit", () => {
            validate_project_button.setAttribute("disabled", true)
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

            const modal_header = document.getElementById("modal-header");
            const modal_body = document.getElementById("modal-body");
            const modal_save = document.getElementById("modal-save");

            const form_direction = document.getElementById("direction");
            const target_name = document.getElementById("target_data_container").getAttribute("data-title");
            const action = "<?= $action ?>";


            modify_button.addEventListener("click", () => {
                modal_header.innerHTML = ` Modification de "${target_name}"`;
                modal_body.innerHTML = `Êtes-vous sûr de vouloir modifier "${target_name}" ?`;
                modal_save.innerHTML = "Sauvegarder les changements";

                modify_target_form.setAttribute("action", action);
                modal_save.setAttribute("class", "btn btn-primary");
                form_direction.setAttribute("value", "modify");

            });

            delete_button.addEventListener("click", () => {
                modal_header.innerHTML = `Suppression de "${target_name}"`;
                modal_body.innerHTML = `Êtes-vous sûr de vouloir supprimer "${target_name}" ?`;
                modal_save.innerHTML = `Supprimer "${target_name}"`

                modify_target_form.setAttribute("action", action);
                modal_save.setAttribute("class", "btn btn-danger");
                form_direction.setAttribute("value", "delete");

            })
        })
    </script>

    <!-- **DISPLAY INPUT FILES SCRIPT** -->

    <script>
        const multi_input_file = document.getElementById("project_pictures");
        const files_name_container = document.getElementById("files_container");

        multi_input_file.addEventListener("change", (e) => {

            const files = e.target.files
            const arr = Array.from(files)

            files_name_container.innerHTML = '';

            arr.forEach((file) => {
                const p = document.createElement("p");
                p.setAttribute("class", "displayed_files")
                p.textContent = file.name;
                files_name_container.appendChild(p);

            })


        })
    </script>