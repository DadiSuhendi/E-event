var $temp = $("<input>");
var $url = $(location).attr('href');;

$('#copyBtn').on('click', function() {
    $("body").append($temp);
    $temp.val($url).select();
    document.execCommand("copy");
    $temp.remove();
    Swal.fire({
        title: '<p class="text-base font-bold">Link berhasil dicopy</p>',
        icon: 'success',
        showConfirmButton: false,
        timer: 1000
    })
})