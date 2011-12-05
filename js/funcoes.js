/***funcoes***/
function showResponse(responseText, statusText){
    location.href = "http://localhost/CampeonatoBotao/";
}
function ajaxer(){
    $("body").ajaxStart(function(){
        $("#lightBox").show();
    }).ajaxStop(function(data){
        $("#lightBox").hide();        
    });
}
function validacao(formData, jqForm, options){
    var r = true;
    if(!formData[0].value){
        alert('Digite o nome do Campeonato');
        return false;
    }
    $("#formNovoCampeonato select").each(function(i){
        if(!Number(this.value)){
            alert("Todos os times devem ser selecionados")
            r = false;
            return false;
        }
    });
    return r;
}
function desappearAppear(hide, hide2, show, liH, liH2, liS){
    $(liH).removeClass("selecionada");
    $(liH2).removeClass("selecionada");
    $(liS).addClass("selecionada");
    $(show).show();
    $(hide).hide();
    $(hide2).hide();
}
function desabilitaSelect(arrayT, id){
    $("#formNovoCampeonato select option").each(function(i){
        if($(this).parent().attr('id') !=  id){
            if(arrayT.contains($(this).val())){
                $(this).attr("disabled", "disabled");
            }else if($(this).attr("disabled")){
                $(this).removeAttr("disabled");
            }
        }
    });
}
function doDigits(pStr, reDigits){
    if (reDigits.test(pStr)) {
        return true;
    }else if (pStr != null && pStr != "") {
        return false;
    }
}
function fazEditavel(div){    
    var gol = div.text();
    var goltime2 = div.next().next().text();
    var ident = div.attr('alt');
    ident = ident.split("|");
    var jogo = ident[0];
    var grupo = ident[1];
    if(!Number(gol)){
        var attr = "sended = 'false'";
    }else{
        var attr = "sended = 'true'";
    }
    div.empty();
    div.html("<input type='text' "+attr+" alt = "+div.attr('alt')+" name='"+jogo+"."+grupo+"_t1' value='"+gol+"' maxlength='2'/>");
    div.next().next().html("<input "+attr+" alt = "+div.attr('alt')+" type='text' name='"+jogo+"."+grupo+"_t2' value='"+goltime2+"' maxlength='2'/>");

//var nome = jogo + "."+grupo;
/*$("input[@name='"+nome+"_t1']").livequery("blur", function(){
            alert('ha');
        });*/
//return $("input[@name='"+nome+"_t1'], input[@name='"+nome+"_t2']");
}
function fazEditavelMataMata(div){
    div.empty();
    var gol = div.text();
    var goltime2 = div.next().next().text();
    if(!Number(gol)){
        var attr = "sended = 'false'";
        gol = "";
        goltime2 = "";
    }else{
        var attr = "sended = 'true'";
    }
    var ident = div.attr('alt');
    ident = ident.split("|");
    var jogo = ident[2];
    var fase = ident[1];
    div.html("<input tipo = '"+div.attr("tipo")+"' type='text' "+attr+" alt = '"+div.attr('alt')+"' name='"+jogo+"."+fase+"_t1' value='"+gol+"' maxlength='2'/>");
    div.next().next().html("<input tipo = '"+div.attr("tipo")+"' "+attr+" alt = '"+div.attr('alt')+"' type='text' name='"+jogo+"."+fase+"_t2' value='"+goltime2+"' maxlength='2'/>");
}