<template>
    <div class="w-full h-full">
        <div class="flex flex-row items-center justify-between w-full">
            <div class="text-xl font-bold text-blue-800 flex items-center justify-center">Manufacturers List</div>
        </div>
        <div class="flex flex-col w-full">
            <v-server-table :columns="columns" :options="options" />
        </div>
    </div>
</template>

<script>
import { getManufacturersList } from '../services';
export default {
    data() {
        return {
            columns: ['id', 'name', 'deleted_at', 'created_at', 'updated_at'],
            options: {
                headings: {'id': '#', 'name': 'Manufacturer Name', deleted_at: 'Status', created_at: 'Created At', updated_at: 'Updated At'},
                sortable: ['name', 'created_at', 'updated_at'],
                filterable: ['name'],
                requestFunction: async () => {
                    return await getManufacturersList(1)
                                .then(res => console.log(res, '__res'))
                                .catch(e => this.dispatch('error', e));
                }, responseAdapted: (res) => {
                    return {
                        data: res.data.data.items,
                        count: res.data.data.items.length
                    }
                }
            },
            seachData: null,
            isLoading: true
        }
    }
}
</script>