/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function chooseEnglish(link){
    $.ajax({
        type: "POST",
        url: link+"index.php/LanguageController/english",
        data: {language: "english"},
        success: function (data)
        {
            location.reload();
        },
        error: function (data) {
            alert(data.status);
        }
    }
    );
    
}

function chooseDutch(link){
    $.ajax({
        type: "POST",
        url: link+"index.php/LanguageController/dutch",
        data: {language: "dutch"},
        success: function (data)
        {
            location.reload();
        },
        error: function (data) {
            alert(data.status);
        }
    }
    );
    
}
