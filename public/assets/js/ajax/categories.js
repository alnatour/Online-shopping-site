$(document).ready(function () {
    $("#category").change(function(){ /* WHEN YOU CHANGE AND SELECT FROM THE SELECT FIELD */
        var cid = $(this).val(); /* GET THE VALUE OF THE SELECTED DATA */
       
        $.ajax({ /* THEN THE AJAX CALL */
          type: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
          url: "‏‏ajax_category.php", /* PAGE WHERE WE WILL PASS THE DATA */
          data:{"cid": cid}, /* THE DATA WE WILL BE PASSING */
          success: function(response){ /* GET THE TO BE RETURNED DATA */
           $("#subCategory").html(response);
           console.log(response);
            /* THE RETURNED DATA WILL BE SHOWN IN THIS DIV */
          },
        });
      });  
});
