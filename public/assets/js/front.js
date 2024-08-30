//BASEURL
const BASE_URL=window.location.origin;

//FUNKCIJA ZA PRIKAZ PROIZVODA, button iskoriscen zbog style
$(document).on('click','.viewProduct',function(){
    let id=$(this).attr("data-id");
    window.location.href='/item/'+id;
});

//DODAVANJE U KORPU
$(document).on('click','.add-to-cart-btn',function(){
    let id=$(this).attr("data-id");
    let token=$(this).attr("data-token");
    $.ajax({
        url:BASE_URL+'/add-to-cart',
        data:{
            '_method' : "post",
            '_token' : token,
            'id': id
        },
        method:'post',
        success:function(response){
            $('span#popup'+id).html(response);
            let qty=$('.qty').html();
            let qtyNum=Number(qty.trim());
            $('.qty').html(qtyNum+1);
            setTimeout(function(){
                $('span#popup'+id).html(' add to cart');
            },1000);
        },
        error:function(xhr){
            $('span#popup'+id).html(xhr);
            setTimeout(function(){
                $('span#popup'+id).html(' add to cart');
            },2000);
        }
    });
});

//POVECAVANJE KOLICINE U KORPI
$(document).on('click','.raise-quantity',function(){
    let id=$(this).attr('data-id');
    let token=$(this).attr("data-token");
    let alertQty=document.getElementById('alertQty');
    $.ajax({
        url:BASE_URL+'/add-to-cart',
        data:{
            '_method' : "post",
            '_token' : token,
            'id': id
        },
        method:'post',
        success:function(response){
            alertQty.innerHTML='Quantity Raised.';
            $('#alertQty').css('visibility','visible');
            let price=Number($('#price'+id).html());

            let qty=$('#quantityCart'+id).html();
            let qtyNum=Number(qty.trim());
            let quantity=$('.qty').html();

            let quantityNumber=Number(quantity.trim());
            $('#totalIndividual'+id).html(parseFloat(price*(qtyNum+1)).toFixed(2));
            $('.qty').html(quantityNumber+1);
            $('#quantityCart'+id).html(qtyNum+1);
            let totalPrice=Number($('#totalPrice').html());
            $('#totalPrice').html(parseFloat(totalPrice+price).toFixed(2));
            setTimeout(function(){
                $('#alertQty').css('visibility','hidden');
            },3000);
        },
        error:function(xhr){
            console.log(xhr);
        }
    });
});

//SMANJENJE KOLICINE - UKLANJANJE PROIZVODA IZ KORPE
$(document).on('click','.lower-quantity',function(){
    let id=$(this).attr('data-id');
    let token=$(this).attr("data-token");
    let alertQty=document.getElementById('alertQty');
    $.ajax({
        url:BASE_URL+'/lower-cart-quantity',
        data:{
            '_method' : "post",
            '_token' : token,
            'id': id
        },
        method:'post',
        success:function(response){
            if(response['status']==200){
                alertQty.innerHTML=response['message'];
                $('#alertQty').css('visibility','visible');
                let quantity=$('.qty').html();
                let quantityNumber=Number(quantity.trim());
                let price=Number($('#price'+id).html());
                let qty=$('#quantityCart'+id).html();
                let qtyNum=Number(qty.trim());
                $('.qty').html(quantityNumber-1);
                $('#quantityCart'+id).html(qtyNum-1);
                $('#totalIndividual'+id).html(parseFloat(price*(qtyNum-1)).toFixed(2));
                let totalPrice=Number($('#totalPrice').html());
                $('#totalPrice').html(parseFloat(totalPrice-price).toFixed(2));
                setTimeout(function(){
                    $('#alertQty').css('visibility','hidden');
                },3000);
            }
            if(response['status']==201){
                window.location.reload();
            }
        },
        error:function(xhr){
            alertQty.innerHTML=xhr['message'];
        }
    });
});

