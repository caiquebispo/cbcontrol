var SystemUsability =  (function(){
    'use strict';
    return{
        init: function(){

            var start = moment().startOf('month');
            var end = moment().endOf('month');
    
            $('#date-range-picker-system-usability').daterangepicker({
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

                SystemUsability.getDataTable(start, end)
                SystemUsability.getDataGraphs(start, end)
            });
            SystemUsability.getDataTable(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'))
            SystemUsability.getDataGraphs(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'))
        },
        getDataTable: function(start, end){
            axios({
                method: 'GET',
                url: `${window.location.href}/getDataTable?`,
                params: {start, end}
            }).then((response) =>{
                SystemUsability.drawTableHistoryAccessUser(response.data)
            }).catch((error) =>{
                console.log('error', error)
            })
        },
        drawTableHistoryAccessUser: function(data){
            const columns = [{
                field: "",
                title: "Usuário"
            }, {
                field: "",
                class: 'text-center',
                title: "Empresa Autenticada"
            }, {
                field: "",
                class: 'text-center',
                title: "Login"
            },{
                field: "",
                class: 'text-center',
                title: "Logout"
            }];
            $('#table-resume-history-access-users').DataTable({
                data: data,
                columns: columns,
                scrollX: false,
                paging: true,
                info: false,
                searching: false,
                destroy:true,
                "displayLength": 10,
                order: [[ 2, "desc" ]],
                columnDefs: [{
                    targets: 0,
                    class: 'text-left',
                    data: function(row) {
                        return row.user_name;
                    }
                },{
                    targets: 1,
                    class: 'text-left',
                    data: function(row) {
                        return row.company_authenticated;
                    }
                },{
                    targets: 2,
                    class: 'text-left',
                    data: function(row) {
                        return row.login;
                    }
                },{
                    targets: 3,
                    class: 'text-left',
                    data: function(row) {
                        return row.logout;
                    }
                }],
    
            })
        },
        getDataGraphs: function(start, end){
            axios({
                method: 'GET',
                url: `${window.location.href}/getDataGraphs?`,
                params: {start, end}
            }).then((response) =>{
                SystemUsability.drawnGraphHistoryAccess(response.data)
            }).catch((error) =>{
                console.log('error', error)
            })
        },
        drawnGraphHistoryAccess(data){

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
                        width: 420,
                        sparkline: {
                            enabled: true
                        }
                    },
                    title: {
                        text: SystemUsability.getNameTypeGraph(d),
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
                console.log('i',i)
                charts.push(new ApexCharts(document.querySelector(`#${i}`), options[i][0]))
            }
            for (let c in charts){
                charts[c].render();
            }
    
        },
        getNameTypeGraph(name){
            switch (name) {
                case 'graph_navigation':
                    return "GRAFICO DE NAVEGAÇÃO";
                break;
                case 'graph_location_city':
                    return "GRAFICO DE ACESSOS POR CIDADES";
                break;
                case 'graph_location_state':
                    return "GRAFICO DE ACESSOS POR ESTADO";
                break;
            }
        }
    }
})(SystemUsability)