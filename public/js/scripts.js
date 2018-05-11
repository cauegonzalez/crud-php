function visualizar(id) {
    window.location = 'index.php?pagina=perfil&id='+id;
}

function cadastrar() {
    window.location = 'index.php?pagina=form';
}

function editar(id) {
    window.location = 'index.php?pagina=form&id='+id;
}

function excluir(id) {
    var confirmacao = confirm("Você tem certeza que deseja excluir o registro "+id+"?");
    if (confirmacao == true)
    {
        window.location = 'index.php?pagina=delete&id='+id;
    }
}


$(document).ready(function() {

    $('input:text').setMask();

    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#rua").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#uf").val("");
        $("#ibge").val("");
    }

    //Quando o campo cep perde o foco.
    $("#cep").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#rua").val("...");
                $("#bairro").val("...");
                $("#cidade").val("...");
                $("#uf").val("...");

                //Consulta o webservice viacep.com.br/
                $.ajax({
                    // The URL for the request
                    url: "https://viacep.com.br/ws/"+ cep +"/json/",
                    // data: {'cep': cep },
                    // Whether this is a POST or GET request
                    type: "GET",
                    // The type of data we expect back
                    dataType : "json",
                })
                // Code to run if the request succeeds (is done);
                // The response is passed to the function
                .done(function( json ) {
                    if (!("erro" in json))
                    {
                        //Atualiza os campos com os valores da consulta.
                        $("#rua").val(json.logradouro);
                        $("#bairro").val(json.bairro);
                        $("#cidade").val(json.localidade);
                        $("#uf").val(json.uf);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                })
                // Code to run if the request fails; the raw request and
                // status codes are passed to the function
                .fail(function( xhr, status, errorThrown ) {
                    alert( "Desculpe, houve algum problema com a busca dos dados do CEP, tente novamente!" );
                })
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });
});