let Dashboard = {
    init(){

        Dashboard.getDataGraphSales();
        Dashboard.getDataTableSales();
    },
    getDataGraphSales(){
        axios({
            method: 'GET',
            url: `${window.location.href}/getDataGraphSales?`,
            params: {'start': '2023-08-01', 'end':'2023-08-31'}
        }).then((response) =>{

            Dashboard.drawGraphSales(response.data)

        }).catch((error) =>{
            console.log('error', error)
        })
    },
    getDataTableSales(){
        axios({
            method: 'GET',
            url: `${window.location.href}/getDataTableSales?`,
            params: {'start': '2023-08-01', 'end':'2023-08-31'}
        }).then((response) =>{

            Dashboard.drawTableSales(response.data)

        }).catch((error) =>{
            console.log('error', error)
        })
    },
    drawGraphSales(data){

        let labelsAux = [];
        let actualSales =  []
        let actualCancel =  []
        let lastSales =  []
        let lastCancel =  []
        for (var i in data) {
            labelsAux.push(data[i].day)
            actualSales .push(data[i].sales)
            lastSales .push(data[i].last_sales)
            actualCancel .push(data[i].cancel_sales)
            lastCancel .push(data[i].last_canceled_sales)
        }
        let options = {
            series: [
                {
                    name: 'Vendas Mes Atual',
                    data: actualSales ,
                },
                {
                    name: 'Cancelamentos do Mes Atual',
                    data: actualCancel ,
                },{
                    name: 'Vendas Mes Anterior',
                    data:  lastSales,
                },{
                    name: 'Cancelamentos do Mes Anterior',
                    data: lastCancel ,
                }
            ],
            chart: {
                height: 450,
                type: 'line',
                dropShadow: {
                    enabled: true,
                    color: '#000',
                    top: 18,
                    left: 7,
                    blur: 10,
                    opacity: 0.2
                },
                toolbar: {
                    show: true
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function(val, opt) {
                    return `R$ ${ val.toFixed(2)}`;
                },
            },
            stroke: {
                curve: 'smooth'
            },
            title: {
                text: 'Comparativo de Vendas, Mês Atual X Mês Anterior',
                align: 'left'
            },
            markers: {
                size: 1
            },
            xaxis: {
                type: 'datetime',
                categories: labelsAux,
                labels: {
                    format: 'dd/MM',
                },


            },
            yaxis: {
                title: {
                    text: 'Faturamento do Mês atual/Ultimo MêS'
                },
                labels: {
                    formatter: function (value) {
                        return `R$ ${ value.toFixed(2)}`;
                    }
                }
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
                floating: true,
                offsetY: -25,
                offsetX: -5
            }
        };
        let chart = new ApexCharts(document.querySelector("#chart-sales"), options);
        chart.render();
    },
    drawTableSales(data){
        const columns = [{
            class: 'dt-control',
            orderable: false,
            data: null,
            defaultContent: `
            `,
        },{
            field: "",
            title: "TIPO"
        }, {
            field: "",
            title: "FORMA DE ENTREGA"
        }, {
            field: "",
            title: "STATUS"
        },{
            field: "",
            title: "QUANTIDADE"
        },{
            field: "",
            title: "VALOR"
        }];
        let table = $('#table-resume-sales').DataTable({
            data: data,
            columns: columns,
            scrollX: false,
            paging: true,
            info: false,
            searching: false,
            destroy:true,
            "displayLength": 10,
            order: [[ 3, "desc" ]],
            columnDefs: [{
                targets: 0,
                data: function(row, type, val, meta) {
                    return '';
                }
            }, {
                targets: 1,
                data: function(row, type, val, meta) {
                    return row.type_payment;
                }
            }, {
                targets: 2,
                class: 'text-center',
                data: function(row, type, val, meta) {
                    return row.delivery_method;
                }
            }, {
                targets: 3,
                class: 'text-center',
                data: function(row, type, val, meta) {
                    return row.status;
                }
            }, {
                targets: 4,
                class: 'text-center',
                data: function(row, type, val, meta) {
                    return row.qty_product;
                }
            },{
                targets: 5,
                class: 'text-center',
                data: function(row, type, val, meta) {
                    let totalPrice = new Intl.NumberFormat({ style: 'currency', currency: 'BRL' }).format(row.total_amount);
                    return 'R$ '+totalPrice
                }
            }],

        })
        function format(d) {
            let row = ''
            for(let i in d.details_order){
                row += `
                    <tr>
                        <td>${d.details_order[i].name}</td>
                        <td class="text-center">${d.details_order[i].category}</td>
                        <td class="text-center">${d.details_order[i].qty_product }</td>
                        <td class="text-center">R$ ${new Intl.NumberFormat({ style: 'currency', currency: 'BRL' }).format(d.details_order[i].price)}</td>
                    </tr>
                `
            }
            let table_child = `
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th>NAME</th>
                        <th class="text-center">CATEGORIA</th>
                        <th class="text-center">QUANTIDADE</th>
                        <th class="text-center">PREÇO</th>
                    </tr>
                </thead>
                <tbody>
                    ${row}
                </tbody>
            </table>
            `
            return table_child;
        }
        const detailRows = [];
        table.on('click', 'tbody td.dt-control', function () {

            let tr = event.target.closest('tr');
            let row = table.row(tr);
            let idx = detailRows.indexOf(tr.id);

            if (row.child.isShown()) {
                tr.classList.remove('details');
                row.child.hide();

                detailRows.splice(idx, 1);
            }
            else {
                tr.classList.add('details');
                row.child(format(row.data())).show();

                if (idx === -1) {
                    detailRows.push(tr.id);
                }
            }
        });
        table.on('draw', () => {
            detailRows.forEach((id, i) => {
                let el = document.querySelector('#' + id + ' td.dt-control');
                if (el) {
                    el.dispatchEvent(new Event('click', { bubbles: true }));
                }
            });
        });
    },

}
