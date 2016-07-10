var authenticationManager = function(){
    this.init = function(){
        this.config = {
            user: null,
            csrf: null
        }
        this.run();
    }
    this.run = function(){
        if(this.config.user){
            //handle logged in user setup
        } else {
            //handle unauthenticated setup
        }
    }
}
