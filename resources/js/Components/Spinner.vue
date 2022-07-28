<script setup>
import { defineProps } from "vue";

let props = defineProps({
  color: String,
});

let col = "#333";
if (props.color) col = props.color;
</script>
<template>
  <div class="lds-dual-ring"></div>
</template>

<style scoped>
.lds-dual-ring {
  display: inline-block;
  width: 50px;
  height: 50px;
}
.lds-dual-ring:after {
  content: " ";
  display: block;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  border: 6px solid #111;
  border-color: v-bind(col) transparent v-bind(col) transparent;
  animation: lds-dual-ring 1.2s linear infinite;
}
@keyframes lds-dual-ring {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>
