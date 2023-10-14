<x-app-layout>
    @section('style')
        <style>
            .dataTables_length{
                display: none !important;
            }
            table
            {
                text-transform: uppercase;
                background-color: #00365d !important;
                overflow-x: visible !important;
                color: lightgray;

            }
            table th,
            table td
            {
                font-size: 1em;
                color: lightgray;
                border: 1px solid #00969A;
                text-align: center;
            }
        </style>
    @endsection
    <div class="py-24">
        <div class="my-6 flex justify-end">
            <div class="relative w-60">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                    </svg>
                </div>
                <input id="date-rangedatepicker-dashboard" type="text"  class="w-60 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
            </div>
        </div>
        <div class="grid gap-7 sm:grid-cols-2 lg:grid-cols-3">
            <x-cards title="Vendas Processadas" />
            <x-cards title="Vendas Pendentes" />
            <x-cards title="Vendas Canceldas" />
        </div>
        <div class="mt-10">
            <x-card title="RESUMO GRÁFICO DE VENDAS">
                <div class="grid gap-3 sm:grid-cols-4 lg:grid-cols-4 px-2 ml-[-60px] mb-6">
                    <div id="chart_segment"></div>
                    <div id="chart_status"></div>
                    <div id="chart_categories"></div>
                    <div id="chart_products"></div>
                </div>
                <div id="chart-day"></div>
            </x-card>
        </div>
        <div class="mt-10">
            <x-card title="TABELA DE RESUMO DE VENDAS">
                <div>
                    <table id="table-resume-sales"></table>
                </div>
            </x-card>
        </div>
    </div>
    @section('script')
        <script src="{{asset('/js/sales.js')}}"></script>
        <script type="text/javascript">
            Sales.init();
        </script>
    @endsection
</x-app-layout>