//UPDATE USER PROFILE
$(document).on('click','#editProfileBtn',function(){
    let id=$(this).attr('data-id');
    let token=$(this).attr('data-token');
    let firstName=$('#firstName').val();
    let lastName=$('#lastName').val();
    let phone=$('#phone').val();
    let address=$('#address').val();
    let zip=$('#zip').val();
    let city=$('#city').val();
    let country=$('#country').val();
    let email=$('#email').val();
    let password=$('#password').val();
    let newPassword;
    if($('#new_password').val())
        newPassword=$('#new_password').val();
    $.ajax({
        url:BASE_URL+'/profile/edit',
        method:'put',
        data:{
            '_method':'put',
            '_token':token,
            'id':id,
            'first_name':firstName,
            'last_name':lastName,
            'phone':phone,
            'address':address,
            'zip':zip,
            'city':city,
            'country':country,
            'email':email,
            'password':password,
            'new_password':newPassword?newPassword:'no'
        },
        dataType:'json',
        success:function(response){
            $('#errorUpd').hide();
            $('#successUpd').html(response.success);
            $('#successUpd').show();
            setTimeout(function(){
                window.location.href=BASE_URL+'/profile';
            },3000);
        },
        error:function(xhr){
            let ers="";
            xhr.responseJSON.errors.forEach(x => {
                ers+=x+"<br/>";
            });
            $('#errorUpd').html(ers);
            $('#errorUpd').show();
        }
    });
});

//UPDATE USER CARD
$(document).on('click','#editCard',function(){
    let id=$(this).attr('data-id');
    let token=$(this).attr('data-token');
    let card=$('#card').val();
    let date=$('#date').val();
    let newCard;
    if($('#new_card').val())
        newCard=$('#new_card').val();
    $.ajax({
        url:BASE_URL+'/profile/card',
        method:'put',
        data:{
            '_method':'put',
            '_token':token,
            'id':id,
            'card':card,
            'new_card':newCard?newCard:'no',
            'date':date+'-01'
        },
        dataType:'json',
        success:function(response){
            $('#errorCard').hide();

            $('#successCard').html(response.success);
            $('#successCard').show();
            setTimeout(function(){
                window.location.href=BASE_URL+'/profile';
            },3000);
        },
        error:function(xhr){
            let ers="";
            xhr.responseJSON.errors.forEach(x => {
                ers+=x+"<br/>";
            });
            $('#errorCard').html(ers);
            $('#errorCard').show();
        }
    });
});

//SHOW ITEMS FOR CLICKED ORDER
$(document).on('click','.showOrderItems',function(){
    let id=$(this).attr('data-id');
    $('.orderItem'+id).toggle();
});

//ONLOAD PRODUCTS STRANICA - DOHVATANJE PROIZVODA
$(document).ready(function(){
    if(document.getElementById('productsDiv')){
        getItems($('#token').val());
    }
});

//EVENTS ZA FILTER
$(document).on('change','#aside',function(){getItems($('#token').val())});
$(document).on('keyup','#price-max',function(){getItems($('#token').val())});
$(document).on('keyup','#price-min',function(){getItems($('#token').val())});
$(document).on('change','#search',function(){getItems($('#token').val())});
$(document).on('keyup','#search',function(){getItems($('#token').val())});
$(document).on('click','.pageBtn',function(){
    getItems($('#token').val(),0,0,0,0,null,$(this).attr('data-id'));
});

//FUNKCIJA ZA FILTERE, PAGINACIJU I DOHVATANJE PROIZVODA
function getItems(token,categories=0,brands=0,minPrice=0,maxPrice=0,search=null,page=1){
    let catCheckboxes=document.querySelectorAll('.categoryCb');
    let catArray=[];
    catCheckboxes.forEach(function(c){
        if(c.checked)
            catArray.push(c.value)
    });
    if(catArray.length>0)
        categories=catArray;

    let brandCheckboxes=document.querySelectorAll('.brandCb');
    let brandArray=[];
    brandCheckboxes.forEach(function(b){
        if(b.checked)
            brandArray.push(b.value)
    });
    if(brandArray.length>0)
        brands=brandArray

    if($('#price-min').val()>0)

        minPrice=$('#price-min').val()
    if($('#price-max').val()>0)
        maxPrice=$('#price-max').val()

    if($('#search').val()!="")
        search=$('#search').val()

    $.ajax({
        url:'/getItems',
        method:'get',
        data:{
            '_token':token,
            '_method':'get',
            'categories':categories,
            'brands':brands,
            'minPrice':minPrice,
            'maxPrice':maxPrice,
            'search':search,
            'page':page
        },
        dataType:'json',
        success:function(response){
            $('#productsDiv').html(response.reply);
            $('#pagination').html(response.pagination);
        },
        error:function(xhr){
            console.log(xhr.responseJSON);
        }
    });
}
