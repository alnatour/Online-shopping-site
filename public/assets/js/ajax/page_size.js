$(document).ready(function () {
    $("#PageSize").change(function(){ /* WHEN YOU CHANGE AND SELECT FROM THE SELECT FIELD */
        var Pagesize = $(this).val(); /* GET THE VALUE OF THE SELECTED DATA */
       
        $.ajax({ /* THEN THE AJAX CALL */
          type: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
          url: "ajax.php", /* PAGE WHERE WE WILL PASS THE DATA */
          data:{"PageSize": Pagesize}, /* THE DATA WE WILL BE PASSING */
          success: function(response){ /* GET THE TO BE RETURNED DATA */
            $("#postsdiv").html(response);
            //window.location.reload();
            console.log(response);
            /* THE RETURNED DATA WILL BE SHOWN IN THIS DIV */
          },
        });
      }); 
    
});

