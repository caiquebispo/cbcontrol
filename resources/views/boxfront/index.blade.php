<style scoped>
    * {
        margin-left: 0;
    }

    aside {
        display: none !important;
    }

    #content-page {
        margin-left: 0 !important;
    }
</style>
<x-app-layout>
    <div class="py-24">
        <div class="grid md:grid-cols-3 gap-4 min-h-full">
            <div class="bg-white shadow-lg shadow-slate-200 border-slate-100 dark:bg-gray-800  rounded">
                <livewire:box-front.cart-items />
            </div>
            <div class="bg-white col-span-2 h-full shadow-lg shadow-slate-200 border-slate-100 dark:bg-gray-800  rounded">
                <livewire:box-front.all-products />
            </div>
        </div>
    </div>

</x-app-layout>