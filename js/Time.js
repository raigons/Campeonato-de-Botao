var Time = function(){

    this.getTimes = function(){
        $.post("Construcao/buscaTimes.php",'', function(data){
            var selection = "";
            $.each(data.clube, function(i){
                selection += "<option value='"+data.clube[i].id+"'>"+data.clube[i].nome+"</option>";               
            });
            $("#formNovoCampeonato select").each(function(){                
                $(this).append(selection);
            });
        }, 'json');
    }
}


