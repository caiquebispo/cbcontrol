let buttonExport = document.querySelector('.export')
buttonExport.addEventListener('click', exportExcel)

function exportExcel() {
    
    let table = document.getElementsByTagName("table");
    TableToExcel.convert(table[0], {
        name: `Lista de Clientes.xlsx`,
        sheet: {
            name: 'Sheet 1'
        }
    });
}