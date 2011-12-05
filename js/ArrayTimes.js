var ArrayTimes = function(){
    var cont = 0;
    var array = [];

    this.add = function(tim){
        array[cont++] = tim;
    }

    this.get = function(i){
        return array[i];
    }

    this.size = function(){
        return cont;
    }

    this.contains = function(elemento){
        for(a = 0; a < cont; a++){
            if(array[a] == elemento)
                return true;
        }
        return false;
    }
}

