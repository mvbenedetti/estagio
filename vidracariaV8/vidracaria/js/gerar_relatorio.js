document.addEventListener('DOMContentLoaded', function() {
    
});

function abrirRelatorio(tipoRelatorio) {
    let url;
    let divID;

    if (tipoRelatorio === 'produtos') {
        url = `../php/relatorio_produtos.php`;
        divID = 'tabela-relatorio-produtos';
    } else {
        const dataInicio = document.getElementById('data-inicio').value;
        const dataFim = document.getElementById('data-fim').value;

        if (!dataInicio || !dataFim) {
            alert('Selecione as datas de início e fim.');
            return;
        }

        url = `../php/relatorio_${tipoRelatorio}.php?inicio=${dataInicio}&fim=${dataFim}`;

        if (tipoRelatorio === 'fornecedores') {
            divID = 'tabela-relatorio';
        } else if (tipoRelatorio === 'orcamentos') {
            divID = 'tabela-relatorio-orcamento';
        } else if (tipoRelatorio === 'ordem_compra') {
            divID = 'tabela-relatorio-ordem-compra';
        }
    }

    fetch(url)
        .then(response => response.text())
        .then(data => {
            document.getElementById(divID).innerHTML = data;
        })
        .catch(error => {
            console.error('Erro ao buscar dados: ', error);
        });
}



function gerarPDFOrcamento() {
    const conteudoRelatorio = document.getElementById('tabela-relatorio-orcamento');
    if (conteudoRelatorio) {
        html2canvas(conteudoRelatorio).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            const pdf = new jspdf.jsPDF({
                orientation: 'p',
                unit: 'mm',
                format: 'a4'
            });

            pdf.addImage(imgData, 'PNG', 10, 10);
            pdf.save('relatorio_orcamento.pdf');
        });
    } else {
        alert('Conteúdo do relatório não encontrado!');
    }
}

//pdf fornecedor aqui
function gerarPDF() {
    const conteudoRelatorio = document.getElementById('tabela-relatorio');
    if (conteudoRelatorio) {
        html2canvas(conteudoRelatorio).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            const pdf = new jspdf.jsPDF({ 
                orientation: 'p',
                unit: 'mm',
                format: 'a4'
            });

            pdf.addImage(imgData, 'PNG', 10, 10);
            pdf.save('relatorio.pdf');
        });
    } else {
        alert('Conteúdo do relatório não encontrado!');
    }
}


function gerarPDFOrdemCompra() {
    const conteudoRelatorio = document.getElementById('tabela-relatorio-ordem-compra');
    if (conteudoRelatorio) {
        html2canvas(conteudoRelatorio).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            const pdf = new jspdf.jsPDF({
                orientation: 'p',
                unit: 'mm',
                format: 'a4'
            });

            pdf.addImage(imgData, 'PNG', 10, 10);
            pdf.save('relatorio_ordem_compra.pdf');
        });
    } else {
        alert('Conteúdo do relatório não encontrado!');
    }
}
function gerarPDFProdutos() {
    const conteudoRelatorio = document.getElementById('tabela-relatorio-produtos');
    if (conteudoRelatorio) {
        html2canvas(conteudoRelatorio).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            const pdf = new jspdf.jsPDF({ // Certifique-se de usar a sintaxe correta
                orientation: 'p',
                unit: 'mm',
                format: 'a4'
            });

            pdf.addImage(imgData, 'PNG', 10, 10);
            pdf.save('relatorio_produtos.pdf');
        });
    } else {
        alert('Conteúdo do relatório não encontrado!');
    }
}

const backButton = document.getElementById("back-button");

backButton.addEventListener("click", function () {
    window.location.href = '../home/menu.html';
});