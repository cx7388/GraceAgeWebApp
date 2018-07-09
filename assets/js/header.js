
function goBack() {
    window.history.back();
}

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