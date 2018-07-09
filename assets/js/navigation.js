


//this function creates an HTML anchor element with a link to the right department
function createURL(department){
    var a = document.createElement('a');
    var linkText = document.createTextNode(department.name);
    a.appendChild(linkText);
    a.href = base_url + "index.php/NavigationController/showRooms?department=" + department.name;
    document.body.appendChild(a);
    var br = document.createElement('br');
    document.body.appendChild(br);
}

function displayDepartment(departmentName){
    window.location.href = base_url + "index.php/NavigationController/showRooms/" + departmentName +"?department=" + departmentName;
}

function alertTest(){
    alert("Test");
}

//Dynamic content

// Parse the URL parameter
function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}


// Give the parameter a variable name
var dynamicContent = getParameterByName('department');

$(document).ready(function() {
    // Check if the URL parameter is 
    if (dynamicContent === 'rooms') {
            $('#rooms').show();
    } 
    // Check if the URL parmeter is empty or not defined, display default content
    else {
            $('#default-content').show();
    }
});
