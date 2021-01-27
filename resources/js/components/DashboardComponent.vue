<template>
    <div class="container min-h-screen">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="card-header bg-white py-5 px-1">
            <search-input-component placeholder="Please search for a book" @search="search"/>
            <p class="mt-1 text-sm text-gray-500">
                Search for any book in Google API.
            </p>
        </div>
        <template v-if="hittingGoogleApi">
            <div class="card card-body min-h-screen">
                <transition name="fade" :duration="{ enter: 1500, leave: 1000 }">
                    <books-search-loader-component/>
                </transition>
            </div>
        </template>
        <template v-else>
            <div class="card card-body min-h-screen">
                <transition name="fade" :duration="{ enter: 1500, leave: 1000 }">
                    <ul v-if="booksResponse.success && booksResponse.items.length > 0"
                        class="grid md:grid-cols-4 sm:grid-cols-2 mb-3">
                        <template v-for="(book, index) in booksResponse.items">
                            <book-grid-component :book="book" :index="index" :updating-collection="updatingCollection"
                                                 :book-is-selected="bookIsSelected(book.id)" :key="book.id"
                                                 @selectBook="selectBook(book, index)"
                                                 @viewBook="viewBookDetails"></book-grid-component>
                        </template>

                    </ul>

                    <ul v-else-if="booksResponse.success"
                        class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 mb-3">
                        Your search didn't matched any criteria.
                    </ul>
                </transition>
            </div>
        </template>
        <simple-modal v-if="openModal" :open="openModal" :book="selectedBook" @closeModal="closeBookModal"></simple-modal>
    </div>
</template>

<script>
import SearchInputComponent from "./includes/SearchInputComponent";
import BooksSearchLoaderComponent from "./includes/BooksSearchLoaderComponent";
import BookGridComponent from "./includes/BookGridComponent";
import SimpleModal from "./includes/SimpleModal";

export default {
    name: "DashboardComponent",
    components: {
        BookGridComponent,
        BooksSearchLoaderComponent,
        SearchInputComponent,
        SimpleModal
    },

    props: {
        collectedBooks: {
            required: true
        }
    },

    mounted() {
        // axios.get('/sanctum/csrf-cookie').then(response => {
        //     console.log('token csrf');
        // });
        this.selectedBooks = this.collectedBooks;
    },

    data() {
        return {
            searchInput: '',
            booksResponse: {},
            apiErrors: {},
            bookSearchApiUrl: '/api/search-book/',
            syncUserBooksCollectionUrl: '/api/user-book-collection',
            hittingGoogleApi: false,
            selectedBooks: [],
            updatingCollection: false,
            selectedBook: {},
            openModal: false
        }
    },
    methods: {
        search(input) {
            this.hittingGoogleApi = true;
            axios.get(this.bookSearchApiUrl + encodeURI(input))

                .then((response) => {
                    this.booksResponse = response.data;
                })
                .catch((error) => {
                    this.apiErrors = error.response.data;
                })
                .finally(() => {
                    this.hittingGoogleApi = false;
                })
        },
        updateUserCollection() {
            this.updatingCollection = true;
            axios.post(this.syncUserBooksCollectionUrl, {booksCollection: this.selectedBooks})

                .then((response) => {
                    // this.selectedBooks = response.data.collection;
                    _.each(response.data.collection, function (book) {
                        if (_.some(this.selectedBooks, function (item) {
                            return item.id === book.id;
                        })) {
                            this.selectedBooks.push(book);
                        }
                    });
                    this.booksResponse.items = _.unionBy(this.booksResponse.items, response.data.collection, 'id')
                })
                .catch((error) => {
                    // this.apiErrors = error.response.data;
                })
                .finally(() => {
                    this.updatingCollection = false;
                })
        },
        selectBook(book) {
            if (this.bookIsSelected(book.id)) {
                book.selected = !book.selected;
                let bookIndex = _.findIndex(this.selectedBooks, function (item) {
                    return book.id === item.id;
                });
                this.selectedBooks.splice(bookIndex, 1);
            } else {
                book.selected = !book.selected;
                this.selectedBooks.push(book);
            }
            this.updateUserCollection();
        },
        bookIsSelected(bookId) {
            return _.some(this.selectedBooks, function (item) {
                return item.id === bookId;
            })
        },
        viewBookDetails(book) {
            this.selectedBook = book;
            this.openModal = true;
        },
        closeBookModal() {
            this.openModal = false
        }
    }
}
</script>
