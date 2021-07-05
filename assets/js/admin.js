let base_url = '';
$(document).ready(function() {
    base_url = $('.base_url').val();
    setTimeout(function() {
        $("input[data-layout=fixed]").prop('checked', true)
        $(".sidebar-mini").addClass('fixed')
    }, 500)
})


function uploadFile(e, baseUrl) {    

    let image = new FormData();
    image.append('image', e.files[0])      

    let index = $('.file').index(e)
        
    if(e.files[0] === undefined) {
        return false;
    }
    

    $.ajax({
        url: baseUrl+'admin/uploadFile',
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: image,
        type: 'post',
        success: function(res) { 
            res = JSON.parse(res)
            if(res.status == 'success') {                                
                $(".image-wrapper").eq(index)
                .html('')
                .append(`
                    <img src="${baseUrl}assets/images/upload/${res.filename}" width="150" height="100">
                    <input type="hidden" value="${res.filename}" name="image[]">
                `)
            } else {
                alert('Hay un error '+res.error.error)
            }       
        }
    })
}

function uploadCustom(e, baseUrl, type) {
    let image = new FormData();
    image.append('image', e.files[0])      

    let index = $('.file').index(e)
        
    if(e.files[0] === undefined) {
        return false;
    }
    

    $.ajax({
        url: baseUrl+'admin/uploadCustom',
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: image,
        type: 'post',
        success: function(res) { 
            res = JSON.parse(res)
            if(res.status == 'success') {
                $(".image-wrapper").eq(index)
                .html('')
                .append(`
                    <img src="${baseUrl}assets/images/logo/${res.filename}" width="150" height="100">
                    <input type="hidden" value="${res.filename}" name="${type}">
                `)
            } else {
                alert('Hay un error '+res.error.error)
            }       
        }
    })
}



$(document).on('DOMNodeInserted', function() {
    $(".delete-photo").click(function(e) {
        $(e.target).parent().remove();                
    })
})

function deletePhotoDb(e, idproduk, namafoto) {
    let y = confirm('Estas seguro de eliminar esta foto?');
    if(y) {
        $.ajax({
            url: base_url+'admin/deletePhotoDb',
            type: 'post',
            data: {idproduk, namafoto},
            success: function(res) {
                console.log(res)
            }
        })
        $(e).parent().remove();
    }    
}

$("#addPhoto").click(function(e) {
    e.preventDefault();
    $(".parent-photos").append(`
        <div class="form-group" style="position:relative;display:inline-block;padding:10px;border:1px solid grey;">
            <label class="text-success" for="file">Seleccione Foto</label>
            <input class="file" type="file" accept="image/*" required onchange="uploadFile(this, '${base_url}')">      
            <div class="image-wrapper" style="padding:5px 0px;">
                <!-- SUCCESS IMAGE UPLOAD SET HERE -->
            </div>            
            <button class="btn btn-xs btn-danger delete-photo" style="position:absolute;top:0;right:0;">eliminar</button>
        </div>          
    `)
})

