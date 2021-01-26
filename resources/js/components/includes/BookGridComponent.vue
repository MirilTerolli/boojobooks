<template>
    <li class="col-span-2 bg-white rounded-lg shadow m-1" :key="book.id">
        <div class="w-full flex p-6 h-3/4">
            <div class="mr-4 flex-shrink-0">
                <img class="h-full w-100 border border-gray-300 bg-white text-gray-300"
                     v-bind:src="book.thumbnail" :alt="book.title">
            </div>
            <div>
                <h4 class="text-gray-900 text-sm font-medium font-bold">{{ book.title }}</h4>
                <p class="mt-1 break-words" v-html="book.snipped"/>
            </div>
        </div>
        <div class="h-1/4 flex justify-content-end">
            <div :disable="updatingCollection"
                 @click="viewBook(book)"
                 class="flex justify-content-center w-full cursor-pointer hover:text-indigo-700">
                <div class="p-3 rounded-br-lg">
                    <svg class="h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
            </div>
            <div class="block text-center rounded-lg shadow-inner badge-light">
                <button
                    :disable="updatingCollection"
                    @click="selectBook(book, index);"
                    :class="['p-3 text-gray-600 rounded-br-lg hover:text-yellow-400 cursor-pointer',{'text-yellow-400': bookIsSelected}]"
                >
                    <div>
                        <svg v-if="!book.selected" class="w-10 h-10 hover:-translate-x-2"
                             fill="currentColor"
                             stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>

                        <transition name="bounce" :duration="{ enter: 1500, leave: 1 }">
                            <svg v-if="book.selected" class="w-10 h-10 hover:-translate-x-2"
                                 fill="currentColor"
                                 stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                        </transition>
                    </div>
                </button>
            </div>
        </div>
    </li>
</template>

<script>

export default {
    name: "BookGridComponent",

    props: {
        book: {
            required: true
        },
        index: {
            required: true
        },
        updatingCollection: {
            required: true,
            type: Boolean,
            default: false
        },
        bookIsSelected: {
            required: true,
            type: Boolean,
            default: false
        }
    },

    methods: {
        selectBook(book, index) {
            this.$emit('selectBook', book, index)
        },
        viewBook(book) {
            this.$emit('viewBook', book);
        }
    }
}
</script>

<style scoped>

</style>
