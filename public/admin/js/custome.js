$(document).ready(function()
{
    $('#current_pwd').keyup(function(){
        var current_pwd = $('#current_pwd').val();
        //alert(current_pwd);
         $.ajax({
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
               type:'POST',
               url:'/admin/check-current-pwd',
               data:{current_pwd:current_pwd},
               success:function(resp)
               {
                //true;
                  console.log(resp);
                  if(resp=="false")
                 {
                    //console.log("Current password is Incorrect Password");
                   $("#verifycurrentpwd").html("Current password is Incorrect Password");
                 }
                 else if(resp=="true")
                 {
                   $("#verifycurrentpwd").html("Current password is Correct");
                 }
             },error:function(){
                alert("Error");
               }
         })
    });
});
