<div id='novoCampeonato'>
	<h1>Novo campeonato</h1>
        <form action="processamentoFormularios/geraNovoCampeonato.php" method="post" id='formNovoCampeonato'>
            <label>Nome do Campeonato: </label><input type="text" id="nomeCampeonato" name="nomeCampeonato"/>
            <h2>Grupos do campeonato</h2>
            <h3>Grupo A</h3>
            <label>Time 1</label><select id='grupo1Time1' name="grupo1Time1"><option value=""></option></select>
            <label>Time 2</label><select id='grupo1Time2' name="grupo1Time2"><option value=""></option></select>
            <label>Time 3</label><select id='grupo1Time3' name="grupo1Time3"><option value=""></option></select>
            <label>Time 4</label><select id='grupo1Time4' name="grupo1Time4"><option value=""></option></select>
            <h3>Grupo B</h3>
            <label>Time 1</label><select id='grupo2Time1' name="grupo2Time1"><option value=""></option></select>
            <label>Time 2</label><select id='grupo2Time2' name="grupo2Time2"><option value=""></option></select>
            <label>Time 3</label><select id='grupo2Time3' name="grupo2Time3"><option value=""></option></select>
            <label>Time 4</label><select id='grupo2Time4' name="grupo2Time4"><option value=""></option></select>
            <h3>Grupo C</h3>
            <label>Time 1</label><select id='grupo3Time1' name="grupo3Time1"><option value=""></option></select>
            <label>Time 2</label><select id='grupo3Time2' name="grupo3Time2"><option value=""></option></select>
            <label>Time 3</label><select id='grupo3Time3' name="grupo3Time3"><option value=""></option></select>
            <label>Time 4</label><select id='grupo3Time4' name="grupo3Time4"><option value=""></option></select>
            <h3>Grupo D</h3>
            <label>Time 1</label><select id='grupo4Time1' name="grupo4Time1"><option value=""></option></select>
            <label>Time 2</label><select id='grupo4Time2' name="grupo4Time2"><option value=""></option></select>
            <label>Time 3</label><select id='grupo4Time3' name="grupo4Time3"><option value=""></option></select>
            <label>Time 4</label><select id='grupo4Time4' name="grupo4Time4"><option value=""></option></select>
            <br /><br />
            <input type="submit" id="submit" value="Criar" />
            <button id="sorteioGrupos">Sortear</button>
    </form>
</div> 