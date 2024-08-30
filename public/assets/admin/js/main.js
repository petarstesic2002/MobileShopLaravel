//BASE URL
const BASE_URL=window.location.origin;

//GET USERS/PRODUCTS ONLOAD
$(document).ready(function(){
    if(document.getElementById('adminUsers')){
        getUsersAdmin();
    }
    if(document.getElementById('adminProducts')){
        getProductsAdmin();
    }
});

//INSERT USER
$(document).on('click','#addUserBtn',function(){
    let token=$('#token').val();
    let firstName=$('#firstName').val();
    let lastName=$('#lastName').val();
    let phone=$('#phone').val();
    let address=$('#address').val();
    let zip=$('#zip').val();
    let city=$('#city').val();
    let country=$('#country').val();
    let email=$('#email').val();
    let password=$('#password').val();
    $.ajax({
        url:BASE_URL+'/admin/user/add',
        method:'post',
        data:{
            '_method':'post',
            '_token':token,
            'first_name':firstName,
            'last_name':lastName,
            'phone':phone,
            'address':address,
            'zip':zip,
            'city':city,
            'country':country,
            'email':email,
            'password':password
        },
        dataType:'json',
        success:function(response){
            $('#errorAdd').hide();
            $('#successAdd').html(response.success);
            $('#successAdd').show();
            setTimeout(function(){
                window.location.href=BASE_URL+'/admin/users';
            },3000);
        },
        error:function(xhr){
            console.log(xhr.responseJSON.errors);
            let ers="";
            xhr.responseJSON.errors.forEach(x => {
                ers+=x+"<br/>";
            });
            $('#errorAdd').html(ers);
            $('#errorAdd').show();
        }
    });
});

