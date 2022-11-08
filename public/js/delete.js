var base = location.protocol + '//' + location.host;
// var route = document.getElementsByName('routeName')[0].getAttribute('content');
// const http = new XMLHttpRequest();
// const csrfToken = document.getElementsByName('csrf-token')[0].getAttribute('content');
console.log(base);

document.addEventListener('DOMContentLoaded', function() {
    btn_deleted = document.getElementsByClassName('btn-deleted');
    for (i = 0; i < btn_deleted.length; i++) {
        btn_deleted[i].addEventListener('click', delete_object)
    }
});


function delete_object(e) {
    e.preventDefault();
    var object = this.getAttribute('data-object');
    var action = this.getAttribute('data-action');
    var path = this.getAttribute('data-path');
    var url = base + '/' + path + '/' +
        object
    console.log(url);
    var title, text, icon, buttons, dM;
    if (action == 'borrar') {
        title = "¿Estas seguro de eliminar este objeto?";
        text = "Estas a punto de enviar este objeto a la papelera.";
        icon = "warning";
    }
    // if (action == 'recuperar') {
    //     title = "¿Quieres restaurar este elemento?";
    //     text = "Estas a punto de volver este elemento a la tienda.";
    //     icon = "info";
    // }

    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        showCancelButton: true,
    }).then((result) => {
        if (result.value) {
            // swal("Producto borrado con éxito", {
            //     icon: "success",
            //     timer: 100000,
            // });
            window.location.href = url;
        }
    });

}