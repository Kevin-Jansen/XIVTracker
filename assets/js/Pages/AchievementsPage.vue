<template>
  <div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <h1 class="text-xl font-semibold text-gray-900">All achievements in Final Fantasy XIV</h1>
      </div>
    </div>
    <div class="-mx-4 mt-10 ring-1 ring-gray-300 sm:-mx-6 md:mx-0 md:rounded-lg">
      <table class="min-w-full divide-y divide-gray-300">
        <thead>
        <tr>
          <th class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 cursor-pointer" scope="col" @click="filter('name')">Name</th>
          <th class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell cursor-pointer" scope="col" @click="filter('description')">
            Description
          </th>
          <th class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell cursor-pointer" scope="col" @click="filter('points')">
            Points
          </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(achievement, index) in filteredArray" :key="achievement.id"
            :class="[index % 2 === 0 ? undefined : 'bg-gray-50', 'hover:bg-gray-100com']">
          <td :class="[index === 0 ? '' : 'border-t border-gray-200', 'hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell']">
            {{ achievement.name }}
          </td>
          <td :class="[index === 0 ? '' : 'border-t border-gray-200', 'hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell']">
            {{ achievement.description }}
          </td>
          <td :class="[index === 0 ? '' : 'border-t border-gray-200', 'hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell']">
            {{ achievement.points }}
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script lang="ts" setup>
import {computed, PropType, ref} from "vue";
import Achievement from "../Interfaces/Achievement";
import {sortBy} from 'lodash';

const props = defineProps({
  achievements: Array as PropType<Array<Achievement>>
});

const sortingKey = ref('');
const reverse = ref(false);
const filteredArray = computed(() => {
  const records = sortBy(props.achievements, sortingKey.value);
  if (reverse) records.reverse();
  return records;
});
</script>
