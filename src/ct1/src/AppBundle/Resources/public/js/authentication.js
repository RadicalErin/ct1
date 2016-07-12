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
            e.preventDefault();
            authenticationManager.checkFormReady(
                function(){
                    console.log("ready");
                },
                function(){
                    console.log("not ready");
                }
            );
            return false;
        });
        $('#authentication_Login').on("click", function(e){
            e.preventDefault();
            authenticationManager.checkFormReady(
                function(){
                    console.log("ready");
                },
                function(){
                    console.log("not ready");
                }
            );
            return false;
        });
    },
    authenticatedSetup: function(){
    },
    checkFormReady: function(success, fail){
        if(
            $('#authentication_username').val() &&
            $('#authentication_password').val()
        ){
            success();
        } else {
            fail();
        }
    }
}

$(document).ready(function(){
    authenticationManager.init();
});
