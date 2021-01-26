<template>
    <div class="mt-1 w-1/2 mb-3 flex rounded-md shadow-sm">
        <div class="relative flex items-stretch flex-grow focus-within:z-10">
            <input @keyup.enter="triggerSearch"
                type="text" name="email" id="email"
                class="focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-none rounded-l-md sm:text-sm border-gray-300"
                :placeholder="placeholder" v-model="searchInput">
        </div>
        <button @click="triggerSearch" :disabled="this.inputIsEmpty"
                :class="['-ml-px relative inline-flex items-center space-x-2 px-4 py-2 border border-gray-300 text-sm font-medium rounded-r-md text-white bg-gray-50 bg-indigo-700 hover:bg-indigo-900 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500', {'bg-gray-50' : inputIsEmpty, 'cursor-not-allowed' : inputIsEmpty } ]">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="white" viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <span>Search</span>
        </button>
    </div>

</template>

<script>
export default {
    name: "SearchInputComponent",
    props: {
        placeholder: {
            type: String,
            required: true,
            default: 'Please search'
        }
    },
    data() {
        return {
            searchInput: ''
        }
    },
    computed: {
        inputIsEmpty() {
            return this.searchInput.length === 0;
        }
    },
    methods: {
        triggerSearch() {
            if(this.inputIsEmpty)
                return;
            return this.$emit('search', this.searchInput);
        }
    }
}
</script>

<style scoped>

</style>
