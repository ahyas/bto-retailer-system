window.addEventListener('DOMContentLoaded', event => {

    var elem3 = document.getElementById("submenu3");
    var elem4 = document.getElementById("submenu4");
    var elem5 = document.getElementById("submenu5");

    document.querySelectorAll('.sidebar .tab3').forEach(function(element){
        element.addEventListener('click', function (e) {
            if(document.getElementById("submenu3").className=="submenu collapse"){
                localStorage.setItem('activeMenu3', "submenu");
                elem3.className = "submenu";
            }else{
                localStorage.setItem('activeMenu3', "submenu collapse");
                elem3.className = "submenu collapse";
            }
            
        });

    });

    document.querySelectorAll('.sidebar .tab4').forEach(function(element){
        element.addEventListener('click', function (e) {
            if(document.getElementById("submenu4").className=="submenu collapse"){
                localStorage.setItem('activeMenu4', "submenu");
                elem4.className = "submenu";
            }else{
                localStorage.setItem('activeMenu4', "submenu collapse");
                elem4.className = "submenu collapse";
            }
            
        });

    });

    document.querySelectorAll('.sidebar .tab5').forEach(function(element){
        element.addEventListener('click', function (e) {
            if(document.getElementById("submenu5").className=="submenu collapse"){
                localStorage.setItem('activeMenu5', "submenu");
                elem5.className = "submenu";
            }else{
                localStorage.setItem('activeMenu4', "submenu collapse");
                elem5.className = "submenu collapse";
            }
            
        });

    });

    var state3 = localStorage.getItem("activeMenu3");
    document.getElementById('submenu3').className = state3;

    var state4 = localStorage.getItem("activeMenu4");
    document.getElementById('submenu4').className = state4;

    var state5 = localStorage.getItem("activeMenu5");
    document.getElementById('submenu5').className = state5;


    if(state3===null){
        document.getElementById('submenu3').className = "submenu collapse";
    }

    if(state4===null){
        document.getElementById('submenu4').className = "submenu collapse";
    }

    if(state5===null){
        document.getElementById('submenu5').className = "submenu collapse";
    }
    
});

