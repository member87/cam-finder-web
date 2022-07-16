<script setup>

const props = defineProps({
    data: Object,
}) 


const used = (props.data.TotalSize - props.data.AvailSize)/1024
const percentage = used/(props.data.TotalSize/1024)

</script>

<template>
  <div class="bg-zinc-800 m-3 p-3 rounded text-lg flex justify-center items-center text-white">
    <div class="text-2xl">
      <i class="fa-regular fa-hard-drive"></i>
    </div>
    <div class="w-full pl-4 relative">
      {{data.CodeName}}\ 

      <span class="text-sm right-0 absolute">{{Math.round(used)}}GB / {{Math.round(data.TotalSize/1024)}}GB</span>
      <div class="w-100 bg-neutral-600/50 h-2 rounded-full overflow-hidden">
        <div class="h-full bg-red-900/50" :style="{width: percentage*100 + '%'}"></div>
      </div>
    </div>
  </div>
</template>
