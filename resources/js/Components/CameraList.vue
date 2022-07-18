<script setup>
import CameraListItem from '@/Components/CameraListItem.vue';
import { useStore } from '@/Stores/cameras'
const store = useStore()


console.log(store.data.links.filter((v, i) => i > 0 && i < store.data.links.length - 1))
</script>

<template>
  <div class="w-full max-w-screen-sm sm:max-w-none p-4 overflow-scroll">
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-200 uppercase bg-neutral-700">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Ip / Port
                </th>
                <th scope="col" class="px-6 py-3">
                    Camera Count
                </th>
                <th scope="col" class="px-6 py-3">
                    Provider
                </th>
                <th scope="col" class="px-6 py-3">
                    Country
                </th>
                <th scope="col" class="px-6 py-3 text-right">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>

          <tr class="border-b bg-zinc-800 border-zinc-700 text-gray-300" v-for="camera in store.cameraList">
            <CameraListItem :data=camera />
          </tr>
        </tbody>
    </table>


    <div class="flex justify-end mt-5 max-w-screen-sm sm:max-w-none overflow-scroll relative h-12">
      <nav class="w-full sm:w-auto absolute z-10 inline-flex rounded-md shadow-sm -space-x-px right-0 top-0" aria-label="Pagination">
        <a :href="store.data.prev_page_url" class="relative bg-zinc-900 inline-flex items-center px-2 py-2 rounded-l-md border border-neutral-600 bg-white font-medium text-zinc-500 hover:bg-gray-50">
          <span class="sr-only">Previous</span>
          <!-- Heroicon name: solid/chevron-left -->
          <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
          </svg>
        </a>
  

        <div v-for="page in store.data.links.filter((v, i) => i > 0 && i < store.data.links.length - 1)">
          <a :href="page.url" class="border-neutral-600 hover:bg-neutral-800 relative inline-flex items-center px-4 py-2 border font-medium" :class='{"bg-neutral-700 text-gray-400": page.active, "bg-zinc-900 text-gray-600": !page.active}' v-if="page.label != '...'"> {{page.label}} </a>


          <span href="#" class="border-neutral-600 text-gray-500 relative inline-flex items-center px-4 py-2 border font-medium bg-zinc-900" v-if="page.label == '...'"> {{page.label}} </span>
        </div>


        <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
        <a :href="store.data.next_page_url" class="relative bg-zinc-900 inline-flex items-center px-2 py-2 rounded-r-md border border-neutral-600 whit font-medium text-gray-500 hover:bg-gray-50">
          <span class="sr-only">Next</span>
          <!-- Heroicon name: solid/chevron-right -->
          <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
          </svg>
        </a>
      </nav>
    </div>

  </div>
</template>


