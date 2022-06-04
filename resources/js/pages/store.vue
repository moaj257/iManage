<template>
    <div class="w-full h-full">
        <div class="flex flex-row items-center justify-between w-full">
            <div class="text-xl font-bold text-blue-800 flex items-center justify-center">Inventory List</div>
            <!-- <div class="flex flex-row items-center justify-center">
                <div class="border border-gray-500 mr-1 rounded-md px-2 py-1.5 flex flex-row items-center justify-center">
                    <i data-eva="search-outline" data-eva-fill="#000" data-eva-height="20" data-eva-width="20" class="mr-1"></i>
                    <input v-model="seachData" @change="getTableData()" type="text" placeholder="Search.." class="hover:outline-none focus:outline-none">
                </div>
                <div class="bg-red-500 p-2 rounded-md border border-red-600 flex justify-center items-center mr-1">
                    <i data-eva="trash-2-outline" data-eva-fill="#fff" data-eva-height="20" data-eva-width="20"></i>
                </div>
                <div class="bg-gray-100 p-2 rounded-md border border-gray-300 flex justify-center items-center">
                    <i data-eva="plus-outline" data-eva-fill="#000" data-eva-height="20" data-eva-width="20"></i>
                </div>
            </div> -->
        </div>
        <div class="flex flex-row items-center justify-between w-full my-3">
            <div class="w-3/12">
                <label for="countries" class="block mb-2 text-sm font-medium text-gray-600">Manufacturer</label>
                <select id="countries" class="bg-gray-50 border-2 border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-blue-800 focus:border-blue-800 block w-full p-2 w-full">
                    <option selected>Choose a manufacturer</option>
                    <option value="0">Add New manufacturer</option>
                    <option value="US">United States</option>
                    <option value="CA">Canada</option>
                    <option value="FR">France</option>
                    <option value="DE">Germany</option>
                </select>
            </div>
            <!-- <div class="text-xl font-bold text-blue-800 flex items-center justify-center tw-w"></div> -->
        </div>
        <div class="flex flex-col w-full">
            <table class="table-fixed my-6">
                <thead>
                    <tr class="w-full border-gray-500 border-b-2">
                        <th class="px-2 py-1 text-left w-1/12">#</th>
                        <th class="px-2 py-1 text-left w-2/12">Product Name</th>
                        <th class="px-2 py-1 text-left w-2/12">Manufacturer</th>
                        <th class="px-2 py-1 text-left w-2/12">Category</th>
                        <th class="px-2 py-1 text-left w-3/12">Sub Category</th>
                        <th class="px-2 py-1 text-left w-1/12">Quantity</th>
                        <th class="px-2 py-1 text-left w-1/12">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr :class="`w-full ${ke !== tableData.length - 1 ? 'border-gray-400 border-b' : ''}`" v-for="(tableInfo, ke) in tableData" :key="tableInfo.id">
                        <td class="px-2 py-1 w-1/12">{{tableInfo.id}}.</td>
                        <td class="px-2 py-1 w-2/12">{{tableInfo.name}}</td>
                        <td class="px-2 py-1 w-2/12">{{tableInfo.manufacturer}}</td>
                        <td class="px-2 py-1 w-2/12">{{tableInfo.type}}</td>
                        <td class="px-2 py-1 w-3/12">
                            <span :class="`px-2 py-0.5 bg-blue-600 text-white rounded-[40px] text-sm ${k !=0 ? 'ml-1' : ''}`" v-for="(itemtype, k) in tableInfo.subtype" :key="k">{{itemtype}}</span>
                        </td>
                        <td class="px-2 py-1 w-1/12">{{tableInfo.quantity}}</td>
                        <td class="px-2 py-1 w-1/12">
                            <div class="flex items-center justify-center w-full">
                                <button class="bg-blue-800 rounded-md px-1 py-1 text-white flex flex-row border border-blue-900 hover:bg-blue-900 items-center justify-center w-full">
                                    <i data-eva="eye-outline" data-eva-fill="#fff" data-eva-height="20" data-eva-width="20"></i>
                                </button>
                                <button class="bg-gray-100 rounded-md px-1 py-1 text-white flex flex-row border border-gray-300 hover:bg-gray-300 items-center justify-center w-full mx-1">
                                    <i data-eva="edit-outline" data-eva-fill="#000" data-eva-height="20" data-eva-width="20"></i>
                                </button>
                                <button class="bg-red-500 rounded-md px-1 py-1 text-white flex flex-row border border-red-600 hover:bg-red-600 items-center justify-center w-full">
                                    <i data-eva="trash-2-outline" data-eva-fill="#fff" data-eva-height="20" data-eva-width="20"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import { tableData as overallTableData } from '../utils/constants';
export default {
    data() {
        return {
            tableData: overallTableData,
            seachData: null
        }
    },
    methods: {
        getTableData() {
            // tableData = 
            overallTableData.map(tableInfo => {
                console.log(tableInfo.name.indexOf(seachData), '__data');
                return tableInfo.name.indexOf(seachData) !== -1;
            });
        }
    }
}
</script>