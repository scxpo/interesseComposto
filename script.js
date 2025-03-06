document.getElementById("calcoloForm").addEventListener("submit", function(event) {
    event.preventDefault();

    let investimentoIniziale = parseFloat(document.getElementById("investimentoIniziale").value);
    let risparmioMensile = parseFloat(document.getElementById("risparmioMensile").value);
    let tassoAnnuale = parseFloat(document.getElementById("tassoAnnuale").value) / 100;
    let durata = parseInt(document.getElementById("durata").value);

    let investimentoTotale = investimentoIniziale;
    let interesseComposto = 0;

    // Calcolo dell'interesse composto anno per anno
    for (let anno = 1; anno <= durata; anno++) {
        investimentoTotale += risparmioMensile * 12; // aggiungi risparmio annuale
        investimentoTotale *= (1 + tassoAnnuale);  // applica interesse annuo
    }

    interesseComposto = investimentoTotale - (investimentoIniziale + risparmioMensile * 12 * durata);

    // Mostra i risultati
    document.getElementById("totaleInvestito").textContent = `Totale Investito: €${(investimentoIniziale + risparmioMensile * 12 * durata).toFixed(2)}`;
    document.getElementById("interesseComposto").textContent = `Interesse Composto: €${interesseComposto.toFixed(2)}`;
    document.getElementById("totaleFinale").textContent = `Totale Finale: €${investimentoTotale.toFixed(2)}`;
});
