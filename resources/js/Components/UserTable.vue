<script setup>
import { useStore } from "@/Stores/cameras";

const store = useStore();
</script>

<template>
  <div class="overflow-x-auto relative m-3 rounded ml-2">
    <table class="w-full text-sm text-left text-zinc-800">
      <thead class="text-xs text-gray-300 uppercase bg-zinc-800">
        <tr>
          <th class="py-3 px-6">Name</th>
          <th class="py-3 px-6">Mail</th>

          <th class="py-3 px-6">Group</th>
        </tr>
      </thead>
      <tbody v-if="typeof store.info.users == 'object'">
        <tr
          class="bg-neutral-600/50 border-b border-neutral-600 text-white"
          v-for="user in store.info.users">
          <td class="py-4 px-6">
            {{ user.Name }}
          </td>
          <td class="py-4 px-6">
            {{ user.Mail.length == 0 ? "N/A" : user.Mail }}
          </td>
          <td class="py-4 px-6">
            {{ user.UserGroups.UserGroup.id }}
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