//UPDATE USER
$(document).on('click','#editUserBtn',function(){
    let id=$(this).attr('data-id');
    let token=$('#token').val();
    let firstName=$('#firstName').val();
    let lastName=$('#lastName').val();
    let phone=$('#phone').val();
    let address=$('#address').val();
    let zip=$('#zip').val();
    let city=$('#city').val();
    let country=$('#country').val();
    let email=$('#email').val();
    let password=$('#password').val();
    $.ajax({
        url:BASE_URL+'/admin/user/edit',
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
            'password':password!=''?password:'no'
        },
        dataType:'json',
        success:function(response){
            $('#errorUpd').hide();
            $('#successUpd').html(response.success);
            $('#successUpd').show();
            setTimeout(function(){
                window.location.href=BASE_URL+'/admin/users';
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

//DELETE USER
$(document).on('click','.userDelete',function(){
    let id=$(this).attr('data-id');
    let token=$(this).attr('data-token');
    $.ajax({
        url:BASE_URL+'/admin/user/delete',
        method:'delete',
        dataType:'json',
        data:{
            '_token':token,
            '_method':'delete',
            'id':id
        },
        success:function(response){
            $('#errorUpd').hide();
            $('#successUpd').html(response.success);
            $('#successUpd').show();
            setTimeout(function(){
                getUsersAdmin();
            },2000);
        },
        error:function(xhr){
            $('#successUpd').hide();
            let ers="";
            xhr.responseJSON.errors.forEach(x => {
                ers+=x+"<br/>";
            });
            $('#errorUpd').html(ers);
            $('#errorUpd').show();
        }
    });
});

//FILTER USER BY ID
$(document).on('change','#searchUser',function(){
    getUsersAdmin();
});
$(document).on('keyup','#searchUser',function(){
    getUsersAdmin();
});

//GET USERS
function getUsersAdmin(){
    let token=$('#token').val();
    let id=$('#searchUser').val();
    $.ajax({
        url:BASE_URL+'/admin/users/get',
        data:{
            '_token':token,
            '_method':'get',
            'id':id>0?id:0
        },
        dataType:'json',
        method:'get',
        success:function(response){
            $('#adminUsers').html(response.users);
        },
        error:function(xhr){
            console.log(xhr);
        }
    });
}

//SHOW/HIDE ITEMS FOR CLICKED ORDER
$(document).on('click','.showOrderItems',function(){
    let id=$(this).attr('data-id');
    $('.orderItem'+id).toggle();
});

//FILTER PRODUCTS BY ID
$(document).on('change','#searchProduct',function(){
    getProductsAdmin();
});
$(document).on('keyup','#searchProduct',function(){
    getProductsAdmin();
});

//ADD PRODUCT
$(document).on('click','#addProductBtn',function(){
    let token=$(this).attr('data-token');
    let data=new FormData();
    $('.details').each(function(index){
        let detailID=$(this).attr('data-id');
        let detailVal=$(this).val();
        if(detailVal)
            data.append('details[]',JSON.stringify({'id':detailID,'value':detailVal}));
        else
            data.append('details[]',JSON.stringify({'id':detailID,'value':null}));
    });
    data.append('file',$('#image')[0].files[0]);
    data.append('name',$('#name').val());
    data.append('brand',$('#brand').val());
    data.append('category',$('#category').val());
    data.append('price',$('#price').val());
    data.append('description',$('#description').val());
    data.append('_token',token);
    $.ajax({
        url:BASE_URL+'/admin/product/add',
        cache: false,
        contentType: false,
        processData: false,
        dataType:'json',
        method:'post',
        data:data,
        success:function(response){
            $('#errorAdd').hide();
            $('#successAdd').html(response.success);
            $('#successAdd').show();
            setTimeout(function(){
                window.location.href=BASE_URL+'/admin/products';
            },2000);
        },
        error:function(xhr){
            $('#successAdd').hide();
            let ers="";
            xhr.responseJSON.errors.forEach(x => {
                ers+=x+"<br/>";
            });
            $('#errorAdd').html(ers);
            $('#errorAdd').show();
        }
    });
});

//EDIT PRODUCT
$(document).on('click','#editProductBtn',function(){
    let id=$(this).attr('data-id');
    let token=$(this).attr('data-token');
    let data=new FormData();
    $('.details').each(function(index){
        let detailID=$(this).attr('data-id');
        let detailVal=$(this).val();
        if(detailVal)
            data.append('details[]',JSON.stringify({'id':detailID,'value':detailVal}));
        else
            data.append('details[]',JSON.stringify({'id':detailID,'value':null}));
    });
    data.append('file',$('#image')[0].files[0]);
    data.append('name',$('#name').val());
    data.append('brand',$('#brand').val());
    data.append('category',$('#category').val());
    data.append('price',$('#price').val());
    data.append('description',$('#description').val());
    data.append('id',id);
    data.append('_method','put');
    data.append('_token',token);
    $.ajax({
        url:BASE_URL+'/admin/product/edit',
        cache: false,
        contentType: false,
        processData: false,
        dataType:'json',
        method:'post',
        data:data,
        success:function(response){
            $('#errorUpd').hide();
            $('#successUpd').html(response.success);
            $('#successUpd').show();
            setTimeout(function(){
                window.location.href=BASE_URL+'/admin/products';
            },2000);
        },
        error:function(xhr){
            $('#successUpd').hide();
            let ers="";
            xhr.responseJSON.errors.forEach(x => {
                ers+=x+"<br/>";
            });
            $('#errorUpd').html(ers);
            $('#errorUpd').show();
        }
    });
});

//DELETE PRODUCT
$(document).on('click','.productDelete',function(){
    let id=$(this).attr('data-id');
    let token=$(this).attr('data-token');
    $.ajax({
        url:BASE_URL+'/admin/product/delete',
        method:'delete',
        dataType:'json',
        data:{
            '_token':token,
            '_method':'delete',
            'id':id
        },
        success:function(response){
            $('#errorUpd').hide();
            $('#successUpd').html(response.success);
            $('#successUpd').show();
            setTimeout(function(){
                getProductsAdmin();
            },2000);
        },
        error:function(xhr){
            $('#successUpd').hide();
            let ers="";
            xhr.responseJSON.errors.forEach(x => {
                ers+=x+"<br/>";
            });
            $('#errorUpd').html(ers);
            $('#errorUpd').show();
        }
    });
});

//GET PRODUCTS
function getProductsAdmin(){
    let token=$('#token').val();
    let id=$('#searchProduct').val();
    $.ajax({
        url:BASE_URL+'/admin/products/get',
        data:{
            '_token':token,
            '_method':'get',
            'id':id>0?id:0
        },
        dataType:'json',
        method:'get',
        success:function(response){
            $('#adminProducts').html(response.products);
        },
        error:function(xhr){
            console.log(xhr);
        }
    });
}
