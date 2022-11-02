var start = 2; //is 2, beacouse first 20 products being rendered by HomeController->indexRender();
var reachedMax = false;

$(document).ready(function(){
    $(window).scroll(function(){
        if ($(window).scrollTop() + $(window).height() >= $(document).height()){
            getData()
        }
    });
});

function getData() {
    if (reachedMax){
        return;
    }

    $.ajax({
        type:'POST',
        url:'/',
        dataType:'text',
        data:{
            getData: 1,
            start: start,
        },
        success: function(response) {
            if(response === 'reachedMax'){
                reachedMax = true;
            }
            start++;
            $('.loader').append(response);
        }
    })
};



