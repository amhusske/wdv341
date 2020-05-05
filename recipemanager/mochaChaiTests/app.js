module.exports = {
    recipeName: function(inName){

        inName += "";	//turns all inValues into strings
        if(inName.trim() == "" || inName == 'null' || inName == 'undefined'){
            return false;
        }
        return true;
       
    },

    servings: function(inNum){
        if(isNaN(inNum)){
            return "not a number";
        }
        else if(inNum == ""){
            return "enter a serving";
        }
        else{
            return "thanks";
        }
    },

    validateDescription: function(inDesc){
        if(inDesc.length >= 40){
            return "too long";
        }
        else if(inDesc == ""){
            return "enter description";
        }
    },

    amount: function(inAmount){
          if(inAmount == ""){
              return false;
          }
           else if(isNaN(inAmount)){
                return false;
            }
    }

    
    
}


