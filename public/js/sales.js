let Sales = {
    init(){

        var start = moment().startOf('month');
        var end = moment().endOf('month');

        $('#date-rangedatepicker-dashboard').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Dia Atual': [moment(), moment()],
                'Dia Anterior': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Ultimos 7 Dias': [moment().subtract(6, 'days'), moment()],
                'Mês Atual': [moment().startOf('month'), moment().endOf('month')],
                'Mês Anterior': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        },function (start, end,){

            start = moment(start).format('YYYY-MM-DD')
            end = moment(end).format('YYYY-MM-DD')
            Sales.get_data_graphs_pizzas(start, end);
            Sales.get_data_resume_table_sales(start, end);


        });

        Sales.get_data_graphs_pizzas(moment(start).format('YYYY-MM-DD'),moment(end).format('YYYY-MM-DD'));
        Sales.get_data_resume_table_sales(moment(start).format('YYYY-MM-DD'),moment(end).format('YYYY-MM-DD'));

    },
    get_data_graphs_pizzas(start, end){
        axios({
            method: 'GET',
            url: `${window.location.href}/getDataGraphPizza?`,
            params: {start, end}
        }).then((response) =>{

            let data_graphs_pizza = [];
            let data_graph_line = [];

            for (let i in response.data){
                if(i != 'chart_line_or_bar'){
                    data_graphs_pizza[i] = response.data[i]
                }else{
                    data_graph_line[i] = response.data[i]
                }
            }
            Sales.drawning_sales_pizzas_summary_graphs(data_graphs_pizza)
            Sales.drawning_sales_line_or_bar_summary_graphs(data_graph_line['chart_line_or_bar'])

        }).catch((error) =>{
            console.log('error', error)
        })
    },
    get_data_resume_table_sales(start, end){
        axios({
            method: 'GET',
            url: `${window.location.href}/getDataResumeTableSales?`,
            params: {start, end}
        }).then((response) =>{

            Sales.drawning_sales_summary_table(response.data)
            Sales.insert_values_in_indicators_cards(response.data)

        }).catch((error) =>{
            console.log('error', error)
        })
    },
    drawning_sales_summary_table(data){

        let table =  $('#table-resume-sales').DataTable({
            data: data,
            columns:[
                {
                    className: 'dt-control',
                    orderable: false,
                    data: null,
                    defaultContent: ''
                },
                {data: 'client_name', title: 'CLIENTE'},
                {data: 'phone_contact', title: 'CONTATO'},
                {data: 'qty_items', title: 'QT/Items'},
                {data: 'segment', title: 'SEGMENTO'},
                {data: 'type_payment_sale', title: 'F/PAGAMENTO'},
                {data: 'value', title: 'VALOR'},
                {data: 'delivery_method', title: 'F/ENTREGA'},
                {data: 'status', title: 'STATUS'},
                {data: 'date', title: 'DATA'},
            ]
        });

        // Add event listener for opening and closing details
        table.on('click', 'td.dt-control', function (e) {
            let tr = e.target.closest('tr');
            let row = table.row(tr);

            if (row.child.isShown()) {
                row.child.hide();
            }
            else {
                // Open this row
                row.child(format(row.data())).show();
            }
        });
        function format(d) {
            let row = ''
            for(let i in d.products_sale){
                row += `
                    <tr>
                        <td>${d.products_sale[i].name}</td>
                        <td class="text-center">${d.products_sale[i].category}</td>
                        <td class="text-center">${d.products_sale[i].qty_product }</td>
                        <td class="text-center">${d.products_sale[i].price}</td>
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
    },
    insert_values_in_indicators_cards(data){


        let sum_sales_comfirmed = 0;
        let sum_sales_no_processing = 0;
        let sum_sales_canceled = 0;

        for(let i in data){
            if(data[i]['status'] == 'CANCELADA'){
                sum_sales_canceled += parseFloat(data[i].value.replace('R$ ', '').replace(',', '.'));
            }else if(data[i]['status'] != 'CONFIRMADA' && data[i]['status'] != 'CANCELDA'){
                sum_sales_no_processing += parseFloat(data[i].value.replace('R$ ', '').replace(',', '.'));
            }else{
                sum_sales_comfirmed += parseFloat(data[i].value.replace('R$ ', '').replace(',', '.'));
            }

        }
        $('.card-vendas-processadas').html(`R$ ${sum_sales_comfirmed.toFixed(2)}`)
        $('.card-vendas-pendentes').html(`R$ ${sum_sales_no_processing.toFixed(2)}`)
        $('.card-vendas-canceldas').html(`R$ ${sum_sales_canceled.toFixed(2)}`)

    },
    drawning_sales_line_or_bar_summary_graphs(data){

        let categories = [];
        let sales_actual =  []
        let canceled_actual =  []
        let sales_last =  []
        let canceled_last =  []
        for (var i in data) {
            categories.push(data[i].day)
            sales_actual .push(data[i].sale_actual)
            sales_last .push(data[i].sale_last)
            canceled_actual .push(data[i].canceled_actual)
            canceled_last .push(data[i].canceled_last)
        }

        var options = {
            series: [{
                name: 'VENDAS M ATUAL',
                data: sales_actual
            }, {
                name: 'CACELAMENTO M ATUAL',
                data: canceled_actual
            },{
                name: 'VENDAS M ANTERIOR',
                data: sales_last
            },{
                name: 'CANCELAMENTO M ATUAL',
                data: canceled_last
            }],
            title: {
                text: 'Comparativo de Vendas, Mês Atual X Mês Anterior',
                align: 'left',
                style: {
                    fontSize: '14px'
                }
            },
            chart: {
                height: 450,
                type: 'area'
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                type: 'datetime',
                categories: categories,
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
                position: 'bottom',
                horizontalAlign: 'center',
                floating: false,
            }

        };
        var chart = new ApexCharts(document.querySelector("#chart-day"), options);
        chart.render();


    },
    drawning_sales_pizzas_summary_graphs(data){

        let charts = [];
        let options = [];
        let series_chart = [];
        let labels_chart = [];
        for(let d in data){
            labels_chart[d] = [];
            series_chart[d] = [];
            options[d] = [];
            for (let e in data[d]){
                labels_chart[d].push(data[d][e]['name'])
                series_chart[d].push(data[d][e]['total'])
            }

            options[d].push({
                series: series_chart[d],
                labels: labels_chart[d],
                chart: {
                    type: 'pie',
                    width: 320,
                    sparkline: {
                        enabled: true
                    }
                },
                title: {
                    text: Sales.getNameTypeGraph(d),
                    align: 'center',
                    floating: false,
                },
                legend: {
                    show: true,
                    position: 'bottom',
                },
                tooltip: {
                    fixed: {
                        enabled: true
                    },
                }
            })
        }
        for (let i in data){
            charts.push(new ApexCharts(document.querySelector(`#${i}`), options[i][0]))
        }
        for (let c in charts){
            charts[c].render();
        }

    },
    getNameTypeGraph(name){
        switch (name) {
            case 'chart_status':
                return "GRAFICO POR STATUS";
            break;
            case 'chart_segment':
                return "GRAFICO POR SEGMENTO";
            break;
            case 'chart_categories':
                return "GRAFICO POR CATEGORIAS";
            break;
            case 'chart_products':
                return "GRAFICO POR PRODUCTOS";
            break;
        }
    }

}
