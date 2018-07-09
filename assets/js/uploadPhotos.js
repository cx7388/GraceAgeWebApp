var data = '<button class="btn btn-default">Add photos</button>';
var index = 0;
function upload(){
    console.log('clicked');
    $('#drop-zone').html(data);
}

function show(){
    
    
    var id;
    var width = $('#begin').width(); 
    var input = document.getElementById('btn-input');
    console.log(input.value);
    if(input.value!=='')
    {
        var appendContent = '<div class="container-msg" style="width:'+width+'px" id="msg'+index+'"><p>'+input.value+'<span class="time-right">11:00</span></p></div>'

        if(index === 0)
        {
            id = '#chat-box';
        }
        else{
            id = '#msg'+(index-1);
        }
        console.log(id);
        $(id).append( appendContent );

         index = index+1;
    }
};