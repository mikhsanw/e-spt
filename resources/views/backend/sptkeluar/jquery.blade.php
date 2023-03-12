$(document).on("click",".lihat",function() {
    ojisatrianiLoadingFadeIn();
    var id = $(this).attr("{{$kode.'-id'}}");
    $.loadmodal({
        url: "{{ url($url_admin.'/'.$kode) }}/lihat/"+ id,
    id: 'responsive',
        dlgClass: 'fade',
        bgClass: 'warning',
        title: 'Lihat',
        width: 'whatever',
        modal: {
            keyboard: true,
            // any other options from the regular $().modal call (see Bootstrap docs)
            },
        ajax: {
            dataType: 'html',
            method: 'GET',
            success: function(data, status, xhr){
                $('.modal-footer').remove();
                ojisatrianiLoadingFadeOut();
            },
        },
    });
});