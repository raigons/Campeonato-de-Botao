function atualizaTabela(){
    var g1;
    var g2;
    $("#conteudoTabela input").livequery('focus', function(){
        if($(this).attr("sended") == "true"){
            if($(this).attr("name").search("_t1") != -1){
                g1 = $(this).val();
                g2 = $(this).parent().next().next().children().val();
            }else if($(this).attr("name").search("_t2") != -1){
                g2 = $(this).val();
                g1 = $(this).parent().prev().prev().children().val();
            }
        }
    }).livequery('blur', function(){
        var alt = $(this).attr("alt").split("|");
        var jogo = alt[0];
        var grupo = alt[1];
        var idT1 = alt[2];
        var idT2 = alt[3];
        var send = false;
        var url = "";
        var info = "";
        var input1;
        var input2;
        if($(this).attr("name").search("_t1") != -1){
            if($(this).parent().next().next().children().val() != '' && $(this).val() != ''){
                var golT1 = $(this).val();
                var golT2 = $(this).parent().next().next().children().val();
                input1 = $(this);
                input2 = $(this).parent().next().next().children();
                send = true;
            }
        }else if($(this).attr("name").search("_t2") != -1){
            if($(this).parent().prev().prev().children().val() != '' && $(this).val() != ''){
                var golT1 = $(this).parent().prev().prev().children().val();
                var golT2 = $(this).val();
                input1 = $(this).parent().prev().prev().children();
                input2 = $(this);
                send = true;
            }
        }
        if($(this).attr("sended") == 'false'){
            url = "processamentoFormularios/editaJogoGrupo.php";
            info = {
                'jogo': jogo,
                'grupo': grupo,
                'golTime1': golT1,
                'golTime2': golT2,
                'time1': idT1,
                'time2': idT2
            };
            input1.attr("sended", "true");
            input2.attr("sended", "true");
        }else{
            //  alert(idT1 + " "+ g1 +" - "+ g2 + " "+idT2 + "(grupo "+ grupo+" - jogo "+jogo+")");
            // alert(golT1 + " x "+ golT2);
            if(doDigits(g1, /^\d+$/) && doDigits(g2, /^\d+$/)){
                url = "processamentoFormularios/editaJogoGrupoRegistrado.php";
                info = {
                    'jogo': jogo,
                    'grupo': grupo,
                    'golOldT1': g1,
                    'golTime1': golT1,
                    'golOldT2': g2,
                    'golTime2': golT2,
                    'time1': idT1,
                    'time2': idT2
                }
                g1 = golT1;
                g2 = golT2;
            }else{
                return false;
            }
        }
        if(send && (doDigits(golT1, /^\d+$/) && doDigits(golT2, /^\d+$/))){
            $.post(url, info, function(data){
                //$(this).attr("sended", "true");
                /*if(data != " "){
                    alert(data);/^\d+$/
                }*/

                });
        }
    });
}

function atualizaFinais(){
    var gol1;
    var gol2;
    $("#conteudoFinais input").livequery('blur', function(){
        var alt = $(this).attr("alt").split("|");
        var campeonato = alt[0];
        var fase = alt[1];
        var idJogo = alt[2];
        var t1 = alt[3];
        var t2 = alt[4];

        if(this.name.search('t1') != -1){
            gol1 = $(this).val();
            gol2 = $(this).parent().next().next().children().val();
        }else if(this.name.search('t2') != -1){
            gol1 = $(this).parent().prev().prev().children().val();
            gol2 = $(this).val();
        }        
        if(doDigits(gol1, /^\d+$/) && doDigits(gol2, /^\d+$/)){
            var str = "Campeonato: "+ campeonato + "\n fase: "+fase+"\nidJogo: "+idJogo+"\nTime1: "+t1+" "+gol1+" x "+gol2+" Time2: "+t2;            
            var data = {
                'campeonato': campeonato,
                'fase' : fase,
                'jogo' : idJogo,
                'time1': t1,
                'time2': t2,
                'golTime1': gol1,
                'golTime2': gol2,
                'tipo': $(this).attr("tipo")
            }           
            $.post("processamentoFormularios/editaJogoMataMata.php", data, function(response){
                if(response == "true"){                    
                    $("#conteudoFinais").load("geradores/paginaMataMata.php", {
                        "campeonato" : data.campeonato
                    });
                }
            });
            //alert(str);
        }
    });
}