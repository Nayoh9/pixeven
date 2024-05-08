    <!-- ** BOOTSTRAP SCRIPT ** -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- **FILE READER SCRIPT ** -->
    <script>
        const fileInput = document.getElementById("file_to_upload");
        const preview = document.getElementById("preview");

        fileInput.addEventListener("change", () => {
            if (fileInput.files.length > 0) {
                file = fileInput.files[0];

                switch (file.type) {
                    case "image/jpeg":
                    case "image/png":
                    case "image/jpg":
                        const fr = new FileReader();

                        fr.readAsDataURL(file);
                        fr.addEventListener("load", () => {
                            for (let i = 0; i < preview.children.length; i++) {
                                preview.removeChild(preview.children[i]);
                            }
                            const url = fr.result;
                            const video = new Image();

                            img.setAttribute("class", "form_asset");
                            img.src = url;
                            preview.appendChild(img);
                        });
                        break;

                    case "video/mp4":

                        const fr_video = new FileReader();

                        fr_video.readAsDataURL(file);
                        fr_video.addEventListener("load", () => {
                            for (let i = 0; i < preview.children.length; i++) {
                                preview.removeChild(preview.children[i]);
                            }
                            const url = fr_video.result;
                            const video = document.createElement("video");

                            video.setAttribute("class", "form_asset");
                            video.src = url;
                            video.controls = true;
                            preview.appendChild(video);
                        });
                        break;

                    default:

                }
            }
        });
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