function showAlert(status, message) {
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

    Toast.fire({
        icon: status,
        title: message
    }).then(() => {
        if (status === 'success') {
            // Redirigir al usuario al login después de que el temporizador termine
            window.location.href = "/CRUD-ALOJAMIENTOS/views/login.php";
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {
    if (registerMessage && registerStatus) {
        showAlert(registerStatus, registerMessage);
    }
});