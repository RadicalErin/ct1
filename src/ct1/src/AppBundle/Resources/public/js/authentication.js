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
                    $.soap({
                        url: 'http://ct1.loc/app.php/api/soap/check?wsdl',
                        method: 'newUser',
                        SOAPAction: 'http://ct1.loc/app.php/api/soap/check#newUser',
                        namespaceQualifier: 'tns',
                        namespaceURL: 'http://ct1.loc/app.php/api/soap/check',
                        appendMethodToURL: false,
                        data: {
                            submittedName: $('#authentication_username').val(),
                            submittedPassword: $('#authentication_password').val()
                        },
                        success: authenticationManager.registerSuccess,
                        error: authenticationManager.registerError
                    });
                },
                function(){
                    alert("Fill out the form before submitting");
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
    },
    registerSuccess: function(soapResponse){
        console.log("success");
    },
    registerError: function(soapResponse){
        console.log("error");
    },
    loginSuccess: function(soapResponse){
        console.log("success");
    },
    loginError: function(soapResponse){
        console.log("error");
    }
}

$(document).ready(function(){
    authenticationManager.init();
});
