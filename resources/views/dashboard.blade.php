<x-app-layout>
    @section('style')
        <style>
            .dataTables_length{
                display: none !important;
            }

        </style>
    @endsection
    <div class="py-24">
        <div class="container mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
                <div id="chart-sales"></div>
                <div class="mt-10">
                    RESUMO DAS VENDA
                    <table id="table-resume-sales" ></table>
                </div>
            </div>
        </div>
    </div>
    @section('script')
    <script src="{{asset('js/dashboard.js')}}"></script>
    <script type="text/javascript">
        Dashboard.init();
    </script>
    @endsection
</x-app-layout>
