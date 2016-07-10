var authenticationManager = {
    init: function(){
        this.config = {
            user: null,
            csrf: null
        }
        this.run();
    },
    run: function(){
        if(this.config.user){
            this.authenticatedSetup();
        } else {
            this.unauthenticatedSetup();
        }
    },
    unauthenticatedSetup: function(){
        $('#authentication_Register').on("click", function(e){
            console.log("register");
        });
        $('#authentication_Login').on("click", function(e){
            console.log("login");
        });
    },
    authenticatedSetup: function(){
    }
}

$(document).ready(function(){
    authenticationManager.init();
});
