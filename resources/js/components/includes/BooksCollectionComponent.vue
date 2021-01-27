<template>
    <div class="bg-white shadow overflow-hidden sm:rounded-md">
        <div class="card card-body">
            <ul v-if="list.length > 0" class="divide-y divide-gray-200">
                <vuedraggable
                    :list="list"
                    :disabled="!enabled"
                    class="list-group"
                    ghost-class="ghost"
                    :move="checkMove"
                    @start="dragging = true"
                    @end="updateUserCollection"
                >
                    <transition-group name="fade" :duration="{ enter: 1500, leave: 1800 }">
                        <li v-for="element in list"
                            :key="element.id"
                            class="bg-gray-100 p-1 border border-gray-300 rounded my-2"
                        >
                            <div
                                class="flex items-center px-4 py-4 sm:px-6">
                                <div class="min-w-0 flex-1 flex items-center cursor-move" title="Drag and Drop">
                                    <div class="flex-shrink-0">
                                        <img class="h-12 w-12 rounded-full"
                                             v-bind:src="element.thumbnail" :alt="element.title">
                                    </div>
                                    <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                        <div>
                                            <p class="text-sm font-medium text-indigo-600 truncate">
                                                {{ element.title }}</p>
                                            <p class="mt-2 flex items-center text-sm text-gray-500">
                                                <span class="truncate" v-html="element.snipped"/>
                                            </p>
                                        </div>
                                        <div class="hidden md:block">
                                            <div>
                                                <p class="text-sm text-gray-900">
                                                    Published on
                                                </p>
                                                <p class="mt-2 flex items-center text-sm text-gray-500">
                                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-green-400" fill="none"
                                                         stroke="currentColor" viewBox="0 0 24 24"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                    <time :datetime="element.publishedDate"
                                                          v-text="getDateFormatted(element.publishedDate)"></time>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cursor-pointer" title="Remove">
                                    <button @click="removeBook(element)">
                                        <svg class="h-5 w-5 text-gray-400 text-yellow-400"
                                             fill="currentColor"
                                             stroke="currentColor" viewBox="0 0 24 24"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </li>
                    </transition-group>
                </vuedraggable>
            </ul>
            <ul v-else>
                <li class="bg-gray-100 p-1 border border-gray-300 rounded my-2"
                >
                    <div class="px-4 py-4 sm:px-6">
                        <div class="min-w-0">
                            <p class="text-center">Your books collection is empty at this time.</p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

</template>

<script>
import vuedraggable from "vuedraggable";
import moment from "moment";
export default {
    name: "BooksCollectionComponent",
    display: "Simple",
    components: {
        vuedraggable
    },
    props: {
        booksCollection: {
            required: true
        }
    },
    watch: {
        list(newVal) {
            _.each(newVal, function (val, index) {
                val.position = index + 1;
            })
        }
    },
    data() {
        return {
            enabled: true,
            list: this.booksCollection,
            dragging: false,
            syncUserBooksCollectionUrl: '/api/user-book-collection'
        };
    },
    // computed: {
    //     draggingInfo() {
    //         return this.dragging ? "under drag" : "";
    //     }
    // },
    methods: {
        checkMove: function (e) {
            // console.log(e)
            // window.console.log("Future index: " + e.draggedContext.futureIndex);
        },
        updateUserCollection() {
            this.dragging = false;
            this.enabled = false;
            axios.post(this.syncUserBooksCollectionUrl, {booksCollection: this.list})

                .then((response) => {
                    this.list = response.data.collection;
                })
                .catch((error) => {
                    // this.apiErrors = error.response.data;
                })
                .finally(() => {
                    this.enabled = true;
                })
        },
        getDateFormatted(date) {
            return moment(date, 'YYYY-MM-DD').format('MMMM Do YYYY')
        },
        removeBook(book) {
            book.selected = !book.selected;
            let bookIndex = _.findIndex(this.list, function (item) {
                return book.id === item.id;
            });
            this.list.splice(bookIndex, 1);
            this.updateUserCollection();
        },
    }
};
</script>
<style scoped>
.buttons {
    margin-top: 35px;
}

.ghost {
    opacity: 0.5;
    background: #a5b4fc;
}
</style>

