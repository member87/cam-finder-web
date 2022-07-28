<script setup>
import { useStore } from "@/Stores/cameras";

const store = useStore();

function convertTime(time) {
  return new Date(time * 1000).toLocaleString();
}
</script>

<template>
  <div class="overflow-x-auto relative m-2 rounded ml-2">
    <table class="w-full text-sm text-left text-zinc-800">
      <thead class="text-xs text-gray-300 uppercase bg-zinc-800">
        <tr>
          <th class="py-3 px-6">Name</th>
          <th class="py-3 px-6">IP</th>

          <th class="py-3 px-6">Time</th>
        </tr>
      </thead>
      <tbody v-if="typeof store.info.users == 'object'">
        <tr
          class="bg-neutral-600 border-b border-neutral-700 text-white"
          v-for="user in store.info.connected">
          <th class="py-4 px-6">
            {{ user.Name }}
          </th>
          <td class="py-4 px-6">
            {{ user.Address }}
          </td>
          <td class="py-4 px-6">
            {{ convertTime(user.Time) }}
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
