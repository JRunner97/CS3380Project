$(function(){
    
    $("#data tr").click(function() {
        var selected = $(this).hasClass("highlight");
        $("#data tr").removeClass("highlight");
        if(!selected)
            $(this).addClass("highlight");
    });
}); 


function PostRequestFromIngredientList() {
    
    if($("tr.highlight").length !== 0){
        method = "post"; // Set method to post by default if not specified.
        path = "editIngredient.php";
        // The rest of this code assumes you are not using a library.
        // It can be made less wordy if you use one.
        var form = document.createElement("form");
        form.setAttribute("method", method);
        form.setAttribute("action", path);

        var ingredientName = document.createElement("input");
        ingredientName.setAttribute("type", "hidden");
        ingredientName.setAttribute("name", "ingredientName");
        ingredientName.setAttribute("value", $("tr.highlight td.ingredientName").text());

        form.appendChild(ingredientName);
        document.body.appendChild(form);
        
        form.submit();
    }
}

function DeleteIngredientFromList() {
    
    if($("tr.highlight").length !== 0){
        method = "post"; // Set method to post by default if not specified.
        path = "deleteIngredient.php";
        // The rest of this code assumes you are not using a library.
        // It can be made less wordy if you use one.
        var form = document.createElement("form");
        form.setAttribute("method", method);
        form.setAttribute("action", path);

        var username = document.createElement("input");
        username.setAttribute("type", "hidden");
        username.setAttribute("name", "ingredientName");
        username.setAttribute("value", $("tr.highlight td.ingredientName").text());

        form.appendChild(username);
        document.body.appendChild(form);
        
        form.submit();
    }
}