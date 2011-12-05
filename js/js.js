$(document).ready(function(){
    var time = new Time();
    time.getTimes();
    
    $("#formNovoCampeonato select").change(function(){
        var id = this.id;
        var arrayT = new ArrayTimes();
        $("#formNovoCampeonato select").each(function(i){
            if(Number(this.value)){
                arrayT.add(this.value);
            }
        });
        desabilitaSelect(arrayT, id);
    });

    $("#sorteioGrupos").bind('click', function(){
        var arrayA = new ArrayTimes();
        $("#grupo1Time1 option").each(function(){
            if(Number(this.value))
                arrayA.add(this.value);
        });
        var arrayA2 = new ArrayTimes();
        var i = 0;

        var sorteio = new Sorteio();
        for(var a = 0; a < arrayA.size(); a++)
            arrayA2 = sorteio.getSorteio(arrayA);
        
        $("#formNovoCampeonato select").each(function(i){
            $(this).val(arrayA2.get(i));
        });
        desabilitaSelect(arrayA, "");
        return false;
    });
    
    var options = {
        success: showResponse,
        beforeSubmit: validacao
    };    
    if(location.href.search("novoCampeonato") != -1){
        ajaxer();
    }    
    $("#formNovoCampeonato").ajaxForm(options);
    
    $("#listaMenu ul li").click(function(){
        if(this.id == 'classificacao'){
            desappearAppear("#conteudoTabela", "#conteudoFinais", "#conteudoClassificacao", "#tabela", "#finais","#classificacao");
            $("#conteudoClassificacao").empty().load("geradores/geraClassificacao.php", {
                'campeonato': $(this).attr('campeonato')
            });
        }else if(this.id == 'tabela'){
            desappearAppear("#conteudoClassificacao", "#conteudoFinais", "#conteudoTabela", "#classificacao", "#finais", "#tabela" );
        }else if(this.id == 'finais'){
            desappearAppear("#conteudoTabela", "#conteudoClassificacao", "#conteudoFinais", "#classificacao", "#tabela", "#finais");
            $("#conteudoFinais").load("geradores/paginaMataMata.php", {
                "campeonato" : $(this).attr("campeonato")
            });
        }
    });
   
    var nome = "";
    $("#conteudoTabela table.tabelaclassificacao tbody td.golTime1").livequery('click', function(){
        if($(this).attr("status") != 1){
            fazEditavel($(this));
            $(this).unbind('click');
            $(this).next().next().unbind('click');
            $(this).focus().select();
        }
    });
    $("#lightBox").css('height', $(document).height()).hide();   
    atualizaTabela();
});