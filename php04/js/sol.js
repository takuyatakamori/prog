
$(function(){
      $('body').on('click', '.solBtn', function(e){
        console.log(e);
        e.stopPropagation();
        const soltn = $(".solBtn").data(sol);
        $.ajax({
                url: 'sol.php',
                type:'POST',
                dataType: 'json',
                data: {
                    sol: soltn
                },
        }).done(function(data){
                // alert('成功');
                console.log(data.text);

        }).fail(function(msg, XMLHttpRequest, textStatus, errorThrown){
                alert(msg);
                console.log(XMLHttpRequest.status);
                console.log(textStatus);
                console.log(errorThrown);
        });
      });
});