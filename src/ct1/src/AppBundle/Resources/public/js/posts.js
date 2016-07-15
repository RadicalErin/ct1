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
            url: 'dunno',
            data: {
                user: authenticationManager.config.user,
                content: $('#post_Content').val()
            },
            type: "GET",
            dataTye: "json"
        })
        .done(function(result){
            //put new post content in place
        })
        .fail(function(xhr, status, err){
            alert("Unable to post the message");
        });
    },
    updatePostWindow: function(newHtml){
    },
    clearForm: function(){
        $('#post_Content').val('');
    }
}

$(document).ready(function(){
    postManager.init();
});
