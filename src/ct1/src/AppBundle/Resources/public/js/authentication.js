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
        $('form[name="logout"]').hide();
        $('form[name="authentication"]').show();
        //clear on click events to ensure no duplicate calls
        $('#authentication_Register').unbind("click");
        $('#authentication_Login').unbind("click");
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
        $('#logout_Logout').on("click", function(e){
            e.preventDefault();
            //we dont need to call the backend for this, cause tracking hasn't been set up
            authenticationManager.logoutSuccess();
        });
    },
    authenticatedSetup: function(){
        $('form[name="logout"]').show();
        $('form[name="authentication"]').hide();
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
        alert("New user created. You may now log in.");
        authenticationManager.clearLoginForm();
    },
    registerError: function(soapResponse){
        alert("There was an error creating the new user.");
    },
    loginSuccess: function(soapResponse){
        if(soapResponse.content.documentElement.textContent == "true"){
            authenticationManager.config.user = $('#authentication_username').val();
            authenticationManager.authenticatedSetup();
        } else {
            authenticationManager.loginError(soapResponse);
        }
    },
    loginError: function(soapResponse){
        alert(soapResponse.content.documentElement.textContent);
    },
    logoutSuccess: function(){
        authenticationManager.config.user = null;
        authenticationManager.clearLoginForm();
        authenticationManager.unauthenticatedSetup();
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
    },
    clearLoginForm: function(){
        $('#authentication_username').val('');
        $('#authentication_password').val('');
    }
}

$(document).ready(function(){
    authenticationManager.init();
});
