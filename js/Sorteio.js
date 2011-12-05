var Sorteio = function(){

    this.getSorteio = function(arrayA){
        var arrayA2 = new ArrayTimes();
        var i = 0;
        while(i < arrayA.size() && (arrayA2.size() < arrayA.size())){
            var e = true;
            while(e){
                var n = Math.round(   (Math.random()* (0 - arrayA.size())) + arrayA.size() );
                if(n == 0)
                    n += 1;
                if(!arrayA2.contains(n)){
                    e = false;
                    arrayA2.add(n);
                }
            }
            i++;
        }
        return arrayA2;
    }
}


