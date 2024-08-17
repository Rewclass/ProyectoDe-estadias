function loadAnalisis(idCategoria) {
    const tableIdMapping = {
        1: 'quimica-clinica-table',
        2: 'hematologica-table',
        3: 'uroanalisis-table',
        4: 'serologia-table',
        5: 'bactereologia-table',
        6: 'parasitologia-table',
        // Puedes agregar más categorías aquí
    };

    const tableId = tableIdMapping[idCategoria];
    const table = document.getElementById(tableId);

    if (table.innerHTML.trim() === "") {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "fetch_data.php?id_categoria=" + idCategoria, true);
        xhr.onload = function () {
            if (this.status === 200) {
                table.innerHTML = this.responseText;
            } else {
                console.error("Error al cargar los datos del análisis.");
            }
        };
        xhr.send();
    }
}
