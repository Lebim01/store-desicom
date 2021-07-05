let base_url = '';
$(document).ready(function(){
    $('.parallax').parallax();
    $('.sidenav').sidenav();
    $('.materialboxed').materialbox();

    base_url = $('.base_url').val();
});

function changeImage(idx, url) {
    $(".image-collection img").removeClass('image-collection-active');
    $(".image-collection img").eq(idx).addClass('image-collection-active');
    $("#primary-image").attr('src', url);
}


function getCategory() {
    $.ajax({
        url: base_url+`home/getCategories`,
        success: function(res) {
            let categories = JSON.parse(res);
            categories.forEach(category => {
                $("#wrap-categories").append(`
                    <div class="my-chip" onclick="getProducts(10, '${category.nama_kategori}')">${category.nama_kategori}</div>
                `)                
            })
        }
    })
}
getCategory()


let limit = 10;

function getProducts(limit, category='') {    
    $(".my-chip").removeClass('active-chip')
    $(".my-chip").eq(0).removeClass('active-chip')
    if(!category.length) {        
        $(".my-chip").removeClass('active-chip')
        $(".my-chip").eq(0).addClass('active-chip')
    }
    if(category.length) {
        $(`.my-chip:contains("${category}")`).addClass('active-chip')
    }    
    $.ajax({
        url: base_url+`home/getProducts/${limit}?category=${category}`,
        success: function(res) {
            let products = JSON.parse(res)        

            if(products.length > 10) {
                $("#more-products").html(`
                    <a onclick="getProducts(${limit+=10})" class="waves-effect waves-dark btn-large rounded btn-outline teal-text rm-box-shadow">Tampilkan Produk Lainnya</a>
                `)
            }
            $("#wrap-products").html('')
            if(!products.length) {
                $("#wrap-products").html(`
                    <h4 class="center">Belum ada produk dengan kategori "${category}"</h4>
                `)
            }
            products.forEach(product => {                                
                $("#wrap-products").append(`
                    <div class="col s12 m6 l3" style="box-sizing:border-box;">  
                        <div class="card rm-box-shadow my-border">
                            <div class="card-image">
                                <img src="${base_url}assets/images/upload/${product.foto_produk.length > 0 ? product.foto_produk[0].nama_foto : ''}" width="100%" height="250px">
                                <!-- <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">add</i></a> -->
                            </div>
                            <div class="card-content text-center">
                                <h6 class="font-weight-bold blue-grey-text">${product.nama_produk.substring(0, 34)}${product.nama_produk.length > 34 ? '...' : ''}  </h6>
                                <h6 class="font-weight-thin teal-text">$${product.harga}</h6>
                            </div>
                            <div class="d-flex justify-center" style="padding: 10px 0px;">
                                <a href="${base_url}product/${product.id_produk}">
                                    <button class="waves-effect d-flex align-center justify-center waves-dark rm-box-shadow capitalize btn-small btn-block teal-text btn-outline">
                                        <i class="material-icons">remove_red_eye</i>&nbsp;
                                        Ver
                                    </button>            
                                </a>            
                            </div>                        
                        </div>
                    </div>
                `)
            })
        }
    })
}

getProducts(limit, '');



function whatsapp(message) {
    /*let jumlah = $("#kuantitas").val();
    if(!jumlah.length) {
        alert('Harap isi kuantitas pembelian!');
    }
    else if(jumlah < 1) {
        alert('Kuantitas tidak boleh kurang dari 1')
    }    
    else {
        
    }*/
    window.open(`https://wa.me/526691241222?text=${message}`, '_blank') 
}