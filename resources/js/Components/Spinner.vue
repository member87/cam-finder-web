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
  border-color: #333 transparent #333 transparent;
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

