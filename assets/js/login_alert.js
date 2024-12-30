const Toast = Swal.mixin({
    toast: true,
    position: "top",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    }
});

document.addEventListener("DOMContentLoaded", function() {
    if (loginMessage) {
        Toast.fire({
            icon: "error",
            title: loginMessage
        });
    }
});