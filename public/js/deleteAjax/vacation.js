$(function(){
    // delete faculty Member

    $('.vacationlist a.delete').on('click',function(){
        var element = $(this);
        var id = element.data('id');
        var targetURL= 'vacation/'+id;
        var token = element.data('token');

        if(id){
            $.ajax({
                type:'DELETE',
                url: targetURL,
                data:{
                    'id' : id,
                    '_token' : token,
                },
                beforeSend:function(){
                    return confirm("Are you sure?");
                },
                success:function(response){
                    handleResponse(response,element);
                }
            });
        }
    });

    // handel all response
    function handleResponse(response,element){
        var MainDiv = document.createElement("div");
        MainDiv.setAttribute('style','width: 97%;text-align: center;');
        MainDiv.setAttribute('class','ajaxMessage')

        if(response.msg){
            var msgDiv = document.createElement('div');
                msgDiv.setAttribute('class','alert alert-success');
                msgDiv.setAttribute('style','font-weight:bold');
                msgDiv.textContent = response.msg;
            MainDiv.append(msgDiv)
            element.closest("tr").slideUp();
        }

        if(response.errors){
            for (let index = 0; index < response.errors.id.length; index++) {
                var errorDiv = document.createElement('div');
                errorDiv.setAttribute('class','alert alert-danger');
                errorDiv.setAttribute('style','font-weight:bold');
                errorDiv.textContent = response.errors.id[index];
                MainDiv.append(errorDiv)
            }
        }
        $('.item-lists').prepend(MainDiv);

        $('.ajaxMessage').slideDown(function(){
            setTimeout(function(){
                $('.ajaxMessage').slideUp(function(){
                    $(this).remove();
                });
            }, 8000);
        });
    }

});
