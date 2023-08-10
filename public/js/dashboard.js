let Dashboard = {
    init(){

        Dashboard.getDataGraphSales();
        Dashboard.getDataTableSales();
        Dashboard.getDataGraphSalesForCategories();
        Dashboard.getDataTableSalesForCategories();
    },
    getDataGraphSales(){
        axios({
            method: 'GET',
            url: `${window.location.href}/getDataGraphSales?`,
            params: {'start': '2023-08-01', 'end':'2023-08-31'}
        }).then((response) =>{

            Dashboard.drawGraphSales(response.data)
            Dashboard.drawGraphSalesForCategories(response.data)

        }).catch((error) =>{
            console.log('error', error)
        })
    },
    getDataGraphSalesForCategories(){
        axios({
            method: 'GET',
            url: `${window.location.href}/getDataGraphSalesForCategories?`,
            params: {'start': '2023-08-01', 'end':'2023-08-31'}
        }).then((response) =>{

            Dashboard.drawGraphSalesForCategories(response.data)

        }).catch((error) =>{
            console.log('error', error)
        })
    },
    getDataTableSalesForCategories(){
        axios({
            method: 'GET',
            url: `${window.location.href}/getDataTableSalesForCategories?`,
            params: {'start': '2023-08-01', 'end':'2023-08-31'}
        }).then((response) =>{

            Dashboard.drawTableSalesForCategories(response.data)

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
                    type:'column'
                },
                {
                    name: 'Cancelamentos do Mes Atual',
                    data: actualCancel ,
                    type:'line'

                },{
                    name: 'Vendas Mes Anterior',
                    data:  lastSales,
                    type:'column'
                },{
                    name: 'Cancelamentos do Mes Anterior',
                    data: lastCancel ,
                    type:'line'
                }
            ],
            chart: {
                height: 450,
                type: 'line',

            },
            dataLabels: {
                enabled: false,
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
    drawGraphSalesForCategories(data){

        const label_categories = [];
        const total =  []
        for (var i in data) {
            label_categories.push(data[i].name)
            total .push(data[i].total)
        }
        var options = {
            series: total,
            chart: {
                width: 580,
                type: 'pie',
            },
            labels: label_categories,
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        let chart_sales_for_categories = new ApexCharts(document.querySelector("#chart-sales-for-categories"), options);
        chart_sales_for_categories.render();

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
            title: "QUANTIDADE",

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
                class: 'text-center',
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
    drawTableSalesForCategories(data){
        const columns = [{
            class: 'dt-control',
            orderable: false,
            data: null,
            defaultContent: '',
        },{
            field: "",
            title: "CATEGORIA"
        }, {
            field: "",
            title: "QUANTIDADE"
        }, {
            field: "",
            title: "PARTICIPAÇÃO"
        }];
        let table = $('#table-resume-sales-for-categories').DataTable({
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
                class: 'text-center',
                data: function(row, type, val, meta) {
                    return row.name;
                }
            }, {
                targets: 2,
                class: 'text-center',
                data: function(row, type, val, meta) {
                    return row.total;
                }
            }, {
                targets: 3,
                class: 'text-center',
                data: function(row, type, val, meta) {
                    return 'R$ '+ new Intl.NumberFormat({ style: 'currency', currency: 'BRL' }).format(row.total_amount);
                }
            }],

        })
        function format(d) {
            let row = ''
            for(let i in d.category_details){
                row += `
                    <tr>
                        <td>${d.category_details[i].name}</td>
                        <td class="text-center">${d.category_details[i].category}</td>
                        <td class="text-center">${d.category_details[i].qty_product }</td>
                        <td class="text-center">R$ ${new Intl.NumberFormat({ style: 'currency', currency: 'BRL' }).format(d.category_details[i].price)}</td>
                    </tr>
                `
            }
            let table_child = `
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="text-gray-700">NAME</th>
                        <th class="text-center text-gray-700">CATEGORIA</th>
                        <th class="text-center text-gray-700">QUANTIDADE</th>
                        <th class="text-center text-gray-700">PREÇO</th>
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
