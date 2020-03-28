$(document).ready(function () {
    $("#PageSize").change(function(){ /* WHEN YOU CHANGE AND SELECT FROM THE SELECT FIELD */
        var Pagesize = $(this).val(); /* GET THE VALUE OF THE SELECTED DATA */
       
        $.ajax({ /* THEN THE AJAX CALL */
          type: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
          url: "view/main/products_per_page_ajax.php", /* PAGE WHERE WE WILL PASS THE DATA */
          data:{"PageSize": Pagesize}, /* THE DATA WE WILL BE PASSING */
          success: function(response){ /* GET THE TO BE RETURNED DATA */
            $("#postsdiv").html(response);
            console.log(response);
            //window.location.reload();
            /* THE RETURNED DATA WILL BE SHOWN IN THIS DIV */
          },
        });
      }); 
    
});

