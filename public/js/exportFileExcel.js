let buttonExport = document.querySelector('.export')
buttonExport.addEventListener('click', exportPDF)

function exportPDF() {
    axios({
        method:'GET',
        url: window.location.href + '/exportPDF'
    }).then((response) =>{
        console.log('response', response)
    }).catch((error) =>{
        console.log('error', error.response)
    })
}
