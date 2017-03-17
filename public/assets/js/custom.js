// Notification
function flashNotification(message, type) {
    toastr.options = {
      "preventDuplicates": false,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-bottom-right",
      "timeOut": "2500",
      "extendedTimeOut": "500",
      "showMethod": "slideDown",
      "hideMethod": "fadeOut",
    }

    if(type === 'success')
      toastr.success(message, 'Sucesso');
    else
      toastr.error(message, 'Falha');
  }