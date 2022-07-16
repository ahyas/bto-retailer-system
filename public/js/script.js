window.addEventListener('DOMContentLoaded', event => {
    var elem = document.getElementById("submenu1");
    var elem2 = document.getElementById("submenu2");

    var tab = document.getElementById("sub-tab1");
    
    document.querySelectorAll('.sidebar .tab1').forEach(function(element){
        element.addEventListener('click', function (e) {
            if(document.getElementById("submenu1").className=="submenu collapse"){
                localStorage.setItem('activeMenu', "submenu");
                elem.className = "submenu";
            }else{
                localStorage.setItem('activeMenu', "submenu collapse");
                elem.className = "submenu collapse";
            }
            
        });

    });

    document.querySelectorAll('.sidebar .tab2').forEach(function(element){
        element.addEventListener('click', function (e) {
            if(document.getElementById("submenu2").className=="submenu collapse"){
                localStorage.setItem('activeMenu2', "submenu");
                elem2.className = "submenu";
            }else{
                localStorage.setItem('activeMenu2', "submenu collapse");
                elem2.className = "submenu collapse";
            }
            
        });

    });

    var state = localStorage.getItem("activeMenu");
    document.getElementById('submenu1').className = state;

    var state2 = localStorage.getItem("activeMenu2");
    document.getElementById('submenu2').className = state2;

    if (state===null ){
        document.getElementById('submenu1').className = "submenu collapse";
    }
    
    if(state2===null){
        document.getElementById('submenu2').className = "submenu collapse";
    }
    
});

