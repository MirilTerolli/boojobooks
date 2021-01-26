<template>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!--
              Background overlay, show/hide based on modal state.

              Entering: "ease-out duration-300"
                From: "opacity-0"
                To: "opacity-100"
              Leaving: "ease-in duration-200"
                From: "opacity-100"
                To: "opacity-0"
            -->
            <transition
                enter-class="ease-out duration-300"
                enter-active-class="opacity-0"
                enter-to-class="opacity-100"
                leave-class="ease-in duration-200"
                leave-active-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <div v-if="open" class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
            </transition>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <!--
              Modal panel, show/hide based on modal state.

              Entering: "ease-out duration-300"
                From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                To: "opacity-100 translate-y-0 sm:scale-100"
              Leaving: "ease-in duration-200"
                From: "opacity-100 translate-y-0 sm:scale-100"
                To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            -->
            <transition
                enter-class="ease-out duration-500"
                enter-active-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                enter-to-class="opacity-100 translate-y-0 sm:scale-100"
                leave-class="ease-in duration-400"
                leave-active-class="opacity-100 translate-y-0 sm:scale-100"
                leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            >
                <div v-if="openLocal"
                     class="inline-block bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:p-6"
                     role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                    <div class="hidden sm:block absolute top-0 right-0 pt-4 pr-4">
                        <button @click="$emit('closeModal')"
                            type="button"
                                class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <span class="sr-only">Close</span>
                            <!-- Heroicon name: x -->
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    <div class="sm:flex">
                        <div class="mb-4 flex-shrink-0 sm:mb-0 sm:mr-4">
                            <img class="border border-gray-300 bg-white text-gray-300"
                                 v-bind:src="book.thumbnail" :alt="book.title">
                            <div class="text-sm text-gray-400">
                                <time :datetime="book.publishedDate"
                                      v-text="getDateFormatted(book.publishedDate)"></time>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold" v-text="book.title"></h4>
                            <p class="mt-1" v-html="book.snipped"/>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </div>

</template>

<script>
import moment from "moment";

export default {
    name: 'SimpleModal',
    props: {
        open: {
            type: Boolean,
            default: false
        },
        book: {
            required: true
        }
    },
    data() {
        return {
            openLocal: false
        };
    },

    mounted() {
        this.$nextTick(() => {
            this.openLocal = this.open;
        })

        // this.show();
    },
    methods: {
        getDateFormatted(date) {
            return moment(date, 'YYYY-MM-DD').format('MMMM Do YYYY')
        },
        // show() {
        //     this.$modal.show('simple-modal');
        // },
        // hide() {
        //     this.$modal.hide('simple-modal');
        // }
    }
}
</script>

