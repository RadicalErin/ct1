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
                    data = {
                        submittedName: $('#authentication_username').val(),
                        submittedPassword: $('#authentication_password').val()
                    };
                    authenticationManager.soapCall(
                        'newUser',
                        data,
                        authenticationManager.registerSuccess,
                        authenticationManager.registerError
                    );
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
                    data = {
                        submittedName: $('#authentication_username').val(),
                        submittedPassword: $('#authentication_password').val()
                    };
                    authenticationManager.soapCall(
                        'logIn',
                        data,
                        authenticationManager.loginSuccess,
                        authenticationManager.loginError
                    );
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
    },
    soapCall: function(method, data, successCallback, errorCallback){
        $.soap({
            url: 'http://ct1.loc/app.php/api/soap/check',
            method: method,
            SOAPAction: 'http://ct1.loc/app.php/api/soap/check#'+method,
            namespaceQualifier: 'tns',
            namespaceURL: 'http://ct1.loc/app.php/api/soap/check',
            appendMethodToURL: false,
            data: data,
            success: successCallback,
            error: errorCallback
        });
    }
}

$(document).ready(function(){
    authenticationManager.init();
});
