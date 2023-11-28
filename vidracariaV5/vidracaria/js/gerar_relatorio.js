document.addEventListener("DOMContentLoaded", function () {
    const concluirButton = document.querySelector("gerar-button");

    concluirButton.addEventListener("click", function (event) {
        event.preventDefault();
        const dataInicio = document.getElementById("data-inicio").value;
        const dataFim = document.getElementById("data-fim").value;
        const tipoRelatorio = document.getElementById("tipo-relatorio").value;
        const url = `gerar_relatorio.php?dataInicio=${dataInicio}&dataFim=${dataFim}&tipoRelatorio=${tipoRelatorio}`;
        fetch(url)
            .then(response => response.json())
            .then(data => {
                const pdf = new jsPDF();
                pdf.text(`Relatório de ${tipoRelatorio}`, 10, 10);
                data.forEach((item, index) => {
                    const keys = Object.keys(item);
                    const values = Object.values(item);

                    for (let i = 0; i < keys.length; i++) {
                        pdf.text(`${keys[i]}: ${values[i]}`, 10, 20 + index * 10);
                    }
                });
                pdf.save(`relatorio_${tipoRelatorio}.pdf`);
            })
            .catch(error => {
                console.error("Erro ao gerar relatório:", error);
            });
    });

    const backButton = document.getElementById("back-button");

    backButton.addEventListener("click", function () {
        window.location.href = '../home/menu.html';
    });
});
