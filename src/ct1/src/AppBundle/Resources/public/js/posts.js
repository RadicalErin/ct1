var postManager = {
    init: function(){
        this.run();
    },
    run: function(){
        $('#post_Post').on("click", function(e){
            postManager.submitNewPost();
        });
    },
    submitNewPost: function(){
        $.ajax({
            url: 'http://ct1.loc/app.php/api/rest/submit',
            data: {
                user: authenticationManager.config.user,
                content: $('#post_Content').val()
            },
            type: "GET",
            dataTye: "json"
        })
        .done(function(result){
            postManager.updatePostWindow(result);
        })
        .fail(function(xhr, status, err){
            alert("Unable to post the message");
        });
    },
    updatePostWindow: function(newHtml){
        $('.left-box').html(newHtml);
        postManager.init();
    },
    clearForm: function(){
        $('#post_Content').val('');
    }
}

$(document).ready(function(){
    postManager.init();
});
