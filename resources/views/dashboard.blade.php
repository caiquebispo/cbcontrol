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
    <div class="mt-40">
        <x-card title="RESUMO DE VENDAS">
            <div id="chart-sales"></div>
            <div class="mt-10">
                <table id="table-resume-sales" ></table>
            </div>
        </x-card>
    </div>
    <div class="mt-10">
        <x-card title="RESUMO DE VENDAS POR CATEGORIAS">
           <div>
               <div class="flex flex-col items-center">
                    <div id="chart-sales-for-categories"></div>
               </div>
               <div class="mt-10">
                   <table id="table-resume-sales-for-categories" ></table>
               </div>
           </div>
        </x-card>
    </div>
    @section('script')
    <script src="{{asset('js/dashboard.js')}}"></script>
    <script type="text/javascript">
        Dashboard.init();
    </script>
    @endsection
</x-app-layout>
