window.addEventListener('DOMContentLoaded', event => {

    document.querySelectorAll('.sidebar .nav-link').forEach(function(element){

        element.addEventListener('click', function (e) {

            let nextEl = element.nextElementSibling;

            if(nextEl) {
                e.preventDefault();	
                let mycollapse = new bootstrap.Collapse(nextEl);

                mycollapse.show();
                  
            }

        });
    });

    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        console.log("open");
    });

});
