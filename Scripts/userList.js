$(function(){
    
    $("#data tr").click(function() {
        var selected = $(this).hasClass("highlight");
        $("#data tr").removeClass("highlight");
        if(!selected)
            $(this).addClass("highlight");
    });
}); 


function PostRequestFromUserList() {
    
    if($("tr.highlight").length !== 0){
        method = "post"; // Set method to post by default if not specified.
        path = "editUser.php";
        // The rest of this code assumes you are not using a library.
        // It can be made less wordy if you use one.
        var form = document.createElement("form");
        form.setAttribute("method", method);
        form.setAttribute("action", path);

        var username = document.createElement("input");
        username.setAttribute("type", "hidden");
        username.setAttribute("name", "username");
        username.setAttribute("value", $("tr.highlight td.username").text());

        form.appendChild(username);
        document.body.appendChild(form);
        
        form.submit();
    }
}

function DeleteUserFromList() {
    
    if($("tr.highlight").length !== 0){
        method = "post"; // Set method to post by default if not specified.
        path = "deleteUser.php";
        // The rest of this code assumes you are not using a library.
        // It can be made less wordy if you use one.
        var form = document.createElement("form");
        form.setAttribute("method", method);
        form.setAttribute("action", path);

        var username = document.createElement("input");
        username.setAttribute("type", "hidden");
        username.setAttribute("name", "username");
        username.setAttribute("value", $("tr.highlight td.username").text());

        form.appendChild(username);
        document.body.appendChild(form);
        
        form.submit();
    }
}