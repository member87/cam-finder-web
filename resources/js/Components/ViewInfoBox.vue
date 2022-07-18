<script setup>
import axios from 'axios'
import { useStore } from '@/Stores/cameras'
import { ref, onMounted, useSlots } from 'vue';
import Spinner from '@/Components/Spinner.vue'


const store = useStore();
let showModal = ref(false);
const slots = useSlots()


let hasSlot = () => {
    return !!slots.default
  }

function toggleModal() {
    console.log("aa")
    showModal.value = !showModal.value
  }


const props = defineProps({
  text: String,
  id: String,
  icon: String,
  color: String
});

function shouldRender() {
    if (store.info[props.id].length) {
      return true;
    } else {
       return false;   
    }
  }

function render() {
    if(store.info[props.id].length) 
      return store.info[props.id].length
    return 1
  }


</script>

<template>
  <div class="h-1/4 flex items-center justify-center p-4 m-2 rounded relative overflow-hidden" :class="props.color">
    <div class="image absolute -left-4 -top-4 text-9xl text-white opacity-50"><i class='fa-solid' :class="props.icon"></i></div>
    <div class="font-extrabold flex items-center justify-center flex-col text-center z-50">
      <span class="text-gray-700 uppercase text-sm">{{props.text}}</span>
      <Spinner v-if="!shouldRender()" />
      <span v-if="shouldRender()" class="text-gray-700 text-4xl">
        {{render()}}
      </span>
      <button @click="toggleModal" class="absolute top-1 right-1 text-xl text-slate-100" v-if="hasSlot()"><i class="fa-solid fa-circle-info"></i></button>
    </div>
  </div>

  <div v-if="showModal" @close="toggleModal">
    <slot :close="toggleModal" ></slot>
  </div>
</template>

<style scoped>


.image {
    transform: rotate(-30deg)
  }

</style>
