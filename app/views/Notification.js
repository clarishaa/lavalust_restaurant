function showNotification(icon, title, message) {
    Swal.fire({
        icon: icon,
        title: title,
        text: message,
        showConfirmButton: false,
        timer: 1500
    });
}