let $message = $('#message');

const commonServices = () => {
  const hideToast = () => {
    setTimeout(() => {
      $message.addClass('hidden');
    }, 3000);
  };

  const showToast = () => {
    $message.removeClass('hidden');
  }

  return {
    hideToast,
    showToast
  }
}

export default commonServices;
