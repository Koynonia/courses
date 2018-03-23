var rodada = 1;
var matriz_jogo = Array(3);

matriz_jogo['A'] = Array(3);
matriz_jogo['B'] = Array(3);
matriz_jogo['C'] = Array(3);

matriz_jogo['A'][1] = 0;
matriz_jogo['A'][2] = 0;
matriz_jogo['A'][3] = 0;

matriz_jogo['B'][1] = 0;
matriz_jogo['B'][2] = 0;
matriz_jogo['B'][3] = 0;

matriz_jogo['C'][1] = 0;
matriz_jogo['C'][2] = 0;
matriz_jogo['C'][3] = 0;

$(document).ready(function () {

    $('#btn_iniciar_jogo').click(function () {

        // valida a digitação dos apelidos dos jogadores
        if ($('#entrada_jogador_1').val() == '' || $('#entrada_jogador_2').val() == '') {
            alert('Apelido(s) do(s) Jogador(es) não preenchidos!');
            return false;
        }

        // Exibe os apelidos nas imagens do grid
        $('#nome_jogador_1').html($('#entrada_jogador_1').val());
        $('#nome_jogador_2').html($('#entrada_jogador_2').val());

        // Controla visualização das DIVs
        $('#pagina_inicial').hide();
        $('#palco_jogo').show();
    });

    $('.jogada').click(function () {

        var id_campo_clicado = this.id;
        $('#'+id_campo_clicado).off(); //desliga os eventos associafos(clique)
        jogada(id_campo_clicado);
    });

    function jogada(id) {

        var icone = '';
        var ponto = 0;

        if ((rodada % 2) == 1) {
            icone = 'url("imagens/marcacao_1.png")';
            ponto = -1;
        } else {
            icone = 'url("imagens/marcacao_2.png")';
            ponto = 1;
        }
        rodada++;
        $('#' + id).css('background-image', icone);

        var linha_coluna = id.split('-');

        matriz_jogo[linha_coluna[0]][linha_coluna[1]] = ponto;
        console.log(matriz_jogo)

        verifica_combinacao();
    }

    function verifica_combinacao() {

        // Verifica na horizontal
        var pontos = 0;
        for (var h = 1; h <= matriz_jogo.length; h++) {
            pontos = pontos + matriz_jogo['A'][h];
        }
        ganhador(pontos);

        pontos = 0;
        for (var h = 1; h <= matriz_jogo.length; h++) {
            pontos = pontos + matriz_jogo['B'][h];
        }
        ganhador(pontos);

        pontos = 0;
        for (var h = 1; h <= matriz_jogo.length; h++) {
            pontos = pontos + matriz_jogo['C'][h];
        }
        ganhador(pontos);

        // Verifica na vertical
        for (var v = 1; v <= matriz_jogo.length; v++) {
            pontos = 0;
            pontos += matriz_jogo['A'][v];
            pontos += matriz_jogo['B'][v];
            pontos += matriz_jogo['C'][v];
            ganhador(pontos);
        }

        // Verifica na diagonal 1
        pontos = 0;
        pontos = matriz_jogo['A'][1]
            + matriz_jogo['B'][2]
            + matriz_jogo['C'][3];
        ganhador(pontos);

        // Verifica na diagonal 2
        pontos = 0;
        pontos = matriz_jogo['A'][3]
            + matriz_jogo['B'][2]
            + matriz_jogo['C'][1];
        ganhador(pontos);
    }

    function ganhador(pontos) {

        if (pontos == -3) {
            var jogada_1 = $('#entrada_jogador_1').val();
            alert(jogada_1 + ' é o vencedor!')
            $('.jogada').off();
        } else if (pontos == 3) {
            var jogada_2 = $('#entrada_jogador_2').val();
            alert(jogada_2 + ' é o vencedor!')
            $('.jogada').off();
        }
    }
});