
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
